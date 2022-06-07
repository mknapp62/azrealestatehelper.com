<?php
session_start();
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require_once "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}



/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/




/* USER LOGIN----------------------------------------------------------------*/


/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      }


/* SAVED BUTTON set contract_id main var to selected address through button on landing page */



/* Log in screen ------------------------------------------------------------
    Create user code
*/
require_once "pass.php";


/* CREATE NEW USER------------ */

if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"]))   

if($_POST["createpswd"] == $_POST["createpswd2"]) {

      $_SESSION['email'] = $_POST["createemail"];
    $stmt = $pdo->prepare("SELECT * FROM buyer WHERE Email= :email");
    $stmt->execute(array(
      ':email' => $_POST['createemail']  )); 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['Email'] == $_POST['createemail']) {
        // email found
     $_SESSION['emailexists'] = 1;

        exit();
}else{     $sql = "INSERT INTO buyer (user1, email, password)
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
        $_SESSION["createname"] = $_POST["createname"];
        $_SESSION['contract'] = 1;
        
       exit();
  }}


/*USER LOGIN----------------------------------------------------*/
if(isset($_POST['email']) && ($_POST['pswd'])) {
    $passQ = 'SELECT user1 FROM buyer
              WHERE email = :em AND password = :pw';
    $stmt = $pdo->prepare($passQ);
    $stmt->execute(array(
      ':em' => $_POST['email'],
      ':pw' => $_POST['pswd']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $IncorrectPass = "Wrong Password";
    $_SESSION['pleasesignin'] = 0;
    if ($row === FALSE) {
      $_SESSION['IncorrectPass'] = "Incorrect Password or Email";
      
      exit();
    } else {
     

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
      $_SESSION['buyer_id'] = $name['user_id'];
      
        $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
     
      $stmtsetsellerid = $s->prepare($setsellerid);
      $stmtsetsellerid->execute(array(
        ':seller_id' => '',
        ':property_id' => $_SESSION['property_id']));

      exit();
}}



/* NEW PROPERTY DATA */
require_once "pass.php";



  /* Update  purchase "Contract deal information page"
  ---------------------------------------------$nameproperty['property_id'] == $_SESSION['property_id'] ){  need to alter this statement it doesn't retur-----------------------*/

  if(isset($_GET["buyer1"]) && isset($_SESSION["contract_id"])){
      $nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
      
  if(isset($_GET["buyer1"]) && isset($_SESSION["contract_id"]) &&  $nameproperty['property_id'] == $_SESSION['property_id'] ){
      
      $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   (new SqlUpadates())->UpdateContract();
     
      echo "<meta http-equiv='refresh' content='0'>";
      exit();
      }




/* Create new purchase "Contract deal information page"
--------------------------------------------------------------------*/

require_once "pass.php";

/* TOOK THIS OUT OF BELOW IT WASNT' CREATING NEW CONTRACT  && $_SESSION['property_id'] != $nameproperty['property_id']*/
  if(isset($_GET["buyer1"]) || isset($_POST["createacctcont"])) {
      $leadpaint = "";
      if($_SESSION['yearbuilt'] < 1978){
        $leadpaint = 1;
      } else {
        $leadpaint = 0;
      }

      $sewer = "";/*could just make the value from the form 1 or 0 I guess */
      function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
      if(test_input($_SESSION['sewer']) == "sewer"){
          $onsitewastewater = 0;
        }else{
          $onsitewastewater = 1;
        }

      $sqlcontract = "INSERT INTO contract (property_id, buyer_id, buyer1, buyer2, seller1, seller2, purchaseprice, earnestmoney, financed, additionaldown, earnestmoneyform, earnestmoneyheld, coedate, buyercontingency, waterwell, hoa, leadpaint, loanassuption, onsitewastewater, sellerfinancing, shortsale, other, refrigerator, washer, dryer, spa, personalprop, personalprop2, financing, sellerconsessionsdollar, homewarrantyorderedby, homewarrantypaidby, homewarrantyamount, additionalterms, accepttime, sent, createdby)
              VALUES (:property_id, :buyer_id, :buyer1, :buyer2, :seller1, :seller2, :purchaseprice, :earnestmoney, :financed, :additionaldown, :earnestmoneyform, :earnestmoneyheld, :coedate, :buyercontingency, :waterwell, :hoa, :leadpaint, :loanassuption, :onsitewastewater, :sellerfinancing, :shortsale, :other, :refrigerator, :washer, :dryer, :spa, :personalprop, :personalprop2, :financing, :sellerconsessionsdollar, :homewarrantyorderedby, :homewarrantypaidby, :homewarrantyamount, :additionalterms, :accepttime, :sent, :createdby)";
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* should be tieing foreign key contract and property*/
        ':sent' => 0,
        ':createdby' => 0,
        ':buyer_id' => $_SESSION['buyer_id'],
        ':buyer1' => $_GET["buyer1"],
        ':buyer2' => $_GET["buyer2"],
        ':seller1' => $_SESSION['seller1'],
        ':seller2' => $_SESSION['seller2'],
        ':purchaseprice' => $_GET["purchaseprice"],
        ':earnestmoney' => $_GET["earnestmoney"],
        ':additionaldown' => $_GET["additionaldown"],
        ':financed' => $_GET["financed"],
        ':earnestmoneyform' => $_GET["earnestmoneyform"],
        ':earnestmoneyheld' => $_GET["earnestmoneyheld"],
        ':coedate' => $_GET["coedate"],
        ':buyercontingency' => $_GET["buyercontingency"],
        ':waterwell' => $_GET["waterwell"],
        ':hoa' => $_GET["hoa"],
        ':leadpaint' => $leadpaint,
        ':loanassuption' => $_GET["loanassuption"],
        ':onsitewastewater' => $onsitewastewater,
        ':sellerfinancing' => $_GET["sellerfinancing"],
        ':shortsale' => $_GET["shortsale"],
        ':other' => $_GET["other"],
        ':refrigerator' => $_GET["refrigerator"],
        ':washer' => $_GET["washer"],
        ':dryer' => $_GET["dryer"],
        ':spa' => $_GET["spa"],
        ':personalprop' => $_GET["personalprop"],
        ':personalprop2' => $_GET["personalprop2"],
        ':financing' => $_GET["financingtype"],
        ':sellerconsessionsdollar' => $_GET["sellerconsessions"],
        ':homewarrantyorderedby' => $_GET["homewarrantyorderedby"],
        ':homewarrantypaidby' => $_GET["homewarrantypaidby"],
        ':homewarrantyamount' => "500.00",
        ':additionalterms' => $_GET["additionalterms"],
        ':accepttime' => $_GET["accepttime"]
        ));

          $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();
          $_SESSION['contract_id'] = $contract['contract_id'];
          $_SESSION['buyer1'] = $contract['buyer1'];
          $_SESSION['buyer2'] = $contract['buyer2'];
          $_SESSION['purchaseprice'] = $contract['purchaseprice'];
          $_SESSION['earnestmoney'] = $contract['earnestmoney'];
          $_SESSION['financed'] = $contract['financed'];
          $_SESSION['additionaldown'] = $contract['additionaldown'];
          $_SESSION['earnestmoneyform'] = $contract['earnestmoneyform'];
          $_SESSION['earnestmoneyheld'] = $contract['earnestmoneyheld'];
          $_SESSION['coedate'] = $contract['coedate'];
          $_SESSION['buyercontingency'] = $contract['buyercontingency'];
          $_SESSION['waterwell'] = $contract['waterwell'];
          $_SESSION['leadpaint'] = $leadpaint;
          $_SESSION['hoa'] = $contract['hoa'];
          $_SESSION['loanassuption'] = $contract['loanassuption'];
          $_SESSION['onsitewastewater'] = $contract['onsitewastewater'];
          $_SESSION['sellerfinancing'] = $contract['sellerfinancing'];
          $_SESSION['shortsale'] = $contract['shortsale'];
          $_SESSION['other'] = $contract['other'];
          $_SESSION['refrigerator'] = $contract['refrigerator'];
          $_SESSION['washer'] = $contract['washer'];
          $_SESSION['dryer'] = $contract['dryer'];
          $_SESSION['spa'] = $contract['spa'];
          $_SESSION['personalprop'] = $contract['personalprop'];
          $_SESSION['personalprop2'] = $contract['personalprop2'];
          $_SESSION['financing'] = $contract['financing'];
          $_SESSION['sellerconsessionspercent'] = $contract['sellerconsessionspercent'];
          $_SESSION['sellerconsessionsdollar'] = $contract['sellerconsessionsdollar'];
          $_SESSION['homewarrantyorderedby'] = $contract['homewarrantyorderedby'];
          $_SESSION['homewarrantypaidby'] = $contract['homewarrantypaidby'];
          $_SESSION['homewarrantyamount'] = $contract['homewarrantyamount'];
          $_SESSION['additionalterms'] = $contract['additionalterms'];
          $_SESSION['accepttime'] = $contract['accepttime'];

          if($_SESSION['buyercontingency'] == "1"){
            $_SESSION['buyercontingencycheck'] = " checked";
          }else{
            $_SESSION['buyercontingencycheck'] ="";
          }

          if($_SESSION['waterwell'] == "1"){
            $_SESSION['waterwellcheck'] = " checked";
          }else{
            $_SESSION['waterwellcheck'] ="";
          }

          if($_SESSION['hoa'] == "1"){
            $_SESSION['hoacheck'] = " checked";
          }else{
            $_SESSION['hoacheck'] ="";
          }

          if($_SESSION['loanassuption'] == "1"){
            $_SESSION['loanassuptioncheck'] = " checked";
          }else{
            $_SESSION['loanassuptioncheck'] ="";
          }

          if($_SESSION['sellerfinancing'] == "1"){
            $_SESSION['sellerfinancingcheck'] = " checked";
          }else{
            $_SESSION['sellerfinancingcheck'] ="";
          }

          if($_SESSION['shortsale'] == "1"){
            $_SESSION['shortsalecheck'] = " checked";
          }else{
            $_SESSION['shortsalecheck'] ="";
          }

          if($_SESSION['other'] == "1"){
            $_SESSION['othercheck'] = " checked";
          }else{
            $_SESSION['othercheck'] ="";
          }

          if($_SESSION['refrigerator'] == "1"){
            $_SESSION['refrigeratorcheck'] = " checked";
          }else{
            $_SESSION['refrigeratorcheck'] ="";
          }

          if($_SESSION['washer'] == "1"){
            $_SESSION['washercheck'] = " checked";
          }else{
            $_SESSION['washercheck'] ="";
          }

          if($_SESSION['dryer'] == "1"){
            $_SESSION['dryercheck'] = " checked";
          }else{
            $_SESSION['dryercheck'] ="";
          }

          if($_SESSION['spa'] == "1"){
            $_SESSION['spacheck'] = " checked";
          }else{
            $_SESSION['spacheck'] ="";
          }

          $_SESSION['cash'] = "";
          $_SESSION['conventional'] = "";
          $_SESSION['fha'] = "";
          $_SESSION['va'] = "";
          $_SESSION['usda'] = "";
          $_SESSION['assumption'] = "";
          $_SESSION['sellercarryback'] = "";

          switch ($_SESSION['financing']) {
            case "Cash":
              $_SESSION['cash'] = "checked";
              break;
            case "Conventional":
              $_SESSION['conventional'] = "checked";
              break;
            case "FHA":
              $_SESSION['fha'] = "checked";
              break;
            case "VA":
              $_SESSION['va'] = "checked";
              break;
            case "USDA":
              $_SESSION['usda'] = "checked";
              break;
            case "Assumption":
              $_SESSION['assumption'] = "checked";
              break;
            case "Seller Carryback":
              $_SESSION['sellercarryback'] = "checked";
              break;
          }

          if($_SESSION['homewarrantyorderedby'] == "Buyer"){
            $_SESSION['homewarrantyorderedbybuyercheck'] = " checked";
          }else{
            $_SESSION['homewarrantyorderedbybuyercheck'] ="";
          }

          if($_SESSION['homewarrantyorderedby'] == "Seller"){
            $_SESSION['homewarrantyorderedbysellercheck'] = " checked";
          }else{
            $_SESSION['homewarrantyorderedbysellercheck'] ="";
          }

          if($_SESSION['homewarrantypaidby'] == "Buyer"){
            $_SESSION['homewarrantypaidbybuyercheck'] = " checked";
          }else{
            $_SESSION['homewarrantypaidbybuyercheck'] ="";
          }

          if($_SESSION['homewarrantypaidby'] == "Seller"){
            $_SESSION['homewarrantypaidbysellercheck'] = " checked";
          }else{
            $_SESSION['homewarrantypaidbysellercheck'] ="";
          }

          /*if agent is set --------------------------*/
        if($_GET["agentname"] != ""){
        $sqlagent = "INSERT INTO agent (agentname, agentlicense, agentname2, agentlicense2, firmname, firmaddress, firmlicense, firmphone, agentemail)
                VALUES (:agentname, :agentlicense, :agentname2, :agentlicense2, :firmname, :firmaddress, :firmlicense, :firmphone, :agentemail)";
        $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
        $_SESSION['agentname'] = $_GET["agentname"];
        $stmtagent = $s->prepare($sqlagent);
        $stmtagent->execute(array(
          ':agentname' => $_GET["agentname"],
          ':agentlicense' => $_GET["agentlicense"],
          ':agentname2' => $_GET["agentname2"],
          ':agentlicense2' => $_GET["agentlicense2"],
          ':firmname' => $_GET["firmname"],
          ':firmaddress' => $_GET["firmaddress"],
          ':firmlicense' => $_GET["firmlicense"],
          ':firmphone' => $_GET["firmphone"],
          ':agentemail' => $_GET["agentemail"]));

        $agent = $pdo->query("SELECT * FROM agent WHERE agentname='{$_SESSION['agentname']}';")->fetch();
        /* $name use this is for any other session var */
        $_SESSION['agentlicense'] = $agent['agentlicense'];
        $_SESSION['agentname2'] = $agent['agentname2'];
        $_SESSION['agentlicense2'] = $agent['agentlicense2'];
        $_SESSION['firmname'] = $agent['firmname'];
        $_SESSION['firmaddress'] = $agent['firmaddress'];
        $_SESSION['firmlicense'] = $agent['firmlicense'];
        $_SESSION['firmphone'] = $agent['firmphone'];
        $_SESSION['agentemail'] = $agent['agentemail'];
        $_SESSION['selleragentid'] = $agent['agentid'];
/*  this part keeps creating a brand new blank post in contract */
        $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
        $stmtselleragent = $s->prepare($sqlselleragent);
        $stmtselleragent->execute(array(
        ':selleragentid' => $_SESSION['selleragentid'],
        ':contract_id' => $_SESSION['contract_id']));
      header("Location: http://confirm.azrealestatehelper.com", 302);
    
    exit();
  }else{
      unset ($_SESSION['agentlicense']);
      unset ($_SESSION['agentname2']);
      unset ($_SESSION['agentname']);
      unset ($_SESSION['agentlicense2']);
      unset ($_SESSION['firmname']);
      unset ($_SESSION['firmaddress']);
      unset ($_SESSION['firmlicense']);
      unset ($_SESSION['firmphone']);
      unset ($_SESSION['agentemail']);
      unset ($_SESSION['selleragentid']);
      header("Location: http://confirm.azrealestatehelper.com", 302);
    
    exit();
        }
}

if(isset($_POST['sendkey']) && $_POST['sentkey'] == ''){
         $key = bin2hex(random_bytes(4));
       
     $to = $_POST['email'];
        $subject = "2My subject";
        $txt = "Hello world! this is your key: ".$key;
        $headers = "From: help@azrealestatehelper.com";
    mail($to,$subject,$txt,$headers);
    $stmt = $pdo->prepare("UPDATE buyer SET resetkey = :key WHERE email = :email");
    $stmt->execute(array(
      ':key' => $key,
      ':email' => $_POST['email']  ));
      $_SESSION['sendkey'] = 1;
    $_SESSION['Incorrectkey'] = 0;
      exit();
}

if(isset($_POST['key'])){
     $stmt = $pdo->prepare("SELECT * FROM buyer WHERE Email= :email");
    $stmt->execute(array(
      ':email' => $_POST['email']  )); 
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['resetkey'] == $_POST['sentkey']) {
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
    $_SESSION['Incorrectkey'] = 0;
          exit();
    }else{
        $_SESSION['Incorrectkey'] = 1;
     exit();
    
}}
//LEFT OFF
 if(isset($_POST["01"])){ 
     if($_POST["createpswd"] == $_POST["createpswd2"]) {
      $stmt = $pdo->prepare("UPDATE buyer SET password = :password WHERE email = :email");
    $stmt->execute(array(
      ':password' => $_POST['createpswd'],
      ':email' => $_SESSION['email']  ));
      $_SESSION['passchange'] = 1;
          exit();
 }else{
     $_SESSION['passnomatch'] = "Passwords dont match";
    
          exit(); 
 }
 }

$usrchk = new \stdClass();
$usrchk->success = false;
$usrchk->id = $_SESSION['user_id'];
$usrchk->contract = $_SESSION['contract'];
$usrchk->e = $_SESSION['emailexists'];
$usrchk->sendkey = $_SESSION['sendkey'];
$usrchk->Incorrectkey = $_SESSION['Incorrectkey'];
$usrchk->passchange = $_SESSION['passchange'];


echo (json_encode($usrchk));

 ?>
