<?php
/**
 * Plugin Main Class
 *
 * @package BlogGenie
 */
namespace BlogGenie;

defined('ABSPATH') || die();

class BG_Post {

	/**
	 * Class constructor.
	 */
	public function __construct() {
        $this->add_hooks();
	}

	private function add_hooks() {
        
	}

    public function create_post($title, $content) {
        $new_post = array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id(),
            'post_category' => array(1) // Default category
        );

        wp_insert_post($new_post);
    }
}