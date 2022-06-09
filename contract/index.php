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

    <title>Contract Page</title>
    <link rel="apple-touch-icon" sizes="180x180" href="//azrealestatehelper.com/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="//azrealestatehelper.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//azrealestatehelper.com/favicon/favicon-16x16.png">
    <link rel="manifest" href="//azrealestatehelper.com/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jslanding.js"></script>
    <script> $.getJSON('index.php', function(data){
             console.log(data.contract);
             console.log(data.id);
           });</script>
  </head>
  <h1 style="display:none">
      <?php 
      $usrchk = new \stdClass();
        $usrchk->success = false;
        $usrchk->id = $_SESSION['user_id'];
        $usrchk->contract = $_SESSION['contract'];
        $myJSON = json_encode($usrchk);
        echo (json_encode($usrchk));
        include 'php/retd.php';
?>
  </h1>
  <body>
    
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">
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

    <title>Contract Page</title>
    <link rel="apple-touch-icon" sizes="180x180" href="//azrealestatehelper.com/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="//azrealestatehelper.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//azrealestatehelper.com/favicon/favicon-16x16.png">
    <link rel="manifest" href="//azrealestatehelper.com/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jslanding.js"></script>
    <script> $.getJSON('index.php', function(data){
             console.log(data.contract);
             console.log(data.id);
           });</script>
  </head>
  <h1 style="display:none">
      <?php 
      $usrchk = new \stdClass();
        $usrchk->success = false;
        $usrchk->id = $_SESSION['user_id'];
        $usrchk->contract = $_SESSION['contract'];
        $myJSON = json_encode($usrchk);
        echo (json_encode($usrchk));
        include 'php/retd.php';
?>
  </h1>
  <body>
    
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">

        <?php print_r("Welcome " .$_SESSION['name']);?><br>
        Purchase Contract for: <? echo $_SESSION['address']; ?>
        <?php
        /*
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " session yearbuilt: " .$_SESSION['yearbuilt'];
        echo " session createname: " .$_SESSION["createname"];
         */
         ?>
      </h2>
    </div>
<!---   NAVbar   ___________________________________________ -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link " href="https://www.azrealestatehelper.com">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.newpurchase.azrealestatehelper.com">Property</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="https://www.contract.azrealestatehelper.com" >Contract</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Confirm</a>
      </li>
      <li class="nav-item">
      <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-outline-danger btn-sm mt-2" type="submit">Logout</button></form>
      </li>      
    </ul>

