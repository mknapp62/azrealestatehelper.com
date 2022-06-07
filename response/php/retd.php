<?php
session_start();
if(empty($_SESSION['user_id'])){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}<?php
session_start();
if(empty($_SESSION['user_id'])){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*FILE UPLOAD FUNCTIONS*/
     
    $filename = $_POST['filetype'].$_FILES['file']['name'];
    $filename1 = $_FILES['userfile']['name'];

    $dirname = "upload/".$_SESSION['contract_id'];
    if(!is_dir($dirname)){
        mkdir($dirname);
    }
    $location = $dirname."/".$filename;
    
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
  if(isset($_POST['filetype'])){
      $_SESSION['buyerseller'] == 0 ? $_SESSION['sellerbuyer'] = "Buyer" : $_SESSION['sellerbuyer'] = "Seller";
       $contractfiles = "INSERT INTO files (user_id, contract_id, submittedby, filename, filepath, submitteddate, filetype, signedby)
         VALUES (:user_id, :contract_id, :submittedby, :filename, :filepath, :submitteddate, :filetype, :signedby);";
      $stmtcontractfiles = $pdo->prepare($contractfiles);
      $stmtcontractfiles->execute(array(
        ':user_id' => $_SESSION['user_id'],
        ':contract_id' => $_SESSION['contract_id'],
        ':submittedby' => $_SESSION['sellerbuyer'],
        ':filename' => $filename,
        ':filepath' => $location,
        ':submitteddate' => $_POST['filedate'],
        ':filetype' => $_POST['filetype'],
        ':signedby' => $_POST['signedby']));
        echo $filename;
        echo $location;
        echo "insert into script ran!";
           $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
 (new FileData())->FileDataResponse();
  }
  
  


/*BINSR BUTTONS FOR CONTRACT INSPECTION SECTION*/
if(isset($_POST["acceptbinsr"])) {
    $pdo->prepare("UPDATE contract SET binsraccepted = 1 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1")->execute();
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}

if(isset($_POST["sendbinsr"])) {
      $binsrupdate = ("UPDATE contract SET binsr0 = :binsr0, binsr1 = :binsr1, binsr2 = :binsr2, binsr3 = :binsr3, binsr4 = :binsr4, binsr5 = :binsr5, binsr6 = :binsr6, binsr7 = :binsr7, binsr8 = :binsr8, binsr9 = :binsr9 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1");
      $stmt = $pdo->prepare($binsrupdate);
      $stmt->execute(array(
          ':binsr0' => $_POST["binsr0"],
          ':binsr1' => $_POST["binsr1"],
          ':binsr2' => $_POST["binsr2"],
          ':binsr3' => $_POST["binsr3"],
          ':binsr4' => $_POST["binsr4"],
          ':binsr5' => $_POST["binsr5"],
          ':binsr6' => $_POST["binsr6"],
          ':binsr7' => $_POST["binsr7"],
          ':binsr8' => $_POST["binsr8"],
          ':binsr9' => $_POST["binsr9"]
          ));
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
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();   
}


/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["reload"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];


$c = "/classes.php";
   require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    
  header("Location: http://landing.azrealestatehelper.com");

  exit();
    }


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
        
    $pdo->prepare("UPDATE contract SET contract.deal_id = '{$_SESSION['deal_id']}', contract.sent = '{$_SESSION['sent']}' WHERE contract.contract_id = '{$_SESSION['contract_id']}'")->execute();
    
   
    
  header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}


if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}


/* COUNTER BUTTON  */
if(isset($_POST['counter'])){
    /* DISPLAYS EDITABLE COUNTER OFFER  */
    if($_SESSION['counter'] == 1 || $_SESSION['counter'] == "counter"){
     unset($_SESSION['counter']);
     $_SESSION['decrementdisable'] = 1;
     $_SESSION['counterbuttontext'] = 'I would like to make a counter offer';
     if($_SESSION['hidecounterdelete'] == 1){
            $pdo->prepare("DELETE FROM contract WHERE property_id='{$_SESSION['property_id']}' ORDER BY contract_id DESC LIMIT 1;")->execute();
         unset($_SESSION['hidecounterdelete']);
         $inc = 10;
         while(isset($_SESSION['contract_id' .$inc])){
             $inc++;
         }
         $inc--;
        unset($_SESSION['contract_id' .$inc]);
        }
            
   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}else{/* HIDES EDITABLE COUNTER OFFER  */
    $_SESSION['counter'] = "counter";
    
    $_SESSION['counterbuttontext'] = 'Cancel Counter Offer';

   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}}


