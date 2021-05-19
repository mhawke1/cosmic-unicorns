<?php
	get_header ();

	$sb = kiddy_get_sidebars();
	$sb_class = $sb && !empty( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] . '_sidebar' : '';
	$sb1_class = $sb && $sb['sb_layout'] == 'right' ? 'sb_right' : 'sb_left';

	$taxonomy = get_query_var( 'taxonomy' );
	$term_slug = get_query_var( $taxonomy );
	$footer_img_height = kiddy_footer_image_height() + 35;

?>
<div class="page_content <?php echo sanitize_html_class($sb_class); ?>" <?php echo isset( $footer_img_height ) ? 'style="padding-bottom:'.$footer_img_height.'px"' : '' ;?>>
	<?php

	kiddy_pattern_image ('left');

	if ( $sb && $sb['sb_exist'] ){
		echo "<div class='container'>";
		if ( $sb['sb1_exists'] ){
			echo "<aside class='$sb1_class'>";
			dynamic_sidebar( $sb['sidebar1'] );
			echo "</aside>";
		}
		if ( $sb['sb2_exists'] ){
			echo "<aside class='sb_right'>";
			dynamic_sidebar( $sb['sidebar2'] );
			echo "</aside>";
		}
	}

	?>
	<main>
		<div class="grid_row">
			<?php
				switch( $taxonomy ){
					case "cws_portfolio_cat":
						echo kiddy_cws_portfolio( array( 'columns' => '4', 'categories' => $term_slug, 'mode' => 'grid' ) );
						break;
					case "cws_staff_member_department":
						echo kiddy_cws_ourteam( array( 'mode' => 'grid', 'categories' => $term_slug ) );
						break;
					case "cws_staff_member_position":
						echo kiddy_cws_ourteam( array( 'mode' => 'grid', 'tags' => $term_slug ) );
						break;
				}
			?>
		</div>
	</main>
	<?php
		if ($sb && $sb['sb_exist']) {
			echo("</div>");
		}
		kiddy_pattern_image ('right');
		kiddy_footer_image ();
	?>
</div>

<?php

get_footer ();
?>