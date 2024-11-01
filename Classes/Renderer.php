<?php

namespace WPFAQBuilder\Classes;

class Renderer
{
    public static function render($atts)
    {
        $atts = shortcode_atts([
            'id' => null
        ], $atts);

        extract($atts);

        if (! $id) {
            return '';
        }

        $config = get_post_meta($id, '_wp_faq_builder_config', true);
        
        wp_enqueue_style('wp_faq_builder_public', WP_FAQ_BUILDER_DIR_URL.'public/css/wp_faq_builder_public.css', array('dashicons'), WP_FAQ_BUILDER_VERSION);

        wp_enqueue_script('wp_faq_builder_public', WP_FAQ_BUILDER_DIR_URL.'public/js/wp_faq_builder_public.js', array('jquery'), WP_FAQ_BUILDER_VERSION, true);

        $shouldCache = Cache::isActive($id);

        if ($shouldCache && $cachedContent = Cache::find($id)) {
            return $cachedContent;
        }

        $content = View::make('render_view', array(
            'config' => $config,
	        'faq_id' => $id
        ));

        if ($shouldCache) {
            Cache::save($id, $content);
        }
        
        return $content;
    }
}
