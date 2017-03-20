<?php
/**
 * Plugin Name: Singleton Example
 * Plugin URI: https://github.com/maurobringolf/wordpress-plugin-singleton
 * Description: An empty illustration of a WordPress plugin implemented as singleton
 * Author: Mauro Bringolf
 * Author URI: https://maurobringolf.ch
 * Version: 1.0
 * Text Domain: singleton
 * Domain Path: languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit;
}

if ( ! class_exists( 'Singleton_Plugin_Illustration' ) ) {

	final class Singleton_Plugin_Illustration {

		/**
		 * Stores the instance
		 */
		private static $instance;

		/**
		 * Stores the message to be displayed
		 */
		private $message;

		/**
		 * Makes sure that there is exactly one instance of this class stored inside the static attribute $instance.
		 * Acts as the constructor for this instance and returns the object.
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Singleton_Plugin_Illustration ) ) {

				self::$instance = new Singleton_Plugin_Illustration;
				self::$instance->message = 'The singleton pattern works and prevents global scope pollution!';

				add_action( 'admin_notices', array( self::$instance, 'notify_user' ) );

			}
			return self::$instance;
		}

		/**
		 * Protect constructor from outside
		 */
		private function __construct() {}

		/**
		 * Outputs a WordPress notification ensuring that the singleton is working
		 */
		public function notify_user() {

			?>

			<div class="notice-info notice is-dismissible">
		  <p><?php echo self::$instance->message; ?></p>
			</div>

			<?php
		}

	}

}

/**
 * This function can be used by other plugins and themes to access any public API's this plugin offers.
 */
function SingletonPluginIllustration() {
	return Singleton_Plugin_Illustration::instance();
}

SingletonPluginIllustration();
