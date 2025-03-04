<?php
/**
 * Plugin Main Class
 *
 * @package BlogGenie
 */
namespace BlogGenie\Traits;

defined('ABSPATH') || die();

class Helper {

    /**
     * Get FAQs post list
     *
     * Retrieves a list of FAQs (from the custom post type 'product_faq') based on specified IDs.
     * 
     * @since 1.3.0
     *
     * @param int|array $ids Optional. Array of specific FAQ post IDs to retrieve.
     * @return array List of FAQ posts.
     */
    public function get_faqs( $ids = 0 ) {

        if( is_array($ids) && count($ids) == 0 ){
            return [];
        }

        $args = array(
            'post_type'         => 'product_faq',
            'posts_per_page'    => -1,
        );

        if( is_array($ids) && count($ids) > 0 ){
            $args['post__in']   = $ids;
            $args['orderby']    = 'post__in';
        }

        $faqs = get_posts($args);

        return apply_filters('pfaqm_get_product_faqs', $faqs);
    }

    /**
     * Get FAQs by Product ID
     *
     * Fetches FAQs linked to a specific WooCommerce product by ID, returning an array of published FAQ data.
     *
     * @param int $product_id The product ID for which FAQs are retrieved.
     * @return array Associative array containing FAQ ID, question, and answer.
     */
    public function faqs_by_product_id( $product_id = 0 ){

        $faq_lists  = [];
        $faq_ids    = get_post_meta( $product_id, 'pfaqm_product_faqs', true ) ?? [];

        foreach( $faq_ids as $id ) {
            $post_status = get_post_status($id);
            if( "publish" !== $post_status ) {
                continue;
            }

            $faq_lists['id']       = $id;
            $faq_lists['question'] = get_the_title($id);
            $faq_lists['answer']   = get_the_content(null, false, $id);
        }

        return apply_filters('pfaqm_get_product_faqs_data', $faq_lists);
    }

}
