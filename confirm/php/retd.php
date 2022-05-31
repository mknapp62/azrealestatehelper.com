<?php
session_start();
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require_once "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

/* UPDATE DEAL BUTTON NOT COMPLETE----------innerjoin */
    if(isset($_POST['update'])){
    
    $dealvars = $pdo->query("SELECT * FROM deal WHERE deal.contract_id = '{$_SESSION['contract_id']}';")->fetch();
       if(!isset($dealvars['deal_id'])){
    
    $deal = "INSERT INTO deal (date, sent, accepted, inspection, insurance,       financing2, complete, user_id, contract_id)
         VALUES (:date, :sent, :accepted, :inspection, :insurance, :financing2, :complete, :user_id, :contract_id)";
         $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmt = $s->prepare($deal);
      $stmt->execute(array(
        ':date' => date("Y-m-d"),
        ':sent' => $_POST["sent"],
        ':accepted' => $_POST["accepted"],
        ':inspection' => $_POST["inspection"],
        ':insurance' => $_POST["insurance"],
        ':financing2' => $_POST["financing"],
        ':complete' => $_POST["complete"],
        ':user_id' => $_SESSION["user_id"],
        ':contract_id' => $_SESSION["contract_id"]));
         
       }else{
    $deal = "UPDATE deal SET date = :date, sent = :sent,  accepted = :accepted, inspection = :inspection, insurance = :insurance, financing2 = :financing2, complete = :complete, user_id = :user_id, contract_id = :contract_id WHERE deal_id = :deal_id;";
       
    
      $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmt = $s->prepare($deal);
      $stmt->execute(array(
        ':date' => date("Y-m-d"),
        ':sent' => $_POST["sent"],
        ':accepted' => $_POST["accepted"],
        ':inspection' => $_POST["inspection"],
        ':insurance' => $_POST["insurance"],
        ':financing2' => $_POST["financing"],
        ':complete' => $_POST["complete"],
        ':user_id' => $_SESSION["user_id"],
        ':contract_id' => $_SESSION["contract_id"],
        ':deal_id' => $dealvars['deal_id']
        ));
        
        }
         
         
        $dealvars = $pdo->query("SELECT * FROM deal WHERE deal.contract_id = '{$_SESSION['contract_id']}';")->fetch();
        $_SESSION['deal_id'] = $dealvars['deal_id'];
        $_SESSION['date'] = $dealvars['date'];
        $_SESSION['sent'] = $dealvars['sent'];
        $_SESSION['accepted'] = $dealvars['accepted'];
        $_SESSION['inspection'] = $dealvars['inspection'];
        $_SESSION['insurance'] = $dealvars['insurance'];
        $_SESSION['financing2'] = $dealvars['financing2'];
        $_SESSION['complete'] = $dealvars['complete'];

        $_SESSION['sent'] == 1 ? $_SESSION['sentcheck'] = ' checked' : $_SESSION['sentcheck'] = '';
        $_SESSION['accepted'] == 1 ? $_SESSION['acceptedcheck'] = ' checked' : $_SESSION['acceptedcheck'] = '';
        $_SESSION['inspection'] == 1 ? $_SESSION['inspectioncheck'] = ' checked' : $_SESSION['inspectioncheck'] = '';
        $_SESSION['insurance'] == 1 ? $_SESSION['insurancecheck'] = ' checked' : $_SESSION['insurancecheck'] = '';
        $_SESSION['financing2'] == 1 ? $_SESSION['financingcheck2'] = ' checked' : $_SESSION['financingcheck2'] = '';
        $_SESSION['complete'] == 1 ? $_SESSION['completecheck'] = ' checked' : $_SESSION['completecheck'] = '';
        
    $pdo->query("UPDATE contract SET deal_id = '{$_SESSION['deal_id']}', sent = '{$_SESSION['sent']}' WHERE contract.contract_id = '{$_SESSION['contract_id']}'")->execute();
    
    $_SESSION['sent'] = $dealvars['sent'];
    $_SESSION['buyerseller'] = 0;
    if($_SESSION['sent'] == 1){
        $contract2 = $pdo->prepare("SELECT * FROM contract WHERE property_id = :xyz;");
  $contract2->execute(array(':xyz' => $_SESSION['property_id']));
  $address2 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                            ON property.property_id = contract.property_id
                            WHERE contract_id = :zxy;");
                            
                            
                            
                            
  $inc = 10; /* 10 because lower contract ids might be set from landing script*/
   
/* sets unlimited contract ids so the user can choose which one to work on */
  while($row = $contract2->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION['disabled' .$inc] = " disabled";
    $_SESSION['sent'] = 1;
    $_SESSION['contract_id' .$inc] = htmlentities($row['contract_id']);
    $_SESSION['createdby'] = $row['createdby'];
     $_SESSION['property_id' .$inc] = $row['property_id'];
    $_SESSION['buyer1' .$inc] = $row['buyer1'];
    $_SESSION['buyer2' .$inc] = $row['buyer2'];
    $_SESSION['seller1' .$inc] = $row['seller1'];
    $_SESSION['seller2' .$inc] = $row['seller2'];
    $_SESSION['purchaseprice' .$inc] = $row['purchaseprice'];
    $_SESSION['earnestmoney' .$inc] = $row['earnestmoney'];
    $_SESSION['additionaldown' .$inc] = $row['additionaldown'];
    $_SESSION['financed' .$inc] = $row['financed'];
    $_SESSION['earnestmoneyform' .$inc] = $row['earnestmoneyform'];
    $_SESSION['earnestmoneyheld' .$inc] = $row['earnestmoneyheld'];
    $_SESSION['coedate' .$inc] = $row['coedate'];
    $_SESSION['buyercontingency' .$inc] = $row['buyercontingency'];
    $_SESSION['waterwell' .$inc] = $row['waterwell'];
    $_SESSION['hoa' .$inc] = $row['hoa'];
    $_SESSION['loanassuption' .$inc] = $row['loanassuption'];
    $_SESSION['onsitewastewater' .$inc] = $row['onsitewastewater'];
    $_SESSION['sellerfinancing' .$inc] = $row['sellerfinancing'];
    $_SESSION['shortsale' .$inc] = $row['shortsale'];
    $_SESSION['other' .$inc] = $row['other'];
    $_SESSION['refrigerator' .$inc] = $row['refrigerator'];
    $_SESSION['washer' .$inc] = $row['washer'];
    $_SESSION['dryer' .$inc] = $row['dryer'];
    $_SESSION['spa' .$inc] = $row['spa'];
    $_SESSION['personalprop' .$inc] = $row['personalprop'];
    $_SESSION['personalprop2' .$inc] = $row['personalprop2'];
    $_SESSION['financing' .$inc] = $row['financing'];
    $_SESSION['leadpaint' .$inc] = $row['leadpaint'];
    $_SESSION['sellerconsessionspercent' .$inc] = $row['sellerconsessionspercent'];
    $_SESSION['sellerconsessionsdollar' .$inc] = $row['sellerconsessionsdollar'];
    $_SESSION['homewarrantyorderedby' .$inc] = $row['homewarrantyorderedby'];
    $_SESSION['homewarrantypaidby' .$inc] = $row['homewarrantypaidby'];
    $_SESSION['homewarrantyamount' .$inc] = $row['homewarrantyamount'];
    $_SESSION['additionalterms' .$inc] = $row['additionalterms'];
    $_SESSION['accepttime' .$inc] = $row['accepttime'];
    $_SESSION['selleragentid' .$inc] = $row['selleragentid'];
    $_SESSION['accepttimedate' .$inc] = date_create($_SESSION['accepttime' .$inc]);
    if($_SESSION['selleragentid' .$inc] == ""){
      unset($_SESSION['agentname' .$inc]);
      unset($_SESSION['selleragentid' .$inc]);
      unset($_SESSION['agentlicense' .$inc]);
      unset($_SESSION['agentname2' .$inc]);
      unset($_SESSION['agentlicense2' .$inc]);
      unset($_SESSION['firmname' .$inc]);
      unset($_SESSION['firmaddress' .$inc]);
      unset($_SESSION['firmlicense' .$inc]);
      unset($_SESSION['firmphone' .$inc]);
      unset($_SESSION['agentemail' .$inc]);
      unset($_SESSION['selleragentid' .$inc]);
    }
   
    $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
    
    if($_SESSION['buyercontingency' .$inc] == "1"){
      $_SESSION['buyercontingencycheck' .$inc] = " checked";
    }else{
      $_SESSION['buyercontingencycheck' .$inc] ="";
    }

    if($_SESSION['waterwell' .$inc] == "1"){
      $_SESSION['waterwellcheck' .$inc] = " checked";
    }else{
      $_SESSION['waterwellcheck' .$inc] ="";
    }

    if($_SESSION['hoa' .$inc] == "1"){
      $_SESSION['hoacheck' .$inc] = " checked";
    }else{
      $_SESSION['hoacheck' .$inc] ="";
    }

    if($_SESSION['loanassuption' .$inc] == "1"){
      $_SESSION['loanassuptioncheck' .$inc] = " checked";
    }else{
      $_SESSION['loanassuptioncheck' .$inc] ="";
    }

    if($_SESSION['sellerfinancing' .$inc] == "1"){
      $_SESSION['sellerfinancingcheck' .$inc] = " checked";
    }else{
      $_SESSION['sellerfinancingcheck' .$inc] ="";
    }

    if($_SESSION['shortsale' .$inc] == "1"){
      $_SESSION['shortsalecheck' .$inc] = " checked";
    }else{
      $_SESSION['shortsalecheck' .$inc] ="";
    }

    if($_SESSION['other' .$inc] == "1"){
      $_SESSION['othercheck' .$inc] = " checked";
    }else{
      $_SESSION['othercheck' .$inc] ="";
    }

    if($_SESSION['refrigerator' .$inc] == "1"){
      $_SESSION['refrigeratorcheck' .$inc] = " checked";
    }else{
      $_SESSION['refrigeratorcheck' .$inc] ="";
    }

    if($_SESSION['washer' .$inc] == "1"){
      $_SESSION['washercheck' .$inc] = " checked";
    }else{
      $_SESSION['washercheck' .$inc] ="";
    }

    if($_SESSION['dryer' .$inc] == "1"){
      $_SESSION['dryercheck' .$inc] = " checked";
    }else{
      $_SESSION['dryercheck' .$inc] ="";
    }

    if($_SESSION['spa' .$inc] == "1"){
      $_SESSION['spacheck' .$inc] = " checked";
    }else{
      $_SESSION['spacheck' .$inc] ="";
    }

    $_SESSION['cash' .$inc] = "";
    $_SESSION['conventional' .$inc] = "";
    $_SESSION['fha' .$inc] = "";
    $_SESSION['va' .$inc] = "";
    $_SESSION['usda' .$inc] = "";
    $_SESSION['assumption' .$inc] = "";
    $_SESSION['sellercarryback' .$inc] = "";

    switch ($_SESSION['financing' .$inc]) {
      case "Cash":
        $_SESSION['cash' .$inc] = "checked";
        break;
      case "Conventional":
        $_SESSION['conventional' .$inc] = "checked";
        break;
      case "FHA":
        $_SESSION['fha' .$inc] = "checked";
        break;
      case "VA":
        $_SESSION['va' .$inc] = "checked";
        break;
      case "USDA":
        $_SESSION['usda' .$inc] = "checked";
        break;
      case "Assumption":
        $_SESSION['assumption' .$inc] = "checked";
        break;
      case "Seller Carryback":
        $_SESSION['sellercarryback' .$inc] = "checked";
        break;
    }
    
    $_SESSION['earnestmoneyformcheck' .$inc] = "";
    $_SESSION['earnestmoneyformwire' .$inc] = "";
    $_SESSION['earnestmoneyheldbroker' .$inc] = "";
    $_SESSION['earnestmoneyheldescrow' .$inc] = "";
    $_SESSION['sewercheck' .$inc] = "";
    $_SESSION['septiccheck' .$inc] = "";
    
    switch ($_SESSION['onsitewastewater' .$inc]){
        case "0":
            $_SESSION['sewercheck' .$inc] = " checked";
            break;
        case "1":
            $_SESSION['septiccheck' .$inc] = " checked";
            break;
    }
        switch ($_SESSION['earnestmoneyform' .$inc]){
          case "Wire":
            $_SESSION['earnestmoneyformwire' .$inc] = " checked";
            break;
          case "Check":
            $_SESSION['earnestmoneyformcheck' .$inc] = " checked";
        }
        
        switch ($_SESSION['earnestmoneyheld' .$inc]){
            case "Broker":
                $_SESSION['earnestmoneyheldbroker' .$inc] = " checked";
                break;
            case "Escrow":
                $_SESSION['earnestmoneyheldescrow' .$inc] = " checked";
                break;
        }

    if($_SESSION['homewarrantyorderedby' .$inc] == "Buyer"){
      $_SESSION['homewarrantyorderedbybuyercheck' .$inc] = " checked";
    }else{
      $_SESSION['homewarrantyorderedbybuyercheck' .$inc] ="";
    }

    if($_SESSION['homewarrantyorderedby' .$inc] == "Seller"){
      $_SESSION['homewarrantyorderedbysellercheck' .$inc] = " checked";
    }else{
      $_SESSION['homewarrantyorderedbysellercheck' .$inc] ="";
    }

    if($_SESSION['homewarrantypaidby' .$inc] == "Buyer"){
      $_SESSION['homewarrantypaidbybuyercheck' .$inc] = " checked";
    }else{
      $_SESSION['homewarrantypaidbybuyercheck' .$inc] ="";
    }

    if($_SESSION['homewarrantypaidby' .$inc] == "Seller"){
      $_SESSION['homewarrantypaidbysellercheck' .$inc] = " checked";
    }else{
      $_SESSION['homewarrantypaidbysellercheck' .$inc] ="";
    }

    if($_SESSION['selleragentid'] != 'NULL'){
        $agent = $pdo->query("SELECT * FROM agent
                          INNER JOIN contract ON agent.agentid=contract.selleragentid
                          WHERE agent.agentid='{$_SESSION['selleragentid']}';")->fetch();
    /* $name use this is for any other session var  INNERJOIN-----------------------*/
    $_SESSION['agentname' .$inc] = $agent['agentname'];
    $_SESSION['agentlicense' .$inc] = $agent['agentlicense'];
    $_SESSION['agentname2' .$inc] = $agent['agentname2'];
    $_SESSION['agentlicense2' .$inc] = $agent['agentlicense2'];
    $_SESSION['firmname' .$inc] = $agent['firmname'];
    $_SESSION['firmaddress' .$inc] = $agent['firmaddress'];
    $_SESSION['firmlicense' .$inc] = $agent['firmlicense'];
    $_SESSION['firmphone' .$inc] = $agent['firmphone'];
    $_SESSION['agentemail' .$inc] = $agent['agentemail'];

    $_SESSION['agentbutton' .$inc] = "show";
    $_SESSION['agentmessage' .$inc] = "Have An Agent";
    $_SESSION['agentdisabled' .$inc] = "";



        
        }else{
          $_SESSION['selleragentid' .$inc] = NULL;
          $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
          $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
          $stmtselleragent = $s->prepare($sqlselleragent);
          $stmtselleragent->execute(array(
          ':selleragentid' => $_SESSION['selleragentid'],
          ':contract_id' => $_SESSION['contract_id']));
        $_SESSION['agentmessage' .$inc] = "NOT Have An Agent";
        $_SESSION['agentdisabled' .$inc] ="disabled";
        $_SESSION['agentbutton' .$inc] = "";
        }




    $name = $pdo->query("SELECT * FROM property
                        INNER JOIN contract ON property.property_id=contract.property_id
                        WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();


    /* $name use this is for any other session var */
    $_SESSION['seller1' .$inc] = $name['owner1'];
    $_SESSION['seller2' .$inc] = $name['owner2'];
    $_SESSION['address' .$inc] = $name['address'];
    $_SESSION['city' .$inc] = $name['city'];
    $_SESSION['county' .$inc] = $name['county'];
    $_SESSION['zip' .$inc] = $name['zip'];
    $_SESSION['assessornum' .$inc] = $name['assessornum'];
    $_SESSION['legaldisc' .$inc] = $name['legaldisc'];
    $_SESSION['yearbuilt' .$inc] = $name['yearbuilt'];
    $_SESSION['sewer' .$inc] = $name['sewer'];
    $inc++;
    $_SESSION['inc']++;
  }
        header("Location: http://response.azrealestatehelper.com", 302);
    exit();
    }else{
    
    
  header("Location: http://confirm.azrealestatehelper.com", 302);
    exit();}
}


if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}



/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["reload"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];

  $contract2 = $pdo->prepare("SELECT property_id, ANY_VALUE(contract_id) AS contract_id FROM contract WHERE buyer_id = :xyz GROUP BY property_id");
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



/* USER LOGIN----------------------------------------------------------------*/
if(isset($_POST['email']) && ($_POST['pswd'])) {
    $passQ = 'SELECT user1 FROM buyer
              WHERE email = :em AND password = :pw';
    $stmt = $pdo->prepare($passQ);
    $stmt->execute(array(
      ':em' => $_POST['email'],
      ':pw' => $_POST['pswd']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $IncorrectPass = "Wrong Password";
    
    if ($row === FALSE) {
      print_r($IncorrectPass);
    } else {
      session_unset();

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
      $_SESSION['buyer_id'] = $name['user_id'];

      $contract2 = $pdo->prepare("SELECT * FROM contract WHERE buyer_id = :xyz;");
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
  
    header("Location: http://confirm.azrealestatehelper.com", 302);

      exit();
}}

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      }


/* SAVE CHANGES BUTTON ON CONFIRM PAGE */



/* set contract_id main var to selected address through button on landing page */





/* UPDATE exsisting PROPERTY DATA from SAVED CHANGES BUTTON */


/* Just to get seller1 data */
if(isset($_GET["seller1"]) && isset($_POST['savechanges'])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
/* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"]) && $_GET["seller1"] ==
$name['owner1']){
    
    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   
   (new SqlUpadates())->UpdateProperty1();
   
    
    /*THIS WAS THE BREAK LINE----------------------------------*/
    $nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"]) &&  $nameproperty['property_id'] == $_SESSION['property_id'] ){
      $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   
   (new SqlUpadates())->UpdateContract();
    }
        require_once "pass.php";

  /* Update  purchase "Contract deal information page"
  ---------------------------------------------$nameproperty['property_id'] == $_SESSION['property_id'] ){  need to alter this statement it doesn't retur-----------------------*/

  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])){$nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"]) &&  $nameproperty['property_id'] == $_SESSION['property_id'] ){
      
            $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   (new SqlUpadates())->UpdateContract();
      
  }
  
  
  /* SENDING CONTRACT TO OWNER/AGENT THIS WILL MARK AS SENT AND RELOCATE TO RESPONSE PAGE  */
     if(isset($_GET['sendcontract'])){
         $contract2 = $pdo->prepare("UPDATE contract SET sent = 1 WHERE contract_id = :xyz;");
  $contract2->execute(array(':xyz' => $_SESSION["contract_id"]));
  
  $_SESSION['agentemail'] == null ? $to = $_GET['selleremail'] : $to = $_SESSION['agentemail'];
  
        $subject = "Home Offer";
        $txt = "Hello, you have recieved an offer to purchase your home!";
        $headers = "From: offer@azrealestatehelper.com";
    mail($to,$subject,$txt,$headers);
  
  header("Location: https://response.azrealestatehelper.com", 302);
    exit();
}





 ?>
