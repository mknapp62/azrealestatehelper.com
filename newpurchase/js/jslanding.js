/*
//------should only display if existing contract exists will display on home page
if (var Purchase !== undefined && var null !== null){
  document.getElementById('latestPurchase').innerHTML = "displayaddress and link"; //place address here
}

*/
$(document).ready(function(){
  $('[data-bs-toggle="popover"]').popover({html: true});});


  var id = "<?php echo $_SESSION['name'];?>";
  if("<?php isset($_SESSION['user_id']);?>"){
    $("#Buyer1").val(id);
  }
