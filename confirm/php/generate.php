<?php
session_start();


use mikehaertl\pdftk\Pdf;
require 'vendor/autoload.php';
/* try absolute path below*/

if(isset($_GET['create'])){
$sellers = ($_SESSION['seller2'] != '') ? $_SESSION['seller1'].' and '.$_SESSION['seller2'] : $_SESSION['seller1'];

$buyers = ($_SESSION['buyer2'] != '') ? $_SESSION['buyer1'].' and '.$_SESSION['buyer2'] : $_SESSION['buyer1'];

$date = date_create($_SESSION['coedate']);
$coedate = date_format($date,"m - d , Y");

$date = date_create($_SESSION['accepttime']);
$accepttime = date_format($date,"m - d ,  Y  h : i A");

$earnestmoneyformcheck = ($_SESSION['earnestmoneyform'] == 'Check') ? 'X' : ''; 
$earnestmoneyformwire = ($_SESSION['earnestmoneyform'] == 'Wire') ? 'X' : '';

$earnestmoneyheldescrow= ($_SESSION['earnestmoneyheld'] == 'Escrow') ? 'X' : '';
$earnestmoneyheldbroker= ($_SESSION['earnestmoneyheld'] == 'Broker') ? 'X' : '';
$leadpaintcheck = ($_SESSION['leadpaint'] == 0) ? '' : 'X';

$buyercontingencycheck = ($_SESSION['buyercontingencycheck'] == '') ? '' : 'X';
$waterwellcheck = ($_SESSION['waterwellcheck'] == '') ? '' : 'X';
$hoacheck = ($_SESSION['hoacheck'] == '') ? '' : 'X';
$loanassuptioncheck = ($_SESSION['loanassuptioncheck'] == '') ? '' : 'X';
$sellerfinancingcheck  = ($_SESSION['sellerfinancingcheck'] == '') ? '' : 'X';
$shortsalecheck  = ($_SESSION['shortsalecheck'] == '') ? '' : 'X';
$othercheck = ($_SESSION['othercheck'] == '') ? '' : 'X';
$refrigeratorcheck = ($_SESSION['refrigeratorcheck'] == '') ? '' : 'X';
$washercheck = ($_SESSION['washercheck'] == '') ? '' : 'X';
$dryercheck = ($_SESSION['dryercheck'] == '') ? '' : 'X';
$spacheck = ($_SESSION['spacheck'] == '') ? '' : 'X';

$homewarrantyordered = ($_SESSION['homewarrantyorderedbybuyer'] || $_SESSION['homewarrantyorderedbyseller'] == ' checked') ? 'X' : '';
$homewarrantyorderedbybuyercheck = ($_SESSION['homewarrantyorderedbybuyercheck'] == '') ? '' : 'X';
$homewarrantyorderedbysellercheck = ($_SESSION['homewarrantyorderedbysellercheck'] == '') ? '' : 'X';
$homewarrantypaidbybuyercheck = ($_SESSION['homewarrantypaidbybuyercheck'] == '') ? '' : 'X';
$homewarrantypaidbysellercheck = ($_SESSION['homewarrantypaidbysellercheck'] == '') ? '' : 'X';
$sewercheck = ($_SESSION['sewer'] == 0) ? '' : 'X';
$septiccheck = ($_SESSION['sewer'] == 1) ? '' : 'X';
$personalpropcheck = ($_SESSION['personalprop'] == '') ? '' : 'X';
$personalprop2check = ($_SESSION['personalprop2'] == '') ? '' : 'X';


        $_SESSION['cash'] = "";
        $_SESSION['conventional'] = "";
        $_SESSION['fha'] = "";
        $_SESSION['va'] = "";
        $_SESSION['usda'] = "";
        $_SESSION['assumption'] = "";
        $_SESSION['sellercarryback'] = "";

        switch ($_SESSION['financing']) {
          case "Cash":
            $_SESSION['cash'] = "X";
            break;
          case "Conventional":
            $_SESSION['conventional'] = "X";
            break;
          case "FHA":
            $_SESSION['fha'] = "X";
            break;
          case "VA":
            $_SESSION['va'] = "X";
            break;
          case "USDA":
            $_SESSION['usda'] = "X";
            break;
          case "Assumption":
            $_SESSION['assumption'] = "X";
            break;
          case "Seller Carryback":
            $_SESSION['sellercarryback'] = "X";
            break;
        }

$pdf = new Pdf('form1.pdf');
$result = $pdf->fillForm([
        'buyers'=> $buyers,
        'sellers' => $sellers,
        'address' => $_SESSION['address'],
        'city' => $_SESSION['city'],
        'county' => $_SESSION['county'],
        'city' => $_SESSION['city'],
        'assessornum' => $_SESSION['assessornum'],
        'zip' => $_SESSION['zip'],
        'legaldisc' => $_SESSION['legaldisc'],
        'purchaseprice' => $_SESSION['purchaseprice'],
        'earnestmoney' => $_SESSION['earnestmoney'],
        'additionaldown' => $_SESSION['additionaldown'],
        'financed' => $_SESSION['financed'],
        'Check' => $earnestmoneyformcheck,
        'Wire' => $earnestmoneyformwire,
        'Escrow' => $earnestmoneyheldescrow,
        'Broker' => $earnestmoneyheldbroker,
        'coedate' => $coedate,
        'buyercontingencycheck' => $buyercontingencycheck,
        'waterwellcheck' => $waterwellcheck,
        'hoacheck' => $hoacheck,
        'loanassuptioncheck' => $loanassuptioncheck,
        'sellerfinancingcheck' => $sellerfinancingcheck,
        'shortsalecheck' => $shortsalecheck,
        'othercheck' => $othercheck,
        'refrigeratorcheck' => $refrigeratorcheck,
        'washercheck' => $washercheck,
        'dryercheck' => $dryercheck,
        'spacheck' => $spacheck,
        'personalprop' => $_SESSION['personalprop'],
        'personalprop2' => $_SESSION['personalprop2'],
        'personalpropcheck' => $personalpropcheck,
        'personalprop2check' => $personalprop2check,
        'leadpaint' => $leadpaintcheck,
        'cash' => $_SESSION['cash'],
        'conventional' => $_SESSION['conventional'],
        'fha' => $_SESSION['fha'],
        'va' => $_SESSION['va'],
        'usda' => $_SESSION['usda'],
        'assumption' => $_SESSION['assumption'],
        'sellercarryback' => $_SESSION['sellercarryback'],
        'sellerconsessionspercent' => $_SESSION['sellerconsessionspercent'],
        'sellerconsessionsdollar' => $_SESSION['sellerconsessionsdollar'],
        'sewercheck' => $sewercheck,
        'septiccheck' => $septiccheck,
        'homewarrantyordered' => $homewarrantyorderedby,
        'homewarrantyorderedbybuyercheck' => $homewarrantyorderedbybuyercheck,
        'homewarrantyorderedbysellercheck' => $homewarrantyorderedbysellercheck,
        'homewarrantypaidbybuyercheck' => $homewarrantypaidbybuyercheck,
        'homewarrantypaidbysellercheck' => $homewarrantypaidbysellercheck,
        'additionalterms' => $_SESSION['additionalterms'],
        'accepttime' => $accepttime,
        'agentname' => $_SESSION['agentname'],
        'agentname2' => $_SESSION['agentname2'],
        'agentlicense' => $_SESSION['agentlicense'],
        'agentlicense2' => $_SESSION['agentlicense2'],
        'firmname' => $_SESSION['firmname'],
        'firmaddress' => $_SESSION['firmaddress'],
        'firmlicense' => $_SESSION['firmlicense'],
        'firmphone' => $_SESSION['firmphone'],
        'agentemail' => $_SESSION['agentemail']
        
        

        

    ])
    ->flatten()
    ->send('pleasework.pdf')
    ;

    if ($result === false) {
    $error = $pdf->getError();
        }
}
/* UPDATE exsisting PROPERTY DATA from SAVED CHANGES BUTTON */
require 'pass.php';
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

