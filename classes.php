<?php
session_start();


<?php
session_start();



    class FileData{
        function FileDataResponse(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            
            $fileinfo = $pdo->prepare("SELECT * FROM files WHERE contract_id = :xyz;");
            $fileinfo->execute(array(':xyz' => $_SESSION['contract_id']));
            $inc = 0;
          while($row = $fileinfo->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['sellerbuyer' .$inc] = $row['submittedby'];
            $_SESSION['filename' .$inc] = $row['filename'];
            $_SESSION['filepath' .$inc] = $row['filepath'];
            $_SESSION['submitteddate' .$inc] = $row['submitteddate'];
            $_SESSION['filetype' .$inc] = $row['filetype'];
            $_SESSION['signedby' .$inc] = $row['signedby'];
           $inc++;
            
            }
        }
    }

    class LoadLanding{
        function LoadContracts(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
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
    
            $address3->execute(array(':zxy' => $_SESSION['contract_id0' .$inc3]));
    
            $inc2++;
            $inc3++;
          }
          
         // RETURNS ALL PURCHASE CONTRACTS FOR BUYER SIDE
    
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
        }
        
        function NewUser(){
              session_unset();
      
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
                    /*$name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['createemail']}';")->fetch();  //preparethis
                    */
                    
                    $name = $pdo->prepare("SELECT * FROM buyer WHERE Email= ?;");
                    $name->execute(array($_POST['createemail']));
                    $name2 = $name->fetchAll();
                    
                    
                    
                    $_SESSION['name'] = $name2['user1']; /* ['buyer1']  is from the associative array pdo above*/
                    $_SESSION['user_id'] = $name2['user_id']; /* this is for the foreign key that goes into any id field*/
                    $_SESSION['buyer_id'] = $name2['user_id'];
                     
                   header("Location: http://www.landing.azrealestatehelper.com");
                    exit();
               
                    
              } 
        }
    }
        
    class SqlInsertNew{
      
        function NewProperty(){
            $sqltest = "INSERT INTO property (owner1, owner2, address, city, county, zip, assessornum, legaldisc, yearbuilt, sewer)
                  VALUES (:seller1, :seller2, :address, :city, :county, :zip, :assessornum, :legaldisc, :yearbuilt, :wastewater)";
            return $sqltest;
        }
        
        }
    
    class SqlUpadates{
     
                    
        function UpdateProperty1(){
            
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
            require "php/pass.php";
            $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater WHERE owner1 = :seller1";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            $stmtupdateproperty = $pdo->prepare($sqlupdateproperty);
            
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
           /* 
            $name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); //preparethis
            */
            
            $name = $pdo->prepare("SELECT * FROM buyer WHERE Email= ?;");
                $name->execute(array($_POST['createemail']));
                $name2 = $name->fetchAll();
            
        
            $_SESSION['property_id'] = $name2['property_id'];
           
            $_SESSION['seller1'] = $name2['owner1'];
            $_SESSION['seller2'] = $name2['owner2'];
            $_SESSION['address'] = $name2['address'];
            $_SESSION['city'] = $name2['city'];
            $_SESSION['county'] = $name2['county'];
            $_SESSION['zip'] = $name2['zip'];
            $_SESSION['assessornum'] = $name2['assessornum'];
            $_SESSION['legaldisc'] = $name2['legaldisc'];
            $_SESSION['yearbuilt'] = $name2['yearbuilt'];
            $_SESSION['sewer'] = $name2['sewer'];
            
        }
        
        
        function updateContract(){
             require "php/pass.php";
                    $leadpaint = "";
            if($_SESSION['yearbuilt'] < 1978){
              $leadpaint = 1;
            } else {
              $leadpaint = 0;
            }
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            $sewer = "";/*could just make the value from the form 1 or 0 I guess */
            $onsitewastewater = "";
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
            if(test_input($_SESSION['sewer']) == "1"){
                $onsitewastewater = 0;
              }else{
                $onsitewastewater = 1;
              }
        
              $sqlupdatecontract = "UPDATE contract SET  buyer1 = :buyer1, buyer2 = :buyer2, seller1 = :seller1, seller2 = :seller2, purchaseprice = :purchaseprice, earnestmoney = :earnestmoney, additionaldown = :additionaldown, financed = :financed, earnestmoneyform = :earnestmoneyform, earnestmoneyheld = :earnestmoneyheld, coedate = :coedate, buyercontingency = :buyercontingency, waterwell = :waterwell, hoa = :hoa, leadpaint = :leadpaint, loanassuption = :loanassuption, onsitewastewater = :onsitewastewater,    sellerfinancing = :sellerfinancing, shortsale = :shortsale, other = :other, refrigerator = :refrigerator, washer = :washer, dryer = :dryer, spa = :spa, personalprop = :personalprop, personalprop2 = :personalprop2, financing = :financing, sellerconsessionsdollar = :sellerconsessionsdollar, homewarrantyorderedby = :homewarrantyorderedby, homewarrantypaidby = :homewarrantypaidby, homewarrantyamount = :homewarrantyamount, additionalterms = :additionalterms, accepttime = :accepttime
                        WHERE property_id = :property_id";
              $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $stmtupdatecontract = $s->prepare($sqlupdatecontract);
              $stmtupdatecontract->execute(array(
                ':property_id' => $_SESSION['property_id'],
             //   ':buyer_id' => $_SESSION['buyer_id'],
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
        /*
                $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch(); //preparethis
                */
                
                $contract = $pdo->query("SELECT * FROM contract WHERE seller1= ?;");
                $contract->execute(array($_SESSION['seller1']));
                $contract2 = $contract->fetchAll();
                
                
                $_SESSION['contract_id'] = $contract2['contract_id'];
                $_SESSION['buyer1'] = $contract2['buyer1'];
                $_SESSION['buyer2'] = $contract2['buyer2'];
                $_SESSION['purchaseprice'] = $contract2['purchaseprice'];
                $_SESSION['earnestmoney'] = $contract2['earnestmoney'];
                $_SESSION['financed'] = $contract2['financed'];
                $_SESSION['additionaldown'] = $contract2['additionaldown'];
                $_SESSION['earnestmoneyform'] = $contract2['earnestmoneyform'];
                $_SESSION['earnestmoneyheld'] = $contract2['earnestmoneyheld'];
                $_SESSION['coedate'] = $contract2['coedate'];
                $_SESSION['buyercontingency'] = $contract2['buyercontingency'];
                $_SESSION['waterwell'] = $contract2['waterwell'];
                $_SESSION['leadpaint'] = $leadpaint;
                $_SESSION['hoa'] = $contract2['hoa'];
                $_SESSION['loanassuption'] = $contract2['loanassuption'];
                $_SESSION['onsitewastewater'] = $contract2['onsitewastewater'];
                $_SESSION['sellerfinancing'] = $contract2['sellerfinancing'];
                $_SESSION['shortsale'] = $contract2['shortsale'];
                $_SESSION['other'] = $contract2['other'];
                $_SESSION['refrigerator'] = $contract2['refrigerator'];
                $_SESSION['washer'] = $contract2['washer'];
                $_SESSION['dryer'] = $contract2['dryer'];
                $_SESSION['spa'] = $contract2['spa'];
                $_SESSION['personalprop'] = $contract2['personalprop'];
                $_SESSION['personalprop2'] = $contract2['personalprop2'];
                $_SESSION['financing'] = $contract2['financing'];
                $_SESSION['sellerconsessionspercent'] = $contract2['sellerconsessionspercent'];
                $_SESSION['sellerconsessionsdollar'] = $contract2['sellerconsessionsdollar'];
                $_SESSION['homewarrantyorderedby'] = $contract2['homewarrantyorderedby'];
                $_SESSION['homewarrantypaidby'] = $contract2['homewarrantypaidby'];
                $_SESSION['homewarrantyamount'] = $contract2['homewarrantyamount'];
                $_SESSION['additionalterms'] = $contract2['additionalterms'];
                $_SESSION['accepttime'] = $contract2['accepttime'];
        
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
        /*
                  $agent = $pdo->query("SELECT * FROM agent WHERE agentname='{$_GET["agentname"]}';")->fetch();  //preparethis
                 */
                  $agent = $pdo->query("SELECT * FROM agent WHERE agentname= ? ;");
                  $agent->execute(array($_GET["agentname"]));
                  $agent2 = $agent->fetchALL();
                 
                  
                  /* $name use this is for any other session var */
                  $_SESSION['agentlicense'] = $agent2['agentlicense'];
                  $_SESSION['agentname2'] = $agent2['agentname2'];
                  $_SESSION['agentlicense2'] = $agent2['agentlicense2'];
                  $_SESSION['firmname'] = $agent2['firmname'];
                  $_SESSION['firmaddress'] = $agent2['firmaddress'];
                  $_SESSION['firmlicense'] = $agent2['firmlicense'];
                  $_SESSION['firmphone'] = $agent2['firmphone'];
                  $_SESSION['agentemail'] = $agent2['agentemail'];
                  $_SESSION['selleragentid'] = $agent2['agentid'];
        
                  $_SESSION['agentmessage'] = "Has An Agent";
                  $_SESSION['agentdisabled'] = "";
        
                  $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
                  $stmtselleragent = $s->prepare($sqlselleragent);
                  $stmtselleragent->execute(array(
                  ':selleragentid' => $_SESSION['selleragentid'],
                  ':contract_id' => $_SESSION['contract_id']));
                header("Location: http://confirm.azrealestatehelper.com", 302);
                exit();
              }else{
                $_SESSION['selleragentid'] = NULL;
                $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
                $stmtselleragent = $s->prepare($sqlselleragent);
                $stmtselleragent->execute(array(
                ':selleragentid' => $_SESSION['selleragentid'],
                ':contract_id' => $_SESSION['contract_id']));
              $_SESSION['agentmessage'] = "NOT Have An Agent";
              $_SESSION['agentdisabled'] ="disabled";
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
                }}
                
            
        }
        
class LoadContracts{
        function loadresponsecontracts(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            if(isset($_POST['propertyid'])){$_SESSION['property_id'] = $_POST['propertyid'];};
           /* $binsrvars = $pdo->query("SELECT * FROM contract WHERE property_id = '{$_SESSION['propertyid']}' ORDER BY contract_id ASC LIMIT 1;")->fetch();  */  //preparethisdone
            
            
            $binsrvars = $pdo->prepare("SELECT * FROM contract WHERE property_id = ? ORDER BY contract_id ASC LIMIT 1;"); 
            $binsrvars->execute(array($_SESSION['propertyid']));
           $binsrvars2 = $binsrvars->fetchAll();
    
            $_SESSION['binsr0'] = $binsrvars2['binsr0'];
            $_SESSION['binsr1'] = $binsrvars2['binsr1'];
            $_SESSION['binsr2'] = $binsrvars2['binsr2'];
            $_SESSION['binsr3'] = $binsrvars2['binsr3'];
            $_SESSION['binsr4'] = $binsrvars2['binsr4'];
            $_SESSION['binsr5'] = $binsrvars2['binsr5'];
            $_SESSION['binsr6'] = $binsrvars2['binsr6'];
            $_SESSION['binsr7'] = $binsrvars2['binsr7'];
            $_SESSION['binsr8'] = $binsrvars2['binsr8'];
            $_SESSION['binsr9'] = $binsrvars2['binsr9'];
   

      $contract2 = $pdo->prepare("SELECT * FROM contract WHERE property_id = :xyz;");
      /*MIGHT NEED TO CHANGE FROM POST TO SESSION BY WHERE IT CAME FROM
      
      THERE IS ANOTHER POST ID ON 785ISH*/
      $contract2->execute(array(':xyz' => $_SESSION['property_id']));
      $address2 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                                ON property.property_id = contract.property_id
                                WHERE contract_id = :zxy;");
                                
        $whowaslast =   $pdo->query("SELECT createdby, sent
                FROM contract
                WHERE property_id = '{$_SESSION['propertyid']}'
                ORDER BY createdby DESC
                LIMIT 1;")->fetch(); //no user input don't need to prepare
        $_SESSION['sent'] = $whowaslast['sent'];
        $_SESSION['createdby'] = $whowaslast['createdby'];
   
        $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];

             
                    
      $inc = 10; /* 10 because lower contract ids might be set from landing script*/
       
    /* sets unlimited contract ids so the user can choose which one to work on */
      while($row = $contract2->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['disabled' .$inc] = " disabled";
        $_SESSION['createdby' .$inc] = $row['createdby'];
        $_SESSION['contract_id' .$inc] = htmlentities($row['contract_id']);
        $_SESSION['property_id'] = htmlentities($row['property_id']);
        $_SESSION['buyer_id'] = $row['buyer_id'];
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
       
          unset($_SESSION['agentlicense' .$inc]);
          unset($_SESSION['agentname2' .$inc]);
          unset($_SESSION['agentlicense2' .$inc]);
          unset($_SESSION['firmname' .$inc]);
          unset($_SESSION['firmaddress' .$inc]);
          unset($_SESSION['firmlicense' .$inc]);
          unset($_SESSION['firmphone' .$inc]);
          unset($_SESSION['agentemail' .$inc]);
         
        }
    
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
    
    if($_SESSION['selleragentid' .$inc] != ""){
        $agent = $pdo->query("SELECT * FROM agent
                              INNER JOIN contract ON agent.agentid=contract.selleragentid
                              WHERE agent.agentid='{$_SESSION['selleragentid'.$inc]}';")->fetch();
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
        /*
         $name = $pdo->query("SELECT * FROM property
                            INNER JOIN contract ON property.property_id=contract.property_id
                            WHERE contract.property_id='{$_POST['propertyid']}';")->fetch(); //preparethis
        */
        $name = $pdo->prepare("SELECT * FROM property INNER JOIN contract ON property.property_id=contract.property_id WHERE contract.property_id= ? ;");
        $name->execute(array($_POST['propertyid']));
        $name2 = $name->fetchAll();
        
    
    
        /* $name use this is for any other session var */
        $_SESSION['seller1' .$inc] = $name2['owner1'];
        $_SESSION['seller2' .$inc] = $name2['owner2'];
        $_SESSION['address' .$inc] = $name2['address'];
        $_SESSION['city' .$inc] = $name2['city'];
        $_SESSION['county' .$inc] = $name2['county'];
        $_SESSION['zip' .$inc] = $name2['zip'];
        $_SESSION['assessornum' .$inc] = $name2['assessornum'];
        $_SESSION['legaldisc' .$inc] = $name2['legaldisc'];
        $_SESSION['yearbuilt' .$inc] = $name2['yearbuilt'];
        $_SESSION['sewer' .$inc] = $name2['sewer'];
        
    
        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch(); //no need to preparethis  user input controlled

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
    
    
    
    /*
        $name = $pdo->query("SELECT * FROM property
                            INNER JOIN contract ON property.property_id=contract.property_id
                            WHERE contract.property_id='{$_SESSION['property_id']}';")->fetch();
    //preparethis
    */
    $name = $pdo->query("SELECT * FROM property INNER JOIN contract ON property.property_id=contract.property_id WHERE contract.property_id = ?;");
    $name->execute(array($_SESSION['property_id']));
    $name2 = $name->fetchAll();
    
    
    
        /* $name use this is for any other session var */
        $_SESSION['seller1' .$inc] = $name2['owner1'];
        $_SESSION['seller2' .$inc] = $name2['owner2'];
        $_SESSION['address' .$inc] = $name2['address'];
        $_SESSION['city' .$inc] = $name2['city'];
        $_SESSION['county' .$inc] = $name2['county'];
        $_SESSION['zip' .$inc] = $name2['zip'];
        $_SESSION['assessornum' .$inc] = $name2['assessornum'];
        $_SESSION['legaldisc' .$inc] = $name2['legaldisc'];
        $_SESSION['yearbuilt' .$inc] = $name2['yearbuilt'];
        $_SESSION['sewer' .$inc] = $name2['sewer'];
        $inc++;
        $_SESSION['inc']++;
    
        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch(); //no need to prepare
    
           
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
            
       $whowaslast =   $pdo->query("SELECT createdby, sent
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY contract_id DESC
            LIMIT 1;")->fetch(); //no need to prepare, no usr input
            $_SESSION['createdby'] = $whowaslast['createdby'];  
            $_SESSION['sent'] = $whowaslast['sent'];
            
            /* who is logged in, who created the last contract, was it sent:  buyer:0 seller:1 sent:bool */
            $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
            
            $_SESSION['buyerseller'] == $_SESSION['createdby'] ? $_SESSION['usercreated'] = 1 : $_SESSION['usercreated'] = 0;
              if(in_array($_SESSION['userview'], [110, "000"])){
                    $_SESSION['counter'] = 1;
                    }else{$_SESSION['counter'] = "";}
    
      
        }
            }
    }

?>
    class FileData{
        function FileDataResponse(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            
            $fileinfo = $pdo->prepare("SELECT * FROM files WHERE contract_id = :xyz;");
            $fileinfo->execute(array(':xyz' => $_SESSION['contract_id']));
            $inc = 0;
          while($row = $fileinfo->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['sellerbuyer' .$inc] = $row['submittedby'];
            $_SESSION['filename' .$inc] = $row['filename'];
            $_SESSION['filepath' .$inc] = $row['filepath'];
            $_SESSION['submitteddate' .$inc] = $row['submitteddate'];
            $_SESSION['filetype' .$inc] = $row['filetype'];
            $_SESSION['signedby' .$inc] = $row['signedby'];
           $inc++;
            
            }
        }
    }

    class LoadLanding{
        function LoadContracts(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              /*RETURNS ALL SALES CONTRACTS FROM DIFFERENT BUYERS*/
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
    
            $address3->execute(array(':zxy' => $_SESSION['contract_id0' .$inc3]));
    
            $inc2++;
            $inc3++;
          }
          
         // RETURNS ALL PURCHASE CONTRACTS FOR BUYER SIDE
    
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
        }
        
        function NewUser(){
              session_unset();
      
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
                    $name = $pdo->query("SELECT * FROM buyer WHERE Email='{$_POST['createemail']}';")->fetch();  //preparethis
                    
                    /*
                    $name = $pdo->prepare("SELECT * FROM buyer WHERE Email= ? ;");
                    $name->execute(array($_POST['createemail']);
                    $name2->fetchAll();
                    */
                    
                    
                    $_SESSION['name'] = $name['user1']; /* ['buyer1']  is from the associative array pdo above*/
                    $_SESSION['user_id'] = $name['user_id']; /* this is for the foreign key that goes into any id field*/
                    $_SESSION['buyer_id'] = $name['user_id'];
                     
                   header("Location: http://www.landing.azrealestatehelper.com");
                    exit();
               
                    
              } 
        }
    }
        
    class SqlInsertNew{
      
        function NewProperty(){
            $sqltest = "INSERT INTO property (owner1, owner2, address, city, county, zip, assessornum, legaldisc, yearbuilt, sewer)
                  VALUES (:seller1, :seller2, :address, :city, :county, :zip, :assessornum, :legaldisc, :yearbuilt, :wastewater)";
            return $sqltest;
        }
        
        }
    
    class SqlUpadates{
     
                    
        function UpdateProperty1(){
            
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
            require "php/pass.php";
            $sqlupdateproperty = "UPDATE property SET owner1 = :seller1, owner2 = :seller2, address = :address, city = :city, county = :county, zip = :zip, legaldisc = :legaldisc, assessornum = :assessornum, yearbuilt = :yearbuilt, sewer = :wastewater WHERE owner1 = :seller1";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            $stmtupdateproperty = $pdo->prepare($sqlupdateproperty);
            
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
            
            $name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); //preparethis
            
            /*
            $name = $pdo->prepare("SELECT * FROM property WHERE owner1 = ?;");
            $name->execute(array($_GET['seller1']));
            $name2->fetchAll();
            */
        
            $_SESSION['property_id'] = $name['property_id'];
           
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
            
        }
        
        
        function updateContract(){
             require "php/pass.php";
                    $leadpaint = "";
            if($_SESSION['yearbuilt'] < 1978){
              $leadpaint = 1;
            } else {
              $leadpaint = 0;
            }
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            $sewer = "";/*could just make the value from the form 1 or 0 I guess */
            $onsitewastewater = "";
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
            if(test_input($_SESSION['sewer']) == "1"){
                $onsitewastewater = 0;
              }else{
                $onsitewastewater = 1;
              }
        
              $sqlupdatecontract = "UPDATE contract SET  buyer1 = :buyer1, buyer2 = :buyer2, seller1 = :seller1, seller2 = :seller2, purchaseprice = :purchaseprice, earnestmoney = :earnestmoney, additionaldown = :additionaldown, financed = :financed, earnestmoneyform = :earnestmoneyform, earnestmoneyheld = :earnestmoneyheld, coedate = :coedate, buyercontingency = :buyercontingency, waterwell = :waterwell, hoa = :hoa, leadpaint = :leadpaint, loanassuption = :loanassuption, onsitewastewater = :onsitewastewater,    sellerfinancing = :sellerfinancing, shortsale = :shortsale, other = :other, refrigerator = :refrigerator, washer = :washer, dryer = :dryer, spa = :spa, personalprop = :personalprop, personalprop2 = :personalprop2, financing = :financing, sellerconsessionsdollar = :sellerconsessionsdollar, homewarrantyorderedby = :homewarrantyorderedby, homewarrantypaidby = :homewarrantypaidby, homewarrantyamount = :homewarrantyamount, additionalterms = :additionalterms, accepttime = :accepttime
                        WHERE property_id = :property_id";
              $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
              $stmtupdatecontract = $s->prepare($sqlupdatecontract);
              $stmtupdatecontract->execute(array(
                ':property_id' => $_SESSION['property_id'],
             //   ':buyer_id' => $_SESSION['buyer_id'],
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
        
                $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch(); //preparethis
                
                /*
                $contract = $pdo->query("SELECT * FROM contract WHERE seller1= ?;")
                $contract->execute(array($_SESSION['seller1']));
                $contract2->fetchAll();
                */
                
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
        
                  $agent = $pdo->query("SELECT * FROM agent WHERE agentname='{$_GET["agentname"]}';")->fetch();  //preparethis
                  /*
                  $agent = $pdo->query("SELECT * FROM agent WHERE agentname= ? ;")
                  $agent->execute(array($_GET["agentname"]));
                  $agent2->fetchALL();
                  */
                  
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
                header("Location: http://confirm.azrealestatehelper.com", 302);
                exit();
              }else{
                $_SESSION['selleragentid'] = NULL;
                $sqlselleragent = "UPDATE contract SET selleragentid = :selleragentid WHERE contract_id = :contract_id";
                $stmtselleragent = $s->prepare($sqlselleragent);
                $stmtselleragent->execute(array(
                ':selleragentid' => $_SESSION['selleragentid'],
                ':contract_id' => $_SESSION['contract_id']));
              $_SESSION['agentmessage'] = "NOT Have An Agent";
              $_SESSION['agentdisabled'] ="disabled";
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
                }}
                
            
        }
        
class LoadContracts{
        function loadresponsecontracts(){
            require "php/pass.php";
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
            if(isset($_POST['propertyid'])){$_SESSION['property_id'] = $_POST['propertyid'];};
           /* $binsrvars = $pdo->query("SELECT * FROM contract WHERE property_id = '{$_SESSION['propertyid']}' ORDER BY contract_id ASC LIMIT 1;")->fetch();  */  //preparethisdone
            
            
            $binsrvars = $pdo->prepare("SELECT * FROM contract WHERE property_id = ? ORDER BY contract_id ASC LIMIT 1;"); 
            $binsrvars->execute(array($_SESSION['propertyid']));
           $binsrvars2 = $binsrvars->fetchAll();
    
            $_SESSION['binsr0'] = $binsrvars2['binsr0'];
            $_SESSION['binsr1'] = $binsrvars2['binsr1'];
            $_SESSION['binsr2'] = $binsrvars2['binsr2'];
            $_SESSION['binsr3'] = $binsrvars2['binsr3'];
            $_SESSION['binsr4'] = $binsrvars2['binsr4'];
            $_SESSION['binsr5'] = $binsrvars2['binsr5'];
            $_SESSION['binsr6'] = $binsrvars2['binsr6'];
            $_SESSION['binsr7'] = $binsrvars2['binsr7'];
            $_SESSION['binsr8'] = $binsrvars2['binsr8'];
            $_SESSION['binsr9'] = $binsrvars2['binsr9'];
   

      $contract2 = $pdo->prepare("SELECT * FROM contract WHERE property_id = :xyz;");
      /*MIGHT NEED TO CHANGE FROM POST TO SESSION BY WHERE IT CAME FROM
      
      THERE IS ANOTHER POST ID ON 785ISH*/
      $contract2->execute(array(':xyz' => $_SESSION['property_id']));
      $address2 = $pdo->prepare("SELECT * FROM property INNER JOIN contract
                                ON property.property_id = contract.property_id
                                WHERE contract_id = :zxy;");
                                
        $whowaslast =   $pdo->query("SELECT createdby, sent
                FROM contract
                WHERE property_id = '{$_SESSION['propertyid']}'
                ORDER BY createdby DESC
                LIMIT 1;")->fetch(); //no user input don't need to prepare
        $_SESSION['sent'] = $whowaslast['sent'];
        $_SESSION['createdby'] = $whowaslast['createdby'];
   
        $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];

             
                    
      $inc = 10; /* 10 because lower contract ids might be set from landing script*/
       
    /* sets unlimited contract ids so the user can choose which one to work on */
      while($row = $contract2->fetch(PDO::FETCH_ASSOC)) {
        $_SESSION['disabled' .$inc] = " disabled";
        $_SESSION['createdby' .$inc] = $row['createdby'];
        $_SESSION['contract_id' .$inc] = htmlentities($row['contract_id']);
        $_SESSION['property_id'] = htmlentities($row['property_id']);
        $_SESSION['buyer_id'] = $row['buyer_id'];
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
       
          unset($_SESSION['agentlicense' .$inc]);
          unset($_SESSION['agentname2' .$inc]);
          unset($_SESSION['agentlicense2' .$inc]);
          unset($_SESSION['firmname' .$inc]);
          unset($_SESSION['firmaddress' .$inc]);
          unset($_SESSION['firmlicense' .$inc]);
          unset($_SESSION['firmphone' .$inc]);
          unset($_SESSION['agentemail' .$inc]);
         
        }
    
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
    
    if($_SESSION['selleragentid' .$inc] != ""){
        $agent = $pdo->query("SELECT * FROM agent
                              INNER JOIN contract ON agent.agentid=contract.selleragentid
                              WHERE agent.agentid='{$_SESSION['selleragentid'.$inc]}';")->fetch();
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
        
         $name = $pdo->query("SELECT * FROM property
                            INNER JOIN contract ON property.property_id=contract.property_id
                            WHERE contract.property_id='{$_POST['propertyid']}';")->fetch(); //preparethis
        /*
        $name = $pdo->prepare("SELECT * FROM property INNER JOIN contract ON property.property_id=contract.property_id WHERE contract.property_id= ? ;")
        $name->execute(array($_POST['propertyid']));
        $name2->fetchAll();
        */
    
    
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
        
    
        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch(); //no need to preparethis  user input controlled

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
    //preparethis
    /*
    $name = $pdo->query("SELECT * FROM property INNER JOIN contract ON property.property_id=contract.property_id WHERE contract.property_id= ?;")
    $name->execute(array($_SESSION['property_id']));
    $name2->fetchAll();
    */
    
    
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
    
        $dealvars = $pdo->query("SELECT * FROM deal WHERE contract_id = '{$_SESSION['contract_id']}';")->fetch(); //no need to prepare
    
           
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
            
       $whowaslast =   $pdo->query("SELECT createdby, sent
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY contract_id DESC
            LIMIT 1;")->fetch(); //no need to prepare, no usr input
            $_SESSION['createdby'] = $whowaslast['createdby'];  
            $_SESSION['sent'] = $whowaslast['sent'];
            
            /* who is logged in, who created the last contract, was it sent:  buyer:0 seller:1 sent:bool */
            $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
            
            $_SESSION['buyerseller'] == $_SESSION['createdby'] ? $_SESSION['usercreated'] = 1 : $_SESSION['usercreated'] = 0;
              if(in_array($_SESSION['userview'], [110, "000"])){
                    $_SESSION['counter'] = 1;
                    }else{$_SESSION['counter'] = "";}
    
      
        }
            }
    }

?>
