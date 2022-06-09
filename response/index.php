<?php
session_set_cookie_params(0, '/', '.azrealestatehelper.com');
session_start();
if(empty($_SESSION['user_id'])){
     session_unset();
      header("Location: https://azrealestatehelper.com", 302);
}
//require("php/retd.php");

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <title>Contract Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="//azrealestatehelper.com/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="//azrealestatehelper.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="//azrealestatehelper.com/favicon/favicon-16x16.png">
    <link rel="manifest" href="//azrealestatehelper.com/favicon/site.webmanifest">

    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jslanding.js"></script>
   

  </head>
  
  <body><h1 id="delete" style="display:none">
    <?php require "php/retd.php";?>
    </h1>
    
      <div id="new">
       <button type="button" style="display:none" class="btn btn-primary" data-bs-toggle="modal" id="usermodal" data-bs-target="#myModal">
              Continue
            </button>
            
            <!-- The Modal -->
            <div class="modal" id="myModal">
              <div class="modal-dialog">
                <div class="modal-content">
            
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Sign in or Sign up</h4>
                   
                  </div>
            
                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="container p-2 my-3 border">
        <!-- USER LOGIN    -->
        <div id="passwordmatch" style="display:none">     
       <button class="btn btn-outline-danger">Incorrect Username or Password</button>
       </div>
        <form  action="php/retd.php" method="post" id="myform1">
          <div class="mb-3 mt-3" id="a">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
          </div>
          <div class="mb-3" id="b">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
          </div>
          <button type="submit" id="c" class="btn btn-primary">Log In</button>
        </form>
        
        <button type="button" id="pwdreset" class="btn btn-outline-primary">Reset Password</button>
                      <!--CREATE NEW ACCOUNT -->
                      
                      <div class="container p-2 my-3 border">
        <?php if(isset($_SESSION['passnomatch1'])){
                  echo '<button type="submit" id="resetbutton" class="btn btn-outline-danger">' .$_SESSION['passnomatch1'].'</button>';
                unset($_SESSION['passnomatch1']);
               
                }?>
        <form action="php/retd.php" method="post" id="myform2">
          <div id="passmatch" style="color:red"></div>
          <div id="emailexists" style="color:red"></div>
          
          <div class="mb-3 mt-3" id="d">
            <label for="name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter legal name" name="createname" required>
          </div>
          <div class="mb-3" id="e">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="newemail" placeholder="Enter email" name="createemail" required>
          </div>
          <div class="mb-3" id="f">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="createpwd" placeholder="Enter password" name="createpswd" required>
          </div>
          <div class="mb-3" id="g">
            <label for="pwd" class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" id="createpwd2" placeholder="Enter password" name="createpswd2" required>
          </div>
          <button type="submit" id="h" class="btn btn-primary">Create Account</button>
        </form>
          </div>
                      
                     <!-- PASSWORD RESET DISPLAY NONE BY DEFAULT -->
                 
         <div id="hidesendkeyform">
             <form action="php/retd.php" method="post" id="form3">     
         <button name="sendkey" style="display:none" type="submit" id="sendkey" value="sendit!" class="btn btn-outline-primary btn-sm"><h6 id="resettext">Send Key to reset password</h6></button>
               
                    <div class="container p-1 my-1 border">
                       <h5 id="badkey" style="fontcolor:red"></h5>
                        <?php if(isset($_SESSION['passnomatch'])){
                              echo '<button type="button" class="btn btn-outline-danger">Passwords Dont match</button><p class="text-danger"></p>';
                            unset($_SESSION['passnomatch']);}
                        ?><h5 id="passnomatch" style="fontcolor:red, display:none"></h5>
                          <div class="mb-3 mt-3" id="1" style="display:none">
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
                    </div></div></div>
            </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                       </div>
            
                </div>
              </div>
            </div> 
                
            </div>
    
    
    <div class="mt-4 p-5 bg-primary text-white rounded">
      <h2 id="header"><span>
        <?php
        print_r("Welcome " .$_SESSION['name']);?>
        <form action="php/retd.php"  method="post">
          <input type="hidden" name="logout" value="logout"/>
          <button class="btn btn-sm btn-outline-danger" type="submit">Logout</button></form></span><br>
        Purchase Contract Information: <? echo $_SESSION['address']; ?>
        
        <?php
         /*   $whowaslast =   $pdo->query("SELECT createdby, sent
            FROM contract
            WHERE property_id = '{$_SESSION['property_id']}'
            ORDER BY contract_id DESC
            LIMIT 1;")->fetch();
            $_SESSION['createdby'] = $whowaslast['createdby'];  
            $_SESSION['sent'] = $whowaslast['sent'];
            
            /* who is logged in, who created the last contract, was it sent:  buyer:0 seller:1 sent:bool 
            $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
            
            $_SESSION['buyerseller'] == $_SESSION['createdby'] ? $_SESSION['usercreated'] = 1 : $_SESSION['usercreated'] = 0;
              if(in_array($_SESSION['userview'], [110, "000"])){
                    $_SESSION['counter'] = 1;
                    }else{$_SESSION['counter'] = "";}
                    
           */
            $_SESSION['userview'] = $_SESSION['buyerseller'].$_SESSION['createdby'].$_SESSION['sent'];
             
        echo "session name: " .$_SESSION['name'];
        echo " session user_id: " .$_SESSION['user_id'];
        echo " session buyer_id: " .$_SESSION['buyer_id'];
        echo " session property_id: " .$_SESSION['property_id'];
        echo " session selleragentid: " .$_SESSION['selleragentid0'];
        echo " session selleragentidinc: " .$_SESSION['selleragentid' .$inc];
        echo " session contract_id: " .$_SESSION['contract_id'];
        echo " session contract_id10: " .$_SESSION['contract_id10'];
        echo " session contract_id11: " .$_SESSION['contract_id11'];
        echo " session contract_id12: " .$_SESSION['contract_id12'];
        echo " session contract_id13: " .$_SESSION['contract_id13'];
        echo "counter: " .$_SESSION['counter'];
        echo "submitteddate0: " .$_SESSION['submitteddate0'];
        echo "pleasesignin: " .$_SESSION['pleasesignin'];
        echo "sewer: " .$_SESSION['sewer'];
        
        echo "address: " .$_SESSION['address'];
        echo "address10: " .$_SESSION['address10'];
        echo " user view buyer:seller, created, sent " .$_SESSION['userview'];
        
        echo " user equals created: " .$_SESSION['usercreated'];
      
         $inc2 = 10;?>
      </h2>
    </div>