/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();     
        */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["savechanges"]) || isset($_GET['updateproperty'])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];
      $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
  
          if(isset($_GET["seller1"])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
        /* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
        if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"])){
            
            //UPDATE PROPERtY function here

    (new SqlUpadates())->UpdateProperty1();
    
            /*
          $sewer = "";
          function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
          if(test_input($_GET["wastewater"]) == "Sewer"){
              $sewer = 1;
            }else{
              $sewer = 0;
            }
            
            $_SESSION['sewer'] = $_GET["wastewater"];
            
          $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater
                WHERE property_id = :property_id";
          $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
          $stmtupdateproperty = $s->prepare($sqlupdateproperty);
          $stmtupdateproperty->execute(array(
            ':property_id' => $_SESSION["property_id"],
            ':seller1' => $_GET["seller1"],
            ':seller2' => $_GET["seller2"],
            ':address' => $_GET["address"],
            ':city' => $_GET["city"],
            ':county' => $_GET["county"],
            ':zip' => $_GET["zip"],
            ':assessornum' => $_GET["assessornum"],
            ':legaldisc' => $_GET["legaldisc"],
            ':yearbuilt' => $_GET["yearbuilt"],
            ':wastewater' => $sewer));
            */
        }
          
          if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])){$nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
/* TOOK THIS OUT OF BELOW IT WASNT' CREATING NEW CONTRACT  && $_SESSION['property_id'] != $nameproperty['property_id']*/
  if(isset($_GET["purchaseprice"])) {
      
      //UPDATE CONTRACT  POSSIBLE
    //  $c = "/classes.php";
  // require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new SqlUpadates())->updateContract();
      /*
      $leadpaint = "";
      if($_SESSION['yearbuilt'] < 1978){
        $leadpaint = 1;
      } else {
        $leadpaint = 0;
      }

      $sewer = "";
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

      $sqlcontract = "INSERT INTO contract (property_id, buyer_id, buyer1, buyer2, seller1, seller2, purchaseprice, earnestmoney, financed, additionaldown, earnestmoneyform, earnestmoneyheld, coedate, buyercontingency, waterwell, hoa, leadpaint, loanassuption, onsitewastewater, sellerfinancing, shortsale, other, refrigerator, washer, dryer, spa, personalprop, personalprop2, financing, sellerconsessionsdollar, homewarrantyorderedby, homewarrantypaidby, homewarrantyamount, additionalterms, accepttime)
              VALUES (:property_id, :buyer_id, :buyer1, :buyer2, :seller1, :seller2, :purchaseprice, :earnestmoney, :financed, :additionaldown, :earnestmoneyform, :earnestmoneyheld, :coedate, :buyercontingency, :waterwell, :hoa, :leadpaint, :loanassuption, :onsitewastewater, :sellerfinancing, :shortsale, :other, :refrigerator, :washer, :dryer, :spa, :personalprop, :personalprop2, :financing, :sellerconsessionsdollar, :homewarrantyorderedby, :homewarrantypaidby, :homewarrantyamount, :additionalterms, :accepttime)";
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* should be tieing foreign key contract and property
        ':buyer_id' => $_SESSION['buyer_id'],
        ':buyer1' => $_GET["buyer1"],
        ':buyer2' => $_GET["buyer2"],
        ':seller1' => $_GET['seller1'],
        ':seller2' => $_GET['seller2'],
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
        ));}
        */
  }
  //  $c = "/classes.php";
 //  require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
  (new LoadContracts())->loadresponsecontracts(); 
  
  
  header("Location: https://response.azrealestatehelper.com");

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
   
   //$_SESSION['IncorrectPass'] = '';
    if ($row == FALSE) {
       $_SESSION['pleasesignin'] = 1;
     $_SESSION['IncorrectPass'] = "Incorrect Password or Email";
     header("Location: http://response.azrealestatehelper.com", 302);
  exit();
    } else {
     

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
     
      $_SESSION['email'] = $name['Email'];
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    (new FileData())->FileDataResponse();
    $_SESSION['pleasesignin'] = 0;
     $contract = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_SESSION['contract_id']}';")->fetch();  //}took out added 385
    if($_SESSION['user_id'] != $contract['buyer_id']){
        /*NEED TO CREATE KEY ONLY SELLER CAN ACCESS ONCE TO ASSIGN SELF TO CONTRACT AND NOT HAVE BUYER BE ABLE TO*/
        $_SESSION['buyerseller'] = 1;
        $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
     
      $stmtsetsellerid = $s->prepare($setsellerid);
      $stmtsetsellerid->execute(array(
        ':seller_id' => $_SESSION['user_id'],
        ':property_id' => $_SESSION['property_id']));}else{$_SESSION['buyerseller'] = 0;}
header("Location: http://response.azrealestatehelper.com", 302);
      exit();
}}

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      exit();
      }
      
