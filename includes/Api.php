<?php
/**
 * Api
 *
 * @package BlogGenie
 */
namespace BlogGenie;

defined('ABSPATH') || die();

class Api {

	/**
	 * Class constructor.
	 */
	public function __construct() {
        $this->add_hooks();
	}

	private function add_hooks() {

	}

    public function generate_content($topic) {
        $api_url = "https://api-inference.huggingface.co/models/facebook/bart-large-cnn";
        $headers = array(
            "Authorization: Bearer YOUR_HUGGINGFACE_API_KEY",
            "Content-Type: application/json"
        );
        
        $data = json_encode(array("inputs" => "Write a blog about: " . $topic));
    
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $result = json_decode($response, true);
    
        return isset($result[0]['generated_text']) ? $result[0]['generated_text'] : "AI failed to generate content.";
    }


}