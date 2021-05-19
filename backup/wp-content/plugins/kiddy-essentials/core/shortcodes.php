<?php

/* Shortcodes */
function kiddy_shortcode_alert( $atts, $content = null ) {
	extract(shortcode_atts(
		array(
			'type' => 'information',
			'title' => null,
			'e_style' => null,
			'grey_skin' => null,
		), $atts));
		return '<div class="message_box ' . sanitize_html_class( $type ) . '_box ' . ( $grey_skin ? ' grey_skin' : '' ) . '">' . ( $title ? "<div class='message_box_header'>" . esc_html( $title ) . '</div>' : '' ) . '<p>' . do_shortcode( $content ) . '</p>' . '</div>';
}
add_shortcode( 'alert', 'kiddy_shortcode_alert' );


// Outputs description post
function kiddy_shortcode_cta( $attr, $content = null ) {
	extract(shortcode_atts(
		array(
			'icon' => null,
			'title' => null,
			'button_text' => esc_html__( 'Click Here', 'kiddy-essentials' ),
			'link' => '#',
		), $attr));
		$title = esc_html( $title );
		$link = esc_url( $link );
		$icon = sanitize_html_class( $icon );

		$output = '<div class="cws-widget callout_widget clearfix ' . ( $icon ? 'with_icon' : '' ) . '">';
		$output .= $icon ? "<div class='icons_part icon_frame'><i class='fa fa-" . $icon . "'></i></div>" : '';
		$output .= "<div class='content_wrapper'><div class='text_part'>" . ( $title ? "<div class='title'>$title</div>" : '' ) . do_shortcode( $content ) . "</div><div class='button_part'><a class='cws_button medium' href='$link'>$button_text</a></div></div>";
		$output .= '</div>';

		return $output;
}
add_shortcode( 'cws_cta', 'kiddy_shortcode_cta' );

function kiddy_shortcode_twitter( $attr ) {
	extract(shortcode_atts(
		array(
			'tweets' => 4,
			'visible' => 2,
			'before_widget' => "<div class='cws-widget'>",
			'after_widget' => '</div>',
			'before_title' => "<div class='widget-title'><span>",
			'after_title' => '</span></div>',
			'sidebar' => false,
			'backlight' => false,
			'title' => '',
		), $attr));
		$visible = intval( $visible );
		$tweets = intval( $tweets );
		$out = '';
		$twt_obj = kiddy_getTweets( $tweets );
		if ( $twt_obj && is_array( $twt_obj ) ) {
			if ( ! array_key_exists( 'error', $twt_obj ) ) {
				$title = esc_html( $title );
				$is_carousel = ($visible < $tweets ? true : false);
				$out .= $sidebar ? '' : $before_widget;
				$backlight_class = $backlight ? 'backlight' : '';
				$out .= "<div class='cws-widget-content $backlight_class'>";

				if ( $is_carousel ) :
						wp_enqueue_script ('owl_carousel');
					$out .= "<div class='carousel_header clearfix'>";
					$out .= count( $twt_obj ) ? "<div class='widget_carousel_nav'><i class='prev fa fa-angle-left'></i><i class='next fa fa-angle-right'></i></div>" : '' ;
				endif;
				$out .= ! empty( $title ) ? $before_title . $title . $after_title : '';
				if ( $is_carousel ) { $out .= '</div>'; }
				if ( $is_carousel ) { $out .= "<div class='carousel_content'>"; }

				$out .= '<ul class="latest_tweets ' . ($is_carousel ? ' widget_carousel' : '' ) . '">';
				if ( $twt_obj ) {
					$i = 0;
					foreach ( $twt_obj as $tweets ) {
						if ( 0 == $i ) {
							$out .= '<li><ul>';
						}
						$strtime = strtotime( $tweets['created_at'] );
						$tweet_text = preg_replace( '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $tweets['text'] );
						$tweet_text = preg_replace( '/#([\\d\\w]+)/', '<a href="http://twitter.com/search?q=%23$1&amp;src=hash">$0</a>', $tweet_text );
						if ( strlen( $tweet_text ) > 0 ) {
							$out .= '<li class="clearfix"><div class="icon_frame"><i class="fa fa-twitter fa-2x"></i></div><div>';
							$out .= '<p>' . esc_html( $tweet_text ) . '</p>';
							$out .= '<span class = "date">' . esc_html( date( 'M d, Y', $strtime ) ) . '</span>';
							$out .= '</div></li>';
						}
						$i++;
						if ( $i == $visible ) {
							$out .= '</ul></li>';
							$i = 0;
						}
					}
					if ( ( $i != $visible ) && ( $i != 0 ) ) {
						$out .= '</ul></li>';
					}
				} else {
					$out .= '<li>' . esc_html__( 'Twitter API keys and tokens are not set.', 'kiddy-essentials' ) . '</li>';
				}
				$out .= '</ul>';
				if ( $is_carousel ) { $out .= '</div>'; }
				$out .= '</div>';
				$out .= $sidebar ? '' : $after_widget;
			} else {
				$out = $twt_obj['error'];
			}
		} else {
			$out = 'Twitter feed is currently turned off. You may turn it on and set the API Keys and Tokens using Theme Options -> Social Options: Enable Twitter Feed.';
		}
		return $out;
}
add_shortcode( 'twitter', 'kiddy_shortcode_twitter' );



/* THE 8 TINYMCE SHORTCODES */

function kiddy_shortcode_msg_box( $atts, $content ) {
	extract( shortcode_atts( array(
		'type' => 'info',
		'title' => '',
		'text' => '',
		'is_closable' => '0',
		'customize' => '0',
		'custom_options' => array(),
	), $atts));

	$custom_options = kiddy_json_sc_attr_conversion( $custom_options );
	$custom_options = is_object( $custom_options ) ? get_object_vars( $custom_options ) : array();
	$custom_options = isset( $custom_options['@'] ) ? $custom_options['@'] : new stdClass();
	$custom_color = isset( $custom_options->color ) ? esc_attr( $custom_options->color ) : '';
	$custom_icon = isset( $custom_options->icon ) ? $custom_options->icon : '';

	$out = '';
	$icon = $customize == '1' && ! empty( $custom_icon ) ? $custom_icon : '';
	if ( empty( $icon ) ) {
		switch ( $type ) {
			case 'info':
				$icon = 'info';
				break;
			case 'warning':
				$icon = 'bolt';
				break;
			case 'success':
				$icon = 'thumbs-up';
				break;
			case 'error':
				$icon = 'exclamation';
				break;
		}
	}

	ob_start();
		echo ! empty( $title ) ? '<div class="msg_box_title">'.esc_html( $title ).'</div>' : '';
		echo ! empty( $text ) ? '<div class="msg_box_text">'. $text .'</div>' : '';
	$content_box = ob_get_clean();

	$custom_styles = ($customize === '1' && ! empty( $custom_color )) ? "background-color:$custom_color" : '';
	$custom_icon_styles = ($customize === '1' && ! empty( $custom_color )) ? "color:$custom_color" : '';
	$container_class = "cws_msg_box $type-box clearfix";
	$container_class .= $is_closable == '1' ? ' closable' : '';

	if ( ! empty( $content_box ) ) {
		$out .= "<div class='$container_class'" . ( ! empty( $custom_styles ) ? " style='$custom_styles'" : '' ) . '>';
			$out .= "<div class='icon_section'><i class='fa fa-$icon' ". ( ! empty( $custom_icon_styles ) ? " style='$custom_icon_styles'" : '' ) . '></i></div>';
			$out .= "<div class='content_section'>$content_box</div>";
			$out .= $is_closable == '1' ? "<div class='cls_btn'></div>" : '';
		$out .= '</div>';
	}

	return $out;
}
add_shortcode( 'cws_sc_msg_box', 'kiddy_shortcode_msg_box' );

function kiddy_shortcode_milestone( $atts, $content ) {
	extract( shortcode_atts( array(
		'number' => '',
		'speed' => '',
		'desc' => '',
		'custom_colors' => '0',
		'custom_color_settings' => array(),
		'alt_style' => '0',
	), $atts));

	wp_enqueue_script ('odometer');

	$number = (int) $number;
	$speed = (int) $speed;
	$desc = esc_html( $desc );

	$custom_color_settings = kiddy_json_sc_attr_conversion( $custom_color_settings );
	$custom_color_settings = is_object( $custom_color_settings ) ? get_object_vars( $custom_color_settings ) : $custom_color_settings;
	$custom_color_settings = isset( $custom_color_settings['@'] ) ? $custom_color_settings['@'] : new stdClass();
	$fill_color = isset( $custom_color_settings->fill_color ) ? esc_attr( $custom_color_settings->fill_color ) : '#26b4d7';
	$font_color = isset( $custom_color_settings->font_color ) ? esc_attr( $custom_color_settings->font_color ) : '#fff';
	$alt_style = ( intval( $alt_style ) == 1 ) ? true : false;

	$out = '';
	$el_atts = '';
	$el_class = '';
	$el_styles = '';
	$el_class = 'cws_milestone';
	$el_atts .= ! empty( $el_class ) ? " class='$el_class'" : '';

	if ( $custom_colors ) {
		if ( $alt_style ) {
			$el_styles .= "background-color:transparent;color:$fill_color;border-color:$fill_color;";
		} else {
			$el_styles .= 'background-color:rgb('.esc_attr( kiddy_Hex2RGBwithdark( $fill_color,0.85 ) ).");color:$font_color;border-color:$fill_color;";
		}
	} else {
		if ($alt_style) {
			$el_styles .= "background-color:transparent;color:$fill_color;border-color:$fill_color;";
		}else{
			$el_styles .= 'background-color:rgb('.esc_attr( kiddy_Hex2RGBwithdark( $fill_color,0.85 ) ).");color:$font_color;border-color:$fill_color;";
		}
	}
	$el_atts .= ! empty( $el_styles ) ? " style='$el_styles'" : '';

	$out .= ! empty( $number ) ? "<div class='milestone_number'" . ( ! empty( $speed ) ? " data-speed='$speed'" : '' ) . ">$number</div>" : '';
	$out_desc = ! empty( $desc ) ? "<div class='milestone_desc' style='color:$fill_color'>$desc</div>" : '';
	$class = 'cws_milestone';
	$out = ( ! empty( $out ) || ! empty( $out_desc )) ? "<div class='milestone-wrapp'>" . ( ! empty( $out ) ? '<div class="milestone_cont"><div ' . ( ! empty( $el_atts ) ? $el_atts : '' ) .'>'.$out.'</div></div>' : '' ) . "$out_desc</div>" : '';
	return $out;
}
add_shortcode( 'cws_sc_milestone', 'kiddy_shortcode_milestone' );

function kiddy_shortcode_progress_bar( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'progress' => '',
		'customize' => '0',
		'custom_colors' => array(),
	), $atts));
	$custom_colors = kiddy_json_sc_attr_conversion( $custom_colors );
	$custom_colors = is_object( $custom_colors ) ? get_object_vars( $custom_colors ) : array();
	$custom_colors = isset( $custom_colors['@'] ) ? $custom_colors['@'] : new stdClass();

	$progress = (int) $progress;
	$title = esc_html( $title );

	$custom_bg_color = isset( $custom_colors->bg_color ) ? ' style="background-color:'.esc_attr( $custom_colors->bg_color ).';"' : '';
	$custom_font_indicator_color = isset( $custom_colors->bg_color ) ? ' style="color:'.esc_attr( $custom_colors->bg_color ).';"' : '';

	$customized = $customize == '1' ? true : false;

	if ( ! intval( $progress ) || $progress < 0 || $progress > 100 ) { return; }
	$out = '';
	$out .= "<div class='cws_progress_bar'>";
		$out .= ! empty( $title ) ? "<div class='pb_title'>$title <span class='indicator'".($customized ? $custom_font_indicator_color : '' ).'></span></div>' : '';
		$out .= "<div class='bar'><div class='progress' data-value='$progress' ".($customized ? $custom_bg_color : '' ).'></div></div>';
	$out .= '</div>';
	return $out;
}
add_shortcode( 'cws_sc_progress_bar', 'kiddy_shortcode_progress_bar' );

