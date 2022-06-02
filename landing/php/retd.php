<?php
session_start();
if(session_status() != 2){
     session_unset();<?php
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
$contract3 = $pdo->prepare("SELECT ANY_VALUE(buyer1), ANY_VALUE(contract_id) AS contract_id FROM contract WHERE seller_id = :xyz GROUP BY buyer_id;");
      $contract3->execute(array(':xyz' => $_SESSION['buyer_id']));
      
      $address3 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                                ON property.property_id = contract.property_id
                                WHERE contract_id = :zxy;");
                                
      $inc = 0;
       while($row = $contract3->fetch(PDO::FETCH_ASSOC)) {


        $_SESSION['contract_id0' .$inc] = htmlentities($row['contract_id']);
        $inc++;

      }
      $inc2 = 0;
      $inc3 = 1;
      
      
      $address3->execute(array(':zxy' => $_SESSION['contract_id0' .$inc2]));
      
        while($row2 = $address3->fetch(PDO::FETCH_ASSOC)){

        $_SESSION['addresslist0' .$inc2] = htmlentities($row2['address']);
        $_SESSION['buyer10' .$inc2] = htmlentities($row2['owner1']);

        $address3->execute(array(':zxy' => $_SESSION['contract_id' .$inc3]));

        $inc2++;
        $inc3++;
      }

       
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
   


    $contract = $pdo->query("SELECT * FROM contract WHERE contract_id='{$_SESSION['contract_id']}';")->fetch();
   
    $_SESSION['sent'] = $contract['sent'];
    $_SESSION['property_id'] = $contract['property_id'];
    $_SESSION['buyer1'] = $contract['buyer1'];
    $_SESSION['buyer2'] = $contract['buyer2'];
    $_SESSION['purchaseprice'] = $contract['purchaseprice'];
    $_SESSION['earnestmoney'] = $contract['earnestmoney'];
    $_SESSION['additionaldown'] = $contract['additionaldown'];
    $_SESSION['financed'] = $contract['financed'];
    $_SESSION['earnestmoneyform'] = $contract['earnestmoneyform'];
    $_SESSION['earnestmoneyheld'] = $contract['earnestmoneyheld'];
    $_SESSION['coedate'] = $contract['coedate'];
    $_SESSION['buyercontingency'] = $contract['buyercontingency'];
    $_SESSION['waterwell'] = $contract['waterwell'];
    $_SESSION['hoa'] = $contract['hoa'];
    $_SESSION['loanassuption'] = $contract['loanassuption'];
    $_SESSION['onsitewastewater'] = $contract['onsitewastewater'];
    $_SESSION['sellerfinancing'] = $contract['sellerfinancing'];
    $_SESSION['shortsale'] = $contract['shortsale'];
    $_SESSION['other'] = $contract['other'];
    $_SESSION['leadpaint'] = ($contract['leadpaint'] == 0) ? '' : 'X';
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
    $_SESSION['selleragentid'] = $contract['selleragentid'];
    
        
    $binsrvars = $pdo->query("SELECT * FROM contract WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1;")->fetch();   
    
    
            $_SESSION['binsr0'] = $binsrvars['binsr0'];
            $_SESSION['binsr1'] = $binsrvars['binsr1'];
            $_SESSION['binsr2'] = $binsrvars['binsr2'];
            $_SESSION['binsr3'] = $binsrvars['binsr3'];
            $_SESSION['binsr4'] = $binsrvars['binsr4'];
            $_SESSION['binsr5'] = $binsrvars['binsr5'];
            $_SESSION['binsr6'] = $binsrvars['binsr6'];
            $_SESSION['binsr7'] = $binsrvars['binsr7'];
            $_SESSION['binsr8'] = $binsrvars['binsr8'];
            $_SESSION['binsr9'] = $binsrvars['binsr9'];
    /*FIND OUT IF SELLER TOUCHED IT AND SENT A COUNTER  */
    $whowaslast =   $pdo->query("SELECT createdby, sent
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY contract_id DESC
            LIMIT 1;")->fetch();
    $_SESSION['createdby'] = $whowaslast['createdby'];  
    $_SESSION['sent'] = $whowaslast['sent'];
    
    $_POST["saved"] == '' ? $_SESSION['buyerseller'] = 1 : $_SESSION['buyerseller'] = 0;
    /* who is logged in, who created the last contract, was it sent:  buyer:0 seller:1 sent:bool */
    $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
    
    if(in_array($_SESSION['userview'], ['110', '000'], true)){
                $_SESSION['counter'] = 1;
                }else{$_SESSION['counter'] = "";}

    if($_SESSION['selleragentid'] == ""){
      unset($_SESSION['agentname']);
      unset($_SESSION['selleragentid']);
      unset($_SESSION['agentlicense']);
      unset($_SESSION['agentname2']);
      unset($_SESSION['agentlicense2']);
      unset($_SESSION['firmname']);
      unset($_SESSION['firmaddress']);
      unset($_SESSION['firmlicense']);
      unset($_SESSION['firmphone']);
      unset($_SESSION['agentemail']);
      unset($_SESSION['selleragentid']);
    }

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

    $_SESSION['earnestmoneyformcheck'] = "";
    $_SESSION['earnestmoneyformwire'] = "";
    $_SESSION['earnestmoneyheldbroker'] = "";
    $_SESSION['earnestmoneyheldescrow'] = "";
    $_SESSION['sewercheck'] = "";
    $_SESSION['septiccheck'] = "";
    
    switch ($_SESSION['onsitewastewater']){
        case "0":
            $_SESSION['sewercheck'] = " checked";
            break;
        case "1":
            $_SESSION['septiccheck'] = " checked";
            break;
    }
    
        switch ($_SESSION['earnestmoneyform']){
          case "Wire":
            $_SESSION['earnestmoneyformwire'] = " checked";
            break;
          case "Check":
            $_SESSION['earnestmoneyformcheck'] = " checked";
        }
        
        switch ($_SESSION['earnestmoneyheld']){
            case "Broker":
                $_SESSION['earnestmoneyheldbroker'] = " checked";
                break;
            case "Escrow":
                $_SESSION['earnestmoneyheldescrow'] = " checked";
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
    
    
    $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch();

        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch();
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
        
    $deal_id =  $pdo->prepare("UPDATE contract SET deal_id = '{$_SESSION['deal_id']}' WHERE contract_id = '{$_SESSION['contract_id']}'")->execute();

if(isset($_SESSION['selleragentid'])){
    $agent = $pdo->query("SELECT * FROM agent
                          INNER JOIN contract ON agent.agentid=contract.selleragentid
                          WHERE agent.agentid='{$_SESSION['selleragentid']}';")->fetch();
    /* $name use this is for any other session var  INNERJOIN-----------------------*/
    $_SESSION['agentname'] = $agent['agentname'];
    $_SESSION['agentlicense'] = $agent['agentlicense'];
    $_SESSION['agentname2'] = $agent['agentname2'];
    $_SESSION['agentlicense2'] = $agent['agentlicense2'];
    $_SESSION['firmname'] = $agent['firmname'];
    $_SESSION['firmaddress'] = $agent['firmaddress'];
    $_SESSION['firmlicense'] = $agent['firmlicense'];
    $_SESSION['firmphone'] = $agent['firmphone'];
    $_SESSION['agentemail'] = $agent['agentemail'];

    $_SESSION['agentbutton'] = "show";
    $_SESSION['agentmessage'] = "Have An Agent";
    $_SESSION['agentdisabled'] = "";

        $name = $pdo->query("SELECT * FROM property
                        INNER JOIN contract ON property.property_id=contract.property_id
                        WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();


    /* $name use this is for any other session var */
    $_SESSION['seller1'] = $name['owner1'];
    $_SESSION['seller2'] = $name['owner2'];
    $_SESSION['address'] = $name['address'];
    $_SESSION['city'] = $name['city'];
    $_SESSION['county'] = $name['county'];
    $_SESSION['zip'] = $name['zip'];
    $_SESSION['assessornum'] = $name['assessornum'];
    $_SESSION['legaldisc'] = $name['legaldisc'];
    $_SESSION['yearbuilt'] = $name['yearbuilt'];
    $_SESSION['sewer'] = $name['sewer'];
 $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 
    if($_SESSION['sent'] == 1){
        header("Location: https://www.response.azrealestatehelper.com", 302);
    exit(); 
    }else{
        header("Location: https://www.confirm.azrealestatehelper.com", 302);
    exit(); 
    }

    
    }else{
      $_SESSION['selleragentid'] = NULL;
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
      $stmtselleragent = $s->prepare($sqlselleragent);
      $stmtselleragent->execute(array(
      ':selleragentid' => $_SESSION['selleragentid'],
      ':contract_id' => $_SESSION['contract_id']));
    $_SESSION['agentmessage'] = "NOT Have An Agent";
    $_SESSION['agentdisabled'] ="disabled";
    $_SESSION['agentbutton'] = "";
    }

    $name = $pdo->query("SELECT * FROM property
                        INNER JOIN contract ON property.property_id=contract.property_id
                        WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();


    /* $name use this is for any other session var */
    $_SESSION['seller1'] = $name['owner1'];
    $_SESSION['seller2'] = $name['owner2'];
    $_SESSION['address'] = $name['address'];
    $_SESSION['city'] = $name['city'];
    $_SESSION['county'] = $name['county'];
    $_SESSION['zip'] = $name['zip'];
    $_SESSION['assessornum'] = $name['assessornum'];
    $_SESSION['legaldisc'] = $name['legaldisc'];
    $_SESSION['yearbuilt'] = $name['yearbuilt'];
    $_SESSION['sewer'] = $name['sewer'];
    
   
    /*THIS WILL TAKE THE BUYER TO TO RESPONSE PAGE IF SELLER CREATED COUNTER OFFER */

    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 

     if($_SESSION['sent'] == 1){
        header("Location: https://www.response.azrealestatehelper.com", 302);
    exit(); 
    }else{
        header("Location: https://www.confirm.azrealestatehelper.com", 302);
    exit(); 
    }
   
  }



/* UPDATE exsisting PROPERTY DATA */


/* NEW PROPERTY DATA */



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
$contract3 = $pdo->prepare("SELECT ANY_VALUE(buyer1), ANY_VALUE(contract_id) AS contract_id FROM contract WHERE seller_id = :xyz GROUP BY buyer_id;");
      $contract3->execute(array(':xyz' => $_SESSION['buyer_id']));
      
      $address3 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                                ON property.property_id = contract.property_id
                                WHERE contract_id = :zxy;");
                                
      $inc = 0;
       while($row = $contract3->fetch(PDO::FETCH_ASSOC)) {


        $_SESSION['contract_id0' .$inc] = htmlentities($row['contract_id']);
        $inc++;

      }
      $inc2 = 0;
      $inc3 = 1;
      
      
      $address3->execute(array(':zxy' => $_SESSION['contract_id0' .$inc2]));
      
        while($row2 = $address3->fetch(PDO::FETCH_ASSOC)){

        $_SESSION['addresslist0' .$inc2] = htmlentities($row2['address']);
        $_SESSION['buyer10' .$inc2] = htmlentities($row2['owner1']);

        $address3->execute(array(':zxy' => $_SESSION['contract_id' .$inc3]));

        $inc2++;
        $inc3++;
      }

       
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

    $contract = $pdo->query("SELECT * FROM contract WHERE contract_id='{$_SESSION['contract_id']}';")->fetch();
   
    $_SESSION['sent'] = $contract['sent'];
    $_SESSION['property_id'] = $contract['property_id'];
    $_SESSION['buyer1'] = $contract['buyer1'];
    $_SESSION['buyer2'] = $contract['buyer2'];
    $_SESSION['purchaseprice'] = $contract['purchaseprice'];
    $_SESSION['earnestmoney'] = $contract['earnestmoney'];
    $_SESSION['additionaldown'] = $contract['additionaldown'];
    $_SESSION['financed'] = $contract['financed'];
    $_SESSION['earnestmoneyform'] = $contract['earnestmoneyform'];
    $_SESSION['earnestmoneyheld'] = $contract['earnestmoneyheld'];
    $_SESSION['coedate'] = $contract['coedate'];
    $_SESSION['buyercontingency'] = $contract['buyercontingency'];
    $_SESSION['waterwell'] = $contract['waterwell'];
    $_SESSION['hoa'] = $contract['hoa'];
    $_SESSION['loanassuption'] = $contract['loanassuption'];
    $_SESSION['onsitewastewater'] = $contract['onsitewastewater'];
    $_SESSION['sellerfinancing'] = $contract['sellerfinancing'];
    $_SESSION['shortsale'] = $contract['shortsale'];
    $_SESSION['other'] = $contract['other'];
    $_SESSION['leadpaint'] = ($contract['leadpaint'] == 0) ? '' : 'X';
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
    $_SESSION['selleragentid'] = $contract['selleragentid'];
    
        
    $binsrvars = $pdo->query("SELECT * FROM contract WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1;")->fetch();   
    
    
            $_SESSION['binsr0'] = $binsrvars['binsr0'];
            $_SESSION['binsr1'] = $binsrvars['binsr1'];
            $_SESSION['binsr2'] = $binsrvars['binsr2'];
            $_SESSION['binsr3'] = $binsrvars['binsr3'];
            $_SESSION['binsr4'] = $binsrvars['binsr4'];
            $_SESSION['binsr5'] = $binsrvars['binsr5'];
            $_SESSION['binsr6'] = $binsrvars['binsr6'];
            $_SESSION['binsr7'] = $binsrvars['binsr7'];
            $_SESSION['binsr8'] = $binsrvars['binsr8'];
            $_SESSION['binsr9'] = $binsrvars['binsr9'];
    /*FIND OUT IF SELLER TOUCHED IT AND SENT A COUNTER  */
    $whowaslast =   $pdo->query("SELECT createdby, sent
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY contract_id DESC
            LIMIT 1;")->fetch();
    $_SESSION['createdby'] = $whowaslast['createdby'];  
    $_SESSION['sent'] = $whowaslast['sent'];
    
    $_POST["saved"] == '' ? $_SESSION['buyerseller'] = 1 : $_SESSION['buyerseller'] = 0;
    /* who is logged in, who created the last contract, was it sent:  buyer:0 seller:1 sent:bool */
    $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
    
    if(in_array($_SESSION['userview'], ['110', '000'], true)){
                $_SESSION['counter'] = 1;
                }else{$_SESSION['counter'] = "";}

    if($_SESSION['selleragentid'] == ""){
      unset($_SESSION['agentname']);
      unset($_SESSION['selleragentid']);
      unset($_SESSION['agentlicense']);
      unset($_SESSION['agentname2']);
      unset($_SESSION['agentlicense2']);
      unset($_SESSION['firmname']);
      unset($_SESSION['firmaddress']);
      unset($_SESSION['firmlicense']);
      unset($_SESSION['firmphone']);
      unset($_SESSION['agentemail']);
      unset($_SESSION['selleragentid']);
    }

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

    $_SESSION['earnestmoneyformcheck'] = "";
    $_SESSION['earnestmoneyformwire'] = "";
    $_SESSION['earnestmoneyheldbroker'] = "";
    $_SESSION['earnestmoneyheldescrow'] = "";
    $_SESSION['sewercheck'] = "";
    $_SESSION['septiccheck'] = "";
    
    switch ($_SESSION['onsitewastewater']){
        case "0":
            $_SESSION['sewercheck'] = " checked";
            break;
        case "1":
            $_SESSION['septiccheck'] = " checked";
            break;
    }
    
        switch ($_SESSION['earnestmoneyform']){
          case "Wire":
            $_SESSION['earnestmoneyformwire'] = " checked";
            break;
          case "Check":
            $_SESSION['earnestmoneyformcheck'] = " checked";
        }
        
        switch ($_SESSION['earnestmoneyheld']){
            case "Broker":
                $_SESSION['earnestmoneyheldbroker'] = " checked";
                break;
            case "Escrow":
                $_SESSION['earnestmoneyheldescrow'] = " checked";
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
    
    
    $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch();

        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch();
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
        
    $deal_id =  $pdo->prepare("UPDATE contract SET deal_id = '{$_SESSION['deal_id']}' WHERE contract_id = '{$_SESSION['contract_id']}'")->execute();

if(isset($_SESSION['selleragentid'])){
    $agent = $pdo->query("SELECT * FROM agent
                          INNER JOIN contract ON agent.agentid=contract.selleragentid
                          WHERE agent.agentid='{$_SESSION['selleragentid']}';")->fetch();
    /* $name use this is for any other session var  INNERJOIN-----------------------*/
    $_SESSION['agentname'] = $agent['agentname'];
    $_SESSION['agentlicense'] = $agent['agentlicense'];
    $_SESSION['agentname2'] = $agent['agentname2'];
    $_SESSION['agentlicense2'] = $agent['agentlicense2'];
    $_SESSION['firmname'] = $agent['firmname'];
    $_SESSION['firmaddress'] = $agent['firmaddress'];
    $_SESSION['firmlicense'] = $agent['firmlicense'];
    $_SESSION['firmphone'] = $agent['firmphone'];
    $_SESSION['agentemail'] = $agent['agentemail'];

    $_SESSION['agentbutton'] = "show";
    $_SESSION['agentmessage'] = "Have An Agent";
    $_SESSION['agentdisabled'] = "";

        $name = $pdo->query("SELECT * FROM property
                        INNER JOIN contract ON property.property_id=contract.property_id
                        WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();


    /* $name use this is for any other session var */
    $_SESSION['seller1'] = $name['owner1'];
    $_SESSION['seller2'] = $name['owner2'];
    $_SESSION['address'] = $name['address'];
    $_SESSION['city'] = $name['city'];
    $_SESSION['county'] = $name['county'];
    $_SESSION['zip'] = $name['zip'];
    $_SESSION['assessornum'] = $name['assessornum'];
    $_SESSION['legaldisc'] = $name['legaldisc'];
    $_SESSION['yearbuilt'] = $name['yearbuilt'];
    $_SESSION['sewer'] = $name['sewer'];
 $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 
    if($_SESSION['sent'] == 1){
        header("Location: https://www.response.azrealestatehelper.com", 302);
    exit(); 
    }else{
        header("Location: https://www.confirm.azrealestatehelper.com", 302);
    exit(); 
    }

    
    }else{
      $_SESSION['selleragentid'] = NULL;
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
      $stmtselleragent = $s->prepare($sqlselleragent);
      $stmtselleragent->execute(array(
      ':selleragentid' => $_SESSION['selleragentid'],
      ':contract_id' => $_SESSION['contract_id']));
    $_SESSION['agentmessage'] = "NOT Have An Agent";
    $_SESSION['agentdisabled'] ="disabled";
    $_SESSION['agentbutton'] = "";
    }

    $name = $pdo->query("SELECT * FROM property
                        INNER JOIN contract ON property.property_id=contract.property_id
                        WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();


    /* $name use this is for any other session var */
    $_SESSION['seller1'] = $name['owner1'];
    $_SESSION['seller2'] = $name['owner2'];
    $_SESSION['address'] = $name['address'];
    $_SESSION['city'] = $name['city'];
    $_SESSION['county'] = $name['county'];
    $_SESSION['zip'] = $name['zip'];
    $_SESSION['assessornum'] = $name['assessornum'];
    $_SESSION['legaldisc'] = $name['legaldisc'];
    $_SESSION['yearbuilt'] = $name['yearbuilt'];
    $_SESSION['sewer'] = $name['sewer'];
    
    
    /*THIS WILL TAKE THE BUYER TO TO RESPONSE PAGE IF SELLER CREATED COUNTER OFFER */

    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 
  
     if($_SESSION['sent'] == 1){
        header("Location: https://www.response.azrealestatehelper.com", 302);
    exit(); 
    }else{
        header("Location: https://www.confirm.azrealestatehelper.com", 302);
    exit(); 
    }
   
  }



/* UPDATE exsisting PROPERTY DATA */


/* NEW PROPERTY DATA */



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
