        if ( window.history.replaceState ) {
        //prevents repost on reload
        window.history.replaceState( null, null, window.location.href );
    }
    
   

    $(document).ready(function(){
      $('[data-bs-toggle="popover"]').popover({html: true});
      
      
      //CONTROLS WHAT CONTRACT BUTTONS APPEAR WHEN
      
      var inc2 = 10;
    //SEARCH HOW MANY ARE VISIBLE
     while($('#b1' + inc2).length !== 0){
          console.log(inc2);
          inc2++;
      }
    //HIDES ALL BUT THE LAST CONTRACTS BUTTONS
       inc2 = inc2 - 10;
        console.log(inc2);
        for (let i = 1; i < inc2; i++) {
            var inc3 = 10;
          $('#b1' + inc3 + ', #b2' + inc3 + ', #b3' + inc3).hide();
       
          console.log(inc3);
          inc3++;
          
        }

        //HIDES LAST CONTRACT BUTTON WHEN COUNTER IS VISIBLE
        
        if($('#countercol' + name).length !== 0){
        
        $('#b1' + inc3 + ', #b2' + inc3 + ', #b3' + inc3).hide();
        }
    
  
  
$('#myModal').modal({backdrop: 'static', keyboard: false});
        $("#binserp").css("display", "none");
    $("#inspection, #binserp").click(function(){
      $("#binserp").toggle("slow");});
    /*   TOGGLE RESET PASSWORD*/
    
       $('#pwdreset').click(function(){
       
           $('#sendkey, #1, #resetket, #resetbutton, #a, #b, #c').toggle();
           if($('#1').css('display') != 'none'){
               $('#pwdreset').text('Back to sign in');
           }else{
               $('#pwdreset').text('Reset Password');
           }
       });
       
     
     //USER SIGNIN/SIGNUP
     function submitForm(){
        $('#myform1').submit();
    }

    $('#myform1').on('submit', function(){
        var that =$(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};
            
        that.find('[name]').each(function(index, val){
            var that = $(this),
             name = that.attr('name'),
             value = that.val();
            data[name] = value;
        });
        
        $.ajax({
            url: url,
            type: type,
            data: data,
             success: function(response){
                var pleasesignin = '';
                var IncorrectPass = '';
                 $.getJSON('php/retd.php', function(data){
                      var IncorrectPass = data.IncorrectPass;
                      window.pleasesignin = data.pleasesignin;
                      console.log(IncorrectPass);
                $('#myModal').modal('hide');});
                return false;
            } });
            
        }); 
    
    function submitForm2(){
        $('#myform2').submit();
    }

    $('#myform2').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        if($('#createpwd').val() != $('#createpwd2').val()){
            $('#passmatch').text('Passwords dont match');
            setTimeout(function (){
                 $('#passmatch').empty();
            }, 5000);
          
        }
        var that =$(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};
            
        that.find('[name]').each(function(index, val){
            var that = $(this),
             name = that.attr('name'),
             value = that.val();
            data[name] = value;
        });
        
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response){
                console.log(response);
                 $.getJSON('php/retd.php', function(data){
                var pleasesignin = data.pleasesignin;
                var emailexists = data.emailexists;
                if(emailexists == 1){
                    $('#emailexists').text('An account with this Email already exists');
                    setTimeout(function (){
                         $('#emailexists').empty();
                    }, 5000);
               }
               if(pleasesignin != 1){
                $('#myModal').modal('hide');
                location.reload();
                }
                 });return false;
            }
        });
       
    //    $('#myModal').modal('hide');
        return false;
    });  
    
    
    $('#form3, #form5').submit(function(e){
      e.stopImmediatePropagation();
    e.preventDefault();
    var that =$(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};
        
    that.find('[name]').each(function(index, val){
        var that = $(this),
         name = that.attr('name'),
         value = that.val();
        data[name] = value;
    });
    
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(response){
            console.log(response);
            $.getJSON("php/retd.php", function(data){
       var Incorrectkey = data.Incorrectkey;
       var emailexists = data.e;
       var sendkey = data.sendkey;
       var passnomatch = data.passnomatch;
       var pleasesignin = data.pleasesignin;
       console.log(data);
       console.log(Incorrectkey);
       $('#resetket, #resetbutton').show();
           $('#sendkey').prop('disabled', true);
            setTimeout(function() {
                $('#sendkey').prop('disabled', false);
                }, 5000);
       if(emailexists == 1){
           $('#myModal').modal('show');
           console.log("modal should show");}
        if(sendkey == 1){   $('#resetbutton').show();
            $('#resetket').show();
            $('#sendkey').prop('disabled', true);
            setTimeout(function() {
                $('#sendkey').prop('disabled', false);
                $('#sendkey').text('Click to resend');
                }, 10000);
        }
        
        if(Incorrectkey !== null && Incorrectkey !== 1 && Incorrectkey !== ''){   $('<h5>Incorrect key: "'+Incorrectkey+'"  Please use the key in the last email sent</h5>').appendTo('#badkey');
             setTimeout(function() {
                 $('#badkey').empty();
             }, 5000);
        }else if(Incorrectkey == 1){
            $('#CreatePassword').show();
            $('#badkey, #1, #resetket, #resetbutton, #sendkey').hide();
        }
        if(passnomatch == 'Passwords dont match silly'){
           $('#passnomatch').show();
           $('#passnomatch').text(passnomatch);
        }
        if(pleasesignin != 1){
            $('#myModal').modal('hide');
            location.reload();
        }
         console.log("reset should show");
         return false;
            });
    }})
        
    });
    });
    
   //INFO BOX
    $(document).ready(function(){
        $("#bsent").css("display", "none");
    $("#sentq").mouseenter(function(){
      $("#bsent").toggle("slow");
     
        });
    
/*LOAD UPLOADED FILES*/
    
        $("#fileinfo").css("display", "none");
   $("#fileupload").change(function(){
    if($("#fileupload").val()!==''){
      $("#fileinfo").show(500);
    }else{
        $("#fileinfo").hide();
    }});
    

    
        $("#bsent").css("display", "none");
    $("#sentq").mouseleave(function(){
      $("#bsent").toggle("slow");
        });
    });
   
   
        var loggedin = '';
        var user_id = '';
        var sellerbuyer = '';
        var contract_id = '';
        var submitteddate = '';
        var filetype1 = '';
        var signedby = '';
        var pleasesignin = '';
        var IncorrectPass = '';
   $.ajax({
       url: 'php/retd.php',
       success: function(data){
           
   $.getJSON('php/retd.php', function(data){
        window.loggedin = data.loggedin;
         window.id = data.id;
         window.contract_id = data.contract_id;
         window.pleasesignin = data.pleasesignin;
            window.user_id = data.id;
             window.sellerbuyer = data.sellerbuyer;
             window.submitteddate = data.submitteddate;
             window.filetype1 = data.filetype1;
             window.signedby = data.signedby;
             window.IncorrectPass = data.IncorrectPass;
             window.hidecreateaccount = data.hidecreateaccount;
             console.log(hidecreateaccount);
             console.log(data.contract_id); 
           if(pleasesignin == 1){$('#myModal').modal(
        setTimeout(function(){
             if(IncorrectPass !== null){
                        $('#myModal').modal('show');
                        $('#passwordmatch').show();}
             if(hidecreateaccount == 1){
                 $('#d, #e, #f, #g, #h').hide();
             }
                console.log('modal should show');
           $('#myModal').modal('show');
        }, 1000));}});
       }});

   // console.log("fileextension " + fileextension[1&&0]);
  
    
          
    
   
   /*LOAD UPLOADED FILES*/
