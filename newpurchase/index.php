<?php
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

    <title>New Purchase</title>
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
    <?php include 'php/retd.php';?>
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">
        <?php print_r("Welcome " .$_SESSION['name']);?><br>
        Property Information for: <? echo $_SESSION['address']; ?>
        <?php

        if($_SERVER['HTTP_REFERER'] == "http://landing.azrealestatehelper.com/"){unset($_SESSION['property_id']);}
        /*
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " session referrer: " .$_SERVER['HTTP_REFERER'];
        echo " session url: " .$_SERVER['REQUEST_URI'];
        */
         ?>
      </h2><?php
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

    <title>New Purchase</title>
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
    <?php include 'php/retd.php';?>
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">
        <?php print_r("Welcome " .$_SESSION['name']);?><br>
        Property Information for: <span id="header2" style="display:none"></span>
        <?php

        if($_SERVER['HTTP_REFERER'] == "http://landing.azrealestatehelper.com/"){unset($_SESSION['property_id']);}
        /*
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " session referrer: " .$_SERVER['HTTP_REFERER'];
        echo " session url: " .$_SERVER['REQUEST_URI'];
        */
         ?>
      </h2>
    </div>
<!---   NAVbar   ___________________________________________ -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link " href="https://www.landing.azrealestatehelper.com">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="https://www.newpurchase.azrealestatehelper.com" >Property</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" >Contract</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Confirm</a>
      </li>
    </ul>

<div class="shadow col-sm p-3 m-3 bg-transparent text-dark border border border-primary border- 5 rounded">
<form action="php/retd.php"  method="get" >
    <div class="mb-3 mt-3">
        <div class="mb-3">
      <label for="Seller" class="form-label">Seller:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Name" data-bs-content="Seller legal name, enter additional sellers in the Additional Seller space below">Help
        </button>
      </label>
      <input type="text" class="form-control rounded-pill" id="Seller1" placeholder="Enter Seller Name*" name="seller1" required>
    </div>

    <div class="mb-3">
      <label for="Seller2" class="form-label">Additional Seller:</label>
      <input type="text" class="form-control rounded-pill" id="Seller2" placeholder="Enter additional seller names" name="seller2">
    </div>

    <div class="mb-3">
      <label for="Address" class="form-label">Property Address:</label>
      <input type="text" class="form-control rounded-pill" id="address" placeholder="Enter Property Address*" name="address" required>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="mb-3">
      <label for="city" class="form-label">City:</label>
      <input type="text" class="form-control rounded-pill" id="city" placeholder="Enter property City*" name="city" required>
    </div>

    <div class="mb-3">
      <label for="county" class="form-label">County:</label>
      <input type="text" class="form-control rounded-pill" id="county" placeholder="Enter property County" name="county">
    </div>

    <div class="mb-3">
      <label for="zip" class="form-label">Zip Code:</label>
      <input type="text" class="form-control rounded-pill" id="zip" placeholder="Enter property Zip*" name="zip" required>
    </div>

    <div class="mb-3">
      <label for="assessornum" class="form-label">Assessor Number:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Assessor Number" data-html="true" data-bs-content="The APN can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
<!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="text" class="form-control rounded-pill" id="assessornum" placeholder="xxx-xx-xxx *" name="assessornum" required>
    </div>

    <div class="mb-3">
      <label for="legaldisc" class="form-label">Property Legal Discription:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Legal Discription" data-html="true" data-bs-content="The APN can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
  <!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="text" class="form-control rounded-pill" id="legaldisc" placeholder="ex: Lot 19 Vista amd mcr 065408" name="legaldisc">
    </div>

    <div class="mb-3">
      <label for="yearbuilt" class="form-label">Year built:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Year Built" data-html="true" data-bs-content="The Year Built can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
  <!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="number" class="form-control rounded-pill" id="yearbuilt" placeholder="Year the property was built" name="yearbuilt" required>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="sewer" name="wastewater" value="Sewer" checked>
      <label class="form-check-label" for="radio1">Sewer</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="septic" name="wastewater" value="Septic">
      <label class="form-check-label" for="radio2">Septic</label>
    </div>

    <button type="submit" class="btn btn-outline-primary btn-lg m-2">Continue</button>
</form>





        <div class="footer">
          <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-outline-danger m-2" type="submit">Logout</button></form>
        </div>
        </div></div
    <script src="js/jslanding.js"></script>
  </body>
</html>

    </div>
<!---   NAVbar   ___________________________________________ -->
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link " href="https://www.landing.azrealestatehelper.com">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="https://www.newpurchase.azrealestatehelper.com" >Property</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" >Contract</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Confirm</a>
      </li>
    </ul>

<form action="php/retd.php"  method="get" >
    <div class="mb-3 mt-3">
      <label for="Seller" class="form-label">Seller:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Seller Name" data-bs-content="Seller legal name, enter additional sellers in the Additional Seller space below">Help
        </button>
      </label>
      <input type="text" class="form-control" id="Seller1" placeholder="Enter Seller Name*" name="seller1" required>
    </div

    <div class="mb-3">
      <label for="Seller2" class="form-label">Additional Seller:</label>
      <input type="text" class="form-control" id="Seller2" placeholder="Enter additional seller names" name="seller2">
    </div>

    <div class="mb-3">
      <label for="Address" class="form-label">Property Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter Property Address*" name="address" required>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="mb-3">
      <label for="city" class="form-label">City:</label>
      <input type="text" class="form-control" id="city" placeholder="Enter property City*" name="city" required>
    </div>

    <div class="mb-3">
      <label for="county" class="form-label">County:</label>
      <input type="text" class="form-control" id="county" placeholder="Enter property County" name="county">
    </div>

    <div class="mb-3">
      <label for="zip" class="form-label">Zip Code:</label>
      <input type="text" class="form-control" id="zip" placeholder="Enter property Zip*" name="zip" required>
    </div>

    <div class="mb-3">
      <label for="assessornum" class="form-label">Assessor Number:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Assessor Number" data-html="true" data-bs-content="The APN can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
<!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="text" class="form-control" id="assessornum" placeholder="xxx-xx-xxx *" name="assessornum" required>
    </div>

    <div class="mb-3">
      <label for="legaldisc" class="form-label">Property Legal Discription:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Legal Discription" data-html="true" data-bs-content="The APN can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
  <!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="text" class="form-control" id="legaldisc" placeholder="ex: Lot 19 Vista amd mcr 065408" name="legaldisc">
    </div>

    <div class="mb-3">
      <label for="yearbuilt" class="form-label">Year built:
        <button type="button" class="btn btn-primary btn-sm" id="test" data-bs-toggle="popover" data-bs-trigger="focus" title="Year Built" data-html="true" data-bs-content="The Year Built can be found on the assessor's website ex: <a href=https://www.mcassessor.maricopa.gov/ target='_blank'>Maricopa County Assessor's Website</a>">Help
  <!---  try to search address in maricopa counties website and place it here -->
        </button>
      </label>
      <input type="number" class="form-control" id="yearbuilt" placeholder="Year the property was built" name="yearbuilt" required>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="sewer" name="wastewater" value="Sewer" checked>
      <label class="form-check-label" for="radio1">Sewer</label>
    </div>

    <div class="form-check">
      <input type="radio" class="form-check-input" id="septic" name="wastewater" value="Septic">
      <label class="form-check-label" for="radio2">Septic</label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg">Continue</button>
</form>





        <div class="footer">
          <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-success" type="submit">Logout</button></form>
        </div>
    <script src="js/jslanding.js"></script>
  </body>
</html>
