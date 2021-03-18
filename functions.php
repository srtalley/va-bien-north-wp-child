<?php
/**
 * luxi functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package luxi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'THEME_DIR', __DIR__ );

require_once( THEME_DIR . '/lib/Theme.php' );
require_once( THEME_DIR . '/lib/WooExtensions.php' );
require_once( THEME_DIR . '/lib/SizingHelp.php' );

/**
 * Add the pinterest code
 */
function vabien_head() {
	echo '<meta name="p:domain_verify" content="b655a8740a47411bb94ed2bbe9f60803"/>';
}
add_action('wp_head', 'vabien_head');

/*-----------------------------------------------------------------------------------*/
/* Quick Print Array functions for debugging
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'PrintArray' ) ) {
	function PrintArray( $array ) {

		if (WP_DEBUG) {
			echo "<pre>";
			print_r( $array );
			echo "</pre>";
		}

	}
}
/**
* Logging function to debug.log
*/
function wl ( $log )  {
    if ( is_array( $log ) || is_object( $log ) ) {
        error_log( print_r( $log, true ) );
    } else {
        error_log( $log );
    }
}

// NOTHING CHOULD BE ADDED TO THE FUNCTIONS FILE - PLEASE PLACE IT IN THE CORRECT FILE ABOVE AS A CLASS ENTRY