/*CREATE NEW USER */ 
  if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ 
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
              $_SESSION['buyerseller'] = 1;
                 $_SESSION['email'] = $name['Email'];
                 $_SESSION['emailexists'] = 0;
                  $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
                unset($_SESSION['pleasesignin']);
                exit();
          }  
    }else{
     $_SESSION['passnomatch1'] = "Passwords don't match";
     
   
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
      $_SESSION['Incorrectkey'] = '';
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
      $_SESSION['email'] = $name['Email'];
      $_SESSION['buyerseller'] = 0;
          $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
               
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
       require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
       
        (new LoadLanding())->LoadContracts();
       // header("Location: http://www.landing.azrealestatehelper.com");
    $_SESSION['Incorrectkey'] = 1;
         
    }else{
        $_SESSION['Incorrectkey'] = $_POST['key'];
}}

/*RESET PASSWORD AND HIDE MODAL*/

 if(isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ if($_POST["createpswd"] == $_POST["createpswd2"]) {
      $stmt = $pdo->prepare("UPDATE buyer SET password = :password WHERE email = :email");
    $stmt->execute(array(
      ':password' => $_POST['createpswd'],
      ':email' => $_SESSION['email']  ));
      unset($_SESSION['pleasesignin']);
 }else{
     $_SESSION['passnomatch'] = "Passwords dont match";
    
 }
 }

/* SAVE CHANGES BUTTON ON CONFIRM PAGE need to loop through for all files same with JS each function*/

$usrid = new \stdClass();
$usrid->success = false;
$usrid->id = $_SESSION['user_id'];
$usrid->contract_id = $_SESSION['contract_id'];
$usrid->loggedin = $_SESSION['buyerseller'];
$usrid->IncorrectPass = $_SESSION['IncorrectPass'];
$usrid->Incorrectkey = $_SESSION['Incorrectkey'];
$usrid->passnomatch = $_SESSION['passnomatch'];
$usrid->pleasesignin = $_SESSION['pleasesignin'];
$usrid->hidecreateaccount = $_SESSION['hidecreateaccount'];
$usrid->emailexists = $_SESSION['emailexists'];
$inc = 0;
if($_SESSION['pleasesignin'] == 1){
    $usrid->pleasesignin = 1;
}
while(isset($_SESSION['signedby' .$inc])){
    $usrid->sellerbuyer[] = $_SESSION['sellerbuyer' .$inc];
    $usrid->submitteddate[] = $_SESSION['submitteddate' .$inc];
    $usrid->filetype1[] = $_SESSION['filetype' .$inc];
    $usrid->signedby[] = $_SESSION['signedby' .$inc];
    $inc++;}

echo (json_encode($usrid));


 ?>

/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*FILE UPLOAD FUNCTIONS*/
     
    $filename = $_POST['filetype'].$_FILES['file']['name'];
    $filename1 = $_FILES['userfile']['name'];

    $dirname = "upload/".$_SESSION['contract_id'];
    if(!is_dir($dirname)){
        mkdir($dirname);
    }
    $location = $dirname."/".$filename;
    
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
  if(isset($_POST['filetype'])){
      $_SESSION['buyerseller'] == 0 ? $_SESSION['sellerbuyer'] = "Buyer" : $_SESSION['sellerbuyer'] = "Seller";
       $contractfiles = "INSERT INTO files (user_id, contract_id, submittedby, filename, filepath, submitteddate, filetype, signedby)
         VALUES (:user_id, :contract_id, :submittedby, :filename, :filepath, :submitteddate, :filetype, :signedby);";
      $stmtcontractfiles = $pdo->prepare($contractfiles);
      $stmtcontractfiles->execute(array(
        ':user_id' => $_SESSION['user_id'],
        ':contract_id' => $_SESSION['contract_id'],
        ':submittedby' => $_SESSION['sellerbuyer'],
        ':filename' => $filename,
        ':filepath' => $location,
        ':submitteddate' => $_POST['filedate'],
        ':filetype' => $_POST['filetype'],
        ':signedby' => $_POST['signedby']));
        echo $filename;
        echo $location;
        echo "insert into script ran!";
           $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
 (new FileData())->FileDataResponse();
  }
  
  


