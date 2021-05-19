<?php
	/**
	 * CWS Text Widget Class
	 */
class CWS_Text extends WP_Widget {
	public $fields = array();
	public function init_fields() {
		$this->fields = array(
			'title' => array(
				'title' => esc_html__( 'Widget title', 'kiddy-essentials' ),
				'atts' => 'id="widget-title"',
				'type' => 'text',
				'value' => '',
			),
			'show_icon_opts' => array(
				'title' => esc_html__( 'Show icon options', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'data-options="e:icon_color;e:icon_type"',
			),
			'icon_color' => array(
				'type'      => 'text',
				'title'     => esc_html__( 'Icon color', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'atts' => 'data-default-color="'.KIDDY_COLOR.'"',
			),
			'icon_type' => array(
				'title' => esc_html__( 'Icon type', 'kiddy-essentials' ),
				'type' => 'radio',
				'addrowclasses' => 'disable',
				'subtype' => 'images',
				'value' => array(
					'fa' => array( esc_html__( 'icon', 'kiddy-essentials' ), 	true, 	'e:icon_fa;d:icon_img;d:icon_img_width;d:icon_img_height', get_template_directory_uri() . '/core/images/align-left.png' ),
					'img' =>array( esc_html__( 'image', 'kiddy-essentials' ), false,	'd:icon_fa;e:icon_img;e:icon_img_width;e:icon_img_height', get_template_directory_uri() . '/core/images/align-right.png' ),
				),
			),
			'icon_img' => array(
				'title' => esc_html__( 'Custom icon', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'type' => 'media',
			),
			'icon_img_width' => array(
				'title' => esc_html__( 'Image width', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'type' => 'text',
				'value' => '40',
			),
			'icon_img_height' => array(
				'title' => esc_html__( 'Image height', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'type' => 'text',
				'value' => '40',
			),
			'icon_fa' => array(
				'title' => esc_html__( 'Font Awesome character', 'kiddy-essentials' ),
				'type' => 'select',
				'addrowclasses' => 'disable fai',
				'source' => 'fa',
			),
			'text' => array(
				'title' => esc_html__( 'Text', 'kiddy-essentials' ),
				'type' => 'textarea',
				'atts' => 'rows="10"',
				'value' => '',
			),
			'with_paragraphs' => array(
				'title' => esc_html__( 'Automatically add paragraphs', 'kiddy-essentials' ),
				'type' => 'checkbox',
			),
			'add_link' => array(
				'title' => esc_html__( 'Add link', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'atts' => 'data-options="e:link_url;e:link_text"',
			),
			'link_url' => array(
				'title' => esc_html__( 'Url', 'kiddy-essentials' ),
				'addrowclasses' => 'disable',
				'type' => 'text',
			),
			'link_text' => array(
				'title' => esc_html__( 'Link text', 'kiddy-essentials' ),
				'type' => 'text',
				'addrowclasses' => 'disable',
				'default' => '',
			),
		);
	}
	function __construct() {
		$widget_ops = array( 'classname' => 'widget-cws-text', 'description' => esc_html__( 'Modified WP Text widget', 'kiddy-essentials' ) );
		parent::__construct( 'cws-text', esc_html__( 'CWS Benefits', 'kiddy-essentials' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		extract( shortcode_atts( array(
			'title' => '',
			'show_icon_opts' => '0',
			'icon_color' => '',
			'icon_type' => '',
			'icon_img' => array('src'=>'','id'=>''),
			'icon_img_width' => 40,
			'icon_img_height' => 40,
			'icon_fa' => '',
			'text' => '',
			'with_paragraphs' => '0',
			'add_link' => '0',
			'link_url' => '',
			'link_text' => '',
		), $instance));

		$widget_title_icon = kiddy_widget_title_icon_rendering( array(
			'icon_color' => $icon_color,
			'icon_type' => $icon_type,
			'icon_fa' => $icon_fa,
			'icon_img' => $icon_img,
			'icon_img_width' => $icon_img_width,
			'icon_img_height' => $icon_img_height,
			) );

		$add_link = $add_link == '1' ? true	: false;
		$with_paragraphs = $with_paragraphs == '1' ? true	: false;

		echo $before_widget;
		if ( ! empty( $widget_title_icon ) ) {
			if ( ! empty( $title ) ) {
				echo $before_title . "<div class='widget_title_box'><div class='widget_title_icon_section'>$widget_title_icon</div><div class='widget_title_text_section'>$title</div></div>" . $after_title;
			} else {
				echo $before_title . $widget_title_icon . $after_title;
			}
		} else if ( ! empty( $title ) ) {
				echo $before_title . esc_html( $title ) . $after_title;
		}
		$text = $with_paragraphs ? wpautop( do_shortcode( $text ) ) : do_shortcode( $text );
		$text_section = ! empty( $text ) ? "<div class='text'>$text</div>" : '';
		$link_section = ! empty( $link_text ) ? "<div class='link'><a href='" . ( ! empty( $link_url ) ? esc_url($link_url) : '#' ) . "' class='cws_button small'>" . esc_html($link_text) . "</a></div>" : '';

		if ( ! empty( $text_section ) || ! empty( $link_section ) ) {
			echo "<div class='cws_textwidget_content'>";
				echo $text_section;
				echo $link_section;
			echo '</div>';
		}

			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = (array)$new_instance;
		var_dump($instance);
		foreach ($new_instance as $key => $v) {
			switch ($this->fields[$key]['type']) {
				case 'text':
					$instance[$key] = strip_tags($v);
					break;
			}
		}
		return $instance;
	}

	function form( $instance ) {
		$this->init_fields();
		$args[0] = $instance;
		cws_mb_fillMbAttributes( $args, $this->fields );
		echo cws_mb_print_layout( $this->fields, 'widget-' . $this->id_base . '[' . $this->number . '][');
	}
}
?>