function kiddy_shortcode_fa( $atts, $content ) {
	extract( shortcode_atts( array(
		'icon' => '',
		'shape' => 'round',
		'size' => '2x',
		'alt' => '0',
		'customize' => '0',
		'custom_options' => array(),
	), $atts));

	if ( empty( $icon ) ) { return; }

	$custom_colors = kiddy_json_sc_attr_conversion( $custom_options );
	$custom_colors = is_object( $custom_colors ) ? get_object_vars( $custom_colors ) : array();
	$custom_colors = isset( $custom_colors['@'] ) ? $custom_colors['@'] : new stdClass();
	$custom_text_color = isset( $custom_colors->text_color ) ? esc_attr( $custom_colors->text_color ) : '';
	$custom_bg_color = isset( $custom_colors->bg_color ) ? esc_attr( $custom_colors->bg_color ) : '';
	$custom_border_color = isset( $custom_colors->border_color ) ? esc_attr( $custom_colors->border_color ) : '';
	$customized = ($customize === '1');
	$alt = ($alt === '1');

	$title_match = preg_match( '#(?s)<h\d[^>]*>.*<\/h\d>#', $content, $title_matches, PREG_OFFSET_CAPTURE );
	$title_match_array = $title_match && isset( $title_matches[0] ) ? $title_matches[0] : array();
	$title = isset( $title_match_array[0] ) ? $title_match_array[0] : '';
	$title_ind = isset( $title_match_array[1] ) ? $title_match_array[1] : null;

	$desc = $title_match ? substr_replace( $content, '', $title_ind, strlen( $title ) ) : $content;

	$class = "cws_fa fa fa-$size fa-$icon" . ( $customized ? ' customized' : '' ) . ( $alt ? ' alt' : '' );
	$custom_color_atts = " data-font-color='$custom_text_color' data-bg-color='$custom_bg_color' data-border-color='$custom_border_color'";

	$out = '';
	if ( ! empty( $title ) && ! empty( $desc ) ) {
		$out .= "<div class='cws_fa_tbl'>";
			$out .= "<div class='cws_fa_tbl_row'>";
				$out .= "<div class='cws_fa_tbl_cell size_$size'>";
					$out .= "<div class='cws_fa_wrapper". ( $shape == 'round' ? ' round' : '' ) ."'><i class='$class'" . ( $customized ? $custom_color_atts : '' ) . "></i><span class='ring'></span></div>";
				$out .= '</div>';
				$out .= "<div class='cws_fa_tbl_cell'>";
					$out .= $title;
				$out .= '</div>';
			$out .= '</div>';
			$out .= "<div class='cws_fa_tbl_row'>";
				$out .= "<div class='cws_fa_tbl_cell'></div>";
				$out .= "<div class='cws_fa_tbl_cell'>";
					$out .= $desc;
				$out .= '</div>';
			$out .= '</div>';
		$out .= '</div>';
	} else if ( ! empty( $title ) && empty( $desc ) ) {
		$out .= "<div class='cws_fa_tbl'>";
			$out .= "<div class='cws_fa_tbl_row'>";
				$out .= "<div class='cws_fa_tbl_cell size_$size'>";
					$out .= "<div class='cws_fa_wrapper". ( $shape == 'round' ? ' round' : '' ) ."'><i class='$class'" . ( $customized ? $custom_color_atts : '' ) . "></i><span class='ring'></span></div>";
				$out .= '</div>';
				$out .= "<div class='cws_fa_tbl_cell'>";
					$out .= $title;
				$out .= '</div>';
			$out .= '</div>';
		$out .= '</div>';
	} else if ( empty( $title ) && ! empty( $desc ) ) {
		$out .= "<div class='cws_fa_tbl v_align_top'>";
			$out .= "<div class='cws_fa_tbl_row'>";
				$out .= "<div class='cws_fa_tbl_cell'>";
					$out .= "<div class='cws_fa_wrapper". ( $shape == 'round' ? ' round' : '' ) ."'><i class='$class'" . ( $customized ? $custom_color_atts : '' ) . "></i><span class='ring'></span></div>";
				$out .= '</div>';
				$out .= "<div class='cws_fa_tbl_cell'>";
					$out .= $desc;
				$out .= '</div>';
			$out .= '</div>';
		$out .= '</div>';
	} else {
		$out .= "<span class='cws_fa_wrapper". ( $shape == 'round' ? ' round' : '' ) ."'><i class='$class'" . ( $customized ? $custom_color_atts : '' ) . "></i><span class='ring'></span></span>";
	}
	return $out;
}
add_shortcode( 'cws_sc_fa', 'kiddy_shortcode_fa' );

function kiddy_shortcode_button( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'url' => '#',
		'new_tab' => '0',
		'size' => 'regular',
		'alt' => '0',
		'full_width' => '0',
		'customize' => '0',
		'custom_options' => '',
	), $atts));


	if ( empty( $title ) ) { return; }

	$custom_options = kiddy_json_sc_attr_conversion( $custom_options );
	$custom_options = is_object( $custom_options ) ? get_object_vars( $custom_options ) : array();
	$custom_options = isset( $custom_options['@'] ) ? $custom_options['@'] : new stdClass();
	$bg_hover_color = isset( $custom_options->bg_hover_color ) ? esc_attr( $custom_options->bg_hover_color ) : '';
	$custom_bg_color = isset( $custom_options->bg_color ) ? esc_attr( $custom_options->bg_color ) : '';
	$text_color = isset( $custom_options->text_color ) ? esc_attr( $custom_options->text_color ) : '';
	$customized = ($customize === '1');
	$alt = ($alt === '1');
	$new_tab = ($new_tab === '1');
	$size = esc_html( $size );


	$out = '';
	$class = 'cws_button' . ( $customized ? ' customized' : '' ) . ( $alt ? ' alt' : '' ) . ( $full_width ? ' full_width' : '' ) . ( $size != 'regular' ? " $size" : '' );
	$custom_color_atts = " data-bg_hover_color='$bg_hover_color' data-bg_color='$custom_bg_color' data-text_color='$text_color'";
	$text_inner = $alt ? '<span class="cws_button_inner" '.$custom_color_atts.'>'.$title.'</span>' : $title;
	$out .= "<a href='$url' class='$class'" . ( $customized ? $custom_color_atts : '' ) . ''.($new_tab ? ' target="_blank"' : '').">$text_inner</a>";
	return $out;
}
add_shortcode( 'cws_sc_button', 'kiddy_shortcode_button' );

