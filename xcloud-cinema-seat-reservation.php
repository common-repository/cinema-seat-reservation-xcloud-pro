<?php
/*

Plugin Name: Cinema Seat Reservation - xCloud.pro
Plugin URI: https://xcloud.pro/prodotto/cinema-seat-reservation/
Description: Integration for WordPress of Cinema Seat Reservation by xCloud.pro - Professional System for Reservation Seat and Sale Tickets. The complete tool for your cinema, theater, event, show. Please use shortcode [xcloud-cinema] in your Page content.
Version: 1.0.5
Author: xCloud.pro
Author URI: https://www.xcloud.pro
License: MIT License
Text Domain: xcloud-cinema
Domain Path: /languages
Requires at least: 4.2.2
Tested up to: 6.2

*/

require_once('shortcode_xcloud.php');

if (!defined('ABSPATH')) {
	exit();
}

class xcloud_cinema {
	private $defaults = array(
		'param1' => ''
	);

	const APPXCLOUD = 'cinema';
	const TEXTDOMAIN = 'xcloud-cinema';

	function __construct() {
		add_action('admin_menu', array($this, 'add_xcloud_app_menu'));
		add_action('admin_init', array($this, 'add_fields'));
		add_action('init', array($this, 'load_textdomain'));
		$this->options = get_option('xcloud_'.self::APPXCLOUD.'_option', $this->defaults);
	}

	private $options = array();

	public function load_textdomain() {
			load_plugin_textdomain(self::TEXTDOMAIN, false, basename( dirname( __FILE__ )).'/languages');
		}

	public function add_xcloud_app_menu() {
		add_menu_page(
			__('Menu Xcloud Cinema',self::TEXTDOMAIN),
			__('XCLOUD Cinema',self::TEXTDOMAIN),
			'manage_options',
			self::TEXTDOMAIN,
			array($this, 'xcloud_app_option')
		);
	}

	public function xcloud_app_option() {
		echo '<div class="wrap">';
		echo '<h2>' . __('Cinema Seat Reservation',self::TEXTDOMAIN) . '</h2>';
		echo "<p>" . __('1. Copy and Paste the Code for The Code Form from your APP > Preview/Install',self::TEXTDOMAIN) . "</p>";
		echo "<p>" . __('2. Use shortcode in your Page/Post content to display The Booking Form:',self::TEXTDOMAIN) . " [".self::TEXTDOMAIN."]</p>";
		echo "<hr>";
		echo '<form action="options.php" method="post">';
		settings_fields('wp_xcloud_option_'.self::APPXCLOUD);
		do_settings_sections(self::TEXTDOMAIN);
		submit_button( '', 'primary', 'wp_xcloud_save', true);
		echo '</form>';
		echo '</div>';
	}
	public function add_fields() {
		register_setting('wp_xcloud_option_'.self::APPXCLOUD,'xcloud_'.self::APPXCLOUD.'_option');
		add_settings_section( 'main_section', __('Settings',self::TEXTDOMAIN), array($this,'display_main_section'), self::TEXTDOMAIN);
		add_settings_field( 'param1', __('Code',self::TEXTDOMAIN), array($this, 'display_field_1'), self::TEXTDOMAIN, 'main_section');
	}

	public function display_main_section() {
		echo "";
	}

	public function display_field_1() {
		echo '<textarea name="xcloud_'.self::APPXCLOUD.'_option[param1]" rows="6" cols="80">'.esc_attr($this->options['param1']).'</textarea>';

	}

	public function sanitize($input) {
		return $input;
	}


}

$xcloud_cinema = new xcloud_cinema();

?>