<?php
/**
 * Plugin Name: Blog Genie
 * Plugin URI: https://nazmunsakib.com/
 * Description:  Feels like magic for blog creation.
 * Version:  1.0
 * Author: Nazmun Sakib
 * Author URI: https://nazmunsakib.com
 * License: GPL v2 or later
 * Text Domain: blog-genie
 * Domain Path: /languages
 * 
 * WP Requirement & Test
 * Requires at least: 4.4
 * Tested up to: 6.5
 * Requires PHP: 5.6
 * 
 * WC Requirement & Test
 * WC requires at least: 3.2
 * WC tested up to: 7.9
 * 
 *  @package BlogGenie
 */

defined('ABSPATH') || die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Main class for Product FAQs Manager.
 */
final class Blog_Genie {

    /**
     * The single instance of the class.
     *
     * @var Blog_Genie|null
     */
    private static $instance = null;

    /**
     * Plugin version.
     *
     * @var string
     */
    private static $version = '1.0';

    /**
     * Constructor.
     *
     * Initializes the class and hooks necessary actions.
     */
    private function __construct() {
        $this->define_constants();
        $this->add_hooks();
    }

    /**
     * Returns the single instance of the class.
     *
     * @return Blog_Genie The single instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Defines plugin constants.
     */
    private function define_constants() {
        define( 'BLOG_GENIE_VERSION', self::$version );
        define( 'BLOG_GENIE_FILE', __FILE__ );
        define( 'BLOG_GENIE_PATH', __DIR__ );
        define( 'BLOG_GENIE_URL', plugins_url( '', BLOG_GENIE_FILE ) );
        define( 'BLOG_GENIE_ASSETS', BLOG_GENIE_URL . '/assets' );
    }

    /**
     * Adds hooks.
     */
    private function add_hooks() {
        add_action( 'init', array( $this, 'load_textdomain' ) );
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    /**
     * Initializes the plugin.
     */
    public function init() {
        BlogGenie\Blog_Genie_Main::init();
    }

    /**
     * Loads the plugin's text domain for localization.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'blog-genie', false, dirname( plugin_basename( BLOG_GENIE_FILE ) ) . '/languages' );
    }

}

/**
 * Initializes the Blog_Genie class.
 *
 * @return Blog_Genie
 */
function blog_genie() {
    return Blog_Genie::instance();
}

// Initialize the plugin.
blog_genie();
