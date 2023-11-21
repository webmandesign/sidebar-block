<?php
/**
 * Predefined hook names available for the block.
 *
 * @package    Sidebar Block
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  1.0.0
 */

namespace WebManDesign\Block\Sidebar;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Register {

	/**
	 * Initialization.
	 *
	 * @since  1.0.0
	 *
	 * @return  void
	 */
	public static function init() {

		// Processing

			// Actions

				add_action( 'after_setup_theme', __CLASS__ . '::after_setup_theme' );

				add_action( 'widgets_init', __CLASS__ . '::register', 99 );

	} // /init

	/**
	 * Making sure a block theme supports widgets.
	 *
	 * @since  1.0.0
	 *
	 * @return  void
	 */
	public static function after_setup_theme() {

		// Processing

			add_theme_support( 'widgets' );

	} // /after_setup_theme

	/**
	 * Register sidebars.
	 *
	 * @since  1.0.0
	 *
	 * @return  void
	 */
	public static function register() {

		// Variables

			/**
			 * Filters sidebar registration arguments.
			 *
			 * @since  1.0.0
			 *
			 * @param  array $args
			 */
			$args = (array) apply_filters( 'sidebar-block/register_sidebar/args', array(

				'id'              => 'sidebar',
				'name'            => esc_html_x( 'Sidebar', 'Widget area name.', 'sidebar-block' ),
				'description'     => esc_html_x( 'Default sidebar area.', 'Widget area description.', 'sidebar-block' ),

				'before_widget'   => '<section id="%1$s" class="wp-block-widget wmd-block-sidebar-widget widget %2$s">',
				'after_widget'    => '</section>',

				'before_title'    => '<h2 class="wp-block-widget__title wmd-block-sidebar-widget__title widget-title widgettitle">',
				'after_title'     => '</h2>',
			) );


		// Processing

			if ( ! is_registered_sidebar( $args['id'] ) ) {
				register_sidebar( $args );
			}

	} // /register

}
