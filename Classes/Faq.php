<?php

namespace WPFAQBuilder\Classes;

class Faq
{
    private $postType = 'wp_faq_builder';

    public function index()
    {
        $pageNumber = intval($_REQUEST['page_number']);
        $perPage = intval($_REQUEST['per_page']);

        $offset = ($pageNumber - 1) * $perPage;

        $faqs = get_posts([
            'post_type'      => $this->postType,
            'offset'         => $offset,
            'posts_per_page' => $perPage
        ]);

        $total = wp_count_posts($this->postType);

        $formatted = array();

        foreach ($faqs as $faq) {
            $formatted[] = array(
                'ID'         => $faq->ID,
                'post_title' => $faq->post_title,
                'demo_url'   => home_url().'?wp_faq_builder_preview='.$faq->ID.'#wp_faq_builder_preview'
            );
        }

        wp_send_json_success([
            'faqs'  => $formatted,
            'total' => intval($total->publish)
        ], 200);
    }

    public function find()
    {
        $id = intval($_REQUEST['id']);

        $faq = get_post($id);

        $formatted = (object) [
            'ID'         => $faq->ID,
            'post_title' => $faq->post_title
        ];

        $faqConfig = get_post_meta($id, '_wp_faq_builder_config', true);

        wp_send_json_success([
            'faq'        => $formatted,
            'faq_config' => $faqConfig,
            'demo_url'   => home_url().'?wp_faq_builder_preview='.$id.'#wp_faq_builder_preview'
        ]);
    }

    public function store()
    {
        $title = sanitize_text_field($_REQUEST['title']);

        $this->validate();

        $data = array(
            'post_title'  => $title,
            'post_type'   => $this->postType,
            'post_status' => 'publish'
        );

        $id = wp_insert_post($data);

        do_action('wp_faq_builder_added', $id);

        wp_send_json_success([
            'message'  => __('Successfully created the FAQ List.', 'wp_faq_builder'),
            'id' => $id
        ], 200);
    }

    public function update()
    {
        $id = intval($_REQUEST['id']);

        $this->validate();

        $data = array(
            'ID'         => $id,
            'post_title' => sanitize_text_field($_REQUEST['title'])
        );

        wp_update_post($data);

        wp_send_json_success([
            'message' => __('Successfully updated the FAQ List name.', 'wp_faq_builder')
        ], 200);
    }

    public function destroy()
    {
        $id = intval($_REQUEST['id']);

        delete_post_meta($id, '_wp_faq_builder_config');

        wp_delete_post($id);

        wp_send_json_success([
            'message' => __('Successfully deleted the FAQ List.', 'wp_faq_builder')
        ], 200);
    }

    public function configure()
    {
        $id = intval($_REQUEST['id']);

        $config = wp_unslash($_REQUEST['config']);
	    
        $config = json_decode($config, true);
	    $config['faq_content']['faq_question_categories'] = wp_unslash($config['faq_content']['faq_question_categories']);
	    
        update_post_meta($id, '_wp_faq_builder_config', $config);

        do_action('wp_faq_builder_updated_config', $id, $config);

        wp_send_json_success([
            'message' => __('Successfully updated the FAQ List.', 'wp_faq_builder')
        ]);
    }

    private function validate()
    {
        if (! sanitize_text_field($_REQUEST['title'])) {
            wp_send_json_error([
                'message' => __('The faq list name field is required.', 'wp_faq_builder')
            ], 423);
        }
    }
}
