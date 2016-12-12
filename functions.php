<?php

require_once('utils.php');

class wp_hooligans_theme {

	function admin_styles() {
		wp_enqueue_style('admin' , get_stylesheet_directory_uri().'/assets/css/admin.css');
	}

	function enqueue_scripts() {

		wp_enqueue_style( 'main.css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'swiper.css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css', array(), '1.0', 'all' );

		wp_deregister_script( "jquery" );
		wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.1.0.min.js');

		wp_enqueue_script( 'head', 'https://cdnjs.cloudflare.com/ajax/libs/headjs/1.0.3/head.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'mobile-detect', get_template_directory_uri() . '/assets/js/mobile-detect.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'my-utils', get_template_directory_uri() . '/assets/js/my-utils.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC_PtCMe4SgXMlUcG2M9NwyLqnEDyCDSKE&v=3.exp', array( 'my-utils' ), '1.0', false );
		wp_enqueue_script( 'lodash', 'https://cdn.jsdelivr.net/lodash/4.15.0/lodash.min.js', array( 'maps' ), '1.0', false );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array( 'lodash' ), '1.0', false );

		wp_localize_script( 'ngSetup', 'appInfo',
			array(
				'api_url'							=> rest_get_url_prefix() . '/wp/v2/',
				'template_directory'	=> get_template_directory_uri() . '/',
				'nonce'								=> wp_create_nonce( 'wp_rest' ),
				'is_admin'						=> current_user_can( 'administrator' )
			)
		);

	}


}

add_filter( "rest_case-study_query", function( $args, $request ){
	if( 'menu_order' === $request->get_param( 'wpse_custom_order' ) )
	$args['orderby'] = 'menu_order';

	return $args;
}, 10, 2 );


$ngTheme = new wp_hooligans_theme();
add_action( 'wp_enqueue_scripts', array( $ngTheme, 'enqueue_scripts' ) );
add_action( 'admin_enqueue_scripts', array( $ngTheme, 'admin_styles' ) );

##########################################
######## CUSTOM IMAGE CROP SIZES #########
##########################################


function remove_default_image_sizes($sizes) {
	unset($sizes['thumbnail']);
	unset($sizes['medium']);
	unset($sizes['large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes');

if (!function_exists('add_image_sizes')) {
	function add_image_sizes(){
		//add_theme_support('post-thumbnails');
		//add_image_size('wide_2x', 600, 460, true);
		//add_image_size( 'mobile_case_study', 1200, 9999 , false );
		add_image_size( 'mobile_case_study', 1200, 9999, array( 'center', 'center' ) );
	}
}
add_image_sizes();

##########################################
########## CREATE CONTACT TABLE ##########
##########################################

add_action('init', 'register_contact_table', 2);
add_action('switch_blog', 'register_contact_table');

function register_contact_table() {
	global $wpdb;
	$contact_info = $wpdb->prefix.'contact';

	$sql = 'CREATE TABLE '.$contact_info.' (
		contact_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
		name CHAR(255),
		email CHAR(255),
		msg CHAR(255),
		dater DATETIME DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (contact_id),
		UNIQUE KEY id (contact_id));
		ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1;';


	require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}

##########################################
########## CREATE CONTACT WIDGET #########
##########################################

function contact_form_create_widget() {
	wp_add_dashboard_widget('contact-form-dashboard','Contact Form Leads','contact_form_show_widget');
}
add_action('wp_dashboard_setup', 'contact_form_create_widget');

function contact_form_show_widget() {
	global $wpdb;
	$contacts = $wpdb->get_results("SELECT * FROM `hoolwp_contact` ORDER BY dater DESC");
	if ($contacts) {
		echo '<div class="contact-table"><div class="headline"><div class="name">Name</div><div class="email">Email</div><div class="msg">Message</div><div class="date">Date</div></div>';
		$i = 0;
		$total = 0;
		foreach ($contacts as $contact ) {
			echo '<div class="content-table-line"><div class="name">'.$contact->name.'</div><div class="email">'.$contact->email.'</div><div class="msg">'.$contact->msg.'</div><div class="date">'.$contact->dater.'</div></div>';
			$i++;
		}
		echo '<div class="totals">Total Leads: <span>'.$i.'</span></div></div>';
	} else {
		echo 'Empty!!!';
	}
}


?>
