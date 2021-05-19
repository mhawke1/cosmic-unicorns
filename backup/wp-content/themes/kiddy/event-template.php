<?php
/* Template Name: Timetable Event */
	$sb = is_active_sidebar( 'sidebar-event' ) ? ' single_sidebar' : '';

	$footer_img_height = (int) kiddy_footer_image_height() + 35;

	get_header();
	?>
	<div class="page_content<?php echo(esc_attr($sb)) ?> tt_event_theme_page timetable_clearfix" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.$footer_img_height.'px"' : '' ;?>>
		<?php kiddy_pattern_image( 'left' ); ?>
        <div class='container'>
            <main class="tt_event_page_left">
				<?php
				ob_start();
					$thumbnail = has_post_thumbnail( ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full' ) : '';
					$thumbnail = ! empty( $thumbnail ) ? $thumbnail[0] : '';
					$thumbnail_dims = is_active_sidebar( 'sidebar-event' ) ? 870 - 22  : 1170 - 22;
					if ( ! empty( $thumbnail ) ) {
						$image_data = wp_get_attachment_metadata( get_post_thumbnail_id( $post->ID ) );
						if ( $image_data['width'] < 1170 ) {
							$img_data['width'] = 0;
							$img_data['height'] = 0;
						} else {
							$img_data['width'] = $thumbnail_dims;
							$img_data['height'] = 0;
						}
						$img_data['crop'] = true;
						$thumb_obj = bfi_thumb( $thumbnail,$img_data, false );
						$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
						$thumb_url = $thumb_path_hdpi;

						echo '<img '.$thumb_url.' alt />';
					}

				$image_src = ob_get_clean();
				if ( ! empty( $image_src ) ) {
						echo ('<a href="'. echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ) .'" class="cws_img_frame alignleft">' .$image_src);
					?>
                </a>
				<?php } ?>
				<h2><?php the_title();?></h2>
				<?php
				$subtitle = esc_html( get_post_meta( get_the_ID(), 'timetable_subtitle', true ) );
				if ( ! empty( $subtitle ) ) {
					echo '<h5>' . $subtitle . '</h5>';
				}
				if ( have_posts() ) : while ( have_posts() ) : the_post();
						echo tt_remove_wpautop( get_the_content() );
				endwhile;
				endif;
				?>
            </main>
			<?php if ( is_active_sidebar( 'sidebar-event' ) ) : ?>
            <aside class="tt_event_page_right sb_right">
				<?php
					dynamic_sidebar( 'sidebar-event' );
				?>
            </aside>
        </div>
		<?php
			kiddy_pattern_image( 'right' );
			kiddy_footer_image();
		?>
		<?php endif; ?>
    </div>
	<?php
	get_footer();
?>
