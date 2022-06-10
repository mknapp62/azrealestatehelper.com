<?php
session_start();


use mikehaertl\pdftk\Pdf;
require 'vendor/autoload.php';
/* try absolute path below*/
$inc5 = 10;

while(isset($_SESSION['contract_id' .$inc5])){

   $inc5++;
 }
$inc5--;

if(isset($_GET['create'])){
$sellers = ($_SESSION['seller2' .$inc5] != '') ? $_SESSION['seller1' .$inc5].' and '.$_SESSION['seller2' .$inc5] : $_SESSION['seller1' .$inc5];

$buyers = ($_SESSION['buyer2' .$inc5] != '') ? $_SESSION['buyer1' .$inc5].' and '.$_SESSION['buyer2' .$inc5] : $_SESSION['buyer1' .$inc5];

$date = date_create($_SESSION['coedate' .$inc5]);
$coedate = date_format($date,"m - d , Y");

$date = date_create($_SESSION['accepttime' .$inc5]);
$accepttime = date_format($date,"m - d ,  Y  h : i A");

$earnestmoneyformcheck = ($_SESSION['earnestmoneyform' .$inc5] == 'Check') ? 'X' : ''; 
$earnestmoneyformwire = ($_SESSION['earnestmoneyform' .$inc5] == 'Wire') ? 'X' : '';

$earnestmoneyheldescrow= ($_SESSION['earnestmoneyheld' .$inc5] == 'Escrow') ? 'X' : '';
$earnestmoneyheldbroker= ($_SESSION['earnestmoneyheld' .$inc5] == 'Broker') ? 'X' : '';
$leadpaintcheck = ($_SESSION['leadpaint' .$inc5] == 0) ? '' : 'X';

$buyercontingencycheck = ($_SESSION['buyercontingencycheck' .$inc5] == '') ? '' : 'X';
$waterwellcheck = ($_SESSION['waterwellcheck' .$inc5] == '') ? '' : 'X';
$hoacheck = ($_SESSION['hoacheck' .$inc5] == '') ? '' : 'X';
$loanassuptioncheck = ($_SESSION['loanassuptioncheck' .$inc5] == '') ? '' : 'X';
$sellerfinancingcheck  = ($_SESSION['sellerfinancingcheck' .$inc5] == '') ? '' : 'X';
$shortsalecheck  = ($_SESSION['shortsalecheck' .$inc5] == '') ? '' : 'X';
$othercheck = ($_SESSION['othercheck' .$inc5] == '') ? '' : 'X';
$refrigeratorcheck = ($_SESSION['refrigeratorcheck' .$inc5] == '') ? '' : 'X';
$washercheck = ($_SESSION['washercheck' .$inc5] == '') ? '' : 'X';
$dryercheck = ($_SESSION['dryercheck' .$inc5] == '') ? '' : 'X';
$spacheck = ($_SESSION['spacheck' .$inc5] == '') ? '' : 'X';

$homewarrantyordered = ($_SESSION['homewarrantyorderedbybuyer' .$inc5] || $_SESSION['homewarrantyorderedbyseller' .$inc5] == ' checked') ? 'X' : '';
$homewarrantyorderedbybuyercheck = ($_SESSION['homewarrantyorderedbybuyercheck' .$inc5] == '') ? '' : 'X';
$homewarrantyorderedbysellercheck = ($_SESSION['homewarrantyorderedbysellercheck' .$inc5] == '') ? '' : 'X';
$homewarrantypaidbybuyercheck = ($_SESSION['homewarrantypaidbybuyercheck' .$inc5] == '') ? '' : 'X';
$homewarrantypaidbysellercheck = ($_SESSION['homewarrantypaidbysellercheck' .$inc5] == '') ? '' : 'X';
$sewercheck = ($_SESSION['sewer' .$inc5] == 0) ? '' : 'X';
$septiccheck = ($_SESSION['sewer' .$inc5] == 1) ? '' : 'X';
$personalpropcheck = ($_SESSION['personalprop' .$inc5] == '') ? '' : 'X';
$personalprop2check = ($_SESSION['personalprop2' .$inc5] == '') ? '' : 'X';


        $_SESSION['cash' .$inc5] = "";
        $_SESSION['conventional' .$inc5] = "";
        $_SESSION['fha' .$inc5] = "";
        $_SESSION['va' .$inc5] = "";
        $_SESSION['usda' .$inc5] = "";
        $_SESSION['assumption' .$inc5] = "";
        $_SESSION['sellercarryback' .$inc5] = "";

        switch ($_SESSION['financing' .$inc5]) {
          case "Cash":
            $_SESSION['cash' .$inc5] = "X";
            break;
          case "Conventional":
            $_SESSION['conventional' .$inc5] = "X";
            break;
          case "FHA":
            $_SESSION['fha' .$inc5] = "X";
            break;
          case "VA":
            $_SESSION['va' .$inc5] = "X";
            break;
          case "USDA":
            $_SESSION['usda' .$inc5] = "X";
            break;
          case "Assumption":
            $_SESSION['assumption' .$inc5] = "X";
            break;
          case "Seller Carryback":
            $_SESSION['sellercarryback' .$inc5] = "X";
            break;
        }

$pdf = new Pdf('form2.pdf');
$result = $pdf->fillForm([
        'sig' => $buyers,
        'buyers'=> $buyers,
        'sellers' => $sellers,
        'address' => $_SESSION['address' .$inc5],
        'city' => $_SESSION['city' .$inc5],
        'county' => $_SESSION['county' .$inc5],
        'city' => $_SESSION['city' .$inc5],
        'assessornum' => $_SESSION['assessornum' .$inc5],
        'zip' => $_SESSION['zip' .$inc5],
        'legaldisc' => $_SESSION['legaldisc' .$inc5],
        'purchaseprice' => $_SESSION['purchaseprice'.$inc5],
        'earnestmoney' => $_SESSION['earnestmoney' .$inc5],
        'additionaldown' => $_SESSION['additionaldown' .$inc5],
        'financed' => $_SESSION['financed' .$inc5],
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
        'personalprop' => $_SESSION['personalprop' .$inc5],
        'personalprop2' => $_SESSION['personalprop2' .$inc5],
        'personalpropcheck' => $personalpropcheck,
        'personalprop2check' => $personalprop2check,
        'leadpaint' => $leadpaintcheck,
        'cash' => $_SESSION['cash' .$inc5],
        'conventional' => $_SESSION['conventional' .$inc5],
        'fha' => $_SESSION['fha' .$inc5],
        'va' => $_SESSION['va' .$inc5],
        'usda' => $_SESSION['usda' .$inc5],
        'assumption' => $_SESSION['assumption' .$inc5],
        'sellercarryback' => $_SESSION['sellercarryback' .$inc5],
        'sellerconsessionspercent' => $_SESSION['sellerconsessionspercent' .$inc5],
        'sellerconsessionsdollar' => $_SESSION['sellerconsessionsdollar' .$inc5],
        'sewercheck' => $sewercheck,
        'septiccheck' => $septiccheck,
        'homewarrantyordered' => $homewarrantyorderedby,
        'homewarrantyorderedbybuyercheck' => $homewarrantyorderedbybuyercheck,
        'homewarrantyorderedbysellercheck' => $homewarrantyorderedbysellercheck,
        'homewarrantypaidbybuyercheck' => $homewarrantypaidbybuyercheck,
        'homewarrantypaidbysellercheck' => $homewarrantypaidbysellercheck,
        'additionalterms' => $_SESSION['additionalterms' .$inc5],
        'accepttime' => $accepttime,
        'agentname' => $_SESSION['agentname' .$inc5],
        'agentname2' => $_SESSION['agentname2' .$inc5],
        'agentlicense' => $_SESSION['agentlicense' .$inc5],
        'agentlicense2' => $_SESSION['agentlicense2' .$inc5],
        'firmname' => $_SESSION['firmname' .$inc5],
        'firmaddress' => $_SESSION['firmaddress' .$inc5],
        'firmlicense' => $_SESSION['firmlicense' .$inc5],
        'firmphone' => $_SESSION['firmphone' .$inc5],
        'agentemail' => $_SESSION['agentemail' .$inc5]
        
        

        

    ])
    ->flatten()
    ->send('pleasework.pdf')
     ;

    if ($result === false) {
    $error = $pdf->getError();
        }
}