/*BINSR BUTTONS FOR CONTRACT INSPECTION SECTION*/
if(isset($_POST["acceptbinsr"])) {
    $pdo->prepare("UPDATE contract SET binsraccepted = 1 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1")->execute();
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}

if(isset($_POST["sendbinsr"])) {
      $binsrupdate = ("UPDATE contract SET binsr0 = :binsr0, binsr1 = :binsr1, binsr2 = :binsr2, binsr3 = :binsr3, binsr4 = :binsr4, binsr5 = :binsr5, binsr6 = :binsr6, binsr7 = :binsr7, binsr8 = :binsr8, binsr9 = :binsr9 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1");
      $stmt = $pdo->prepare($binsrupdate);
      $stmt->execute(array(
          ':binsr0' => $_POST["binsr0"],
          ':binsr1' => $_POST["binsr1"],
          ':binsr2' => $_POST["binsr2"],
          ':binsr3' => $_POST["binsr3"],
          ':binsr4' => $_POST["binsr4"],
          ':binsr5' => $_POST["binsr5"],
          ':binsr6' => $_POST["binsr6"],
          ':binsr7' => $_POST["binsr7"],
          ':binsr8' => $_POST["binsr8"],
          ':binsr9' => $_POST["binsr9"]
          ));
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
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();   
}


/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/<?php
session_start();
if(empty($_SESSION['user_id'])){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*FILE UPLOAD FUNCTIONS*/
     
    $filename = $_POST['filetype'].$_FILES['file']['name'];
    $filename1 = $_FILES['userfile']['name'];

    $dirname = "upload/".$_SESSION['contract_id'];
    if(!is_dir($dirname)){
        mkdir($dirname);
    }
    $location = $dirname."/".$filename;
    
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
  if(isset($_POST['filetype'])){
      $_SESSION['buyerseller'] == 0 ? $_SESSION['sellerbuyer'] = "Buyer" : $_SESSION['sellerbuyer'] = "Seller";
       $contractfiles = "INSERT INTO files (user_id, contract_id, submittedby, filename, filepath, submitteddate, filetype, signedby)
         VALUES (:user_id, :contract_id, :submittedby, :filename, :filepath, :submitteddate, :filetype, :signedby);";
      $stmtcontractfiles = $pdo->prepare($contractfiles);
      $stmtcontractfiles->execute(array(
        ':user_id' => $_SESSION['user_id'],
        ':contract_id' => $_SESSION['contract_id'],
        ':submittedby' => $_SESSION['sellerbuyer'],
        ':filename' => $filename,
        ':filepath' => $location,
        ':submitteddate' => $_POST['filedate'],
        ':filetype' => $_POST['filetype'],
        ':signedby' => $_POST['signedby']));
        echo $filename;
        echo $location;
        echo "insert into script ran!";
           $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
 (new FileData())->FileDataResponse();
  }
  
  


/*BINSR BUTTONS FOR CONTRACT INSPECTION SECTION*/
if(isset($_POST["acceptbinsr"])) {
    $pdo->prepare("UPDATE contract SET binsraccepted = 1 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1")->execute();
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}

if(isset($_POST["sendbinsr"])) {
      $binsrupdate = ("UPDATE contract SET binsr0 = :binsr0, binsr1 = :binsr1, binsr2 = :binsr2, binsr3 = :binsr3, binsr4 = :binsr4, binsr5 = :binsr5, binsr6 = :binsr6, binsr7 = :binsr7, binsr8 = :binsr8, binsr9 = :binsr9 WHERE property_id = '{$_SESSION['property_id']}' ORDER BY contract_id ASC LIMIT 1");
      $stmt = $pdo->prepare($binsrupdate);
      $stmt->execute(array(
          ':binsr0' => $_POST["binsr0"],
          ':binsr1' => $_POST["binsr1"],
          ':binsr2' => $_POST["binsr2"],
          ':binsr3' => $_POST["binsr3"],
          ':binsr4' => $_POST["binsr4"],
          ':binsr5' => $_POST["binsr5"],
          ':binsr6' => $_POST["binsr6"],
          ':binsr7' => $_POST["binsr7"],
          ':binsr8' => $_POST["binsr8"],
          ':binsr9' => $_POST["binsr9"]
          ));
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
    header("Location: http://response.azrealestatehelper.com", 302);
    exit();   
}


/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["reload"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];


$c = "/classes.php";
   require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    
  header("Location: http://landing.azrealestatehelper.com");

  exit();
    }


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
        
    $pdo->prepare("UPDATE contract SET contract.deal_id = '{$_SESSION['deal_id']}', contract.sent = '{$_SESSION['sent']}' WHERE contract.contract_id = '{$_SESSION['contract_id']}'")->execute();
    
   
    
  header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}


