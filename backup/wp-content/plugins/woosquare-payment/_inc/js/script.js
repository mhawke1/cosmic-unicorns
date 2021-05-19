(function(){



function initPopup(){
    jQuery("#sync-error,#sync-content-woo,#sync-content-square").html('');
    jQuery("#sync-content,#sync-error,.cd-buttons.end,.cd-buttons.start").hide();

    jQuery('.cd-popup').addClass('is-visible');
}

function processPopup(){
    jQuery('.cd-buttons.start').hide();
    jQuery('#sync-processing').text('Processing ...').prop('disabled', 'true');
    jQuery('.cd-buttons.end').show();
    
    //disable all checkboxes
    jQuery("#sync-content input:checkbox").prop('disabled', 'true');
    
}

function endPopup(){
    jQuery('#sync-processing').text('Close');
    jQuery('#sync-processing').prop('disabled', false);


}



//Bind events to the page
jQuery(document).ready(function (jQuery) {
  

    //pop-up
    //close popup
    jQuery('.cd-popup').on('click', function (event) {
        if (jQuery(event.target).is('.cd-popup-close') || jQuery(event.target).is('.cd-popup')) {
            event.preventDefault();
            jQuery(this).removeClass('is-visible');           
            terminateManualSync(jQuery('#start-process').data("caller"));           

        }
    });
    //close popup when clicking the esc keyboard button
    jQuery(document).keyup(function (event) {
        if (event.which == '27') {
            jQuery('.cd-popup').removeClass('is-visible');
            terminateManualSync(jQuery('#start-process').data("caller"));
        }
    });
    
   
    
    

    jQuery('#start-process').on('click', function (event) {
        event.preventDefault();
        startManualSync(jQuery('#start-process').data("caller"));
    });
    
    jQuery('#sync-processing').on('click', function (event) {
        event.preventDefault();
        jQuery('.cd-popup').removeClass('is-visible');
    });
    
    
    jQuery('.collapse').on('click', function () {
        jQuery(this).siblings('.grid-div').toggleClass( "hidden collapse-content-show" );
        jQuery(this).children(".dashicons").toggleClass('collapse-open')
    });

    
    


});



})();


jQuery(document).ready(function(){
  
	
	
	jQuery( ".subsubsub li" ).each(function(index,key) {
		
		if(jQuery( this ).text().trim() == 'Square'){
			jQuery(this).remove();
			
		}
		if(jQuery( this ).text().trim() == 'Square |'){
			jQuery(this).remove();
		}
	
	   
	 });
		
		var textt=jQuery( ".subsubsub li" ).last().html(  );
		if(textt){
		var splittext = textt.split('|');
		
			// console.log(splittext);
			jQuery( ".subsubsub li" ).last().html( splittext[0] );
		}
		
		
	
});


function hide_unhide_squ_sandbox(){
var ischecked= jQuery("#woocommerce_square_enable_sandbox:checkbox").is(':checked');
if(ischecked){
    jQuery("#woocommerce_square_sandbox_application_id").parents("tr").fadeIn();
    jQuery("#woocommerce_square_woocommerce_square_sandbox_application_id").parents("tr").fadeIn();
    jQuery("#woocommerce_square_sandbox_access_token").parents("tr").fadeIn();
    jQuery("#woocommerce_square_woocommerce_square_sandbox_access_token").parents("tr").fadeIn();
    jQuery("#woocommerce_square_sandbox_location_id").parents("tr").fadeIn();
    jQuery("#woocommerce_square_woocommerce_square_sandbox_location_id").parents("tr").fadeIn();
    jQuery(".squ-sandbox-description").fadeIn();
    jQuery("#woocommerce_square_api_details").fadeIn();
} else {
	jQuery("#woocommerce_square_sandbox_application_id").parents("tr").fadeOut();
	jQuery("#woocommerce_square_woocommerce_square_sandbox_application_id").parents("tr").fadeOut();
    jQuery("#woocommerce_square_sandbox_access_token").parents("tr").fadeOut();
    jQuery("#woocommerce_square_woocommerce_square_sandbox_access_token").parents("tr").fadeOut();
    jQuery("#woocommerce_square_sandbox_location_id").parents("tr").fadeOut();
    jQuery("#woocommerce_square_woocommerce_square_sandbox_location_id").parents("tr").fadeOut();
    jQuery(".squ-sandbox-description").fadeOut();
    jQuery("#woocommerce_square_api_details").fadeOut();
}

}

jQuery( document ).ready(function() {
	hide_unhide_squ_sandbox();
	
	jQuery("#woocommerce_square_enable_sandbox:checkbox").change(function() {
		hide_unhide_squ_sandbox();
	});
	
});