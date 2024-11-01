<?php
/*
Plugin Name: WP FAQ Builder
Description: Fast and Modern FAQ Builder Plugin for WordPress
Version: 1.0.0
Author: WPManageNinja
Author URI: https://wpmanageninja.com
Plugin URI: https://wpmanageninja.com/faq-builder
License: GPLv2 or later
Text Domain: wp_faq_builder
Domain Path: /languages
*/

defined('ABSPATH') or die;

define('WP_FAQ_BUILDER_DIR_URL', plugin_dir_url(__FILE__));
define('WP_FAQ_BUILDER_DIR_PATH', plugin_dir_path(__FILE__));
define('WP_FAQ_BUILDER_VERSION', '1.0.0');
define('WP_FAQ_BUILDER_CACHED_VERSION', '1');

include 'load.php';

class WPFAQBuilderPlugin
{
    public function boot()
    {
        $this->commonHooks();
        $this->adminHooks();
        $this->publicHooks();
    }

    public function commonHooks()
    {
        add_shortcode(
            'wp_faq_builder',
            array('WPFAQBuilder\Classes\Renderer', 'render')
        );

        add_action('init', function () {
            \WPFAQBuilder\Classes\Demo::make();
        });
    }

    public function adminHooks()
    {
        add_action('init', array('WPFAQBuilder\Classes\Cpt', 'register'));

        add_action('admin_menu', array('WPFAQBuilder\Classes\Menu', 'addAdminMenuPages'));

        add_action('wp_ajax_wp_faq_ajax_actions', array('WPFAQBuilder\Classes\Ajax', 'handle'));

        add_action('wp_faq_builder_updated_config', array('WPFAQBuilder\Classes\Cache', 'delete'));
    }

    public function publicHooks()
    {
        // public hooks...
    }
}

add_action('plugins_loaded', function () {
    $faqBuilder = new WPFAQBuilderPlugin();
    $faqBuilder->boot();
});