if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}


/* COUNTER BUTTON  */
if(isset($_POST['counter'])){
    /* DISPLAYS EDITABLE COUNTER OFFER  */
    if($_SESSION['counter'] == 1 || $_SESSION['counter'] == "counter"){
     unset($_SESSION['counter']);
     $_SESSION['decrementdisable'] = 1;
     $_SESSION['counterbuttontext'] = 'I would like to make a counter offer';
     if($_SESSION['hidecounterdelete'] == 1){
            $pdo->prepare("DELETE FROM contract WHERE property_id='{$_SESSION['property_id']}' ORDER BY contract_id DESC LIMIT 1;")->execute();
         unset($_SESSION['hidecounterdelete']);
         $inc = 10;
         while(isset($_SESSION['contract_id' .$inc])){
             $inc++;
         }
         $inc--;
        unset($_SESSION['contract_id' .$inc]);
        }
            
   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}else{/* HIDES EDITABLE COUNTER OFFER  */
    $_SESSION['counter'] = "counter";
    
    $_SESSION['counterbuttontext'] = 'Cancel Counter Offer';

   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}}


/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();     
        */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["savechanges"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];
  
  
          if(isset($_GET["seller1"])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
        /* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
        if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"]) && $_GET["seller1"] ==
        $name['owner1']){
            
            //UPDATE PROPERtY function here
    $c = "/classes.php";
   require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new SqlUpadates())->UpdateProperty1();
            /*
          $sewer = "";
          function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
          if(test_input($_GET["wastewater"]) == "Sewer"){
              $sewer = 1;
            }else{
              $sewer = 0;
            }
            
            $_SESSION['sewer'] = $_GET["wastewater"];
            
          $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater
                WHERE property_id = :property_id";
          $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
          $stmtupdateproperty = $s->prepare($sqlupdateproperty);
          $stmtupdateproperty->execute(array(
            ':property_id' => $_SESSION["property_id"],
            ':seller1' => $_GET["seller1"],
            ':seller2' => $_GET["seller2"],
            ':address' => $_GET["address"],
            ':city' => $_GET["city"],
            ':county' => $_GET["county"],
            ':zip' => $_GET["zip"],
            ':assessornum' => $_GET["assessornum"],
            ':legaldisc' => $_GET["legaldisc"],
            ':yearbuilt' => $_GET["yearbuilt"],
            ':wastewater' => $sewer));
        }
          */
          if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])){$nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
/* TOOK THIS OUT OF BELOW IT WASNT' CREATING NEW CONTRACT  && $_SESSION['property_id'] != $nameproperty['property_id']*/
  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])) {
      
      //UPDATE CONTRACT  POSSIBLE
      $c = "/classes.php";
   require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new SqlUpadates())->updateContract();
      /*
      $leadpaint = "";
      if($_SESSION['yearbuilt'] < 1978){
        $leadpaint = 1;
      } else {
        $leadpaint = 0;
      }

      $sewer = "";
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

      $sqlcontract = "INSERT INTO contract (property_id, buyer_id, buyer1, buyer2, seller1, seller2, purchaseprice, earnestmoney, financed, additionaldown, earnestmoneyform, earnestmoneyheld, coedate, buyercontingency, waterwell, hoa, leadpaint, loanassuption, onsitewastewater, sellerfinancing, shortsale, other, refrigerator, washer, dryer, spa, personalprop, personalprop2, financing, sellerconsessionsdollar, homewarrantyorderedby, homewarrantypaidby, homewarrantyamount, additionalterms, accepttime)
              VALUES (:property_id, :buyer_id, :buyer1, :buyer2, :seller1, :seller2, :purchaseprice, :earnestmoney, :financed, :additionaldown, :earnestmoneyform, :earnestmoneyheld, :coedate, :buyercontingency, :waterwell, :hoa, :leadpaint, :loanassuption, :onsitewastewater, :sellerfinancing, :shortsale, :other, :refrigerator, :washer, :dryer, :spa, :personalprop, :personalprop2, :financing, :sellerconsessionsdollar, :homewarrantyorderedby, :homewarrantypaidby, :homewarrantyamount, :additionalterms, :accepttime)";
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* should be tieing foreign key contract and property
        ':buyer_id' => $_SESSION['buyer_id'],
        ':buyer1' => $_GET["buyer1"],
        ':buyer2' => $_GET["buyer2"],
        ':seller1' => $_GET['seller1'],
        ':seller2' => $_GET['seller2'],
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
        ));}
        */
    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
  (new LoadContracts())->loadresponsecontracts(); 
  
  
  header("Location: http://response.azrealestatehelper.com");

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
   
   //$_SESSION['IncorrectPass'] = '';
    if ($row == FALSE) {
       $_SESSION['pleasesignin'] = 1;
     $_SESSION['IncorrectPass'] = "Incorrect Password or Email";
     header("Location: http://response.azrealestatehelper.com", 302);
  exit();
    } else {
     

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
     
      $_SESSION['email'] = $name['Email'];
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    (new FileData())->FileDataResponse();
    $_SESSION['pleasesignin'] = 0;
     $contract = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_SESSION['contract_id']}';")->fetch();  //}took out added 385
    if($_SESSION['user_id'] != $contract['buyer_id']){
        /*NEED TO CREATE KEY ONLY SELLER CAN ACCESS ONCE TO ASSIGN SELF TO CONTRACT AND NOT HAVE BUYER BE ABLE TO*/
        $_SESSION['buyerseller'] = 1;
        $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
     
      $stmtsetsellerid = $s->prepare($setsellerid);
      $stmtsetsellerid->execute(array(
        ':seller_id' => $_SESSION['user_id'],
        ':property_id' => $_SESSION['property_id']));}else{$_SESSION['buyerseller'] = 0;}
