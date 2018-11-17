<?php
/*
Plugin Name: GoWP WooCommerce Variations Apply All
Plugin URL: https://www.gowp.com/blog/apply-the-price-of-a-woocommerce-product-variation-to-all-variations-of-the-same-product/
Description: Adds a link to variation edit screen to apply a price to all variations
Version:     1.0.3
Author:      GoWP
Author URI:  https://www.gowp.com
*/

function wcApplyAll_enqueue_scripts() {
	
	wp_enqueue_script('wc-apply-all', plugins_url( '/js/apply-all-min.js', __FILE__), array('jquery'), '1.0.3', true);

}
add_action( 'admin_enqueue_scripts', 'wcApplyAll_enqueue_scripts' );

//add HTML to page that specifies supported fields - filterable for any custom fields
add_action( 'woocommerce_product_data_panels', 'wcApplyAll_supported_fields' );
function wcApplyAll_supported_fields(){
	$fields = apply_filters('wc_applyall_fields', array(
		'variable_sale_price',
		'variable_regular_price'
	));
	echo '<div style="display: none;" id="wcApplyAll_fields">'.implode(',',$fields).'</div>';
}