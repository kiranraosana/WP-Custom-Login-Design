<?php
/**
 * Plugin Name: WPLogin Admin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Author:            Kiran Kumar
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined('ABSPATH')){
  die("You can't access this file");
}
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true'):
   echo    '<div id="setting-error-settings_updated" class="updated settings-error"> 
<p><strong>Settings saved</strong></p></div>';
endif;
/****Logo functiom*****/

	include_once( plugin_dir_path( __FILE__ ) . '/logo-update.php');	

/****End Logo functiom*****/

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return get_option('wplogin-logo-title'); 
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/**********Custom Styles*****/
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', plugins_url( '/assets/style-login.css' , __FILE__ ) );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/***Menu Page***/

function wplogin_plugin_menu() {
   add_menu_page( 'WPLogin Custom Admin Login', 'WPLogin Admin', 'manage_options', 'wplogin-custom-admin-login', 'wplogin_plugin_options', 'dashicons-admin-network', 5 );
}
add_action( 'admin_menu', 'wplogin_plugin_menu' );

function wplogin_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">
	      <div id="icon-options-general" class="icon32"></div>
          <h1>Theme Options</h1>
          <form method="post" action="options.php">';

	settings_fields("wplogin_options_section");

	do_settings_sections("wplogin-custom-admin-login");

	submit_button(); 

	echo '</form>
          </div>';
}
/*****end menu page***/

function wplogin_admin_page_options(){

	add_settings_section( 'wplogin_options_section', 'Options for Admin Login Page', 'display_wplogin_options_content', 'wplogin-custom-admin-login');

	add_settings_field( 'wplogin-bg-image', 'Background Image', 'bg_file_display', 'wplogin-custom-admin-login', 'wplogin_options_section');
	add_settings_field( 'wplogin-logo-image', 'Logo Image', 'login_file_display', 'wplogin-custom-admin-login', 'wplogin_options_section');

	add_settings_field( 'wplogin-logo-title', 'Logo Title', 'login_title_display', 'wplogin-custom-admin-login', 'wplogin_options_section');

	add_settings_field( 'wplogin-custom-css', 'Add Custom CSS', 'add_custom_css_display', 'wplogin-custom-admin-login', 'wplogin_options_section');

	register_setting( 'wplogin_options_section', 'wplogin-bg-image', 'bg_handle_file_upload');
	register_setting( 'wplogin_options_section', 'wplogin-logo-image', 'login_handle_file_upload');
	register_setting( 'wplogin_options_section', 'wplogin-logo-title', 'login_handle_file_upload');
    register_setting( 'wplogin_options_section', 'wplogin-custom-css', 'login_handle_file_upload');

}
function display_wplogin_options_content(){echo "Developed By Kiran Kumar and Joshuva Daniel.";}

	// function bg_handle_file_upload($option)
	// {
	//   if(!empty($_FILES["wplogin-bg-image"]["tmp_name"]))
	//   {
	//     $urls = wp_handle_upload($_FILES["wplogin-bg-image"], array('test_form' => FALSE));
	//     $temp = $urls["url"];
	//     return $temp;   
	//   }
	  
	//   return $option;
	// }
	// function login_handle_file_upload($option)
	// {
	//   if(!empty($_FILES["login-file"]["tmp_name"]))
	//   {
	//     $urls = wp_handle_upload($_FILES["login-file"], array('test_form' => FALSE));
	//     $temp = $urls["url"];
	//     return $temp;   
	//   }
	  
	//   return $option;
	// }
	function bg_file_display()
	{
	   ?>
	        <input type="text" name="wplogin-bg-image" placeholder="Enter your URL here" value="<?php echo get_option('wplogin-bg-image'); ?>" style="width: 350px;"/> 
	        <div style="margin-top: 10px;"><img src="<?php echo get_option('wplogin-bg-image'); ?>" width="80" height="auto"></div>
	   <?php
	}
	function login_title_display()
	{
	   ?>
	        <input type="text" name="wplogin-logo-title" placeholder="Enter your login title" value="<?php echo get_option('wplogin-logo-title'); ?>" style="width: 350px;"> 
	   <?php
	}
	function add_custom_css_display()
	{
	   ?>
	        <textarea name="wplogin-custom-css" placeholder="Add Here Custom CSS Without Style Tag" style="width: 800px; height: 500px;"><?php echo get_option('wplogin-custom-css'); ?></textarea>
	         
	   <?php
	}
	function login_file_display()
	{
	   ?>
	        <input type="text" name="wplogin-logo-image" placeholder="Enter your URL here" value="<?php echo get_option('wplogin-logo-image'); ?>" style="width: 350px;"/> 
	          <div style="margin-top: 10px;"><img src="<?php echo get_option('wplogin-logo-image'); ?>" width="150" height="auto"></div>
	   <?php
	}
	add_action("admin_init", "wplogin_admin_page_options");