header("Location: http://response.azrealestatehelper.com", 302);
      exit();
}}

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      exit();
      }
      
/*CREATE NEW USER */ 
  if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ 
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
              $_SESSION['buyerseller'] = 1;
                 $_SESSION['email'] = $name['Email'];
                 $_SESSION['emailexists'] = 0;
                  $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
                unset($_SESSION['pleasesignin']);
                exit();
          }  
    }else{
     $_SESSION['passnomatch1'] = "Passwords don't match";
     
   
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
      $_SESSION['Incorrectkey'] = '';
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
      $_SESSION['email'] = $name['Email'];
      $_SESSION['buyerseller'] = 0;
          $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
               
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
       require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
       
        (new LoadLanding())->LoadContracts();
       // header("Location: http://www.landing.azrealestatehelper.com");
    $_SESSION['Incorrectkey'] = 1;
         
    }else{
        $_SESSION['Incorrectkey'] = $_POST['key'];
}}

/*RESET PASSWORD AND HIDE MODAL*/

 if(isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ if($_POST["createpswd"] == $_POST["createpswd2"]) {
      $stmt = $pdo->prepare("UPDATE buyer SET password = :password WHERE email = :email");
    $stmt->execute(array(
      ':password' => $_POST['createpswd'],
      ':email' => $_SESSION['email']  ));
      unset($_SESSION['pleasesignin']);
 }else{
     $_SESSION['passnomatch'] = "Passwords dont match";
    
 }
 }

/* SAVE CHANGES BUTTON ON CONFIRM PAGE need to loop through for all files same with JS each function*/

$usrid = new \stdClass();
$usrid->success = false;
$usrid->id = $_SESSION['user_id'];
$usrid->contract_id = $_SESSION['contract_id'];
$usrid->loggedin = $_SESSION['buyerseller'];
$usrid->IncorrectPass = $_SESSION['IncorrectPass'];
$usrid->Incorrectkey = $_SESSION['Incorrectkey'];
$usrid->passnomatch = $_SESSION['passnomatch'];
$usrid->pleasesignin = $_SESSION['pleasesignin'];
$usrid->hidecreateaccount = $_SESSION['hidecreateaccount'];
$usrid->emailexists = $_SESSION['emailexists'];
$inc = 0;
if($_SESSION['pleasesignin'] == 1){
    $usrid->pleasesignin = 1;
}
while(isset($_SESSION['signedby' .$inc])){
    $usrid->sellerbuyer[] = $_SESSION['sellerbuyer' .$inc];
    $usrid->submitteddate[] = $_SESSION['submitteddate' .$inc];
    $usrid->filetype1[] = $_SESSION['filetype' .$inc];
    $usrid->signedby[] = $_SESSION['signedby' .$inc];
    $inc++;}

echo (json_encode($usrid));


 ?>

if(isset($_POST["reload"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];


$c = "/classes.php";
   require_once dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    
  header("Location: http://landing.azrealestatehelper.com");

  exit();
    }


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
        
    $pdo->prepare("UPDATE contract SET contract.deal_id = '{$_SESSION['deal_id']}', contract.sent = '{$_SESSION['sent']}' WHERE contract.contract_id = '{$_SESSION['contract_id']}'")->execute();
    
   
    
  header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}


