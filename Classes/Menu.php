<?php
namespace WPFAQBuilder\Classes;

class Menu
{
    public static function addAdminMenuPages()
    {
        add_menu_page(
            __('WP FAQ Builder', 'wp_faq_builder'),
            __('WP FAQ Builder', 'wp_faq_builder'),
            static::managePermission(),
            'wp-faq-builder',
            array(static::class, 'render'),
            self::getMenuIcon(),
            30
        );
    }

    public static function render()
    {
    	
        wp_enqueue_script(
            'wp_faq_builder_admin',
            WP_FAQ_BUILDER_DIR_URL.'public/js/wp_faq_builder_admin.js',
            array('jquery'),
            WP_FAQ_BUILDER_VERSION,
            true
        );

        wp_enqueue_style('wp_faq_builder_admin', WP_FAQ_BUILDER_DIR_URL.'public/css/wp_faq_builder_admin.css', array('dashicons'), WP_FAQ_BUILDER_VERSION);

        wp_localize_script(
            'wp_faq_builder_admin',
            'wp_faq_builder_admin',
            [
                'img_path' => WP_FAQ_BUILDER_DIR_URL.'public/img/',
                'i18n'     => array()
            ]
        );

        include WP_FAQ_BUILDER_DIR_PATH.'views/admin_view.php';
    }

    public static function managePermission()
    {
        return apply_filters('wp_faq_builder_manager', 'manage_options');
    }
    
    
    public static function getMenuIcon() {
	    return 'data:image/svg+xml;base64,'
	           .base64_encode('<svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 464 367.2"><defs><style>.cls-1{fill:url(#radial-gradient);}.cls-2{fill:#050000;}</style><radialGradient id="radial-gradient" cx="232" cy="232" r="209.2" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"/><stop offset="0.01" stop-color="#f6f6f6"/><stop offset="0.05" stop-color="#c8c8c8"/><stop offset="0.09" stop-color="#9d9d9d"/><stop offset="0.14" stop-color="#777"/><stop offset="0.2" stop-color="#575757"/><stop offset="0.25" stop-color="#3b3b3b"/><stop offset="0.32" stop-color="#252525"/><stop offset="0.4" stop-color="#141414"/><stop offset="0.49" stop-color="#090909"/><stop offset="0.63" stop-color="#020202"/><stop offset="1"/></radialGradient></defs><title>faq</title><path class="cls-1" d="M440,96.4H336v-24a24,24,0,0,0-24-24H24a24,24,0,0,0-24,24V359.6a8,8,0,0,0,13.66,5.66L90.51,288.4H128V407.6a8,8,0,0,0,13.66,5.66l76.86-76.86H440a24,24,0,0,0,24-24v-192A24,24,0,0,0,440,96.4Zm-312,24v152H87.2a8,8,0,0,0-5.66,2.34L16,340.29V72.4a8,8,0,0,1,8-8H312a8,8,0,0,1,8,8v24H152A24,24,0,0,0,128,120.4Zm320,192a8,8,0,0,1-8,8H215.2a8,8,0,0,0-5.66,2.34L144,388.29V120.4a8,8,0,0,1,8-8H440a8,8,0,0,1,8,8Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M272,248.4v-72a24,24,0,0,0-24-24H208a24,24,0,0,0-24,24v72a24,24,0,0,0,24,24h40a23.61,23.61,0,0,0,10.28-2.4l13.32,13.32L282.91,272,269.6,258.68A23.6,23.6,0,0,0,272,248.4Zm-64,8a8,8,0,0,1-8-8v-72a8,8,0,0,1,8-8h40a8,8,0,0,1,8,8v68.69l-18.34-18.34-11.31,11.31,18.34,18.34Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M288,208.4h32v16H288Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M408,152.4H344a8,8,0,0,0-8,8v112h16v-56h48v56h16v-112A8,8,0,0,0,408,152.4Zm-56,48v-32h48v32Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M48,96.4H80v16H48Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M96,96.4h24v16H96Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M48,136.4h72v16H48Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M48,176.4h72v16H48Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M48,216.4H64v16H48Z" transform="translate(0 -48.4)"/><path class="cls-2" d="M80,216.4h40v16H80Z" transform="translate(0 -48.4)"/></svg>');
    }
    
}
