<?php
/**
 * Plugin Name: Important Message
 * Description: Plugin to show a message in top of the store.
 * Version: 1.0
 * Author: Hevger Ibrahim
 * Author URI: https://iibrahim.me/
 */

// Require Woocommerce before plugin can be activated
register_activation_hook( __FILE__, 'important_message_child_plugin_activate' );
function important_message_child_plugin_activate(){

    // Require parent plugin
    if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) and current_user_can( 'activate_plugins' ) ) {
        wp_die('Sorry, but this plugin requires the Woocommerce to be installed and active. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
    }
}


// Register CSS styles And Javascript
function init_important_message()
{
	// CSS
	wp_register_style('important-message-css', plugins_url('/css/style.css', __FILE__));
	wp_enqueue_style('important-message-css');

	// Script
	wp_register_script('wpfi-js', plugins_url('/js/script.js', __FILE__));
	wp_enqueue_script('wpfi-js');
}
add_action('admin_enqueue_scripts', 'init_important_message');
add_action('wp_enqueue_scripts', 'init_important_message');


// Register Menu
function important_message_register_menu()
{
	add_menu_page(
		'Important Message Settings',
		'Important Message',
		'manage_options',
		'important_message',
		'important_message_page',
		'dashicons-lightbulb',
		11
	);
}
add_action('admin_menu', 'important_message_register_menu');

function register_my_setting_field() {

    $args = array(
            'type' => 'string', 
            'sanitize_callback' => 'sanitize_text_field',
            );
	register_setting( 'imm_options_group', 'imm_msg', $args );
	unset($args);

	$args = array(
			'type' => 'int'
            );
	register_setting( 'imm_options_group', 'imm_enabled', $args );

	settings_fields( 'imm_options_group' );
} 
add_action( 'admin_init', 'register_my_setting_field' );

// Inject html to header
function add_head_html() {
	if(get_option('imm_enabled') == 'on'){
			if (isset($_COOKIE['imm_message']) && $_COOKIE['imm_message'] != get_option('imm_msg')):
				echo '<div id="messageInStoreTop"><p id="immTextMessage">'.get_option('imm_msg').'</p><span onclick="removeImmMessage()" class="dashicons dashicons-no-alt"></span></div>';
			elseif(!isset($_COOKIE['imm_message'])):
				echo '<div id="messageInStoreTop"><p id="immTextMessage">'.get_option('imm_msg').'</p><span onclick="removeImmMessage()" class="dashicons dashicons-no-alt"></span></div>';
			endif;
	}
}
add_action( 'wp_head', 'add_head_html' );


// Load page
function important_message_page()
{
	include_once "important_message_page.php";
}

