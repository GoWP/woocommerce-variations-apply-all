<?php
/*
Plugin Name: GoWP WooCommerce Variations Apply All
Plugin URL: https://www.gowp.com/blog/apply-the-price-of-a-woocommerce-product-variation-to-all-variations-of-the-same-product/
Description: Adds a link to variation edit screen to apply a price to all variations
Version:     1.0.2
Author:      GoWP
Author URI:  https://www.gowp.com
*/


add_action( 'woocommerce_product_data_panels', 'gowp_global_variation_price' );
function gowp_global_variation_price() {
	global $woocommerce;
	?>
		<script type="text/javascript">
			function addVariationLinks() {
				a = jQuery( '<a href="#">Apply to all Variations</a>' );
				b = jQuery( 'input[name^="variable_regular_price"].wc_input_price' );
				a.click( function( c ) {
					d = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_regular_price"].wc_input_price' ).val();
					e = confirm( "Change the price of all variations to " + d + "?" );
					if ( e ) b.val( d ).trigger( 'change' );
					c.preventDefault();
				} );
				b.prev( 'label' ).append( " " ).append( a );
				aa = jQuery( '<a href="#">Apply to all Variations</a>' );
				bb = jQuery( 'input[name^="variable_sale_price"].wc_input_price' );
				aa.click( function( cc ) {
					dd = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_sale_price"].wc_input_price' ).val();
					ee = confirm( "Change the price of all variations to " + dd + "?" );
					if ( ee ) bb.val( dd ).trigger( 'change' );
					cc.preventDefault();
				} );
				bb.prev( 'label' ).append( " " ).append( aa );
			}
			<?php if ( version_compare( $woocommerce->version, '2.4', '>=' ) ) : ?>
				jQuery( document ).ready( function() {
					jQuery( document ).ajaxComplete( function( event, request, settings ) {
						if ( settings.data.lastIndexOf( "action=woocommerce_load_variations", 0 ) === 0 ) {
							addVariationLinks();
						}
					} );
				} );
			<?php else: ?>
				addVariationLinks();
			<?php endif; ?>
		</script>
	<?php
}
