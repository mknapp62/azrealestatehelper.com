
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover({html: true});
  $('#resetbutton1').click(function(e) {
      e.stopImmediatePropagation();
      $('.hideform').toggle('slow');
      if($('#resetbutton1').text() == "Reset Password"){
      $('#resetbutton1').text('Log In');}else{
         $('#resetbutton1').text('Reset Password'); 
      }
  });
 
$('#earnestmoney').on('keyup', function(){
       var total = $('#purchaseprice').val() - $('#earnestmoney').val() -$('#financed').val();
        $('#additionaldown').val(Number(total));
        
});
});

$(document).ready(function(){
           $.getJSON('php/retd.php', function(data){
             console.log(data.contract);
             console.log(data.id);
           });
}); 
 

 $(document).ready(function(){
     $.getJSON('php/retd.php', function(data){
     if(data.id == 1){
         $('#usrreq').hide();
         $('#new').show();
     }else{
         $('#new').hide();
         $('#usrreq').show();
     }
     });
    
 }); 

function submitForm1(){
        $('#form1').submit();
    }

$('#form1').on('submit', function(){
    if($('#createpwd').val() != $('#createpwd2').val()){
        $('#matchingerror').text('Passwords Dont Match');
        setTimeout(function() {$('#matchingerror').empty()}, 2000);
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
        }
    });
   
     $.getJSON('php/retd.php', function(data){
    if(data.id == 1){
         $('#usrreq').hide();
         $('#new').show();
         $('#myModal').modal('show');
         if(data.e == 1){
         $('#emailexists').text('An account with this Email already exists');
          setTimeout(function() {$('#emailexists').empty()}, 2000);}
     }else{
         $('#new').hide();
         $('#usrreq').show();
     }});
    return false;
});
    
    
    function submitForm(){
        $('#form2').submit();
    }

$('#form2').on('submit', function(){
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
 
        }
    });
      $.getJSON('php/retd.php', function(data){
    if(data.id == 1){
         $('#usrreq').hide();
         $('#new').show();
         $('#myModal').modal('show');
         $('#IncorrectPass2').text('Incorrect Email or Password');
          setTimeout(function() {$('#IncorrectPass2').empty()}, 2000);
     }else{
         $('#new').hide();
         $('#usrreq').show();
         $('#myModal').modal('hide');
     }});
    return false;
});

 $('#form3').submit(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    $('#sendkey').prop('disabled', true);
    setTimeout(function() {$('#sendkey').prop('disabled', false);}, 3000);
    $('#resetbutton').show('slow');
    $('#resetket').show('slow');
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
                var id = data.id;
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
        
        if(Incorrectkey == 1){ $('#resetket').show('slow');
        $('#badkey').show('slow');
        setTimeout(function() {$('#badkey').hide('slow')}, 3000);
        }
     
            $('#resetbutton').show();
        }
     if(id != 1){ $('#CreatePassword').show('slow');
     $('#resetbutton').hide();
           $('#resetket').hide();
          }
           return false;
            });
    }})});
    
     $('#form5').submit(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    if($('#createpwd3').val() != $('#createpwd4').val()){
        $('#matchingerror2').text('Passwords Dont Match');
        setTimeout(function() {$('#matchingerror2').empty()}, 2000);
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
            $.getJSON("php/retd.php", function(data){
               var passchange = data.passchange; 
               if(passchange == 1){
                   $('#myModal').modal('hide');
                   alert('password changed!');
               }
})
}
});
});
