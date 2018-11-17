(function($) {
	$(document).ready( function($) {
		$( document ).ajaxComplete( function( event, request, settings ) {
			if ( settings.data.lastIndexOf( "action=woocommerce_load_variations", 0 ) === 0 ) {
				addVariationLinks();
			}
		} );
		
	});

	function addVariationLinks() {
		fields = $('#wcApplyAll_fields').text().split(',');
		
		var i;
		for (i = 0; i < fields.length; i++) {
			field = fields[i];
			
			$( 'input[id^="'+field+'"]' ).each(function(){

				//add clickable control 
				$(this).after('<a class="wc_apply_to_all" href="#" data-match="'+field+'" data-source-field="'+$(this).attr('id')+'">Apply to all Variations</a>');
			})
		}
	}

	$('#variable_product_options').on('click', 'a.wc_apply_to_all', function(click) {
		source_field_id = $(this).attr('data-source-field');
		val = $('input#'+source_field_id).val();
		match = $(this).attr('data-match');
		if(val){
			e = confirm( "Change this value for all variations to " + val + "?" );
			if ( e ){
				console.log('syncing')
				$( 'input[id^="'+match+'"]' ).each(function(){
					$(this).val(val).trigger( 'change' );
				});
			}
			click.preventDefault();
		} else {
			alert('Please provide a value to be applied');
		}	
		
	});
})( jQuery );