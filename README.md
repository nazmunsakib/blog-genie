# Blog Genie - WordPress Auto Blogging Plugin

![Blog Genie](https://img.shields.io/badge/WordPress-6.5-blue.svg)
![PHP](https://img.shields.io/badge/PHP-%3E=5.6-green.svg)
![License](https://img.shields.io/badge/License-GPL%20v2-orange.svg)

## Description
**Blog Genie** is a powerful WordPress auto-blogging plugin that generates and publishes AI-powered blog posts with minimal effort. Simply provide a topic, and Blog Genie will create high-quality content using AI.

### Features
✅ **AI-Powered Content Generation** - Automatically generate blog posts from a given topic using Hugging Face AI models.
✅ **One-Click Publishing** - Instantly publish AI-generated blog posts to your WordPress site.
✅ **Custom API Key Integration** - Securely configure your AI API key in plugin settings.
✅ **Easy-to-Use Dashboard** - Generate and publish blog posts with an intuitive WordPress admin interface.
✅ **Security Measures** - Includes nonce verification and proper sanitization to prevent vulnerabilities.
✅ **Fully Compatible** - Works seamlessly with WordPress 6.5+ and WooCommerce.

## Installation

### From WordPress Admin:
1. Go to **Plugins > Add New**.
2. Click **Upload Plugin** and select the `blog-genie.zip` file.
3. Click **Install Now**, then **Activate** the plugin.

### Manual Installation:
1. Download the latest release from [GitHub](https://github.com/nazmunsakib/blog-genie).
2. Extract the `blog-genie` folder and upload it to `/wp-content/plugins/`.
3. Activate the plugin from the **Plugins** menu in WordPress.

## Configuration

1. Navigate to **Settings > Blog Genie** in your WordPress admin panel.
2. Enter your **Hugging Face API Key** (required for AI-generated content).
3. Click **Save Changes**.
4. Go to **Blog Genie Dashboard** and enter a topic.
5. Click **Generate & Publish**, and the AI-generated blog post will be published automatically.

## API Integration
Blog Genie utilizes the **Hugging Face AI API** for text generation. Ensure you have an active API key and set it in your WordPress settings.

### Example API Request
```php
$api_url = "https://api-inference.huggingface.co/models/facebook/bart-large-cnn";
$headers = [
    "Authorization: Bearer YOUR_API_KEY",
    "Content-Type: application/json"
];
$data = json_encode(["inputs" => "Write a blog about: Artificial Intelligence in 2024"]);

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);
```

## Screenshots
1. **Admin Dashboard** - Simple interface to generate blog posts.
2. **Settings Page** - Securely configure your API key.
3. **Generated Post** - Example of AI-generated content.

## Contributing
Contributions are welcome! To contribute:
1. Fork this repository.
2. Create a new branch (`feature/new-feature`).
3. Commit your changes.
4. Push to your fork and submit a **Pull Request**.

## License
This plugin is licensed under the **GPL v2 or later**.

## Support
For issues, open a GitHub [Issue](https://github.com/nazmunsakib/blog-genie/issues) or contact [Nazmun Sakib](https://nazmunsakib.com).

---
💡 **Blog Genie - Feels like magic for blog creation!** 🚀

