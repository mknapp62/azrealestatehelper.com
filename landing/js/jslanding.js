/*
//------should only display if existing contract exists will display on home page
if (var Purchase !== undefined && var null !== null){
  document.getElementById('latestPurchase').innerHTML = "displayaddress and link"; //place address here
}

*/
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover({html: true});
    
$('#form4').submit(function(e){
   e.preventDefault();
   e.stopImmediatePropagation();
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
                $('#badkey').empty();
                $('#goodkey').empty();
                $('#goodkey').hide();
                $('#badkey').hide();
                var emailexists = 'null';
                var userupdated = 'null';
                var passnomatch = 'null';
                var emailexists = data.emailexists;
                var userupdated = data.userupdated;
                var passnomatch = data.passnomatch;
                if(passnomatch != 'null'){
                    $('#badkey').append(passnomatch);
                    $('#badkey').show();
                    console.log(passnomatch);
                }
                if(userupdated != 'null'){
                    $('#badkey').append(userupdated);
                    $('#badkey').show();
                 console.log(userupdated);
                }
                if(emailexists != 'null'){
                    $('#badkey').append(emailexists);
                    $('#badkey').show();
                    console.log(emailexists);
                }
                
            });
          return false;
        } });   
    
    
});
});