<form action="php/retd.php"  method="get" id="form0" class="m-1">
    <div class="shadow col-sm-12 m-1 p-3 bg-transparent text-dark border border border-primary rounded">
    <div class="mb-3 mt-3">
        
    <!--ARE YOU THE BUYER AGENT OR BUYER THEN ASK FOR AGENT DETAILS AND CREATE NEW AGENT AND TIE IT TO CONTRACT-->
    
    <div class="form-check">
      <input class="form-check-input" type="radio" name="buyeragent" id="buyeragent">
      <label class="form-check-label" for="buyeragent">
        I don't have an agent <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent Help" data-bs-content="Call or Text 000-000-0000 ">I want agent representation
        </button>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="buyeragent" id="buyeragent1" >
      <label class="form-check-label" for="buyeragent1">
        I am the buyer agent
         <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal">
              Agent Details
            </button>
          <div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="agentModalLabel">Buyer Agent Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
          <div class="mb-3 mt-3">
                <label for="buyeragentname" class="form-label">Agent Full Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyeragentname1" placeholder="Enter Agent Name*" name="buyeragentname">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyeragentemail" class="form-label">Agent Email:
                </label>
                <input type="email" class="form-control rounded-pill" id="buyeragentemail" placeholder="Enter Agent Email" name="buyeragentemail">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Agent License Number:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyeragentlicense1" placeholder="Enter Agent License" name="buyeragentlicense">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyeragentname2" class="form-label">Additional Agent Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyeragentname2" placeholder="Enter Agent Name" name="buyeragentname2">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyeragentlicense" class="form-label">Additional Agent License Number:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyeragentlicense2" placeholder="Enter Agent License" name="buyeragentlicense2">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyerfirmname" class="form-label">Agent's Firm Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyerfirmname" placeholder="Enter Brokerage Name" name="buyerfirmname">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyerfirmaddress" class="form-label">Agent's Firm Address:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyerfirmaddress" placeholder="Enter Brokerage Address" name="buyerfirmaddress">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyerfirmphone" class="form-label">Broker Firm Phone Number:
                </label>
                <input type="tel" class="form-control rounded-pill" id="buyerfirmphone" placeholder="Enter Brokerage Phone Number" name="buyerfirmphone">
              </div>

              <div class="mb-3 mt-3">
                <label for="buyerfirmlicense" class="form-label">Agent's Firm Liscense:
                </label>
                <input type="text" class="form-control rounded-pill" id="buyerfirmlicense1" placeholder="Enter Brokerage License Number" name="buyerfirmlicense">
              </div>
             </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
                  </div>
                </div>
              </div>
            </div>
        
        
        
      </label>
    </div>
    </div>
    <div class="mb-3 mt-3">
      <label for="Buyer" class="form-label">Buyer:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Buyer Name" data-bs-content="Buyer legal name, enter additional buyers in the Additional Buyer space below">Help
        </button>
      </label>
      <input type="text" class="form-control rounded-pill" id="Buyer1" placeholder="Enter Buyer Name*" name="buyer1" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="Buyer2" class="form-label">Additional Buyer:</label>
      <input type="text" class="form-control rounded-pill" id="Buyer2" placeholder="Enter Additional Buyer Name" name="buyer2">
    </div>

    <div class="mb-3 mt-3">
      <label for="purchaseprice" class="form-label">Full Purchase Price:
        <button type="button" class="btn btn-primary btn-sm" id="test2" data-bs-toggle="popover" data-bs-trigger="focus" title="Full Purchase Price" data-bs-content="Enter the full purchase price, if you don't know what to offer call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="purchaseprice" placeholder="Enter Full Purchase Price*" name="purchaseprice" required>
    </div>
    
        <div class="mb-3 mt-3">
      <label for="financed" class="form-label">Financed Amount:
        <button type="button" class="btn btn-primary btn-sm" id="buttonfinanced" data-bs-toggle="popover" data-bs-trigger="focus" title="Financed" data-bs-content="The financed amount will be the purchase price, minus your total down payment(Earnest money + Additional Down). Consult with your mortgage broker and finacial advisor for advice.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="financed" placeholder="Enter financed amount ex: $500,000" name="financed" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="earnestmoney" class="form-label">Earnest Money Deposit:
        <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoney" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Deposit" data-bs-content="This deposit shows you are serious about buying.  If you cancel this contract for any reason outside of the contingencies you will lose this money.  1% of the full purchase price is a good starting point depending on market conditions.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="earnestmoney" placeholder="Enter Earnest Money Deposit ex: $6000.00*" name="earnestmoney" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="additionaldown" class="form-label">Additional Downpayment:
        <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoney1" data-bs-toggle="popover" data-bs-trigger="focus" title="Additional Downpayment" data-bs-content="The down payment also shows you are serious about buying. The total down payment will include the earnest money so remember to not include that here. If you are paying all cash, this will be the total purchase price minus your earnest money.  All-cash offers will are expected to include a funding letter.  Consult with your mortgage broker for advice.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="additionaldown" placeholder="Additional Downpayment (subtact earnest money from total down payment)*" name="additionaldown" required>
    </div>



    Earnest Money Form:
    <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoneyform" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Form" data-bs-content="The earnest money must be deposited upon acceptance of this contract. Contact an Escrow company for help.  call: or email: for help">Help
    </button>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Check" checked>
      <label class="form-check-label" for="radio1">Check</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyform1" name="earnestmoneyform" value="Wire">
      <label class="form-check-label" for="radio2">Wire</label>
    </div>

    Earnest Money Held:
    <button type="button" class="btn btn-primary btn-sm" id="earnestmoneyheld" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Held" data-bs-content="The earnest money must be deposited here. Typically at the Escrow company.  call: or email: for help">Help
    </button>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyheld1" name="earnestmoneyheld" value="Escrow" checked>
      <label class="form-check-label" for="radio1">Escrow Company</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyheld2" name="earnestmoneyheld" value="Broker">
      <label class="form-check-label" for="radio2">Broker</label>
    </div>

    <div class="mb-3 mt-3">
      <label for="coedate" class="form-label">Close of Escrow Date:
        <button type="button" class="btn btn-primary btn-sm" id="coedate" data-bs-toggle="popover" data-bs-trigger="focus" title="Close of Escrow Date" data-bs-content="If any of the following apply you will need to include an addenda.  call: or email: for help">Help
        </button>
      </label>
      <input type="date" class="form-control rounded-pill" id="coedate1" name="coedate" required>
    </div>

    Addenda Incorporated:
    <button type="button" class="btn btn-primary btn-sm" id="addenda" data-bs-toggle="popover" data-bs-trigger="focus" title="Addenda Incorporated" data-bs-content="This is the closing day for the purchase, typically 30 days from contract submission. Consult with your mortgage broker to make sure they can finance the property by this date.  call: or email: for help">Help
    </button>
        <div class="form-check">
          <input type="hidden" name="buyercontingency" value=0 />
          <input type="checkbox" class="form-check-input" id="buyercontingency" name="buyercontingency" value=1>
          <label class="form-check-label" for="buyercontingency">Buyer Contingency</label>
          <button type="button" class="btn btn-primary btn-sm" id="buyercontingency1" data-bs-toggle="popover" data-bs-trigger="focus" title="Buyer Contingency" data-bs-content="Check here if this purchase is contingent on your current poperty closing.  This will make your offer substantially weaker.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="waterwell" value=0 />
          <input type="checkbox" class="form-check-input" id="waterwell" name="waterwell" value=1>
          <label class="form-check-label" for="waterwell">Waterwell</label>
          <button type="button" class="btn btn-primary btn-sm" id="waterwell1" data-bs-toggle="popover" data-bs-trigger="focus" title="Waterwell" data-bs-content="Check here if your property has a water well, this is not common.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="hoa" value=0 />
          <input type="checkbox" class="form-check-input" id="hoa" name="hoa" value=1>
          <label class="form-check-label" for="hoa">HOA</label>
          <button type="button" class="btn btn-primary btn-sm" id="hoa1" data-bs-toggle="popover" data-bs-trigger="focus" title="HOA" data-bs-content="Check here if your property is in an HOA(Home Owners Association).  This is common in Arizona.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="loanassuption" value=0 />
          <input type="checkbox" class="form-check-input" id="loanassuption" name="loanassuption" value=1>
          <label class="form-check-label" for="loanassuption">loan assumtion</label>
          <button type="button" class="btn btn-primary btn-sm" id="loanassuption1" data-bs-toggle="popover" data-bs-trigger="focus" title="Loan Assumtion" data-bs-content="Check here if you plan on assuming an exsisting loan.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="sellerfinancing" value=0 />
          <input type="checkbox" class="form-check-input" id="sellerfinancing" name="sellerfinancing" value=1>
          <label class="form-check-label" for="sellerfinancing">Seller Financing</label>
          <button type="button" class="btn btn-primary btn-sm" id="sellerfinancing1" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Financing" data-bs-content="Check here if you plan on using seller financing.  A seller will typically offer this in a listing, it is not common.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="shortsale" value=0 />
          <input type="checkbox" class="form-check-input" id="shortsale" name="shortsale" value=1>
          <label class="form-check-label" for="shortsale">Short Sale</label>
          <button type="button" class="btn btn-primary btn-sm" id="shortsale1" data-bs-toggle="popover" data-bs-trigger="focus" title="Short Sale" data-bs-content="Check here if the property is offered as a short sale.  The seller will indicate this in the listing.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="other" value=0 />
          <input type="checkbox" class="form-check-input" id="other" name="other" value=1>
          <label class="form-check-label" for="other">Other</label>
          <button type="button" class="btn btn-primary btn-sm" id="other1" data-bs-toggle="popover" data-bs-trigger="focus" title="Other" data-bs-content="Check here if you have any other addenda.  call: or email: for help">?
          </button>
        </div>

    Additional Personal Property Included:

      <button type="button" class="btn btn-primary btn-sm" id="other2" data-bs-toggle="popover" data-bs-trigger="focus" title="Other" data-bs-content="Check listing to see what the seller is offering.  Make sure you document the property when you tour(pictures are helpful).   call: or email: for help">Help
      </button>

      <div class="form-check">
        <input type="hidden" name="refrigerator" value=0 />
        <input type="checkbox" class="form-check-input" id="refrigerator" name="refrigerator" value=1>
        <label class="form-check-label" for="refrigerator">Refrigerator</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="washer" value=0 />
        <input type="checkbox" class="form-check-input" id="washer" name="washer" value=1>
        <label class="form-check-label" for="washer">Washer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="dryer" value=0 />
        <input type="checkbox" class="form-check-input" id="dryer" name="dryer" value=1>
        <label class="form-check-label" for="dryer">Dryer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="spa" value=0 />
        <input type="checkbox" class="form-check-input" id="spa" name="spa" value=1>
        <label class="form-check-label" for="spa">Spa</label>
      </div>
      <div class="mb-1 mt-0">
        <input type="hidden" name="personalprop" value=0 />
        <label for="personalprop" class="form-label"></label>
        <input type="text" class="form-control rounded-pill" id="personalprop" placeholder="Other Personal Property:" name="personalprop">
      </div>
      <div class="mb-1 mt-0">
        <input type="hidden" name="personalprop2" value=0 />
        <label for="personalprop2" class="form-label"></label>
        <input type="text" class="form-control rounded-pill" id="personalprop2" placeholder="Other Personal Property:" name="personalprop2">
      </div>
      <div class="mb-3 mt-3">
        <label for="coedate" class="form-label">Date Toured:
          <button type="button" class="btn btn-primary btn-sm" id="tour" data-bs-toggle="popover" data-bs-trigger="focus" title="Date Toured" data-bs-content="Date you toured the property, if this is site unseen leave blank(Not Recommended).  call: or email: to set up a showing">?
          </button>
        </label>
        <input type="date" class="form-control rounded-pill" id="tour1" name="tour">
      </div>


      Type of Financing:
      <button type="button" class="btn btn-primary btn-sm" id="financingtype" data-bs-toggle="popover" data-bs-trigger="focus" title="Type of Financing" data-bs-content="Consult with your mortgage company.  call: or email: for help">Help
      </button>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype1" name="financingtype" value="Cash">
        <label class="form-check-label" for="radio0">Cash</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype2" name="financingtype" value="Conventional">
        <label class="form-check-label" for="radio1">Conventional</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype3" name="financingtype" value="FHA">
        <label class="form-check-label" for="radio2">FHA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype4" name="financingtype" value="VA">
        <label class="form-check-label" for="radio3">VA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype5" name="financingtype" value="USDA">
        <label class="form-check-label" for="radio3">USDA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype6" name="financingtype" value="Assumption">
        <label class="form-check-label" for="radio3">Assumption</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype7" name="financingtype" value="Seller Carryback">
        <label class="form-check-label" for="radio3">Seller Carryback</label>
      </div>


      <label for="Buyer" class="form-label">Seller Consessions: $
        <button type="button" class="btn btn-primary btn-sm" id="sellerconsessions" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Consessions" data-bs-content="You can ask for the seller to pay for a portion of the closing costs.  This will weaken your offer, amount is typically a small percentage of the purchase price.  ex: 2%.  call: or email: for help">Help
      </button>
      </label>
      <div class="form-check">
          <input type="hidden" name="sellerconsessions" value=0 />
          <input type="number" class="form-control rounded-pill" id="sellerconsessions1" value=0 placeholder="Seller Consessions $" name="sellerconsessions">
      </div>

      Home Warranty Plan Ordered By:
      <button type="button" class="btn btn-primary btn-sm" id="homewarrantyorderedby" data-bs-toggle="popover" data-bs-trigger="focus" title="Home Warranty Plan Ordered By" data-bs-content="A home warranty typically covers essential home systems and appliances issues, it is fairly common.  Buyers who don't ask sellers to order will likely be veiwed as more serious, this is optional.  call: or email: for help">Help
      </button>
      <div class="form-check">
        <input type="hidden" name="homewarrantyorderedby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantyorderedby1" name="homewarrantyorderedby" value="Buyer">
        <label class="form-check-label" for="radio1">Buyer</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="homewarrantyorderedby2" name="homewarrantyorderedby" value="Seller">
        <label class="form-check-label" for="radio2">Seller</label>
      </div>

      Home Warranty Plan Paid By:
      <button type="button" class="btn btn-primary btn-sm" id="homewarrantypaidby1" data-bs-toggle="popover" data-bs-trigger="focus" title="Home Warranty Plan Paid By" data-bs-content="Asking the seller to pay for this will weaken your offer.  call: or email: for help">Help
      </button>
      <div class="form-check">
        <input type="hidden" name="homewarrantypaidby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantypaidby" name="homewarrantypaidby" value="Buyer">
        <label class="form-check-label" for="radio1">Buyer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="homewarrantypaidby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantypaidby2" name="homewarrantypaidby" value="Seller">
        <label class="form-check-label" for="radio2">Seller</label>
      </div>

      <div class="input-group mb-3 mt-3">
      <div class="input-group-text">
        <input type="radio" name="additionalterms" value=1>
        </div>
        <input type="text" class="form-control rounded-pill" name="additionalterms"placeholder="Additional Terms">
      </div>

      <div class="mb-3 mt-3">
        <label for="coedate" class="form-label">Seller Acceptance Deadline:
          <button type="button" class="btn btn-primary btn-sm" id="accepttime" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Acceptance Deadline" data-bs-content="The seller must respond by this time or this contract will become null.  24-48 hours is typical, however some sellers specify this in the listing.  call: or email: for help">Help
          </button>
        </label>
        <input type="datetime-local" class="form-control rounded-pill" id="accepttime1" name="accepttime" required>
      </div>

      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="collapse" data-bs-target="#demo">Seller Agent</button>
        <div id="demo" class="collapse">
        If there is no seller agent leave blank(For Sale By Owner)
              <div class="mb-3 mt-3">
                <label for="agentname" class="form-label">Agent Full Name:
                  <button type="button" class="btn btn-primary btn-sm" id="agentname" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent Full Name" data-bs-content="Agent full name, this will be found in the listing">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname1" placeholder="Enter Agent Name*" name="agentname">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentemail" class="form-label">Agent Email:
                </label>
                <input type="email" class="form-control rounded-pill" id="agentemail" placeholder="Enter Agent Email" name="agentemail">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Agent License Number:
                  <button type="button" class="btn btn-primary btn-sm" id="agentlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent License Number" data-html="true" data-bs-content="The Agent's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchIndividuals.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense1" placeholder="Enter Agent License" name="agentlicense">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentname2" class="form-label">Additional Agent Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname2" placeholder="Enter Agent Name" name="agentname2">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Additional Agent License Number:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense2" placeholder="Enter Agent License" name="agentlicense2">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmname" class="form-label">Agent's Firm Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmname" placeholder="Enter Brokerage Name" name="firmname">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmaddress" class="form-label">Agent's Firm Address:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmaddress" placeholder="Enter Brokerage Address" name="firmaddress">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmphone" class="form-label">Broker Firm Phone Number:
                </label>
                <input type="tel" class="form-control rounded-pill" id="firmphone" placeholder="Enter Brokerage Phone Number" name="firmphone">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmlicense" class="form-label">Agent's Firm Liscense:
                  <button type="button" class="btn btn-primary btn-sm" id="firmlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Firm License Number" data-html="true" data-bs-content="The Brokerage Firm's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchEntities.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="firmlicense1" placeholder="Enter Brokerage License Number" name="firmlicense">
              </div>

        </div>
      

      <br>
      
  <button  type="submit" class="btn btn-primary btn-lg" id="usrreq">Confirm Offer</button>

