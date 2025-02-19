<?php
/**
 * Plugin Main Class
 *
 * @package BlogGenie
 */
namespace BlogGenie\Admin;
use BlogGenie\Admin\Dashboard;


defined('ABSPATH') || die();

class Admin_Menu {

	protected $dashboard;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->dashboard = new Dashboard();
        $this->add_hooks();
	}

	private function add_hooks() {
        add_action( 'admin_menu', [$this, 'add_menu_page'] );
		add_action('admin_post_bg_generate_post', [$this->dashboard, 'handle_form_submission']);
	}

	public function add_menu_page() {
		$dashboard = new Dashboard();

		add_menu_page(
			'BlogGenie', 
			'BlogGenie', 
			'manage_options', 
			'blog-genie', 
			[$this->dashboard, 'render_dashboard'],
			'dashicons-edit',
			20
		);
	}
}