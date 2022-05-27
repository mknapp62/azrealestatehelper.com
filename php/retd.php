<?php

session_start();
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require_once "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}

/* VIEW OFFER BUTTON TO GO TO THE RESPONSE PAGE   */

if(isset($_POST["offer"])) {
   session_unset();
   $passQ = 'SELECT * FROM contract
              WHERE buyer_id = :buyer_id AND property_id = :property_id';
    $stmt = $pdo->prepare($passQ);
    $stmt->execute(array(
      ':buyer_id' => $_POST['buyerid'],
      ':property_id' => $_POST['propertyid']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row === FALSE) {
        $_SESSION['offernotfound'] = "Please re-enter the correct ID numbers" .$_POST['buyerid'].$_POST['propertyid'] ;
        header("Location: http://www.azrealestatehelper.com");
    exit();
    }
   $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_POST['buyerid']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
     $_SESSION['buyer_id'] = $name['user_id'];
      $firscontract = $pdo->prepare("SELECT * FROM contract WHERE property_id = :xyz LIMIT 1;");
        $firscontract->execute(array(
            ':xyz' => $_POST['propertyid']
            ));
        $row2 = $firscontract->fetch(PDO::FETCH_ASSOC);
        $_SESSION['contract_id'] = $row2['contract_id'];
        $_SESSION['sent'] = $row2['sent'];
        $_SESSION['createdby'] = $row2['createdby'];
        if($row2['seller_id'] !== null){
            $_SESSION['hidecreateaccount'] = 1;
        }
   $_SESSION['user_id'] = 1;
   /*MARKER TO KNOW WE NEED TO PROMPT THEM TO SIGN IN/UP*/
      $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
   
   (new LoadContracts())->loadresponsecontracts();
       (new FileData())->FileDataResponse();
   $_SESSION['pleasesignin'] = 1;
   
   
    header("Location: http://response.azrealestatehelper.com");
   exit();
}



/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/


/* USER LOGIN----------------------------------------------------------------*/
if(isset($_POST['email']) && ($_POST['pswd'])) {
    $passQ = 'SELECT user1 FROM buyer
              WHERE email = :em AND password = :pw';
    $stmt = $pdo->prepare($passQ);
    $stmt->execute(array(
      ':em' => $_POST['email'],
      ':pw' => $_POST['pswd']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    if ($row === FALSE) {
      $_SESSION['IncorrectPass'] = "Incorrect Password or Email";
    $_SESSION['email'] = $_POST['email'];
      header("Location: http://azrealestatehelper.com");
      exit();
    } else {
      
      session_unset();

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
      $_SESSION['buyer_id'] = $name['user_id'];
      $_SESSION['email'] = $name['Email'];
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    header("Location: http://landing.azrealestatehelper.com");

      exit();
}}

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      session_destroy();
      header("Location: http://www.azrealestatehelper.com");
      }


/* set contract_id main var to selected address through button on landing page */



/* Log in screen ------------------------------------------------------------
    Create user code
*/
require_once "pass.php";
  if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ 
      if($_POST["createpswd"] == $_POST["createpswd2"]) {
      session_unset();
      $_SESSION['email'] = $_POST["createemail"];
    $stmt = $pdo->prepare("SELECT * FROM buyer WHERE Email= :email");
    $stmt->execute(array(
      ':email' => $_POST['createemail']  )); 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['Email'] == $_POST['createemail']) {
        // email found
     $_SESSION['emailexists'] = 1;

        header("Location: http://www.azrealestatehelper.com");
        exit();
        } else {
               
              $sql = "INSERT INTO buyer (user1, email, password)
                   VALUES (:user1, :buyerEmail, :buyerPass)";
              $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $stmt = $s->prepare($sql);
             $stmt->execute(array(
                ':user1' => $_POST["createname"],
                ':buyerEmail' => $_POST["createemail"],
                ':buyerPass' => $_POST["createpswd"]));
                $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['createemail']}';")->fetch();
                $_SESSION['name'] = $name['user1']; /* ['buyer1']  is from the associative array pdo above*/
                $_SESSION['user_id'] = $name['user_id']; /* this is for the foreign key that goes into any id field*/
                $_SESSION['buyer_id'] = $name['user_id'];
                 $_SESSION['email'] = $name['Email'];
                 $_SESSION['emailexists'] = 0;
                 
               header("Location: http://www.landing.azrealestatehelper.com");
                exit();
  
          }  
          
      }else{
     $_SESSION['passnomatch1'] = "Passwords don't match";
     
    header("Location: http://www.azrealestatehelper.com");
          exit(); 
 }} 

if(isset($_POST['sendkey']) && $_POST['key'] == ''){
         $key = bin2hex(random_bytes(4));
       $_SESSION['email'] = $_POST['email'];
     $to = $_SESSION['email'];
        $subject = "2My subject";
        $txt = "Hello world! this is your key: ".$key;
        $headers = "From: help@azrealestatehelper.com";
    mail($to,$subject,$txt,$headers);
    $stmt = $pdo->prepare("UPDATE buyer SET resetkey = :key WHERE Email = :email");
    $stmt->execute(array(
      ':key' => $key,
      ':email' => $_SESSION['email']  ));
      $_SESSION['sendkey'] = 1;
    
      exit();
}
/* RESET KEY ENTERED */
if(isset($_POST['key'])){
     $stmt = $pdo->prepare("SELECT * FROM buyer WHERE Email= :email");
    $stmt->execute(array(
      ':email' => $_POST['email']  )); 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['resetkey'] == $_POST['key']) {
              $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
      $_SESSION['buyer_id'] = $name['user_id'];
      $_SESSION['email'] = $name['Email'];
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
       require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
        (new LoadLanding())->LoadContracts();
       // header("Location: http://www.landing.azrealestatehelper.com");
    $_SESSION['Incorrectkey'] = 1;
         
    }else{
        $_SESSION['Incorrectkey'] = $_POST['key'];
    
    
}}

/*RESET PASSWORD AND GO TO LANDING*/

 if(isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ if($_POST["createpswd"] == $_POST["createpswd2"]) {
      $stmt = $pdo->prepare("UPDATE buyer SET password = :password WHERE email = :email");
    $stmt->execute(array(
      ':password' => $_POST['createpswd'],
      ':email' => $_SESSION['email']  ));
      
          exit();
 }else{
     $_SESSION['passnomatch'] = "Passwords dont match";
    
          exit(); 
 }
 }
 

  /* Update  purchase "Contract deal information page"
  ---------------------------------------------$nameproperty['property_id'] == $_SESSION['property_id'] ){  need to alter this statement it doesn't retur-----------------------*/

$json1 = new \stdClass();
$json1->success = false;
$json1->e = $_SESSION['emailexists'];
$json1->sendkey = $_SESSION['sendkey'];
$json1->Incorrectkey = $_SESSION['Incorrectkey'];
$json1->passnomatch = $_SESSION['passnomatch'];
echo (json_encode($json1));

if(isset($_SESSION['Incorrectkey'])){
    unset($_SESSION['Incorrectkey']);
}
if(isset($_SESSION['sendkey'])){
    unset($_SESSION['sendkey']);
}




 ?>