</form>


<div id="new">
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="usermodal" data-bs-target="#myModal">
  Continue
</button>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Offer</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <div class="row">
                      <div class="col">
                    <div class="container p-2 my-3 border">
                        <div id="IncorrectPass2" style="color:red"></div>
                                <div class="hideform">
                        <form  action="php/retd.php" method="post" id="form2">
                          <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                          </div>
                          <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                          </div>
                          <button type="submit" class="btn btn-primary">Log In</button>
                        </form>
                    </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" id="resetbutton1" data-bs-target="#demo1">Reset Password</button>
                          <div id="demo1" class="collapse">
                                        <form action="php/retd.php" method="post" id="form3"> <button name="sendkey" type="submit" id="sendkey" value="sendit!" class="btn btn-outline-primary btn-sm">Send Key to reset password</button></h4>
        
          
         
                      
                    <div class="container p-1 my-1 border">
                       <h5 id="badkey" style="color:red; display:none">
                           Incorrect Key, please use the last key sent to your email
                       </h5>
                        
                          <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control"  value="<? echo $_SESSION['email']?>" name="email" required>
                          </div>
                          <div class="mb-3" id="resetket" style="display:none">
                            <label for="pwd"  class="form-label">Key:</label>
                            <input type="password" class="form-control" placeholder="Enter key sent to your email: " name="sentkey"  >
                          
                          <button type="submit" id="resetbutton" value="inputkey"  name="key" class="btn btn-primary">Reset Password</button>
                        </form></div>
                        <div id="CreatePassword" style="display:none">
                        <form action="php/retd.php" method="post" id="form5">
                                      <div class="mb-3" >
                            <div id="matchingerror2" style="color:red"></div>
                            <label for="pwd" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="createpwd3" placeholder="Enter password" name="createpswd" required>
                              </div>
                            <div class="mb-3">
                            <label for="pwd" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="createpwd4" placeholder="Enter password" name="createpswd2" required>
                          </div>
                            
                        <button type="submit" name="01" class="btn btn-primary">Create Password</button></form></div>
                    </div></div></div>
                         
                            

