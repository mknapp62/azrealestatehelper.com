<?php
session_set_cookie_params(0, '/', '.azrealestatehelper.com');
session_start();

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/jslanding.js"></script>
  </head>
  <body class="login">
<div style="display:none"><?php include('php/retd.php');?></div>
    <div class="mt-4 p-5 bg-primary text-white rounded">
    <h1>Welcome</h1>
    <p>Real Estate Transaction Database</p>
  </div>
 <div class="d-grid">
  <a href="https://newpurchase.azrealestatehelper.com" type="button" class="btn btn-primary btn-block mt-1" data value="<? $_SESSION['user_id'] = 1?>">Write Offer</a>
</div>
  <div class="row">
      <div class="col">
    <div class="container p-2 my-3 border">
        
        <?php if(isset($_SESSION['IncorrectPass'])){
                  echo '<button type="button" class="btn btn-outline-danger">' .$_SESSION['IncorrectPass'].'</button><p class="text-danger"></p>';
                unset($_SESSION['IncorrectPass']);}
              ?>
        <form  action="php/retd.php" method="post">
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
        <div id="resetmodalbutton">
    <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" id="resetpass" data-bs-target="#myModal">
  Reset Password
</button>
</div>
    </div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
         <form action="php/retd.php" method="post" id="form3"> 
         <div id="hidesendkeyform">
         <button name="sendkey" type="submit" id="sendkey" value="sendit!" class="btn btn-outline-primary btn-sm"><h6 id="resettext">Send Key to reset password</h6></button>
               
                    <div class="container p-1 my-1 border">
                       <h5 id="badkey" style="fontcolor:red"></h5>
                        <?php if(isset($_SESSION['passnomatch'])){
                              echo '<button type="button" class="btn btn-outline-danger">Passwords Dont match</button><p class="text-danger"></p>';
                            unset($_SESSION['passnomatch']);}
                        ?>
                          <div class="mb-3 mt-3" id="1">
                            <label for="email"  class="form-label">Email:</label>
                            <input type="email"  class="form-control"  value="<? echo $_SESSION['email']?>" name="email" required>
                          </div>
                          <div class="mb-3" id="resetket" style="display:none">
                            <label for="pwd" class="form-label">Enter key sent to your email:</label>
                            <input type="password" class="form-control"  placeholder="This could take a minute: Check spam folders" name="key"  >
                          </div>
                          <button type="submit" id="resetbutton" style="display:none" class="btn btn-primary">Reset Password</button>
                        </form></div>
                        <div id="CreatePassword" style="display:none">
                        <form action="php/retd.php" method="post" id="form5">
                                      <div class="mb-3">
                            <label for="pwd" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="createpwd3" placeholder="Enter password" name="createpswd" required>
                              </div>
                            <div class="mb-3">
                            <label for="pwd" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="createpwd4" placeholder="Enter password" name="createpswd2" required>
                          </div>
                            
                        <button type="submit" class="btn btn-primary">Create Password</button></form></div>
                    </div></div></div></div>
    
</div>
    <div class="container p-2 my-3 border">
        <?php if(isset($_SESSION['passnomatch1'])){
                  echo '<button type="submit" id="resetbutton" class="btn btn-outline-danger">' .$_SESSION['passnomatch1'].'</button>';
                unset($_SESSION['passnomatch1']);
               
                }?>
        <form action="php/retd.php" method="post" id="myform1">
          
          <div class="mb-3 mt-3">
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter legal name" name="createname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="newemail" placeholder="Enter email" name="createemail" required>
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="createpwd" placeholder="Enter password" name="createpswd" required>
          </div>
          <div class="mb-3">
            <label for="pwd" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="createpwd2" placeholder="Enter password" name="createpswd2" required>
          </div>
          <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
          </div>
        </div>

         <div class="col">
             <div class="mb-3 mt-3">
                 <div class="container p-2 my-3 border">
         <form action="php/retd.php"  method="post">
             <?php if(isset($_SESSION['offernotfound'])){
                  echo '<button type="submit" id="resetbutton" class="btn btn-outline-danger">' .$_SESSION['offernotfound'].'</button>';
                unset($_SESSION['offernotfound']);
               
                }?>
              <div class="mb-3">
            <label for="buyerid" class="form-label">Buyer ID:</label>
            <input type="number" class="form-control" id="buyerid" placeholder="Enter buyer ID #" name="buyerid" required>
          </div>
           <div class="mb-3">
            <label for="propertyid" class="form-label">Property ID:</label>
            <input type="number" class="form-control" id="propertyid" placeholder="Enter property id #" name="propertyid" required>
          </div>
             
              <input type="hidden" name="offer" value="counter"/>
              <button class="btn btn-outline-primary" type="submit" href="https://response.azrealestatehelper.com">View Offer</button></form>
        </div></div></div></div>
   
  </body>
</html>
