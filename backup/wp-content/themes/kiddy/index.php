<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kiddy
 * @since Kiddy 1.0
 */

	$sb = kiddy_get_sidebars();
	$sb_class = $sb && ! empty( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] . '_sidebar' : '';
	$sb1_class = $sb && $sb['sb_layout'] == 'right' ? 'sb_right' : 'sb_left';
	get_header();

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
			<?php get_template_part( 'content', 'blog' ); ?>
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