<!-- The Modal -->

    
</div>
                    </div><div class="hideform">
        <form action="php/retd.php" method="post" id="form1">
          <div class="mb-3 mt-3">
              <div id="matchingerror3" style="color:red"></div>
              <div id="emailexists" style="color:red"></div>
              
               <?php if($_SESSION['emailexists'] == 1){
                  echo '<button id="resetbutton" class="btn btn-outline-danger">An account already exists for this email address</button>';
                unset($_SESSION['emailexists']);
               
                }?>
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter legal name" name="createname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="newemail" placeholder="Enter email" name="createemail" required>
          </div>
          <div id="matchingerror" style="color:red"></div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="createpwd" placeholder="Enter password" name="createpswd" required>
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="createpwd2" placeholder="Enter password" name="createpswd2" required>
          </div>
          <button class="btn btn-primary"  onclick="submitForm1()">Create Account</button>
          </form>
      </div></div>
</div>
      <!-- Modal footer -->
      <div class="modal-footer">

      </div>

    </div>
    
  </div>
  
</div> 
    
</div>

        <div class="footer">
         
        </div>
    <script src="js/jslanding.js"></script>
  </body>
</html>

        <?php print_r("Welcome " .$_SESSION['name']);?><br>
        Purchase Contract for: <? echo $_SESSION['address']; ?>
        <?php
        /*
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " session yearbuilt: " .$_SESSION['yearbuilt'];
        echo " session createname: " .$_SESSION["createname"];
         */
         ?>
      </h2>
    </div>