function kiddy_shortcode_testimonial( $atts, $content ) {
	extract( shortcode_atts( array(
		'thumbnail' => '',
		'text' => '',
		'author' => '',
		'customize' => '0',
		'custom_pattern' => array(),
		'custom_options' => array(),
	), $atts));

	$custom_colors = kiddy_json_sc_attr_conversion( $custom_options );
	$custom_colors = is_object( $custom_colors ) ? get_object_vars( $custom_colors ) : array();
	$custom_colors = isset( $custom_colors['@'] ) ? $custom_colors['@'] : new stdClass();
	$custom_bg_color = isset( $custom_colors->bg_color ) ? esc_attr( $custom_colors->bg_color ) : '';
	$text_color = isset( $custom_colors->text_color ) ? esc_attr( $custom_colors->text_color ) : '';
	$customized = $customize == '1' ? true : false;

	$custom_pattern = kiddy_json_sc_attr_conversion( $custom_pattern );
	$custom_pattern = is_object( $custom_pattern ) ? get_object_vars( $custom_pattern ) : array();
	$custom_pattern = isset( $custom_pattern['@'] ) ? $custom_pattern['@'] : new stdClass();
	$custom_pattern_url = isset( $custom_pattern->src ) ? $custom_pattern->src : '';

	$thumbnail = kiddy_json_sc_attr_conversion( $thumbnail );
	$thumbnail = is_object( $thumbnail ) ? get_object_vars( $thumbnail ) : array();
	$thumbnail = isset( $thumbnail['@'] ) ? $thumbnail['@'] : new stdClass();
	$thumb_url = isset( $thumbnail->src ) ? $thumbnail->src : '';

	return kiddy_testimonial_renderer( $thumb_url, $text, $author, $text_color , $custom_bg_color , $custom_pattern_url );
}
add_shortcode( 'cws_sc_testimonial', 'kiddy_shortcode_testimonial' );

function kiddy_shortcode_dropcap( $atts, $content ) {
	return ! empty( $content ) ? "<span class='dropcap'>$content</span>" : '';
}
add_shortcode( 'cws_sc_dropcap', 'kiddy_shortcode_dropcap' );

function kiddy_shortcode_bee( $atts, $content ) {
		extract( shortcode_atts( array(
		'direction' => '',
	), $atts));
	$out = "<div class='bees". ( $direction == 'right' ? ' bees-end' : '' ) ."'><span></span></div>";
	return $out;
}
add_shortcode( 'cws_sc_bee_icon', 'kiddy_shortcode_bee' );

function kiddy_shortcode_embed( $atts, $content ) {
	extract( shortcode_atts( array(
		'url' => '',
		'width' => '',
		'height' => '',
	), $atts));
	$url = esc_url( $url );
	return ! empty( $url ) ? apply_filters( 'the_content', '[embed' . ( ! empty( $width ) && is_numeric( $width ) ? " width='$width'" : '' ) . ( ! empty( $height ) && is_numeric( $height ) ? " height='$height'" : '' ) . ']' . $url . '[/embed]' ) : '';
}
add_shortcode( 'cws_sc_embed', 'kiddy_shortcode_embed' );

function kiddy_shortcode_mark( $atts, $content ) {
	extract( shortcode_atts( array(
		'font_color' => '#fff',
		'bg_color' => '#26b4d7',
	), $atts));
	$font_color = esc_attr( $font_color );
	$bg_color = esc_attr( $bg_color );
	return ! empty( $content ) ? "<mark style='color:$font_color;background-color:$bg_color;'>$content</mark>" : '';
}
add_shortcode( 'cws_sc_mark', 'kiddy_shortcode_mark' );

function kiddy_shortcode_carousel( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'columns' => '1',
		'autoplay' => '',
		'autoplay_speed' => '1000',			
	), $atts));

	$has_title = ! empty( $title );
	$section_class = 'cws_sc_carousel';
	$section_class .= ! $has_title ? ' bullets_nav' : '';
	$section_class .= ($autoplay == '1') ? " autoplay" : "";		
	$title = esc_html( $title );
	$section_atts = ' data-columns='. (int) $columns;
	$section_atts .= ($autoplay == '1' && !empty( $autoplay_speed )) ? ' data-autoplay="'.$autoplay_speed.'"' : '';	
	$out = '';
	if ( ! empty( $content ) ) {
								wp_enqueue_script ('owl_carousel');
		$out .= "<div class='$section_class'" . ( ! empty( $section_atts ) ? $section_atts : '' ) . '>';
		if ( $has_title ) {
			$out .= "<div class='cws_sc_carousel_header clearfix'>";
				$out .= $has_title ? "<div class='ce_title'>$title</div>" : '';
				$out .= "<div class='carousel_nav_panel'>";
					$out .= "<span class='prev'></span>";
					$out .= "<span class='next'></span>";
				$out .= '</div>';
			$out .= '</div>';
		}
			$out .= "<div class='cws_wrapper'>";
				$out .= do_shortcode( $content );
			$out .= '</div>';
		$out .= '</div>';
	}
	return $out;
}
add_shortcode( 'cws_sc_carousel', 'kiddy_shortcode_carousel' );

/* THE 8 PB SHORTCODES */