if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}


/* COUNTER BUTTON  */
if(isset($_POST['counter'])){
    /* DISPLAYS EDITABLE COUNTER OFFER  */
    if($_SESSION['counter'] == 1 || $_SESSION['counter'] == "counter"){
     unset($_SESSION['counter']);
     $_SESSION['decrementdisable'] = 1;
     $_SESSION['counterbuttontext'] = 'I would like to make a counter offer';
     if($_SESSION['hidecounterdelete'] == 1){
            $pdo->prepare("DELETE FROM contract WHERE property_id='{$_SESSION['property_id']}' ORDER BY contract_id DESC LIMIT 1;")->execute();
         unset($_SESSION['hidecounterdelete']);
         $inc = 10;
         while(isset($_SESSION['contract_id' .$inc])){
             $inc++;
         }
         $inc--;
        unset($_SESSION['contract_id' .$inc]);
        }
            
   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}else{/* HIDES EDITABLE COUNTER OFFER  */
    $_SESSION['counter'] = "counter";
    
    $_SESSION['counterbuttontext'] = 'Cancel Counter Offer';
        
        
        
        
        
   header("Location: http://response.azrealestatehelper.com", 302);
    exit();
}}


/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();     
        */

/*  RESET AND GET ADDRESSES EVERY HOME RELOAD*/
if(isset($_POST["savechanges"])) {


  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];
  
  
          if(isset($_GET["seller1"])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
        /* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
        if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"]) && $_GET["seller1"] ==
        $name['owner1']){
          $sewer = "";/*could just make the value from the form 1 or 0 I guess*/
          function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
          if(test_input($_GET["wastewater"]) == "Sewer"){
              $sewer = 1;
            }else{
              $sewer = 0;
            }
            
            $_SESSION['sewer'] = $_GET["wastewater"];
            
          $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater
                WHERE property_id = :property_id";
          $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
          $stmtupdateproperty = $s->prepare($sqlupdateproperty);
          $stmtupdateproperty->execute(array(
            ':property_id' => $_SESSION["property_id"],
            ':seller1' => $_GET["seller1"],
            ':seller2' => $_GET["seller2"],
            ':address' => $_GET["address"],
            ':city' => $_GET["city"],
            ':county' => $_GET["county"],
            ':zip' => $_GET["zip"],
            ':assessornum' => $_GET["assessornum"],
            ':legaldisc' => $_GET["legaldisc"],
            ':yearbuilt' => $_GET["yearbuilt"],
            ':wastewater' => $sewer));
        }
          
          if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])){$nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
/* TOOK THIS OUT OF BELOW IT WASNT' CREATING NEW CONTRACT  && $_SESSION['property_id'] != $nameproperty['property_id']*/
  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])) {
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

      $sqlcontract = "INSERT INTO contract (property_id, buyer_id, buyer1, buyer2, seller1, seller2, purchaseprice, earnestmoney, financed, additionaldown, earnestmoneyform, earnestmoneyheld, coedate, buyercontingency, waterwell, hoa, leadpaint, loanassuption, onsitewastewater, sellerfinancing, shortsale, other, refrigerator, washer, dryer, spa, personalprop, personalprop2, financing, sellerconsessionsdollar, homewarrantyorderedby, homewarrantypaidby, homewarrantyamount, additionalterms, accepttime)
              VALUES (:property_id, :buyer_id, :buyer1, :buyer2, :seller1, :seller2, :purchaseprice, :earnestmoney, :financed, :additionaldown, :earnestmoneyform, :earnestmoneyheld, :coedate, :buyercontingency, :waterwell, :hoa, :leadpaint, :loanassuption, :onsitewastewater, :sellerfinancing, :shortsale, :other, :refrigerator, :washer, :dryer, :spa, :personalprop, :personalprop2, :financing, :sellerconsessionsdollar, :homewarrantyorderedby, :homewarrantypaidby, :homewarrantyamount, :additionalterms, :accepttime)";
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* should be tieing foreign key contract and property*/
        ':buyer_id' => $_SESSION['buyer_id'],
        ':buyer1' => $_GET["buyer1"],
        ':buyer2' => $_GET["buyer2"],
        ':seller1' => $_GET['seller1'],
        ':seller2' => $_GET['seller2'],
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
        ));}
    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
  (new LoadContracts())->loadresponsecontracts(); 
  
  
  header("Location: http://response.azrealestatehelper.com");

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
   
   //$_SESSION['IncorrectPass'] = '';
    if ($row == FALSE) {
       $_SESSION['pleasesignin'] = 1;
     $_SESSION['IncorrectPass'] = "Incorrect Password or Email";
     header("Location: http://response.azrealestatehelper.com", 302);
  exit();
    } else {
     

      $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['email']}';")->fetch();
      $_SESSION['name'] = $name['user1'];
      $_SESSION['user_id'] = $name['user_id'];
     
      $_SESSION['email'] = $name['Email'];
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadLanding())->LoadContracts();
    (new FileData())->FileDataResponse();
    $_SESSION['pleasesignin'] = 0;
     $contract = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_SESSION['contract_id']}';")->fetch();  //}took out added 385
    if($_SESSION['user_id'] != $contract['buyer_id']){
        /*NEED TO CREATE KEY ONLY SELLER CAN ACCESS ONCE TO ASSIGN SELF TO CONTRACT AND NOT HAVE BUYER BE ABLE TO*/
        $_SESSION['buyerseller'] = 1;
        $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
     
      $stmtsetsellerid = $s->prepare($setsellerid);
      $stmtsetsellerid->execute(array(
        ':seller_id' => $_SESSION['user_id'],
        ':property_id' => $_SESSION['property_id']));}else{$_SESSION['buyerseller'] = 0;}
