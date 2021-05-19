<?php
/*
Plugin Name: CWS Portfolio and Staff
Description: internal use for CWSThemes only.
Text Domain: cws-portf-staff
Version: 1.0.3
*/

/**
 * Load plugin textdomain.
 */
function cws_load_textdomain() {
  load_plugin_textdomain( 'cws-portf-staff', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'cws_load_textdomain' );


add_action( "init", "register_cws_portfolio_cat" );
add_action( "init", "register_cws_portfolio" );

function register_cws_portfolio_cat(){
	$portfolio_slug = kiddy_get_option( 'portfolio_slug' );
	$portfolio_slug = empty( $portfolio_slug ) ? 'portfolio' : $portfolio_slug;
	register_taxonomy( 'cws_portfolio_cat', 'cws_portfolio', array(
		'hierarchical' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => $portfolio_slug . '_cat' )
		));
}

function register_cws_portfolio (){
	$labels = array(
		'name' => esc_html__( 'Portfolio items', 'cws-portf-staff' ),
		'singular_name' => esc_html__( 'Portfolio item', 'cws-portf-staff' ),
		'menu_name' => esc_html__( 'Portfolio', 'cws-portf-staff' ),
		'add_new' => esc_html__( 'Add Portfolio Item', 'cws-portf-staff' ),
		'add_new_item' => esc_html__( 'Add New Portfolio Item', 'cws-portf-staff' ),
		'edit_item' => esc_html__('Edit Portfolio Item', 'cws-portf-staff' ),
		'new_item' => esc_html__( 'New Portfolio Item', 'cws-portf-staff' ),
		'view_item' => esc_html__( 'View Portfolio Item', 'cws-portf-staff' ),
		'search_items' => esc_html__( 'Search Portfolio Item', 'cws-portf-staff' ),
		'not_found' => esc_html__( 'No Portfolio Items found', 'cws-portf-staff' ),
		'not_found_in_trash' => esc_html__( 'No Portfolio Items found in Trash', 'cws-portf-staff' ),
		'parent_item_colon' => '',
		);
	$portfolio_slug = kiddy_get_option( 'portfolio_slug' );
	$portfolio_slug = empty( $portfolio_slug ) ? 'portfolio' : $portfolio_slug;
	register_post_type( 'cws_portfolio', array(
		'label' => esc_html__( 'Portfolio items', 'cws-portf-staff' ),
		'labels' => $labels,
		'public' => true,
		'rewrite' => array( 'slug' => sanitize_title($portfolio_slug) ),
		'capability_type' => 'post',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail'
			),
		'menu_position' => 23,
		'menu_icon' => 'dashicons-format-gallery',
		'taxonomies' => array( 'cws_portfolio_cat' ),
		'has_archive' => true
	));
}

function cws_get_portfolio_thumbnail_dims ( $columns = null, $p_id = null, $forcibly_is_single = null ){
	$image_data = wp_get_attachment_metadata( get_post_thumbnail_id( $p_id ) );
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	$sb = kiddy_get_sidebars( $p_id );
	$sb_layout = $sb['sb_layout_class'];
	$single = isset( $forcibly_is_single ) ? $forcibly_is_single : is_single();
	$width_correction = 22;
	$height_correction = 22;
	$dims = array( 'width' => 0, 'height' => 0, 'crop' => true );

	if ($single && !empty($image_data)){
			if ( $sb_layout == 'single' ){
				$image_data['width']<870 ? $dims['width'] = 0 : $dims['width'] = 870;
			}
			else if ( $sb_layout == 'double' ){
				$image_data['width']<570 ? $dims['width'] = 0 : $dims['width'] = 570;
			}
			else{
				$image_data['width']<1170 ? $dims['width'] = 0 : $dims['width'] = 1170;
			}

	}
	else{
		switch ($columns){
			case "1":
				if ( $sb_layout == 'single' ){
					$dims['width'] = 870;
					/*$dims['height'] =  490;*/
				}
				else if ( $sb_layout == 'double' ){
					$dims['width'] = 570;
					/*$dims['height'] =  321;*/
				}
				else{
					$dims['width'] = 1170;
					/*$dims['height'] = 659;*/
				}
				break;
			case '2':
				if ( $sb_layout == 'single' ){
					$dims['width'] = 420;
					/*$dims['height'] =  420;*/
				}
				else if ( $sb_layout == 'double' ){
					$dims['width'] = 270;
					/*$dims['height'] =  270;*/
				}
				else{
					$dims['width'] = 570;
					/*$dims['height'] = 570;*/
				}
				break;
			case '3':
				if ( $sb_layout == 'single' ){
					$dims['width'] = 270;
					/*$dims['height'] =  270;*/
				}
				else if ( $sb_layout == 'double' ){
					$dims['width'] = 270;
					/*$dims['height'] =  270;*/
				}
				else{
					$dims['width'] = 370;
					/*$dims['height'] = 370;*/
				}
				break;
			case '4':
				$dims['width'] = 270;
				/*$dims['height'] =  270;*/
				break;
			default:
				if ( $sb_layout == 'single' ){
					$dims['width'] = 870;
					/*$dims['height'] =  490;*/
				}
				else if ( $sb_layout == 'double' ){
					$dims['width'] = 570;
					/*$dims['height'] =  321;*/
				}
				else{
					$dims['width'] = 1170;
					/*$dims['height'] = 659;*/
				}
		}
	}
	$dims['width'] = $dims['width'] != 0 ? $dims['width'] - $width_correction : $dims['width'];
	$dims['height'] = $dims['height'] != 0 ? $dims['height'] - $height_correction : $dims['height'];
	return $dims;
}

