<?php

new Kiddy_Metaboxes();

class Kiddy_Metaboxes {
	public function __construct() {
		$this->init();
	}

	private function init() {
		include_once get_template_directory() . '/core/pb.php';
		add_action( 'add_meta_boxes', array($this, 'post_addmb') );
		add_action( 'add_meta_boxes_cws_portfolio', array($this, 'portfolio_addmb') );
		add_action( 'add_meta_boxes_cws_staff', array($this, 'staff_addmb') );

		add_action( 'admin_enqueue_scripts', array($this, 'mb_script_enqueue') );
		add_action( 'save_post', array($this, 'post_metabox_save'), 11, 2 );
	}

	public function portfolio_addmb() {
		add_meta_box( 'cws-post-metabox-id', 'CWS Portfolio Options', array($this, 'mb_portfolio_callback'), 'cws_portfolio', 'normal', 'high' );
	}

	public function staff_addmb() {
		add_meta_box( 'cws-post-metabox-id', 'CWS Staff Options', array($this, 'mb_staff_callback'), 'cws_staff', 'normal', 'high' );
	}

	public function post_addmb() {
		add_meta_box( 'cws-post-metabox-id', 'CWS Post Options', array($this, 'mb_post_callback'), 'post', 'normal', 'high' );
		add_meta_box( 'cws-post-metabox-id', 'CWS Page Options', array($this, 'mb_page_callback'), 'page', 'normal', 'high' );
	}

	public function mb_staff_callback( $post ) {
		wp_nonce_field( 'cws_mb_nonce', 'mb_nonce' );

		$mb_attr = array(
			'is_clickable' => array(
				'type' => 'checkbox',
				'title' => esc_html__('Reference to single', 'kiddy-essentials' ),
				'atts' => 'data-options="e:cws_img_clickable;"',
			),
			'cws_img_clickable' => array(
				'type' => 'checkbox',
				'title' => esc_html__('Add URL to the staff photo.', 'kiddy-essentials' ),
			),
			'social_group' => array(
				'type' => 'group',
				'addrowclasses' => 'group',
				'title' => esc_html__('Social networks', 'kiddy-essentials' ),
				'button_title' => esc_html__('Add new social network', 'kiddy-essentials' ),
				'layout' => array(
					'title' => array(
						'type' => 'text',
						'atts' => 'data-role="title"',
						'title' => esc_html__('Social account title', 'kiddy-essentials' ),
					),
					'icon' => array(
						'type' => 'select',
						'addrowclasses' => 'fai',
						'source' => 'fa',
						'title' => esc_html__('Select the icon for this social contact', 'kiddy-essentials' )
					),
					'url' => array(
						'type' => 'text',
						'title' => esc_html__('Url to your account', 'kiddy-essentials' ),
					),
				),
			),
		);

		$cws_stored_meta = get_post_meta( $post->ID, 'cws_mb_post' );
		cws_mb_fillMbAttributes($cws_stored_meta, $mb_attr);
		echo cws_mb_print_layout($mb_attr, 'cws_mb_');
	}