header("Location: http://response.azrealestatehelper.com", 302);
      exit();
}}

/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      exit();
      }
      
/*CREATE NEW USER */ 
  if(isset($_POST["createname"]) && isset($_POST["createemail"]) && isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ 
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
              $_SESSION['buyerseller'] = 1;
                 $_SESSION['email'] = $name['Email'];
                 $_SESSION['emailexists'] = 0;
                  $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
                unset($_SESSION['pleasesignin']);
                exit();
          }  
    }else{
     $_SESSION['passnomatch1'] = "Passwords don't match";
     
   
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
      $_SESSION['Incorrectkey'] = '';
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
      $_SESSION['email'] = $name['Email'];
      $_SESSION['buyerseller'] = 0;
          $s = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $s->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $setsellerid = "UPDATE contract SET seller_id = :seller_id WHERE property_id = :property_id";
             
              $stmtsetsellerid = $s->prepare($setsellerid);
              $stmtsetsellerid->execute(array(
                ':seller_id' => $_SESSION['user_id'],
                ':property_id' => $_SESSION['property_id']));
               
       /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
       $c = "/classes.php";
       require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
       
        (new LoadLanding())->LoadContracts();
       // header("Location: http://www.landing.azrealestatehelper.com");
    $_SESSION['Incorrectkey'] = 1;
         
    }else{
        $_SESSION['Incorrectkey'] = $_POST['key'];
}}

/*RESET PASSWORD AND HIDE MODAL*/

 if(isset($_POST["createpswd"]) && isset($_POST["createpswd2"])){ if($_POST["createpswd"] == $_POST["createpswd2"]) {
      $stmt = $pdo->prepare("UPDATE buyer SET password = :password WHERE email = :email");
    $stmt->execute(array(
      ':password' => $_POST['createpswd'],
      ':email' => $_SESSION['email']  ));
      unset($_SESSION['pleasesignin']);
 }else{
     $_SESSION['passnomatch'] = "Passwords dont match";
    
 }
 }

/* SAVE CHANGES BUTTON ON CONFIRM PAGE need to loop through for all files same with JS each function*/

$usrid = new \stdClass();
$usrid->success = false;
$usrid->id = $_SESSION['user_id'];
$usrid->contract_id = $_SESSION['contract_id'];
$usrid->loggedin = $_SESSION['buyerseller'];
$usrid->IncorrectPass = $_SESSION['IncorrectPass'];
$usrid->Incorrectkey = $_SESSION['Incorrectkey'];
$usrid->passnomatch = $_SESSION['passnomatch'];
$usrid->pleasesignin = $_SESSION['pleasesignin'];
$usrid->hidecreateaccount = $_SESSION['hidecreateaccount'];
$usrid->emailexists = $_SESSION['emailexists'];
$inc = 0;
if($_SESSION['pleasesignin'] == 1){
    $usrid->pleasesignin = 1;
}
while(isset($_SESSION['signedby' .$inc])){
    $usrid->sellerbuyer[] = $_SESSION['sellerbuyer' .$inc];
    $usrid->submitteddate[] = $_SESSION['submitteddate' .$inc];
    $usrid->filetype1[] = $_SESSION['filetype' .$inc];
    $usrid->signedby[] = $_SESSION['signedby' .$inc];
    $inc++;}

echo (json_encode($usrid));


 ?>
