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

	$meta = get_post_meta( $p_id, 'cws_mb_post' );
	$meta = isset( $meta[0] ) ? $meta[0] : array();

	extract( shortcode_atts( array(
		'carousel' => '0',
		'show_related' => '0',
		'related_projects_options' => array(),
		'enable_hover' => '0',
		'link_options_fancybox' => '0',
	), $meta) );

	$related_projects_title = isset( $meta['rpo_title'] ) ? $meta['rpo_title'] : '';
	$related_projects_cols = isset( $meta['rpo_cols'] ) ? (int) $meta['rpo_cols'] : '4';
	$related_projects_count = isset( $meta['rpo_items_count'] ) ? (int) $meta['rpo_items_count'] : '4';

	$cats = get_the_terms( $p_id, 'cws_portfolio_cat' );
	$cats = $cats ? $cats : array(); /* if get_the_terms returns false */
	$cat_slugs = array();
	foreach ( $cats as $cat ) {
		$cat_slugs[] = $cat->slug;
	}
	$has_cats = ! empty( $cat_slugs );

	$related_posts = array();
	$has_related = false;

	if ( $has_cats ) {
		$query_args = array(
			'post_type' => 'cws_portfolio',
		);
		$query_args['tax_query'] = array( array(
			'taxonomy' => 'cws_portfolio_cat',
			'field' => 'slug',
			'terms' => $cat_slugs,
		),
		);
		$query_args['post__not_in'] = array( $p_id );
		if ( $related_projects_count ) {
			$query_args['posts_per_page'] = $related_projects_count;
		}
		$q = new WP_Query( $query_args );
		$related_posts = $q->posts;
		if ( count( $related_posts ) > 0 ) {
			$has_related = true;
		}
	}

	$use_related_carousel = $carousel === '1' && $has_related;
	$show_related_items  = $show_related === '1' && $has_related;

	$section_class = 'cws_portfolio single';
	$section_class .= $use_related_carousel ? ' related' : ''

	?>
<main>
	<div class="grid_row">
		<section class="<?php echo(esc_attr($section_class)); ?>">
			<div class="cws_wrapper">
				<div class="cws_portfolio_items grid">
					<article class="item">
					<?php
						$dims = cws_get_portfolio_thumbnail_dims();
						$chars_count = cws_portfolio_get_chars_count();
						while ( have_posts() ) :
							the_post();
							render_cws_portfolio_item( $p_id, $dims, $chars_count );
						endwhile;
						wp_reset_postdata();
					?>
					</article>
				</div>
			</div>
				<?php
				if ( $use_related_carousel ) {
					$related_ids = array();
					foreach ( $related_posts as $related_post ) {
						$related_ids[] = $related_post->ID;
					}
					array_unshift( $related_ids, $p_id );
					$ajax_data = array(
						'current' => $p_id,
						'initial' => $p_id,
						'related_ids' => $related_ids,
					);
					echo "<input type='hidden' id='cws_portfolio_single_ajax_data' value='" . esc_attr( json_encode( $ajax_data ) ) . "' />";
					?>
	<div class='carousel_nav_panel clearfix'>
		<div class='prev_section'>
			<span class='prev'><span><?php esc_html_e( 'Prev', 'kiddy' ); ?></span></span>
		</div>
		<div class='next_section'>
			<span class='next'><span><?php esc_html_e( 'Next', 'kiddy' ); ?></span></span>
		</div>
	</div>
						<?php
				}
				?>
	</section>
</div>
		<?php
		if ( $show_related_items ) {
			$mode = $q->post_count > $related_projects_cols ? 'carousel' : 'grid';
			$sc_atts = array(
				'title' => $related_projects_title,
				'columns' => $related_projects_cols,
				'categories' => implode( ',', $cat_slugs ),
				'mode' => $mode,
				'items_per_page' => $related_projects_count,
				'exclude' => array( $p_id ),
				'disable_pagination' => true,
			);
			$related_projects_section = kiddy_cws_portfolio( $sc_atts );
			echo ! empty( $related_projects_section ) ? "<div class='grid_row related_projects'>$related_projects_section</div>" : '';
		}
		?>
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