	public function mb_page_callback( $post ) {
		wp_nonce_field( 'cws_mb_nonce', 'mb_nonce' );

		$mb_attr = array(
			'sb_layout' => array(
				'title' => esc_html__('Sidebar Position', 'kiddy-essentials' ),
				'type' => 'radio',
				'subtype' => 'images',
				'value' => array(
					'default'=>	array( esc_html__('Default', 'kiddy-essentials' ), true, 'd:sidebar1;d:sidebar2', get_template_directory_uri() . '/core/images/default.png' ),
					'left' => 	array( esc_html__('Left', 'kiddy-essentials' ), false, 'e:sidebar1;d:sidebar2',	get_template_directory_uri() . '/core/images/left.png' ),
					'right' => 	array( esc_html__('Right', 'kiddy-essentials' ), false, 'e:sidebar1;d:sidebar2', get_template_directory_uri() . '/core/images/right.png' ),
					'both' => 	array( esc_html__('Double', 'kiddy-essentials' ), false, 'e:sidebar1;e:sidebar2', get_template_directory_uri() . '/core/images/both.png' ),
					'none' => 	array( esc_html__('None', 'kiddy-essentials' ), false, 'd:sidebar1;d:sidebar2', get_template_directory_uri() . '/core/images/none.png' )
				),
			),
			'sidebar1' => array(
				'title' => esc_html__('Select a sidebar', 'kiddy-essentials' ),
				'type' => 'select',
				'addrowclasses' => 'disable',
				'source' => 'sidebars',
			),
			'sidebar2' => array(
				'required' => array( 'sb_layout', '=', 'both' ),
				'title' => esc_html__('Select right sidebar', 'kiddy-essentials' ),
				'type' => 'select',
				'addrowclasses' => 'disable',
				'source' => 'sidebars',
			),
			'is_blog' => array(
				'type' => 'checkbox',
				'title' => esc_html__('Show Blog posts', 'kiddy-essentials' ),
				'atts' => 'data-options="e:blogtype;e:category"',
			),
			'blogtype' => array(
				'type' => 'radio',
				'subtype' => 'images',
				'title' => esc_html__('Blog Layout', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'value' => array(
					'default'=>	array( esc_html__('Default', 'kiddy-essentials' ), false, '', get_template_directory_uri() . '/core/images/default.png' ),
					'small' => array( esc_html__('Small', 'kiddy-essentials' ), false, '', get_template_directory_uri() . '/core/images/small.png' ),
					'medium' => array( esc_html__('Medium', 'kiddy-essentials' ), true, '', get_template_directory_uri() . '/core/images/medium.png' ),
					'large' => array( esc_html__('Large', 'kiddy-essentials' ), false, '', get_template_directory_uri() . '/core/images/large.png' ),
					'2' => array(  esc_html__('Two', 'kiddy-essentials' ), false, '', get_template_directory_uri() . '/core/images/pinterest_2_columns.png'),
					'3' => array( esc_html__('Three', 'kiddy-essentials' ), false, '', get_template_directory_uri() . '/core/images/pinterest_3_columns.png'),
				),
			),
			'category' => array(
				'title' => esc_html__('Category', 'kiddy-essentials' ),
				'type' => 'taxonomy',
				'addrowclasses' => 'disable',
				'atts' => 'multiple',
				'taxonomy' => 'category',
				'source' => array(),
			),
			'sb_foot_override' => array(
				'type' => 'checkbox',
				'title' => esc_html__( 'Customize footer', 'kiddy-essentials' ),
				'atts' => 'data-options="e:footer-sidebar-top"',
			),
			'footer-sidebar-top' => array(
				'title' => esc_html__('Sidebar area', 'kiddy-essentials' ),
				'type' => 'select',
				'addrowclasses' => 'disable',
				'source' => 'sidebars',
			),
			'sb_benefits_override' => array(
				'type' => 'checkbox',
				'title' => esc_html__( 'Add Benefits', 'kiddy-essentials' ),
				'atts' => 'data-options="e:benefits-sidebar"',
			),
			'benefits-sidebar' => array(
				'title' => esc_html__('Sidebar area', 'kiddy-essentials' ),
				'type' => 'select',
				'addrowclasses' => 'disable',
				'source' => 'sidebars',
			),
			'sb_slider_override' => array(
				'type' => 'checkbox',
				'title' => esc_html__( 'Add Image Slider', 'kiddy-essentials' ),
				'atts' => 'data-options="e:slider_shortcode"',
			),
			'slider_shortcode' => array(
				'title' => esc_html__( 'Slider shortcode', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'type' => 'text',
				'default' => ''
			),
		);

		$cws_stored_meta = get_post_meta( $post->ID, 'cws_mb_post' );
		cws_mb_fillMbAttributes($cws_stored_meta, $mb_attr);
		echo cws_mb_print_layout($mb_attr, 'cws_mb_');
	}

	public function mb_portfolio_callback( $post ) {
		wp_nonce_field( 'cws_mb_nonce', 'mb_nonce' );

		$mb_attr = array(
			'carousel' => array(
				'title' => esc_html__( 'Use carousel of items', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'checked',
			),
			'show_related' => array(
				'title' => esc_html__( 'Show related projects', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'checked data-options="e:related_projects_options;e:rpo_title;e:rpo_cols;e:rpo_items_count"',
			),
			'related_projects_options' => array(
				'type' => 'label',
				'title' => esc_html__( 'Related projects options', 'kiddy-essentials' ),
			),
			'rpo_title' => array(
				'type' => 'text',
				'title' => esc_html__( 'Title', 'kiddy-essentials' ),
				'value' => esc_html__( 'Related projects', 'kiddy-essentials' )
				),
			'rpo_cols' => array(
				'type' => 'select',
				'title' => esc_html__( 'Columns', 'kiddy-essentials' ),
				'source' => array(
					'1' => array(esc_html__( 'one', 'kiddy-essentials' ), false),
					'2' => array(esc_html__( 'two', 'kiddy-essentials' ), false),
					'3' => array(esc_html__( 'three', 'kiddy-essentials' ), false),
					'4' => array(esc_html__( 'four', 'kiddy-essentials' ), true),
					),
				),
			'rpo_items_count' => array(
				'type' => 'number',
				'title' => esc_html__( 'Items count', 'kiddy-essentials' ),
				'value' => '4'
			),
			'enable_hover' => array(
				'title' => esc_html__( 'Enable hover effect', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'checked data-options="e:link_options;e:link_options_url;e:link_options_fancybox"',
			),
			'link_options' => array(
				'type' => 'label',
				'title' => esc_html__( 'Link options', 'kiddy-essentials' ),
			),
			'link_options_url' => array(
				'type' => 'text',
				'title' => esc_html__( 'Custom url', 'kiddy-essentials' ),
				'default' => ''
			),
			'link_options_fancybox' => array(
				'type' => 'checkbox',
				'title' => esc_html__( 'Open in fancybox', 'kiddy-essentials' ),
				'atts' => 'checked'
			)
		);

		$cws_stored_meta = get_post_meta( $post->ID, 'cws_mb_post' );
		cws_mb_fillMbAttributes($cws_stored_meta, $mb_attr);
		echo cws_mb_print_layout($mb_attr, 'cws_mb_');
	}

	public function mb_post_callback( $post ) {
		wp_nonce_field( 'cws_mb_nonce', 'mb_nonce' );

		$mb_attr = array(
			'gallery' => array(
				'type' => 'tab',
				'init' => 'closed',
				'title' => esc_html__( 'Gallery options', 'kiddy-essentials' ),
				'layout' => array(
					'gallery' => array(
						'title' => esc_html__( 'Gallery', 'kiddy-essentials' ),
						'type' => 'gallery'
					),
				)
			),
			'video' => array(
				'type' => 'tab',
				'init' => 'closed',
				'title' => esc_html__( 'Video options', 'kiddy-essentials' ),
				'layout' => array(
					'video' => array(
						'title' => esc_html__( 'Url to video file', 'kiddy-essentials' ),
						'type' => 'text'
					)
				)
			),
			'audio' => array(
				'type' => 'tab',
				'init' => 'closed',
				'title' => esc_html__( 'Audio options', 'kiddy-essentials' ),
				'layout' => array(
					'audio' => array(
						'title' => esc_html__( 'Self-hosted/soundclod audio url.', 'kiddy-essentials' ),
						'subtitle' => esc_html__( 'Ex.: /wp-content/uploads/audio.mp3 or http://soundcloud.com/...', 'kiddy-essentials' ),
						'type' => 'text'
					)
				)
			),
			'link' => array(
				'type' => 'tab',
				'init' => 'closed',
				'title' => esc_html__( 'Link options', 'kiddy-essentials' ),
				'layout' => array(
					'link' => array(
						'title' => esc_html__( 'Url', 'kiddy-essentials' ),
						'type' => 'text'
					)
				)
			),
			'quote' => array(
				'type' => 'tab',
				'init' => 'closed',
				'title' => esc_html__( 'Quote options', 'kiddy-essentials' ),
				'layout' => array(
					'quote[quote]' => array(
						'title' => esc_html__( 'Quote', 'kiddy-essentials' ),
						'subtitle' => esc_html__( 'Enter the quote', 'kiddy-essentials' ),
						'atts' => 'rows="5"',
						'type' => 'textarea'
					),
					'quote[author]' => array(
						'title' => esc_html__( 'Author', 'kiddy-essentials' ),
						'type' => 'text'
					)
				)
			)
		);

		$cws_stored_meta = get_post_meta( $post->ID, 'cws_mb_post' );
		cws_mb_fillMbAttributes($cws_stored_meta, $mb_attr);
		echo cws_mb_print_layout($mb_attr, 'cws_mb_');

		$mb_attr_all = array(
			'enable_lightbox' => array(
				'title' => esc_html__( 'Enable lightbox', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'checked',
			),
		);
		cws_mb_fillMbAttributes($cws_stored_meta, $mb_attr_all);
		echo cws_mb_print_layout($mb_attr_all, 'cws_mb_');
	}

	public function mb_script_enqueue($a) {
		global $typenow;
		if (($a === 'post.php' || $a === 'post-new.php') && ('cws_' === substr($typenow, 0, 4) )) {
		}
	}

	public function post_metabox_save( $post_id, $post )
	{
		if ( in_array($post->post_type, array('post', 'page', 'cws_portfolio', 'cws_staff')) ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;

			if ( !isset( $_POST['mb_nonce']) || !wp_verify_nonce($_POST['mb_nonce'], 'cws_mb_nonce') )
				return;

			if ( !current_user_can( 'edit_post', $post->ID ) )
				return;

			$save_array = array();

			foreach($_POST as $key => $value) {
				if (0 === strpos($key, 'cws_mb_')) {
					if ('on' === $value) {
						$value = '1';
					}
					if (is_array($value)) {
						foreach ($value as $k => $val) {
							if (is_array($val)) {
								$save_array[substr($key, 7)][$k] = $val;
							} else {
								$save_array[substr($key, 7)][$k] = esc_html($val);
							}
						}
					} else {
						$save_array[substr($key, 7)] = esc_html($value);
					}
				}
			}
			if (!empty($save_array)) {
				update_post_meta($post_id, 'cws_mb_post', $save_array);
			}
		}
	}
}
?>