/* Just to get seller1 data */
if(isset($_GET["sendcontract"]) || isset($_GET['savechanges'])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
/* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"])  && $_GET["seller1"] ==
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
  $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater
        WHERE owner1 = :seller1";
  $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
  $stmtupdateproperty = $s->prepare($sqlupdateproperty);
  $stmtupdateproperty->execute(array(
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

    $name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();

    $_SESSION['property_id'] = $name['property_id'];
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
    
    
    /*THIS WAS THE BREAK LINE----------------------------------*/
    $nameproperty = $pdo->query("SELECT * FROM contract WHERE property_id ='{$_SESSION['property_id']}';")->fetch();}
  if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"]) &&  $nameproperty['property_id'] == $_SESSION['property_id'] ){
  
    $leadpaint = "";
    if($_SESSION['yearbuilt'] < 1978){
      $leadpaint = 1;
    } else {
      $leadpaint = 0;
    }

    $sewer = "";/*could just make the value from the form 1 or 0 I guess */
    $onsitewastewater = "";
    
    if(test_input($_SESSION['sewer']) == "1"){
        $onsitewastewater = 0;
      }else{
        $onsitewastewater = 1;
      }
 
      $sqlupdatecontract = "UPDATE contract SET buyer_id = :buyer_id, buyer1 = :buyer1, buyer2 = :buyer2,  seller1 = :seller1, seller2 = :seller2, purchaseprice = :purchaseprice, earnestmoney = :earnestmoney, additionaldown = :additionaldown, financed = :financed, earnestmoneyform = :earnestmoneyform, earnestmoneyheld = :earnestmoneyheld, coedate = :coedate, buyercontingency = :buyercontingency, waterwell = :waterwell, hoa = :hoa, leadpaint = :leadpaint, loanassuption = :loanassuption, onsitewastewater = :onsitewastewater,    sellerfinancing = :sellerfinancing, shortsale = :shortsale, other = :other, refrigerator = :refrigerator, washer = :washer, dryer = :dryer, spa = :spa, personalprop = :personalprop, personalprop2 = :personalprop2, financing = :financing, sellerconsessionsdollar = :sellerconsessionsdollar, homewarrantyorderedby = :homewarrantyorderedby, homewarrantypaidby = :homewarrantypaidby, homewarrantyamount = :homewarrantyamount, additionalterms = :additionalterms, accepttime =:accepttime
                        WHERE property_id = :property_id";
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtupdatecontract = $s->prepare($sqlupdatecontract);
      $stmtupdatecontract->execute(array(
        ':property_id' => $_SESSION['property_id'],
        ':buyer_id' => $_SESSION['buyer_id'], /* should be tieing foreign key contract and property*/
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
        ':accepttime' => $_GET["accepttime"]));

        $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();
        $_SESSION['contract_id'] = $contract['contract_id'];
        $_SESSION['buyer1'] = $contract['buyer1'];
        $_SESSION['buyer2'] = $contract['buyer2'];
        $_SESSION['purchaseprice'] = $contract['purchaseprice'];
        $_SESSION['earnestmoney'] = $contract['earnestmoney'];
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
        $_SESSION['leadpaint'] = $contract['leadpaint'];
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

      if($_GET["agentname"] != ""){
        $sqlupadateagent = "UPDATE agent SET agentname = :agentname, agentlicense = :agentlicense, agentname2 = :agentname2, agentlicense2 = :agentlicense2, firmname = :firmname, firmaddress = :firmaddress, firmlicense = :firmlicense, firmphone = :firmphone, agentemail = :agentemail
                            WHERE agentid = :agentid";
        $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
        $stmtupdateagent = $s->prepare($sqlupadateagent);
        $stmtupdateagent->execute(array(
          ':agentid' => $_SESSION['selleragentid'],
          ':agentname' => $_GET["agentname"],
          ':agentlicense' => $_GET["agentlicense"],
          ':agentname2' => $_GET["agentname2"],
          ':agentlicense2' => $_GET["agentlicense2"],
          ':firmname' => $_GET["firmname"],
          ':firmaddress' => $_GET["firmaddress"],
          ':firmlicense' => $_GET["firmlicense"],
          ':firmphone' => $_GET["firmphone"],
          ':agentemail' => $_GET["agentemail"]));

          $agent = $pdo->query("SELECT * FROM agent WHERE agentname='{$_GET["agentname"]}';")->fetch();
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

          $_SESSION['agentmessage'] = "Has An Agent";
          $_SESSION['agentdisabled'] = "";

          $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
          $stmtselleragent = $s->prepare($sqlselleragent);
          $stmtselleragent->execute(array(
          ':selleragentid' => $_SESSION['selleragentid'],
          ':contract_id' => $_SESSION['contract_id']));
        if(isset($_GET['sendcontract'])){
         $contract2 = $pdo->prepare("UPDATE contract SET sent = 1 WHERE contract_id = :xyz;");
          $contract2->execute(array(':xyz' => $_SESSION["contract_id"]));
          
          $to = $_SESSION['agentemail'].', '.$_GET['selleremail'];
                $subject = "Home Offer";
                $txt = "Hello, you have recieved an offer to purchase your home!";
                $headers = "From: offer@azrealestatehelper.com";
            mail($to,$subject,$txt,$headers);
            $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 
$_SESSION['buyerseller'] = 0;
          header("Location: https://response.azrealestatehelper.com", 302);
            exit();}else{
        header("Location: https://confirm.azrealestatehelper.com", 302);
        exit();}
      }else{
          
        $_SESSION['selleragentid'] = NULL;
        $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
        $stmtselleragent = $s->prepare($sqlselleragent);
        $stmtselleragent->execute(array(
        ':selleragentid' => $_SESSION['selleragentid'],
        ':contract_id' => $_SESSION['contract_id']));
        $_SESSION['agentmessage'] = "NOT Have An Agent";
        $_SESSION['agentdisabled'] ="disabled";
      if(isset($_GET['sendcontract'])){
         $contract2 = $pdo->prepare("UPDATE contract SET sent = 1 WHERE contract_id = :xyz;");
          $contract2->execute(array(':xyz' => $_SESSION["contract_id"]));
          
          $to = $_SESSION['agentemail'].', '.$_GET['selleremail'];
                $subject = "Home Offer";
                $txt = "Hello, you have recieved an offer to purchase your home!";
                $headers = "From: offer@azrealestatehelper.com";
            mail($to,$subject,$txt,$headers);
            $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;  
   (new FileData())->FileDataResponse();
(new LoadContracts())->loadresponsecontracts(); 
$_SESSION['buyerseller'] = 0;
          header("Location: https://response.azrealestatehelper.com", 302);
            exit();}else{
      header("Location: http://confirm.azrealestatehelper.com", 302);
      exit();
      }}
}
 ?>
