<?php
session_set_cookie_params(0, '/', '.azrealestatehelper.com');
session_start();
if(empty($_SESSION['user_id'])){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Confirm Page</title>
    <link rel="apple-touch-icon" sizes="180x180" href="//azrealestatehelper.com/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="//azrealestatehelper.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//azrealestatehelper.com/favicon/favicon-16x16.png">
    <link rel="manifest" href="//azrealestatehelper.com/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jslanding.js"></script>

  </head>
  <body>
    <?php require("php/retd.php");?>
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">
        <?php print_r("Welcome " .$_SESSION['name']);?><br>
        Purchase Contract Information: <? echo $_SESSION['address']; ?>
        <?php
        /*
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " deal id: " .$_SESSION['deal_id'];
        echo " user view buyer:seller, created, sent " .$_SESSION['userview'];
        */
         ?>
      </h2>
    </div>
<!---   NAVbar   ___________________________________________ -->
    <ul class="nav nav-pills">
      <li class="nav-item">
                      <form action="php/retd.php"  method="post">
              <input type="hidden" name="reload" value="logout"/>
              <button class="btn btn-outline-primary" type="submit" href="https://landing.azrealestatehelper.com">Home</button></form>
      </li>
      <li class="nav-item">
        <a class="nav-link">Property</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Contract</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="https://www.confirm.azrealestatehelper.com">Confirm</a>
      </li>
    </ul>


    <div class="container p-5 my-5 border">
        <form action="php/generate.php"  method="get" >
      <h1>Property Summary</h1>
     
        <li class="list-group-item">Buyer name: <input type="text" class="d-inline-flex bd-highlight" id="Buyer1" value="<?php echo $_SESSION['buyer1']?>" name="buyer1" required></li>
        <li class="list-group-item">Second Buyer name: <input type="text" class="d-inline-flex bd-highlight" id="Buyer2" value="<?php echo $_SESSION['buyer2']?>" name="buyer2" ></li>
        <li class="list-group-item">Seller name: <input type="text" class="d-inline-flex bd-highlight" id="Seller1" value="<?php echo $_SESSION['seller1'];?>" name="seller1" required></li>
        <li class="list-group-item">Seller name: <input type="text" class="d-inline-flex bd-highlight" id="Seller2" value="<?php echo $_SESSION['seller2'];?>" name="seller2" ></li>
        <li class="list-group-item">Address: <input type="text" class="d-inline-flex bd-highlight" id="address" value="<?php echo $_SESSION['address'];?>" name="address" ></li>
        <li class="list-group-item">City: <input type="text" class="d-inline-flex bd-highlight" id="city" value="<?php echo $_SESSION['city'];?>" name="city" ></li>
        <li class="list-group-item">County: <input type="text" class="d-inline-flex bd-highlight" id="county" value="<?php echo $_SESSION['county'];?>" name="county" ></li>
        <li class="list-group-item">Zip: <input type="text" class="d-inline-flex bd-highlight" id="zip" value="<?php echo $_SESSION['zip'];?>" name="zip" ></li>
        <li class="list-group-item">Assessornum: <input type="text" class="d-inline-flex bd-highlight" id="assessornum" value="<?php echo $_SESSION['assessornum'];?>" name="assessornum" ></li>
        <li class="list-group-item">Legal Discription: <input type="text" class="d-inline-flex bd-highlight" id="legaldisc" value="<?php echo $_SESSION['legaldisc'];?>" name="legaldisc" ></li>
        <li class="list-group-item">Year Built: <input type="number" class="d-inline-flex bd-highlight" id="yearbuilt" value="<?php echo $_SESSION['yearbuilt'];?>" name="yearbuilt" ></li>

        <?php
            if($_SESSION['sewer'] == 1){
              echo "<li class='list-group-item'><b>Wastewater:</b><div class='form-check'>
                <input type='radio' class='form-check-input' id='sewer' name='wastewater' value='Sewer' checked>
                <label class='form-check-label' for='radio1'>Sewer</label>
              </div>

              <div class='form-check'>
                <input type='radio' class='form-check-input' id='septic' name='wastewater' value='Septic'>
                <label class='form-check-label' for='radio2'>Septic</label>
              </div></li>";
            } else {
              echo "<li class='list-group-item'><b>Wastewater:</b><div class='form-check'>
                <input type='radio' class='form-check-input' id='sewer' name='wastewater' value='Sewer'>
                <label class='form-check-label' for='radio1'>Sewer</label>
              </div>

              <div class='form-check'>
                <input type='radio' class='form-check-input' id='septic' name='wastewater' value='Septic' checked>
                <label class='form-check-label' for='radio2'>Septic</label>
              </div></li>";
            }

         ?><br>
      
      

    
        <h1>Purchase Contract Summary</h1>
        <li class="list-group-item">Purchase Price: $<input type="number" class="d-inline-flex bd-highlight" id="purchaseprice" value="<?php echo $_SESSION['purchaseprice'];?>" name="purchaseprice" ></li>
        <li class="list-group-item">Earnest Money: $<input type="number" class="d-inline-flex bd-highlight" id="earnestmoney" value="<?php echo $_SESSION['earnestmoney'];?>" name="earnestmoney" ></li>
        <li class="list-group-item">Additional Down Payment: $<input type="number" class="d-inline-flex bd-highlight" id="additionaldown" value="<?php echo $_SESSION['additionaldown'];?>" name="additionaldown" ></li>
        <li class="list-group-item">Financed Amount: $<input type="number" class="d-inline-flex bd-highlight" id="financed" value="<?php echo $_SESSION['financed'];?>" name="financed" ></li>

        <?php
            if($_SESSION['earnestmoneyform'] == "Wire"){
        echo '<li class="list-group-item"><b>Earnest money will be sent by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Check" >
          <label class="form-check-label" for="radio1">Check</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Wire" checked>
          <label class="form-check-label" for="radio2">Wire</label>
        </div></li>';
      }else{
        echo '<li class="list-group-item"><b>Earnest money will be sent by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Check" checked>
          <label class="form-check-label" for="radio1">Check</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Wire">
          <label class="form-check-label" for="radio2">Wire</label>
        </div></li>';
      }

      if($_SESSION['earnestmoneyheld'] == "Escrow"){
        echo '<li class="list-group-item"><b>Earnest money will be held by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld" name="earnestmoneyheld" value="Escrow" checked>
          <label class="form-check-label" for="radio1">Escrow Company</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld" name="earnestmoneyheld" value="Broker">
          <label class="form-check-label" for="radio2">Broker</label>
        </div></li>';
      }else{
        echo '<li class="list-group-item"><b>Earnest money will be held by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld" name="earnestmoneyheld" value="Escrow" >
          <label class="form-check-label" for="radio1">Escrow Company</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld" name="earnestmoneyheld" value="Broker" checked>
          <label class="form-check-label" for="radio2">Broker</label>
        </div></li>';
      }
      ?>

      <li class="list-group-item">Close of Escrow Date: <input type="date" class="form-control" id="coedate" name="coedate" value="<?php echo $_SESSION['coedate'];?>"></li>
      <li class="list-group-item">
      <h5>Addenda:</h5>
    <input type="hidden" name="buyercontingency" value=0 />
      <input type="checkbox" class="form-check-input" id="buyercontingency" name="buyercontingency" value=1 <?php echo $_SESSION['buyercontingencycheck']; ?>>
      <label class="form-check-label" for="buyercontingency">Buyer Contingency</label>
    <input type="hidden" name="Waterwell" value=0 />
      <input type="checkbox" class="form-check-input" id="Waterwell" name="waterwell" value=1 <?php echo $_SESSION['waterwellcheck']; ?>>
      <label class="form-check-label" for="waterwell">Waterwell</label>

    <input type="hidden" name="hoa" value=0 />
      <input type="checkbox" class="form-check-input" id="hoa" name="hoa" value=1 <?php echo $_SESSION['hoacheck']; ?>>
      <label class="form-check-label" for="hoa">HOA</label>

    <input type="hidden" name="loanassuption" value=0 />
      <input type="checkbox" class="form-check-input" id="loanassuption" name="loanassuption" value=1 <?php echo $_SESSION['loanassuptioncheck']; ?>>
      <label class="form-check-label" for="loanassuption">Loan Assumption</label>
    <input type="hidden" name="sellerfinancing" value=0 />
      <input type="checkbox" class="form-check-input" id="sellerfinancing" name="sellerfinancing" value=1 <?php echo $_SESSION['sellerfinancingcheck']; ?>>
      <label class="form-check-label" for="sellerfinancing">sellerfinancing</label>
      
    <input type="hidden" name="shortsale" value=0 />
      <input type="checkbox" class="form-check-input" id="shortsale" name="shortsale" value=1 <?php echo $_SESSION['shortsalecheck']; ?>>
      <label class="form-check-label" for="shortsale">Short Sale</label>

    <input type="hidden" name="other" value=0 />
      <input type="checkbox" class="form-check-input" id="other" name="other" value=1 <?php echo $_SESSION['othercheck']; ?>>
      <label class="form-check-label" for="other">Other Addenda</label>
      </li>
      <li class="list-group-item">
      <h5>Personal Property to be Included:</h5>

    <input type="hidden" name="refrigerator" value=0 />
      <input type="checkbox" class="form-check-input" id="refrigerator" name="refrigerator" value=1 <?php echo $_SESSION['refrigeratorcheck']; ?>>
      <label class="form-check-label" for="refrigerator">Refrigerator</label>

    <input type="hidden" name="washer" value=0 />
      <input type="checkbox" class="form-check-input" id="washer" name="washer" value=1  <?php echo $_SESSION['washercheck']; ?>>
      <label class="form-check-label" for="washer">Washer</label>

    <input type="hidden" name="dryer" value=0 />
      <input type="checkbox" class="form-check-input" id="dryer" name="dryer" value=1 <?php echo $_SESSION['dryercheck']; ?>>
      <label class="form-check-label" for="dryer">Dryer</label>

    <input type="hidden" name="spa" value=0 />
      <input type="checkbox" class="form-check-input" id="spa" name="spa" value=1 <?php echo $_SESSION['spacheck']; ?>>
      <label class="form-check-label" for="spa">Spa</label>
      </li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-form bd-highlight" id="personalprop" value="<?php echo $_SESSION['personalprop'];?>" name="personalprop" ></li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-flex bd-highlight" id="personalprop2" value="<?php echo $_SESSION['personalprop2'];?>" name="personalprop2" ></li>
      <li class="list-group-item">Date Toured: <input type="date" class="d-inline-flex bd-highlight" id="tour" value="<?php if(isset($_SESSION['tour'])){echo $_SESSION['tour'];}else{echo "";};?>" name="tour" ></li>
    <li class="list-group-item">
      <h5>Your Purchase Will Use:</h5>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="Cash" <?php echo $_SESSION['cash']?>>
      <label class="form-check-label" for="radio0">Cash</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="Conventional" <?php echo $_SESSION['conventional']?>>
      <label class="form-check-label" for="radio1">Conventional</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="FHA" <?php echo $_SESSION['fha']?>>
      <label class="form-check-label" for="radio1">FHA</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="VA" <?php echo $_SESSION['va']?>>
      <label class="form-check-label" for="radio1">VA</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="USDA" <?php echo $_SESSION['usda']?>>
      <label class="form-check-label" for="radio1">USDA</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="Assumption" <?php echo $_SESSION['assumption']?>>
      <label class="form-check-label" for="radio1">Assumption</label>

      <input type="radio" class="form-check-input" id="financingtype" name="financingtype" value="Seller Carryback" <?php echo $_SESSION['sellercarryback']?>>
      <label class="form-check-label" for="radio1">Seller Carryback</label>
    </li>
    <li class="list-group-item">
      <h5>Seller Consessions Requested:</h5>

      <input type="number" class="form-control" id="sellerconsessions" placeholder="Seller Consessions $" name="sellerconsessions" value="<?php echo $_SESSION['sellerconsessionsdollar']?>">
    </li>
    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Ordered By:</h5>

      <input type="checkbox" class="form-check-input" id="homewarrantyorderedby" name="homewarrantyorderedby" value="Buyer" <?php echo $_SESSION['homewarrantyorderedbybuyercheck']; ?>>
      <label class="form-check-label" for="homewarrantyorderedby">Buyer</label>

      <input type="checkbox" class="form-check-input" id="homewarrantyorderedby" name="homewarrantyorderedby" value="Seller" <?php echo $_SESSION['homewarrantyorderedbysellercheck']; ?>>
      <label class="form-check-label" for="homewarrantyorderedby">Seller</label>
    </li>

    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Paid By:</h5>
      <input type="checkbox" class="form-check-input" id="homewarrantypaidby" name="homewarrantypaidby" value="Buyer" <?php echo $_SESSION['homewarrantypaidbybuyercheck']; ?>>
      <label class="form-check-label" for="radio1">Buyer</label>

      <input type="checkbox" class="form-check-input" id="homewarrantypaidby" name="homewarrantypaidby" value="Seller" <?php echo $_SESSION['homewarrantypaidbysellercheck']; ?>>
      <label class="form-check-label" for="radio2">Seller</label>
    </li>
    <li class="list-group-item">
      <h5>Any Additional Terms:</h5>
      <input type="text" class="form-control" name="additionalterms" placeholder="Additional Terms" value="<?php echo $_SESSION['additionalterms']; ?>">
    </li>
    <li class="list-group-item">
      <h5>Seller Must Respond By: </h5>
      <input type="datetime-local" class="form-control" id="accepttime" name="accepttime" value=<?php $date = date_create($_SESSION['accepttime']);  echo date_format($date, "Y-m-d\TH:i:s");?>>
    </li>
      <h1>The Seller Does <?php echo $_SESSION['agentmessage'] ?></h1>

      <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="collapse" data-bs-target="#demo" >Seller Agent</button>
        <div id="demo" class="collapse <?php echo $_SESSION['agentbutton'] ?>">
          <li class="list-group-item">Agent Name: <input type="text" class="d-inline-flex bd-highlight" id="agentname" value="<?php echo $_SESSION['agentname'];?>" name="agentname" ></li>
          <li class="list-group-item">Agent Email: <input type="text" class="d-inline-flex bd-highlight" id="agentemail" value="<?php echo $_SESSION['agentemail'];?>" name="agentemail" ></li>
          <li class="list-group-item">Agent Liscence: <input type="number" class="d-inline-flex bd-highlight" id="agentlicense" value="<?php echo $_SESSION['agentlicense'];?>" name="agentlicense" ></li>
          <li class="list-group-item">Additional Agent Name: <input type="text" class="d-inline-flex bd-highlight" id="agentname2" value="<?php echo $_SESSION['agentname2'];?>" name="agentname2" ></li>
          <li class="list-group-item">Additional Agent Liscence: <input type="number" class="d-inline-flex bd-highlight" id="agentlicense2" value="<?php echo $_SESSION['agentlicense2'];?>" name="agentlicense2" ></li>
          <li class="list-group-item">Agent's Firm: <input type="text" class="d-inline-flex bd-highlight" id="firmname" value="<?php echo $_SESSION['firmname'];?>" name="firmname" ></li>
          <li class="list-group-item">Agent's Firm Address: <input type="text" class="d-inline-flex bd-highlight" id="firmaddress" value="<?php echo $_SESSION['firmaddress'];?>" name="firmaddress" ></li>
          <li class="list-group-item">Agent's Firm Phone: <input type="text" class="d-inline-flex bd-highlight" id="firmphone" value="<?php echo $_SESSION['firmphone'];?>" name="firmphone" ></li>
          <li class="list-group-item">Agent's Firm Liscence: <input type="text" class="d-inline-flex bd-highlight" id="firmlicense" value="<?php echo $_SESSION['firmlicense'];?>" name="firmlicense" ></li>
        </div>
    <br><button type="submit" name="savechanges" class="btn btn-primary btn-sm" >Save Changes</button><br>
    <br><button type="submit" name="create" class="btn btn-primary">Download Contract</button><br>
    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
  Submit Offer to Selling Party
    </button>
    
    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Send Offer To:</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
              <li class="list-group-item">Agent Email: <input type="text" class="d-inline-flex bd-highlight" value="<?php echo $_SESSION['agentemail'];?>" ></li>And/Or
              <li class="list-group-item">Seller Email: <input type="text" class="d-inline-flex bd-highlight" name="selleremail"></li>
              
            <button type="submit" name="sendcontract" value="1" class="btn btn-primary btn-lg">Submit Offer to Seller</button>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
    </div>


</form>

  
        <div class="footer">
          <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-outline-danger" type="submit">Logout</button></form>
        </div></div>
    <script src="js/jslanding.js"></script>
  </body>
</html>
