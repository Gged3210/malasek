<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

// function add_author_support_to_products() {
// 	add_post_type_support( 'product', 'suppliers' ); 
//  }
//  add_action( 'init', 'add_author_support_to_products' );

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */
// Add fields to new vendor form
add_action( 'shop_vendor_add_form_fields', 'custom_add_vendor_fields', 2, 1 );
function custom_add_vendor_fields( $taxonomy ) {
	?>
	<div class="form-field">
		<label for="vendor_website"><?php _e( 'Vendor website' ); ?></label>
		<input type="text" name="vendor_data[website]" id="vendor_website" class="vendor_fields" /><br/>
		<span class="description"><?php _e( 'The vendor\'s website.' ); ?></span>
	</div>
	<?php
}

// Add fields to vendor edit form for admins to edit
add_action( 'shop_vendor_edit_form_fields', 'custom_edit_vendor_fields', 2, 1 );
function custom_edit_vendor_fields( $vendor ) {

    $vendor_id = $vendor->term_id;
    $vendor_data = get_option( 'shop_vendor_' . $vendor_id );
    
    $vendor_website = '';
    if( isset( $vendor_data['website'] ) && ( strlen( $vendor_data['website'] ) > 0 || $vendor_data['website'] != '' ) ) {
        $vendor_website = $vendor_data['website'];
    }
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="vendor_website"><?php _e( 'Vendor website' ); ?></label></th>
        <td>
            <input type="text" name="vendor_data[website]" id="vendor_website" class="vendor_fields" /><br/>
            <span class="description"><?php _e( 'The vendor\'s website' ); ?></span>
        </td>
    </tr>
    <?php
}

// Add fields to vendor details form for vendors to edit
add_action( 'product_vendors_details_fields', 'custom_vendor_details_fields', 10, 1 );
function custom_vendor_details_fields( $vendor_id ) {
    
    $vendor = get_user_vendor();
    $vendor_data = get_option( 'shop_vendor_' . $vendor->ID );
    $vendor_info = get_vendor( $vendor->ID );
    
    $vendor_website = '';
    if( isset( $vendor_data['website'] ) && ( strlen( $vendor_data['website'] ) > 0 || $vendor_data['website'] != '' ) ) {
        $vendor_website = $vendor_data['website'];
    }
    
    $html = '<p class="form-field">
                <label for="vendor_website">' . __( 'Website' ) . ':</label>
                <input type="text" name="wc_product_vendors_website_' . $vendor->ID . '" id="vendor_website" class="vendor_fields" />
             </p>';
    
    echo $html;
}

// Save fields from vendor details form
add_action( 'product_vendors_details_fields_save', 'custom_vendor_details_fields_save', 10, 2 );
function custom_vendor_details_fields_save( $vendor_id, $posted ) {
    
    $vendor_data = get_option( 'shop_vendor_' . $vendor_id );
    
    if( isset( $posted[ 'wc_product_vendors_website_' . $vendor_id ] ) ) {
        $vendor_data['website'] = $posted[ 'wc_product_vendors_website_' . $vendor_id ];
    }
    
    update_option( 'shop_vendor_' . $vendor_id, $vendor_data );
}