function cws_portfolio_get_chars_count ( $cols = null, $p_id = null ){
	$number = 155;
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	$sb = kiddy_get_sidebars( $p_id );
	$sb_layout = isset( $sb['sb_layout_class'] ) ? $sb['sb_layout_class'] : '';
	switch ( $cols ){
		case '1':
			switch ( $sb_layout ){
				case 'double':
					$number = 130;
					break;
				case 'single':
					$number = 200;
					break;
				default:
					$number = 300;
			}
			break;
		case '2':
			switch ( $sb_layout ){
				case 'double':
					$number = 55;
					break;
				case 'single':
					$number = 90;
					break;
				default:
					$number = 130;
			}
			break;
		case '3':
			switch ( $sb_layout ){
				case 'double':
					$number = 60;
					break;
				case 'single':
					$number = 60;
					break;
				default:
					$number = 70;
			}
			break;
		case '4':
			switch ( $sb_layout ){
				case 'double':
					$number = 55;
					break;
				case 'single':
					$number = 55;
					break;
				default:
					$number = 55;
			}
			break;
	}
	return $number;
}

function cws_get_portfolio_cat_slugs (){
	$cat_slugs = array();
	$cat_objects = get_terms( "cws_portfolio_cat" );
	foreach ( $cat_objects as $cat_obj ) {
		$cat_slugs[] = $cat_obj->slug;
	}
	return $cat_slugs;
}

function render_cws_portfolio( $q, $columns = 4, $p_id = null ){
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	$gallery_id = uniqid( 'cws-portfolio-gallery-' );
	$chars_count = cws_portfolio_get_chars_count( $columns, $p_id );
	$portcontent = $q->query_vars['portcontent'];
	while( $q->have_posts() ):

		$q->the_post();
		$pid = get_the_id();
		$forcibly_is_single = $p_id == $pid;
		$dims = cws_get_portfolio_thumbnail_dims( $columns, $p_id, $forcibly_is_single );
		echo "<article class='item'>";
			render_cws_portfolio_item( $pid, $dims, $chars_count, $gallery_id , null , $portcontent);
		echo "</article>";
	endwhile;
	wp_reset_query();
}

function render_cws_portfolio_item( $pid, $dims, $chars_count, $gallery_id = '', $forcibly_is_single = null , $portcontent = 'exerpt'){
	$post = get_post( $pid );
	$p_meta = get_post_meta( $pid, 'cws_mb_post' );
	$p_meta = isset( $p_meta[0] ) ? $p_meta[0] : array();
	$single = isset( $forcibly_is_single ) ? $forcibly_is_single : is_single( $pid );
	$title = get_the_title( $pid );
	$permalink = get_the_permalink( $pid );

	$p_category_terms = wp_get_post_terms( $pid, 'cws_portfolio_cat' );
	if($portcontent == 'categories'){
		$p_cats = "";
		for ( $i=0; $i<count( $p_category_terms ); $i++ ){
			$p_category_term = $p_category_terms[$i];
			$p_cat_permalink = get_term_link( $p_category_term->term_id, 'cws_portfolio_cat' );
			$p_cat_name = $p_category_term->name;
			$p_cats .= "<a href='$p_cat_permalink'>$p_cat_name</a>";
			$p_cats .= $i < count( $p_category_terms ) - 1 ? esc_html__( ", ", 'cws-portf-staff' ) : "";
		}
	}

	if ( has_post_thumbnail( $pid ) ){
		$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $pid ) );

		$thumb_obj = bfi_thumb($featured_img_url, $dims, false);
		$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". $thumb_obj[0] ."' data-at2x='" . $thumb_obj[3]['retina_thumb_url'] ."'" : " src='". $thumb_obj[0] . "' data-no-retina";
		$thumb_url = $thumb_path_hdpi;
		echo "<div class='media_part'>";
			echo "<div class='pic'>";
				echo "<img $thumb_url alt />";
				if ( isset( $p_meta['enable_hover'] ) && !empty( $p_meta['enable_hover'] )){

					echo "<div class='hover-effect'></div>";
					$custom_url = isset($p_meta['link_options_url']) && !empty( $p_meta['link_options_url'] );

					$fancybox = isset($p_meta['link_options_fancybox']) && !empty( $p_meta['link_options_fancybox'] );

					$url = $custom_url ? $p_meta['link_options_url'] : $featured_img_url;

					$icon = $fancybox ? ( $custom_url ? 'magic' : ( !empty( $gallery_id ) ? 'camera' : 'plus' ) ) : 'share';
					echo "	<div class='links_popup'>
								<div class='link_cont'>
									<div class='link'>
										<a ".($fancybox ? "class='fancy'" : "")."  href='$url' ".(($fancybox && $custom_url) ? 'data-fancybox-type="iframe"' : '')."  " . ( $fancybox && ( !empty( $gallery_id ) ) ? " data-fancybox-group='$gallery_id'" : "" ) . "><i class='fa fa-$icon'></i></a>
									</div>
								</div>
							</div>
						";
				}
			echo "</div>";
		echo "</div>";
	}

	echo !$single && !empty( $title ) ? "<div class='title_part'><a href='$permalink'>$title</a></div>".(($portcontent == 'exerpt' && (!empty( $post->post_excerpt ) || !empty( $post->post_content ))) || ($portcontent == 'categories' && !empty($p_cats)) ? "<div class='separate_part'><div class='separate'></div></div>" : "" ) : "";

	$content = "";
	if ( $single ){
		$content = apply_filters( 'the_content', $post->post_content );
	}
	else if($portcontent == 'exerpt'){
		$content = !empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
		$content = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes( strip_tags( $content ) ) ) );
		$content = wptexturize( $content );
		$content = substr( $content, 0, $chars_count );
	}else if($portcontent == 'categories'){
		$content = !empty($p_cats) ? '<div class="categories">'.$p_cats.'</div>' : '';
	}
	echo !empty( $content ) ? "<div class='desc_part'>$content</div>" : "";
}