function kiddy_shortcode_row( $sc_atts, $content ) {
	extract( shortcode_atts( array(
		'flags' => '0',
		'cols' => '1',
		'margin_left' => '',
		'margin_top' => '',
		'margin_right' => '',
		'margin_bottom' => '',
		'render' => '',
		'atts' => '',
	), $sc_atts));
	$out = '';
	$row_bg_atts = '';
	$row_atts = '';
	$row_bg_class = 'row_bg';
	$row_class = 'grid_row';
	$row_bg_styles = '';
	$row_styles = '';
	$padding_styles = '';
	$row_bg_html = '';
	$row_content = '';
	$has_bg = false;

	$padding_styles .= ! empty( $margin_left ) 	|| $margin_left === '0' ? 'padding-left: '.esc_attr( $margin_left ). 'px;' : '';
	$padding_styles .= ! empty( $margin_top ) 	|| $margin_top === '0' ? 'padding-top: '.esc_attr( $margin_top ). 'px;' : '';
	$padding_styles .= ! empty( $margin_right ) || $margin_right === '0' ? 'padding-right: '.esc_attr( $margin_right ). 'px;' : '';
	$padding_styles .= ! empty( $margin_bottom )|| $margin_bottom === '0' ? 'padding-bottom: '.esc_attr( $margin_bottom ). 'px;' : '';

	$atts_arr = json_decode( $atts, true );

	extract( shortcode_atts( array(
		'customize_bg' => '0',
		'bg_media_type' => 'none',
		'bg_img' => array(),
		'is_bg_img_high_dpi' => '0',
		'bg_video_type' => '1',
		'sh_bg_video_source' => array(),
		'yt_bg_video_source' => '',
		'vimeo_bg_video_source' => '',
		'bg_color_type' => 'none',
		'bg_color' => '#26b4d7',
		'bg_color_opacity' => '100',
		'bg_pattern' => array(),
		'font_color' => '#fff',
		'animate' => '0',
		'ani_duration' => '2',
		'ani_delay' => '0',
		'ani_offset' => '10',
		'ani_iteration' => '1',
		'ani_effect' => '',
		'use_prlx' => '0',
		'prlx_speed' => '0',
		'eclass' => '',
	), $atts_arr));

	$row_bg_img = isset( $bg_img['row'] ) ? esc_url( $bg_img['row'] ) : '';
	$row_bg_img_w = isset( $bg_img['w'] ) ? esc_url( $bg_img['w'] ) : '';


	if ( ! empty( $row_bg_img ) ) {
		if ( $is_bg_img_high_dpi && ! empty( $row_bg_img_w ) && is_numeric( $row_bg_img_w ) ) {
			$thumb_obj = bfi_thumb( $row_bg_img,array( 'width' => floor( (float) $row_bg_img_w / 2 ), 'crop' => true ), false );
			$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
			$img_src = $thumb_path_hdpi;
		} else {
			$img_src = 'src="'.$row_bg_img.'" data-no-retina';
		}
	} else {
		$img_src = '';
	}

	$prlx_speed = (int) $prlx_speed;

	if ( ! empty( $img_src ) ) {
		$row_bg_class .= ' cws_wrapper';
		$row_bg_class .= $use_prlx ? ' cws_prlx_section' : '';
		$row_bg_html .= "<img $img_src class='" . ( $use_prlx ? 'cws_prlx_layer' : 'row_bg_img' ). "'" . ( ! empty( $prlx_speed ) ? " data-scroll-speed='$prlx_speed'" : '' ) . ' alt />';
		$has_bg = true;
	}
				if ($use_prlx) {
		wp_enqueue_script ('cws_parallax');
	}

	$video_src = '';
	if ( $bg_media_type == 'video' ) {
		switch ( $bg_video_type ) {
			case '1':
				$video_src = isset( $sh_bg_video_source['row'] ) ? esc_url( $sh_bg_video_source['row'] ) : '';
				$row_bg_class .= ' cws_self_hosted_video';
				$row_bg_html .= "<video class='self_hosted_video" . ( $use_prlx ? ' cws_prlx_layer' : '' ) . "' src='$video_src' autoplay='autoplay' loop='loop' muted='muted'" . ( ! empty( $prlx_speed ) ? " data-scroll-speed='$prlx_speed'" : '' ) . '></video>';
				break;
			case '2':
		wp_enqueue_script ('cws_YT_bg');
				$video_src = $yt_bg_video_source ;
				$uniqid = uniqid( 'video-' );
				$row_bg_class .= ' cws_Yt_video_bg loading';
				$row_bg_atts .= " data-video-source='$video_src' data-video-id='$uniqid'";
				$row_bg_html .= "<div id='$uniqid'" . ( $use_prlx ? " class='cws_prlx_layer'" : '' ) . ( ! empty( $prlx_speed ) ? " data-scroll-speed='$prlx_speed'" : '' ) . '></div>';
				break;
			case '3':
																wp_enqueue_script ('vimeo');
				wp_enqueue_script ('cws_self&vimeo_bg');
				$video_src = $vimeo_bg_video_source;
				$uniqid = uniqid( 'video-' );
				$row_bg_class .= ' cws_Vimeo_video_bg';
				$row_bg_atts .= " data-video-source='$video_src' data-video-id='$uniqid'";
				$row_bg_html .= "<iframe id='$uniqid'" . ( $use_prlx ? " class='cws_prlx_layer'" : '' ) . ( ! empty( $prlx_speed ) ? " data-scroll-speed='$prlx_speed'" : '' ) . " src='" . $video_src . "?api=1&player_id=$uniqid' frameborder='0'></iframe>";
				break;
		}
		if ( ! empty( $video_src ) ) {
			$row_bg_class .= ' row_bg_video';
			$has_bg = true;
		}
	}

	if ( ( ! empty( $img_src ) || ! empty( $video_src ) ) && ( ! empty( $bg_pattern ) && isset( $bg_pattern['row'] ) && ! empty( $bg_pattern['row'] ) ) ) {
		$bg_pattern_src = esc_attr( $bg_pattern['row'] );
		$layer_styles = "background-image:url($bg_pattern_src);";
		$row_bg_html .= "<div class='row_bg_layer' style='$layer_styles'></div>";
		$has_bg = true;
	}

	if ( in_array( $bg_color_type, array( 'color' ) ) ) {
		$layer_styles = '';
		$bg_color = esc_attr( $bg_color );
		if ( $bg_color_type == 'color' ) {
			$layer_styles .= "background-color:$bg_color;";
		}
		$layer_styles .= ! empty( $bg_color_opacity ) ? 'opacity:' . (float) $bg_color_opacity / 100 . ';' : '';
		if ( ! empty( $layer_styles ) ) {
			$row_bg_html .= "<div class='row_bg_layer' style='$layer_styles'></div>";
			$has_bg = true;
		}
	}

	if ( $has_bg ) {
		$font_color = esc_attr( $font_color );
		$row_bg_styles .= $padding_styles;
		$row_bg_styles .= "color:$font_color;";
	} else {
		$row_styles .= $padding_styles;
	}

	$row_class .= (bool) ($flags & 1) ? ' eq_cols' : ' clearfix';
	$row_class .= in_array( $render, array( 'portfolio_fw' ) ) ? ' full_width' : '';
	$row_class .= ! empty( $eclass ) ? ' ' . sanitize_html_class( trim( $eclass ) ) : '';
	$row_bg_class .= $use_prlx ? ' cws_prlx_section' : '';

	$row_bg_atts .= ! empty( $row_bg_class ) ? " class='$row_bg_class'" : '';
	$row_bg_atts .= ! empty( $row_bg_styles ) ? " style='$row_bg_styles'" : '';

	if ( $animate ) {
		wp_enqueue_script ('wow');
		$ani_effect = sanitize_html_class( $ani_effect );
		$row_class .= ! empty( $ani_effect ) ? " wow $ani_effect" : '';
		$row_atts .= ! empty( $ani_duration ) ? " data-wow-duration='" . (int) $ani_duration . "s'" : '';
		$row_atts .= ! empty( $ani_delay ) ? " data-wow-delay='" . (int) $ani_delay . "s'" : '';
		$row_atts .= ! empty( $ani_offset ) ? " data-wow-offset='" . (int) $ani_offset . "'" : '';
		$row_atts .= ! empty( $ani_iteration ) ? " data-wow-iteration='" . (int) $ani_iteration . "'" : '';
	}

	$row_atts .= ! empty( $row_class ) ? " class='$row_class'" : '';
	$row_atts .= ! empty( $row_styles ) ? " style='$row_styles'" : '';

	switch ( $render ) {
		case 'portfolio':
			if ( function_exists('register_cws_portfolio') ) {
				wp_enqueue_script ('isotope');
				$row_content .= kiddy_cws_portfolio( $atts_arr );
			} else {
				$shortcode_back = '';
				foreach ( $sc_atts as $key => $value ) {
					if ( ! empty( $value ) ) {
						$shortcode_back .= ' '.$key.'='.($key == 'atts' ? '\'' : (is_numeric( $value ) ? '' : '"')).$value.($key == 'atts' ? '\'' : (is_numeric( $value ) ? '' : '"'));
					}
				}
				echo "<div class='grid_row clearfix'>".('[cws-row'.$shortcode_back.'][/cws-row]').'</div>';
			}
			break;
		case 'portfolio_fw':
			$row_content .= cws_portfolio_fw( $atts_arr );
			break;
		case 'ourteam':
			if ( function_exists('register_cws_portfolio') ) {
								wp_enqueue_script ('isotope');
				$row_content .= kiddy_cws_ourteam( $atts_arr );
			} else {
				$shortcode_back = '';
				foreach ( $sc_atts as $key => $value ) {
					if ( ! empty( $value ) ) {
						$shortcode_back .= ' '.$key.'='.($key == 'atts' ? '\'' : (is_numeric( $value ) ? '' : '"')).$value.($key == 'atts' ? '\'' : (is_numeric( $value ) ? '' : '"'));
					}
				}
				echo "<div class='grid_row clearfix'>".('[cws-row'.$shortcode_back.'][/cws-row]').'</div>';
			}
			break;
		case 'blog':
			$row_content .= kiddy_blog( $atts_arr );
			break;
		default:
			$row_content .= do_shortcode( $content );
	}

	$out .= $has_bg ? '<div' . ( ! empty( $row_bg_atts ) ? $row_bg_atts : '' ) . '>' : '';

		$out .= $has_bg && ! empty( $row_bg_html ) ? $row_bg_html : '';
		$out .= '<div' . ( ! empty( $row_atts ) ? $row_atts : '' ) . '>';
		$out .= $row_content;
		$out .= '</div>';
	$out .= $has_bg ? '</div><div class="row_bg_content_width"></div>' : '';

	return $out;
}
add_shortcode( 'cws-row', 'kiddy_shortcode_row' );

function kiddy_shortcode_col( $atts, $content ) {
	extract( shortcode_atts( array(
		'flags' => '0',
		'span' => '12',
		'_pcol' => '',
	), $atts));

	$_pcol = ! empty( $_pcol ) ? json_decode( $_pcol, true ) : array();
	extract( shortcode_atts( array(
		'animate' => '0',
		'ani_effect' => '',
		'ani_duration' => '',
		'ani_delay' => '',
		'ani_offset' => '',
		'ani_iteration' => '',
		), $_pcol));

	$out = '';
	$section_atts = '';
	$section_class = "grid_col grid_col_$span";

	$section_class .= (bool) ($flags & 1) ? ' pricing_table_column' : '';
	$section_class .= (bool) ($flags & 2) ? ' active_table_column' : '';

	if ( $animate ) {
		wp_enqueue_script ('wow');
		$ani_effect = sanitize_html_class( $ani_effect );
		$section_class .= ! empty( $ani_effect ) ? " wow $ani_effect" : '';
		$section_atts .= ! empty( $ani_duration ) ? " data-wow-duration='" . (int) $ani_duration . "s'" : '';
		$section_atts .= ! empty( $ani_delay ) ? " data-wow-delay='" . (int) $ani_delay . "s'" : '';
		$section_atts .= ! empty( $ani_offset ) ? " data-wow-offset='" . (int) $ani_offset . "'" : '';
		$section_atts .= ! empty( $ani_iteration ) ? " data-wow-iteration='" . (int) $ani_iteration . "'" : '';
	}

	$section_atts .= ! empty( $section_class ) ? " class='$section_class'" : '';
	$out .= '<div' . ( ! empty( $section_atts ) ? $section_atts : '' ) . '>';
		$out .= do_shortcode( $content );
	$out .= '</div>';
	return $out;
}
add_shortcode( 'col', 'kiddy_shortcode_col' );

