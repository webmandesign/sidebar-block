<?php
/**
 * Block.
 *
 * @package    Sidebar Block
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since  1.0.0
 */

namespace WebManDesign\Block\Sidebar;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Block {

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

				add_action( 'init', __CLASS__ . '::register' );

				add_action( 'enqueue_block_editor_assets', __CLASS__ . '::assets' );

	} // /init

	/**
	 * Register block.
	 *
	 * @since  1.0.0
	 *
	 * @return  void
	 */
	public static function register() {

		// Variables

			/**
			 * Filters registration arguments for `wmd/sidebar` block.
			 *
			 * @since  1.0.0
			 *
			 * @param  array $args
			 */
			$args = (array) apply_filters( 'sidebar-block/register_block_type/args', array(

				'api_version' => 3,
				'version'     => SIDEBAR_BLOCK_VERSION,

				'title'       => esc_html__( 'Sidebar', 'sidebar-block' ),
				'description' => esc_html__( 'Displays a sidebar on front-end of the website.', 'sidebar-block' ),
				'category'    => 'theme',
				'icon'        => 'align-pull-right', // @see  `blocks/sidebar/dev/block.js` for the actual SVG icon.
				'keywords'    => array(
					esc_html_x( 'sidebar', 'Block search keyword. Theme Hook Alliance abbreviation.', 'sidebar-block' ),
					esc_html_x( 'aside', 'Block search keyword.', 'sidebar-block' ),
					esc_html_x( 'widgets', 'Block search keyword.', 'sidebar-block' ),
					esc_html_x( 'area', 'Block search keyword.', 'sidebar-block' ),
				),

				'textdomain' => 'sidebar-block',

				'attributes' => array(
					'id' => array(
						'type'    => 'string',
						'default' => 'sidebar',
					),
				),

				'supports' => array(
					'className'       => false,
					'customClassName' => false,
					'html'            => false,
				),

				'editor_script_handles' => array( 'sidebar-block' ),
				'editor_style_handles'  => array( 'sidebar-block' ),

				'render_callback' => __CLASS__ . '::render',
			) );


		// Processing

			register_block_type( 'wmd/sidebar', $args );

	} // /register

	/**
	 * Render block.
	 *
	 * @since  1.0.0
	 *
	 * @param  array $atts  Array of stored block attributes.
	 *
	 * @return  string
	 */
	public static function render( array $atts = array() ): string {

		// Requirements check

			if ( empty( $atts['id'] ) ) {
				return '';
			}


		// Processing

			ob_start();
			dynamic_sidebar( trim( (string) $atts['id'] ) );


		// Output

			return trim( ob_get_clean() );

	} // /render

	/**
	 * Register block editor assets.
	 *
	 * @since  1.0.0
	 *
	 * @return  void
	 */
	public static function assets() {

		// Variables

			global $wp_registered_sidebars;

			$handle  = 'sidebar-block';
			$version = 'v' . SIDEBAR_BLOCK_VERSION;

			if ( current_user_can( 'edit_theme_options' ) ) {
				$option_desc = esc_html__( 'Make sure the sidebar contains widgets (Appearance → Widgets).', 'sidebar-block' );
			} else {
				$option_desc = '';
			}


		// Processing

			wp_register_script(
				$handle,
				SIDEBAR_BLOCK_URL . 'blocks/sidebar/block.js',
				array(
					'wp-blocks',
					'wp-element',
					'wp-components',
					'wp-block-editor',
					'wp-polyfill',
				),
				$version
			);

				wp_add_inline_script(
					$handle,
					'var wmdSidebarBlock = {'
						. 'sidebarOptions: [ '
							. implode(
								',',
								array_map(
									function( $args ) {
										return '{ label:"' . esc_html( $args['name'] ) . '", value:"' . esc_attr( $args['id'] ) . '" }';
									},
									array_merge(
										array(
											array(
												'name' => esc_html__( '- choose a sidebar', 'sidebar-block' ),
												'id'   => '',
											),
										),
										$wp_registered_sidebars
									)
								)
							)
						. ' ],'
						. 'sidebarNames: {'
							. implode(
								',',
								array_map(
									function( $args ) {
										return '"' . esc_attr( $args['id'] ) . '":"' . esc_html( $args['name'] ) . '"';
									},
									$wp_registered_sidebars
								)
							)
						. '},'
						. 'texts: {'
							. 'contentIsId:"' . esc_html__( 'Displaying sidebar: ', 'sidebar-block' ) . '",'
							. 'contentNoId:"' . esc_html__( 'No sidebar selected.', 'sidebar-block' ) . '",'
							. 'optionIdLabel:"' . esc_html__( 'Sidebar to display', 'sidebar-block' ) . '",'
							. 'optionIdDesc:"' . $option_desc . '",'
						. '},'
					. '};',
					'before'
				);

			wp_register_style(
				$handle,
				SIDEBAR_BLOCK_URL . 'blocks/sidebar/block.css',
				array(
					'wp-components',
				),
				$version
			);

	} // /assets

}
