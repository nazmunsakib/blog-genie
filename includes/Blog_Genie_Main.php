<?php
/**
 * Plugin Main Class
 *
 * @package BlogGenie
 */
namespace BlogGenie;

use BlogGenie\Enqueue;
use BlogGenie\Admin\Admin_Menu;

defined('ABSPATH') || die();

class Blog_Genie_Main {

    /**
     * Instance
     * 
     * @var Blog_Genie_Main
     */
    private static $instance = null;

	/**
	 * Class constructor.
	 * Private to enforce singleton pattern.
	 */
	private function __construct() {
        // Include dependencies and initiate them
        $this->includes();
	}

    /**
     * Initialize the main plugin class using singleton pattern.
     * 
     * @return Blog_Genie_Main
     */
    public static function init(){
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Includes all necessary classes.
     */
	private function includes() {
        // Initialize required classes
        new Enqueue();
        new Admin_Menu();
	}
}