function kiddy_shortcode_widget( $sc_atts, $content ) {
	extract( shortcode_atts( array(
		'type' => 'text',
		'title' => '',
		'atts' => '',
	), $sc_atts));

	$atts_arr = json_decode( $atts, true );

	$GLOBALS['widget_type'] = $type;

	extract( shortcode_atts( array(
		'title' => '',
		'centertitle' => '0',
		'animate' => '0',
		'ani_effect' => '',
		'ani_duration' => '',
		'ani_delay' => '',
		'ani_offset' => '',
		'ani_iteration' => '',
	), $atts_arr));

	$section_atts = '';
	$section_class = 'ce clearfix';
	if ( $animate ) {
		wp_enqueue_script ('wow');
		$ani_effect = sanitize_html_class( $ani_effect );
		$section_class .= ! empty( $ani_effect ) ? " wow $ani_effect" : '';
		$section_atts .= ! empty( $ani_duration ) ? " data-wow-duration='" . (int) $ani_duration . "s'" : '';
		$section_atts .= ! empty( $ani_delay ) ? " data-wow-delay='" . (int) $ani_delay . "s'" : '';
		$section_atts .= ! empty( $ani_offset ) ? " data-wow-offset='" . (int) $ani_offset . "'" : '';
		$section_atts .= ! empty( $ani_iteration ) ? " data-wow-iteration='" . (int) $ani_iteration . "'" : '';
	}
	$section_atts .= ! empty( $section_class ) ? " class='" . trim( $section_class ) . "'" : '';
	$out = '';
	if ( $type == 'tcol' ) {
		$out .= kiddy_pricecol_renderer( $atts_arr, $content );
	} else {
		if ( in_array( $type, array( 'callout', 'tweet' ) ) ) {
			switch ( $type ) {
				case 'callout':
					$out .= kiddy_callout_renderer( $atts_arr, $content );
					break;
				case 'tweet':
					$out .= kiddy_twitter_renderer( $atts_arr, $content );
					break;
			}
		} else {
			$title = esc_html( $title );
			$out .= ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : '';
			switch ( $type ) {
				case 'text':
					$out .= '<div>' . do_shortcode( $content ) . '</div>';
					break;
				case 'tabs':
					$out .= kiddy_tabs_renderer( $atts_arr, $content );
					break;
				case 'accs':
					$out .= kiddy_accs_renderer( $atts_arr, $content );
					break;

			}
		}
		$out = ! empty( $out ) ? '<div' . ( ! empty( $section_atts ) ? $section_atts : '' ) . ">$out</div>" : '';
	}
	return $out;
}
add_shortcode( 'cws-widget', 'kiddy_shortcode_widget' );

function kiddy_blog( $atts = array() ) {
	extract( shortcode_atts( array(
		'title' => '',
		'columns' => '1',
		'categories' => '',
		'tags' => '',
		'items_per_page' => get_option( 'posts_per_page' ),
		'use_carousel' => '0',
		'custom_layout' => '0',
		'post_text_length' => '',
		'button_name' => '',
		'enable_lightbox' => '',
		'hide_meta' => '',
	), $atts));

	$categories = explode( ',', $categories );
	$categories = kiddy_filter_by_empty( $categories );	
	$tags = explode( ',', $tags );
	$tags = kiddy_filter_by_empty( $tags );

	$out = '';

	$header_content = '';
	ob_start();

	/* carousel_nav */
	$title = esc_html( $title );
	echo ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : '';
	if ( $use_carousel ) {
		wp_enqueue_script ('owl_carousel');
		echo "<div class='carousel_nav_panel_container'><div class='carousel_nav_panel clearfix'><span class='prev'></span><span class='next'></span></div></div>";
	}
	$header_content .= ob_get_clean();

	$column_style = ($columns >= '2');
	$query_args = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'posts_per_page' => (int) $items_per_page,
		'this_shortcode' => true,
		'column_style' => $column_style,
		'custom_layout' => (int) $custom_layout,
		'post_text_length' => (int) $post_text_length,
		'button_name' => $button_name,
		'enable_lightbox' => $enable_lightbox,
		'hide_meta' => $hide_meta,
		'column_count' => (int) $columns,
	);

	if ( ! empty( $categories ) && ! empty( $tags ) ) {
		$query_args['tax_query'] = array(
		      'relation' => 'AND',
		      array(
		        'taxonomy' => 'category',
		        'field' => 'slug',
		        'terms' => $categories,
		      ),
		      array(
		        'taxonomy' => 'post_tag',
		        'field' => 'slug',
		        'terms' => $tags,
		      )
		);
	} elseif ( ! empty( $categories ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $categories,
			),
		);
	} elseif ( ! empty( $tags ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $tags,
			),
		);
	}

	$q = new WP_Query( $query_args );

	if ( $q->have_posts() ) {
		$section_class = 'news';
		$section_class .= $columns == '1' ? ' news-large' : ' news-pinterest';
		$grid_class = 'grid';
		$grid_class .= $columns != '1' ? " grid-$columns" : '';
		$grid_class .= $use_carousel ? ' news_carousel' : ( $columns != '1' ? ' isotope' : '');


		if ($use_carousel) {
			wp_enqueue_script ('owl_carousel');
		} elseif ($columns != '1') {
			wp_enqueue_script ('isotope');
		}

		$column_style = $columns >= '2' ? true : false;

		$new_blogtype = $columns == '1' ? 'large' : $columns;
		$old_blogtype = kiddy_get_page_meta_var( array( 'blog', 'blogtype' ) );
		if ( ! ( is_bool( $old_blogtype ) && ! $old_blogtype ) ) { kiddy_set_page_meta_var( array( 'blog', 'blogtype' ), $new_blogtype ); }

		ob_start();
			echo "<section class='$section_class'>";
				echo ! empty( $header_content ) ? "<div class='cws_blog_header'>$header_content</div>" : '';
				echo "<div class='cws_wrapper'>";
					echo "<div class='$grid_class'>";
						kiddy_blog_output( $q );
					echo '</div>';
				echo '</div>';
			echo '</section>';
		$out .= ob_get_clean();

		if ( ! ( is_bool( $old_blogtype ) && ! $old_blogtype ) ) { kiddy_set_page_meta_var( array( 'blog', 'blogtype' ), $old_blogtype ); }
	}

	return $out;
}
add_shortcode( 'cws_sc_blog', 'kiddy_blog' );