/* Portfolio ajax */

add_action( "wp_ajax_cws_portfolio_pagination", "cws_portfolio_pagination" );
add_action( "wp_ajax_nopriv_cws_portfolio_pagination", "cws_portfolio_pagination" );

function cws_portfolio_pagination (){
	$data = $_POST['data'];
	extract( shortcode_atts( array(
		'p_id' => null,
		'cols' => '4',
		'mode' => 'grid_with_filter',
		'cats' => array(),
		'exclude' => array(),
		'filter' => 'all',
		'portcontent' => 'exerpt',
		'posts_per_page' => get_option( 'posts_per_page' ),
		'url' => ''
	), $data));

	if ( empty( $url ) ) return;
	$match = preg_match( "#paged?(=|/)(\d+)#", $url, $matches );
	$paged = $match ? $matches[2] : 1;

	$query_args = array(
		'post_type' => 'cws_portfolio',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'portcontent' => $portcontent,
		'posts_per_page' => $posts_per_page,
		'paged' => $paged
	);

	$categories = array();

	if ( $mode == "grid_with_filter" ){
		if ( $filter == "all" ){
			if ( !empty( $cats ) ){
				$categories = $cats;
			}
		}
		else{
			$categories[] = $filter;
		}
	}
	else{
		if ( !empty( $cats ) ){
			$categories = $cats;
		}
	}

	$tax_query = array();
	if ( !empty( $categories ) ){
		$tax_query[] = array(
			'taxonomy' => 'cws_portfolio_cat',
			'field' => 'slug',
			'terms' => $categories
		);
	}

	if ( !empty( $tax_query ) ) $query_args['tax_query'] = $tax_query;

	if ( !empty( $exclude ) ){
		$query_args["post__not_in"] = $exclude;
	}

	$q = new WP_Query( $query_args );

	echo "<div class='cws_ajax_response'>";
		render_cws_portfolio( $q, $cols, $p_id );
		$max_paged = ceil( $q->found_posts / $posts_per_page );
		if ( $max_paged > 1 ){
			kiddy_pagination( $paged, $max_paged );
		}
	echo "</div>";

	die();

}

add_action( "wp_ajax_cws_portfolio_filter", "cws_portfolio_filter" );
add_action( "wp_ajax_nopriv_cws_portfolio_filter", "cws_portfolio_filter" );

function cws_portfolio_filter (){
	$data = $_POST['data'];
	extract( shortcode_atts( array(
		'p_id' => null,
		'cols' => '4',
		'cats' => array(),
		'exclude' => array(),
		'filter' => 'all',
		'portcontent' => 'exerpt',
		'posts_per_page' => get_option( 'posts_per_page' ),
	), $data));

	$query_args = array(
		'post_type' => 'cws_portfolio',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'portcontent' => $portcontent,
		'posts_per_page' => $posts_per_page,
	);

	$categories = array();

	if ( $filter == "all" ){
		if ( !empty( $cats ) ){
			$categories = $cats;
		}
	}
	else{
		$categories[] = $filter;
	}

	$tax_query = array();
	if ( !empty( $categories ) ){
		$tax_query[] = array(
			'taxonomy' => 'cws_portfolio_cat',
			'field' => 'slug',
			'terms' => $categories
		);
	}

	if ( !empty( $tax_query ) ) $query_args['tax_query'] = $tax_query;

	if ( !empty( $exclude ) ){
		$query_args["post__not_in"] = $exclude;
	}

	$q = new WP_Query( $query_args );

	echo "<div class='cws_ajax_response'>";
		render_cws_portfolio( $q, $cols, $p_id );
		$max_paged = ceil( $q->found_posts / $posts_per_page );
		if ( $max_paged > 1 ){
			kiddy_pagination( 1, $max_paged );
		}
	echo "</div>";

	die();

}

