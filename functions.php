<?php

function simun_emanuel_child_enqueue_scripts() {
	wp_enqueue_style(
		'altair-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'altair-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'simun_emanuel_child_enqueue_scripts' );

/**
 *  @snippet     Add custom image sizes for thumbnails
**/

add_theme_support( 'post-thumbnails' );
add_image_size('novosti-medium', 1024, 576);
add_image_size('novosti-hd', 1280, 720);
add_image_size('novosti-fhd', 1920, 1080);


/**
 * @snippet       Add Name & Address Fields to My Account Register Form - WooCommerce
**/
  
///////////////////////////////
// 1. ADD FIELDS
  
add_action( 'woocommerce_register_form_start', 'simunemanuel_add_name_woo_account_registration' );
  
function simunemanuel_add_name_woo_account_registration() {
    ?>
  
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
  
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>

    <p class="form-row">
    <label for="reg_billing_address_1"><?php _e( 'Address', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
    </p>

    <p class="form-row">
    <label for="reg_billing_postcode"><?php _e( 'Postcode', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_postcode" id="reg_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
    </p>

    <p class="form-row">
    <label for="reg_billing_city"><?php _e( 'City', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_city" id="reg_city" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
    </p>

    <p class="form-row">
    <label for="reg_billing_country"><?php _e( 'Država', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_country" id="reg_country" value="<?php if ( ! empty( $_POST['billing_country'] ) ) esc_attr_e( $_POST['billing_country'] ); ?>" />
    </p>

    <p class="form-row">
    <label for="reg_billing_phone"><?php _e( 'Broj telefona', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_phone" id="reg_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>
  
    <div class="clear"></div>
  
    <?php
}
  
///////////////////////////////
// 2. VALIDATE FIELDS
  
add_filter( 'woocommerce_registration_errors', 'simunemanuel_validate_name_fields', 10, 3 );
  
function simunemanuel_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_address_1'] ) && empty( $_POST['billing_address_1'] ) ) {
        $errors->add( 'billing_address_1_error', __( '<strong>Error</strong>: Address is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_postcode'] ) && empty( $_POST['billing_postcode'] ) ) {
        $errors->add( 'billing_postcode_error', __( '<strong>Error</strong>: Postcode is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {
        $errors->add( 'billing_city_error', __( '<strong>Error</strong>: City is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_country'] ) && empty( $_POST['billing_country'] ) ) {
        $errors->add( 'billing_country_error', __( '<strong>Error</strong>: Country is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
        $errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone number is required!.', 'woocommerce' ) );
    }
    return $errors;
}
  
///////////////////////////////
// 3. SAVE FIELDS
  
add_action( 'woocommerce_created_customer', 'simunemanuel_save_name_fields' );
  
function simunemanuel_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );
    }
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );
        update_user_meta( $customer_id, 'address_1', sanitize_text_field($_POST['billing_address_1']) );
    }
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );
        update_user_meta( $customer_id, 'postcode', sanitize_text_field($_POST['billing_postcode']) );
    }
    if ( isset( $_POST['billing_city'] ) ) {
        update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
        update_user_meta( $customer_id, 'city', sanitize_text_field($_POST['billing_city']) );
    }
    if ( isset( $_POST['billing_country'] ) ) {
        update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
        update_user_meta( $customer_id, 'country', sanitize_text_field($_POST['billing_country']) );
    }
    if ( isset( $_POST['billing_phone'] ) ) {
        update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
        update_user_meta( $customer_id, 'phone', sanitize_text_field($_POST['billing_phone']) );
    }
  
}