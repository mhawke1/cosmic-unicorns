<?php
	/**
	 * Latest Posts Widget Class
	 */
class CWS_Latest_Posts extends WP_Widget {
	function init_fields() {
		$this->fields = array(
			'title' => array(
				'title' => esc_html__( 'Widget Title', 'kiddy-essentials' ),
				'atts' => 'id="widget-title"',
				'type' => 'text',
				),
			'cats' => array(
				'title' => esc_html__( 'Post categories', 'kiddy-essentials' ),
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'atts' => 'multiple',
				'source' => array(),
				),
			'count' => array(
				'type' => 'number',
				'title' => esc_html__( 'Post count', 'kiddy-essentials' ),
				'value' => '3',
				),
			'visible_count' => array(
				'type' => 'number',
				'title' => esc_html__( 'Visible count', 'kiddy-essentials' ),
				'value' => '3',
				),
			'chars_count' => array(
				'type' => 'number',
				'title' => esc_html__( 'Count of chars from post content', 'kiddy-essentials' ),
				'value' => '50',
				),
			'show_date' => array(
				'type' => 'checkbox',
				'title' => esc_html__( 'Show date', 'kiddy-essentials' ),
				),
		);
	}
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_cws_recent_entries', 'description' => esc_html__( 'CWS most recent posts', 'kiddy-essentials' ) );
		parent::__construct( 'cws-recent-posts', esc_html__( 'CWS Recent Posts', 'kiddy-essentials' ), $widget_ops );
	}
	function widget( $args, $instance ) {
		extract( $args );

		extract( shortcode_atts( array(
			'title' => '',
			'cats' => array(),
			'count' => get_option( 'posts_per_page' ),
			'visible_count' => get_option( 'posts_per_page' ),
			'chars_count' => '50',
			'show_date' => '0',
		), $instance));

		for ( $i = 0; $i < count( $cats ); $i++ ) {
			$term_obj = get_term_by( 'slug', $cats[ $i ], 'category' );
			$cats[ $i ] = $term_obj->term_id;
		}

		$footer_is_rendered = isset( $GLOBALS['footer_is_rendered'] );

		$count = empty( $count ) ? (int) get_option( 'posts_per_page' ) : (int) $count;
		$visible_count = empty( $visible_count ) ? $count : $visible_count;
		$chars_count = empty( $chars_count ) ? 50 : (int) $chars_count;

		$q_args = array( 'category__in' => $cats, 'posts_per_page' => $count, 'ignore_sticky_posts' => true, 'post_status' => 'publish' );
		$q = new WP_Query( $q_args );

		$carousel_mode = $count > $visible_count;
		$counter = 0;

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html($title) . $after_title;
		}
		if ( $q->have_posts() ) :
			if ( $carousel_mode ) {
				wp_enqueue_script ('owl_carousel');
				echo "<div class='widget_carousel'>";
			} else if ( $footer_is_rendered ) {
				echo "<div class='post_items'>";
			}
			while ( $q->have_posts() ) :
				$q->the_post();
				$date_format = get_option( 'date_format' );
				$date = esc_html( get_the_time( $date_format ) );
				if ( $carousel_mode && $counter <= 0 ) {
					echo "<div class='item'>";
				}
					echo "<div class='post_item'>";
						echo "<div class='post_preview clearfix'>";
							$post_title = esc_html( get_the_title() );
							$permalink = esc_url( get_permalink() );
				if ( has_post_thumbnail() ) :
					$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id() );
					$thumb_obj = bfi_thumb( $featured_img_url,array( 'width' => 58, 'height' => 58, 'crop' => true ), false );
					$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
					$thumb_url = $thumb_path_hdpi;

					echo "<a href='$permalink' class='post_thumb_wrapp pic'><img class='post_thumb' $thumb_url alt /><div class='hover-effect'></div><div class='links'><span class='fa fa-link'></span></div></a>";
							endif;
							echo ! empty( $post_title ) ? "<div class='post_title'><a href='$permalink'>$post_title</a></div>" : '';
							$content = ! empty( get_the_excerpt() ) ? get_the_excerpt() : get_the_content( '' );
							$content = trim( preg_replace( '/[\s]{2,}/', ' ', strip_shortcodes( strip_tags( $content ) ) ) );
							$is_content_empty = empty( $content );
				if ( ! $is_content_empty ) {
					if ( strlen( $content ) > $chars_count ) {
						$content = mb_substr( $content, 0, $chars_count );
						$content = wptexturize( $content ); // apply wp filter
						echo "<div class='post_content'>$content <a href='$permalink'>" . esc_html__( '...', 'kiddy-essentials' ) . '</a></div>';
					} else {
						$content = wptexturize( $content ); // apply wp filter
						echo "<div class='post_content'>$content</div>";
					}
				}
				if ( $show_date && $footer_is_rendered ) {
					echo "<div class='post_date'>$date</div>";
				}
							echo '</div>';
				if ( $show_date && ! $footer_is_rendered ) {
					echo "<div class='post_date'>$date</div>";
				}
							echo '</div>';
				if ( $carousel_mode ) {
					if ( $counter >= $visible_count -1 || $q->current_post >= $q->post_count -1 ) {
						echo '</div>';
						$counter = 0;
					} else {
						$counter ++;
					}
				}
			endwhile;
			wp_reset_postdata();
			echo $carousel_mode || $footer_is_rendered ? '</div>' : '';
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
