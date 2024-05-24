<?php
/*
 * Template Name: Soegning
 * Template Post Type: page
 */

get_header();

include_once(WP_PLUGIN_DIR . '/storagelens/search/search-module.php');

// Get query parameters
$location = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : '';
$types = isset($_GET['type']) ? array_map('sanitize_text_field', $_GET['type']) : array();


// Add your custom search logic here
// You can use WP_Query or any other method to fetch results based on $location and $types

// Fetch Elementor template content
$elementor_template_id = 123; // Replace with your Elementor template ID
echo do_shortcode('[elementor-template id="91979"]');

get_footer();