<!---   NAVbar   ___________________________________________ -->
<div class="col-md-12 text-center">
    <div class="btn-group" role="group" >
      
                      <form action="php/retd.php"  method="post">
              <input type="hidden" name="reload" value="logout"/>
              <button class="btn btn-outline-primary" type="submit" href="https://landing.azrealestatehelper.com">Home</button></form>
      
        <button class="btn btn-outline-primary active" href="https://www.response.azrealestatehelper.com">Deal Status</button>
    </div>
</div>
<div class="m-3">
    <div class="shadow col-sm-12 p-3 bg-transparent text-dark border border border-primary rounded">
      <h1>Check List</h1>
    <div class="row">
     <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary rounded">    
      <ul class="list-group">
          <li class="list-group-item">
            <h5>Buyer</h5>
          <form action="php/retd.php"  method="post" >
          <?php if($_SESSION['buyerseller'] == 1){echo "<fieldset disabled>";}?>


        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="inspection" value=0 />
              <input class="form-check-input" type="checkbox" id="inspection" name="inspection" value=1 <? echo $_SESSION['inspectioncheck'] ?>>
              <label class="form-check-label">Inspection and/or BINSER complete<p id="binserp">I have completed ALL inspections within 10 days including reading the CC&R’s, and SPDS(provided by seller) or issues will be fixed per BINSER</p> </label>
                </div>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#binsrModal">
                    BINSR
                  </button>
                
                
                <!-- The Modal -->
                <div class="modal fade" id="binsrModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                          
                        <h4 class="modal-title">BINSR</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                          <div class="input-group mb-3">
                            <span class="input-group-text">Price Adjustment</span>
                            <input type="text" class="form-control" name="binsr0" value="<?php echo $_SESSION['binsr0']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 1:</span>
                            <input type="text" class="form-control" name="binsr1" value="<?php echo $_SESSION['binsr1']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 2:</span>
                            <input type="text" class="form-control" name="binsr2" value="<?php echo $_SESSION['binsr2']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 3:</span>
                            <input type="text" class="form-control" name="binsr3" value="<?php echo $_SESSION['binsr3']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 4:</span>
                            <input type="text" class="form-control" name="binsr4" value="<?php echo $_SESSION['binsr4']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 5:</span>
                            <input type="text" class="form-control" name="binsr5" value="<?php echo $_SESSION['binsr5']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 6:</span>
                            <input type="text" class="form-control" name="binsr6" value="<?php echo $_SESSION['binsr6']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 7:</span>
                            <input type="text" class="form-control" name="binsr7" value="<?php echo $_SESSION['binsr7']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 8:</span>
                            <input type="text" class="form-control" name="binsr8" value="<?php echo $_SESSION['binsr8']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 9:</span>
                            <input type="text" class="form-control" name="binsr9" value="<?php echo $_SESSION['binsr9']?>"><br>
                          </div>
                 </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                          
          
                         <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="acceptbinsr">Accept</button>    
                             
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="sendbinsr">Send Proposal</button> 
                      </div>
              
                    </div>
                  </div>
               
           

                

        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="insurance" value=0 />
              <input class="form-check-input" type="checkbox"  name="insurance" value=1 <? echo $_SESSION['insurancecheck'] ?>>
              <label class="form-check-label">I have contacted an insurance company to make sure you can insure the property</label>
                </div></li>
        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="financing" value=0 />
              <input class="form-check-input" type="checkbox"  name="financing" value=1 <? echo $_SESSION['financingcheck2'] ?>>
              <label class="form-check-label">I have obtained financing before COE: <?php echo $_SESSION['coedate'];?></label>
            </li>
        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="complete" value=0 />
              <input class="form-check-input" type="checkbox"  name="complete" value=1 <? echo $_SESSION['completecheck'] ?>>
              <label class="form-check-label">COE Done Deal!!!!!!</label>
            </div></li>
      


          <input type="hidden" name="update" value="update"/>
          <button class="btn btn-outline-success" type="submit">Update Checklist</button></form>
    <?php if($_SESSION['buyerseller'] == 1){echo "</fieldset>";}?>
