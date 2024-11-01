<?php

namespace WPFAQBuilder\Classes;

class Cache
{
    public static function isActive($id)
    {
        return apply_filters('wp_faq_builder_cache_content_status', true, $id);
    }

    public static function find($id)
    {
        return get_post_meta($id, '_wp_faq_builder_html_'.WP_FAQ_BUILDER_CACHED_VERSION, true);
    }

    public static function save($id, $content)
    {
        update_post_meta($id, '_wp_faq_builder_html_'.WP_FAQ_BUILDER_CACHED_VERSION, $content);
    }

    public static function delete($id)
    {
        update_post_meta($id, '_wp_faq_builder_html_'.WP_FAQ_BUILDER_CACHED_VERSION, false);
    }
}
