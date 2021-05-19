<?php
	/**
	 * CWS Twitter Widget Class
	 */
class CWS_Twitter extends WP_Widget {
	public $fields_controller;
	public $fields = array();
	public function init_fields (){
		$this->fields = array(
			'title' => array(
				'title' => esc_html__( 'Widget title', 'kiddy-essentials' ),
				'atts' => 'id="widget-title"',
				'type' => 'text',
				),
			'items' => array(
				'title' => esc_html__( 'Tweets to extract', 'kiddy-essentials' ),
				'type' => 'number',
				'value' => get_option( 'posts_per_page' )
			),
			'visible' => array(
				'title' => esc_html__( 'Tweets to show', 'kiddy-essentials' ),
				'type' => 'number',
				'value' => get_option( 'posts_per_page' )
			),
			'showdate' => array(
				'title' => esc_html__( 'Show date', 'kiddy-essentials' ),
				'type' => 'checkbox',
			)
		);
	}
	function __construct(){
		$widget_ops = array('classname' => 'widget_cws_twitter', 'description' => esc_html__( 'CWS Twitter Widget', 'kiddy-essentials' ) );
		parent::__construct('cws-twitter', esc_html__('CWS Twitter', 'kiddy-essentials' ), $widget_ops);
	}

	function widget ( $args, $instance ){

		extract( $args );

		extract( shortcode_atts( array('title' => '',), $instance));

		echo $before_widget;

		if ( !empty( $title ) ){
			echo $before_title . esc_html($title) . $after_title;
		}

		$twitter_args = array(
			'in_widget' => true
		);
		if ( isset( $instance['items'] ) ) $twitter_args['items'] = $instance['items'];
		if ( isset( $instance['visible'] ) ) $twitter_args['visible'] = $instance['visible'];
		if ( isset( $instance['showdate'] ) ) $twitter_args['showdate'] = $instance['showdate'];

		echo kiddy_twitter_renderer( $twitter_args );

		echo $after_widget;
	}

	function form ( $instance ){
		if (function_exists('getTweets')) {
		$this->init_fields();
		$args[0] = $instance;
		cws_mb_fillMbAttributes( $args, $this->fields );
		echo cws_mb_print_layout( $this->fields, 'widget-' . $this->id_base . '[' . $this->number . '][');
		} else {
			echo 'You need to install and activate <b>oAuth Twitter Feed for Developers</b> plugin';
		}
	}
}
?>