<!---   NAVbar   ___________________________________________ -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link " href="https://www.azrealestatehelper.com">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.newpurchase.azrealestatehelper.com">Property</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="https://www.contract.azrealestatehelper.com" >Contract</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Confirm</a>
      </li>
      <li class="nav-item">
      <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-outline-danger btn-sm mt-2" type="submit">Logout</button></form>
      </li>      
    </ul>

<form action="php/retd.php"  method="get" id="form0" class="m-1">
    <div class="shadow col-sm-12 m-1 p-3 bg-transparent text-dark border border border-primary rounded">
    <div class="mb-3 mt-3">
        
    <!--ARE YOU THE BUYER AGENT OR BUYER THEN ASK FOR AGENT DETAILS AND CREATE NEW AGENT AND TIE IT TO CONTRACT-->
    
    <div class="form-check">
      <input class="form-check-input" type="radio" name="buyeragent" id="buyeragent">
      <label class="form-check-label" for="buyeragent">
        I don't have an agent <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent Help" data-bs-content="Call or Text 000-000-0000 ">I want agent representation
        </button>
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="buyeragent" id="buyeragent1" >
      <label class="form-check-label" for="buyeragent1">
        I am the buyer agent
         <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal">
              Agent Details
            </button>
          <div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="agentModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
          <div class="mb-3 mt-3">
                <label for="agentname" class="form-label">Agent Full Name:
                  <button type="button" class="btn btn-primary btn-sm" id="agentname" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent Full Name" data-bs-content="Agent full name, this will be found in the listing">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname1" placeholder="Enter Agent Name*" name="agentname">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentemail" class="form-label">Agent Email:
                </label>
                <input type="email" class="form-control rounded-pill" id="agentemail" placeholder="Enter Agent Email" name="agentemail">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Agent License Number:
                  <button type="button" class="btn btn-primary btn-sm" id="agentlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent License Number" data-html="true" data-bs-content="The Agent's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchIndividuals.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense1" placeholder="Enter Agent License" name="agentlicense">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentname2" class="form-label">Additional Agent Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname2" placeholder="Enter Agent Name" name="agentname2">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Additional Agent License Number:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense2" placeholder="Enter Agent License" name="agentlicense2">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmname" class="form-label">Agent's Firm Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmname" placeholder="Enter Brokerage Name" name="firmname">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmaddress" class="form-label">Agent's Firm Address:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmaddress" placeholder="Enter Brokerage Address" name="firmaddress">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmphone" class="form-label">Broker Firm Phone Number:
                </label>
                <input type="tel" class="form-control rounded-pill" id="firmphone" placeholder="Enter Brokerage Phone Number" name="firmphone">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmlicense" class="form-label">Agent's Firm Liscense:
                  <button type="button" class="btn btn-primary btn-sm" id="firmlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Firm License Number" data-html="true" data-bs-content="The Brokerage Firm's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchEntities.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="firmlicense1" placeholder="Enter Brokerage License Number" name="firmlicense">
              </div>
             </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save Changes</button>
                  </div>
                </div>
              </div>
            </div>
        
        
        
      </label>
    </div>
    </div>
    <div class="mb-3 mt-3">
      <label for="Buyer" class="form-label">Buyer:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Buyer Name" data-bs-content="Buyer legal name, enter additional buyers in the Additional Buyer space below">Help
        </button>
      </label>
      <input type="text" class="form-control rounded-pill" id="Buyer1" placeholder="Enter Buyer Name*" name="buyer1" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="Buyer2" class="form-label">Additional Buyer:</label>
      <input type="text" class="form-control rounded-pill" id="Buyer2" placeholder="Enter Additional Buyer Name" name="buyer2">
    </div>

    <div class="mb-3 mt-3">
      <label for="purchaseprice" class="form-label">Full Purchase Price:
        <button type="button" class="btn btn-primary btn-sm" id="test2" data-bs-toggle="popover" data-bs-trigger="focus" title="Full Purchase Price" data-bs-content="Enter the full purchase price, if you don't know what to offer call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="purchaseprice" placeholder="Enter Full Purchase Price*" name="purchaseprice" required>
    </div>
    
        <div class="mb-3 mt-3">
      <label for="financed" class="form-label">Financed Amount:
        <button type="button" class="btn btn-primary btn-sm" id="buttonfinanced" data-bs-toggle="popover" data-bs-trigger="focus" title="Financed" data-bs-content="The financed amount will be the purchase price, minus your total down payment(Earnest money + Additional Down). Consult with your mortgage broker and finacial advisor for advice.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="financed" placeholder="Enter financed amount ex: $500,000" name="financed" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="earnestmoney" class="form-label">Earnest Money Deposit:
        <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoney" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Deposit" data-bs-content="This deposit shows you are serious about buying.  If you cancel this contract for any reason outside of the contingencies you will lose this money.  1% of the full purchase price is a good starting point depending on market conditions.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="earnestmoney" placeholder="Enter Earnest Money Deposit ex: $6000.00*" name="earnestmoney" required>
    </div>

    <div class="mb-3 mt-3">
      <label for="additionaldown" class="form-label">Additional Downpayment:
        <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoney1" data-bs-toggle="popover" data-bs-trigger="focus" title="Additional Downpayment" data-bs-content="The down payment also shows you are serious about buying. The total down payment will include the earnest money so remember to not include that here. If you are paying all cash, this will be the total purchase price minus your earnest money.  All-cash offers will are expected to include a funding letter.  Consult with your mortgage broker for advice.  call: or email: for help">Help
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="additionaldown" placeholder="Additional Downpayment (subtact earnest money from total down payment)*" name="additionaldown" required>
    </div>



    Earnest Money Form:
    <button type="button" class="btn btn-primary btn-sm" id="buttonearnestmoneyform" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Form" data-bs-content="The earnest money must be deposited upon acceptance of this contract. Contact an Escrow company for help.  call: or email: for help">Help
    </button>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyform" name="earnestmoneyform" value="Check" checked>
      <label class="form-check-label" for="radio1">Check</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyform1" name="earnestmoneyform" value="Wire">
      <label class="form-check-label" for="radio2">Wire</label>
    </div>

    Earnest Money Held:
    <button type="button" class="btn btn-primary btn-sm" id="earnestmoneyheld" data-bs-toggle="popover" data-bs-trigger="focus" title="Earnest Money Held" data-bs-content="The earnest money must be deposited here. Typically at the Escrow company.  call: or email: for help">Help
    </button>
    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyheld1" name="earnestmoneyheld" value="Escrow" checked>
      <label class="form-check-label" for="radio1">Escrow Company</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="earnestmoneyheld2" name="earnestmoneyheld" value="Broker">
      <label class="form-check-label" for="radio2">Broker</label>
    </div>

    <div class="mb-3 mt-3">
      <label for="coedate" class="form-label">Close of Escrow Date:
        <button type="button" class="btn btn-primary btn-sm" id="coedate" data-bs-toggle="popover" data-bs-trigger="focus" title="Close of Escrow Date" data-bs-content="If any of the following apply you will need to include an addenda.  call: or email: for help">Help
        </button>
      </label>
      <input type="date" class="form-control rounded-pill" id="coedate1" name="coedate" required>
    </div>

    Addenda Incorporated:
    <button type="button" class="btn btn-primary btn-sm" id="addenda" data-bs-toggle="popover" data-bs-trigger="focus" title="Addenda Incorporated" data-bs-content="This is the closing day for the purchase, typically 30 days from contract submission. Consult with your mortgage broker to make sure they can finance the property by this date.  call: or email: for help">Help
    </button>
        <div class="form-check">
          <input type="hidden" name="buyercontingency" value=0 />
          <input type="checkbox" class="form-check-input" id="buyercontingency" name="buyercontingency" value=1>
          <label class="form-check-label" for="buyercontingency">Buyer Contingency</label>
          <button type="button" class="btn btn-primary btn-sm" id="buyercontingency1" data-bs-toggle="popover" data-bs-trigger="focus" title="Buyer Contingency" data-bs-content="Check here if this purchase is contingent on your current poperty closing.  This will make your offer substantially weaker.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="waterwell" value=0 />
          <input type="checkbox" class="form-check-input" id="waterwell" name="waterwell" value=1>
          <label class="form-check-label" for="waterwell">Waterwell</label>
          <button type="button" class="btn btn-primary btn-sm" id="waterwell1" data-bs-toggle="popover" data-bs-trigger="focus" title="Waterwell" data-bs-content="Check here if your property has a water well, this is not common.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="hoa" value=0 />
          <input type="checkbox" class="form-check-input" id="hoa" name="hoa" value=1>
          <label class="form-check-label" for="hoa">HOA</label>
          <button type="button" class="btn btn-primary btn-sm" id="hoa1" data-bs-toggle="popover" data-bs-trigger="focus" title="HOA" data-bs-content="Check here if your property is in an HOA(Home Owners Association).  This is common in Arizona.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="loanassuption" value=0 />
          <input type="checkbox" class="form-check-input" id="loanassuption" name="loanassuption" value=1>
          <label class="form-check-label" for="loanassuption">loan assumtion</label>
          <button type="button" class="btn btn-primary btn-sm" id="loanassuption1" data-bs-toggle="popover" data-bs-trigger="focus" title="Loan Assumtion" data-bs-content="Check here if you plan on assuming an exsisting loan.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="sellerfinancing" value=0 />
          <input type="checkbox" class="form-check-input" id="sellerfinancing" name="sellerfinancing" value=1>
          <label class="form-check-label" for="sellerfinancing">Seller Financing</label>
          <button type="button" class="btn btn-primary btn-sm" id="sellerfinancing1" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Financing" data-bs-content="Check here if you plan on using seller financing.  A seller will typically offer this in a listing, it is not common.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="shortsale" value=0 />
          <input type="checkbox" class="form-check-input" id="shortsale" name="shortsale" value=1>
          <label class="form-check-label" for="shortsale">Short Sale</label>
          <button type="button" class="btn btn-primary btn-sm" id="shortsale1" data-bs-toggle="popover" data-bs-trigger="focus" title="Short Sale" data-bs-content="Check here if the property is offered as a short sale.  The seller will indicate this in the listing.  call: or email: for help">?
          </button>
        </div>
        <div class="form-check">
          <input type="hidden" name="other" value=0 />
          <input type="checkbox" class="form-check-input" id="other" name="other" value=1>
          <label class="form-check-label" for="other">Other</label>
          <button type="button" class="btn btn-primary btn-sm" id="other1" data-bs-toggle="popover" data-bs-trigger="focus" title="Other" data-bs-content="Check here if you have any other addenda.  call: or email: for help">?
          </button>
        </div>

    Additional Personal Property Included:

      <button type="button" class="btn btn-primary btn-sm" id="other2" data-bs-toggle="popover" data-bs-trigger="focus" title="Other" data-bs-content="Check listing to see what the seller is offering.  Make sure you document the property when you tour(pictures are helpful).   call: or email: for help">Help
      </button>

      <div class="form-check">
        <input type="hidden" name="refrigerator" value=0 />
        <input type="checkbox" class="form-check-input" id="refrigerator" name="refrigerator" value=1>
        <label class="form-check-label" for="refrigerator">Refrigerator</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="washer" value=0 />
        <input type="checkbox" class="form-check-input" id="washer" name="washer" value=1>
        <label class="form-check-label" for="washer">Washer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="dryer" value=0 />
        <input type="checkbox" class="form-check-input" id="dryer" name="dryer" value=1>
        <label class="form-check-label" for="dryer">Dryer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="spa" value=0 />
        <input type="checkbox" class="form-check-input" id="spa" name="spa" value=1>
        <label class="form-check-label" for="spa">Spa</label>
      </div>
      <div class="mb-1 mt-0">
        <input type="hidden" name="personalprop" value=0 />
        <label for="personalprop" class="form-label"></label>
        <input type="text" class="form-control rounded-pill" id="personalprop" placeholder="Other Personal Property:" name="personalprop">
      </div>
      <div class="mb-1 mt-0">
        <input type="hidden" name="personalprop2" value=0 />
        <label for="personalprop2" class="form-label"></label>
        <input type="text" class="form-control rounded-pill" id="personalprop2" placeholder="Other Personal Property:" name="personalprop2">
      </div>
      <div class="mb-3 mt-3">
        <label for="coedate" class="form-label">Date Toured:
          <button type="button" class="btn btn-primary btn-sm" id="tour" data-bs-toggle="popover" data-bs-trigger="focus" title="Date Toured" data-bs-content="Date you toured the property, if this is site unseen leave blank(Not Recommended).  call: or email: to set up a showing">?
          </button>
        </label>
        <input type="date" class="form-control rounded-pill" id="tour1" name="tour">
      </div>


      Type of Financing:
      <button type="button" class="btn btn-primary btn-sm" id="financingtype" data-bs-toggle="popover" data-bs-trigger="focus" title="Type of Financing" data-bs-content="Consult with your mortgage company.  call: or email: for help">Help
      </button>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype1" name="financingtype" value="Cash">
        <label class="form-check-label" for="radio0">Cash</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype2" name="financingtype" value="Conventional">
        <label class="form-check-label" for="radio1">Conventional</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype3" name="financingtype" value="FHA">
        <label class="form-check-label" for="radio2">FHA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype4" name="financingtype" value="VA">
        <label class="form-check-label" for="radio3">VA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype5" name="financingtype" value="USDA">
        <label class="form-check-label" for="radio3">USDA</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype6" name="financingtype" value="Assumption">
        <label class="form-check-label" for="radio3">Assumption</label>
      </div>

      <div class="form-check">
        <input type="radio" class="form-check-input" id="financingtype7" name="financingtype" value="Seller Carryback">
        <label class="form-check-label" for="radio3">Seller Carryback</label>
      </div>


      <label for="Buyer" class="form-label">Seller Consessions: $
        <button type="button" class="btn btn-primary btn-sm" id="sellerconsessions" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Consessions" data-bs-content="You can ask for the seller to pay for a portion of the closing costs.  This will weaken your offer, amount is typically a small percentage of the purchase price.  ex: 2%.  call: or email: for help">Help
      </button>
      </label>
      <div class="form-check">
          <input type="hidden" name="sellerconsessions" value=0 />
          <input type="number" class="form-control rounded-pill" id="sellerconsessions1" value=0 placeholder="Seller Consessions $" name="sellerconsessions">
      </div>

      Home Warranty Plan Ordered By:
      <button type="button" class="btn btn-primary btn-sm" id="homewarrantyorderedby" data-bs-toggle="popover" data-bs-trigger="focus" title="Home Warranty Plan Ordered By" data-bs-content="A home warranty typically covers essential home systems and appliances issues, it is fairly common.  Buyers who don't ask sellers to order will likely be veiwed as more serious, this is optional.  call: or email: for help">Help
      </button>
      <div class="form-check">
        <input type="hidden" name="homewarrantyorderedby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantyorderedby1" name="homewarrantyorderedby" value="Buyer">
        <label class="form-check-label" for="radio1">Buyer</label>
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="homewarrantyorderedby2" name="homewarrantyorderedby" value="Seller">
        <label class="form-check-label" for="radio2">Seller</label>
      </div>

      Home Warranty Plan Paid By:
      <button type="button" class="btn btn-primary btn-sm" id="homewarrantypaidby1" data-bs-toggle="popover" data-bs-trigger="focus" title="Home Warranty Plan Paid By" data-bs-content="Asking the seller to pay for this will weaken your offer.  call: or email: for help">Help
      </button>
      <div class="form-check">
        <input type="hidden" name="homewarrantypaidby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantypaidby" name="homewarrantypaidby" value="Buyer">
        <label class="form-check-label" for="radio1">Buyer</label>
      </div>
      <div class="form-check">
        <input type="hidden" name="homewarrantypaidby" value=0 />
        <input type="checkbox" class="form-check-input" id="homewarrantypaidby2" name="homewarrantypaidby" value="Seller">
        <label class="form-check-label" for="radio2">Seller</label>
      </div>

      <div class="input-group mb-3 mt-3">
      <div class="input-group-text">
        <input type="radio" name="additionalterms" value=1>
        </div>
        <input type="text" class="form-control rounded-pill" name="additionalterms"placeholder="Additional Terms">
      </div>

      <div class="mb-3 mt-3">
        <label for="coedate" class="form-label">Seller Acceptance Deadline:
          <button type="button" class="btn btn-primary btn-sm" id="accepttime" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Acceptance Deadline" data-bs-content="The seller must respond by this time or this contract will become null.  24-48 hours is typical, however some sellers specify this in the listing.  call: or email: for help">Help
          </button>
        </label>
        <input type="datetime-local" class="form-control rounded-pill" id="accepttime1" name="accepttime" required>
      </div>

      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="collapse" data-bs-target="#demo">Seller Agent</button>
        <div id="demo" class="collapse">
        If there is no seller agent leave blank(For Sale By Owner)
              <div class="mb-3 mt-3">
                <label for="agentname" class="form-label">Agent Full Name:
                  <button type="button" class="btn btn-primary btn-sm" id="agentname" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent Full Name" data-bs-content="Agent full name, this will be found in the listing">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname1" placeholder="Enter Agent Name*" name="agentname">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentemail" class="form-label">Agent Email:
                </label>
                <input type="email" class="form-control rounded-pill" id="agentemail" placeholder="Enter Agent Email" name="agentemail">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Agent License Number:
                  <button type="button" class="btn btn-primary btn-sm" id="agentlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Agent License Number" data-html="true" data-bs-content="The Agent's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchIndividuals.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense1" placeholder="Enter Agent License" name="agentlicense">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentname2" class="form-label">Additional Agent Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentname2" placeholder="Enter Agent Name" name="agentname2">
              </div>

              <div class="mb-3 mt-3">
                <label for="agentlicense" class="form-label">Additional Agent License Number:
                </label>
                <input type="text" class="form-control rounded-pill" id="agentlicense2" placeholder="Enter Agent License" name="agentlicense2">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmname" class="form-label">Agent's Firm Name:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmname" placeholder="Enter Brokerage Name" name="firmname">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmaddress" class="form-label">Agent's Firm Address:
                </label>
                <input type="text" class="form-control rounded-pill" id="firmaddress" placeholder="Enter Brokerage Address" name="firmaddress">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmphone" class="form-label">Broker Firm Phone Number:
                </label>
                <input type="tel" class="form-control rounded-pill" id="firmphone" placeholder="Enter Brokerage Phone Number" name="firmphone">
              </div>

              <div class="mb-3 mt-3">
                <label for="firmlicense" class="form-label">Agent's Firm Liscense:
                  <button type="button" class="btn btn-primary btn-sm" id="firmlicense" data-bs-toggle="popover" data-bs-trigger="focus" title="Firm License Number" data-html="true" data-bs-content="The Brokerage Firm's Liscence Number can be found on the ADRE's website ex: <a href=https://services.azre.gov/publicdatabase/SearchEntities.aspx/ target='_blank'>Arizona Department of Real Estate Public Database</a>">Help
                  </button>
                </label>
                <input type="text" class="form-control rounded-pill" id="firmlicense1" placeholder="Enter Brokerage License Number" name="firmlicense">
              </div>

        </div>
      

      <br>
      
  <button  type="submit" class="btn btn-primary btn-lg" id="usrreq">Confirm Offer</button>