function kiddy_cws_portfolio( $atts = array() ) {
	extract( shortcode_atts( array(
		'title' => '',
		'columns' => '4',
		'categories' => '',
		'mode' => 'grid_with_filter',
		'portcontent' => 'exerpt',
		'items_per_page' => get_option( 'posts_per_page' ),
		'exclude' => array(),
		'disable_pagination' => false,
	), $atts));

	$p_id = get_queried_object_id();

	$filter = 'all';

	$categories = explode( ',', $categories );
	$categories = kiddy_filter_by_empty( $categories );

	$query_args = array(
		'post_type' => 'cws_portfolio',
		'portcontent' => $portcontent,
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
	);

	if ( in_array( $mode, array( 'grid', 'grid_with_filter', 'carousel' ) ) ) { $query_args['posts_per_page'] = $items_per_page; }

	$tax_query = array();
	if ( ! empty( $categories ) ) {
		$tax_query[] = array(
			'taxonomy' => 'cws_portfolio_cat',
			'field' => 'slug',
			'terms' => $categories,
		);
	}

	if ( ! empty( $tax_query ) ) { $query_args['tax_query'] = $tax_query; }

	$excluded_posts = is_array( $exclude ) ? $exclude : kiddy_json_sc_attr_conversion( $exclude );
	$excluded_posts = $excluded_posts ? $excluded_posts : array();
	if ( ! empty( $excluded_posts ) ) {
		$query_args['post__not_in'] = $excluded_posts;
	}

	$q = new WP_Query( $query_args );

	$section_class = 'cws_portfolio';
	$section_class .= in_array( $columns, array( '2', '3', '4' ) ) ? ' massonry' : '';

	$out = '';

	if ( $q->have_posts() ) {
		$out .= "<section class='$section_class'>";

			ob_start();

			$use_filter = false;
			$use_carousel = false;

			/* filter */
		if ( $mode == 'grid_with_filter' ) {
			$avail_cats = $categories;
			if ( empty( $avail_cats ) ) {
				$avail_cats = cws_get_portfolio_cat_slugs();
			}
			if ( ! empty( $avail_cats ) ) {
				$use_filter = true;
			}
		} /* \filter */

			/* carousel_nav */
			else if ( $mode == 'carousel' ) {
				$use_carousel = true;
				wp_enqueue_script ('owl_carousel');
			}
			/* carousel_nav */
			$title = esc_html( $title );
			echo ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : '';

			if ( $use_filter ) {
				echo "<div class='cws_portfolio_filter_container'>";
					echo "<select class='cws_portfolio_filter'>";
						echo "<option value='$filter'>" . esc_html__( 'All', 'kiddy-essentials' ) . '</option>';
				foreach ( $avail_cats as $avail_cat ) {
					$cat = get_term_by( 'slug', $avail_cat, 'cws_portfolio_cat' );
					$cat_name = esc_html( $cat->name );
					echo '<option value="'. esc_attr( $avail_cat ). "\">$cat_name</option>";
				}
					echo '</select>';
				echo '</div>';
			}

			if ( $use_carousel ) {
				wp_enqueue_script ('owl_carousel');
				echo "<div class='carousel_nav_panel_container'><div class='carousel_nav_panel clearfix'><span class='prev'></span><span class='next'></span></div></div>";
			}

			wp_enqueue_script ('isotope');

			$header_content = ob_get_clean();
			$out .= ! empty( $header_content ) ? "<div class='cws_portfolio_header'>$header_content</div>" : '';
			$columns = (int) $columns;
			$items_section_class = 'cws_portfolio_items grid' . ( in_array( $columns, array( '2', '3', '4' ) ) ? " grid-$columns" : '' );
			$items_section_class .= $mode == 'carousel' ? ' portfolio_carousel' : ' isotope';
			$out .= "<div class='cws_wrapper'>";
				$out .= "<div class='$items_section_class'>";
					ob_start();
					render_cws_portfolio( $q, $columns );
					$out .= ob_get_clean();
				$out .= '</div>';
			$out .= '</div>';

			if ( in_array( $mode, array( 'grid', 'grid_with_filter' ) ) ) {
				$out .= "<input type='hidden' class='cws_portfolio_ajax_data' value='" . esc_attr(
					json_encode(
						array(
							'p_id' => $p_id,
							'cols' => $columns,
							'mode' => $mode,
							'portcontent' => $portcontent,
							'cats' => $categories,
							'exclude' => $excluded_posts,
							'filter' => $filter,
							'posts_per_page' => $items_per_page,
							)
						)
					) . "' />";
				$max_paged = ceil( $q->found_posts / $items_per_page );
				if ( ! $disable_pagination && $max_paged > 1 ) {
					ob_start();
					kiddy_pagination( 1, $max_paged );
					$out .= ob_get_clean();
				}
			}

			$out .= '</section>';
	}

	return $out;
}
add_shortcode( 'cws_sc_portfolio', 'kiddy_cws_portfolio' );

function kiddy_cws_portfolio_fw( $atts = array() ) {
	extract( shortcode_atts( array(
		'title' => '',
		'columns' => '6',
		'sel_posts_by' => 'none',
		'categories' => '',
		'post_ids' => '',
		'usefilter' => '0',
		'items_per_page' => get_option( 'posts_per_page' ),
	), $atts));

	$columns = (int) $columns;
	$categories = explode( ',', $categories );
	$categories = kiddy_filter_by_empty( $categories );

	$post_ids = explode( ',', $post_ids );
	$post_ids = kiddy_filter_by_empty( $post_ids );

	if ( $sel_posts_by == 'titles' && ! empty( $post_ids ) ) {
		$items_per_page = count( $post_ids );
	}

	$thumb_dims = get_cws_portfolio_fw_thumb_dims( $columns );
	$out = '';

	$header_class = 'cws_portfolio_header';
	$header_content = '';
	$has_filter = $sel_posts_by === 'cats' && ! empty( $categories ) && $usefilter;
	$title = esc_html( $title );
	$header_content .= ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : '';
	if ( $has_filter ) {
		$header_content .= "<div class='cws_portfolio_filter_container'>";
		$header_content .= "<select class='cws_portfolio_filter'>";
			$header_content .= "<option value='all'>" . esc_html__( 'All', 'kiddy-essentials' ) . '</option>';
		foreach ( $categories as $cat_slug ) {
			$cat_obj = get_term_by( 'slug', $cat_slug, 'cws_portfolio_cat' );
			$cat_name = $cat_obj->name;
			$header_content .= '<option value="'.esc_attr( $cat_slug ).">$cat_name</option>";
		}
		$header_content .= '</select>';
		$header_content .= '</div>';
	}

	$query_args = array(
		'post_type' => 'cws_portfolio',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'posts_per_page' => $items_per_page,
	);

	if ( $sel_posts_by == 'cats' && ! empty( $categories ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'cws_portfolio_cat',
				'field' => 'slug',
				'terms' => $categories,
			),
		);
	} else if ( $sel_posts_by == 'titles' && ! empty( $post_ids ) ) {
		$query_args['post__in'] = $post_ids;
	}

	$q = new WP_Query( $query_args );
	if ( $q->have_posts() ) :

		$multiple = $q->post_count > 1;
		$gallery_id = uniqid( 'cws-gallery-' );

		$out .= "<section class='cws_portfolio_fw'>";
			$out .= ! empty( $header_content ) ? "<div class='fw_row_content_wrapper'><div class='$header_class'>$header_content</div></div>" : '';
			$out .= "<div class='grid_fw col-$columns isotope'>";
		while ( $q->have_posts() ) :
			$q->the_post();
			$pid = get_the_id();
			if ( has_post_thumbnail() ) {
				ob_start();
				render_cws_portfolio_fw_item( $pid, $thumb_dims, $multiple, $gallery_id );
				$out .= ob_get_clean();
			}
				endwhile;
				wp_reset_postdata();
			$out .= '</div>';
		if ( $has_filter ) {
			$ajax_data = array(
				'columns' => $columns,
				'categories' => $categories,
				'items_per_page' => $items_per_page,
			);
			$ajax_data_json = esc_attr( json_encode( $ajax_data ) );
			$out .= "<input type='hidden' class='cws_portfolio_fw_ajax_data' value='$ajax_data_json' />";
		}
		$out .= '</section>';

	endif;

	return $out;
}
add_shortcode( 'cws_sc_portfolio_fw', 'kiddy_cws_portfolio_fw' );

function kiddy_cws_ourteam( $atts = array() ) {
	extract( shortcode_atts( array(
		'title' => '',
		'mode' => 'grid',
		'categories' => '',
		'tags' => '',
		'items_per_page' => get_option( 'posts_per_page' ),
	), $atts));

	$p_id = get_queried_object_id();

	$filter = 'all';

	$categories = explode( ',', $categories );
	$categories = kiddy_filter_by_empty( $categories );
	$tags = explode( ',', $tags );
	$tags = kiddy_filter_by_empty( $tags );

	$query_args = array(
		'post_type' => 'cws_staff',
		'ignore_sticky_posts' => true,
		'post_status' => 'publish',
		'orderby'	=> 'menu_order',
		'order'		=> 'ASC'
	);

	if ( in_array( $mode, array( 'grid', 'grid_with_filter' ) ) ) { $query_args['posts_per_page'] = $items_per_page; }
	$tax_query = array();
	if ( ! empty( $categories ) ) {
		$tax_query[] = array(
			'taxonomy' => 'cws_staff_member_department',
			'field' => 'slug',
			'terms' => $categories,
		);
	}
	if ( ! empty( $tags ) ) {
		$tax_query[] = array(
			'taxonomy' => 'cws_staff_member_position',
			'field' => 'slug',
			'terms' => $tags,
		);
	}

	if ( ! empty( $tax_query ) ) { $query_args['tax_query'] = $tax_query; }

	$q = new WP_Query( $query_args );

	$section_class = 'cws_ourteam';

	$out = '';

	if ( $q->have_posts() ) {
		$out .= "<section class='$section_class'>";

			ob_start();

			$use_filter = false;
			$use_carousel = false;

			/* filter */
		if ( $mode == 'grid_with_filter' ) {
			$avail_cats = $categories;
			if ( empty( $avail_cats ) ) {
				$avail_cats = cws_get_staff_cat_slugs();
			}
			if ( ! empty( $avail_cats ) ) {
				$use_filter = true;
			}
		} /* \filter */

			/* carousel_nav */
			else if ( $mode == 'carousel' ) {
				$use_carousel = true;
				wp_enqueue_script ('owl_carousel');
			}
			/* carousel_nav */
			$title = esc_html( $title );
			echo ! empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : '';

			if ( $use_filter ) {
				echo "<div class='cws_ourteam_filter_container'>";
					echo "<select class='cws_ourteam_filter'>";
						echo "<option value='$filter'>" . esc_html__( 'All', 'kiddy-essentials' ) . '</option>';
				foreach ( $avail_cats as $avail_cat ) {
					$cat = get_term_by( 'slug', $avail_cat, 'cws_staff_member_department' );
					$cat_name = $cat->name;
					echo '<option value="'.esc_attr( $avail_cat )."\">$cat_name</option>";
				}
					echo '</select>';
				echo '</div>';
			}

			if ( $use_carousel ) {
				wp_enqueue_script ('owl_carousel');
				echo "<div class='carousel_nav_panel_container'><div class='carousel_nav_panel clearfix'><span class='prev'></span><span class='next'></span></div></div>";
			}
			wp_enqueue_script ('isotope');
			$header_content = ob_get_clean();
			$out .= ! empty( $header_content ) ? "<div class='cws_ourteam_header'>$header_content</div>" : '';

			$items_section_class = 'cws_ourteam_items grid grid-4';
			$items_section_class .= $mode == 'carousel' ? ' ourteam_carousel' : ' isotope';
			$out .= "<div class='cws_wrapper'>";
				$out .= "<div class='$items_section_class'>";
					ob_start();
					render_cws_ourteam( $q );
					$out .= ob_get_clean();
				$out .= '</div>';
			$out .= '</div>';

			if ( in_array( $mode, array( 'grid', 'grid_with_filter' ) ) ) {
				$out .= "<input type='hidden' class='cws_ourteam_ajax_data' value='" . esc_attr( json_encode( array( 'p_id' => $p_id, 'mode' => $mode, 'cats' => $categories, 'filter' => $filter, 'posts_per_page' => $items_per_page ) ) ) . "' />";
				$max_paged = ceil( $q->found_posts / $items_per_page );
				if ( $max_paged > 1 ) {
					ob_start();
					kiddy_pagination( 1, $max_paged );
					$out .= ob_get_clean();
				}
			}

			$out .= '</section>';
	}

	return $out;
}
add_shortcode( 'cws_sc_ourteam', 'kiddy_cws_ourteam' );

