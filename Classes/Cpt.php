<?php

namespace WPFAQBuilder\Classes;

class Cpt
{
    public static function register()
    {
        $cptArgs = array(
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => false,
            'show_in_menu'       => false,
            'query_var'          => false,
            'label'              => __('WP FAQ Builder', 'wp_faq_builder')
        );

        register_post_type('wp_faq_builder', $cptArgs);
    }
}
