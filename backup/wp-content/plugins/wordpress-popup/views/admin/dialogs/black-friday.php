<?php
/**
 * Black Friday modal.
 *
 * @since 4.3.5
 *
 * @package hustle
 */

$banner_1x = self::$plugin_url . 'assets/images/hustle-black-friday-modal.png';
$banner_2x = self::$plugin_url . 'assets/images/hustle-black-friday-modal@2x.png';
?>

<div class="sui-modal sui-modal-lg">

	<div
		role="dialog"
		id="hustle-dialog--black-friday-sale"
		class="sui-modal-content"
		aria-modal="true"
		aria-labelledby="hustle-dialog--black-friday-sale-title"
		aria-describedby="hustle-dialog--black-friday-sale-desc"
	>

		<div class="sui-box">

			<div class="sui-box-header sui-content-center sui-flatten sui-spacing-top--60">

				<button class="sui-button-icon sui-button-float--right hustle-modal-close" data-modal-close>
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'hustle' ); ?></span>
				</button>

				<figure class="sui-box-banner" role="banner" aria-hidden="true">
					<?php
					if ( ! $this->is_branding_hidden ) :
						echo $this->render_image_markup( $banner_1x, $banner_2x, 'sui-image sui-image-center' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					endif;
					?>
				</figure>

			</div>

			<div class="sui-box-body sui-spacing-top--0 sui-spacing-sides--50">

				<div id="hui-black-modal-content" class="sui-border-frame">

					<h3 id="hustle-dialog--black-friday-sale-title" class="hui-black-title"><?php esc_html_e( 'Hustle Pro 60% OFF', 'hustle' ); ?></h3>

					<p id="hustle-dialog--black-friday-sale-desc" class="sui-description"><?php esc_html_e( 'For all your popup and optin needs.', 'hustle' ); ?></p>

					<p class="sui-screen-reader-text" style="margin-bottom: 0;"><?php esc_html_e( 'Before $60 per year, now $24 per year. A total of 8 months free!', 'hustle' ); ?></p>

					<div class="hui-black-price" aria-hidden="true">

						<p>
							<del>$60</del>
							<ins>$24</ins>
							<span>/<?php esc_html_e( 'year', 'hustle' ); ?></span>
						</p>

						<p><?php esc_html_e( 'Total of 8 months free!', 'hustle' ); ?></p>

					</div>

					<p>
						<a
							href="https://premium.wpmudev.org/project/hustle/?coupon=BF2020HUSTLE&checkout=0&utm_source=hustle&utm_medium=plugin&utm_campaign=hustle_bf2020modal_cta"
							target="_blank"
							class="sui-button sui-button-purple"
						>
							<?php esc_html_e( 'Get 60% Off Hustle Pro', 'hustle' ); ?>
						</a>
					</p>

					<h4 class="hui-black-benefits-title"><?php esc_html_e( 'Hustle Pro Benefits', 'hustle' ); ?></h4>

					<ul class="hui-black-benefits-list">

						<li>
							<span class="sui-icon-check sui-sm" aria-hidden="true"></span>
							<?php esc_html_e( 'Unlimited Popups', 'hustle' ); ?>
						</li>

						<li>
							<span class="sui-icon-check sui-sm" aria-hidden="true"></span>
							<?php esc_html_e( 'Unlimited Optins', 'hustle' ); ?>
						</li>

						<li>
							<span class="sui-icon-check sui-sm" aria-hidden="true"></span>
							<?php esc_html_e( 'Unlimited Slide-ins', 'hustle' ); ?>
						</li>

						<li>
							<span class="sui-icon-check sui-sm" aria-hidden="true"></span>
							<?php esc_html_e( '24/7 Support', 'hustle' ); ?>
						</li>

					</ul>

				</div>

			</div>

			<div class="sui-box-footer sui-content-center sui-flatten">

				<a
					href="https://premium.wpmudev.org/project/hustle/?coupon=BF2020HUSTLE&checkout=0&utm_source=hustle&utm_medium=plugin&utm_campaign=hustle_bf2020modal_checkallplansbutton"
					target="_blank"
					class="sui-button sui-button-ghost"
				>
					<span class="sui-icon-open-new-window sui-sm" aria-hidden="true"></span>
					<?php esc_html_e( 'Check All Plans', 'hustle' ); ?>
				</a>

			</div>

		</div>

	</div>

</div>
