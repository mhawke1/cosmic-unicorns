<?php
	/**
	 * Latest Posts Widget Class
	 */
class CWS_Portfolio extends WP_Widget {

	function init_fields() {
		$this->fields = array(
			'title' => array(
				'title' => esc_html__( 'Widget Title', 'kiddy-essentials' ),
				'atts' => 'id="widget-title"',
				'type' => 'text',
			),
			'cats' => array(
				'type' => 'taxonomy',
				'title' => esc_html__( 'Categories', 'kiddy-essentials' ),
				'atts' => 'multiple',
				'taxonomy' => 'cws_portfolio_cat',
				'source' => array(),
			),
			'count' => array(
				'title' => esc_html__( 'Items Count', 'kiddy-essentials' ),
				'type' => 'number',
			),
		);
	}

	function __construct() {
		$widget_ops = array( 'description' => esc_html__( 'Portfolio Items', 'kiddy-essentials' ) );
		parent::__construct( 'cws-portfolio-widget', esc_html__( 'CWS Portfolio', 'kiddy-essentials' ), $widget_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		extract( shortcode_atts( array(
			'title' => '',
			'cats' => array(),
			'count' => '',
		), $instance));

		$count = empty( $count ) ? get_option( 'posts_per_page' ) : $count;

		$query_args = array(
			'post_type' => 'cws_portfolio',
			'ignore_sticky_posts' => true,
			'post_status' => 'publish',
			'posts_per_page' => $count,
		);

		$tax_query = array();
		if ( ! empty( $cats ) ) {
			$tax_query[] = array(
				'taxonomy' => 'cws_portfolio_cat',
				'field' => 'slug',
				'terms' => $cats,
			);
		}

		if ( ! empty( $tax_query ) ) { $query_args['tax_query'] = $tax_query; }

		$q = new WP_Query( $query_args );

		$several = ($q->post_count > 1);
		$gallery_id = uniqid( 'cws-portfolio-gallery-' );

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html($title) . $after_title;
		}
		if ( $q->have_posts() ) :
			echo "<div class='portfolio_item_thumbs clearfix'>";
			while ( $q->have_posts() ) :
				$q->the_post();
				if ( has_post_thumbnail() ) {
					$img_url = wp_get_attachment_url( get_post_thumbnail_id() );
					$thumb_obj = bfi_thumb( $img_url,array( 'width' => 71, 'height' => 71, 'crop' => true ), false );
					$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
					$thumb_url = $thumb_path_hdpi;
					$img_url = esc_url( $img_url );
					echo "<div class='portfolio_item_thumb'>";
						echo "<div class='pic'>";
							echo "<a href='$img_url' class='fancy'" . ( $several ? " data-fancybox-group='$gallery_id'" : '' ) . '>';
								echo "<img $thumb_url alt />";
								echo "<div class='hover-effect'></div>";
								echo "	<div class='links_popup'>
													<div class='link_cont'>
														<div class='link'>
															<span><i class='fa fa-" . ( $several ? 'camera' : 'plus' ) . "'></i></span>
														</div>
													</div>
												</div>";
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
					endwhile;
				wp_reset_postdata();
				echo '</div>';
			else :
				echo do_shortcode( "[cws_sc_msg_box text='" . esc_html__( 'There are no posts matching the query', 'kiddy-essentials' ) . "'][/cws_sc_msg_box]" );
			endif;
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
