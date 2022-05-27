<?php
session_start();
/* Log in screen ------------------------------------------------------------ ------------------------------------------------------------
------------------------------------------------------------ Log in code*/
require_once "pass.php";
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);

if(isset($_SESSION['seller1'])){
  $contract = $pdo->query("SELECT * FROM contract WHERE seller1='{$_SESSION['seller1']}';")->fetch();}



/*$name = $pdo->query("SELECT * FROM property WHERE owner1='{$_GET['seller1']}';")->fetch(); */



/* lOGOUT BUTTON*/
  if(isset($_POST["logout"])) {
      session_unset();
      header("Location: http://azrealestatehelper.com", 302);
      }


/* UPDATE exsisting PROPERTY DATA */


    /* Just to get seller1 data */
    if(isset($_GET["seller1"])){
    $seller1exists = 0;
    $name = "SELECT * FROM property WHERE owner1= :seller1;";
    $stmt = $pdo->prepare($name);
    $stmt->bindValue(':seller1',$_GET['seller1']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }

/* UPDATE exsisting PROPERTY DATA using seller1 == owner1 in database but would like to tie unique id to it*/
if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"]) && $_GET["seller1"] ==
    $row['owner1']){
    
    $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   


  (new SqlUpadates())->UpdateProperty1();
  

    if(isset($_GET["purchaseprice"])){
      header("Location: http://www.confirm.azrealestatehelper.com", TRUE, 301);
        exit();
  }else{
    header("Location: http://www.contract.azrealestatehelper.com", TRUE, 301);
        exit();
  }
}



/* NEW PROPERTY DATA */
require_once "pass.php";
$c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
   
  if(isset($_GET["seller1"]) && isset($_GET["address"]) && isset($_GET["city"]) && isset($_GET["zip"]) && isset($_GET["assessornum"]) && isset($_GET["yearbuilt"])) {
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

    
        $sql = (new SqlInsertNew())->NewProperty();
        
      $s = new PDO('mysql:localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
      $stmt = $s->prepare($sql);
      $stmt->execute(array(
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
        header("Location: http://www.contract.azrealestatehelper.com", 302);
        exit();
  }


  /* Update  purchase "Contract deal information page"
  ---------------------------------------------$nameproperty['property_id'] == $_SESSION['property_id'] ){  need to alter this statement it doesn't retur-----------------------*/

  




 ?>