</form>


<div id="new">
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" id="usermodal" data-bs-target="#myModal">
  Continue
</button>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Offer</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <div class="row">
                      <div class="col">
                    <div class="container p-2 my-3 border">
                        <div id="IncorrectPass2" style="color:red"></div>
                                <div class="hideform">
                        <form  action="php/retd.php" method="post" id="form2">
                          <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                          </div>
                          <div class="mb-3">
                            <label for="pwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                          </div>
                          <button type="submit" class="btn btn-primary">Log In</button>
                        </form>
                    </div>

                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" id="resetbutton1" data-bs-target="#demo1">Reset Password</button>
                          <div id="demo1" class="collapse">
                                        <form action="php/retd.php" method="post" id="form3"> <button name="sendkey" type="submit" id="sendkey" value="sendit!" class="btn btn-outline-primary btn-sm">Send Key to reset password</button></h4>
        
          
         
                      
                    <div class="container p-1 my-1 border">
                       <h5 id="badkey" style="color:red; display:none">
                           Incorrect Key, please use the last key sent to your email
                       </h5>
                        
                          <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control"  value="<? echo $_SESSION['email']?>" name="email" required>
                          </div>
                          <div class="mb-3" id="resetket" style="display:none">
                            <label for="pwd"  class="form-label">Key:</label>
                            <input type="password" class="form-control" placeholder="Enter key sent to your email: " name="sentkey"  >
                          
                          <button type="submit" id="resetbutton" value="inputkey"  name="key" class="btn btn-primary">Reset Password</button>
                        </form></div>
                        <div id="CreatePassword" style="display:none">
                        <form action="php/retd.php" method="post" id="form5">
                                      <div class="mb-3" >
                            <div id="matchingerror2" style="color:red"></div>
                            <label for="pwd" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="createpwd3" placeholder="Enter password" name="createpswd" required>
                              </div>
                            <div class="mb-3">
                            <label for="pwd" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="createpwd4" placeholder="Enter password" name="createpswd2" required>
                          </div>
                            
                        <button type="submit" name="01" class="btn btn-primary">Create Password</button></form></div>
                    </div></div></div>
                         
                            

<!-- The Modal -->

    
</div>
                    </div><div class="hideform">
        <form action="php/retd.php" method="post" id="form1">
          <div class="mb-3 mt-3">
              <div id="matchingerror3" style="color:red"></div>
              <div id="emailexists" style="color:red"></div>
              
               <?php if($_SESSION['emailexists'] == 1){
                  echo '<button id="resetbutton" class="btn btn-outline-danger">An account already exists for this email address</button>';
                unset($_SESSION['emailexists']);
               
                }?>
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter legal name" name="createname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="newemail" placeholder="Enter email" name="createemail" required>
          </div>
          <div id="matchingerror" style="color:red"></div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="createpwd" placeholder="Enter password" name="createpswd" required>
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="createpwd2" placeholder="Enter password" name="createpswd2" required>
          </div>
          <button class="btn btn-primary"  onclick="submitForm1()">Create Account</button>
          </form>
      </div></div>
</div>
      <!-- Modal footer -->
      <div class="modal-footer">

      </div>

    </div>
    
  </div>
  
</div> 
    
</div>

        <div class="footer">
         
        </div>
    <script src="js/jslanding.js"></script>
  </body>
</html>
