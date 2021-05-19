<?php
	$paged = ! empty( $_POST['paged'] ) ? (int) $_POST['paged'] : ( ! empty( $_GET['paged'] ) ? (int) $_GET['paged'] : ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ) );
	$posts_per_page = (int) get_option( 'posts_per_page' );
	$search_terms = get_query_var( 'search_terms' );

	get_header();

	$p_id = get_queried_object_id();

	$sb = kiddy_get_sidebars( $p_id );
	$sb_class = $sb && ! empty( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] . '_sidebar' : '';
	$sb1_class = $sb && $sb['sb_layout'] == 'right' ? 'sb_right' : 'sb_left';
	$footer_img_height = (int) kiddy_footer_image_height() + 35;
?>
<div class="page_content search_results <?php echo sanitize_html_class($sb_class); ?>" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.(int) $footer_img_height.'px"' : '' ;?>>
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

	$blogtype = sanitize_html_class( kiddy_get_option( 'def_blogtype' ) );
	$news_class = ! empty( $blogtype ) ? ( preg_match( '#^\d+$#', $blogtype ) ? 'news-pinterest' : "news-$blogtype" ) : 'news-medium';
	$grid_class = $news_class == 'news-pinterest' ? "grid-$blogtype isotope" : '';

	?>
    <main>
        <div class="grid_row clearfix">
			<?php
			global $wp_query;
			$total_post_count = $wp_query->found_posts;
			$max_paged = ceil( $total_post_count / $posts_per_page );
			if ( 0 === strlen( $wp_query->query_vars['s'] ) ) {
				ob_start();
				echo do_shortcode( "[cws_sc_msg_box type='info' title='" . esc_html__( 'Empty search string', 'kiddy' ) . "' text='" . esc_html__( 'Please, enter something to the search field', 'kiddy' ) . "'][/cws_sc_msg_box]" );
				get_search_form( $search_terms );
				$sc_content = ob_get_clean();
				echo do_shortcode( "[cws-widget type='text']" . $sc_content . '[/cws-widget]' );
			}
			if ( have_posts() ) {
				?>
                <section class="news news-small">
                    <div class='cws_wrapper'>
                        <div class="grid">
						<?php
							$use_pagination = $max_paged > 1;
						while ( have_posts() ) : the_post();
							$content = get_the_content();
							$content = preg_replace( '/\[.*?(\"title\":\"(.*?)\").*?\]/', '$2', $content );
							$content = preg_replace( '/\[.*?(|title=\"(.*?)\".*?)\]/', '$2', $content );
							$content = strip_tags( $content );
							$content = preg_replace( '|\s+|', ' ', $content );
							$title = get_the_title();

							$cont = '';
							$bFound = false;
							$contlen = strlen( $content );
							foreach ( $search_terms as $term ) {
								$pos = 0;
								$term_len = strlen( $term );
								do {
									if ( $contlen <= $pos ) {
										break;
									}
									$pos = stripos( $content, $term, $pos );
									if ( $pos ) {
										$start = ($pos > 50) ? $pos - 50 : 0;
										$temp = mb_substr( $content, $start, $term_len + 100 );
										$cont .= ! empty( $temp ) ? $temp . ' ... ' : '';
										$pos += $term_len + 50;
									}
								} while ($pos);
							}

							if ( strlen( $cont ) > 0 ) {
								$bFound = true;
							} else {
								$cont = mb_substr( $content, 0, $contlen < 100 ? $contlen : 100 );
								if ( $contlen > 100 ) {
									$cont .= '...';
								}
								$bFound = true;
							}
							$pattern = '#\[[^\]]+\]#';
							$replace = '';
							$cont = preg_replace( $pattern, $replace, $cont );
							$cont = preg_replace( '/('.implode( '|', $search_terms ) .')/iu', '<mark>\0</mark>', $cont );
							$permalink = esc_url( get_the_permalink() );
							$title = get_the_title();
							$title = preg_replace( '/('.implode( '|', $search_terms ) .')/iu', '<mark>\0</mark>', $title );

							echo "<article class='item small'>";
								echo ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<span><a href='$permalink'>$title</a></span>" . KIDDY_AFTER_CE_TITLE : '';
							if ( has_post_thumbnail() ) {
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full', true );

								$thumb_obj = bfi_thumb( $image[0],array( 'width' => 350, 'crop' => true ),false );
								$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
								$logo_src = $thumb_path_hdpi;

								if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									$default_attr = array(
											'class' => 'cws_img_frame alignleft noborder',
											'style' => 'margin-top:0',
										);
										the_post_thumbnail( 'thumbnail' ,$default_attr );
								}
							}
								echo "<div class='post_content'>" . apply_filters( 'the_content', $cont ) . '</div>';
							if ( has_tag() ) {
								echo "<div class='post_tags'>";
								the_tags( "<i class='fa fa-tag'></i>", KIDDY_V_SEP, '' );
								echo '</div>';
							}
							if ( has_category() ) {
								echo "<div class='post_categories'><i class='fa fa-bookmark'></i>";
								the_category( KIDDY_V_SEP );
								echo '</div>';
							}
								$button_word = esc_html__( 'Read More', 'kiddy' );
								echo "<div class='right_alight'><a href='$permalink' class='cws_button small'>".$button_word.'</a></div>';
							echo '</article>';
								endwhile;
								wp_reset_postdata();
							?>
						</div></div></section>
				<?php
				if ( $use_pagination ) {
					kiddy_pagination( $paged,$max_paged );
				}
			} else {
				ob_start();
				echo do_shortcode( "[cws_sc_msg_box type='info' title='" . esc_html__( 'No search Results', 'kiddy' ) . "' text='" . esc_html__( 'There are no posts matching your query', 'kiddy' ) . "'][/cws_sc_msg_box]" );
				get_search_form( $search_terms );
				$sc_content = ob_get_clean();
				echo do_shortcode( "[cws-widget type='text']" . $sc_content . '[/cws-widget]' );
			}
			?>
        </div>
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