/* WIDGET RENDERERS */

function kiddy_pricecol_renderer( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'encouragement' => '',
		'currency' => '',
		'price' => '',
		'price_description' => '',
		'order_url' => '#',
		'button_text' => '',
		'ishilited' => '0',
		'atts' => '',
	), $atts));

	$out = '';
	ob_start();

		ob_start();
			$title = esc_html( $title );
			$encouragement = esc_html( $encouragement );
			echo ! empty( $title ) ? "<div class='title_section'>$title</div>" : '';
			echo ! empty( $encouragement ) ? "<div class='encouragement'>$encouragement</div><div class='separate'></div>" : '';

			ob_start();
				preg_match( '#(.|,)\d+$#', $price, $matches );
				$fract_price_part = isset( $matches[0] ) ? $matches[0] : '';
				$main_price_part = !empty( $fract_price_part ) ? esc_html( mb_substr( $price, 0, strpos( $price, $fract_price_part ) ) ) : esc_html( $price );
				$currency = $currency;
				echo ! empty( $currency ) ? "<span class='currency'>$currency</span>" : '';
				echo ! empty( $main_price_part ) ? "<span class='main_price_part gh'>$main_price_part</span>" : ( ! empty( $fract_price_part ) ? "<span class='main_price_part'>$fract_price_part</span>" : '');
				/* price_details */
				ob_start();
					$price_description = $price_description;
					echo ( ! empty( $main_price_part ) && ! empty( $fract_price_part )) ? "<span class='fract_price_part'>$fract_price_part</span>" : '';
					echo ! empty( $price_description ) ? "<span class='price_description'><span>$price_description</span></span>" : '';
				$price_details = ob_get_clean();
				/* end price_details */
				$price_details = $price_details;
				echo ! empty( $price_details ) ? "<span class='price_details'>$price_details</span>" : '';

			$price_content = ob_get_clean();
			echo ! empty( $price_content ) ? "<div class='price_section'><div class='price_container'>$price_content</div></div>" : '';

		$top_section = ob_get_clean();

		echo ! empty( $top_section ) ? "<div class='top_section'>$top_section</div>" : '';

		echo ! empty( $content ) ? "<div class='desc_section'>" . wptexturize( do_shortcode( $content ) ) . '</div>' : '';

	$box1 = ob_get_clean();

	$out .= ! empty( $box1 ) ? "<div>$box1</div>" : '';

	ob_start();
		$order_url = esc_url( $order_url );
		echo ! empty( $button_text ) ? "<div class='btn_section'><a class='cws_button' href='$order_url'>$button_text<div class='hover-btn'></div><div class='button-shadow'></div></a></div>" : '';
	$box2 = ob_get_clean();

	$out .= ! empty( $box2 ) ? "<div>$box2</div>" : '';

	return $out;
}

function kiddy_callout_renderer( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'c_btn_href' => '#',
		'c_btn_text' => '',
		'custom_pattern' => array(),
		'custom_colors' => '0',
		'custom_color' => '#26b4d7',
		'custom_text_color' => '#fff',
		'custom_button_color' => '#0eecbd',
		'custom_button_hover_color' => '#0eecbd',
		'custom_text_button_color' => '#fff',
	), $atts));
	$out = '';

	$section_atts = '';
	$section_class = 'cws_callout';
	$section_styles = '';

	$button_styles_attr = '';

	$custom_text_color = esc_attr( $custom_text_color );
	$custom_button_color = esc_attr( $custom_button_color );
	$custom_button_hover_color = esc_attr( $custom_button_hover_color );
	$custom_text_button_color = esc_attr( $custom_text_button_color );
	$custom_color = esc_attr( $custom_color );
	$c_btn_href = esc_url( $c_btn_href );
	$c_btn_text = esc_html( $c_btn_text );
	$title = esc_html( $title );

	if ( $custom_colors ) {
		$section_class .= ' customized';
		$section_styles .= ! empty( $custom_text_color ) ? "color:$custom_text_color;" : '';
		$section_styles .= ! empty( $custom_color ) ? "background-color:$custom_color;" : '';
		$section_styles .= ! empty( $custom_pattern['row'] ) ? 'background-image:url('.$custom_pattern['row'].');' : '';

		$button_styles_attr .= ! empty( $custom_button_color ) ? "data-bg_color='$custom_button_color' " : '';
		$button_styles_attr .= ! empty( $custom_button_hover_color ) ? "data-bg_hover_color='$custom_button_hover_color' " : '';
		$button_styles_attr .= ! empty( $custom_text_button_color ) ? "text_color='$custom_text_button_color' " : '';
	}
	$section_atts .= ! empty( $section_class ) ? " class='$section_class'" : '';
	$section_atts .= ! empty( $section_styles ) ? " style='$section_styles'" : '';

	$bees_icon = '';
	if ( kiddy_get_option('menu-with-bees') == 1 ) {
		$bees_icon .= '<div class="bees bees-end"><span></span></div>';
	}

	ob_start();
	echo ! empty( $title ) ? "<div class='callout_title'" . ( $custom_colors ? " style='color:$custom_text_color;'" : '' ) . ">$bees_icon$title</div>" : '';
	echo ! empty( $title ) ? ! empty( $content ) ? "<div class='separate'".($custom_colors ? " style='background-color:$custom_button_color'" : '').'></div>' : '' : '';
	echo ! empty( $content ) ? "<div class='callout_text'>" . wptexturize( do_shortcode( $content ) ) . '</div>' : '';
	$box1 = ob_get_clean();

	$out .= ! empty( $box1 ) ? "<div class='content_section'>$box1</div>" : '';

	$out .= ! empty( $c_btn_text ) ? "<div class='button_section'><a href='$c_btn_href' class='cws_button xlarge".($custom_colors ? ' customized' : '')."' " . $button_styles_attr . ">$c_btn_text<div class='button-shadow'></div></a></div>" : '';

	$out = ! empty( $out ) ? '<div ' . ( ! empty( $section_atts ) ? $section_atts : '' ) . ">$out</div>" : '';

	return $out;
}

function kiddy_tabs_renderer( $atts, $content ) {
	extract( shortcode_atts( array(
		'altstyle' => '0',
		'vertical' => '0',
		'items' => '0',
	), $atts));
	$out = '';
	$section_class = 'cws_ce_content ce_tabs';
	$section_class .= $altstyle ? ' alt' : '';
	$section_class .= $vertical ? ' vertical' : '';
	$GLOBALS['cws_tabs_currently_rendered'] = array();
	do_shortcode( $content );
	$tab_items = $GLOBALS['cws_tabs_currently_rendered'];
	unset( $GLOBALS['cws_tabs_currently_rendered'] );
	if ( ! empty( $tab_items ) ) {
		$out .= "<div class='$section_class'>";
		$out .= "<div class='tabs" . ( ! $vertical ? ' clearfix' : '' ) . "'>";
		foreach ( $tab_items as $tab_item ) {
			$tab_class = 'tab';
			$tab_class .= isset( $tab_item['open'] ) && $tab_item['open'] ? ' active' : '';
			$out .= "<div class='$tab_class' role='tab' tabindex='" . $tab_item['tabindex'] . "'>";
			if ( isset( $tab_item['iconimg'] ) && ! empty( $tab_item['iconimg'] ) ) {
				$thumb_obj = bfi_thumb( $tab_item['iconimg'],array( 'width' => 30, 'height' => 30, 'crop' => true ), false );
				$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
				$img_src = $thumb_path_hdpi;

				$out .= '<img ' . $img_src . " class='tab_icon' />";
			} else if ( isset( $tab_item['iconfa'] ) && ! empty( $tab_item['iconfa'] ) ) {
					$out .= "<i class='tab_icon fa fa-" . sanitize_html_class( $tab_item['iconfa'] ) . "'></i>";
			}
				$out .= isset( $tab_item['title'] ) && ! empty( $tab_item['title'] ) ? '<span>' . $tab_item['title'] . '</span>' : '';
				$out .= '</div>';
		}
		$out .= '</div>';
		$out .= "<div class='tab_items'>";
		foreach ( $tab_items as $tab_item ) {
			$out .= "<div class='tab_item' role='tabpanel' tabindex='" . $tab_item['tabindex'] . "'" . ( ! isset( $tab_item['open'] ) || ! $tab_item['open'] ? " style='display:none;'" : '' ) . '>';
			$out .= isset( $tab_item['content'] ) ? do_shortcode ($tab_item['content']) : '';
			$out .= '</div>';
		}
		$out .= '</div>';
		$out .= '</div>';
	}
	return $out;
}

