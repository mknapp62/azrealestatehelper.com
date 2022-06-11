/*
//------should only display if existing contract exists will display on home page
if (var Purchase !== undefined && var null !== null){
  document.getElementById('latestPurchase').innerHTML = "displayaddress and link"; //place address here
}

*/ 
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover({html: true});
  alert('This website is NOT complete and should not be relied upon to create or negotiate offers.  The goal is to create a negotiation/transaction interface, to reduce the friction in buying and selling residential real estate.  Current needs are Legal (Re-Write Residential Sales Contract) and help from any other developers.  Languages/frameworks include: PHP, Javascript, JQuery, CSS, Bootstrap 5, MySql, PDFTK, Linux VPS on apache server.  Let me know if you can contribute mknapp62@gmail.com https://github.com/mknapp62/azrealestatehelper.com (By hitting OK you agree to use cookies)');
  
   $.getJSON("php/retd.php", function(data){
       
       var e = data.e;
       var sendkey = data.sendkey;
       var resetmodalbutton = data.resetmodalbutton;
       console.log(data);
       console.log(resetmodalbutton);
       if(e == 1){
           $('#myModal').modal('show');
           $('#resettext').text('Email exists, send Key to reset password?');
           console.log("modal should show");
           e = 0;
           console.log(e);
        if(sendkey == 1){   $('#resetbutton').show();
             $('#sendkey').prop('disabled', true);
            setTimeout(function() {
                $('#sendkey').prop('disabled', false);
                }, 5000);
        }
       
       }
   
    console.log(resetmodalbutton);
        
   });
 
 
 
 
   $('#form3').submit(function(e){
       
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
       console.log(data);
       console.log(emailexists);
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
        
        if(Incorrectkey !== null && Incorrectkey !== 1){   $('<h5>Incorrect key: "'+Incorrectkey+'"  Please use the key in the last email sent</h5>').appendTo('#badkey');
            Incorrectkey = "";
        }else if(Incorrectkey == 1){
            $('#CreatePassword').show();
            $('#badkey, #1, #resetket, #resetbutton, #sendkey').hide();
        }
       
           console.log("reset should show");
           return false;
            });
    }})});
    
    
  $('#form4').submit(function(e){
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
       console.log(data);
       console.log(emailexists);
       if(emailexists == 1){
           $('#myModal').modal('show');
           console.log("modal should show");
        if(sendkey == 1){   $('#resetbutton').hide();
           $('#resetket').hide();
        }
       }
        if(Incorrectkey == 1){   $('<h5>Incorrect key: Please use the key in the last email that was sent</h5>').appendTo('#badkey');
            Incorrectkey = 0;
        }else{
            $('#CreatePassword').show();
        }
       
           console.log("key entered");
           return false;
           
           
        });
    }})});
    
    $('#form5').submit(function(e){
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
       var passnomatch = data.passnomatch;
       var emailexists = data.e;
       var sendkey = data.sendkey;
       console.log(data);
       console.log(passnomatch);
       if(emailexists == 1){
           $('#myModal').modal('show');
           console.log("modal should show");
        if(sendkey == 1){   $('#resetbutton').show();
            
        }
       }
       if(passnomatch != 'Passwords dont match silly'){
           window.location.href = "http://www.landing.azrealestatehelper.com";
       }else{$('#passnomatch').show();
           $('#passnomatch').text(passnomatch)}
           console.log("reset should show");
           return false;
            });
    }})});
    
    
});

    
