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
	?>
<main>
	<div class="grid_row clearfix">
		<section class="news single">
			<div class="cws_wrapper">
				<div class="grid">
					<article class="item clearfix">
						<?php
						while ( have_posts() ) :
							the_post();
							kiddy_post_output();
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