setTimeout(function(){
    var dir = "php/upload/" + contract_id;
    var fileextension = [".jpg", ".pdf"];

   
    $.ajax({
        url: dir,
        success: function(data){
        var inc = 0;
             $(data).find("a:contains(" + "." + ")").each(function () {
            var filename = this.href.replace(window.location.host, "").replace("https://", "");
            var filename = filename.replace("/", "");
            $("#usrfile").prepend("<tr><td ><a target='_blank' rel='noopener noreferrer' href='" + dir +'/'+ filename + "' class='btn btn-outline-info'>"+filename+"</a></td><td >"+filetype1[inc]+"</td><td >"+sellerbuyer[inc]+"</td><td >"+signedby[inc]+"</td><td >"+submitteddate[inc]+"</td></tr>");
            
            inc++;
            console.log(inc);
        });
        }

        }); }, 1000);
    

    
    
    
  /*REQUIRE USER TO SIGN IN OR UP---------------*/
   $(document).ready(function(){
    
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
      
       
        var today =  month + "-" + day + "-" + year;
      $('#filedate').val(today);  
  
      console.log(today);
   });
    
/*UPLOAD FILE FUNCTION*/
    
        function uploadFile() {
 
         let formData1 = new FormData();
          formData1.append("file", fileupload.files[0]);
          
             fetch("php/retd.php", {
               
                method: "POST",
                
                body: formData1,
                enctype: "multipart/form-data"
                });
                
            alert('File upload');
            return false;}
