$(document).on('change', '#type_id', function() {
   var type_id= $(this).val();
   if(type_id==0)
   {
     $("#discount").attr("required",true);
    $(".discount").show();
   }else {
   	$('#discount-input').val(0);
    $("#discount").attr("required",false);
    $(".discount").hide();
   }
});

$(document).on('submit', '#couponDelete', function(e) {
   
  return confirm('Are you sure you want to delete this coupon?');
 
});