add_action( "wp_ajax_cws_portfolio_single", "cws_portfolio_single" );
add_action( "wp_ajax_nopriv_cws_portfolio_single", "cws_portfolio_single" );

function cws_portfolio_single(){
	$data = isset( $_POST['data'] ) ? $_POST['data'] : array();
	extract( shortcode_atts( array(
			'initial_id' => '',
			'requested_id' => ''
		), $data));
	if ( empty( $initial_id ) || empty( $requested_id ) ) die();
	$dims = cws_get_portfolio_thumbnail_dims( '1', $requested_id, true );
	$chars_count = cws_portfolio_get_chars_count( '1', $initial_id, true );

	echo "<div class='cws_ajax_response'>";
		echo "<article class='item'>";
			render_cws_portfolio_item( $requested_id, $dims, $chars_count, null, true );
		echo "</article>";
	echo "</div>";
	die();
}

/* \Portfolio ajax */

/* Full width portfolio */

function cws_portfolio_fw_settings_init (){
	$GLOBALS['cws_portfolio_fw_settings'] = array();
	$GLOBALS['cws_portfolio_fw_settings']['screen_width'] = 1920;
	$GLOBALS['cws_portfolio_fw_settings']['height_to_width_ratio'] = 0.78;
}
add_action( 'init', 'cws_portfolio_fw_settings_init' );

function get_cws_portfolio_fw_thumb_dims ( $columns = 1 ){
	$thumb_dims = array();
	global $cws_portfolio_fw_settings;
	$thumb_dims['width'] = $cws_portfolio_fw_settings['screen_width'] / (int)$columns;
	$thumb_dims['height'] = $thumb_dims['width'] * $cws_portfolio_fw_settings['height_to_width_ratio'];
	return $thumb_dims;
}

function render_cws_portfolio_fw_item ( $pid, $dims, $multiple = false, $gallery_id = '' ){
	$attachment= wp_get_attachment_image_src( get_post_thumbnail_id( $pid ), 'full' );
	$attachment_url = $attachment[0];
	$thumb_url = bfi_thumb( $attachment_url, $dims );

	$p_title = get_the_title( $pid );
	$p_permalink = get_permalink( $pid );
	$p_cats = "";
	$p_category_terms = wp_get_post_terms( $pid, 'cws_portfolio_cat' );
	for ( $i=0; $i<count( $p_category_terms ); $i++ ){
		$p_category_term = $p_category_terms[$i];
		$p_cat_permalink = get_permalink( $p_category_term->term_id );
		$p_cat_name = $p_category_term->name;
		$p_cats .= "<a href='$p_cat_permalink'>$p_cat_name</a>";
		$p_cats .= $i < count( $p_category_terms ) - 1 ? esc_html__( ", ", 'cws-portf-staff' ) : "";
	}

	$post_info = "";
	$post_info .= !empty( $p_title ) ? "<div class='title'>$p_title</div>" : "";
	$post_info .= !empty( $p_cats ) ? "<div class='cats'>$p_cats</div>" : "";
	$links = "";
	$links .= "<a href='$attachment_url' class='fancy'><i class='fa fa-plus'></i></a>";
	$links .= "<a href='$p_permalink'><i class='fa fa-share'></i></a>";
	$links .= $multiple ? "<a href='$attachment_url' class='fancy' data-fancybox-group='$gallery_id'><i class='fa fa-camera'></i></a>" : "";

	echo "<div class='item'>";
		echo "<div class='pic_alt'>";
			echo "<img src='$thumb_url' alt />";
			echo "<div class='hover-effect'></div>";
			echo "<div class='item_content'>";
				echo !empty( $post_info ) ? "<div class='post_info_wrapper'><div class='post_info'>$post_info</div></div>" : "";
				echo !empty( $links ) ? "<div class='links_popup'>
											<div class='link_cont'>
												<div class='link'>
													$links
												</div>
											</div>
										</div>" : "";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}

/* \Full width portfolio */

/* Portfolio full-width ajax */

function cws_portfolio_fw_filter (){
	$data = isset( $_POST["data"] ) ? $_POST["data"] : array();
	extract( shortcode_atts( array(
		'categories' => array(),
		'columns' => '1',
		'items_per_page' => get_option( 'posts_per_page' )
	), $data));
	$filter = isset( $data["filter"] ) ? $data["filter"] : "all";
	$thumb_dims = get_cws_portfolio_fw_thumb_dims( $columns );

	$query_args = array(
		'post_type' => 'cws_portfolio',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'posts_per_page' => $items_per_page
	);

	$cats = array();
	if ( $filter == 'all' ){
		if ( !empty( $categories ) ){
			$cats = $categories;
		}
		else{
			$cats = cws_get_portfolio_cat_slugs();
		}
	}
	else if ( !empty( $filter ) ){
		$cats = $filter;
	}

	if ( !empty( $cats ) ){
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'cws_portfolio_cat',
				'field' => 'slug',
				'terms' => $cats
			)
		);
	}

	$q = new WP_Query( $query_args );

	$multiple = $q->post_count > 1;
	$gallery_id = uniqid( 'cws-gallery-' );

	if ( $q->have_posts() ):
		echo "<div class='cws_ajax_response'>";
			while ( $q->have_posts() ):
				$q->the_post();
				$pid = get_the_id();
				render_cws_portfolio_fw_item ( $pid, $thumb_dims, $multiple, $gallery_id );
			endwhile;
			wp_reset_query();
		echo "</div>";
	endif;

	die();
}

