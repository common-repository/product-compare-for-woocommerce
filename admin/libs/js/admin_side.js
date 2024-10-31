/**
 * Admin Custom Jquery Scripts
 * @package product-compare-for-woocommerce	
 */
jQuery(document).ready( function () {
	jQuery('#proco_form_1').on('submit', function(e){ 
		e.preventDefault();	
		jQuery.ajax({
			method: 'post',
			url: ajaxurl + "?action=save_options_adminside",
			data: new FormData(this),
			contentType: false,
			processData: false,
			beforeSend: function(){
				// Show image container
				jQuery(".loader").show();
			},
			complete:function(){
				// Hide image container
				jQuery(".loader").hide();
			},
			success: function(admin_proco) {
				console.log(admin_proco);
				var result = jQuery.parseJSON(admin_proco);
				if( result.success_msg == 1 ) {
					alert('Setting saved successfully');					
				}
				else {
					alert('Setting update operation Failed,Crucio, Please try after some time');					
				}
			}
		});
	});	
});