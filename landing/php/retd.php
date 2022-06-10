<?php
session_start();
if(session_status() != 2){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}

   
        
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require_once "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}



/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["reload"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];

  $contract2 = $pdo->prepare("SELECT * FROM contract WHERE buyer_id = :xyz GROUP BY contract_id;");
  $contract2->execute(array(':xyz' => $_SESSION['buyer_id']));
  $address2 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                            ON property.property_id = contract.property_id
                            WHERE contract_id = :zxy;");
  $inc = 0;

/* sets unlimited contract ids so the user can choose which one to work on */
  while($row = $contract2->fetch(PDO::FETCH_ASSOC)) {


    $_SESSION['contract_id' .$inc] = htmlentities($row['contract_id']);
    $inc++;

  }
  $inc2 = 0;
  $inc3 = 1;
  $address2->execute(array(':zxy' => $_SESSION['contract_id' .$inc2]));
/* sets unlimited address vars tied to contractids so the user can choose which one to work on */
  while($row2 = $address2->fetch(PDO::FETCH_ASSOC)){

    $_SESSION['addresslist' .$inc2] = htmlentities($row2['address']);

    $address2->execute(array(':zxy' => $_SESSION['contract_id' .$inc3]));

    $inc2++;
    $inc3++;
  }
    
  header("Location: http://landing.azrealestatehelper.com");

  exit();
    }



/* DELETE CONTRACT------$contract2 = $pdo->prepare("UPDATE contract SET buyer_id = 1 WHERE contract_id = :xyz;");
  $contract2->execute(array(':xyz' => $_POST["delete"]));e----------------------------------------------------------*/
if(isset($_POST["delete"])){

  $contract4 = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_POST["delete"]}';")->fetch();
    
  $propid = $contract4['property_id'];
   
 $contract3 = $pdo->prepare("UPDATE contract SET buyer_id = 1 WHERE property_id = :xyz;");
  $contract3->execute(array(':xyz' => $propid));
  
  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];

$inc4 = 0;
    while(isset($_SESSION['contract_id' .$inc4])){
    unset($_SESSION['contract_id' .$inc4]);
    $inc4++;

}

  $contract2 = $pdo->prepare("SELECT property_id, ANY_VALUE(contract_id) AS contract_id FROM contract WHERE buyer_id = :xyz GROUP BY property_id;");
      $contract2->execute(array(':xyz' => $_SESSION['buyer_id']));
      
      
      $address2 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                                ON property.property_id = contract.property_id
                                WHERE contract_id = :zxy;");
      $inc = 0;

/* sets unlimited contract ids so the user can choose which one to work on */
      while($row = $contract2->fetch(PDO::FETCH_ASSOC)) {


        $_SESSION['contract_id' .$inc] = htmlentities($row['contract_id']);
        $inc++;

      }
      $inc2 = 0;
      $inc3 = 1;
      $address2->execute(array(':zxy' => $_SESSION['contract_id' .$inc2]));
/* sets unlimited address vars tied to contractids so the user can choose which one to work on */
      while($row2 = $address2->fetch(PDO::FETCH_ASSOC)){

        $_SESSION['addresslist' .$inc2] = htmlentities($row2['address']);

        $address2->execute(array(':zxy' => $_SESSION['contract_id' .$inc3]));

        $inc2++;
        $inc3++;
      }
    $_SESSION['deleted'] = "Contract Deleted";
  header("Location: http://landing.azrealestatehelper.com");

  exit();

}


if(isset($_POST["deleteseller"])){

  $contract4 = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_POST["deleteseller"]}';")->fetch();
    
  $propid = $contract4['property_id'];
   
 $contract3 = $pdo->prepare("UPDATE contract SET seller_id = 1 WHERE property_id = :xyz;");
  $contract3->execute(array(':xyz' => $propid));
  
  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];
//SELLER CONTRACTS   RELOAD 
 $inc4 = 0;
            while(isset($_SESSION['contract_id0' .$inc4])){
            unset($_SESSION['contract_id0' .$inc4]);
            $inc4++;
        
        }
        
        LoadLanding::LoadContracts();

    $_SESSION['deletedseller'] = "Contract Deleted";
  header("Location: http://landing.azrealestatehelper.com");

  exit();

}

