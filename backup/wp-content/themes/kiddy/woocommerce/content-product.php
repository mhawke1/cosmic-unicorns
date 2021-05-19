<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class('', $product ); ?>>
	<?php
		ob_start();
			woocommerce_show_product_loop_sale_flash();
		$woo_sale = ob_get_clean();
		if (! empty( $woo_sale )){
			echo('<div class="sale-wrapper">'.  $woo_sale  . '</div>');
		}
		$img_url = get_the_post_thumbnail_url();
		$lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;

		ob_start();
			woocommerce_template_loop_rating();
		$woo_rating = ob_get_clean();

		ob_start();
			the_permalink();
		$woo_link = ob_get_clean();

		ob_start();
		if ( $lightbox_en ) {
			echo "<div class='links_popup animate'>
					<div class='link_cont'>
						<div class='link'>
							<a class='fancy' href='$img_url'><i class='fa fa-camera'></i></a>
							<div class='link-item-bounce'></div>
						</div>
						<div class='link'>
							<a href='".$woo_link."'><i class='fa fa-share'></i></a>
							<div class='link-item-bounce'></div>
						</div>
					</div>
					<div class='link-toggle-button'>
						<i class='fa fa-plus link-toggle-icon'></i>
					</div>
				</div>";
		} else {
			?>
				<a href="<?php the_permalink(); ?>" class="go_to_post"></a>
					<?php
		}
			$woo_lightbox = ob_get_clean();

		if ( ! empty( $img_url ) ) {
			$thumb_dims = array( 'width' => '250', 'height' => '250');

			$thumb_obj = bfi_thumb( $img_url,$thumb_dims, false );
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
			$thumb_url = $thumb_path_hdpi;

			$link_item = get_permalink();
			echo "	<div class='media_part'>";
			echo "		<div class='pic'>
								<img $thumb_url>
								$woo_lightbox
								<div class='hover-effect'></div>
							</div>";			
			if( $product->get_average_rating() > 0 ){
				echo("<div class='rating_cont'>".  $woo_rating  . "<div class='button-shadow'></div></div>");
			}
			echo '</div>';
		}
		?>

		<a href="<?php the_permalink(); ?>"><?php do_action( 'woocommerce_shop_loop_item_title' );
		?></a>

		<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		woocommerce_template_loop_price();
		do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li>
