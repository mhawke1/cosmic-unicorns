<?php
	get_header();

	$p_id = get_queried_object_id();

	$sb = kiddy_get_sidebars( $p_id );
	$sb_class = $sb && ! empty( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] . '_sidebar' : '';
	$sb1_class = $sb && $sb['sb_layout'] == 'right' ? 'sb_right' : 'sb_left';
	$footer_img_height = (int) kiddy_footer_image_height() + 35;
?>

<div class="page_content <?php echo sanitize_html_class($sb_class); ?>" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.$footer_img_height.'px"' : '' ;?>>
	<?php

	kiddy_pattern_image( 'left' );

	if ( $sb && $sb['sb_exist'] ) {
		echo "<div class='container'>";
		if ( $sb['sb1_exists'] ) {
			echo "<aside class='$sb1_class'>";
			dynamic_sidebar( $sb['sidebar1'] );
			echo '</aside>';
		}
		if ( $sb['sb2_exists'] ) {
			echo "<aside class='sb_right'>";
			dynamic_sidebar( $sb['sidebar2'] );
			echo '</aside>';
		}
	}

	$section_class = 'news single';

	?>
    <main>
        <div class="grid_row clearfix">
			<section class="<?php echo(esc_attr($section_class)); ?>">
                <div class="cws_wrapper">
                    <div class="grid">
                        <article class="item clearfix attach">
						<?php
						while ( have_posts() ) :
							the_post();
							$c_post = get_post( get_the_id() );
							$title = esc_html( get_the_title() );
							$permalink = get_permalink();

							echo "<div class='post_info_top'>";
							?>
								<div class="date">
									<?php
									$date = get_the_time( get_option( 'date_format' ) );
									$first_word_boundary = strpos( $date, ' ' );

									if ( $first_word_boundary ) {
										$first_word_full = esc_attr( mb_substr( $date, 0, $first_word_boundary ) );
										$first_word_short = esc_html( mb_substr( $date, 0, 3 ) );
										echo ("<div class='date-cont'><span class='day'>". esc_html( str_replace( ',','',mb_substr( $date, $first_word_boundary + 1, 2 ) ) ) .
														"</span><span class='month' title='$first_word_full'><span>$first_word_short</span></span><span class='year'>". esc_html( mb_substr( $date, -4 ) ) ."</span><i class='springs'></i></div>");
									} else {
										echo (get_the_time( get_option( 'date_format' ) ));
									}
									?>
                                    </div>

								<?php

								$author = esc_html( get_the_author() );
								$special_pf = kiddy_is_special_post_format();
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


								$comments_n = get_comments_number();
								$permalink = get_permalink();
								if ( $comments_n != 0 ) {
									$permalink .= '#comments_part';
									echo "<div class='comments_link'><a href='$permalink'><i class='fa fa-comment'></i> $comments_n</a></div>";
								}
								echo '</div>';
								?>

                                <div class="media_info_wrapper">
								<div class="media_part">
									<div class="pic">
										<?php
											$thumbnail_dims = kiddy_get_post_thumbnail_dims();
											$thumbnail = wp_get_attachment_image_src( get_the_id(), 'full' );
											$thumbnail = ! empty( $thumbnail ) ? $thumbnail[0] : '';

											$thumb_obj = bfi_thumb( $thumbnail,$thumbnail_dims, false );
											$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
											$thumb_url = $thumb_path_hdpi;
											$thumbnail = esc_url( $thumbnail );
											echo '<img '. $thumb_url ." alt />
                                                <div class='hover-effect'></div>
                                                <div class='links_popup'>
                                                    <div class='link_cont'>
                                                        <div class='link'>
                                                            <a class='fancy' href='$thumbnail'><i class='fa fa-camera'></i></a>
                                                        </div>
                                                    </div>
                                                </div>
												";
										?>
                                        </div>
                                    </div>
                                </div>

                                <div class="post_info_header">
									<?php
									echo KIDDY_BEFORE_CE_TITLE . "<span>$title</span>" . KIDDY_AFTER_CE_TITLE;
									?>
                                </div>

							<?php
							$content = get_the_content();
							if ( ! empty( $content ) ) { echo "<div class='post_content'>" . apply_filters( 'the_content', $content ) . '</div>'; }
							kiddy_page_links();

							/* ATTACHMENTS NAVIGATION */

							?>

							<?php
							ob_start();
							previous_image_link( false, "<span class='prev'><span>" . esc_html__( 'Prev', 'kiddy' ) . '</span></span>' );
							$prev_img_link = ob_get_clean();
							ob_start();
							next_image_link( false, "<span class='next'><span>" . esc_html__( 'Next', 'kiddy' ) . '</span></span>' );
							$next_img_link = ob_get_clean();
							if ( ! empty( $prev_img_link ) || ! empty( $next_img_link ) ) {
								echo "<div class='clearfix'></div>";
								echo "<nav class='carousel_nav_panel clearfix'>";
									echo ! empty( $prev_img_link ) ? "<div class='prev_section'>$prev_img_link</div>" : '';
									echo ! empty( $next_img_link ) ? "<div class='next_section'>$next_img_link</div>" : '';
								echo '</nav>';
							}

							/* \ATTACHMENTS NAVIGATION */

							endwhile;
							wp_reset_postdata();
						?>
                        </article>
                    </div>
                </div>
            </section>
        </div>
		<?php comments_template(); ?>
    </main>
	<?php
		if ($sb && $sb['sb_exist']){
			echo('</div>');
		}
		kiddy_pattern_image( 'right' );
		kiddy_footer_image();
	?>
</div>

<?php

get_footer();
?>