/* MODIFY USER INFO----------------------------------------------------------------*/
if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ 
    if($_POST["createpswd"] == $_POST["createpswd2"]) {
   
              $sql = "UPDATE buyer SET user1 = :user1, Email = :email, password = :password WHERE user_id = :user_id";
              $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $s->prepare($sql);
             $stmt->execute(array(
                 ':user_id' => $_SESSION['user_id'],
                ':user1' => $_POST["createname"],
                ':email' => $_POST["createemail"],
                ':password' => $_POST["createpswd"]));
                $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['createemail']}';")->fetch();
                $_SESSION['name'] = $name['user1']; /* ['buyer1']  is from the associative array pdo above*/
                $_SESSION['user_id'] = $name['user_id']; /* this is for the foreign key that goes into any id field*/
                $_SESSION['buyer_id'] = $name['user_id'];
                 $_SESSION['email'] = $name['Email'];
               $_SESSION['userupdated'] = "User profile updated";
              
                exit();
           
          
      }else{
     $_SESSION['passnomatch'] = "Passwords don't match";
  echo $_SESSION['passnomatch'];
          exit(); 
 }} 

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      }


/*ADD NEW OFFER SENT TO USER IN LOGIN PAGE*/
if(isset($_POST["offer"])) {
   
   $_SESSION['buyerseller'] = 1;
   $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
   (new FileData())->FileDataResponse();
   (new LoadContracts())->loadresponsecontracts();
   

      $firscontract = $pdo->prepare("SELECT * FROM contract WHERE property_id = :xyz LIMIT 1;");
        $firscontract->execute(array(
            ':xyz' => $_POST['propertyid']
            ));
        $row2 = $firscontract->fetch(PDO::FETCH_ASSOC);
        $_SESSION['contract_id'] = $row2['contract_id'];
 
   /*MARKER TO KNOW WE NEED TO PROMPT THEM TO SIGN IN/UP*/
     $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
     
      $stmtsetsellerid = $s->prepare($setsellerid);
      $stmtsetsellerid->execute(array(
        ':seller_id' => $_SESSION['user_id'],
        ':property_id' => $_POST['propertyid']));
   
    header("Location: http://response.azrealestatehelper.com", 302);
   exit();
}

/* SEVED CONTRACTS FROM LANDING set contract_id main var to selected address through button on landing page */
  if(isset($_POST["saved"]) || isset($_POST["saved2"])) {
   
   
    $_SESSION['contract_id'] = $_POST["saved"].$_POST["saved2"];
        $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    LoadContracts::loadbasecontract();
    
    LoadContracts::loaduserview();

    LoadContracts::loadproperty();

    LoadContracts::loadbinsrvars();
    
    (new FileData())->FileDataResponse();
    (new LoadContracts())->loadresponsecontracts(); 
    
    if($_SESSION['sent'] == 1 || $_SESSION['contract_id11'] != null){
        header("Location: https://www.response.azrealestatehelper.com", 302);
    exit(); 
    }else{
        header("Location: https://www.confirm.azrealestatehelper.com", 302);
    exit(); 
    }

  }

  /* Update  purchase "Contract deal information page"
  ---------------------------------------------$nameproperty['property_id'] == $_SESSION['property_id'] ){  need to alter this statement it doesn't retur-----------------------*/
$json1 = new \stdClass();
$json1->success = false;
$json1->emailexists = $_SESSION['emailexists'];
$json1->userupdated = $_SESSION['userupdated'];
$json1->passnomatch = $_SESSION['passnomatch'];

echo (json_encode($json1));

if(isset($_SESSION['passnomatch'])){
    unset($_SESSION['passnomatch']);
}
if(isset($_SESSION['userupdated'])){
    unset($_SESSION['userupdated']);
}
if(isset($_SESSION['emailexists'])){
    unset($_SESSION['emailexists']);
}

 ?>
