/**
 * Public Custom Jquery Scripts
 * @package product-compare-for-woocommerce	
 */
jQuery(document).ready(function(){
	jQuery('.adcomp-button').on('click', function(e) {
		e.preventDefault();
		var product_id = jQuery(this).data('id');
		var request = jQuery.ajax({
			method: 'post',
			url: procopublicajax.ajaxurl,
			//url: procopublicajax+"?action=check_upg_prdct_category",	
			data:{
				action: "check_upg_prdct_category",
				product_id: product_id
			},		
			//data: 'product_id='+product_id,
			
			beforeSend: function(){
				// Show image container
				jQuery(".loader").show();
			},
			complete:function(){
				// Hide image container
				jQuery(".loader").hide();
				jQuery('.view_table').show();
			},
			success: function( ops_result ) {
				alert( ops_result );
				jQuery('#'+product_id).hide();
				jQuery('.view_table').show();
			}			
		});
	});

	/* show comparison table in popup */
	jQuery('body').on('click','.showcomp-button', function(){
		jQuery.ajax({
			method: 'get',
			url: procopublicajax.ajaxurl,
			data:{
				action: "show_compare_table_popup"			
			},	
			//url: procopublicajax+"?action=show_compare_table_popup",
			success: function( sct_result ) {	
				jQuery('.result').html(sct_result);
				jQuery('#exampleModal').modal('toggle');
			}
		});
	});

	/*
	*Remove product
	*/
	jQuery('body').on('click','.remove_product', function(e){
		e.preventDefault();
		var productId_remove = jQuery(this).data('id');
		jQuery.ajax({
			method: 'post',
			url: procopublicajax.ajaxurl,
			data:{
				action: "remove_product_compare_table",
				productId_remove: productId_remove
			},	
			//url: procopublicajax+"?action=remove_product_compare_table",
			//data:'productId_remove='+productId_remove,
			beforeSend: function(){
				// Show image container
				jQuery(".loader").show();
			},
			complete:function(){
				// Hide image container
				jQuery(".loader").hide();
				jQuery('#exampleModal').modal('toggle');
			},
			success: function( remove_product_result ) {
				console.log( remove_product_result );				
				jQuery.ajax({
					method: 'get',
					url: procopublicajax.ajaxurl,
					data:{
						action: "show_compare_table_popup",
						product_id: productId_remove
					},	
					//url: procopublicajax+"?action=show_compare_table_popup",
					beforeSend: function(){
						// Show image container
						jQuery(".before_remove").show();
						jQuery(".loader").show();
					},
					complete:function(){
						// Hide image container
						jQuery(".loader").hide();
						jQuery(".before_remove").hide();
					},
					success: function( sct_result ) {						
						jQuery('.result').html(sct_result);
						jQuery('#exampleModal').modal('toggle');
						jQuery('#'+productId_remove).show();
					}
				});
			}
		});
	});
});