</ul>
    </div>
 
 
    <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary rounded">    
      <ul class="list-group">
          <li class="list-group-item">
            <h5>Seller</h5>
          <form action="php/retd.php"  method="post" >
          <?php if($_SESSION['buyerseller'] == 0){echo "<fieldset disabled>";}?>
          <li class="list-group-item"><div class="form-check">
              <input type="hidden" name="sellersent" value=0 />
              <input class="form-check-input" type="checkbox" id="sent" name="sellersent" value=1 <? echo $_SESSION['sentcheck'] ?>>
              <label class="form-check-label">SPDS and CLUE sent</label>
            </div></li>

      


        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="sellerinspection" value=0 />
              <input class="form-check-input" type="checkbox" id="sellerinspection" name="sellerinspection" value=1 <? echo $_SESSION['inspectioncheck'] ?>>
              <label class="form-check-label">BINSER Requirements Complete</label>
                </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2">
                    BINSR
                  </button>
                
                
                <!-- The Modal -->
                <div class="modal fade" id="myModal2">
                  <div class="modal-dialog">
                    <div class="modal-content">
                
                      <!-- Modal Header -->
                      <div class="modal-header">
                          
                        <h4 class="modal-title">BINSR</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                
                      <!-- Modal body -->
                      <div class="modal-body">
                          <div class="input-group mb-3">
                            <span class="input-group-text">Price Adjustment</span>
                            <input type="text" class="form-control" name="binsr0" value="<?php echo $_SESSION['binsr0']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 1:</span>
                            <input type="text" class="form-control" name="binsr1" value="<?php echo $_SESSION['binsr1']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 2:</span>
                            <input type="text" class="form-control" name="binsr2" value="<?php echo $_SESSION['binsr2']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 3:</span>
                            <input type="text" class="form-control" name="binsr3" value="<?php echo $_SESSION['binsr3']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 4:</span>
                            <input type="text" class="form-control" name="binsr4" value="<?php echo $_SESSION['binsr4']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 5:</span>
                            <input type="text" class="form-control" name="binsr5" value="<?php echo $_SESSION['binsr5']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 6:</span>
                            <input type="text" class="form-control" name="binsr6" value="<?php echo $_SESSION['binsr6']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 7:</span>
                            <input type="text" class="form-control" name="binsr7" value="<?php echo $_SESSION['binsr7']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 8:</span>
                            <input type="text" class="form-control" name="binsr8" value="<?php echo $_SESSION['binsr8']?>"><br>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">Repair 9:</span>
                            <input type="text" class="form-control" name="binsr9" value="<?php echo $_SESSION['binsr9']?>"><br>
                          </div>
                 </div>
                      <!-- Modal footer -->
                      <div class="modal-footer">
                          
          
                         <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="acceptbinsr">Accept</button>    
                             
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="sendbinsr">Send Proposal</button> 
                      </div>
              
                    </div>
                  </div>

                </li>

        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="closingdocs" value=0 />
              <input class="form-check-input" type="checkbox"  name="closingdocs" value=1 <? echo $_SESSION['insurancecheck'] ?>>
              <label class="form-check-label">Closing documents signed</label>
                </div></li>
        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="financing" value=0 />
              <input class="form-check-input" type="checkbox"  name="financing" value=1 <? echo $_SESSION['financingcheck2'] ?>>
              <label class="form-check-label">seller checklist: <?php echo $_SESSION['coedate'];?></label>
            </li>
        <li class="list-group-item"><div class="form-check">
            <input type="hidden" name="complete" value=0 />
              <input class="form-check-input" type="checkbox"  name="complete" value=1 <? echo $_SESSION['completecheck'] ?>>
              <label class="form-check-label">COE Done Deal!!!!!!</label>
            </div></li>
      


          <input type="hidden" name="updateseller" value="updateseller"/>
          <button class="btn btn-outline-success" type="submit">Update Checklist</button></form>
    <?php if($_SESSION['buyerseller'] == 0){echo "</fieldset>";}?>
