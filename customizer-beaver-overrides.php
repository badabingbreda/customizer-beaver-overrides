<?php
/**
 * Customizer Beaver Overrides
 *
 * @package     Demo Styles
 * @author      Badabingbreda
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Customizer Beaver Overrides
 * Plugin URI:  https://www.badabing.nl
 * Description: Override certain settings for Beaver Builder Modules so you can change them in one place
 * Version:     1.0.0
 * Author:      Badabingbreda
 * Author URI:  https://www.badabing.nl
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


use BeaverOverrides\Autoloader;
use BeaverOverrides\Init;
use ToolboxCustomizer\CustomizerCss;


if ( defined( 'ABSPATH' ) && ! defined( 'BEAVEROVERRIDES_VERSION' ) ) {
	register_activation_hook( __FILE__, 'BEAVEROVERRIDES_check_php_version' );

	/**
	 * Display notice for old PHP version.
	 */
	function BEAVEROVERRIDES_check_php_version() {
		if ( version_compare( phpversion(), '5.3', '<' ) ) {
			die( esc_html__( 'EAsy UIkit Styles requires PHP version 5.3+. Please contact your host to upgrade.', 'easy-uikit-styles' ) );
		}

	}

    define( 'BEAVEROVERRIDES_VERSION', '1.0.0' );
    define( 'BEAVEROVERRIDES_DIR', plugin_dir_path( __FILE__ ) );
    define( 'BEAVEROVERRIDES_FILE', __FILE__ );
    define( 'BEAVEROVERRIDES_URL', plugins_url( '/', __FILE__ ) );
    
    define( 'CHECK_BEAVEROVERRIDES_PLUGIN_FILE', __FILE__ );

	/**
	 * The file where the Autoloader class is defined.
	 */
	require_once 'inc/Autoloader.php';
	spl_autoload_register( array( new Autoloader(), 'autoload' ) );

    new Init();


}