<?php

// CONSTANTS
$theme = wp_get_theme();

define( 'KIDDY_SLUG', 'kiddy' );
define( 'KIDDY_DIR', get_template_directory() );
define( 'KIDDY_URI', get_template_directory_uri() );
define( 'KIDDY_JS_DIR', KIDDY_URI . '/js' );
define( 'KIDDY_BEFORE_CE_TITLE', '<h3 class="ce_title">' );
define( 'KIDDY_AFTER_CE_TITLE', '</h3>' );
define( 'KIDDY_V_SEP', '<span class="v_sep"></span>' );
define( 'KIDDY_MB_PAGE_LAYOUT_KEY', 'cws_mb_post' );
define( 'KIDDY_COLOR', '#26b4d7' );
define( 'KIDDY_FOOTER_COLOR', '#26b4d7' );
define( 'KIDDY_SECONDARY_COLOR', '#f8f2dc' );
define( 'KIDDY_OUTLINE_COLOR', '#f9e8b2' );
define( 'KIDDY_MENU_COLOR', '#fec20b' );
define( 'KIDDY_MENU_COLOR_HOVER', '#fd8e00' );

// \CONSTANTS
// GLOBALS
load_theme_textdomain( 'kiddy', KIDDY_DIR .'/language' );

// PAGEBUILDER
// CWS PB settings
function kiddy_get_pb_options() {
	$body_font_settings = kiddy_get_option( 'body-font' );
	$body_font_color = isset( $body_font_settings['color'] ) ? $body_font_settings['color'] : '';

	return array(
	'modules' => array( 'text', 'tabs', 'tweet', 'accs', 'tcol', (function_exists( 'register_cws_portfolio' ) ? 'row_ourteam' : ''), 'callout', 'row_blog', (function_exists( 'register_cws_portfolio' ) ? 'row_portfolio' : '') ),
	'parallax' => true,
	'portfolio' => array(
		'options' => array(
			'post_type' => 'cws_portfolio',
			'taxonomy' => 'cws_portfolio_cat',
			),
		),
	'ourteam' => array(
		'options' => array(
			'post_type' => 'cws_staff',
			'taxonomy' => 'cws_staff_member_department',
		),
	),
	'callout' => array(
		'layout' => array(
			'p_title' => array(
				'title' => esc_html__( 'Title', 'kiddy' ),
				'type' => 'text',
			),
			'p_c_btn_text' => array(
				'title' => esc_html__( 'Button name', 'kiddy' ),
				'type' => 'text',
				'value' => 'Purchase Now',
			),
			'p_c_btn_href' => array(
				'title' => esc_html__( 'Button URL', 'kiddy' ),
				'type' => 'text',
				'value' => '#',
			),
			'p_custom_colors' => array(
				'title' => esc_html__( 'Custom colors', 'kiddy' ),
				'type' => 'checkbox',
				'atts' => 'data-options="toggle:p_custom_pattern;toggle:p_custom_color;toggle:p_custom_text_color;toggle:p_custom_button_color;toggle:p_custom_button_hover_color;toggle:p_custom_text_button_color;"',
			),
			'p_custom_pattern' => array(
				'title' => esc_html__( 'Pattern', 'kiddy' ),
				'type' => 'media',
				'addrowclasses' => 'disable',
			),
			'p_custom_color' => array(
				'title' => 'Custom Background color',
				'type' => 'text',
				'addrowclasses' => 'disable',
				'value' => KIDDY_COLOR,
				'atts' => 'data-default-color="'.KIDDY_COLOR.'"',
			),
			'p_custom_text_color' => array(
				'title' => 'Custom Text color',
				'type' => 'text',
				'addrowclasses' => 'disable',
				'value' => '#ffffff',
				'atts' => 'data-default-color="#ffffff"',
			),
			'p_custom_button_color' => array(
				'title' => 'Custom button background color',
				'type' => 'text',
				'addrowclasses' => 'disable',
				'value' => KIDDY_MENU_COLOR,
				'atts' => 'data-default-color="'.KIDDY_MENU_COLOR.'"',
			),
			'p_custom_button_hover_color' => array(
				'title' => 'Custom button hover background color',
				'type' => 'text',
				'addrowclasses' => 'disable',
				'value' => KIDDY_MENU_COLOR_HOVER,
				'atts' => 'data-default-color="'.KIDDY_MENU_COLOR_HOVER.'"',
			),
			'p_custom_text_button_color' => array(
				'title' => 'Custom button text color',
				'type' => 'text',
				'addrowclasses' => 'disable',
				'value' => '#ffffff',
				'atts' => 'data-default-color="#ffffff"',
			),
			'module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
			'insertmedia' => array(
				'type' => 'insertmedia',
				'rowclasses' => 'row',
			),
			'cws-pb-tmce' => array(
				'type' => 'textarea',
				'rowclasses' => 'cws-pb-tmce',
				'atts' => 'class="wp-editor-area" id="wp-editor-area"',
			),
		),
	),
	'text' => array(
		'layout' => array(
			'p_title' => array(
				'title' => esc_html__( 'Title', 'kiddy' ),
				'type' => 'text',
			),
			'module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
			'insertmedia' => array(
				'type' => 'insertmedia',
				'rowclasses' => 'row',
			),
			'cws-pb-tmce' => array(
				'type' => 'textarea',
				'rowclasses' => 'cws-pb-tmce',
				'atts' => 'class="wp-editor-area" id="wp-editor-area"',
			),
		),
	),
	'margins_label' => 'Padding:',
	'tcol' => array(
		'layout' => array(
			'p_title' => array(
				'title' => 'Column title',
				'type' => 'text',
				'value' => 'START',
			),
			'p_encouragement' => array(
				'title' => 'Encouragement',
				'type' => 'text',
				'value' => 'Great for small business',
			),
			'p_currency' => array(
				'title' => 'Currency',
				'type' => 'text',
				'value' => '$',
			),
			'p_price' => array(
				'title' => 'Price',
				'type' => 'text',
				'value' => '60',
			),
			'p_price_description' => array(
				'title' => 'Price description',
				'type' => 'text',
				'value' => 'monthly',
			),
			'p_order_url' => array(
				'title' => 'Order url',
				'type' => 'text',
				'value' => '#',
			),
			'p_button_text' => array(
				'title' => 'Button text',
				'type' => 'text',
				'value' => 'buy now',
			),
			'p_ishilited' => array(
				'title' => 'Highlighted',
				'type' => 'checkbox',
			),
			'module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
			'insertmedia' => array(
				'type' => 'insertmedia',
				'rowclasses' => 'row',
			),
			'cws-pb-tmce' => array(
				'type' => 'textarea',
				'rowclasses' => 'cws-pb-tmce',
				'atts' => 'class="wp-editor-area" id="wp-editor-area"',
			),
		),
	),
	'col-title' => array(
		'layout' => array(
			'p_title' => array(
				'title' => 'Widget Title',
				'type' => 'text',
			),
			'p_vertical' => array(
					'title' => 'Vertical view',
					'type' => 'checkbox',
			),
			'module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'accs-title' => array(
		'layout' => array(
			'p_title' => array(
				'title' => 'Accordion Title',
				'type' => 'text',
			),
			'p_altstyle' => array(
				'title' => esc_html__( 'Alt style', 'kiddy' ),
				'type' => 'checkbox',
			),
			'p_istoggle' => array(
				'title' => 'Use it as toggle?',
				'type' => 'checkbox',
			),
			'module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'row_ourteam' => array(
		'layout' => array(
			'p_title' => array(
				'title' => esc_html__( 'Title', 'kiddy' ),
				'type' => 'text',
			),
			'p_margins' => array(
				'title' => esc_html__( 'Margins (px)', 'kiddy' ),
				'type' => 'input_group',
				'source' => array(
					'margin_left' => array( 'number', 'Left' ),
					'margin_top' => array( 'number', 'Top' ),
					'margin_bottom' => array( 'number', 'Bottom' ),
					'margin_right' => array( 'number', 'Right' ),
				),
			),
			'p_eclass' => array(
				'title' => esc_html__( 'Extra Class', 'kiddy' ),
				'description' => esc_html__( 'Space separated class names', 'kiddy' ),
				'type' => 'text',
			),
			'p_mode' => array(
				'title' => esc_html__( 'Display', 'kiddy' ),
				'type' => 'select',
				'source' => array(
					'grid' => array( 'Grid', true, 'e:p_items_per_page;e:p_categories' ), // Title, isselected, data-options
					'grid_with_filter' => array( 'Grid with filter', false, 'e:p_items_per_page;e:p_categories' ),
					'carousel' => array( 'Carousel', false, 'd:p_items_per_page;d:p_categories;d:p_categories' ),
				),
			),
			'p_categories' => array(
				'title' => esc_html__( 'Departments ', 'kiddy' ),
				'type' => 'taxonomy',
				'atts' => 'multiple',
				'taxonomy' => 'cws_staff_member_department',
			),
			'p_items_per_page' => array(
				'title' => esc_html__( 'Items per page', 'kiddy' ),
				'type' => 'text',
			),
			'prlx_module' => array(
				'type' => 'module',
				'name' => 'prlx_add',
			),
			'ani_module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'row_portfolio' => array(
		'layout' => array(
			'p_title' => array(
				'title' => 'Title',
				'type' => 'text',
			),
			'p_margins' => array(
				'title' => esc_html__( 'Margins (px)', 'kiddy' ),
				'type' => 'input_group',
				'source' => array(
					'margin_left' => array( 'number', 'Left' ),
					'margin_top' => array( 'number', 'Top' ),
					'margin_bottom' => array( 'number', 'Bottom' ),
					'margin_right' => array( 'number', 'Right' ),
				),
			),
			'p_eclass' => array(
				'title' => esc_html__( 'Extra Class', 'kiddy' ),
				'description' => esc_html__( 'Space separated class names', 'kiddy' ),
				'type' => 'text',
			),
				'p_columns' => array(
					'title' => 'Select number of columns',
					'type' => 'select',
					'source' => array(
						'1' => array( 'One' ), // Title, isselected, data-options
						'2' => array( 'Two', true ),
						'3' => array( 'Three' ),
						'4' => array( 'Four' ),
						),
				),
				'p_categories' => array(
					'title' => 'Select categories',
					'type' => 'taxonomy',
					'atts' => 'multiple',
					'taxonomy' => 'cws_portfolio_cat',
				),
				'p_mode' => array(
					'title' => 'Select mode',
					'type' => 'select',
					'source' => array(
						'grid' => array( 'Grid', true, 'e:p_items_per_page' ), // Title, isselected, data-options
						'grid_with_filter' => array( 'Grid with filter', false, 'e:p_items_per_page' ),
						'carousel' => array( 'Carousel', false, 'd:p_items_per_page' ),
					),
				),
				'p_portcontent' => array(
					'title' => 'Items content',
					'type' => 'select',
					'source' => array(
						'none' => array( 'None' ), // Title, isselected, data-options
						'exerpt' => array( 'Exerpt',true ),
						'categories' => array( 'Categories' ),
					),
				),
				'p_items_per_page' => array(
					'title' => 'Items',
					'type' => 'text',
				),
			'prlx_module' => array(
				'type' => 'module',
				'name' => 'prlx_add',
			),
			'ani_module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'row_blog' => array(
		'layout' => array(
			'p_title' => array(
				'title' => 'Title',
				'type' => 'text',
			),
			'p_margins' => array(
				'title' => esc_html__( 'Margins (px)', 'kiddy' ),
				'type' => 'input_group',
				'source' => array(
					'margin_left' => array( 'number', 'Left' ),
					'margin_top' => array( 'number', 'Top' ),
					'margin_bottom' => array( 'number', 'Bottom' ),
					'margin_right' => array( 'number', 'Right' ),
				),
			),
			'p_eclass' => array(
				'title' => esc_html__( 'Extra Class', 'kiddy' ),
				'description' => esc_html__( 'Space separated class names', 'kiddy' ),
				'type' => 'text',
			),
			'p_columns' => array(
				'title' => 'Select number of columns',
				'type' => 'select',
				'source' => array(
					'1' => array( 'One', true ), // Title, isselected, data-options
					'2' => array( 'Two' ),
					'3' => array( 'Three' ),
				),
			),
			'p_categories' => array(
				'title' => 'Select categories',
				'type' => 'taxonomy',
				'atts' => 'multiple',
				'taxonomy' => 'category',
			),
			'p_tags' => array(
				'title' => 'Select tags',
				'type' => 'taxonomy',
				'atts' => 'multiple',
				'taxonomy' => 'post_tag',
			),
			'p_items_per_page' => array(
				'title' => 'Items',
				'type' => 'text',
			),
			'p_use_carousel' => array(
				'title' => 'Use carousel',
				'type' => 'checkbox',
			),
			'p_custom_layout' => array(
				'title' => 'Custom layout',
				'type' => 'checkbox',
				'atts' => 'data-options="toggle:p_post_text_length;toggle:p_enable_lightbox;toggle:p_hide_meta;toggle:p_button_name"',
			),
			'p_post_text_length' => array(
				'title' => esc_html__( 'Post text length', 'kiddy' ),
				'type' => 'text',
				'addrowclasses' => 'disable',
			),
			'p_button_name' => array(
				'title' => esc_html__( 'Button name', 'kiddy' ),
				'type' => 'text',
				'addrowclasses' => 'disable',
			),
			'p_enable_lightbox' => array(
				'title' => 'Disable Lightbox',
				'type' => 'checkbox',
				'addrowclasses' => 'disable',
			),
			'p_hide_meta' => array(
				'title' => 'Hide meta section',
				'type' => 'checkbox',
				'addrowclasses' => 'disable',
			),
			'prlx_module' => array(
				'type' => 'module',
				'name' => 'prlx_add',
			),
			'ani_module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'col' => array(
		'layout' => array(
			'p_margins' => array(
				'title' => esc_html__( 'Margins (px)', 'kiddy' ),
				'type' => 'input_group',
				'source' => array(
					'margin_left' => array( 'number', 'Left' ),
					'margin_top' => array( 'number', 'Top' ),
					'margin_bottom' => array( 'number', 'Bottom' ),
					'margin_right' => array( 'number', 'Right' ),
				),
			),
			'p_eclass' => array(
				'title' => esc_html__( 'Extra Class', 'kiddy' ),
				'description' => esc_html__( 'Space separated class names', 'kiddy' ),
				'type' => 'text',
			),
			'bg_module' => array(
				'type' => 'module',
				'name' => 'prlx_add',
			),
			'ani_module' => array(
				'type' => 'module',
				'name' => 'ani_add',
			),
		),
	),
	'prlx_add' => array(
		'layout' => array(
			'p_customize_bg' => array(
				'title' => esc_html__( 'Custom Background', 'kiddy' ),
				'type' => 'checkbox',
				'atts' => 'data-options="toggle:p_bg_media_type;toggle:p_bg_color_type;toggle:p_font_color;"',
			),
			'p_bg_media_type' => array(
				'title' => esc_html__( 'Media type', 'kiddy' ),
				'type' => 'select',
				'source' => array(
					'none' => array( 'None', true, 'd:p_bg_img;d:p_is_bg_img_high_dpi;d:p_bg_video_type;d:p_bg_pattern;d:p_use_prlx;' ),
					'img' => array( 'Image', false, 'e:p_bg_img;e:p_is_bg_img_high_dpi;e:p_bg_pattern;e:p_use_prlx;d:p_bg_video_type;' ),
					'video' => array( 'Video', false, 'd:p_is_bg_img_high_dpi;e:p_bg_video_type;e:p_bg_pattern;e:p_use_prlx;d:p_bg_img;' ),
					),
				'addrowclasses' => 'disable',
				),
			'p_bg_img' => array(
				'title' => esc_html__( 'Image', 'kiddy' ),
				'type' => 'media',
				'atts' => 'data-role="media"',
				'addrowclasses' => 'disable',
				),
			'p_is_bg_img_high_dpi' => array(
				'title' => esc_html__( 'This is HiDPI image', 'kiddy' ),
				'type' => 'checkbox',
				'addrowclasses' => 'disable',
				),
			'p_bg_video_type' => array(
				'title' => esc_html__( 'Video type', 'kiddy' ),
				'type' => 'select',
				'source' => array(
					'1' => array( 'Self hosted', true, 'e:p_sh_bg_video_source;d:p_yt_bg_video_source;d:p_vimeo_bg_video_source;' ),
					'2' => array( 'YouTube', false, 'e:p_yt_bg_video_source;d:p_sh_bg_video_source;d:p_vimeo_bg_video_source;' ),
					'3' => array( 'Vimeo', false, 'e:p_vimeo_bg_video_source;d:p_sh_bg_video_source;d:p_yt_bg_video_source;' ),
					),
				'addrowclasses' => 'disable',
				),
			'p_sh_bg_video_source' => array(
				'title' => esc_html__( 'Source', 'kiddy' ),
				'type' => 'media',
				'addrowclasses' => 'disable',
				),
			'p_yt_bg_video_source' => array(
				'title' => esc_html__( 'YouTube ID', 'kiddy' ),
				'type' => 'text',
				'value' => '',
				'addrowclasses' => 'disable',
				),
			'p_vimeo_bg_video_source' => array(
				'title' => esc_html__( 'Vimeo embed URL', 'kiddy' ),
				'type' => 'text',
				'value' => '',
				'addrowclasses' => 'disable',
				),

			'p_bg_color_type' => array(
				'title' => esc_html__( 'Background Color', 'kiddy' ),
				'type' => 'select',
				'source' => array(
					'none' => array( 'None', true, 'd:p_bg_color;d:p_bg_color_opacity;' ),
					'color' => array( 'Color', false, 'e:p_bg_color;e:p_bg_color_opacity;' ),
					),
				'addrowclasses' => 'disable',
				),
			'p_bg_color' => array(
				'title' => esc_html__( 'Color', 'kiddy' ),
				'type' => 'text',
				'atts' => 'data-default-color="' . KIDDY_COLOR . '"',
				'value' => KIDDY_COLOR,
				'addrowclasses' => 'disable',
				),
			'p_bg_color_opacity' => array(
				'title' => esc_html__( 'Opacity', 'kiddy' ),
				'description' => esc_html__( 'In percents', 'kiddy' ),
				'type' => 'number',
				'atts' => 'min="1" max="100" step="1"',
				'value' => '40',
				'addrowclasses' => 'disable',
			),

			'p_use_prlx' => array(
				'title' => esc_html__( 'Apply Parallax', 'kiddy' ),
				'type' => 'checkbox',
				'atts' => 'data-options="toggle:p_prlx_speed;"',
				'addrowclasses' => 'disable',
				),
			'p_prlx_speed' => array(
				'title' => esc_html__( 'Parallax speed', 'kiddy' ),
				'type' => 'number',
				'atts' => 'min="1" max="100" step="1"',
				'value' => '50',
				'addrowclasses' => 'disable',
			),
			'p_bg_pattern' => array(
				'title' => esc_html__( 'Pattern', 'kiddy' ),
				'type' => 'media',
				'addrowclasses' => 'disable',
			),
			'p_font_color' => array(
				'title' => esc_html__( 'Font color', 'kiddy' ),
				'type' => 'text',
				'atts' => 'data-default-color="' . $body_font_color . '"',
				'value' => $body_font_color,
				'addrowclasses' => 'disable',
			),
		),
		),
		'tweet' => array(
				'atts' => true,
				'layout' => array(
				'p_title' => array(
					'title' => esc_html__( 'Title', 'kiddy' ),
						'type' => 'text',
				),
				'p_items' => array(
					'title' => esc_html__( 'Tweets to extract', 'kiddy' ),
					'type' => 'text',
				),
				'p_visible' => array(
					'title' => esc_html__( 'Tweets to show', 'kiddy' ),
					'type' => 'text',
				),
				'p_showdate' => array(
					'title' => esc_html__( 'Show date', 'kiddy' ),
					'type' => 'checkbox',
				),
				'module' => array(
					'type' => 'module',
					'name' => 'ani_add',
				),
				),
		),
		'ani_add' => array(
			'layout' => array(
				'p_animate' => array(
					'title' => esc_html__( 'Apply Animation', 'kiddy' ),
					'type' => 'checkbox',
					'atts' => 'data-options="toggle:p_ani_effect;toggle:p_ani_duration;toggle:p_ani_delay;toggle:p_ani_offset;toggle:p_ani_iteration"',
				),
				'p_ani_effect' => array(
					'title' => esc_html__( 'Effect', 'kiddy' ),
					'type' => 'select',
					'addrowclasses' => 'disable',
					'source' => array(
						'' => array( 'None', true ),
						'bounce' => array( 'bounce' ),
						'flash' => array( 'flash' ),
						'pulse' => array( 'pulse' ),
						'shake' => array( 'shake' ),
						'swing' => array( 'swing' ),
						'tada' => array( 'tada' ),
						'wobble' => array( 'wobble' ),
						'bounceIn' => array( 'bounceIn' ),
						'bounceInDown' => array( 'bounceInDown' ),
						'bounceInLeft' => array( 'bounceInLeft' ),
						'bounceInRight' => array( 'bounceInRight' ),
						'bounceInUp' => array( 'bounceInUp' ),
						'bounceOut' => array( 'bounceOut' ),
						'bounceOutDown' => array( 'bounceOutDown' ),
						'bounceOutLeft' => array( 'bounceOutLeft' ),
						'bounceOutRight' => array( 'bounceOutRight' ),
						'bounceOutUp' => array( 'bounceOutUp' ),
						'fadeIn' => array( 'fadeIn' ),
						'fadeInDown' => array( 'fadeInDown' ),
						'fadeInDownBig' => array( 'fadeInDownBig' ),
						'fadeInLeft' => array( 'fadeInLeft' ),
						'fadeInLeftBig' => array( 'fadeInLeftBig' ),
						'fadeInRight' => array( 'fadeInRight' ),
						'fadeInRightBig' => array( 'fadeInRightBig' ),
						'fadeInUp' => array( 'fadeInUp' ),
						'fadeInUpBig' => array( 'fadeInUpBig' ),
						'fadeOut' => array( 'fadeOut' ),
						'fadeOutDown' => array( 'fadeOutDown' ),
						'fadeOutDownBig' => array( 'fadeOutDownBig' ),
						'fadeOutLeft' => array( 'fadeOutLeft' ),
						'fadeOutLeftBig' => array( 'fadeOutLeftBig' ),
						'fadeOutRight' => array( 'fadeOutRight' ),
						'fadeOutRightBig' => array( 'fadeOutRightBig' ),
						'fadeOutUp' => array( 'fadeOutUp' ),
						'fadeOutUpBig' => array( 'fadeOutUpBig' ),
						'flipInX' => array( 'flipInX' ),
						'flipInY' => array( 'flipInY' ),
						'flipOutX' => array( 'flipOutX' ),
						'flipOutY' => array( 'flipOutY' ),
						'lightSpeedIn' => array( 'lightSpeedIn' ),
						'lightSpeedOut' => array( 'lightSpeedOut' ),
						'rotateIn' => array( 'rotateIn' ),
						'rotateInDownLeft' => array( 'rotateInDownLeft' ),
						'rotateInDownRight' => array( 'rotateInDownRight' ),
						'rotateInUpLeft' => array( 'rotateInUpLeft' ),
						'rotateInUpRight' => array( 'rotateInUpRight' ),
						'rotateOut' => array( 'rotateOut' ),
						'rotateOutDownLeft' => array( 'rotateOutDownLeft' ),
						'rotateOutDownRight' => array( 'rotateOutDownRight' ),
						'rotateOutUpLeft' => array( 'rotateOutUpLeft' ),
						'rotateOutUpRight' => array( 'rotateOutUpRight' ),
						'slideInDown' => array( 'slideInDown' ),
						'slideInLeft' => array( 'slideInLeft' ),
						'slideInRight' => array( 'slideInRight' ),
						'slideOutLeft' => array( 'slideOutLeft' ),
						'slideOutRight' => array( 'slideOutRight' ),
						'slideOutUp' => array( 'slideOutUp' ),
						'hinge' => array( 'hinge' ),
						'rollIn' => array( 'rollIn' ),
						'rollOut' => array( 'rollOut' ),
					),
				),
				'p_ani_duration' => array(
					'title' => esc_html__( 'Duration (sec)', 'kiddy' ),
					'type' => 'text',
					'value' => '2',
					'addrowclasses' => 'disable',
				),
				'p_ani_delay' => array(
					'title' => esc_html__( 'Delay (sec)', 'kiddy' ),
					'type' => 'text',
					'value' => '0',
					'addrowclasses' => 'disable',
				),
				'p_ani_offset' => array(
					'title' => esc_html__( 'Offset (px, related to bottom)', 'kiddy' ),
					'type' => 'text',
					'value' => '10',
					'addrowclasses' => 'disable',
				),
				'p_ani_iteration' => array(
					'title' => esc_html__( 'Iteration', 'kiddy' ),
					'type' => 'text',
					'value' => '1',
					'addrowclasses' => 'disable',
				),
			),
		),
	);
}


// \PAGEBUILDER
/********************************** !!! **********************************/

// reset list-to-grid plugin
add_action( 'wp_enqueue_scripts', 'kiddy_remove_gridlist_styles', 30 );

function kiddy_remove_gridlist_styles() {
	wp_dequeue_style( 'grid-list-button' );
	wp_dequeue_style( 'grid-list-layout' );
}

// UPDATE THEME
set_transient( 'update_themes', 24 * 3600 );
add_filter( 'pre_set_site_transient_update_themes', 'kiddy_check_for_update' );

function kiddy_check_for_update( $transient ) {
	if ( empty( $transient->checked ) ) { return $transient; }

	$theme_pc = trim( kiddy_get_option( '_theme_purchase_code' ) );
	if ( empty( $theme_pc ) ) {
		add_action( 'admin_notices', 'kiddy_an_purchase_code' );
	}
	$h = 0;
	$result = wp_remote_get( 'http://up.cwsthemes.com/products-updater.php?pc=' . $theme_pc . '&tname=' . KIDDY_SLUG );
	if ( ! is_wp_error( $result ) ) {
		if ( 200 == $result['response']['code'] && 0 != strlen( $result['body'] ) ) {
			$resp = json_decode( $result['body'], true );
			$h = isset( $resp['h'] ) ? (float) $resp['h'] : 0;
			$theme = wp_get_theme(get_template());
			if ( version_compare( $theme->get( 'Version' ), $resp['new_version'], '<' ) ) {
				$transient->response[ KIDDY_SLUG ] = $resp;
			}
			// request and save plugins info
			$opt_res = wp_remote_get('http://up.cwsthemes.com/plugins/update.php', array( 'timeout' => 1));
			if ( is_array( $opt_res ) && ! is_wp_error( $opt_res ) ) {
				update_option('cws_plugin_ver', array('data' => $opt_res['body'], 'lasttime' => date('U')));
			}
			// end of request and save plugins info
		} else {
			unset( $transient->response[ KIDDY_SLUG ] );
		}
	}
	$pc = get_option( 'cws_'.sprintf( '%8X', crc32( KIDDY_SLUG ) ) );
	if ( ! isset( $pc[0] ) || ( isset( $pc[0] ) && time() - $pc[0] > 30 * 24 * 3600) ) {
		update_option( 'cws_'.sprintf( '%8X', crc32( KIDDY_SLUG ) ), array( time(), $h ) );
	}
	return $transient;
}


function kiddy_an_purchase_code() {
	$kiddy_theme = wp_get_theme();
	echo "<div class='update-nag'>" . esc_html( $kiddy_theme->get( 'Name' ) ) . esc_html__( ' theme notice: Please insert your Item Purchase Code in Theme Options to get the latest theme updates!', 'kiddy' ) .'</div>';
}

// \UPDATE THEME
function kiddy_fix_shortcodes_autop( $content ) {
	$array = array(
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']',
	);

	$content = strtr( $content, $array );
	return $content;
}
add_filter( 'the_content', 'kiddy_fix_shortcodes_autop' );


function kiddy_getTweets( $count = 20 ) {
	$res = null;
	if ( '0' != kiddy_get_option( 'turn-twitter' ) ) {
		$twitt_name = trim(kiddy_get_option( 'tw-username' )) ? trim(kiddy_get_option( 'tw-username' )) : 'Creative_WS';
		if (function_exists('getTweets')) {
			$res = getTweets($twitt_name, $count);
		}
	}

	return $res;
}

require_once( KIDDY_DIR . '/core/plugins.php' );

function kiddy_after_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( ' widgets ' );
	add_theme_support( 'title-tag' );

	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

	register_nav_menu( 'header-menu', esc_html__( 'Navigation Menu', 'kiddy' ) );
	register_nav_menu( 'sidebar-menu', esc_html__( 'SideBar Menu', 'kiddy' ) );
	add_theme_support( 'woocommerce' );

	// Add Gutenberg Compatibility
	add_theme_support( 'align-wide' );

	// metaboxes
	if(class_exists('Kiddy_SCG')){
		new Kiddy_SCG();
	}
	require_once( get_template_directory() . '/core/bfi_thumb.php' );
	
	$user = wp_get_current_user();
	$user_nav_adv_options = get_user_option( 'managenav-menuscolumnshidden', get_current_user_id() );
	if ( is_array( $user_nav_adv_options ) ) {
		$css_key = array_search( 'css-classes', $user_nav_adv_options );
		if ( false !== $css_key ) {
			unset( $user_nav_adv_options[ $css_key ] );
			update_user_option( $user->ID, 'managenav-menuscolumnshidden', $user_nav_adv_options,	true );
		}
	}
}
add_action( 'after_setup_theme', 'kiddy_after_setup_theme' );

function kiddy_metabox_scripts_enqueue($a) {
global $typenow;
 if( $a == 'widgets.php' || $a == 'post-new.php' || $a == 'post.php' || $a == 'edit-tags.php' ) {
	if($typenow != 'product'){
		wp_enqueue_script('select2-js', KIDDY_URI . '/core/js/select2/select2.js', array('jquery') );
		wp_enqueue_style('select2-css', KIDDY_URI . '/core/js/select2/select2.css', false, '2.0.0' );
	}
	
	wp_enqueue_script('kiddy-metaboxes-js', KIDDY_URI . '/core/js/metaboxes.js', array('jquery') );
	wp_enqueue_style('kiddy-metaboxes-css', KIDDY_URI . '/core/css/metaboxes.css', false, '2.0.0' );
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker');
	wp_enqueue_script( 'wp-color-picker');

	wp_enqueue_style( 'mb_post_css' );
 }
}
add_action( 'admin_enqueue_scripts', 'kiddy_metabox_scripts_enqueue' );

function kiddy_filter_by_empty( $arr = array() ) {
	if ( empty( $arr ) || ! is_array( $arr ) ) { return false; }
	for ( $i = 0; $i < count( $arr ); $i++ ) {
		if ( empty( $arr[ $i ] ) ) {
			array_splice( $arr, $i, 1 );
		}
	}
	return $arr;
}

function kiddy_theme_enqueue_scripts() {
	$scripts = array(
					'retina' => 'retina_1.3.0.js',
					'modernizr' => 'modernizr.js',
					'owl_carousel' => 'owl.carousel.js',
					'isotope' => 'isotope.pkgd.min.js',
					'fancybox' => 'jquery.fancybox.js',
					'odometer' => 'odometer.js',
					'select2' => 'select2.js',
					'img_loaded' => 'imagesloaded.pkgd.min.js',
					'wow' => 'wow.min.js',
					'cws_parallax' => 'cws_parallax.js',
					'cws_self&vimeo_bg' => 'cws_self&vimeo_bg.js',
					'cws_YT_bg' => 'cws_YT_bg.js',
					'vimeo' => 'jquery.vimeo.api.min.js',
					'main' => 'scripts.js',
	);
	if ( '0' == kiddy_get_option('enable_mob_menu') ) {
		unset($scripts['modernizr']);
	}
	global $typenow;
	if($typenow != 'product'){
		unset($scripts['select2']);
	}	
	foreach ( $scripts as $alias => $src ) {
		wp_register_script( $alias, KIDDY_JS_DIR . "/$src", array( 'jquery' ), '1.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'kiddy_theme_enqueue_scripts' );

function kiddy_theme_standart_script(){
	$scripts = array (
				'retina',
				'modernizr',
				'fancybox',
				'select2',
				'img_loaded',
				'main'
			);

	foreach ($scripts as $alias) {
		if($alias == 'fancybox'){
			// Localize the script with new data
			$cws_fancy_translate = array(
				'cws_fn_close' => esc_html__( 'Close', 'kiddy' ),				
				'cws_fn_next' => esc_html__( 'Next', 'kiddy' ),
				'cws_fn_prev' => esc_html__( 'Prev', 'kiddy' ),
				'cws_fn_error' => esc_html__( 'The requested content cannot be loaded. Please try again later.', 'kiddy' )
			);
			wp_localize_script( 'fancybox', 'cws_nav', $cws_fancy_translate );
		}
		wp_enqueue_script ($alias);
	}
}

add_action('wp_enqueue_scripts', 'kiddy_theme_standart_script');

function kiddy_theme_enqueue_styles() {
	$styles =
		array(
			'font-awesome' => 'font-awesome.css',
			'cws-fancybox' => 'jquery.fancybox.css',
			'cws-odometer' => 'odometer-theme-default.css',
			'cws-select2' => 'select2.css',
			'cws-animate' => 'animate.css',
			'cws-reset' => 'reset.css',
			'cws-layout' => 'layout.css',
			'cws-main' => 'main.css',
		);

	foreach ( $styles as $key => $sc ) {
		 wp_register_style( $key, KIDDY_URI . '/css/' . $sc );
		 wp_enqueue_style( $key );
	}

	$is_custom_color = kiddy_get_option( 'is-custom-color' );
	if ( $is_custom_color != '1' ) {
		$style = kiddy_get_option( 'stylesheet' );
		if ( ! empty( $style ) ) {
			wp_register_style( 'style-color', KIDDY_URI . '/css/' . $style . '.css' );
			wp_enqueue_style( 'style-color' );
		}
	}
}
function kiddy_enqueue_theme_stylesheet() {
	wp_register_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'style' );
}
add_action( 'wp_enqueue_scripts', 'kiddy_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'kiddy_enqueue_theme_stylesheet', 999 );

function kiddy_widgets_init() {
	$sidebars = kiddy_get_option( 'sidebars' );
	if ( ! empty( $sidebars ) && function_exists( 'register_sidebars' ) ) {
								include_once 'core/pb.php';
		foreach ( $sidebars as $sb ) {
			if ( $sb ) {
				register_sidebar( array(
					'name' => $sb,
					'id' => strtolower( preg_replace( '/[^a-z0-9\-]+/i', '_', $sb ) ),
					'before_widget' => '<div class="cws-widget">',
					'after_widget' => '</div>',
					'before_title' => '<div class="widget-title">',
					'after_title' => '</div>',
					));
			}
		}
	}
}

add_action( 'widgets_init', 'kiddy_widgets_init' );

$args = array( 'default-color' => '616262' );
add_theme_support( 'custom-background', $args );

function kiddy_layout_class( $classes = array() ) {
	$boxed_layout = kiddy_get_option( 'boxed-layout' );
	$wave_style = kiddy_get_option( 'wave-style' );
	if ( $boxed_layout == '0' ) {
		array_push( $classes, 'wide' );
	}
	if ( $wave_style == '1' ) {
		array_push( $classes, 'wave-style' );
	}
	return $classes;
}
add_filter( 'body_class','kiddy_layout_class' );

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'team-thumb-admin', 100 );
	add_image_size( 'team-230', 230 );
}

function kiddy_hdpi_to_ldpi_url( $url ) {
	$width = $url['width'] ;
	$url = bfi_thumb( $url['url'], array( 'width' => floor( (int) $url['width'] / 2 ), 'crop' => true ) );
	return esc_url( $url );
}

function kiddy_footer_image_height() {
	$footer_img = kiddy_get_option( 'footer_img' );
	$footer_img_high_dpi = kiddy_get_option( 'footer_img_is_high_dpi' );
	$footer_height = (int) $footer_img['height'];
	if ( isset( $footer_img['url'] ) && ( ! empty( $footer_img['url'] ) ) ) {

		if ( $footer_img_high_dpi == 1 ) {
			$footer_height = floor( (int) $footer_img['height'] / 2 );
		}
	}
	return $footer_height;
}

function kiddy_footer_image() {
	$footer_img = kiddy_get_option( 'footer_img' );
	$footer_img_high_dpi = kiddy_get_option( 'footer_img_is_high_dpi' );
	$footer_width = '';
	$footer_height = (int) $footer_img['height'];

	if ( isset( $footer_img['url'] ) && ( ! empty( $footer_img['url'] ) ) ) {

		if ( $footer_img_high_dpi == 1 ) {
			$footer_width = floor( (int) $footer_img['width'] / 2 );
			$footer_height = floor( (int) $footer_img['height'] / 2 );
		}
	}

	$footer_img_url = ! empty( $footer_img['url'] ) ? esc_url( $footer_img['url'] ) : '';

	$footer_style_file = '';
	if ( $footer_img_high_dpi ) {
		$footer_style_file .= '
														.page_content>.footer_image{
								background-image:url(' . kiddy_hdpi_to_ldpi_url( $footer_img ) . ');
														}
														@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
														only screen and (min--moz-device-pixel-ratio: 1.5),
														only screen and (-o-device-pixel-ratio: 3/2),
														only screen and (min-device-pixel-ratio: 1.5) {
																.page_content>.footer_image{
									background-image:url(' . $footer_img_url . ');
									background-size:' . $footer_width . 'px;
																}
							}';
	} else {
		$footer_style_file .= '
								.page_content>.footer_image{
					background-image:url(' . $footer_img_url . ');
								}
		';
	}

	$footer_img_height = $footer_height;

	$footer_img_height_style = ! empty( $footer_img_height ) ? 'height:'.$footer_img_height.'px;' : '';

	$footer_img_style = $footer_img_height ? 'style="' . esc_attr($footer_img_height_style) . '"' : '';

	echo isset( $footer_img ) ? '<div class="footer_image" ' .  $footer_img_style  . '><style type="text/css">' . $footer_style_file . '</style></div>' : '' ;
}

function kiddy_pattern_image( $position ) {
	$boxed_layout = ('0' != kiddy_get_option( 'boxed-layout' ) );

	$pattern = kiddy_get_option( 'side_pattern' );
	$cutom_pattern = kiddy_get_option( 'side_pattern_custom' );
	$is_custom_puttern = (kiddy_get_option( 'side_pattern' ) == 10);
	$pattern_is_high_dpi = kiddy_get_option( 'side_pattern_custom_is_high_dpi' );

	$cutom_pattern_url = ( ! empty( $cutom_pattern['url'] ) && $is_custom_puttern) ? esc_url( $cutom_pattern['url'] ) : '';

	$is_pattern = (bool) ($pattern !== 0);

	$pattern_cont = '';
	if ( $is_pattern && ! $is_custom_puttern && ! $boxed_layout ) {
		$pattern_cont = ' pattern-'. esc_attr( $pattern );
	} else if ( $is_custom_puttern && ! $boxed_layout ) {
		$pattern_cont = ' pattern-custom';
	}

	$pattern_high_dpi_width = '';

	if ( isset( $cutom_pattern['url'] ) && ( ! empty( $cutom_pattern['url'] ) ) ) {
		if ( $pattern_is_high_dpi ) {
			$pattern_high_dpi_width = floor( (int) $cutom_pattern['width'] / 2 );
		}
		$pattern_high_dpi_width = floor( (int) $cutom_pattern['width'] / 2 );
	}

	$pattern_style_file = '';
	if ( $pattern_is_high_dpi ) {
		$pattern_style_file .= '
	.pattern-custom{
		background-image:url('.kiddy_hdpi_to_ldpi_url( $cutom_pattern ).');}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
		only screen and (min--moz-device-pixel-ratio: 1.5),
		only screen and (-o-device-pixel-ratio: 3/2),
		only screen and (min-device-pixel-ratio: 1.5) {
				.pattern-custom{
		background-image:url('.$cutom_pattern_url.');
		background-size:'.$pattern_high_dpi_width.'px;
									}
		}';
	} else {
		$pattern_style_file .= '.pattern-custom{background-image:url('.$cutom_pattern_url.');}';
	}

	$style_cont = $is_custom_puttern ? '<style type="text/css">' . $pattern_style_file . '</style>': '';

	if ( $position == 'left' ) {
		echo ! empty( $pattern_cont ) ? '<div class="left-pattern pattern ' . sanitize_html_class( $pattern_cont ) . '">' . $style_cont . '</div>' : '';
	}
	if ( $position == 'right' ) {
		echo ! empty( $pattern_cont ) ? '<div class="right-pattern pattern ' . sanitize_html_class( $pattern_cont ) . '"></div>' : '';
	}

}

/******************** TYPOGRAPHY ********************/

function kiddy_print_font_css( $font_array ) {
	$out = '';
	foreach ( $font_array as $style => $v ) {
		if ( $style != 'font-options' && $style != 'google' && $style != 'subsets' && $style != 'font-backup' ) {
			$out .= ! empty( $v ) ? $style .':'.$v.';' : '';
		}
	}
	return $out;
}


// MENU FONT HOOK
function kiddy_print_menu_font() {
	ob_start();
	do_action( 'menu_font_hook' );
	return ob_get_clean();
}

add_action( 'menu_font_hook', 'kiddy_menu_font_action' );

function kiddy_menu_font_action() {
	$font_array = kiddy_get_option( 'menu-font' );
	if ( isset( $font_array ) ) {
		echo ('.main-nav-container .menu-item a,.main-nav-container .menu-item
		 .button_open,.mobile_menu_header{'. kiddy_print_font_css( $font_array ) . '}');
		echo('.main-nav-container .sub-menu .menu-item a{font-size:'. round( ((int) $font_array['font-size']) * 0.7, 0 ) . 'px}');
		echo('.main-nav-container .sub-menu .menu-item,.cws-widget .portfolio_item_thumb .pic .links > * {color:'. $font_array['color'] . '}');
	}
}

// \MENU FONT HOOK
// HEADER FONT HOOK
function kiddy_print_header_font() {
	ob_start();
	do_action( 'header_font_hook' );
	return ob_get_clean();
}

add_action( 'header_font_hook', 'kiddy_header_font_action' );

function kiddy_header_font_action() {
	$font_array = kiddy_get_option( 'header-font' );
	if ( isset( $font_array ) ) {
		echo '.ce_title,
								.comments-area .comments_title,
								.comments-area .comment-reply-title
							{'. kiddy_print_font_css( $font_array ) . '}';
		echo '.cws_portfolio_items .item .title_part,
								.cws_portfolio_items .item .desc_part .categories a:hover,
								.wpcf7 label,
								.comments-area label,
								.cws_ourteam .cws_ourteam_items .title,
								.page_title h1,
								.testimonial .quote .quote_link:hover,
								.pagination a,
								.widget-title,
								a,
								.bread-crumbs .current,
								.cws-widget ul li>a:hover,
								.page_footer .cws-widget ul li>a:hover,
								.menu .menu-item.current-menu-ancestor>a,
								.menu .menu-item.current-menu-item>a,
								.cws-widget .current-cat>a,
								.cws-widget .current_page_item>a,
								.page_footer .cws-widget .current-cat>a,
								.page_footer .cws-widget .current_page_item>a,
								.select2-drop .select2-results .select2-highlighted,
								.select2-container.select2-container--default .select2-results__option--highlighted[aria-selected],
								.cws-widget .parent_archive .widget_archive_opener,
								.cws-widget .has_children .opener
							{color:' . $font_array['color'] . ';}';
		echo '.page_title h1,
								blockquote,
								.item .date,
								.pagination .page_links>*,
								.cws_button,
								.cws-widget .button,
								input[type="submit"],
								.more-link,
								.cws_callout .callout_title,
								.pricing_table_column .title_section,
								.pricing_table_column .price_section,
								.cws_portfolio_items .item .title_part,
								.cws_msg_box .msg_box_title,
								.milestone_number,
								.cws_progress_bar .pb_title,
								.testimonial,
								.dropcap,
								.cws-widget .widget-title,
								.comments-area .comment_list .reply,
								.cws_portfolio.single.related .carousel_nav_panel span,
								.attach .carousel_nav_panel span,
								.cws_ourteam .cws_ourteam_items .title,
								.cws_ourteam:not(.single) .cws_ourteam_items .positions,
								.news .media_part.only_link a,
								.mini-cart .button,
								.not_found,
								.milestone_desc
							{ font-family:'. $font_array['font-family'] .' !important}';
	}
}

// \HEADER FONT HOOK
// BODY FONT HOOK
function kiddy_print_body_font() {
	ob_start();
	do_action( 'body_font_hook' );
	return ob_get_clean();
}

add_action( 'body_font_hook', 'kiddy_body_font_action' );

function kiddy_body_font_action() {
	$font_array = kiddy_get_option( 'body-font' );
	if ( isset( $font_array ) ) {
		echo 'html,body
					{'. kiddy_print_font_css( $font_array ) . '}';
		echo '.cws-widget ul li>a,
								.mini-cart .cart_list
					{color:' . $font_array['color'] . ';}';
		echo 'a:hover,
								.pagination .page_links>*
					{color:' . $font_array['color'] . ';}';
		echo '.woo_mini-count span
					{font-family:' . $font_array['font-family'] . ';}';
		echo 'abbr
					{border-bottom-color:' . $font_array['color'] . ';}';
	}
}

// \BODY FONT HOOK
function kiddy_process_fonts() {
	echo '<style type="text/css" id="cws-custom-fonts-css">';
	echo kiddy_print_menu_font();
	echo kiddy_print_header_font();
	echo kiddy_print_body_font();
	echo '</style>';
}

/******************** \TYPOGRAPHY ********************/

/******************** CUSTOM COLOR ********************/

// THEME COLOR HOOK
function kiddy_print_theme_color() {
	ob_start();
		do_action( 'theme_color_hook' );
	return ob_get_clean();
}

add_action( 'theme_color_hook', 'kiddy_theme_color_action' );

add_action( 'theme_color_hook', 'kiddy_theme_color_woocommerce' );

function kiddy_content_element_pattern_style() {
	ob_start();
	do_action( 'kiddy_cont_elem_style_hook' );
	return ob_get_clean();
}
add_action( 'kiddy_cont_elem_style_hook', 'kiddy_cont_elem_pattern_style' );
function kiddy_cont_elem_pattern_style() {
	$content_patt = kiddy_get_option( 'content_pattern' );
	$content_patt_url = ! empty( $content_patt['url'] ) ? esc_url( $content_patt['url'] ) : '';
	echo ".cws_callout,
			blockquote,
			.testimonial,
			.header_logo_part.with_border .logo>img{
			background-image: url($content_patt_url);
		}";
}

function kiddy_print_timetable_style() {
	ob_start();
	do_action( 'kiddy_timetable_style_hook' );
	return ob_get_clean();
}

add_action( 'kiddy_timetable_style_hook', 'kiddy_theme_color_timetable' );

function kiddy_theme_color_timetable() {
	$font_body_array = kiddy_get_option( 'body-font' );
	$font_header_array = kiddy_get_option( 'header-font' );

	if ( function_exists( 'timetable_init' ) ) {
		echo '.tabs_box_navigation.sf-timetable-menu,
				.sf-timetable-menu li:hover ul a,
				.sf-timetable-menu li.submenu:hover ul a,
				.tt_responsive .tt_timetable.small .tt_items_list a,
				.tt_responsive .tt_timetable.small .tt_items_list span,
				.tt_event_theme_page p,
				.tt_event_theme_page h2,
				.tt_event_theme_page h3,
				.tt_event_theme_page h4,
				.tt_event_theme_page h5{
						font-family:'. $font_body_array['font-family'] .' !important;
				}
				.tt_event_theme_page.page_content{
						width: 100%;
						margin: 0;
				}
				.tt_calendar_icon{
						margin-top: 0.5em;
				}
				.tt_event_page_left .cws_img_frame .attachment-event-post-thumb{
						margin-bottom: 0;
				}
				.tt_event_theme_page h1{
						font-size: 2em;
				}
				.tt_event_theme_page h2{
						font-size: 1.5em;
				}
				.tt_event_theme_page h3{
						font-size: 1.17em;
				}
				.tt_event_theme_page h4{
						font-size: 1em;
				}
				.tt_event_theme_page h5{
						font-size: 0.83em;
				}
				.tt_event_theme_page p{
						padding: 0;
						font-size: '.$font_body_array['font-size'].';
						line-height: '.$font_body_array['line-height'].';
				}
				.widget.timetable_sidebar_box .box_header{
						font-size: 1.8em;
						line-height: 1;
				}
				.widget.timetable_sidebar_box .box_header{
						margin-bottom: 0;
						font-family:'. $font_header_array['font-family'] .' !important;
						color: '.$font_header_array['color']."!important;
				}
				.widget.timetable_sidebar_box .box_header:after {
						content: '';
						display: block;
						width: 100%;
						height: 6px;
						border-radius: 3px;
						margin-top: 8px;
			background-color:".kiddy_get_option( 'theme-menu-color' ).';
				}
				.widget.timetable_sidebar_box .textwidget,
				.widget.timetable_sidebar_box p{
						font-size: 0.947em;
				}
				.tt_upcoming_events_widget .tt_upcoming_events_wrapper{
						margin-top: 10px;
				}
				.widget.timetable_sidebar_box .box_header + .textwidget p:first-child{
						margin-top: 10px;
				}
				.tabs_box_navigation.sf-timetable-menu li:before,
				.tt_tabs_navigation li:before{
						display: none;
				}
				.tabs_box_navigation.sf-timetable-menu{
						font-size: '.$font_body_array['font-size'].' !important;
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected:hover,
				.sf-timetable-menu li:hover ul a,
				.sf-timetable-menu li.submenu:hover ul a,
				.tt_tabs_navigation li a,
				.tt_tabs_navigation li a:hover,
				.tt_tabs_navigation li a.selected,
				.tt_tabs_navigation li.ui-tabs-active a,
				.tt_responsive .tt_timetable.small .tt_items_list a,
				.tt_responsive .tt_timetable.small .tt_items_list span,
				.tt_event_theme_page p,
				.tt_event_theme_page h2,
				.tt_event_theme_page h3,
				.tt_event_theme_page h4,
				.tt_event_theme_page h5,
				.tt_responsive .tt_timetable.small .box_header,
				.tt_items_list .value{
						color: '.$font_body_array['color'].'!important;
				}
				.tt_tooltip:hover .tt_tooltip_text .tt_tooltip_content{
						box-shadow: 0px 3px 9px 1px rgba(0, 0, 0, 0.2);
				}
				.tt_timetable th,
				.tt_timetable td{
						color: '.$font_body_array['color'].';
				}
				table.tt_timetable thead th{
						color: #fff;
						background-color:'.kiddy_get_option( 'theme-custom-color' ).';
				}
				.tt_timetable .event{
						background-color:'.kiddy_get_option( 'theme-menu-color' ).';
				}
				.tt_timetable .event:hover,
				.tt_timetable .event .event_container.tt_tooltip:hover,
				.tt_tooltip .tt_tooltip_content,
				.sf-timetable-menu li:hover a,
				.sf-timetable-menu li.selected a,
				.sf-timetable-menu li.current-menu-item a,
				.sf-timetable-menu li.current-menu-ancestor a{
						background-color:'.kiddy_get_option( 'theme-menu-color-hover' ).';
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected{
						max-width: 200px;
						min-width:200px;
						box-sizing:border-box;
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected{
						padding: 7px 10px !important;
						border-radius: 4px;
						box-shadow: none;
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected:hover{
						box-shadow: none;
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected{
						border: 1px solid '.kiddy_get_option( 'theme-menu-color' ).';
				}
				.tabs_box_navigation.sf-timetable-menu .tabs_box_navigation_selected,
				.sf-timetable-menu li ul li a:hover,
				.sf-timetable-menu li ul li.selected a:hover{
						background-color: '.kiddy_get_option( 'theme-menu-color' ).';
				}
				.tt_tabs_navigation li a:hover,
				.tt_tabs_navigation li a.selected,
				.tt_tabs_navigation li.ui-tabs-active a{
						border-color: '.kiddy_get_option( 'theme-menu-color' ).' !important;
				}
				.tabs_box_navigation label{
						font-size: 0.867em !important;
						line-height: 1.385em;
				}
				.tabs_box_navigation.sf-timetable-menu li:hover ul,
				.tabs_box_navigation.sf-timetable-menu li.sfHover ul{
						top: calc(100% + 1px) !important;
						box-shadow: none;
						left: 0;
						border: none !important;
				}
				.sf-timetable-menu li ul{
						width: 200px;
						border-color: none !important;
				}
				.sf-timetable-menu li ul li{
						width:100%;
						padding: 0 !important;
				}
				.sf-timetable-menu li ul li a{
						border-left: 1px solid rgba(0, 0, 0, 0.1) !important;
						border-right: 1px solid rgba(0, 0, 0, 0.1) !important;
				}
				.sf-timetable-menu li ul li:first-child a{
						border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
						border-top-left-radius: 4px;
						border-top-right-radius: 4px;
				}
				.sf-timetable-menu li ul li:last-child a{
						border-bottom: 1px solid rgba(0, 0, 0, 0.1) !important;
						border-bottom-left-radius: 4px;
						border-bottom-right-radius: 4px;
				}
				.sf-timetable-menu li:hover ul a,
				.sf-timetable-menu li.submenu:hover ul a{
						padding: 7px 10px !important;
				}
				.sf-timetable-menu li ul li a:hover,
				.sf-timetable-menu li ul li.selected a:hover{
						border-color: transparent !important;
				}
				.sf-timetable-menu li ul li:first-child{
						padding-top:3px !important;
				}
				.tt_event_items_list li .tt_event_text{
						float: none !important;
				}
				.tt_items_list li:before{
						display:none;
				}
				.tt_event_column_left,
				.tt_event_column_right{
						width: calc(50% - 15px) !important;
				}
				.tt_event_items_list li{
						position: relative;
						padding-left: 0 !important;
						line-height: 1.5em !important;
						background: transparent !important;
						font-size: '.$font_body_array['font-size'].' !important;
						color: '.$font_body_array['color'].'!important;
						font-family:'. $font_body_array['font-family'] .' !important;
				}
				.tt_event_items_list li.type_info{
						border-bottom: 1px solid #d8d8d8;
						display: table;
						width: 100%;
				}
				.tt_event_items_list li.type_info>*{
						display: table-cell;
						float:none;
						width: 50%;
						font-size: inherit !important;
				}
				.tt_event_items_list li.type_info:before{
						display:none;
				}
				.tt_event_hours_count{
						color: inherit;
				}
				.tt_event_hours li{
						border: 1px solid #d8d8d8;
						border-left: 3px solid '.kiddy_get_option( 'theme-custom-color' ).';
						width: calc(50% - 15px);
						box-sizing: border-box;
				}
				.tt_event_hours li:before{
						display: none;
				}
				.tt_event_hours li h4{
						font-size: 1.3em;
						font-weight: 700;
						line-height: 1;
						margin-top: 0;
						margin-bottom: 5px;
				}
				.tt_event_hours li>*:not(:last-child){
						margin-bottom: 5px;
				}
				aside .tt_upcoming_events li{
						width: 100%;
				}
				aside .tt_upcoming_events li .tt_upcoming_events_event_container{
						font-size: '.$font_body_array['font-size'].';
						color: '.$font_body_array['color'].';
						font-family:'. $font_body_array['font-family'] .';
						border-left: 3px solid '.kiddy_get_option( 'theme-custom-color' ).';
						height: auto;
						border-bottom: 1px solid #d8d8d8;
						border-right: 1px solid #d8d8d8;
						border-top: 1px solid #d8d8d8;
				}
				.tt_upcoming_event_controls a{
						border: 1px solid #d8d8d8;
				}
				aside .tt_upcoming_events li .tt_upcoming_events_event_container .tt_event_hours_description{
						display: none;
				}
				aside .tt_upcoming_events li .tt_upcoming_events_event_container:hover .tt_event_hours_description{
						display: block;
						margin-top: 0;
				}
				.tt_upcoming_events li .tt_upcoming_events_event_container:hover{
						background: '.kiddy_get_option( 'theme-custom-color' ).';
						border-top: 1px solid '.kiddy_get_option( 'theme-custom-color' ).';
						border-bottom: 1px solid '.kiddy_get_option( 'theme-custom-color' ).';
						border-right: 1px solid '.kiddy_get_option( 'theme-custom-color' ).';
				}
				.timetable_sidebar_box{
						margin-top: 30px;
				}

				@media screen and (max-width: 1190px){
						.tt_event_page_right{
								width: 220px;
						}
						.tt_event_hours li{
								width: calc(50% - 10px);
								margin: 0 20px 20px 0;
						}
						.tt_event_column_left,
						.tt_event_column_right{
								width: calc(50% - 10px) !important;
						}
						.tt_event_column_left{
								margin-right: 20px !important;
						}
						.tt_responsive .tt_timetable th,
						.tt_responsive .tt_timetable .event_container,
						.tt_responsive .tt_tooltip .tt_tooltip_content {
								padding: 4px 4px 5px;
						}
				}
				@media screen and (max-width: 980px){
						.tt_event_page_right{
								width: 171px;
						}
						.tt_event_hours li{
								width: calc(50% - 10px);
								margin: 0 20px 20px 0;
						}
						.tt_event_column_left,
						.tt_event_column_right{
								width: calc(50% - 10px) !important;
						}
						.tt_event_column_left{
								margin-right: 20px !important;
						}
				}
				@media screen and (max-width: 767px){
						.tt_event_hours li{
								width: 100%;
								margin: 0 0 20px 0;
						}
						.tt_event_column_left,
						.tt_event_column_right{
								width: 100% !important;
						}
						.tt_event_column_left{
								margin-right: 20px  !important;
						}
				}';
	}
}

function kiddy_theme_color_woocommerce() {
	if ( class_exists( 'woocommerce' ) ) {
		$font_header_array = kiddy_get_option( 'header-font' );
		$font_body_array = kiddy_get_option( 'body-font' );

		echo ('.woocommerce .media_part,
					ul.product_list_widget li a img,
					.price_slider_wrapper .price_slider{
							border-color:'.kiddy_get_option( 'theme-custom-color' ).";
					}
					.gridlist-toggle a:before,
					.woocommerce div[class^='post-'] h1.product_title.entry-title,
					div.woocommerce .cart_totals h2,
					.upsells.products h2,
					.woocommerce .related.products h2,
					.cart_totals .amount,
					input[type=checkbox]:checked:before{
							color:".kiddy_get_option( 'theme-custom-color' ).';
					}
					ul.product_list_widget>li>a,
					form.checkout h3{
							color:'.$font_header_array['color'].';
					}
					.button.add_to_cart_button,
					.added_to_cart.wc-forward,
					.woocommerce-pagination .page-numbers.current:after,
					.woocommerce .button,
					.tinv-wishlist button,
					.woocommerce-page [class^="tinvwl_button"],
					.woocommerce-page .button,
					.woo_mini_cart .button,
					.woocommerce .woocommerce-tabs .tabs li,
					ul.products li .media_part .rating_cont:before,
					ul.products li .media_part .rating_cont .button-shadow,
					.price_slider .ui-slider-range,
					.woocommerce-product-search:before{
							background-color:'.kiddy_get_option( 'theme-custom-color' ).";
					}
					.woocommerce ul.products h3,
					.price,
					.added_to_cart.wc-forward,
					.woocommerce div[class^='post-'] h1.product_title.entry-title,
					.woocommerce .button,
					.tinv-wishlist button,
					.woocommerce-page .button,
					div.woocommerce .shop_table .amount,
					div.woocommerce .cart_totals h2,
					form.checkout h3,
					.upsells.products h2,
					.woocommerce .related.products h2,
					.woocommerce span.onsale,
					.woocommerce-page span.onsale,
					.product.woocommerce.add_to_cart_inline ins,
					.product.woocommerce.add_to_cart_inline del{
							font-family:". $font_header_array['font-family'] .' !important;
					}
					.price ins,
					.price .amount,
					.product.woocommerce.add_to_cart_inline ins,
					.gridlist-toggle a.active:before,
					.woocommerce-tabs #tab-reviews time,
					div.woocommerce .shop_table .amount,
					.cws-widget .product_list_widget>li .quantity>.amount,
					.cws-widget .product_list_widget>li ins>.amount,
					.cws-widget .product_list_widget>li>.amount,
					.mini-cart .product_list_widget>li .quantity>.amount,
					.mini-cart .product_list_widget>li ins>.amount,
					.mini-cart .product_list_widget>li>.amount,
					.mini-cart  .total>.amount{
							color:'.kiddy_get_option( 'theme-menu-color' ).';
					}
					.added_to_cart.wc-forward:hover,
					.woocommerce .button:hover,
					.tinv-wishlist button:hover,
					.woocommerce-page [class^="tinvwl_button"]:hover,
					.woocommerce-page .button:hover,
					.woo_mini_cart .button:hover,
					.woocommerce .woocommerce-tabs .tabs li.active,
					.price_slider .ui-slider-handle,
					.woocommerce-product-search,
					.woocommerce span.onsale,
					.woocommerce-page span.onsale,
					.woo_panel{
							background-color:'.kiddy_get_option( 'theme-menu-color' ).';
					}
					.woocommerce-tabs .comment_container img {
							border-color:'.kiddy_get_option( 'theme-menu-color' ).';
					}
					.woocommerce-pagination ul.page-numbers li a,
					.woocommerce-pagination .page-numbers.current:before{
							background-color:'.kiddy_get_option( 'theme-custom-outline-color' ).';
					}
					.woocommerce-pagination ul.page-numbers li,
					.woocommerce-pagination ul.page-numbers li a,
					.woocommerce-tabs #tab-reviews .description{
							color:'. $font_body_array['color'] .' !important;
					}');
	}
}

function kiddy_theme_color_action() {
	global $wp_filesystem;
	if( empty( $wp_filesystem ) ) {
		require_once( ABSPATH .'/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	$file = KIDDY_DIR . '/css/theme-color.css';
	$new_css = '';
	$text = '';
	if ( $wp_filesystem && $wp_filesystem->exists($file) ) {
		$text = $wp_filesystem->get_contents($file);
	}

	if(!empty($text))
	{
		$new_css = $text;

		$value_c = kiddy_get_option( 'theme-custom-color' );
		$value_f_c = kiddy_get_option( 'theme-custom-footer-color' );
		$value_s_c = kiddy_get_option( 'theme-custom-secondary-color' );
		$value_o_c = kiddy_get_option( 'theme-custom-outline-color' );
		$value_m_c = kiddy_get_option( 'theme-menu-color' );
		$value_m_c_h = kiddy_get_option( 'theme-menu-color-hover' );

		// colors
		$theme_c = isset( $value_c ) ? $value_c : KIDDY_COLOR ;
		$theme_f_c = isset( $value_f_c ) ? $value_f_c : KIDDY_FOOTER_COLOR ;
		$theme_s_c = isset( $value_s_c ) ? $value_s_c : KIDDY_SECONDARY_COLOR;
		$theme_o_c = isset( $value_o_c ) ? $value_o_c : KIDDY_OUTLINE_COLOR;
		$theme_m_c = isset( $value_m_c ) ? $value_m_c : KIDDY_MENU_COLOR;
		$theme_m_c_h = isset( $value_m_c_h ) ? $value_m_c_h : KIDDY_MENU_COLOR_HOVER;

		$replacements = array(
			'#cws_theme_color#' => $theme_c,
			'#cws_theme_footer_color#' => $theme_f_c,
			'#cws_theme_secondary_color#' => $theme_s_c,
			'#cws_theme_outline_color#' => $theme_o_c,
			'#cws_menu_color#' => $theme_m_c,
			'#cws_menu_color_hover#' => $theme_m_c_h,
		);
		foreach ( $replacements as $k => $v ) {
			$new_css = (str_replace( $k, $v, $new_css ));
		}
		echo("/* dynamic colors */ ".$new_css);
	}
}

// \THEME TIMETABLE STYLE
add_action( 'wp_head', 'kiddy_process_timetable_style' );

function kiddy_process_timetable_style() {
	echo '<style type="text/css" id="cws-custom-timetable-style">';
	echo kiddy_print_timetable_style();
	echo '</style>';
}

// \ CONTENT ELEMENT PATTERN
add_action( 'wp_head', 'kiddy_content_element_pattern' );
function kiddy_content_element_pattern() {
	echo '<style type="text/css" id="cws-content-element-pattern">';
	echo (kiddy_content_element_pattern_style());
	echo '</style>';
}

// \THEME COLOR HOOK
function kiddy_process_colors() {
	echo '<style type="text/css" id="cws-custom-colors-css">';
	echo (kiddy_print_theme_color());
	echo '</style>';
}

function kiddy_Hex2RGB( $hex ) {
	$hex = str_replace( '#', '', $hex );
	$color = '';

	if ( strlen( $hex ) == 3 ) {
		$color = hexdec( substr( $hex, 0, 1 ) ) . ',';
		$color .= hexdec( substr( $hex, 1, 1 ) ) . ',';
		$color .= hexdec( substr( $hex, 2, 1 ) );
	} else if ( strlen( $hex ) == 6 ) {
		$color = hexdec( substr( $hex, 0, 2 ) ) . ',';
		$color .= hexdec( substr( $hex, 2, 2 ) ) . ',';
		$color .= hexdec( substr( $hex, 4, 2 ) );
	}
	return $color;
}

function kiddy_Hex2RGBwithdark( $hex, $coef_color = 1 ) {
	$hex = str_replace( '#', '', $hex );
	$color = '';

	if ( strlen( $hex ) == 3 ) {
		$color = round( hexdec( substr( $hex, 0, 1 ) ) / $coef_color ) . ',';
		$color .= round( hexdec( substr( $hex, 1, 1 ) ) / $coef_color ) . ',';
		$color .= round( hexdec( substr( $hex, 2, 1 ) ) / $coef_color );
	} else if ( strlen( $hex ) == 6 ) {
		$color = round( hexdec( substr( $hex, 0, 2 ) ) / $coef_color ) . ',';
		$color .= round( hexdec( substr( $hex, 2, 2 ) ) / $coef_color ) . ',';
		$color .= round( hexdec( substr( $hex, 4, 2 ) ) / $coef_color );
	}

	return $color;
}

/******************** \CUSTOM COLOR ********************/

/************** JAVASCRIPT VARIABLES INIT **************/

function kiddy_js_vars_init() {
		$is_user_logged = is_user_logged_in();
		$stick_menu = kiddy_get_option( 'menu-stick' );
		?>
		<script type="text/javascript">
			var stick_menu = <?php echo isset( $stick_menu ) ? esc_js( $stick_menu ) : true ?>;
			var is_user_logged = <?php if($is_user_logged) {echo('true'); }else{ echo('false'); } ?>;
		</script>
		<?php
}

add_action( 'wp_enqueue_scripts', 'kiddy_js_vars_init' );

function kiddy_theme_youtube_api_init (){
	?>
	<script type="text/javascript">
		// Loads the IFrame Player API code asynchronously.
			var tag = document.createElement("script");
			tag.src = "https://www.youtube.com/player_api";
			var firstScriptTag = document.getElementsByTagName("script")[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	</script>
	<?php
}
add_action ( 'wp_enqueue_scripts', 'kiddy_theme_youtube_api_init' );

/************** \JAVASCRIPT VARIABLES INIT **************/

function kiddy_dbl_to_sngl_quotes( $content ) {
	return preg_replace( '|"|', "'", $content );
}
add_filter( 'kiddy_dbl_to_sngl_quotes', 'kiddy_dbl_to_sngl_quotes' );

function kiddy_is_woo() {
	global $woocommerce;
	return ! empty( $woocommerce ) ? is_woocommerce() || is_shop() || is_product() || is_product_tag() || is_product_category() || is_account_page() ||  is_cart() || is_checkout() : false;
}

if ( ! isset( $content_width ) ) $content_width = 1170;

function kiddy_get_sidebars( $p_id = null ) {
	/*!*/
	if ( $p_id ) {
		$post_type = get_post_type( $p_id );
		if ( in_array( $post_type, array( 'page' ) ) ) {
			$kiddy_stored_meta = get_post_meta( $p_id, KIDDY_MB_PAGE_LAYOUT_KEY );
			$sidebar1 = $sidebar2 = $sidebar_pos = $sb_block = '';
			$page_type = 'page';
			if ( isset( $kiddy_stored_meta[0] ) ) {
				$sidebar_pos = $kiddy_stored_meta[0]['sb_layout'];
				if ( $sidebar_pos == 'default' ) {
					if (  $kiddy_stored_meta[0]['is_blog'] !== '0'  ) {
						$page_type = 'blog';
					} else if ( is_front_page() ) {
						$page_type = 'home';
					}

					$sidebar_pos = kiddy_get_option( 'def-' . $page_type . '-layout' );
					$sidebar1 = kiddy_get_option( 'def-' . $page_type . '-sidebar1' );
					$sidebar2 = kiddy_get_option( 'def-' . $page_type . '-sidebar2' );

				} else {
					$sidebar1 = isset( $kiddy_stored_meta[0]['sidebar1'] ) ? $kiddy_stored_meta[0]['sidebar1'] : '';
					$sidebar2 = isset( $kiddy_stored_meta[0]['sidebar2'] ) ? $kiddy_stored_meta[0]['sidebar2'] : '';
				}
			} else {
				$page_type = 'page';
				$sidebar_pos = kiddy_get_option( 'def-' . $page_type . '-layout' );
				$sidebar1 = kiddy_get_option( 'def-' . $page_type . '-sidebar1' );
				$sidebar2 = kiddy_get_option( 'def-' . $page_type . '-sidebar2' );
			}
		} else if ( in_array( $post_type, array( 'post', 'cws_portfolio', 'cws_staff' ) ) ) {
			$sidebar_pos = kiddy_get_option( 'def-blog-layout' );
			$sidebar1 = kiddy_get_option( 'def-blog-sidebar1' );
			$sidebar2 = kiddy_get_option( 'def-blog-sidebar2' );
		}
	} else if ( is_home() ) { 										/* default home page hasn't ID */
		$sidebar_pos = kiddy_get_option( 'def-home-layout' );
		$sidebar1 = kiddy_get_option( 'def-home-sidebar1' );
		$sidebar2 = kiddy_get_option( 'def-home-sidebar2' );
	} else if ( is_category() || is_tag() || is_archive() ) {
		$sidebar_pos = kiddy_get_option( 'def-blog-layout' );
		$sidebar1 = kiddy_get_option( 'def-blog-sidebar1' );
		$sidebar2 = kiddy_get_option( 'def-blog-sidebar2' );
		if (get_post_type() == 'cws_portfolio' || get_post_type() == 'cws_staff') {
			$page_type = "page";
			$sidebar_pos = kiddy_get_option("def-" . $page_type . "-layout");
			$sidebar1 = kiddy_get_option("def-" . $page_type . "-sidebar1");
			$sidebar2= kiddy_get_option("def-" . $page_type . "-sidebar2");
		}
	} else if ( is_search() ) {
		$sidebar_pos = kiddy_get_option( 'def-page-layout' );
		$sidebar1 = kiddy_get_option( 'def-page-sidebar1' );
		$sidebar2 = kiddy_get_option( 'def-page-sidebar2' );
	}

	$ret = array();
	$ret['sb_layout'] = isset( $sidebar_pos ) ? $sidebar_pos : '';
	$ret['sidebar1'] = isset( $sidebar1 ) ? $sidebar1 : '';
	$ret['sidebar2'] = isset( $sidebar2 ) ? $sidebar2 : '';

	$sb_enabled = $ret['sb_layout'] != 'none';
	$ret['sb1_exists'] = $sb_enabled && is_active_sidebar( $ret['sidebar1'] );
	$ret['sb2_exists'] = $sb_enabled && $ret['sb_layout'] == 'both' && is_active_sidebar( $ret['sidebar2'] );

	$ret['sb_exist'] = $ret['sb1_exists'] || $ret['sb2_exists'];
	$ret['sb_layout_class'] = ( $ret['sb1_exists'] xor $ret['sb2_exists'] ) ? 'single' : ( ( $ret['sb1_exists'] && $ret['sb2_exists'] ) ? 'double' : '' );

	return $ret;
}

function kiddy_get_option( $name ) {
	$theme_options = get_option( KIDDY_SLUG );
	return isset( $theme_options[ $name ] ) ? $theme_options[ $name ] : null;
}

function kiddy_widget_title_icon_rendering( $args = array() ) {
	extract( shortcode_atts(
		array(
			'icon_color' => kiddy_get_option( 'theme-custom-color' ),
			'icon_type' => '',
			'icon_fa' => '',
			'icon_img' => array('src'=>'','id'=>''),
			'icon_img_width' => '',
			'icon_img_height' => '',
			), $args));
		$is_benefits_area_rendered = isset( $GLOBALS['benefits_area_is_rendered'] );
		$r = '';
		if ( $icon_type == 'fa' && ! empty( $icon_fa ) ) {
			$r = "<i class='fa fa-$icon_fa'></i>";
		} else if ( $icon_type == 'img' && isset( $icon_img['src'] ) && ! empty( $icon_img['src'] ) ) {
			$img_url = $icon_img['src'];
			$body_font_settings = kiddy_get_option( 'body-font' );
			$font_size = isset( $body_font_settings['font_size'] ) ? preg_replace( 'px', '', $body_font_settings['font_size'] ) : '15';

			$thumb_obj = bfi_thumb( $img_url,array( 'width' => $icon_img_width, 'height' => $icon_img_height, 'crop' => true ), false );
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
			$thumb_url = $thumb_path_hdpi;

			$r = '<img '.$thumb_url.' alt />';
		}
		return $r;
}

function kiddy_post_info( $custom_layout_arr ) {
	$show_author = kiddy_get_option( 'blog_author' );
	$author = $show_author ? esc_html( get_the_author() ) : '';
	$special_pf = kiddy_is_special_post_format();
	$comments_n = esc_html( get_comments_number() );
	$permalink = esc_url( get_permalink() );

	if ( ! (intval( $custom_layout_arr['hide_meta'] ) == 1) ) {
		?>
				<div class="post_info">
		<?php
		if ( is_single() ) {
			kiddy_post_date( $custom_layout_arr['column_style'] );
		}
		if ( ! empty( $author ) || $special_pf ) {
				echo "<div class='info'>";
					echo ! empty( $author ) ? "<i class='fa fa-user'></i> $author" : '';
					if($special_pf) {
						if ( ! empty( $author )){
							echo(KIDDY_V_SEP . kiddy_post_format_mark());
						} else {
							echo(kiddy_post_format_mark());
						}
					} 				
				echo '</div>';
		}
		if ( has_category() ) {
			echo "<div class='post_categories'><i class='fa fa-bookmark'></i>";
			esc_html( the_category( KIDDY_V_SEP ) );
			echo '</div>';
		}

		if ( has_tag() ) {
			echo "<div class='post_tags'>";
			esc_html( the_tags( "<i class='fa fa-tag'></i>", KIDDY_V_SEP, '' ) );
			echo '</div>';
		}

		if ( $comments_n != 0 ) {
			$permalink .= '#comments_part';
			echo "<div class='comments_link'><a href='$permalink'><i class='fa fa-comment'></i> $comments_n</a></div>";
		}

		?>
				</div>
		<?php
	}
}

function kiddy_post_date( $column_style = false ) {
	$date = esc_html( get_the_time( get_option( 'date_format' ) ) );

	if ( is_single() ) {
		echo("<div class='date_default'><i class='fa fa-calendar'></i> $date</div>");
	} else {
		?>

		<div class="date<?php if($column_style ){ echo(' def_style'); } ?>">
			<?php
				echo "<div class='date-cont'><span class='day'>". esc_html( get_the_time( 'j' ) ) ."</span><span class='month' title='" . esc_html( get_the_time( 'M' ) ) . "'><span>" . esc_html( get_the_time( 'M' ) ) . "</span></span><span class='year'>". esc_html( get_the_time( 'Y' ) ) ."</span><i class='springs'></i></div>";
			?>
		</div>
			<?php
	}
}

function kiddy_post_info_header_part() {
	$title_text = get_the_title();
	$title = '<a href="'. esc_url( get_the_permalink() ) .'">' . esc_html( $title_text ) . '</a>';
	if ( ! kiddy_is_special_post_format() && ! empty( $title_text ) ) {
		?>
			<div class="post_info_header">
				<?php
					echo  KIDDY_BEFORE_CE_TITLE . $title . KIDDY_AFTER_CE_TITLE;
				?>
								</div>
			<?php
	}
}

function kiddy_output_media_part( $custom_layout_arr = false ) {
	$column_style = $custom_layout_arr['column_style'];
	$custom_layout = intval( $custom_layout_arr['custom_layout'] );

	$post_url = esc_url( get_the_permalink() );
	$post_format = get_post_format( );
	$eq_thumb_height = in_array( $post_format, array( 'gallery' ) );
	$media_meta = get_post_meta( get_the_ID(), 'cws_mb_post' );
	$media_meta = isset( $media_meta[0] ) ? $media_meta[0] : array();
	$thumbnail = has_post_thumbnail( ) ? wp_get_attachment_image_src( get_post_thumbnail_id( ),'full' ) : '';
	$thumbnail = ! empty( $thumbnail ) ? $thumbnail[0] : '';
	$thumbnail_dims = kiddy_get_post_thumbnail_dims( $eq_thumb_height );
	$single = is_single();
	$title = get_the_title();

	$image_data = wp_get_attachment_metadata( get_post_thumbnail_id( get_the_ID() ) );
	if ( ! empty( $thumbnail ) ) {
		if ( $single ) {
			if ( $image_data['width'] < 1170 ) {
				$img_data['width'] = 0;
				$img_data['height'] = 0;
			} else {
				$img_data = $thumbnail_dims;
			}
		} else {
			$img_data = $thumbnail_dims;
		}
	}

	$only_link = ($post_format == 'link' && empty( $thumbnail ) ) ? ' only_link' : '';
	$quote = ('quote' === $post_format && isset( $media_meta['quote'] )) ? $media_meta['quote'] : '';
	$quote_post = ( ! empty( $quote )) ? ' quoute_post' : '';
	$video_post = ('video' === $post_format)  ? ' video_post' : '';

	$audio_post = ( 'audio' === $post_format && isset( $media_meta['audio'] ) ) ? ' audio_post' : '';

	$audio_post .= isset( $media_meta['audio'] ) ? ( is_int( strpos( $media_meta['audio'], 'https://soundcloud' ) ) ? ' soundcloud' : '') : '';
	$some_media = false;

	ob_start();
	?>
		<div class="media_part<?php echo(esc_attr($only_link));
		echo(esc_attr($quote_post));
		echo(esc_attr($video_post));
		echo(esc_attr($audio_post));?>">
			<?php
			switch ( $post_format ) {
				case 'link':
					$link = isset( $media_meta['link'] ) ? esc_url( $media_meta['link'] ) : '';
					if ( ! empty( $thumbnail ) ) {
						?>
						<div class="pic <?php echo ! empty( $link ) ? 'link_post' : ''; ?>">
							<?php
								echo ! empty( $link ) ? "<a href='$link'>" : '';
								$thumb_obj = bfi_thumb( $thumbnail,$img_data,false );
								$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
								echo ("<img " . $thumb_path_hdpi . " alt />");
								$some_media = true;
								if ( ! empty( $link ) ) {
									echo "<div class='link'><span>$link</span></div>";
								} elseif(( ($custom_layout == 1) && (intval( $custom_layout_arr['enable_lightbox'] ) == 0) ) || (($custom_layout != 1) && (isset($media_meta['enable_lightbox']) && $media_meta['enable_lightbox'] == '1')) )  {
									echo "<div class='hover-effect'></div>";
									echo "<div class='links_popup".($single ? '' : ' animate')."'>
												<div class='link_cont'>
													<div class='link'>
														<a class='fancy' href='$thumbnail'><i class='fa fa-camera'></i></a>
													".($single ? '' : '<div class="link-item-bounce"></div>').'
												</div>
													'.($single ? '' : '<div class="link">
													<a href="'.$post_url.'"><i class="fa fa-share"></i></a>
													<div class="link-item-bounce"></div></div>').'
												</div>
												'.($single ? '' : '<div class="link-toggle-button"><i class="fa fa-plus link-toggle-icon"></i>
											</div>').'</div>';
								}
								echo ! empty( $link ) ? '</a>' : '';
								?>
						</div>
								<?php
								$some_media = true;
					} else {
						if ( ! empty( $link ) ) {
							echo "<div class='link'><a href='$link'>$link</a></div>";
							$some_media = true;
						}
					}
					break;
				case 'video':
					$video = isset( $media_meta['video'] ) ? $media_meta['video'] : '';
					if ( ! empty( $video ) ) {
						$video_dims = kiddy_get_post_thumbnail_dims( false );
						echo "<div class='video'>" . apply_filters( 'the_content',"[embed width='" . $video_dims['width'] . "']" . $video . '[/embed]' ) . '</div>';
						$some_media = true;
					}
					break;
				case 'audio':
					$audio = isset( $media_meta['audio'] ) ? $media_meta['audio'] : '';
					$is_sounfcloud = is_int( strpos( (string) $audio, 'https://soundcloud' ) );

					if ( $is_sounfcloud == false ) {
						if ( ! empty( $thumbnail ) ) {
							$thumb_obj = bfi_thumb( $thumbnail,$img_data,false );
							$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
							echo "<div class='pic'><img ". $thumb_path_hdpi .' alt /></div>';
							$some_media = true;
						}
						if ( ! empty( $audio ) ) {
							echo "<div class='audio'>" . apply_filters( 'the_content','[audio src="' . esc_url( $audio ) . '"]' ) . '</div>';
							$some_media = true;
						}
					} else {
						echo apply_filters( 'the_content',"$audio" );
						$some_media = true;
					}

					break;
				case 'quote':
					$quote = isset( $media_meta['quote'] ) ? $media_meta['quote']['quote'] : '';
					$author = isset( $media_meta['quote']['author'] ) ? $media_meta['quote']['author'] : '';
					if ( ! empty( $quote ) ) {
						echo kiddy_testimonial_renderer( $thumbnail, $quote, $author );
						$some_media = true;
					}
					break;
				case 'gallery':
					$gallery = isset( $media_meta['gallery'] ) ? $media_meta['gallery'] : '';
					if ( ! empty( $gallery ) ) {
						$match = preg_match_all( '/\d+/',$gallery,$images );
						if ( $match ) {
							$images = $images[0];
							$image_srcs = array();
							foreach ( $images as $image ) {
								$image_src = wp_get_attachment_image_src( $image,'full' );
								$image_url = $image_src[0];
								array_push( $image_srcs, $image_url );

							}
							$some_media = count( $image_srcs ) > 0 ? true : false;
							$carousel = count( $image_srcs ) > 1 ? true : false;
							$gallery_id = esc_attr( uniqid( 'cws-gallery-' ) );
									if ($carousel) {
										wp_enqueue_script ('owl_carousel');
										wp_enqueue_script ('isotope');
									}
							if($carousel){
								echo "<a class='carousel_nav prev'><span></span></a><a class='carousel_nav next'><span></span></a><div class='gallery_post_carousel'>";	
							}
							foreach ( $image_srcs as $image_src ) {

									$thumb_obj = bfi_thumb( $image_src,$thumbnail_dims,false );
									$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";

								?>
								<div class='pic'>
									<?php echo ("<img " .$thumb_path_hdpi."alt />");
									if (( ($custom_layout == 1) && (intval( $custom_layout_arr['enable_lightbox'] ) == 0) ) || (($custom_layout != 1) && (isset($media_meta['enable_lightbox'])) && $media_meta['enable_lightbox'] == '1'))  {
										?>
											<div class="hover-effect"></div>
											<div class='links_popup'>
												<div class='link_cont'>
													<div class='link'>
														<a href="<?php echo esc_url( $image_src ); ?>" <?php if($carousel) echo " data-fancybox-group='$gallery_id'"; ?> class="<?php if($carousel) { echo 'fancy fancy_gallery'; } else { echo 'fancy'; } ?>" <?php if($carousel) { echo "data-thumbnail='" . esc_attr( bfi_thumb( $image_src, array( 'width' => 50, 'height' => 50, 'crop' => true ) ) ) . "'";} ?>><i class="<?php if($carousel){ echo 'fa fa-camera'; } else { echo 'fa fa-camera';} ?>"></i></a>
													</div>
												</div>
											</div>
									<?php } ?>
								</div>
							<?php
							}
							if($carousel){
								echo  '</div>';
							}
						}
					}
					break;
			}
			if ( ! $some_media && ! empty( $thumbnail ) ) {
				$thumb_obj = bfi_thumb( $thumbnail,$img_data,false );
				$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";

				if (( ($custom_layout == 1) && (intval( $custom_layout_arr['enable_lightbox'] ) == 1) ) || (($custom_layout != 1) && (isset($media_meta['enable_lightbox'])) && $media_meta['enable_lightbox'] == '0')) {
					echo "<div class='pic'><img ". $thumb_path_hdpi .' alt /></div>';
				} else {
					echo "<div class='pic'><img ". $thumb_path_hdpi ." alt />
								<div class='hover-effect'></div>
								<div class='links_popup".($single ? '' : ' animate')."'>
									<div class='link_cont'>
										<div class='link'>
											<a class='fancy' href='$thumbnail'><i class='fa fa-camera'></i></a>
					".($single ? '' : '<div class="link-item-bounce"></div>').'
						</div>
						'.($single ? '' : '<div class="link">
					<a href="'.$post_url.'"><i class="fa fa-share"></i></a>
						<div class="link-item-bounce"></div>
				</div>').'
			</div>
				'.($single ? '' : '<div class="link-toggle-button">
				<i class="fa fa-plus link-toggle-icon"></i>
			</div>').'</div></div>';
				}
				$some_media = true;
			}
				?>
			</div>
			<?php
			?>
			<?php
				$is_media = $some_media ? '' : ' no_media';
				$comments_n = get_comments_number();
				$permalink = get_permalink();

				$media_cont = '';

				$some_media ? $media_cont = ob_get_clean() : ob_end_clean();

			if ( $some_media ) {
				if ( ! $column_style && ! empty( $title ) && ! kiddy_is_special_post_format() && ! $single ) {
					echo "<div class='post_header_def_post'>";
					kiddy_post_date( $column_style );
					kiddy_post_info_header_part();
					echo '</div>';
				}

				echo "<div class='media_info_wrapper'>". $media_cont .'</div>';

			} else {
				if ( ! $column_style && ! empty( $title ) && ! kiddy_is_special_post_format() && ! $single ) {
					echo "<div class='post_header_def_post'>";
					kiddy_post_date( $column_style );
					kiddy_post_info_header_part();
					echo '</div>';
				}
			}
				?>
		<?php
}

function kiddy_get_post_thumbnail_dims( $eq_thumb_height = false ) {
	$p_id = get_queried_object_id();
	if ( is_page() ) {
		$blogtype = kiddy_get_page_meta_var( array( 'blog', 'blogtype' ) );
	} else {
		$blogtype = kiddy_get_option( 'def_blogtype' );
	}

	if ($blogtype == 'default') {
		$blogtype = kiddy_get_option( 'def_blogtype' );
	}

	$sb = kiddy_get_sidebars( $p_id );
	$sb_block = isset( $sb['sb_layout'] ) ? $sb['sb_layout'] : 'none';
	$single = is_single();
	$width_correction = 22;
	$height_correction = 22;
	$dims = array( 'width' => 0, 'height' => 0 );
	$dims['crop'] = true;
	if ( $single ) {
		if ( $sb_block == 'none' ) {
			$dims['width'] = 1170;
		} else if ( in_array( $sb_block, array( 'left', 'right' ) ) ) {
			$dims['width'] = 870;
		} else if ( $sb_block == 'both' ) {
			$dims['width'] = 570;
		}
	} else {
		switch ( $blogtype ) {
			case 'large':
				if ( $sb_block == 'none' ) {
					$dims['width'] = 1170;
				} else if ( in_array( $sb_block, array( 'left', 'right' ) ) ) {
					$dims['width'] = 870;
				} else if ( $sb_block == 'both' ) {
					$dims['width'] = 570;
				}
				break;
			case 'medium':
				$dims['width'] = 570;
				break;
			case 'small':
				$dims['width'] = 370;
				break;
			case '2':
				if ( $sb_block == 'none' ) {
					$dims['width'] = 570;
				} else if ( in_array( $sb_block, array( 'left', 'right' ) ) ) {
					$dims['width'] = 420;

				} else if ( $sb_block == 'both' ) {
					$dims['width'] = 270;

				}
				break;
			case '3':
				if ( $sb_block == 'none' ) {
					$dims['width'] = 370;

				} else if ( in_array( $sb_block, array( 'left', 'right' ) ) ) {
					$dims['width'] = 270;

				} else if ( $sb_block == 'both' ) {
					$dims['width'] = 270;

				}
				break;
		}
	}
	$dims['width'] = $dims['width'] != 0 ? $dims['width'] - $width_correction : $dims['width'];

	return $dims;
}

function kiddy_page_meta_vars() {
	if ( is_page() ) {
		$pid = get_query_var( 'page_id' );
		$pid = ! empty( $pid ) ? $pid : get_queried_object_id();
		$post = get_post( $pid );
		$kiddy_stored_meta = get_post_meta( $pid, KIDDY_MB_PAGE_LAYOUT_KEY );
		$kiddy_stored_meta = isset( $kiddy_stored_meta[0] ) ? $kiddy_stored_meta[0] : array();
		$GLOBALS['kiddy_page_meta'] = array();
		$GLOBALS['kiddy_page_meta']['sb'] = kiddy_get_sidebars( $pid );
		$GLOBALS['kiddy_page_meta']['is_blog'] = isset( $kiddy_stored_meta['is_blog'] ) && $kiddy_stored_meta['is_blog'] !== '0' ? true : ( is_home() ? true : false );
		$GLOBALS['kiddy_page_meta']['blog'] = array(
		'blogtype' => isset( $kiddy_stored_meta['blogtype'] ) ? $kiddy_stored_meta['blogtype'] : 'large',
			'cats' => isset( $kiddy_stored_meta['category'] ) ? implode( $kiddy_stored_meta['category'], ',' ) : ( is_home() ? kiddy_get_option( 'def-home-category' ) : '' ),
		);
		$GLOBALS['kiddy_page_meta']['footer'] = array( 'footer_sb_top' => '', 'footer_sb_bottom' => '' );
		if ( ( ! is_404()) && ( ! empty( $post )) ) {
			if ( isset( $kiddy_stored_meta['sb_foot_override'] ) && $kiddy_stored_meta['sb_foot_override'] !== '0' ) {
				$GLOBALS['kiddy_page_meta']['footer']['footer_sb_top'] = isset( $kiddy_stored_meta['footer-sidebar-top'] ) ? $kiddy_stored_meta['footer-sidebar-top'] : '';
			} else {
				$GLOBALS['kiddy_page_meta']['footer']['footer_sb_top'] = kiddy_get_option( 'footer-sidebar-top' );
			}
		} else {
			$GLOBALS['kiddy_page_meta']['footer']['footer_sb_top'] = kiddy_get_option( 'footer-sidebar-top' );
		}
		$GLOBALS['kiddy_page_meta']['benefits'] = array( 'benefits_sb' => '' );
		if ( ( ! is_404()) && ( ! empty( $post )) ) {
			if ( isset( $kiddy_stored_meta['sb_benefits_override'] ) && $kiddy_stored_meta['sb_benefits_override'] !== '0' ) {
				$GLOBALS['kiddy_page_meta']['benefits']['benefits_sb'] = $kiddy_stored_meta['benefits-sidebar'] !== '0' ? $kiddy_stored_meta['benefits-sidebar'] : '';
			}
		}
		$GLOBALS['kiddy_page_meta']['slider'] = array( 'slider_override' => '', 'slider_shortcode' => '' );
		$GLOBALS['kiddy_page_meta']['slider']['slider_override'] = isset( $kiddy_stored_meta['sb_slider_override'] ) && $kiddy_stored_meta['sb_slider_override'] !== '0' ? $kiddy_stored_meta['sb_slider_override'] : false;
		$GLOBALS['kiddy_page_meta']['slider']['slider_options'] = isset( $kiddy_stored_meta['slider_shortcode'] ) ? $kiddy_stored_meta['slider_shortcode'] : '';
		return true;
	} else {
		return false;
	}
}

add_action( 'wp', 'kiddy_page_meta_vars' );

function kiddy_get_page_meta_var( $keys = array() ) {
	$p_meta = array();
	if ( isset( $GLOBALS['kiddy_page_meta'] ) ) {
		$p_meta = $GLOBALS['kiddy_page_meta'];
	} else {
		return false;
	}
	if ( is_string( $keys ) && ! empty( $keys ) ) {
		if ( isset( $p_meta[ $keys ] ) ) {
			return  $p_meta[ $keys ];
		} else {
			return false;
		}
	} else if ( is_array( $keys ) && ! empty( $keys ) ) {
		for ( $i = 0; $i < count( $keys ); $i++ ) {
			if ( isset( $p_meta[ $keys[ $i ] ] ) ) {
				if ( $i < count( $keys ) - 1 ) {
					if ( is_array( $p_meta[ $keys[ $i ] ] ) ) {
						$p_meta = $p_meta[ $keys[ $i ] ];
					} else {
						return false;
					}
				} else {
					return $p_meta[ $keys[ $i ] ];
				}
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}

function kiddy_set_page_meta_var( $keys = array(), $value = '' ) {
	$p_meta = array();
	if ( isset( $GLOBALS['kiddy_page_meta'] ) ) {
		$p_meta = &$GLOBALS['kiddy_page_meta'];
	} else {
		return false;
	}
	if ( is_string( $keys ) && ! empty( $keys ) ) {
		if ( isset( $p_meta[ $keys ] ) ) {
			$p_meta[ $keys ] = $value;
			return true;
		} else {
			return false;
		}
	} else if ( is_array( $keys ) && ! empty( $keys ) ) {
		for ( $i = 0; $i < count( $keys ); $i++ ) {
			if ( isset( $p_meta[ $keys[ $i ] ] ) ) {
				if ( $i < count( $keys ) - 1 ) {
					if ( is_array( $p_meta[ $keys[ $i ] ] ) ) {
						$p_meta = &$p_meta[ $keys[ $i ] ];
					} else {
						return false;
					}
				} else {
					$p_meta[ $keys[ $i ] ] = $value;
					return true;
				}
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}

function kiddy_blog_output( $query = false ) {
	$test = $query;

	$custom_layout_arr = array(
		'this_shortcode' => isset( $query->query_vars['this_shortcode'] ) ? $query->query_vars['this_shortcode'] : false,
		'column_style' => isset( $query->query_vars['column_style'] ) ? $query->query_vars['column_style'] : false,
		'custom_layout' => isset( $query->query_vars['custom_layout'] ) ? $query->query_vars['custom_layout'] : 0,
		'post_text_length' => ! empty( $query->query_vars['post_text_length'] ) ? $query->query_vars['post_text_length'] : '',
		'button_name' => ! empty( $query->query_vars['button_name'] ) ? $query->query_vars['button_name'] : '',
		'enable_lightbox' => isset( $query->query_vars['enable_lightbox'] ) ? $query->query_vars['enable_lightbox'] : '',
		'hide_meta' => isset( $query->query_vars['hide_meta'] ) ? $query->query_vars['hide_meta'] : '',
		'column_count' => isset( $query->query_vars['column_count'] ) ? intval( $query->query_vars['column_count'] ) : 3,
	);
	global $wp_query;
	$query = $query ? $query : $wp_query;
	$use_wave_separate = kiddy_get_option( 'wave-style' ) == 1 ? true : false ;
	$separator = $use_wave_separate ? "<canvas class='separator' width='1170' data-line-color='" . esc_attr( kiddy_get_option( 'theme-custom-outline-color' ) ) . "'></canvas>" : "<hr class='separator'>";
	if ( is_page() ) {
		$blogtype = kiddy_get_page_meta_var( array( 'blog', 'blogtype' ) );
	} else {
		$blogtype = kiddy_get_option( 'def_blogtype' );
	}

	if ($blogtype == 'default') {
		$blogtype = kiddy_get_option( 'def_blogtype' );
	}

	if ( $query->have_posts() ) :
		ob_start();
		while ( $query->have_posts() ) :
			$query->the_post();
			echo ("<article id='post-".get_the_ID()."' ");
			post_class(array('item', $blogtype));
			echo ">";
			kiddy_post_output( $custom_layout_arr );
			echo "<div class='separator-box'>$separator</div></article>";
			endwhile;
		wp_reset_postdata();
		ob_end_flush();
		endif;
}

function kiddy_load_more( $paged = 0, $template = '', $max_paged = PHP_INT_MAX ) {
	?>
		<a class="cws_button large cws_load_more" href="#" data-paged="<?php echo esc_attr( $paged ); ?>" data-max-paged="<?php echo esc_attr( $max_paged ); ?>" data-template="<?php echo esc_attr( $template ); ?>"><?php esc_html_e( 'Load More', 'kiddy' ); ?></a>
		<?php
}

function kiddy_ajax_redirect() {
	$ajax = isset( $_POST['ajax'] ) ? (bool) $_POST['ajax'] : false;
	if ( $ajax ) {
		$template = isset( $_POST['template'] ) ? $_POST['template'] : '';
		if ( ! empty( $template ) ) {
			if ( strpos( $template, '-' ) ) {
				$template_parts = explode( '-', $template );
				if ( count( $template_parts ) == 2 ) {
					get_template_part( $template_parts[0], $template_parts[1] );
				} else {
					return;
				}
			} else {
				get_template_part( $template );
			}
			exit();
		} else {
			return;
		}
	} else {
		return;
	}
}

add_action( 'template_redirect', 'kiddy_ajax_redirect' );


function kiddy_pagination( $paged = 1, $max_paged = 1 ) {
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts	= explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = $GLOBALS['wp_rewrite']->using_permalinks() ? trailingslashit( $pagenum_link ) . '%_%' : trailingslashit( $pagenum_link ) . '?%_%';
	if ( ! empty( $query_args['s'] ) ) {
		$query_args['s'] = str_replace( ' ', '+', $query_args['s'] );
	}
	$pagenum_link = add_query_arg( $query_args, $pagenum_link );

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : 'paged=%#%';
	?>
	<div class='pagination'>
		<div class='page_links'>
		<?php
		$pagination_args = array(
		'base' => $pagenum_link,
									'format' => $format,
									'current' => $paged,
									'total' => $max_paged,
									'prev_text' => "<i class='fa fa-angle-left'></i>",
									'next_text' => "<i class='fa fa-angle-right'></i>",
									'link_before' => '',
									'link_after' => '',
									'before' => '',
									'after' => '',
									'mid_size' => 2,
									);
		echo (paginate_links( $pagination_args ));
		?>
		</div>
				</div>
		<?php
}

function kiddy_page_links() {
	$args = array(
	 'before'		   => '',
	'after'			=> '',
	'link_before'	  => '<span>',
	'link_after'	   => '</span>',
	'next_or_number'   => 'number',
	'nextpagelink'	 => esc_html__( 'Next Page', 'kiddy' ),
	'previouspagelink' => esc_html__( 'Previous Page', 'kiddy' ),
	'pagelink'		 => '%',
	'echo'			 => 0,
	);
	$pagination = wp_link_pages( $args );
	echo ! empty( $pagination ) ? "<div class='pagination'><div class='page_links'>$pagination</div></div>" : '';
}

function kiddy_post_output( $custom_layout_arr = false ) {
	?>
		<?php
			kiddy_output_media_part( $custom_layout_arr );
			kiddy_post_content_output( $custom_layout_arr );
			kiddy_page_links();
		?>
		<?php
}

function kiddy_custom_excerpt_length( $length ) {
	return 1400;
}
add_filter( 'excerpt_length', 'kiddy_custom_excerpt_length', 999 );


function kiddy_post_content_output( $custom_layout_arr = false ) {
	global $post;
	global $more;
	$more = 0;
	$content = '';
	$chars_count = kiddy_blog_get_chars_count( $custom_layout_arr['column_count'] );

	$button_word = '';

	$char_length = intval( $custom_layout_arr['post_text_length'] ) !== 0 ? intval( $custom_layout_arr['post_text_length'] ) : $chars_count;
	$button_add = false;
	if ( is_single() ) {
		$content .= $post->post_content;
	} else {
		if ( ! empty( $post->post_excerpt ) ) {
			$content .= $post->post_excerpt;
		} else {
			$button_word = esc_html__( 'Read More', 'kiddy' );
			$pos = strpos( (string) $post->post_content, '<!--more-->' );
			if ( $pos ) {
				$button_add = true;
			}
			$content .= get_the_content( '[...]' );
		}
	}
	if ( $custom_layout_arr['this_shortcode'] ) {
		$content = ! empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
		$content = trim( preg_replace( '/[\s]{2,}/u', ' ', strip_shortcodes( strip_tags( $content ) ) ) );
		$content = wptexturize( $content );
		$content_length = strlen( $content );
		if ( $content_length > $char_length ) {
			$button_add = false;
			$content = mb_substr( $content, 0, $char_length );
			if ( strlen( $custom_layout_arr['button_name'] ) !== 0 && $custom_layout_arr['custom_layout'] == 1 ) {
				$button_add = true;
				$button_word = esc_html( $custom_layout_arr['button_name'] );
			} else if ( $custom_layout_arr['custom_layout'] == 0 ) {
				$button_add = true;
				$button_word = esc_html__( 'Read More', 'kiddy' );
			}
			$content .= "<a class='p_cut' href='".esc_url( get_the_permalink() )."'>[...]</a>";
		}
	}

	if ( $custom_layout_arr['column_style'] ) {
		kiddy_post_date( $custom_layout_arr['column_style'] );
		kiddy_post_info_header_part();
		if( ! empty( $content ) ) {
			echo "<div class='post_content'>" . apply_filters( 'the_content', $content ) . '</div>';	
		}
		kiddy_post_info( $custom_layout_arr );
		if ( $button_add ) {
			echo "<div class='button_cont'><a href='".esc_url( get_the_permalink() )."' class='cws_button small'>" . $button_word . '</a></div>';
		}
	} else {
		echo "<div class='post_content_wrap'>";
			if( ! empty( $content ) ){
				echo "<div class='post_content'>" . apply_filters( 'the_content', $content ) . '</div>';	
			}

			echo "<div class='meta_cont_wrapper'><div class='meta_cont'>";
			kiddy_post_info( $custom_layout_arr );
		if ( $button_add ) {
			echo "<div class='button_cont'><a href='".esc_url( get_the_permalink() )."' class='cws_button small'>" . $button_word . '</a></div>';
		}
			echo '</div></div>';
			echo '</div>';
	}
}

function kiddy_blog_get_chars_count( $cols = null, $p_id = null ) {
	$number = 155;
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	$sb = kiddy_get_sidebars( $p_id );
	$sb_layout = isset( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] : '';
	switch ( $cols ) {
		case '1':
			switch ( $sb_layout ) {
				case 'double':
					$number = 130;
					break;
				case 'single':
					$number = 200;
					break;
				default:
					$number = 300;
			}
			break;
		case '2':
			switch ( $sb_layout ) {
				case 'double':
					$number = 55;
					break;
				case 'single':
					$number = 90;
					break;
				default:
					$number = 130;
			}
			break;
		case '3':
			switch ( $sb_layout ) {
				case 'double':
					$number = 60;
					break;
				case 'single':
					$number = 60;
					break;
				default:
					$number = 70;
			}
			break;
		case '4':
			switch ( $sb_layout ) {
				case 'double':
					$number = 55;
					break;
				case 'single':
					$number = 55;
					break;
				default:
					$number = 55;
			}
			break;
	}
	return $number;
}


/****************** WALKER *********************/

class kiddy_Walker_Nav_Menu extends Walker {
	private $elements;
	private $elements_counter = 0;
	private $logo_in_menu_number;
	private $logo_position;

	function __construct() {
		$this->logo_in_menu_number = kiddy_get_option( 'logo_number_item' );
		$this->logo_position = kiddy_get_option( 'logo-position' );
	}

	function walk( $items, $depth, ...$args ) {
		$this->elements = $this->get_number_of_root_elements( $items );
		return parent::walk( $items, $depth );
	}

	/**
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );


	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<span class='button_open'></span><ul class=\"sub-menu\">";
		$output .= '<li class="menu-item back"><a href="#"><em>←</em>&nbsp;' . esc_html__( "BACK", "kiddy" ) . '</a></li>';
		$output .= "\n";
	}
	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param int    $current_page Menu item ID.
	 * @param object $args
	 */
	function logo_ini( $indent, $item ) {
		$logo_position = kiddy_get_option( 'logo-position' );
		$logo_option = kiddy_get_option('logo_option');
		$logo_is_high_dpi = $logo_option['logo_is_high_dpi'];
		$logo = kiddy_get_option( 'logo' );


		if ( $logo_position == 'in-menu' ) {

			if ( isset( $logo['url'] ) && ( ! empty( $logo['url'] ) ) ) {
				$logo_border = $logo_option['logo-with-border'] > 0 ? ' with_border' : '';
				$logo_hw = kiddy_get_option( 'logo-dimensions' );
				$logo_m = kiddy_get_option( 'logo-margin' );
				$bfi_args = array();
				if ( is_array( $logo_hw ) ) {
					foreach ( $logo_hw as $key => $value ) {
						if ( ! empty( $value ) ) {
							$bfi_args[ $key ] = $value;
							$bfi_args['crop'] = true;
						}
					}
				}
				$logo_lr_spacing = '';
				$logo_tb_spacing = '';
				if ( is_array( $logo_m ) ) {
					$logo_lr_spacing .= ( ! empty( $logo_m['margin-left'] ) ? 'margin-left:' . $logo_m['margin-left'] . 'px;' : '' ) .
						( ! empty( $logo_m['margin-right'] ) ? 'margin-right:' . $logo_m['margin-right'] . 'px;' : '' );
					$logo_tb_spacing .= ( ! empty( $logo_m['margin-top'] ) ? 'padding-top:' . $logo_m['margin-top'] . 'px;' : '' ) .
						( ! empty( $logo_m['margin-bottom'] ) ? 'padding-bottom:' . $logo_m['margin-bottom'] . 'px;' : '' );
				}
				$logo_src = '';

				if ( isset( $logo['url'] ) && ( ! empty( $logo['url'] ) ) ) {
					if ( empty( $bfi_args ) ) {
						if ( $logo_is_high_dpi ) {
							$thumb_obj = bfi_thumb( $logo['url'],array( 'width' => floor( (int) $logo['width'] / 2 ), 'crop' => true ),false );
							$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
							$logo_src = $thumb_path_hdpi;
						} else {
							$logo_src = " src='" . esc_url( $logo['url'] ) . "' data-no-retina";
						}
					} else {
						$thumb_obj = bfi_thumb( $logo['url'],$bfi_args,false );
						$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
						$logo_src = $thumb_path_hdpi;
					}
				}
			}

			$logo_sticky = kiddy_get_option( 'logo_sticky' );
			$logo_sticky_src = '';
			$logo_sticky_is_high_dpi = kiddy_get_option( 'logo_sticky_is_high_dpi' );
			if ( isset( $logo_sticky['url'] ) && ( ! empty( $logo_sticky['url'] ) ) ) {
				$logo_sticky_src = '';
				if ( $logo_sticky_is_high_dpi ) {
					$thumb_obj = bfi_thumb( $logo_sticky['url'],array( 'width' => floor( (int) $logo_sticky['width'] / 2 ), 'crop' => true ),false );
					$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
					$logo_sticky_src = $thumb_path_hdpi;
				} else {
					$logo_sticky_src = ' src="' . esc_url( $logo_sticky['url'] ) . '" data-no-retina';
				}
			}

			$logo_mobile = kiddy_get_option( 'logo_mobile' );
			$logo_mobile_src = '';
			$logo_mobile_is_high_dpi = kiddy_get_option( 'logo_mobile_is_high_dpi' );
			if ( isset( $logo_mobile['url'] ) && ( ! empty( $logo_mobile['url'] ) ) ) {
				if ( $logo_mobile_is_high_dpi ) {
					$thumb_obj = bfi_thumb( $logo_mobile['url'],array( 'width' => floor( (int) $logo_mobile['width'] / 2 ), 'crop' => true ),false );
					$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
					$logo_mobile_src = $thumb_path_hdpi;
				} else {
					$logo_mobile_src = " src='" . esc_url( $logo_mobile['url'] ) . "' data-no-retina";
				}
			}

			$rety = esc_url( home_url() );
			$img_mrg = ! empty( $logo_lr_spacing ) ? "style='".esc_attr( $logo_lr_spacing )."'" : '';
		}
		if ( $indent == 0 && $logo_position == 'in-menu' && ! empty( $logo['url'] ) && $logo_position == 'in-menu' ) {
			$logo_cont = '<div class="header_logo_part'. $logo_border .'" role="banner">
							<a class="logo" href="'.$rety.'">'.($logo_sticky_src ?  '<img '.$logo_sticky_src." class='logo_sticky' alt />" : '').($logo_mobile_src ?  '<img '.$logo_mobile_src." class='logo_mobile' alt />" : '').'<img '. $logo_src .' '.$img_mrg.' alt /></a>
						</div>';
		} else {
			$logo_cont = '';
		};
		return $logo_cont;
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . sanitize_html_class( $item->ID );

		if ( $item->menu_item_parent == '0' ) {

			$this->elements_counter += 1;
			if ( $this->elements_counter > $this->elements / 2 ) {
				array_push( $classes,'right' );
			}
		}

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. sanitize_html_class( $item->ID ), $item, $args );
		$id = $id ? ' id="' . $id . '"' : '';

		// logo in cont init;
		if ( $item->menu_item_parent == '0' && $this->elements_counter == $this->logo_in_menu_number ) {
			$logo_container = $this->logo_ini( $indent, $item );
		} else {
			$logo_container = '';
		}

		// bees init
		$bees = '';
		$bees_class = '';

		if ( $item->menu_item_parent == '0' && kiddy_get_option('menu-with-bees') == 1 ) {
			if ( (1 != $this->logo_in_menu_number && $this->elements_counter == 1) || ($this->logo_position !== 'in-menu' && $this->elements_counter == 1) ) {
				$bees = '<div class="bees bees-start"><span></span><div class="line-one"></div><div class="line-two"></div></div>';
				$bees_class = ' bees-start';
			} elseif ( ($this->elements_counter == $this->elements && $this->elements >= $this->logo_in_menu_number) || ($this->logo_position !== 'in-menu' && $this->elements_counter == $this->elements) ) {
				$bees = '<div class="bees bees-end"><span></span><div class="line-one"></div><div class="line-two"></div></div>';
				$bees_class = ' bees-end';
			} else {
				$bees = '';
				$bees_class = '';
			}
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . $class_names . $bees_class . '"' : $bees_class;

		$output .= $indent . $logo_container .'<li' . $id . $value . $class_names . '>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']	= ! empty( $item->xfn )	? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? $value : $value;
				//$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = ! empty( $args->before ) ? $args->before : '';
		$item_output .= '<a'. $attributes .'>' . $bees . '';

		$item_output .= ( ! empty( $args->link_before ) ? $args->link_before : '' ) . apply_filters( 'the_title', $item->title, $item->ID ) . ( ! empty( $args->link_after ) ? $args->link_after : '' );
		$item_output .= $item->menu_item_parent == '0' ? '<div class="canvas_wrapper"><canvas class="menu_dashed" width="500"></canvas></div></a>' : '</a>';
		$item_output .= ( ! empty( $args->after ) ? $args->after : '' );

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int    $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$logo_container = '';
		if ( $item->menu_item_parent == '0' && $this->elements < $this->logo_in_menu_number && $this->elements == $this->elements_counter ) {
			$logo_container = $this->logo_ini( $indent, $item );
		}
		$output .= "</li>\n".$logo_container;
	}
}

function kiddy_testimonial_renderer( $thumbnail, $text, $author, $text_color = false, $custom_bg_color = false, $custom_pattern_url = false ) {
	$custom_style = '';
	if ( ! empty( $custom_bg_color ) || ! empty( $text_color ) || ! empty( $custom_pattern_url ) ) {
		$custom_style = 'style="';
		$custom_style .= ! empty( $custom_bg_color ) ? 'background-color:'.esc_attr( $custom_bg_color ).';' : '';
		$custom_style .= ! empty( $text_color ) ? 'color:'.esc_attr( $text_color ).';' : '';
		$custom_style .= ! empty( $custom_pattern_url ) ? 'background-image:url('.esc_url( $custom_pattern_url ).');' : '';
		$custom_style .= '"';
	}
	ob_start();
	$author_section = '';
	if ( ! empty( $thumbnail ) || ! empty( $author ) ) {
		$author_section .= "<figure class='author'><div class='dott'><span>.</span><span>.</span><span>.</span></div>";
			$thumb_obj = bfi_thumb( $thumbnail,array( 'width' => 64, 'height' => 64, 'crop' => true ),false );
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
			$author_section .= ! empty( $thumbnail ) ? '<img ' . $thumb_path_hdpi . ' alt />' : '';
			$author_section .= ! empty( $author ) ? '<figcaption>' . $author . '</figcaption>' : '';
		$author_section .= '</figure>';
	}
	$quote_section = ! empty( $text ) ? '<div class="quote">'.$text.'</div>' : '';

	echo('<div class="testimonial clearfix ' .( sanitize_html_class( $thumbnail ) ? '' : 'without_image'). '" ' . $custom_style .'>' . $quote_section . $author_section . '</div>');		
	return ob_get_clean();
}

function kiddy_get_grid_shortcodes() {
	return array( 'cws-row', 'col', 'cws-widget' );
}

function kiddy_get_special_post_formats() {
	return array( 'aside', 'link', 'quote' );
}

function kiddy_is_special_post_format() {
	global $post;
	$sp_post_formats = kiddy_get_special_post_formats();
	if ( isset( $post ) ) {
		return in_array( get_post_format(), $sp_post_formats );
	} else {
		return false;
	}
}

function kiddy_post_format_mark() {
	global $post;
	$out = '';
	if ( isset( $post ) ) {
		$pf = get_post_format();
		$icon = 'book';
		switch ( $pf ) {
			case 'aside':
				$icon = 'bullseye';
				break;
			case 'gallery':
				$icon = 'bullseye';
				break;
			case 'link':
				$icon = 'chain';
				break;
			case 'image':
				$icon = 'image';
				break;
			case 'quote':
				$icon = 'quote-left';
				break;
			case 'status':
				$icon = 'flag';
				break;
			case 'video':
				$icon = 'video-camera';
				break;
			case 'audio':
				$icon = 'music';
				break;
			case 'chat':
				$icon = 'wechat';
				break;
		}
		$out = "<i class='fa fa-$icon'></i> $pf";
	}
	return $out;
}

// Check if WooCommerce is active
if(class_exists( 'woocommerce' )){
	require_once( KIDDY_DIR . '/woocommerce/wooinit.php' ); // WooCommerce Shop ini file
}

// Check if WPML is active
if ( function_exists('wpml_init_language_switcher') ) {
	define( 'KIDDY_WPML_ACTIVE', true );
	$GLOBALS['wpml_settings'] = get_option( 'icl_sitepress_settings' );
	global $icl_language_switcher;
}

function kiddy_is_wpml_active() {
	return defined( 'KIDDY_WPML_ACTIVE' ) && KIDDY_WPML_ACTIVE;
}

// shortcode json attribute conversion
function kiddy_json_sc_attr_conversion( $attr ) {
	return is_string( $attr ) ? json_decode( preg_replace( array( '/\\^\\*/', '/\\*\\$/' ), array( '[', ']' ), $attr ) ) : false;
}

// declare ajaxurl on frontend
add_action( 'wp_head','pluginname_ajaxurl' );
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
</script>
<?php
}

/* Comments */
class KIDDY_Walker_Comment extends Walker_Comment {
	// init classwide variables
	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	/** CONSTRUCTOR
	 * You'll have to use this if you plan to get to the top of the comments list, as
	 * start_lvl() only goes as high as 1 deep nested comments */
	function __construct() {
	?>

				<div class="comment_list">

	<?php }

	/** START_LVL
	 * Starts the list before the CHILD elements are added. Unlike most of the walkers,
	 * the start_lvl function means the start of a nested comment. It applies to the first
	 * new level under the comments that are not replies. Also, it appear that, by default,
	 * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>
				<div class="comments_children">
	<?php }

	/** END_LVL
	 * Ends the children list of after the elements are added. */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>
				</div><!-- /.children -->

	<?php }

	/** START_EL */
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );
	 ?>

		<div <?php comment_class( $parent_class ); ?> id="comment-<?php echo sanitize_html_class( comment_ID() ) ?>">
			<div id="comment-body-<?php echo sanitize_html_class( comment_ID() ) ?>" class="comment-body clearfix">

								<div class="avatar_section">
								<?php if($args['avatar_size'] != 0){
									echo (get_avatar( $comment, $args['avatar_size'] ));						
								} ?>
								</div>
								<div class="comment_info_section">
										<div class="comment_info_header">
												<div class="reply">
							<?php $reply_args = array(
								'reply_text' => esc_html__( 'Reply', 'kiddy' ) . "&nbsp; <i class='fa fa-reply'></i>",
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
							);
							comment_reply_link( array_merge( $args, $reply_args ) );  ?>
												</div><!-- /.reply -->
												<div class="comment-meta comment-meta-data">
							<cite class="fn n author-name"><?php echo get_comment_author_link(); ?></cite>
							&nbsp; <span class="comment_date"><?php comment_date() . esc_html_e( ' at ', 'kiddy' ) .  comment_time(); ?></span>
							<?php edit_comment_link( esc_html__( '(Edit)', 'kiddy' )); ?>
												</div><!-- /.comment-meta -->
										</div>

										<div id="comment-content-<?php echo sanitize_html_class( comment_ID() ); ?>" class="comment-content">
											<?php if ( ! $comment->comment_approved ) : ?>
											<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'kiddy' ) ?></em>
											<?php else : comment_text(); ?>
											<?php endif; ?>
										</div><!-- /.comment-content -->

								</div>
						</div><!-- /.comment-body -->

	<?php }

	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
	?>

				</div><!-- /#comment-' . get_comment_ID() . ' -->

	<?php }

	/** DESTRUCTOR
	 * I just using this since we needed to use the constructor to reach the top
	 * of the comments list, just seems to balance out :) */
	function __destruct() {
	?>

		</div><!-- /#comment-list -->

	<?php }
}

function kiddy_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
		<div class="comments_nav carousel_nav_panel clearfix">
		<?php
		if ( $prev_link = get_previous_comments_link( "<span class='prev'></span><span>" . esc_html__( 'Older Comments', 'kiddy' ) . '</span>' ) ) :
			printf( '<div class="prev_section">%s</div>', $prev_link );
			endif;

		if ( $next_link = get_next_comments_link( '<span>' . esc_html__( 'Newer Comments', 'kiddy' ) . "</span><span class='next'></span>" ) ) :
			printf( '<div class="next_section">%s</div>', $next_link );
			endif;
		?>
		</div><!-- .comment-navigation -->
	<?php
	endif;
}

function kiddy_comment_post( $incoming_comment ) {
	$comment = strip_tags($incoming_comment['comment_content']);
	$comment = esc_html($comment);
	$incoming_comment['comment_content'] = $comment;
	return( $incoming_comment );
}

add_filter('preprocess_comment', 'kiddy_comment_post', '', 1);

/* \Comments */

add_filter( 'embed_oembed_html','kiddy_oembed_wrapper',10,3 );

function kiddy_oembed_wrapper( $html, $url, $args ) {
	return ! empty( $html ) ? '<div class="cws_oembed_wrapper">'.$html.'</div>' : '';
}

if ( class_exists( 'woocommerce' ) ) {
	add_action( 'wp_ajax_woocommerce_remove_from_cart', 'woocommerce_ajax_remove_from_cart',1000 );
	add_action( 'wp_ajax_nopriv_woocommerce_remove_from_cart', 'woocommerce_ajax_remove_from_cart',1000 );
}

function woocommerce_ajax_remove_from_cart() {
	global $woocommerce;

	$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );

	$ver = explode( '.', WC_VERSION );

	if ( $ver[1] == 1 && $ver[2] >= 2 ) :
		$wc_ajax = new WC_AJAX();
		$wc_ajax->get_refreshed_fragments();
	else :
		woocommerce_get_refreshed_fragments();
	endif;

	die();
}
if ( class_exists( 'woocommerce' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
}

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
		?>
			<i class='woo_mini-count fa fa-shopping-cart'><?php echo ((WC()->cart->cart_contents_count > 0) ?  '<span>' . esc_html( WC()->cart->cart_contents_count ) .'</span>' : '') ?></i>
		<?php
		$fragments['.woo_mini-count'] = ob_get_clean();

		ob_start();
		woocommerce_mini_cart();
		$fragments['div.woo_mini_cart'] = ob_get_clean();

		return $fragments;
}

add_filter( 'woocommerce_output_related_products_args', 'kiddy_related_products_args' );

function kiddy_related_products_args( $args ) {
	$args['posts_per_page'] = kiddy_get_option( 'woo-resent-num-products' ); // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

/* Social Links */

function render_kiddy_social_links() {
	$out = '';
	$social_groups_option = kiddy_get_option( 'social_group' );
	if ( ! empty( $social_groups_option ) && is_array( $social_groups_option ) ) {
		$social_groups = array();
		for ( $i = 0; $i < count( $social_groups_option ); $i++ ) {
			if ( isset( $social_groups_option[ $i ]['soc-select-fa'] ) && ! empty( $social_groups_option[ $i ]['soc-select-fa'] ) ) {
				$social_groups[] = $social_groups_option[ $i ];
			}
		}
		foreach ( $social_groups as $social_group ) {
			$title = isset( $social_group['title'] ) ? esc_attr( $social_group['title'] ) : '';
			$icon = sanitize_html_class( $social_group['soc-select-fa'] );
			$url = isset( $social_group['soc-url'] ) ? esc_url( $social_group['soc-url'] ) : '';
			$out .= "<a href='" . ( ! empty( $url ) ? $url : '#' ) . "' target='_blank' class='cws_social_link'" . ( ! empty( $title ) ? " title='$title'" : '' ) . "><i class='share-icon fa fa-$icon'></i></a>";
		}
		$out = ! empty( $out ) ? "<div class='cws_social_links'>$out</div>" : '';
	}
	return $out;
}

	/* \Social Links */

function kiddy_get_date_part( $part = '' ) {
	$part_val = '';
	$p_id = get_queried_object_id();
	$perm_struct = get_option( 'permalink_structure' );
	$use_perms = ! empty( $perm_struct );
	$merge_date = get_query_var( 'm' );
	$match = preg_match( '#(\d{4})?(\d{1,2})?(\d{1,2})?#', $merge_date, $matches );
	switch ( $part ) {
		case 'y':
			$part_val = $use_perms ? get_query_var( 'year' ) : ( isset( $matches[1] ) ? $matches[1] : '' );
			break;
		case 'm':
			$part_val = $use_perms ? get_query_var( 'monthnum' ) : ( isset( $matches[2] ) ? $matches[2] : '' );
			break;
		case 'd':
			$part_val = $use_perms ? get_query_var( 'day' ) : ( isset( $matches[3] ) ? $matches[3] : '' );
			break;
	}
	return $part_val;
}

add_filter( 'mce_buttons_2', 'kiddy_mce_buttons_2' );

function kiddy_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'tiny_mce_before_init', 'kiddy_tiny_mce_before_init' );

function kiddy_tiny_mce_before_init( $settings ) {

	$font_array = kiddy_get_option( 'header-font' );

	$settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

	$style_formats = array(
	array( 'title' => 'Title', 'block' => 'h3', 'classes' => 'ce_title','styles' => array( 'font-size' => $font_array['font-size'] ) ),
	array( 'title' => 'H1 Title', 'block' => 'h1', 'classes' => 'ce_title heading' ),
	array( 'title' => 'H2 Title', 'block' => 'h2', 'classes' => 'ce_title heading' ),
	array( 'title' => 'H3 Title', 'block' => 'h3', 'classes' => 'ce_title heading' ),
	array( 'title' => 'H4 Title', 'block' => 'h4', 'classes' => 'ce_title heading' ),
	array( 'title' => 'H5 Title', 'block' => 'h5', 'classes' => 'ce_title heading' ),
	array( 'title' => 'H6 Title', 'block' => 'h6', 'classes' => 'ce_title heading' ),
	array( 'title' => 'Borderless image', 'selector' => 'img', 'classes' => 'noborder' ),
	);
	// Before 3.1 you needed a special trick to send this array to the configuration.
	// See this post history for previous versions.
	$settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );

	return $settings;
}


/**************** CUSTOM ADD TO CART ****************/

add_action('wp_ajax_canvas_add_cart', 'canvas_add_cart');
add_action('wp_ajax_nopriv_canvas_add_cart', 'canvas_add_cart');

function canvas_add_cart() {
	 $arr = array();
     $arr["Child Name"] = $_POST['child_name'];
     $arr['Hair Image']  = $_POST['hair_img']; 
     $arr['Hair Class']  = $_POST['hair_cls'];
     $arr['Eye Image']   = $_POST['eye_img'];
     $arr['Eye val']     = $_POST['eye_val'];
     $arr['Glass Image'] = $_POST['gls_img'];
     $arr['Body Type']   = $_POST['body_type'];
     $arr['Body Attribute']   = $_POST['body_attr'];
     $arr['Frekles']   = $_POST['freklesyes']; 
     $arr['Story 1']   = $_POST['st1'];
     $arr['Story 2']   = $_POST['st2'];
     $arr['Story 3']   = $_POST['st3'];
     $arr['Story 4']   = $_POST['st4'];
     $arr['Story 5']   = $_POST['st5'];
     $arr['Story 6']   = $_POST['st6'];
     $arr['Story 7']   = $_POST['st7'];
     $arr['Story 8']   = $_POST['st8'];
     $arr['Story 9']   = $_POST['st9'];
     $arr['Story 10']   = $_POST['st10'];

	WC()->cart->add_to_cart(6152, 1, '', $arr, null);
}


/****************** END ADD TO CART ******************/

/*************** ADD FIELDS AND DOWNLOAD BUTTON ********/

add_action('woocommerce_before_order_itemmeta', 'so_32457241_before_order_itemmeta', 10, 3 );
function so_32457241_before_order_itemmeta( $item_id, $item, $_product ){
 	$order_id = $item['order_id'];
	$order = wc_get_order($order_id);
	echo "<div id='javaid'>";
	foreach ($order->get_items() as $item_key => $item1 ){
		$meta_data = $item1->get_formatted_meta_data('_', true);
		echo "<input type='hidden' name='order_id' value='".$order_id."'>";
		foreach($meta_data as $dd){
			$key = $dd->key;
			$value = $dd->value;
			$key = str_replace(" ","_", $key);
			$key = strtolower($key);
			echo "<input type='hidden' name='".$key."' value='".$value."'>";
		}
	}
	echo "<button type='button' id='Downloadbook'> Download Book </button>";
	echo "</div>";
}



function woocommerce_button_proceed_to_checkout() { ?>
 <a href="https://cosmicunicorns.com/checkout" class="checkout-button button alt wc-forward">
 <?php esc_html_e( 'Secure Checkout', 'woocommerce' ); ?>
 </a>
 <?php
}

/********************* END OF DOWNLOAD PDF ********************/

/************ SAVING FIELDS FOR PDF ************/


add_action('wp_ajax_add_data_order', 'add_data_order');
add_action('wp_ajax_nopriv_add_data_order', 'add_data_order');

function add_data_order() {
	$order_id   = $_POST['order_id'];
	$child_name = $_POST['child_name'];
	$hair_image = $_POST['hair_image'];
	$hair_class = $_POST['hair_class'];
	$eye_image  = $_POST['eye_image'];
	$eye_val    = $_POST['eye_val'];
	$glass_image = $_POST['glass_image'];
	$body_type = $_POST['body_type'];
	$body_attribute = $_POST['body_attribute'];
	$frekles = $_POST['frekles'];
	$story_1 = $_POST['story_1'];
	$story_2 = $_POST['story_2'];
	$story_3 = $_POST['story_3'];
	$story_4 = $_POST['story_4'];
	$story_5 = $_POST['story_5'];
	$story_6 = $_POST['story_6'];
	$story_7 = $_POST['story_7'];
	$story_8 = $_POST['story_8'];
	$story_9 = $_POST['story_9'];
	$story_10 = $_POST['story_10'];
	global $wpdb;
	$table_name  = "wp8o_record_data";
	$my_query = $wpdb->get_results("SELECT * from ".$table_name." WHERE order_id=".$order_id);
	$num_rows = count($my_query); 
	if($num_rows == 0) {
	$wpdb->insert($table_name, array('order_id' => $order_id, 
									 'child_name' => $child_name,
									 'hair_image' => $hair_image,
									 'hair_class' => $hair_class,
									 'eye_image' => $eye_image,
									 'eye_val' => $eye_val,
									 'glass_image' => $glass_image, 
									 'body_type' => $body_type,
									 'body_attribute' => $body_attribute,
									 'frekles' => $frekles,
									 'story_1' => $story_1,
									 'story_2' => $story_2,
									 'story_3' => $story_3,
									 'story_4' => $story_4,
									 'story_5' => $story_5,
									 'story_6' => $story_6,
									 'story_7' => $story_7,
									 'story_8' => $story_8,
									 'story_9' => $story_9,
									 'story_10' => $story_10
									 )); 
	
	}
	echo $order_id;
	die();
}


?>