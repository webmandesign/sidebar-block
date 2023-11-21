<?php
/**
 * Plugin Name:  Sidebar Block
 * Plugin URI:   https://www.webmandesign.eu/portfolio/sidebar-block-wordpress-plugin/
 * Description:  A block to display a sidebar.
 * Version:      1.0.0
 * Author:       WebMan Design, Oliver Juhas
 * Author URI:   https://www.webmandesign.eu/
 * License:      GPL-3.0-or-later
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:  sidebar-block
 * Domain Path:  /languages
 *
 * Requires PHP:       7.0
 * Requires at least:  6.3
 *
 * GitHub Plugin URI:  https://github.com/webmandesign/sidebar-block
 *
 * @copyright  WebMan Design, Oliver Juhas
 * @license    GPL-3.0, https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @link  https://github.com/webmandesign/sidebar-block
 * @link  https://www.webmandesign.eu
 *
 * @package  Sidebar Block
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Constants.
define( 'SIDEBAR_BLOCK_VERSION', '1.0.0' );
define( 'SIDEBAR_BLOCK_FILE', __FILE__ );
define( 'SIDEBAR_BLOCK_PATH', plugin_dir_path( SIDEBAR_BLOCK_FILE ) ); // Trailing slashed.
define( 'SIDEBAR_BLOCK_URL', plugin_dir_url( SIDEBAR_BLOCK_FILE ) ); // Trailing slashed.

// Load the functionality.
require_once SIDEBAR_BLOCK_PATH . 'includes/Autoload.php';
WebManDesign\Block\Sidebar\Block::init();
WebManDesign\Block\Sidebar\Register::init();