/* CREATE NEW CONTRACT TO COUNTER from SAVED CHANGES BUTTON */
require 'pass.php';
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

/* Just to get seller1 data */
if(isset($_GET["sendsave"])) {
    $_SESSION["savechanges"] = 1;
   
   if($_GET["sendsave"] == 2){
       $sent = 1;
       $_SESSION['counter'] = "";
   }else{
       $sent = 0;
       $_SESSION['hidecounterdelete'] = 1;
   }

  $name = $pdo->query("SELECT * FROM buyer WHERE user_id='{$_SESSION['user_id']}';")->fetch();

  $_SESSION['name'] = $name['user1'];
  $_SESSION['user_id'] = $name['user_id'];
  $_SESSION['buyer_id'] = $name['user_id'];
  
  //NEED THE FOLLOWING TO PLACE BUYER ID INSTEAD OF SELLER ID FOR SAVED 
  $name = $pdo->query("SELECT * FROM contract WHERE property_id='{$_SESSION['property_id']}';")->fetch();
  $_SESSION['buyer_id'] = $name['buyer_id'];
  
  
  
            function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
            }
  
          if(isset($_GET["seller1"])){$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch();}
      
          
          if(isset($_GET["purchaseprice"])){
              $nameproperty = $pdo->query("SELECT * FROM contract WHERE contract_id ='{$_SESSION['contract_id' .$inc5]}';")->fetch();
              $_SESSION['selleragentid'] = $nameproperty['selleragentid'];
              $_SESSION['contract_id' .$inc5] = $nameproperty['contract_id'];
              $_SESSION['createdby'] = $nameproperty['createdby'];
              $_SESSION['buyer_id'] = $nameproperty['buyer_id'];
              $_SESSION['seller_id'] = $nameproperty['seller_id'];
          }
