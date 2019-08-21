<?php

if ( ! defined('ABSPATH')){
  die("You can't access this file");
}

if( ! function_exists('my_login_logo')){
		 function my_login_logo() {
		  ?>
		    <style type="text/css">
		        #login h1 a, .login h1 a {
		        background-image: url('<?php echo get_option('wplogin-logo-image'); ?>');
				height: 74px;
				width: 224px;
				margin-top: 33px !important;
				background-size: contain;
				background-repeat: no-repeat;
				padding-bottom: 30px;
		        }
		        body{
	            background-image: url('<?php echo get_option('wplogin-bg-image'); ?>') !important;
	            background-size: cover !important;
                }
                <?php echo get_option('wplogin-custom-css'); ?>
		    </style>
		<?php 
		  }
		}
		add_action( 'login_enqueue_scripts', 'my_login_logo' );