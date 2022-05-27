<?php
session_set_cookie_params(100, '/', '.azrealestatehelper.com');
session_start();
if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == 1){
     session_unset();
      header("Location: http://azrealestatehelper.com", 302);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="//azrealestatehelper.com/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="//azrealestatehelper.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//azrealestatehelper.com/favicon/favicon-16x16.png">
    <link rel="manifest" href="//azrealestatehelper.com/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jslanding.js"></script>
   
    </style>
  </head>
  <body>
     <h1 style="display:none"> <?php require("php/retd.php");?></h1>
    <?php if($_SESSION['user_id'] == 1){ $_SESSION['user_id'] = $_SESSION['buyer_id'];}; ?>

    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header">
          
        <?php 
        print_r("Welcome " .$_SESSION['name']);?><br>
        <?php
        unset($_SESSION['selleragentid']);
       /* echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid'];
        echo $_SESSION['test'];
        print_r(" session referrer: " .$_SERVER['HTTP_REFERER']);
        $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
        echo "current address: ".$_SERVER['REQUEST_URI'];
        print("<br>contract00: " .$_SESSION['contract_id00']);
        print("<br>contract01: " .$_SESSION['contract_id01']);
        print("<br>" .$_SESSION['contract_id2']);
        echo "Address: " .$_SESSION['addresslist0'];
        print("list1: " .$_SESSION['addresslist1']);
        print("list2: " .$_SESSION['addresslist2']);*/
        require_once "php/pass.php";
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=knapp62_transaction', 'root', $pass);
        $whowaslast =   $pdo->query("SELECT createdby
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY createdby DESC
            LIMIT 1;")->fetch();
            
        $c = "/classes.php";
   require dirname("/home/knapp62/public_html/landing/index.php", 2).$c;
       
         ?>
      </h2>
    </div>
     <div class="d-grid">
     <a href="https://newpurchase.azrealestatehelper.com" type="button" class="btn btn-primary btn-block mt-1">Write New Offer</a>
    </div>
    
        
         <form action="php/retd.php"  method="post">
             <div class="d-grid">
              
              <button class="btn btn-primary btn-block mt-1" type="submit">
                  
             
            <input type="number" class="form-control-sm border-primary rounded" id="buyerid" placeholder="Enter buyer ID #" name="buyerid" required>
          <span class="input-group-btn" style="width:0px;"></span>
           
            <input type="number" class="form-control-sm border-primary rounded" id="propertyid" placeholder="Property id #" name="propertyid" required>
          
             <input type="hidden" name="offer" value="counter"/>
              View New Offer</button></div></div></form>
        
        <div id="resetmodalbutton">
    <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" id="resetpass" data-bs-target="#myModal">
  My Account
</button>
</div>
    </div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        Account Information
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <div class="row">
             
                      <div class="col" >
                     
                    <div class="container p-1 my-1 border">
                    
                        <button style="display:none" type="button" id="badkey" class="btn btn-outline-primary"></button>

                        <form action="php/retd.php" method="post" id="form4">
                          <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control"  value="<? echo $_SESSION['email']?>" name="createemail" required>
                          </div>
                          <div class="mb-3" id="resetket">
                            <label for="name" class="form-label">Legal Name:</label>
                            <input type="text" class="form-control"  value="<?echo $_SESSION['name'];?>" name="createname"  >
                          </div>
                          
                        <div id="CreatePassword" >
                        
                                      <div class="mb-3">
                            <label for="pwd" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="createpwd3" placeholder="Enter password" name="createpswd" required>
                              </div>
                            <div class="mb-3">
                            <label for="pwd" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="createpwd4" placeholder="Enter password" name="createpswd2" required>
                          </div>
                            
                        <button  class="btn btn-primary">Update</button></form></div>
                    </div></div></div></div></div></div></div>
        
    <div class="container-fluid mt-5  bg-transparent">
        <div class="row">
            <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary border- 5 rounded">
              <h5>Purchase Contracts</h5>
              <?php if(isset($_SESSION['deleted'])){
                  echo '<p class="text-danger">' .$_SESSION['deleted'].'</p>';
                unset($_SESSION['deleted']);
                }?>
                <ul><!--  -->
            <?php $inc4 = 0;
                  while(isset($_SESSION['contract_id' .$inc4])){
                  echo '<li class="nav-item"><form action="php/retd.php"  method="post">
                          <div class="btn-group">
                          <input type="hidden" name="saved" value="'.$_SESSION['contract_id' .$inc4].'"/>
                          <button class="btn btn-outline-primary my-1" type="submit" >'.$_SESSION["addresslist" .$inc4].'</button></form>
                          
                              <button type="button" class="btn btn-outline-danger my-1" data-bs-toggle="modal" data-bs-target="#myModal'.$inc4.'">
                                Delete
                              </button>
                            </div>
                            
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal'.$inc4.'" >
                              <div class="modal-dialog">
                                <div class="modal-content">
                            
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Delete Property?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    This will delete the property, contract, and deal information
                                  </div>
                            
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <form action="php/retd.php"  method="post" >
                                     <input type="hidden" name="delete" value="'.$_SESSION['contract_id' .$inc4].'"/>
                                      <button class="btn btn-outline-danger my-1" type="submit">Delete</button>
                                      </div></form>
                                    
                                  </div>
                            
                                </div>
                              </div>
                            
                          ';
                        
                 
                  $inc4++;}
            ?>
            </ul>
          </div>


      <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary border- 5 rounded">
            <h5>Property Sales</h5>
              <?php if(isset($_SESSION['deletedseller'])){
                  echo '<p class="text-danger">' .$_SESSION['deletedseller'].'</p>';
                unset($_SESSION['deletedseller']);
                
                }?>
                <ul><!--  -->
            <?php $inc5 = 0;
                  while(isset($_SESSION['contract_id0' .$inc5])){
                  echo '<li class="nav-item"><form action="php/retd.php"  method="post">
                          <div class="btn-group">
                          <input type="hidden" name="saved2" value="'.$_SESSION['contract_id0' .$inc5].'"/>
                          <button class="btn btn-outline-primary my-1" type="submit" >'.$_SESSION["addresslist0" .$inc5].'-Buyer: '.$_SESSION['buyer10' .$inc5].'</button></form>
                          
                              <button type="button" class="btn btn-outline-danger my-1" data-bs-toggle="modal" data-bs-target="#myModals'.$inc5.'">
                                Delete
                              </button>
                            </div>
                            
                            <!-- The Modal -->
                            <div class="modal fade" id="myModals'.$inc5.'" >
                              <div class="modal-dialog">
                                <div class="modal-content">
                            
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Delete Property?</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                            
                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    This will delete the property, contract, and deal information
                                  </div>
                            
                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <form action="php/retd.php"  method="post" >
                                     <input type="hidden" name="deleteseller" value="'.$_SESSION['contract_id0' .$inc5].'"/>
                                      <button class="btn btn-outline-danger my-1" type="submit">Delete</button>
                                      </div></form>
                                    
                                  </div>
                            
                                </div>
                              </div>
                            
                          ';
                        
                 
                  $inc5++;}
            ?>
            </ul>
        </div>
    </div>
        <div class="footer">
          <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-danger" type="submit">Logout</button></form>
        </div>
  
    <script src="js/jslanding.js"></script>
  </body>
</html>