/* TOOK THIS OUT OF BELOW IT WASNT' CREATING NEW CONTRACT  && $_SESSION['property_id'] != $nameproperty['property_id']*/
  
      $leadpaint = "";
      if($_SESSION['yearbuilt'] < 1978){
        $leadpaint = 1;
      } else {
        $leadpaint = 0;
      }
   
      $sewer = "";/*could just make the value from the form 1 or 0 I guess if(isset($_GET["buyer1"]) && isset($_GET["purchaseprice"])) {*/
  
      if(test_input($_SESSION['sewer']) == "sewer"){
          $onsitewastewater = 0;
        }else{
          $onsitewastewater = 1;
        }
    if(in_array($_SESSION['userview'], ['111', '101', '001', '011'], true )){
      $sqlcontract = "INSERT INTO contract (property_id, buyer_id, buyer1, buyer2, seller1, seller2, seller_id, purchaseprice, earnestmoney, financed, additionaldown, earnestmoneyform, earnestmoneyheld, coedate, buyercontingency, waterwell, hoa, leadpaint, loanassuption, onsitewastewater, sellerfinancing, shortsale, other, refrigerator, washer, dryer, spa, personalprop, personalprop2, financing, sellerconsessionsdollar, homewarrantyorderedby, homewarrantypaidby, homewarrantyamount, additionalterms, accepttime, selleragentid, createdby, sent)
              VALUES (:property_id, :buyer_id, :buyer1, :buyer2, :seller1, :seller2, :seller_id, :purchaseprice, :earnestmoney, :financed, :additionaldown, :earnestmoneyform, :earnestmoneyheld, :coedate, :buyercontingency, :waterwell, :hoa, :leadpaint, :loanassuption, :onsitewastewater, :sellerfinancing, :shortsale, :other, :refrigerator, :washer, :dryer, :spa, :personalprop, :personalprop2, :financing, :sellerconsessionsdollar, :homewarrantyorderedby, :homewarrantypaidby, :homewarrantyamount, :additionalterms, :accepttime, :selleragentid, :createdby, :sent)";
              
         $_SESSION['createdby'] == 1 ? $_SESSION['createdby'] = 0 : $_SESSION['createdby'] = 1;
         
         $_SESSION['createdby'] == 1? $_SESSION['ifseller'] =  $_SESSION['user_id'] : $_SESSION['ifseller'] = $_SESSION['seller_id'];
         
         $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* '{$_SESSION['contract_id' .$inc5]} ':contract_id' => 33, should be tieing foreign key contract and property*/
        
        ':sent' => $sent,
        ':createdby' => $_SESSION['createdby'],
        ':buyer_id' => $_SESSION['buyer_id'],//seller is getting own id because of this
        ':buyer1' => $_SESSION["buyer1"],
        ':buyer2' => $_SESSION["buyer2"],
        ':seller1' => $_SESSION['seller1'],
        ':seller2' => $_SESSION['seller2'],
        ':seller_id' => $_SESSION['ifseller'],
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
        ':accepttime' => $_GET["accepttime"],
        ':selleragentid' => $_SESSION["selleragentid"],
        
        ));
           /*  $_SESSION['decrementdisable'] = 1; comment out it was showing old contract, from 111 to 000*/
    }else{
        $sqlcontract = "UPDATE contract SET property_id = :property_id, buyer_id = :buyer_id, buyer1 = :buyer1, buyer2 = :buyer2,  seller1 = :seller1, seller2 = :seller2, seller_id = :seller_id, purchaseprice = :purchaseprice, earnestmoney = :earnestmoney, additionaldown = :additionaldown, financed = :financed, earnestmoneyform = :earnestmoneyform, earnestmoneyheld = :earnestmoneyheld, coedate = :coedate, buyercontingency = :buyercontingency, waterwell = :waterwell, hoa = :hoa, leadpaint = :leadpaint, loanassuption = :loanassuption, onsitewastewater = :onsitewastewater, sellerfinancing = :sellerfinancing, shortsale = :shortsale, other = :other, refrigerator = :refrigerator, washer = :washer, dryer = :dryer, spa = :spa, personalprop = :personalprop, personalprop2 = :personalprop2, financing = :financing, sellerconsessionsdollar = :sellerconsessionsdollar, homewarrantyorderedby = :homewarrantyorderedby, homewarrantypaidby = :homewarrantypaidby, homewarrantyamount = :homewarrantyamount, additionalterms = :additionalterms, accepttime = :accepttime, createdby = :createdby, selleragentid = :selleragentid, sent = :sent
                        WHERE contract_id = :contract_id";
                  
        
         $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmtcontract = $s->prepare($sqlcontract);
      $stmtcontract->execute(array(
        ':property_id' => $_SESSION['property_id'],/* '{$_SESSION['contract_id' .$inc5]} , should be tieing foreign key contract and property*/
        ':sent' => $sent,
        ':buyer_id' => $_SESSION['buyer_id'],
        ':buyer1' => $_SESSION["buyer1"],
        ':buyer2' => $_SESSION["buyer2"],
        ':seller1' => $_SESSION['seller1'],
        ':seller2' => $_SESSION['seller2'],
        ':seller_id' => $_SESSION['ifseller'],
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
        ':accepttime' => $_GET["accepttime"],
        ':createdby' => $_SESSION['createdby'],
        ':selleragentid' => $_SESSION["selleragentid"],
        ':contract_id' => $_SESSION["contract_id" .$inc5]
        ));
        
    }
     
      $c = "/classes.php";
   require dirname("/home/knapp62/public_html/response/index.php", 2).$c;
    (new LoadContracts())->loadresponsecontracts();
    

  header("Location: http://response.azrealestatehelper.com");

  exit();
    }
    
  
 ?>
