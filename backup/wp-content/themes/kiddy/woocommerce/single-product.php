<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version	 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
get_header( 'shop' );
ob_start();
do_action( 'woocommerce_sidebar' );
$woo_sidebar = ob_get_clean();
$woo_sb_position = kiddy_get_option('def-woo-layout');
$class_container = 'page_content' . ( ! empty( $woo_sidebar ) && ($woo_sb_position != 'none') ? ' single_sidebar' : '' );

$footer_img_height = (int) kiddy_footer_image_height() + 35;

?>

	<div class="<?php echo(esc_attr($class_container)); ?>" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.$footer_img_height.'px"' : '' ;?>>

			<?php
				kiddy_pattern_image( 'left' );
			?>

			<div class="container">

				<?php
					echo ! empty( $woo_sidebar ) && ($woo_sb_position == 'left') ? "<aside class='sb_left'>" .  $woo_sidebar  . '</aside>' : '';

					echo ! empty( $woo_sidebar ) && ($woo_sb_position == 'right') ? "<aside class='sb_right'>" .  $woo_sidebar  . '</aside>' : '';
				?>

				<main>

					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>

				</main>
			</div>
			<?php kiddy_footer_image();
			kiddy_pattern_image( 'right' ); ?>
	</div>

<?php get_footer( 'shop' ); ?>