add_action( "wp_ajax_cws_portfolio_fw_filter", "cws_portfolio_fw_filter" );
add_action( "wp_ajax_nopriv_cws_portfolio_fw_filter", "cws_portfolio_fw_filter" );

/* \Portfolio full-width ajax */

/* STAFF */
add_action( "init", "register_cws_staff_department" );
add_action( "init", "register_cws_staff_position" );
add_action( "init", "register_cws_staff" );

function register_cws_staff (){
	$labels = array(
		'name' => esc_html__( 'Staff members', 'cws-portf-staff' ),
		'singular_name' => esc_html__( 'Staff member', 'cws-portf-staff' ),
		'menu_name' => esc_html__( 'Our team', 'cws-portf-staff' ),
		'all_items' => esc_html__( 'All', 'cws-portf-staff' ),
		'add_new' => esc_html__( 'Add new', 'cws-portf-staff' ),
		'add_new_item' => esc_html__( 'Add New Staff Member', 'cws-portf-staff' ),
		'edit_item' => esc_html__('Edit Staff Member\'s info', 'cws-portf-staff' ),
		'new_item' => esc_html__( 'New Staff Member', 'cws-portf-staff' ),
		'view_item' => esc_html__( 'View Staff Member\'s info', 'cws-portf-staff' ),
		'search_items' => esc_html__( 'Find Staff Member', 'cws-portf-staff' ),
		'not_found' => esc_html__( 'No Staff Members found', 'cws-portf-staff' ),
		'not_found_in_trash' => esc_html__( 'No Staff Members found in Trash', 'cws-portf-staff' ),
		'parent_item_colon' => '',
		);
	$staff_slug = kiddy_get_option( 'staff_slug' );
	$staff_slug = empty( $staff_slug ) ? 'staff' : $staff_slug;
	register_post_type( 'cws_staff', array(
		'label' => esc_html__( 'Staff members', 'cws-portf-staff' ),
		'labels' => $labels,
		'public' => true,
		'rewrite' => array( 'slug' => sanitize_title($staff_slug) ),
		'capability_type' => 'post',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'page-attributes',
			'thumbnail'
			),
		'menu_position' => 24,
		'menu_icon' => 'dashicons-groups',
		'taxonomies' => array( 'cws_staff_member_position' ),
		'has_archive' => true
	));
}

function register_cws_staff_department(){
	$staff_slug = kiddy_get_option( 'staff_slug' );
	$staff_slug = empty( $staff_slug ) ? 'staff' : $staff_slug;
	$labels = array(
		'name' => esc_html__( 'Departments', 'cws-portf-staff' ),
		'singular_name' => esc_html__( 'Staff department', 'cws-portf-staff' ),
		'all_items' => esc_html__( 'All Staff departments', 'cws-portf-staff' ),
		'edit_item' => esc_html__( 'Edit Staff department', 'cws-portf-staff' ),
		'view_item' => esc_html__( 'View Staff department', 'cws-portf-staff' ),
		'update_item' => esc_html__( 'Update Staff department', 'cws-portf-staff' ),
		'add_new_item' => esc_html__( 'Add Staff department', 'cws-portf-staff' ),
		'new_item_name' => esc_html__( 'New Staff department name', 'cws-portf-staff' ),
		'parent_item' => esc_html__( 'Parent Staff department', 'cws-portf-staff' ),
		'parent_item_colon' => esc_html__( 'Parent Staff department:', 'cws-portf-staff' ),
		'search_items' => esc_html__( 'Search Staff departments', 'cws-portf-staff' ),
		'popular_items' => esc_html__( 'Popular Staff departments', 'cws-portf-staff' ),
		'separate_items_width_commas' => esc_html__( 'Separate with commas', 'cws-portf-staff' ),
		'add_or_remove_items' => esc_html__( 'Add or Remove Staff departments', 'cws-portf-staff' ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used Staff departments', 'cws-portf-staff' ),
		'not_found' => esc_html__( 'No Staff departments found', 'cws-portf-staff' )
	);
	register_taxonomy( 'cws_staff_member_department', 'cws_staff', array(
		'labels' => $labels,
		'hierarchical' => true,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => sanitize_title($staff_slug . '-cat') )
	));
}

