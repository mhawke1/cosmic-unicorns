<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Kiddy
 * @since Kiddy 1.0
 */
?>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="0" style='display:none;'>
          <defs>
            <filter id="goo">
              <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
              <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
            </filter>
          </defs>
        </svg>

        </div><!-- #main -->

		<?php
			$footer_pattern = kiddy_get_option( 'footer_pattern' );
			$footer_sidebar = is_page() ? kiddy_get_page_meta_var( array( 'footer', 'footer_sb_top' ) ) : kiddy_get_option( 'footer-sidebar-top' );
			$use_wave = kiddy_get_option( 'wave-style' ) == 1 ? true : false;

			$copyrights = kiddy_get_option( 'footer_copyrights_text' );
			$social_links = '';
			$social_links_location = kiddy_get_option( 'social_links_location' );

			$show_wpml_footer = ( kiddy_is_wpml_active()) ? true : false;
		if ( in_array( $social_links_location, array( 'bottom', 'top_bottom' ) ) ) {
			$social_links = render_kiddy_social_links();
		}
		$ret = '';
		if ( function_exists('wpml_init_language_switcher') ) {
			global $wpml_language_switcher;
			$slot = $wpml_language_switcher->get_slot( 'statics', 'footer' );	
			$template = $slot->get_model();
			$ret = $slot->is_enabled();
		}
		
			ob_start();
		if ( ! empty( $copyrights ) ) {
			echo "<div class='copyrights'>$copyrights</div>";
		}
		if ( !empty( $social_links ) || ! empty( $show_wpml_footer ) ) {
			echo "<div class='copyrights_panel'>";
				echo "<div class='copyrights_panel_wrapper'>";
					echo !empty( $social_links ) ? $social_links : "";
					$class_wpml = '';
					if(isset($template['template']) && !empty($template['template'])){
						if($template['template'] == 'wpml-legacy-vertical-list'){
							$class_wpml = 'wpml_language_switch lang_bar '. $template['template'];
						}
						else{
							$class_wpml = 'wpml_language_switch horizontal_bar '.$template['template'];
						}						
					}else{
						$class_wpml = 'lang_bar';
					}

					if ( $show_wpml_footer && !empty($ret) ) : ?>
						<div class="<?php echo esc_attr($class_wpml);?>">
							<?php 
								do_action( 'wpml_footer_language_selector'); 
							?>
						</div>
					<?php 	endif;
				echo "</div>";
			echo "</div>";
		}
			$copyrights_content = ob_get_clean();

		if ( ( ! empty( $footer_sidebar ) && is_active_sidebar( $footer_sidebar )) || ! empty( $copyrights_content ) ) {
			$footer_pattern_url = ! empty( $footer_pattern['url'] ) ? 'style="background-image: url('.esc_attr( $footer_pattern['url'] ).');"' :'';
			echo "<div class='footer_wrapper_copyright' $footer_pattern_url>";
			if ( ! empty( $footer_sidebar ) && is_active_sidebar( $footer_sidebar ) ) {
				$data_custom_color_167 = esc_attr( kiddy_Hex2RGBwithdark( kiddy_get_option( 'theme-custom-footer-color' ),1.53 ) );
				if($use_wave) {
					echo "<div class='half_sin_wrapper'><canvas class='half_sin' data-bg-color='".$data_custom_color_167."' data-line-color='".$data_custom_color_167."'></canvas></div>";
				}
			}
		}
		if ( ! empty( $footer_sidebar ) && is_active_sidebar( $footer_sidebar ) ) {
			echo "<footer class='page_footer'>";
				echo "<div class='container'>";
					echo "<div class='footer_container'>";
						$GLOBALS['footer_is_rendered'] = true;
						dynamic_sidebar( $footer_sidebar );
						unset( $GLOBALS['footer_is_rendered'] );
					echo '</div>';
				echo '</div>';
			echo '</footer>';
		}
		if ( ! empty( $copyrights_content ) ) {
			echo "<div class='copyrights_area'>";
				$data_custom_color_281 = esc_attr( kiddy_Hex2RGBwithdark( kiddy_get_option( 'theme-custom-footer-color' ),2.45 ) );
				if($use_wave){
					echo "<div class='half_sin_wrapper'><canvas class='footer_half_sin' data-bg-color='".$data_custom_color_281."' data-line-color='".$data_custom_color_281."'></canvas></div>";	
				}
				echo "<div class='container'>";
					echo ("<div class='copyrights_container'>" . $copyrights_content . "</div>");
				echo '</div>';
			echo '</div>';
		}
		if ( ( ! empty( $footer_sidebar ) && is_active_sidebar( $footer_sidebar )) || ! empty( $copyrights_content ) ) {
			echo '</div>';
		}
		?>

    </div><!-- #page -->

    <div class='scroll_top animated'></div>

	<?php
	$boxed_layout = ('0' != kiddy_get_option( 'boxed-layout' ) ) ? 'boxed' : '';
	if($boxed_layout){
		 echo '</div>';	
	} 
	wp_footer(); ?>
</body>
</html>
