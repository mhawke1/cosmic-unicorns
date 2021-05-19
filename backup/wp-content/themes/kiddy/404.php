<?php
	get_header();
	$footer_img_height = (int) kiddy_footer_image_height() + 35;
?>
<div class="page_content" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.$footer_img_height.'px"' : '' ;?>>
	<?php
		$home_url = esc_url( get_home_url() );
		kiddy_pattern_image( 'left' );
	?>
    <main>
        <div class="grid_row clearfix">
            <div class="grid_col grid_col_12">
                <div class="ce">
                    <div class="not_found">
                        <div class="banner_404">
                            4<span>0</span>4
                        </div>
                        <div class="desc_404">
                            <div class="msg_404">
								<?php
									echo '<span>' . esc_html__( 'Sorry', 'kiddy' ) . '</span>' . '<br />' . esc_html__( 'page not found', 'kiddy' );
								?>
                            </div>
                            <div class="link">
								<?php
									echo esc_html__( 'Please, proceed to our ', 'kiddy' ) . "<a href='$home_url'>" . esc_html__( 'Home page', 'kiddy' ) . '</a>';
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<?php
		kiddy_pattern_image( 'right' );
		kiddy_footer_image();
	?>
</div>
<?php
get_footer();
?>