</ul>
    </div>
 </div>
 
 </div>
 </div>
 <div class="container-fluid mt-5 p-5 bg-transparent">
        
            <div class="shadow col-sm-12 p-3 bg-transparent text-dark border border border-primary border- 5 rounded">
                <div class="row">
                    <div class="col">
                <h4>Property Information</h4>
                 <form action="php/retd.php"  method="get" >
         
        <li class="list-group-item">Buyer name: <input type="text" class="d-inline-flex rounded-pill"  value="<? echo $_SESSION['buyer1']?>" name="buyer1" required ></li>
        <li class="list-group-item">Second Buyer name: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['buyer2']?>" name="buyer2" ></li>
        <li class="list-group-item">Seller name: <input type="text" class="form-control rounded-pill"  value="<? echo $_SESSION['seller1']?>" name="seller1" required ></li>
        <li class="list-group-item">Seller name: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['seller2']?>" name="seller2" ></li>
        <li class="list-group-item">Address: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['address']?>" name="address" ></li>
        <li class="list-group-item ">City: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['city'] ?>" name="city" ></li>
        <li class="list-group-item">County: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['county'] ?>" name="county" ></li>
        <li class="list-group-item">Zip: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['zip'] ?>" name="zip" ></li>
        <li class="list-group-item">Assessornum: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['assessornum']?>" name="assessornum" ></li>
        <li class="list-group-item">Legal Discription: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['legaldisc']?>" name="legaldisc" ></li>
        <li class="list-group-item">Year Built: <input type="number" class="d-inline-flex bd-highlight rounded-pill"  value="<? echo $_SESSION['yearbuilt']?>" name="yearbuilt" ></li>
        
       <li class="list-group-item"><b>Wastewater:</b><div class="form-check">
                <input type="radio" class="form-check-input"  name="wastewater" value="Sewer" <? echo $_SESSION['sewercheck']?>>
                <label class="form-check-label" for="radio1">Sewer</label>
              </div>

              <div class="form-check">
                <input type="radio" class="form-check-input"  name="wastewater" value="Septic" <? echo $_SESSION['septiccheck']?>>
                <label class="form-check-label" for="radio2">Septic</label>
              </div></li><br>
              
          <button draggable="true" class="btn btn-outline-success" name="updateproperty" value="updateproperty" type="submit">Update Property</button>
                </form></div>
                
    <div class="col">
                 <h4>Seller Agent Info</h4>
    <form action="php/retd.php"  method="get" >
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="collapse" data-bs-target="#demo" >Seller Agent</button>
        <div id="demo" class="collapse <? echo $_SESSION['agentbutton' .$inc]?>">
          <li class="list-group-item">Agent Name: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['agentname']?>" name="agentname" ></li>
          <li class="list-group-item">Agent Email: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['agentemail']?>" name="agentemail" ></li>
          <li class="list-group-item">Agent Liscence: <input type="number" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['agentlicense']?>" name="agentlicense" ></li>
          <li class="list-group-item">Additional Agent Name: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['agentname2']?>" name="agentname2" ></li>
          <li class="list-group-item">Additional Agent Liscence: <input type="number" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['agentlicense2']?>" name="agentlicense2" ></li>
          <li class="list-group-item">Agent Firm: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['firmname']?>" name="firmname"></li>
          <li class="list-group-item">Agent Firm Address: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['firmaddress']?>" name="firmaddress" ></li>
          <li class="list-group-item">Agent Firm Phone: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['firmphone']?>" name="firmphone" ></li>
          <li class="list-group-item">Agent Firm Liscence: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['firmlicense']?>" name="firmlicense" ></li>
          <button draggable="true" class="btn btn-outline-success" name="selleragent" value="selleragent" type="submit">Update Seller Agent</button>
          </form>
            </div></div>
            
            <div class="col">
                 <h4>Buyer Agent Info</h4>
        <form action="php/retd.php"  method="get" >
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="collapse" data-bs-target="#buyeragent" >Buyer Agent</button>
        <div id="buyeragent" class="collapse <? echo $_SESSION['agentbutton' .$inc]?>">
          <li class="list-group-item">Agent Name: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['buyeragentname']?>" name="buyeragentname" ></li>
          <li class="list-group-item">Agent Email: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['buyeragentemail']?>" name="buyeragentemail" ></li>
          <li class="list-group-item">Agent Liscence: <input type="number" class="d-inline-flex bd-highlight"  value="<? echo  $_SESSION['buyeragentlicense']?>" name="buyeragentlicense" ></li>
          <li class="list-group-item">Additional Agent Name: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyeragentname2']?>" name="buyeragentname2" ></li>
          <li class="list-group-item">Additional Agent Liscence: <input type="number" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyeragentlicense2']?>" name="buyeragentlicense2" ></li>
          <li class="list-group-item">Agent Firm: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyerfirmname']?>" name="buyerfirmname"></li>
          <li class="list-group-item">Agent Firm Address: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyerfirmaddress']?>" name="buyerfirmaddress" ></li>
          <li class="list-group-item">Agent Firm Phone: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyerfirmphone']?>" name="buyerfirmphone" ></li>
          <li class="list-group-item">Agent Firm Liscence: <input type="text" class="d-inline-flex bd-highlight"  value="<? echo $_SESSION['buyerfirmlicense']?>" name="buyerfirmlicense" ></li>
          <button draggable="true" class="btn btn-outline-success" name="buyeragent" value="buyeragent" type="submit">Update Buyer Agent</button>
          </form>
            </div></div>
            
            </div>
            
        </div>
</div>

<div class="shadow container p-5 my-5 border border-primary">
  <div class="row">
      <h3>Upload Your Signed Files Here</h3>
    <div class="col-sm-12 bg-white">
      <div class="file-field">
                  
                 <form method="post" id="fileform" enctype="multipart/form-data">
                    <input type="file" id="fileupload" name="fileupload"  class="btn btn-primary btn-sm float-left waves-effect waves-light"/>
                  <div class="mb-3">
  
                
                </div>
                  <div class="input-group mb-3">
                  <button class="btn btn-primary dropdown-toggle" id="fileinfo" type="button" data-bs-toggle="dropdown"  data-bs-auto-close="false" aria-expanded="false">File type</button>
                  <ul class="dropdown-menu">
                      
                <div class="container-fluid mt-1  bg-transparent">
                    <div class="row">
                        <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary border- 5 rounded">      <h5>File Type</h5>
                    <li>  
                    <input type="radio" class="btn-check" name="filetype" id="option1" value="Purchase Contract" autocomplete="off">
                    <label class="btn btn-outline-primary" for="option1">Purchase Contract</label>
                    
                        
                    </li>
                    <li>  
                    <input type="radio" class="btn-check" name="filetype" id="option2" value="BINSER" autocomplete="off">
                    <label class="btn btn-outline-primary" for="option2">BINSR</label>
                    <input type="text" id="filedate" name="filedate" hidden>
                    <input type="text" id="submittedby" name="submittedby" hidden>    
                    </li>
                    <li>  
                    <input type="radio" class="btn-check" name="filetype" id="option3" value="MISC" autocomplete="off">
                    <label class="btn btn-outline-primary" for="option3">MISC</label>
                    </li></div>
                <div class="shadow col-sm-6 p-3 bg-transparent text-dark border border border-primary border- 5 rounded">
                    <h5>Signed By</h5>
                    <input type="radio" class="btn-check" name="signedby" id="Buyer" value="Buyer" autocomplete="off">
                        <label class="btn btn-outline-primary" for="Buyer">Buyer</label>
                    <input type="radio" class="btn-check" name="signedby" id="Seller" value="Seller" autocomplete="off">
                        <label class="btn btn-outline-primary" for="Seller">Seller</label>
                    <input type="radio" class="btn-check" name="signedby" id="all" value="All Parties" autocomplete="off">
                        <label class="btn btn-outline-primary" for="all">All Parties</label>
                    <input type="radio" class="btn-check" name="signedby" id="none" value="None" autocomplete="off">
                        <label class="btn btn-outline-primary" for="none">None</label>       
                    </div><button type="submit" class="btn btn-primary" onclick="uploadFile()">Submit File</button>
                   </form></ul>
                 <div class="row"></div>
                 </div></div>
                </div>
                <div id="filetable">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>File Name</th>
                        <th>Document type</th>
                        <th>Submitted By</th>
                        <th>Signed By</th>
                        <th>Date Submitted</th>
                      </tr>
                    </thead>
                    <tbody id="usrfile">
                     
                      
                    </tbody>
                  </table>
                  </div>
                </div>
    </div>
  </div>
