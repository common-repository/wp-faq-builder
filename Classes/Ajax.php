<?php
namespace WPFAQBuilder\Classes;

class Ajax
{
    /**
     * Handle ajax calls for the FAQ.
     *
     * @return void
     */
    public static function handle()
    {
    	if(!current_user_can(Menu::managePermission())) {
    		return;
	    }
	    
        $routes = array(
            'get_faqs'      => 'index',
            'get_faq'       => 'find',
            'add_faq'       => 'store',
            'update_faq'    => 'update',
            'delete_faq'    => 'destroy',
            'update_config' => 'configure'
        );

        $route = sanitize_text_field($_REQUEST['route']);

        if (isset($routes[$route])) {
	        $method = $routes[ $route ];
	        ( new Faq )->{$method}();
        }
        wp_die();
    }
}
