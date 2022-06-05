/*
//------should only display if existing contract exists will display on home page
if (var Purchase !== undefined && var null !== null){
  document.getElementById('latestPurchase').innerHTML = "displayaddress and link"; //place address here
}

*/
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover({html: true});
    $('#address').focusout(function(){
        $('#header2').text($('#address').val());
        $('#header2').fadeIn(4000);
    });

});
