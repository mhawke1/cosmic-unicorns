<?php
class Kiddy_SCG {
	private $cws_tmce_sc_settings_config = array();

	public function __construct() {
		$this->init();
	}

	private function init() {
		add_filter( 'mce_buttons_3', array($this, 'mce_sc_buttons') );
		add_filter( 'mce_external_plugins', array($this, 'mce_sc_plugin') );
		add_action( 'wp_ajax_cws_ajax_sc_settings', array($this, 'ajax_sc_settings_callback') );
		add_action( 'admin_enqueue_scripts', array($this, 'scg_scripts_enqueue') );

		$this->cws_tmce_sc_settings_config = array(
			'msg_box' => array(
				'title' => esc_html__( 'CWS Message Box', 'kiddy-essentials' ),
				'icon' => 'fa fa-exclamation-circle',
				'paired' => false,
				'fields' => array(
					'type' => array(
						'title' => esc_html__( 'Message type', 'kiddy-essentials' ),
						'type' => 'select',
						'source' => array(
							'info' => array(esc_html__( 'Informational', 'kiddy-essentials' ), true),
							'warning' => array(esc_html__( 'Warning', 'kiddy-essentials' ), false),
							'success' => array(esc_html__( 'Success', 'kiddy-essentials' ), false),
							'error' => array(esc_html__( 'Error', 'kiddy-essentials' ), false)
							),
					),
					'title' => array(
						'title' => esc_html__( 'Title', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'text' => array(
						'title' => esc_html__( 'Text', 'kiddy-essentials' ),
						'type' => 'textarea',
					),
					'is_closable' => array(
						'title' => esc_html__( 'Make this box collapsible', 'kiddy-essentials' ),
						'type' => 'checkbox',
					),
					'customize' => array(
						'title' => esc_html__( 'Customize colors', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_options[color];e:custom_options[icon]"'
					),
					'custom_options[color]' => array(
						'title' => esc_html__( 'Color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
						'addrowclasses' => 'disable',
					),
					'custom_options[icon]' => array(
						'title' => esc_html__( 'Icon', 'kiddy-essentials' ),
						'type' => 'select',
						'addrowclasses' => 'fai disable',
						'source' => 'fa'
					)
				)
			),
			'milestone' => array(
				'title' => esc_html__( 'CWS Milestone', 'kiddy-essentials' ),
				'icon' => 'fa fa-trophy',
				'fields' => array(
					'number' => array(
						'title' => esc_html__( 'Number', 'kiddy-essentials' ),
						'type' => 'number',
						'value' => ''
					),
					'speed' => array(
						'title' => esc_html__( 'Speed', 'kiddy-essentials' ),
						'desc' => esc_html__( 'Should be integer', 'kiddy-essentials' ),
						'type' => 'number',
						'value' => '2000'
					),
					'desc' => array(
						'title' => esc_html__( 'Description', 'kiddy-essentials' ),
						'type' => 'textarea',
						'atts' => 'rows="5"',
						'value' => ''
					),
					'custom_colors' => array(
						'title' => esc_html__( 'Customize colors', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_color_settings[fill_color];e:custom_color_settings[font_color]"',
					),
					'custom_color_settings[fill_color]' => array(
								'title' => esc_html__( 'Filling color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
						'addrowclasses' => 'disable',
							),
					'custom_color_settings[font_color]' => array(
								'title' => esc_html__( 'Font Color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
						'addrowclasses' => 'disable',
					),
					'alt_style' => array(
						'title' => esc_html__( 'Use alternative style', 'kiddy-essentials' ),
						'type' => 'checkbox',
					)
				)
			),
			'progress_bar' => array(
				'title' => esc_html__( 'CWS Progress Bar', 'kiddy-essentials' ),
				'icon' => 'fa fa-tasks',
				'fields' => array(
					'title' => array(
						'title' => esc_html__( 'Title', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'progress' => array(
						'title' => esc_html__( 'Progress', 'kiddy-essentials' ),
						'desc' => esc_html__( 'In percents ( number from 0 to 100 )', 'kiddy-essentials' ),
						'type' => 'number',
						'atts' => 'min="1" max="100" step="1"',
					),
					'customize' => array(
						'title' => esc_html__( 'Customize Color Settings', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_colors[bg_color]"',
					),
					'custom_colors[bg_color]' => array(
								'title' => esc_html__( 'Background Color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
						'addrowclasses' => 'disable',
					)
				)
			),
			'fa' => array(
				'title' => esc_html__( 'CWS Font Awesome Icon', 'kiddy-essentials' ),
				'icon' => 'fa fa-flag',
				'paired' => true,
				'fields' => array(
					'icon' => array(
						'title' => esc_html__( 'Icon', 'kiddy-essentials' ),
						'type' => 'select',
						'addrowclasses' => 'fai',
						'source' => 'fa',
					),
					'shape' => array(
						'title' => esc_html__( 'Shape', 'kiddy-essentials' ),
						'type' => 'radio',
						'value' => array(
							'square' => array(esc_html__( 'Use Squared icon container', 'kiddy-essentials' ), true),
							'round' => array(esc_html__( 'Use Round icon container', 'kiddy-essentials' ), false)
						),
					),
					'size' => array(
						'title' => esc_html__( 'Size', 'kiddy-essentials' ),
						'type' => 'select',
						'source' => array(
							'lg' => array(esc_html__( 'Mini', 'kiddy-essentials' ), false),
							'2x' => array(esc_html__( 'Small', 'kiddy-essentials' ), true),
							'3x' => array(esc_html__( 'Medium', 'kiddy-essentials' ), false),
							'4x' => array(esc_html__( 'Large', 'kiddy-essentials' ), false),
							'5x' => array(esc_html__( 'Extra Large', 'kiddy-essentials' ), false)
						),
					),
					'alt' => array(
						'title' => esc_html__( 'Alternative style', 'kiddy-essentials' ),
						'type' => 'checkbox',
					),
					'customize' => array(
						'title' => esc_html__( 'Customize colors', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_options[text_color];e:custom_options[bg_color];e:custom_options[border_color]"',
					),
					'custom_options[text_color]' => array(
								'title' => esc_html__( 'Font', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
						'addrowclasses' => 'disable',
							),
					'custom_options[bg_color]' => array(
								'title' => esc_html__( 'Background', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
						'addrowclasses' => 'disable',
							),
					'custom_options[border_color]' => array(
								'title' => esc_html__( 'Border color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#fec20b"',
						'addrowclasses' => 'disable',
					),
				)
			),
			'button' => array(
				'title' => esc_html__( 'CWS Button', 'kiddy-essentials' ),
				'icon' => 'fa fa-check-square-o',
				'paired' => true,
				'fields' => array(
					'title' => array(
						'title' => esc_html__( 'Title', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'url' => array(
						'title' => esc_html__( 'Url', 'kiddy-essentials' ),
						'type' => 'text',
						'value' => '#'
					),
					'new_tab' => array(
						'title' => esc_html__( 'Open link in a new window/tab', 'kiddy-essentials' ),
						'type' => 'checkbox',
					),
					'size' => array(
						'title' => esc_html__( 'Size', 'kiddy-essentials' ),
						'type' => 'select',
						'source' => array(
							'mini' => array(esc_html__( 'Mini', 'kiddy-essentials' ), false),
							'small' => array(esc_html__( 'Small', 'kiddy-essentials' ), false),
							'regular' => array(esc_html__( 'Regular', 'kiddy-essentials' ), true),
							'large' => array(esc_html__( 'Large', 'kiddy-essentials' ), false),
							'xlarge' => array(esc_html__( 'Extra large', 'kiddy-essentials' ), false)
						),
					),
					'alt' => array(
						'title' => esc_html__( 'Alternative style', 'kiddy-essentials' ),
						'type' => 'checkbox',
					),
					'full_width' => array(
						'title' => esc_html__( 'Full width', 'kiddy-essentials' ),
						'type' => 'checkbox',
					),
					'customize' => array(
						'title' => esc_html__( 'Customize colors', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_options[text_color];e:custom_options[bg_color];e:custom_options[bg_hover_color]"',
					),
					'custom_options[text_color]' => array(
						'title' => esc_html__( 'Font', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
						'addrowclasses' => 'disable',
					),
					'custom_options[bg_color]' => array(
						'title' => esc_html__( 'Background', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#fec20b"',
						'addrowclasses' => 'disable',
							),
					'custom_options[bg_hover_color]' => array(
						'title' => esc_html__( 'Border color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
						'addrowclasses' => 'disable',
							),
				)
			),
			'testimonial' => array(
				'title' => esc_html__( 'CWS Testimonial', 'kiddy-essentials' ),
				'icon' => 'dashicons dashicons-testimonial',
				'fields' => array(
					'thumbnail' => array(
						'title' => esc_html__( 'Thumbnail', 'kiddy-essentials' ),
						'type' => 'media'
					),
					'text' => array(
						'title' => esc_html__( 'Text', 'kiddy-essentials' ),
						'type' => 'textarea',
						'atts' => 'row="5"'
					),
					'author' => array(
						'title' => esc_html__( 'Author', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'customize' => array(
						'title' => esc_html__( 'Customize colors', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:custom_pattern;e:custom_options[text_color];e:custom_options[bg_color]"',
					),
					'custom_pattern' => array(
						'title' => esc_html__( 'Add Pattern', 'kiddy-essentials' ),
						'addrowclasses' => 'disable',
						'type' => 'media',
					),
					'custom_options[text_color]' => array(
						'title' => esc_html__( 'Font', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
						'addrowclasses' => 'disable',
					),
					'custom_options[bg_color]' => array(
						'title' => esc_html__( 'Background', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
						'addrowclasses' => 'disable',
							),
				)
			),
			'embed' => array(
				'title' => esc_html__( 'Embed audio/video file', 'kiddy-essentials' ),
				'icon' => 'dashicons dashicons-format-video',
				'fields' => array(
					'url' => array(
						'title' => esc_html__( 'Url', 'kiddy-essentials' ),
						'desc' => esc_html__( 'Embed url', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'width' => array(
						'title' => esc_html__( 'Width', 'kiddy-essentials' ),
						'desc' => esc_html__( 'Max width in pixels', 'kiddy-essentials' ),
						'type' => 'number',
					),
					'height' => array(
						'title' => esc_html__( 'Height', 'kiddy-essentials' ),
						'desc' => esc_html__( 'Max height in pixels', 'kiddy-essentials' ),
						'type' => 'number',
					)
				)
			),
			'dropcap' => array(
				'title' => esc_html__( 'CWS Dropcap', 'kiddy-essentials' ),
				'icon' => 'fa fa-font',
				'required' => 'single_char_selected'
			),
			'mark' => array(
				'title' => esc_html__( 'CWS Mark Selection', 'kiddy-essentials' ),
				'icon' => 'fa fa-pencil',
				'paired' => true,
				'required' => 'selection',
				'fields' => array(
					'font_color' => array(
						'title' => esc_html__( 'Font Color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#ffffff"',
					),
					'bg_color' => array(
						'title' => esc_html__( 'Background Color', 'kiddy-essentials' ),
						'type' => 'text',
						'atts' => 'data-default-color="#26b4d7"',
					)
				)
			),
			'custom_list' => array(
				'title' => esc_html__( 'CWS List Selection', 'kiddy-essentials' ),
				'icon' => 'fa fa-list-ul',
				'required' => 'list_selection',
				'fields' => array(
					'list_style' => array(
						'title' => esc_html__( 'List Style', 'kiddy-essentials' ),
						'type' => 'select',
						'source' => array(
							'dot_style' => array(esc_html__( 'Dots', 'kiddy-essentials' ), true, 'd:icon'),
							'checkmarks_style' => array(esc_html__( 'Checkmarks', 'kiddy-essentials' ), false, 'd:icon'),
							'arrow_style' => array(esc_html__( 'Arrow', 'kiddy-essentials' ), false, 'd:icon'),
							'custom_icon_style' => array(esc_html__( 'Custom Icon', 'kiddy-essentials' ), false, 'e:icon'),
						),
					),
					'icon' => array(
						'title' => esc_html__( 'Icon', 'kiddy-essentials' ),
						'type' => 'select',
						'addrowclasses' => 'fai disable',
						'source' => 'fa',
					),
				)
			),
			'carousel' => array(
				'title' => esc_html__( 'CWS Shortcode Carousel', 'kiddy-essentials' ),
				'icon' => 'fa fa-arrows-h',
				'required' => 'sc_selection_or_nothing',
				'paired' => true,
				'def_content' => "<ul><li>" . esc_html__( 'Some content here', 'kiddy-essentials' ) . "</li><li>" . esc_html__( 'Some content here', 'kiddy-essentials' ) . "</li></ul>",
				'fields' => array(
					'title' => array(
						'title' => esc_html__( 'Carousel title', 'kiddy-essentials' ),
						'type' => 'text',
					),
					'autoplay' => array(
						'title' => esc_html__( 'Autoplay', 'the8' ),
						'type' => 'checkbox',
						'atts' => 'data-options="e:autoplay_speed;"',
					),	

					'autoplay_speed' => array(
						'title' => esc_html__( 'Autoplay speed', 'the8' ),
						'type' => 'number',
						'value' => '1000',
						'addrowclasses' => 'disable'
					),						
					'columns' => array(
						'title' => esc_html__( 'Columns', 'kiddy-essentials' ),
						'type' => 'select',
						'source' => array(
							'1' => array(esc_html__( 'One', 'kiddy-essentials' ), true),
							'2' => array(esc_html__( 'Two', 'kiddy-essentials' ), false),
							'3' => array(esc_html__( 'Three', 'kiddy-essentials' ), false),
							'4' => array(esc_html__( 'Four', 'kiddy-essentials' ), false)
						),
					)
				)
			),
			'bee_icon' => array(
				'title' => esc_html__( 'CWS Bee Icon', 'kiddy-essentials' ),
				'icon' => 'fa fa-paint-brush',
				'paired' => false,
				'fields' => array(
					'direction' => array(
						'title' => esc_html__( 'Bee direction', 'kiddy-essentials' ),
						'type' => 'radio',
						'value' => array(
							'left' => array(esc_html__( 'Left', 'kiddy-essentials' ), true),
							'right'  => array(esc_html__( 'Right', 'kiddy-essentials' ), false)
						),
					),
				),
			)			
		);
	}

	public function scg_scripts_enqueue($a) {
		if( $a == 'post-new.php' || $a == 'post.php' ) {
			$prefix = 'cws_sc_';
			$data = array();
			foreach ( $this->cws_tmce_sc_settings_config as $sect_name => $section ) {
				array_push( $data, array(
					'sc_name' => $prefix . $sect_name,
					'title' => isset( $section['title'] ) ? $section['title'] : '',
					'icon' => isset( $section['icon'] ) ? $section['icon'] : '',
					'required' => isset( $section['required'] ) ? $section['required'] : '',
					'def_content' => isset( $section['def_content'] ) ? $section['def_content'] : '',
					'has_options' => isset( $section['fields'] ) && is_array( $section['fields'] ) && !empty( $section['fields'] )
				));
			}
			wp_localize_script('kiddy-metaboxes-js', 'cws_sc_data', $data);
			wp_register_script( 'cws-redux-sc-settings', get_template_directory_uri() . '/core/js/cws_sc_settings_controller.js', array( 'jquery' ) );
			wp_enqueue_script( 'cws-redux-sc-settings' );
		}
	}

	public function mce_sc_buttons ( $buttons ){
		$cws_sc_names = array_keys( $this->cws_tmce_sc_settings_config );
		$cws_sc_prefix = 'cws_sc_';
		foreach ($cws_sc_names as $key => $v) {
			$cws_sc_names[$key] = $cws_sc_prefix . $v;
		}
		$buttons = array_merge( $buttons, $cws_sc_names );
		return $buttons;
	}
	public function mce_sc_plugin ( $plugin_array ){
		$plugin_array['cws_shortcodes'] = get_template_directory_uri() . '/core/js/cws_tmce.js';
		return $plugin_array;
	}
	public function ajax_sc_settings_callback (){
		$shortcode = trim( $_POST['shortcode'] );
		$prefix = 'cws_sc_';
		$selection = isset( $_POST['selection'] ) ? stripslashes( trim( $_POST['selection'] ) ) : '';
		$def_content = isset( $_POST['def_content'] ) ? trim( $_POST['def_content'] ) : '';
		$shortcode = substr($shortcode, 7);
		$paired = isset($this->cws_tmce_sc_settings_config[$shortcode]['paired']) && $this->cws_tmce_sc_settings_config[$shortcode]['paired']? '1' : '0';
		?>
		<script type='text/javascript'>
			var controller = new cws_sc_settings_controller();
		</script>
		<div class="cws_sc_settings_container">
			<input type="hidden" name="cws_sc_name" id="cws_sc_name" value="<?php echo esc_attr($shortcode); ?>" />
			<input type="hidden" name="cws_sc_selection" id="cws_sc_selection" value="<?php echo apply_filters( 'kiddy_dbl_to_sngl_quotes', $selection); ?>" />
			<input type="hidden" name="cws_sc_def_content" id="cws_sc_def_content" value="<?php echo esc_attr($def_content); ?>" />
			<input type="hidden" name="cws_sc_prefix" id="cws_sc_prefix" value="<?php echo esc_attr($prefix); ?>" />
			<input type="hidden" name="cws_sc_paired" id="cws_sc_paired" value="<?php echo esc_attr($paired); ?>" />
	<?php
		$meta = array(
			array (
				'text' => $selection,
				)
			);
		$sc_fields = $this->cws_tmce_sc_settings_config[$shortcode]['fields'];
		cws_mb_fillMbAttributes($meta, $sc_fields);
		echo cws_mb_print_layout($sc_fields, 'cws_sc_');
	?>
		<input type="submit" class="button button-primary button-large" id="cws_insert_button" value="<?php esc_html_e('Insert Shortcode', 'kiddy-essentials' ) ?>">
		</div>
	<?php
		wp_die();
	}
}
?>
