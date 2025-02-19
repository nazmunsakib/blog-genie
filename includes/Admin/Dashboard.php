<?php
/**
 * Dashboard
 *
 * @package BlogGenie
 */
namespace BlogGenie\Admin;
use BlogGenie\Api;
use BlogGenie\BG_Post;

defined('ABSPATH') || die();

class Dashboard {

	/**
	 * Class constructor.
	 */
	public function __construct() {
        $this->add_hooks();
	}

	private function add_hooks() {

	}

    public function render_dashboard() {
        ?>
        <div class="wrap">
            <h1>WP Auto Blogging</h1>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="bg_generate_post">
                <?php wp_nonce_field('bg_generate_post_nonce', 'wpab_nonce'); ?>
                <label for="post_topic">Enter a Blog Topic:</label><br>
                <input type="text" id="post_topic" name="post_topic" required>
                <button type="submit" class="button-primary">Generate & Publish</button>
            </form>
        </div>
        <?php
	}

    public function handle_form_submission() {
        if (!isset($_POST['wpab_nonce']) || !wp_verify_nonce($_POST['wpab_nonce'], 'bg_generate_post_nonce')) {
            wp_die('Security check failed');
        }

        $topic = sanitize_text_field($_POST['post_topic']);
        if (!empty($topic)) {
            $api        =  new Api();
            $content    =  $api->generate_content($topic);

            if ($content) {
                $post_handler = new BG_Post();
                $post_handler->create_post($topic, $content);
                wp_redirect(admin_url('admin.php?page=blog-genie&message=success'));
                exit;
            }
        }

        wp_redirect(admin_url('admin.php?page=blog-genie&message=error'));
        exit;
    }


}