<?php
/**
 * Api
 *
 * @package BlogGenie
 */
namespace BlogGenie;

defined('ABSPATH') || die();

class Api {

    protected $key;
    protected $host; 

	/**
	 * Class constructor.
	 */
	public function __construct() {
        $this->key  = get_option('wp_auto_blogging_api_key', '');
        $this->host = 'https://api-inference.huggingface.co/models/facebook/bart-large-cnn';
	}

    public function generate_content($topic) {
        if (empty($this->key)) {
            return array("error" => "Missing API key.");
        }
    
        $data = json_encode(array(
            "inputs"        =>  "Write a blog about: " . $topic,
            "parameters"    => array(
                "max_length"    => 1024,
                "min_length"    => 500,
                "temperature"   => 0.7,
                "top_p"         => 0.9
            )
        ));
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 60,  // Increased timeout to 60 seconds
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->key
            ),
        ));
    
        // Debugging: Log the request
        error_log("Sending API request to: " . $this->host);
        error_log("Request payload: " . $data);
    
        $response   = curl_exec($curl);
        $http_code  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($curl);
        curl_close($curl);
    
        // Debugging: Log the response
        error_log("API response: " . $response);
        error_log("HTTP code: " . $http_code);
        error_log("cURL error: " . $curl_error);
    
        // Handle cURL errors
        if ($curl_error) {
            return array("error" => "cURL Error: " . $curl_error);
        }
    
        // Handle HTTP errors
        if ($http_code !== 200) {
            return array("error" => "API Error: Received HTTP code " . $http_code);
        }
    
        // Decode JSON response
        $response_data = json_decode($response, true);
    
        // Validate JSON response
        if (json_last_error() !== JSON_ERROR_NONE) {
            return array("error" => "Invalid JSON response from API.");
        }
    
        return array("success" => true, "data" => $response_data);
    }


}