function kiddy_accs_renderer( $atts, $content ) {
	extract( shortcode_atts( array(
		'istoggle' => '0',
		'altstyle' => '0',
		'items' => '0',
	), $atts));
	$out = '';
	if ( (int) $items > 0 ) {
		$section_class = 'cws_ce_content';
		$section_class .= $istoggle ? ' ce_toggle' : ' ce_accordion';
		$section_class .= $altstyle ? ' alt' : '';
		$out .= "<div class='$section_class'>" . do_shortcode( $content ) . '</div>';
	}
	return $out;
}

function kiddy_twitter_renderer( $atts, $content = '' ) {
	extract( shortcode_atts( array(
		'in_widget' => false,
		'title' => '',
		'items' => get_option( 'posts_per_page' ),
		'visible' => get_option( 'posts_per_page' ),
		'showdate' => '0',
	), $atts));
	$out = '';
	$tw_username = kiddy_get_option( "tw-username" );
	if ( ! is_numeric( $items ) || ! is_numeric( $visible ) ) { return $out; }
	$tweets = kiddy_getTweets( (int) $items );
	if ( is_string( $tweets ) ) {
		$out .= do_shortcode( "[cws_sc_msg_box title='" . esc_html__( 'Twitter responds:', 'kiddy-essentials' ) . "' text='$tweets' is_closable='1'][/cws_sc_msg_box]" );
	}
	else if ( is_array( $tweets ) && isset($tweets['error']) ){
		echo esc_html($tweets['error']);
	}
	else if ( is_array( $tweets ) ){
		$use_carousel = count( $tweets ) > $visible;

		$section_class = 'cws_tweets';
		$section_class .= $use_carousel ? ' tweets_carousel' : '';
		$section_class .= $use_carousel && empty( $title ) ? ' paginated' : '';
		$out .= !empty( $title ) ? KIDDY_BEFORE_CE_TITLE . "<div>$title</div>" . KIDDY_AFTER_CE_TITLE : "";

		$out .= "<div class='$section_class'>";
			$out .= "<div class='cws_wrapper'>";
				$carousel_item_closed = false;
		for ( $i = 0; $i < count( $tweets ); $i++ ) {
			$tweet = $tweets[ $i ];
			if ( $use_carousel && ( $i == 0 || $carousel_item_closed ) ) {
										wp_enqueue_script ('owl_carousel');
				$out .= "<div class='item'>";
				$carousel_item_closed = false;
			}
			$tweet_text = isset( $tweet['text'] ) ? $tweet['text'] : '';
			$tweet_entitties = isset( $tweet['entities'] ) ? $tweet['entities'] : array();
			$tweet_urls = isset( $tweet_entitties['urls'] ) && is_array( $tweet_entitties['urls'] ) ? $tweet_entitties['urls'] : array();
			foreach ( $tweet_urls as $tweet_url ) {
				$display_url = isset( $tweet_url['display_url'] ) ? $tweet_url['display_url'] : "";
				$received_url = isset( $tweet_url['url'] ) ? $tweet_url['url'] : "";
				$html_url = "<a href='$received_url'>$display_url</a>";
				$tweet_text = substr_replace( $tweet_text, $html_url, strpos( $tweet_text, $received_url ), strlen( $received_url ) );
			}

			$item_content = '';
			$item_content .= "<a href='http://twitter.com/$tw_username' class='follow_us fa fa-twitter' target='_blank'></a>";
			$item_content .= ! empty( $tweet_text ) ? "<div class='tweet_content'>$tweet_text</div>" : '';
			if ( $showdate ) {
				$tweet_date = isset( $tweet['created_at'] ) ? $tweet['created_at'] : '';
				$tweet_date_formatted = kiddy_time_elapsed_string( date( 'U', strtotime( $tweet_date ) ) );
				$item_content .= "<div class='tweet_date'>$tweet_date_formatted</div>";
			}
			$out .= ! empty( $item_content ) ? "<div class='cws_tweet'>$item_content</div>" : '';
			$temp1 = ( $i + 1 ) / (int) $visible;
			if ( $use_carousel && ( $temp1 - floor( $temp1 ) == 0 || $i == count( $tweets ) - 1 ) ) {
				$out .= '</div>';
				$carousel_item_closed = true;
			}
		}
			$out .= '</div>';
		$out .= '</div>';
	}
	return $out;
}

function kiddy_time_elapsed_string( $ptime ) {
	$etime = time() - $ptime;

	if ( $etime < 1 ) {
		return '0 seconds';
	}

	$a = array(
		365 * 24 * 60 * 60 => 'year',
		30 * 24 * 60 * 60 => 'month',
		24 * 60 * 60 => 'day',
		60 * 60 => 'hour',
		60  => 'minute',
		1  => 'second',
	);
	$a_plural = array(
	'year' => 'years',
	'month'  => 'months',
	'day'    => 'days',
	'hour'   => 'hours',
	'minute' => 'minutes',
	'second' => 'seconds',
	);

	foreach ( $a as $secs => $str ) {
		$d = $etime / $secs;
		if ( $d >= 1 ) {
			$r = round( $d );
			return $r . ' ' . ($r > 1 ? $a_plural[ $str ] : $str) . ' ago';
		}
	}
}

function kiddy_tab_item_handler( $title, $content, $open, $iconimg, $iconfa ) {
	array_push( $GLOBALS['tabs'], array( 'title' => $title, 'open' => $open, 'iconimg' => $iconimg, 'iconfa' => $iconfa ) );
	array_push( $GLOBALS['tab_items_content'], $content );
}

function kiddy_item_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'title' => '',
		'open' => '0',
		'iconfa' => '',
		'iconimg' => ''
	), $atts));

	 if (isset($atts['atts'])) {
	  $icon = kiddy_json_sc_attr_conversion($atts['atts']);
	  if (isset($icon->{'fa_icon'})) {
	   $iconfa = $icon->{'fa_icon'};
	  } else if (isset($icon->pbimage)) {
	   $iconimg = $icon->pbimage->row;
	  }
	 }

	$type = $GLOBALS['widget_type'];
	$out = '';
	$item_content = do_shortcode( $content );
	if ( in_array( $type, array( 'accs', 'tabs' ) ) ) {
		if ( $type == 'accs' ) {
			$out .= "<div class='accordion_section" . ( $open ? ' active' : '' ) . "'>";
			$out .= "<div class='accordion_title'>";
			if ( ! empty( $iconimg ) ) {
				$thumb_obj = bfi_thumb( $iconimg,array( 'width' => 30, 'height' => 30, 'crop' => true ), false );
				$thumb_path_hdpi = $thumb_obj[3]['retina_thumb_exists'] ? " src='". esc_url( $thumb_obj[0] ) ."' data-at2x='" . esc_attr( $thumb_obj[3]['retina_thumb_url'] ) ."'" : " src='". esc_url( $thumb_obj[0] ) . "' data-no-retina";
				$img_src = $thumb_path_hdpi;

				$out .= '<img ' . $img_src . " class='accordion_icon custom' />";
			} else {
				$out .= "<i class='accordion_icon" . ( ! empty( $iconfa ) ? ' custom fa fa-' . sanitize_html_class( $iconfa ) : '' ) . "'></i>";
			}
			$title = esc_html( $title );
			$out .= ! empty( $title ) ? "<span>$title</span>" : '';
			$out .= '</div>';
			$out .= ! empty( $item_content ) ? "<div class='accordion_content'" . ( $open ? '' : " style='display:none;'" ) . ">$item_content</div>" : '';
			$out .= '</div>';
		} else if ( $type == 'tabs' ) {
			if ( isset( $GLOBALS['cws_tabs_currently_rendered'] ) && is_array( $GLOBALS['cws_tabs_currently_rendered'] ) ) {
				$tab_item = $atts;
				$tab_item['content'] = $content;
				$tab_item['tabindex'] = count( $GLOBALS['cws_tabs_currently_rendered'] );
				array_push( $GLOBALS['cws_tabs_currently_rendered'], $tab_item );
			}
		}
	}
	return $out;
}
add_shortcode( 'item', 'kiddy_item_shortcode' );

?>