</div>




    <div class="shadow container p-5 my-5 border border-primary">
        
     <div class="row">


<?php $inc4 = 11; /* this is the 2+ contracts*/
      $inc = 10; /* this is the above contract*/
      $inc3 = 10;/* this is to disable previous contracts*/
      $inc5 = 1; /*counter offer button txt */
      $inc6 = 0;/*for the for loop  */
      
      
      if($_SESSION['counter'] === 1 or $_SESSION['counter'] === "counter"){
        $_SESSION['disabled'] = " disabled";}else{
        $_SESSION['disabled'] = "";
        }
      $_SESSION['counterbuttontext'] = "I Would Like To Counter";
      while(isset($_SESSION['contract_id' .$inc])){
     $inc6++;
     $inc++;
     }
     
    $inc7 = $inc6 - 1;
    
    
    
     if(in_array($_SESSION['userview'], ['101', '011', '111', '001'], true )){
         $inc6++;}
     
  
  
   --$inc6;
  
   $_SESSION['$inc6'] = $inc6;
      $inc = 10;
                  for($x = 0; $x < $inc6; $x++){
                   
                    $inc5 == 1 ? $_SESSION['counteroffer'] = "Original Offer" : $_SESSION['counteroffer'] = "Counter ";
                    $inc5 == 1 ? $_SESSION['countercount' .$inc5] = "" : $_SESSION['countercount' .$inc5] = $inc5;
                  
                  echo '
  <div class="col">
      <h1>'.$_SESSION['counteroffer'].$_SESSION['countercount' .$inc5].'</h1>
      <form action="php/generate.php"  method="get" >
          <fieldset disabled>
        

 
        <h1>Purchase Contract Summary</h1>
        <li class="list-group-item">Purchase Price: $<input type="number" class="d-inline-flex bd-highlight rounded-pill"  value="'.$_SESSION['purchaseprice' .$inc].'" name="purchaseprice" ></li>
        <li class="list-group-item">Earnest Money: $<input type="number" class="d-inline-flex bd-highlight rounded-pill"  value="'.$_SESSION['earnestmoney' .$inc].'" name="earnestmoney" ></li>
        <li class="list-group-item">Additional Down Payment: $<input type="number" class="d-inline-flex bd-highlight rounded-pill"  value="'.$_SESSION['additionaldown' .$inc].'" name="additionaldown" ></li>
        <li class="list-group-item">Financed Amount: $<input type="number" class="d-inline-flex bd-highlight rounded-pill"  value="'.$_SESSION['financed' .$inc].'" name="financed" ></li>

         <li class="list-group-item"><b>Earnest money will be sent by:</b><div class="form-check">
          <input type="radio" class="form-check-input" name="earnestmoneyform" value="Check" '.$_SESSION['earnestmoneyformcheck' .$inc].$_SESSION['disabled' .$inc3].'
          <label class="form-check-label" for="radio1">Check</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input"  name="earnestmoneyform" value="Wire" '. $_SESSION['earnestmoneyformwire' .$inc].$_SESSION['disabled' .$inc3].'
          <label class="form-check-label" for="radio2">Wire</label>
        </div></li>

      <li class="list-group-item"><b>Earnest money will be held by:</b><div class="form-check">
          <input type="radio" class="form-check-input"  name="earnestmoneyheld" value="Escrow" '. $_SESSION['earnestmoneyheldescrow' .$inc].$_SESSION['disabled' .$inc3].'
          <label class="form-check-label" for="radio1">Escrow Company</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input"  name="earnestmoneyheld" value="Broker" '. $_SESSION['earnestmoneyheldbroker' .$inc].$_SESSION['disabled' .$inc3].'
          <label class="form-check-label" for="radio2">Broker</label>
        </div></li>

      <li class="list-group-item">Close of Escrow Date: <input type="date" class="form-control rounded-pill"  name="coedate" value="'. $_SESSION['coedate' .$inc].'"></li>
      <li class="list-group-item">
      <h5>Addenda:</h5>
    <input type="hidden" name="buyercontingency" value=0 />
      <input type="checkbox" class="form-check-input"  name="buyercontingency" value=1 '. $_SESSION['buyercontingencycheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="buyercontingency">Buyer Contingency</label>
    <input type="hidden" name="Waterwell" value=0 />
      <input type="checkbox" class="form-check-input"  name="waterwell" value=1 '. $_SESSION['waterwellcheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="waterwell">Waterwell</label>

    <input type="hidden" name="hoa" value=0 />
      <input type="checkbox" class="form-check-input"  name="hoa" value=1 '. $_SESSION['hoacheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="hoa">HOA</label>

    <input type="hidden" name="loanassuption" value=0 />
      <input type="checkbox" class="form-check-input" name="loanassuption" value=1 '.$_SESSION['loanassuptioncheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="loanassuption">Loan Assumption</label>
    <input type="hidden" name="sellerfinancing" value=0 />
      <input type="checkbox" class="form-check-input"  name="sellerfinancing" value=1 '. $_SESSION['sellerfinancingcheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="sellerfinancing">sellerfinancing</label>

    <input type="hidden" name="shortsale" value=0 />
      <input type="checkbox" class="form-check-input"  name="shortsale" value=1 '. $_SESSION['shortsalecheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="shortsale">Short Sale</label>

    <input type="hidden" name="other" value=0 />
      <input type="checkbox" class="form-check-input"  name="other" value=1 '. $_SESSION['othercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="other">Other Addenda</label>
      </li>
      
      
      <li class="list-group-item">
      <h5>Personal Property to be Included:</h5>

    <input type="hidden" name="refrigerator" value=0 />
      <input type="checkbox" class="form-check-input"  name="refrigerator" value=1 '.$_SESSION['refrigeratorcheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="refrigerator">Refrigerator</label>

    <input type="hidden" name="washer" value=0 />
      <input type="checkbox" class="form-check-input"  name="washer" value=1  '.$_SESSION['washercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="washer">Washer</label>

    <input type="hidden" name="dryer" value=0 />
      <input type="checkbox" class="form-check-input"  name="dryer" value=1 '.$_SESSION['dryercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="dryer">Dryer</label>

    <input type="hidden" name="spa" value=0 />
      <input type="checkbox" class="form-check-input"  name="spa" value=1 '.$_SESSION['spacheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="spa">Spa</label>
      </li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="'. $_SESSION['personalprop' .$inc].'" name="personalprop" ></li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-flex bd-highlight rounded-pill"  value="'. $_SESSION['personalprop2' .$inc].'" name="personalprop2" ></li>
      <li class="list-group-item">Date Toured: <input type="date" class="d-inline-flex bd-highlight rounded-pill"  value="'.$_SESSION['tour' .$inc].'" name="tour" ></li>
      
    <li class="list-group-item">
      <h5>Your Purchase Will Use:</h5>

      <input type="radio" class="form-check-input"  name="financingtype" value="Cash" '.$_SESSION['cash' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio0">Cash</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="Conventional" '. $_SESSION['conventional' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">Conventional</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="FHA" '.$_SESSION['fha' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">FHA</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="VA" '.$_SESSION['va' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">VA</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="USDA" '.$_SESSION['usda' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">USDA</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="Assumption" '.$_SESSION['assumption' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">Assumption</label>

      <input type="radio" class="form-check-input"  name="financingtype" value="Seller Carryback" '. $_SESSION['sellercarryback' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">Seller Carryback</label>
    </li>
    
    
    <li class="list-group-item">
      <h5>Seller Consessions Requested:</h5>

      <input type="number" class="form-control rounded-pill"  placeholder="Seller Consessions $" name="sellerconsessions" value="'.$_SESSION['sellerconsessionsdollar' .$inc].'">
    </li>
    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Ordered By:</h5>

      <input type="checkbox" class="form-check-input"  name="homewarrantyorderedby" value="Buyer" '. $_SESSION['homewarrantyorderedbybuyercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="homewarrantyorderedby">Buyer</label>

      <input type="checkbox" class="form-check-input"  name="homewarrantyorderedby" value="Seller" '. $_SESSION['homewarrantyorderedbysellercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="homewarrantyorderedby">Seller</label>
    </li>

    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Paid By:</h5>
      <input type="checkbox" class="form-check-input"  name="homewarrantypaidby" value="Buyer" '. $_SESSION['homewarrantypaidbybuyercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio1">Buyer</label>

      <input type="checkbox" class="form-check-input"  name="homewarrantypaidby" value="Seller" '. $_SESSION['homewarrantypaidbysellercheck' .$inc].$_SESSION['disabled' .$inc3].'>
      <label class="form-check-label" for="radio2">Seller</label>
    </li>
    <li class="list-group-item">
      <h5>Any Additional Terms:</h5>
      <input type="text" class="form-control rounded-pill" name="additionalterms" placeholder="Additional Terms" value="'.$_SESSION['additionalterms' .$inc].'">
    </li>
   
    <li class="list-group-item">
      <h5>Seller Must Respond By: </h5>
      <input type="datetime-local" class="form-control rounded-pill"  name="accepttime" value='.date_format($_SESSION['accepttimedate' .$inc], "Y-m-d\TH:i:s").'>
    </li>
     </fieldset>'; 
        if($inc7 == 0){echo '
        <div class="d-grid col-6">
        <br><button type="submit" name="savechanges" class="btn btn-primary" '.$_SESSION['disabled'].'>Save Changes</button>
    
    <br><button type="submit" name="create" class="btn btn-primary"'.$_SESSION['disabled'].'>I Accept Create Contract</button></form><br>';}else{echo '</form><br>';}
    
    
       
      if(!in_array($_SESSION['userview'], ['111', '001'], true) && $inc7 == 0){
       echo '<form action="php/retd.php"  method="post">
             <input type="hidden" name="counter" value="counter"/>
            <button class="btn btn-outline-primary" type="submit" '.$_SESSION['disabled'].'>'.$_SESSION['counterbuttontext'].'</button> </form></div></div>

';}else{echo '</div>';}


if(isset($_SESSION['decrementdisable'])){
    $inc4++;
   
  /*  unset($_SESSION['decrementdisable']);*/
}

$inc4++;
$inc++;
$inc3++;
$inc5++;
$inc7--;
}



if($_SESSION['counter'] == 1 or $_SESSION['counter'] == "counter"){
    if($_SESSION['usercreated'] == 0){  $inc--;}
     $inc5 == 1 ? $_SESSION['counteroffer'] = "Original Offer" : $_SESSION['counteroffer'] = "Counter ";
                    $inc5 == 1 ? $_SESSION['countercount' .$inc5] = "" : $_SESSION['countercount' .$inc5] = $inc5;
    echo '
  <div class="col">
      <h1>'.$_SESSION['counteroffer'].$_SESSION['countercount' .$inc5].'</h1>
      <form action="php/generate.php"  method="get" >

        <h1>Purchase Contract Summary</h1>
        <li class="list-group-item">Purchase Price: $<input type="number" class="d-inline-flex bd-highlight" id="purchaseprice0" value="'.$_SESSION['purchaseprice' .$inc].'" name="purchaseprice" ></li>
        <li class="list-group-item">Earnest Money: $<input type="number" class="d-inline-flex bd-highlight" id="earnestmoney0" value="'.$_SESSION['earnestmoney' .$inc].'" name="earnestmoney" ></li>
        <li class="list-group-item">Additional Down Payment: $<input type="number" class="d-inline-flex bd-highlight" id="additionaldown0" value="'.$_SESSION['additionaldown' .$inc].'" name="additionaldown" ></li>
        <li class="list-group-item">Financed Amount: $<input type="number" class="d-inline-flex bd-highlight" id="financed0" value="'.$_SESSION['financed' .$inc].'" name="financed" ></li>

         <li class="list-group-item"><b>Earnest money will be sent by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform0" name="earnestmoneyform" value="Check" '.$_SESSION['earnestmoneyformcheck' .$inc].'
          <label class="form-check-label" for="radio1">Check</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyform1" name="earnestmoneyform" value="Wire" '. $_SESSION['earnestmoneyformwire' .$inc].'
          <label class="form-check-label" for="radio2">Wire</label>
        </div></li>

      <li class="list-group-item"><b>Earnest money will be held by:</b><div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld0" name="earnestmoneyheld" value="Escrow" '. $_SESSION['earnestmoneyheldescrow' .$inc].'
          <label class="form-check-label" for="radio1">Escrow Company</label>
        </div>

        <div class="form-check">
          <input type="radio" class="form-check-input" id="earnestmoneyheld1" name="earnestmoneyheld" value="Broker" '. $_SESSION['earnestmoneyheldbroker' .$inc].'
          <label class="form-check-label" for="radio2">Broker</label>
        </div></li>

      <li class="list-group-item">Close of Escrow Date: <input type="date" class="form-control" id="coedate" name="coedate" value="'. $_SESSION['coedate' .$inc].'"></li>
      <li class="list-group-item">
      <h5>Addenda:</h5>
    <input type="hidden" name="buyercontingency" value=0 />
      <input type="checkbox" class="form-check-input" id="buyercontingency0" name="buyercontingency" value=1 '. $_SESSION['buyercontingencycheck' .$inc].'>
      <label class="form-check-label" for="buyercontingency">Buyer Contingency</label>
    <input type="hidden" name="Waterwell" value=0 />
      <input type="checkbox" class="form-check-input" id="Waterwell0" name="waterwell" value=1 '. $_SESSION['waterwellcheck' .$inc].'>
      <label class="form-check-label" for="waterwell">Waterwell</label>

    <input type="hidden" name="hoa" value=0 />
      <input type="checkbox" class="form-check-input" id="hoa0" name="hoa" value=1 '. $_SESSION['hoacheck' .$inc].'>
      <label class="form-check-label" for="hoa">HOA</label>

    <input type="hidden" name="loanassuption" value=0 />
      <input type="checkbox" class="form-check-input" id="loanassuption0" name="loanassuption" value=1 '.$_SESSION['loanassuptioncheck' .$inc].'>
      <label class="form-check-label" for="loanassuption">Loan Assumption</label>
    <input type="hidden" name="sellerfinancing" value=0 />
      <input type="checkbox" class="form-check-input" id="sellerfinancing0" name="sellerfinancing" value=1 '. $_SESSION['sellerfinancingcheck' .$inc].'>
      <label class="form-check-label" for="sellerfinancing">sellerfinancing</label>

    <input type="hidden" name="shortsale" value=0 />
      <input type="checkbox" class="form-check-input" id="shortsale0" name="shortsale" value=1 '. $_SESSION['shortsalecheck' .$inc].'>
      <label class="form-check-label" for="shortsale">Short Sale</label>

    <input type="hidden" name="other" value=0 />
      <input type="checkbox" class="form-check-input" id="other0" name="other" value=1 '. $_SESSION['othercheck' .$inc].'>
      <label class="form-check-label" for="other">Other Addenda</label>
      </li>
      
      
      <li class="list-group-item">
      <h5>Personal Property to be Included:</h5>

    <input type="hidden" name="refrigerator" value=0 />
      <input type="checkbox" class="form-check-input" id="refrigerator0" name="refrigerator" value=1 '.$_SESSION['refrigeratorcheck' .$inc].'>
      <label class="form-check-label" for="refrigerator">Refrigerator</label>

    <input type="hidden" name="washer" value=0 />
      <input type="checkbox" class="form-check-input" id="washer0" name="washer" value=1  '.$_SESSION['washercheck' .$inc].'>
      <label class="form-check-label" for="washer">Washer</label>

    <input type="hidden" name="dryer" value=0 />
      <input type="checkbox" class="form-check-input" id="dryer0" name="dryer" value=1 '.$_SESSION['dryercheck' .$inc].'>
      <label class="form-check-label" for="dryer">Dryer</label>

    <input type="hidden" name="spa" value=0 />
      <input type="checkbox" class="form-check-input" id="spa0" name="spa" value=1 '.$_SESSION['spacheck' .$inc].'>
      <label class="form-check-label" for="spa">Spa</label>
      </li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-flex bd-highlight" id="personalprop0" value="'. $_SESSION['personalprop' .$inc].'" name="personalprop" ></li>
      <li class="list-group-item">Other Personal Prop: <input type="text" class="d-inline-flex bd-highlight" id="personalprop20" value="'. $_SESSION['personalprop2' .$inc].'" name="personalprop2" ></li>
      <li class="list-group-item">Date Toured: <input type="date0" class="d-inline-flex bd-highlight" id="tour" value="'.$_SESSION['tour' .$inc].'" name="tour" ></li>
      
    <li class="list-group-item">
      <h5>Your Purchase Will Use:</h5>

      <input type="radio" class="form-check-input" id="financingtype0" name="financingtype" value="Cash" '.$_SESSION['cash' .$inc].'>
      <label class="form-check-label" for="radio0">Cash</label>

      <input type="radio" class="form-check-input" id="financingtype1" name="financingtype" value="Conventional" '. $_SESSION['conventional' .$inc].'>
      <label class="form-check-label" for="radio1">Conventional</label>

      <input type="radio" class="form-check-input" id="financingtype2" name="financingtype" value="FHA" '.$_SESSION['fha' .$inc].'>
      <label class="form-check-label" for="radio1">FHA</label>

      <input type="radio" class="form-check-input" id="financingtype3" name="financingtype" value="VA" '.$_SESSION['va' .$inc].'>
      <label class="form-check-label" for="radio1">VA</label>

      <input type="radio" class="form-check-input" id="financingtype4" name="financingtype" value="USDA" '.$_SESSION['usda' .$inc].'>
      <label class="form-check-label" for="radio1">USDA</label>

      <input type="radio" class="form-check-input" id="financingtype5" name="financingtype" value="Assumption" '.$_SESSION['assumption' .$inc].'>
      <label class="form-check-label" for="radio1">Assumption</label>

      <input type="radio" class="form-check-input" id="financingtype6" name="financingtype" value="Seller Carryback" '. $_SESSION['sellercarryback' .$inc].'>
      <label class="form-check-label" for="radio1">Seller Carryback</label>
    </li>
    
    
    <li class="list-group-item">
      <h5>Seller Consessions Requested:</h5>

      <input type="number" class="form-control" id="sellerconsessions0" placeholder="Seller Consessions $" name="sellerconsessions" value="'.$_SESSION['sellerconsessionsdollar' .$inc].'">
    </li>
    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Ordered By:</h5>

      <input type="checkbox" class="form-check-input" id="homewarrantyorderedby0" name="homewarrantyorderedby" value="Buyer" '. $_SESSION['homewarrantyorderedbybuyercheck' .$inc].'>
      <label class="form-check-label" for="homewarrantyorderedby">Buyer</label>

      <input type="checkbox" class="form-check-input" id="homewarrantyorderedby1" name="homewarrantyorderedby" value="Seller" '. $_SESSION['homewarrantyorderedbysellercheck' .$inc].'>
      <label class="form-check-label" for="homewarrantyorderedby">Seller</label>
    </li>

    <li class="list-group-item">
      <h5>Home Warranty Plan May Be Paid By:</h5>
      <input type="checkbox" class="form-check-input" id="homewarrantypaidby0" name="homewarrantypaidby" value="Buyer" '. $_SESSION['homewarrantypaidbybuyercheck' .$inc].'>
      <label class="form-check-label" for="radio1">Buyer</label>

      <input type="checkbox" class="form-check-input" id="homewarrantypaidby1" name="homewarrantypaidby" value="Seller" '. $_SESSION['homewarrantypaidbysellercheck' .$inc].'>
      <label class="form-check-label" for="radio2">Seller</label>
    </li>
    <li class="list-group-item">
      <h5>Any Additional Terms:</h5>
      <input type="text" class="form-control" name="additionalterms" placeholder="Additional Terms" value="'.$_SESSION['additionalterms' .$inc].'">
    </li>
   
    <li class="list-group-item">
      <h5>Seller Must Respond By: </h5>
      <input type="datetime-local" class="form-control" id="accepttime0" name="accepttime" value='.date_format($_SESSION['accepttimedate' .$inc], "Y-m-d\TH:i:s").'>
    </li>
     
 
    <br><button type="submit" name="create" class="btn btn-primary btn-lg"'.$_SESSION['disabled' .$inc4].'>I Accept Create Contract</button>
    
    <br><button type="submit" name="sendsave" class="btn btn-primary btn-sm" value=1>Save Changes</button><br>
    <br>
   
    <button type="submit" name="sendsave" class="btn btn-primary btn-sm" value=2>Send Counter</button><br>
    
       </form>
       '; 
       
       if($_SESSION['$inc6'] != 0){echo '
       <form action="php/retd.php"  method="post">
             <input type="hidden" name="counter" value="counter"/>
            <button class="btn btn-outline-primary" type="submit" href="https://response.azrealestatehelper.com" '.$_SESSION['disabled' .$inc4].'>Hide Counter Offer</button></form>';}

}

?>
 

        <div class="footer">
          
        </div></div>
   
  </body>
</html>
