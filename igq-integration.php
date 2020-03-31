<?php
/**
 * Plugin Name: AffiliateWP - IGQ Integration
 * Plugin URI: https://igotquarentined.com
 * Description: Integration for IGotQuarentined
 * Author: Chris Klosowski
 * Author URI: https://chrisk.io
 * Version: 1.0
 * Domain Path: languages
 */

class IGQ {
	private static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof IGQ ) ) {
			self::$instance = new IGQ();
			self::$instance->setup_constants();

			add_filter( 'affwp_extended_integrations', array( self::$instance, 'add' ), 99, 1 );
		}
		return self::$instance;
	}

	private function setup_constants() {
		// Plugin Folder Path
		if ( ! defined( 'IGQ_PLUGIN_DIR' ) ) {
			define( 'IGQ_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}
	}

	public function includes() {

		if ( is_admin() ) {

		}
	}

	public function add( $integrations ) {

		$integration_options = array(
			'name'  => 'I Got Quarantined',
			'class' => 'Affiliate_WP_IGQ',
			'file'  => IGQ_PLUGIN_DIR . '/includes/class-igq-integration.php',
			'enabled' => true,
		);

		$integrations['igq-integration'] = $integration_options;

		return $integrations;
	}
}

function igq() {
	return IGQ::instance();
}
igq();