function register_cws_staff_position(){
	$staff_slug = kiddy_get_option( 'staff_slug' );
	$staff_slug = empty( $staff_slug ) ? 'staff' : $staff_slug;
	$labels = array(
		'name' => esc_html__( 'Positions', 'cws-portf-staff' ),
		'singular_name' => esc_html__( 'Staff Member position', 'cws-portf-staff' ),
		'all_items' => esc_html__( 'All Staff Member positions', 'cws-portf-staff' ),
		'edit_item' => esc_html__( 'Edit Staff Member position', 'cws-portf-staff' ),
		'view_item' => esc_html__( 'View Staff Member position', 'cws-portf-staff' ),
		'update_item' => esc_html__( 'Update Staff Member position', 'cws-portf-staff' ),
		'add_new_item' => esc_html__( 'Add Staff Member position', 'cws-portf-staff' ),
		'new_item_name' => esc_html__( 'New Staff Member position name', 'cws-portf-staff' ),
		'search_items' => esc_html__( 'Search Staff Member positions', 'cws-portf-staff' ),
		'popular_items' => esc_html__( 'Popular Staff Member positions', 'cws-portf-staff' ),
		'separate_items_width_commas' => esc_html__( 'Separate with commas', 'cws-portf-staff' ),
		'add_or_remove_items' => esc_html__( 'Add or Remove Staff Member positions', 'cws-portf-staff' ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used Staff Member positions', 'cws-portf-staff' ),
		'not_found' => esc_html__( 'No Staff Member positions found', 'cws-portf-staff' )
	);
	register_taxonomy( 'cws_staff_member_position', 'cws_staff', array(
		'labels' => $labels,
		'show_admin_column' => true,
		'rewrite' => array( 'slug' => sanitize_title($staff_slug . '-tag') ),
		'show_tagcloud' => false
	));
}

function add_new_cws_staff_column($cws_staff_columns) {
  $cws_staff_columns['menu_order'] = "Order";
  return $cws_staff_columns;
}
add_action('manage_edit-cws_staff_columns', 'add_new_cws_staff_column');

/**
* show custom order column values
*/
function show_order_column($name){
  global $post;

  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_cws_staff_posts_custom_column','show_order_column');

/**
* make column sortable
*/
function order_column_register_sortable($columns){
	$columns['menu_order'] = 'menu_order';
	return $columns;
}
add_filter('manage_edit-cws_staff_sortable_columns','order_column_register_sortable');


function cws_get_ourteam_thumbnail_dims ( $p_id, $forcibly_is_single = null ){
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	$sb = kiddy_get_sidebars( $p_id );
	$sb_layout = $sb['sb_layout_class'];
	$single = isset( $forcibly_is_single ) ? $forcibly_is_single : is_single();
	$width_correction = 22;
	$height_correction = 22;
	$dims = array( 'width' => 0, 'height' => 0, 'crop' => true );
	if ($single){
/*		if ( $sb_layout == 'single' ){
			$dims['width'] = 870;
		}
		else if ( $sb_layout == 'double' ){
			$dims['width'] = 570;
		}
		else{
			$dims['width'] = 1170;
		}*/
		$dims['width'] = 370;
		// $dims['height'] = 208;
	}
	else{
		$dims['width'] = 270;
		$dims['height'] =  270;
	}
	$dims['width'] = $dims['width'] != 0 ? $dims['width'] - $width_correction : $dims['width'];
	$dims['height'] = $dims['height'] != 0 ? $dims['height'] - $height_correction : $dims['height'];
	return $dims;
}

function cws_get_staff_cat_slugs (){
	$cat_slugs = array();
	$cat_objects = get_terms( "cws_staff_member_department" );
	foreach ( $cat_objects as $cat_obj ) {
		$cat_slugs[] = $cat_obj->slug;
	}
	return $cat_slugs;
}

function render_cws_ourteam ( $q, $p_id = null ){
	$p_id = isset( $p_id ) ? $p_id : get_queried_object_id();
	while( $q->have_posts() ):
		$q->the_post();
		$pid = get_the_id();
		$forcibly_is_single = $p_id == $pid;
		$dims = cws_get_ourteam_thumbnail_dims( $p_id, $forcibly_is_single );
		echo "<article class='item'>";
			render_cws_ourteam_item( $pid, $dims );
		echo "</article>";
	endwhile;
	wp_reset_query();
}

function render_cws_ourteam_item ( $pid, $dims, $forcibly_is_single = null ){
	$post = get_post( $pid );
	$p_meta = get_post_meta( $pid, 'cws_mb_post' );
	$p_meta = isset( $p_meta[0] ) ? $p_meta[0] : array();

	$single = isset( $forcibly_is_single ) ? $forcibly_is_single : is_single( $pid );
	$ref_to_single = isset( $p_meta['is_clickable'] ) ? $p_meta['is_clickable'] : false;
	$ref_img_to_single = isset( $p_meta['cws_img_clickable'] ) ? $p_meta['cws_img_clickable'] : false;
	$title = get_the_title( $pid );
	$permalink = get_the_permalink( $pid );
	$post_content = "";
	$departments_array = wp_get_post_terms( $pid, 'cws_staff_member_department' );
	$positions_array = wp_get_post_terms( $pid, 'cws_staff_member_position' );
	$departments_str = "";
	$positions_str = "";
	$social_links = "";

	if ( $single ){
		$post_content =  apply_filters( 'the_content', $post->post_content );
	}
	else{
		$post_content = !empty( $post->post_excerpt ) ? $post->post_excerpt : "";
		$post_content = apply_filters( 'the_content', $post_content );
	}

	for ( $i=0; $i<count( $departments_array ); $i++ ){
		$department = $departments_array[$i];
		$department_id = $department->term_id;
		$department_permalink = get_term_link( $department_id, 'cws_staff_member_department' );
		$department_name = $department->name;
		$departments_str .= "<a href='$department_permalink'>$department_name</a>";
		$departments_str .= $i < count( $departments_array ) - 1 ? esc_html__( ', ', 'cws-portf-staff' ) : "";
	}
	for ( $i=0; $i<count( $positions_array ); $i++ ){
		$position = $positions_array[$i];
		$position_id = $position->term_id;
		$position_permalink = get_term_link( $position_id, 'cws_staff_member_position' );
		$position_name = $position->name;
		$positions_str .= "<a href='$position_permalink'>" . esc_html($position_name) . "</a>";
		$positions_str .= $i < count( $positions_array ) - 1 ? esc_html__( ', ', 'cws-portf-staff' ) : "";
	}

	$socials = isset( $p_meta['social_group'] ) ? $p_meta['social_group'] : array();
	foreach ( $socials as $social ) {
		$soc_title = isset( $social['title'] ) ? $social['title'] : "";
		$soc_icon = isset( $social['icon'] ) ? $social['icon'] : "";
		$soc_url = isset( $social['url'] ) ? $social['url'] : "";
		if ( !empty( $soc_icon ) ){
			$social_links .= "<a href='" . ( !empty( $soc_url ) ? $soc_url : "#" ) . "' class='fa fa-$soc_icon'" . ( !empty( $soc_title ) ? " title='$soc_title'" : "" ) . " target='_blank'></a>";
		}
	}

	echo !$single ? "<div class='ourteam_item_wrapper'>" : "";

		if ( has_post_thumbnail( $pid ) ){
			$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $pid ) );

			$thumb_obj = bfi_thumb($featured_img_url, $dims, false);
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". $thumb_obj[0] ."' data-at2x='" . $thumb_obj[3]['retina_thumb_url'] ."'" : " src='". $thumb_obj[0] . "' data-no-retina";
			$thumb_url = $thumb_path_hdpi;

			echo $single && !empty( $social_links ) ? "<div class='media_part_wrapper'>" : "";
				echo "<div class='media_part'>";
					echo "<div class='pic'>";
						echo (($ref_to_single && $ref_img_to_single) ? "<a href='$permalink'>" : "");
							echo "<img $thumb_url alt />";
						echo (($ref_to_single && $ref_img_to_single) ? "</a>" : "");
							if ( !$single && !$ref_img_to_single ){
								echo "<div class='hover-effect'></div>";
								echo "<div class='links_popup".($ref_to_single ? " animate" : "")."'>";
									echo "<div class='link_cont'>";
										echo "<div class='link'>";
											echo "<a href='$featured_img_url' class='fancy'><i class='fa fa-camera'></i></a>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							}
					echo "</div>";
				echo "</div>";
				echo $single && !empty( $social_links ) ? "<div class='social_links'>$social_links</div>" : "";
			echo $single && !empty( $social_links ) ? "</div>" : "";
		}

		echo $single && !empty( $post_content ) ? "<div class='post_content'>$post_content</div>" : "";

		ob_start();
		if ( !$single ){
			if ( !empty( $title ) ){
				echo "<h3 class='title'>";
					echo $ref_to_single ? "<a href='$permalink'>" : "";
						echo esc_html($title);
					echo $ref_to_single ? "</a>" : "";
				echo "</h3>";
			}
			echo (!empty( $positions_str )) ?  "<div class='positions'>$positions_str</div>" : "";
		}
		$post_title = ob_get_clean();
		echo !empty( $post_title ) ? "<div class='title_wrap'>$post_title</div>" : "";

		/**/
		ob_start();
		if ( !empty( $departments_str ) ){
			echo "<div class='departments'>";
				echo $single ? esc_html__( "Departments: ", 'cws-portf-staff' ) : "";
				echo $departments_str;
			echo "</div>";
		}
		$terms_list = ob_get_clean();

		ob_start();
		if ( !empty( $positions_str ) ){
			echo "<div class='positions'>";
				echo $single ? esc_html__( "Positions: ", 'cws-portf-staff' ) : "";
				echo $positions_str;
			echo "</div>";
		}
		$positions_list = ob_get_clean();

		if ( $single ){
			echo !empty( $terms_list ) || !empty( $positions_list ) ? '<div class="pos_term_cont">' : '';
				echo !empty( $terms_list ) ? "<div class='terms'>$terms_list</div>" : "";
				echo !empty( $positions_list ) ? "$positions_list" : "";
			echo !empty( $terms_list ) || !empty( $positions_list ) ? '</div>' : '';
		}
		/**/

		echo !$single && ( (!empty( $terms_list ) || !empty( $post_title )) && !empty( $post_content )) ? "<div class='separate_part'><div class='separate'></div></div>" : "";

		echo !$single && !empty( $post_content ) ? "<div class='desc'>$post_content</div>" : "";


		echo !$single && !empty( $social_links ) ? "<div class='social_links'>$social_links</div>" : "";

	echo !$single ? "</div>" : "";
}

/* Ourteam ajax */

add_action( "wp_ajax_cws_ourteam_pagination", "cws_ourteam_pagination" );
add_action( "wp_ajax_nopriv_cws_ourteam_pagination", "cws_ourteam_pagination" );

function cws_ourteam_pagination (){
	$data = $_POST['data'];
	extract( shortcode_atts( array(
		'p_id' => null,
		'mode' => 'grid_with_filter',
		'cats' => array(),
		'filter' => 'all',
		'posts_per_page' => get_option( 'posts_per_page' ),
		'url' => ''
	), $data));

	if ( empty( $url ) ) return;
	$match = preg_match( "#paged?(=|/)(\d+)#", $url, $matches );
	$paged = $match ? $matches[2] : 1;

	$query_args = array(
		'post_type' => 'cws_staff',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC',
		'posts_per_page' => $posts_per_page,
		'paged' => $paged
	);

	$categories = array();

	if ( $mode == "grid_with_filter" ){
		if ( $filter == "all" ){
			if ( !empty( $cats ) ){
				$categories = $cats;
			}
		}
		else{
			$categories[] = $filter;
		}
	}
	else{
		if ( !empty( $cats ) ){
			$categories = $cats;
		}
	}

	$tax_query = array();
	if ( !empty( $categories ) ){
		$tax_query[] = array(
			'taxonomy' => 'cws_staff_member_department',
			'field' => 'slug',
			'terms' => $categories
		);
	}

	if ( !empty( $tax_query ) ) $query_args['tax_query'] = $tax_query;

	$q = new WP_Query( $query_args );

	echo "<div class='cws_ajax_response'>";
		render_cws_ourteam( $q, $p_id );
		$max_paged = ceil( $q->found_posts / $posts_per_page );
		if ( $max_paged > 1 ){
			kiddy_pagination( $paged, $max_paged );
		}
	echo "</div>";

	die();

}

add_action( "wp_ajax_cws_ourteam_filter", "cws_ourteam_filter" );
add_action( "wp_ajax_nopriv_cws_ourteam_filter", "cws_ourteam_filter" );

function cws_ourteam_filter (){
	$data = $_POST['data'];
	extract( shortcode_atts( array(
		'p_id' => null,
		'cats' => array(),
		'filter' => 'all',
		'posts_per_page' => get_option( 'posts_per_page' ),
	), $data));

	$query_args = array(
		'post_type' => 'cws_staff',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC',
		'posts_per_page' => $posts_per_page,
	);

	$categories = array();

	if ( $filter == "all" ){
		if ( !empty( $cats ) ){
			$categories = $cats;
		}
	}
	else{
		$categories[] = $filter;
	}

	$tax_query = array();
	if ( !empty( $categories ) ){
		$tax_query[] = array(
			'taxonomy' => 'cws_staff_member_department',
			'field' => 'slug',
			'terms' => $categories
		);
	}

	if ( !empty( $tax_query ) ) $query_args['tax_query'] = $tax_query;

	$q = new WP_Query( $query_args );

	echo "<div class='cws_ajax_response'>";
		render_cws_ourteam( $q, $p_id );
		$max_paged = ceil( $q->found_posts / $posts_per_page );
		if ( $max_paged > 1 ){
			kiddy_pagination( 1, $max_paged );
		}
	echo "</div>";

	die();

}

/* \Ourteam ajax */
?>