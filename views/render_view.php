<?php
$demo_data         = array(
	'style' => array(
		'template_type'         => 'background',
		'question_text_color'   => '#000000',
		'item_backgroung_color' => '#ffffff',
		'answer_text_color'     => '#636363',
		'category_text_color'   => '#000000'
	)
);
$layout_type       = $config ? $config['faq_layout']['layout_type'] : 'accordion';
$search_visibility = $config ? $config['faq_content']['enable_search_approach'] : false;
$titleVisibility   = $config ? $config['faq_content']['display_content_title_visible'] : true;
$categories        = $config ? $config['faq_content']['faq_question_categories'] : array();
$style             = $config ? $config['faq_style'] : $demo_data['style'];
$grid_size         = 0;
$question_grid     = ( count( $categories ) == 1 && $layout_type == 'multicolumn' ) ? 6 : 12;
if ( $layout_type != "multicolumn" ) {
	$grid_size = 12;
} else {
	if ( $layout_type == 'multicolumn' && count( $categories ) == 1 ) {
		$grid_size = 12;
	} else {
		$grid_size = 6;
	}
}
?>


<div class="wp_faq-wrapper <?php echo $layout_type, $titleVisibility ? '' : ' category-none'; ?>">
	<?php if ( $search_visibility ): ?>
        <div class="wp_faq_search_panel">
            <div class="wp_faq_search_box_area">
                <input type="text" class="wp_faq_search_box" placeholder="Search" />
            </div>
        </div>
	<?php endif; ?>

	<?php foreach ( $categories as $category ): ?>
        <div class="wp_faq_category wp_faq-inner-wrapper ninja-col-md-<?php echo $grid_size, $titleVisibility
			? ' not-allow' : ' allow'; ?>">
            <!-- Category Title Section-->
            <section class="wp_faq_category-title">
				<?php if ( $titleVisibility ): ?>
                    <!-- Category Title -->
                    <h1 style="color:<?php echo $style['category_text_color']; ?>" class="wp_faq_category-title">
						<?php if($category['icon'] && $category['icon'] != 'No icon'): ?>
                            <i class="<?php echo $category['icon'] ?>"></i>
						<?php endif; ?>
						<?php echo $category['title'] ?>
                    </h1>
				<?php endif; ?>
            </section>
            <!-- Question Items -->
            <section class="wp_faq-content-category-items wp_faq_<?php echo $layout_type; ?> <?php echo $style['template_type']; ?>">
				<?php foreach ( $category['questions'] as $question ): ?>
                    <!-- Question -->
                    <div class="wp_faq-content-category-item-part ninja-col-md-<?php echo $question_grid, $layout_type != 'multicolumn' ? ' remove-padding' : ''; ?>">
                        <div class="wp_faq-content-category-item"
                             style="background: <?php echo $style['item_backgroung_color']; ?>">
                            <!-- Question Title -->
                            <div class="wp_faq-content-category-item-question" style="color:<?php echo $style['question_text_color']; ?>">
                                <!-- title -->
                                <span class="wp_faq-content-category-item-question-text">
                                    <?php echo $question['title']; ?>
                                </span>
                                <!-- right side icon -->
                                <span class="wp_faq-content-category-item-question-icon <?php echo $config['faq_layout']['accordion_icon'] ?: 'plus-icon'; ?>"></span>
                            </div>
                            <!-- Answer -->
                            <div class="wp_faq-content-category-item-answer" style="color:<?php echo $style['answer_text_color']; ?>">
                                <div class="wp_faq-content-category-item-answer-text">
									<?php echo $question['answer']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endforeach; ?>
            </section>
        </div>
	<?php endforeach; ?>
    
    <div class="wp_faq_no_result_found">
        <?php 
            $no_result_found_text = __('No Result Found', 'wp_faq_builder');
            $no_result_found_text = apply_filters('wp_faq_builder_no_result_found_text', $no_result_found_text, $faq_id);
        ?>
        <h3><?php echo $no_result_found_text; ?></h3>
    </div>
    
</div>