<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Info
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @author      Abdullah Almesbahi
 * @author      Jesús Mendoza (@vertigo7x)
 * @version     3.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_group')) {

	/**
	 * Main ReduxFramework_info class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_group extends ReduxFramework {

		public $multi; /* multi or static group */
		/**
		 * Field Constructor.
		 *
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value ='', $parent ) {

			parent::__construct( $parent->sections, $parent->args );
			$this->parent = $parent;
			$this->field = $field;
			$this->value = $value;

			$this->multi = isset( $this->field['multi'] ) ? $this->field['multi'] : false; /* default = false */
			$this->def_index = '@';

		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {

/*			if (!empty($this->value[1])) {
				var_dump($this->value[1]);
				$this->value = array(
					array(
						'slide_title' => $this->value[1]['title'],
						'slide_sort' => '0',
					)
				);
			}*/

			$groups = empty( $this->value ) || !is_array( $this->value ) ? array() : $this->value; /* because of default value is the empty string */
			echo '<div class="redux-group">';
			echo '<input type="hidden" class="redux-dummy-slide-count" id="redux-dummy-' . $this->field['id'] . '-count" name="redux-dummy-' . $this->field['id'] . '-count" value="' . count($groups) . '" />';
			echo '<div' . ( $this->multi ? ' class="redux-groups-accordion"' : ' class="single_group_container"' ) . '>';

			// Create dummy content for the adding new ones
			//echo '<div class="redux-groups-accordion-group redux-dummy" id="redux-dummy-' . $this->field['id'] . '"><h3><span class="redux-groups-header">' . esc_html__("New ", "redux-framework") . $this->field['groupname'] . '</span></h3>';

			if ( $this->multi ){
				$this->render_group();
				if ( !empty( $groups ) ){
					/*** ! regularize keys ! ***/
					$group_keys = array_keys( $groups );
					for ( $i=0; $i<count( $group_keys ); $i++ ){
						$buf = $groups[ $group_keys[$i] ];
						unset( $groups[ $group_keys[$i] ] );
						$groups[$i] = $buf;
					}
					/*** \! regularize keys ! ***/
					foreach ( $groups as $group_ind => $group_fields ){
						$group_ind = ( string ) $group_ind;
						if ( $group_ind != $this->def_index ) $this->render_group( array( 'group_index' => $group_ind, 'group' => $group_fields ) );
					}
				}
			}
			else{
				if ( isset( $groups[ $this->def_index ] ) ){
					$this->render_group( array( 'index' => $this->def_index, 'group' => $groups[$this->def_index] ) );
				}
				else{
					$this->render_group( array( 'index' => $this->def_index ) );
				}
			}

			echo '</div>';
			echo $this->multi ? '<a href="javascript:void(0);" class="button redux-groups-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][slide_title][]">' . esc_html__('Add', 'redux-framework') .' '.$this->field['groupname']. '</a><br/>' : '';

			echo '</div>';

		}

		function support_multi($content, $field, $sort) {
			//convert name
			$name = $this->args['opt_name'] . '[' . $field['id'] . ']';
			$content = str_replace($name, $name . '[' . $sort . ']', $content);
			//we should add $sort to id to fix problem with select field
			$content = str_replace(' id="'.$field['id'].'-select"', ' id="'.$field['id'].'-select-'.$sort.'"', $content);
			return $content;
		}

		public function render_group( $atts = array() ){
			extract( shortcode_atts(array(
					'group_index' => $this->def_index,
					'group' => array()
				), $atts) );
			// $this->options[ $this->field['id'] ][0]['title']
			echo $this->multi ? '<div class="redux-groups-accordion-group' . ( $group_index == $this->def_index ? ' redux-dummy" style="display:none;" id="redux-dummy-' . $this->field['id'] . '"' : '"' ) . '>' : '';
			echo ( isset($this->field['groupname']) && !empty( $this->field['groupname'] ) ) ? '<h3>' . '</h3>' : '';
			echo '<div>';//according content open
			echo '<table style="margin-top: 0;" class="redux-groups-accordion redux-group form-table no-border">';
			echo '<fieldset><input type="hidden" id="' . $this->field['id'] . '_slide-title" value="" class="regular-text slide-title" /></fieldset>';
			// echo '<input type="hidden" class="slide-sort" data-name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][@][slide_sort]" id="' . $this->field['id'] . '-slide_sort" value="" />';
			$field_is_title = true;
				foreach ($this->field['fields'] as $field) {
					//we will enqueue all CSS/JS for sub fields if it wasn't enqueued
					$this->enqueue_dependencies($field['type']);

					echo '<tr><td>';
					if(isset($field['class']))
						$field['class'] .= " group";
					else
						$field['class'] = " group";

					if (!empty($field['title']))
						echo '<h4>' . $field['title'] . '</h4>';
					if (!empty($field['subtitle']))
						echo '<span class="description">' . $field['subtitle'] . '</span>';
					$value = isset( $group[$field['id']] ) ? $group[$field['id']] : ( isset( $field['default'] ) ? $field['default'] : '' );
					ob_start();
					$field['name'] = '';
					$this->_field_input($field, $value);

					$content = ob_get_contents();
					ob_end_clean();
					//adding sorting number to the name of each fields in group
					// $name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';
					$name_common_part = $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $group_index . '][' . $field['id'] . ']';
					$index = 0;
					while ( true ){
						$found = preg_match( '|name=".*?"|', $content, $matches, PREG_OFFSET_CAPTURE, $index );
						if ( !$found ) break;
						foreach ($matches as $match) {
							$match_str = $match[0];
							$match_ind = $match[1];
							$new_str = ( $this->multi && ( $group_index == $this->def_index ) ) ? str_replace( 'name=', 'data-name=', $match_str) : $match_str;
							preg_match( '|"(.*)"|', $new_str, $old_names, PREG_OFFSET_CAPTURE );
							if ( !$old_names ) continue;
							$old_name = $old_names[1];
							$old_name_str = $old_name[0];
							$old_name_ind = $old_name[1];
							$is_old_name_in_group = preg_match( "#" . $this->args['opt_name'] . "\[[^\]]*\]#", $old_name_str, $nested_group_prefix, PREG_OFFSET_CAPTURE );
							if ( $is_old_name_in_group ){
								$nested_group_prefix = $nested_group_prefix[0];
								$nested_group_prefix_str = $nested_group_prefix[0];
								$nested_group_prefix_ind = $nested_group_prefix[1];
								$processed_old_name_str = substr_replace( $old_name_str, "", $nested_group_prefix_ind, strlen( $nested_group_prefix_str ) );
							}
							else{
								$processed_old_name_str = $old_name_str;
							}
							$new_str = substr_replace( $new_str, $name_common_part . $processed_old_name_str, $old_name_ind, strlen( $old_name_str ) );
							$content = substr_replace( $content, $new_str, $match_ind, strlen( $match_str ) );
							$index = $match_ind + strlen( $new_str );
						}
					}
					// remove the name property. asigned by the controller, create new data-name property for js
					//$content = str_replace('name=', 'data-name', $content);

					if(($field['type'] === "text") && ($field_is_title)) {
						$content = str_replace('/>', 'data-title="true" />', $content);
						$field_is_title = false;
					}

					//we should add $sort to id to fix problem with select field
					//$content = str_replace(' id="'.$field['id'].'-select"', ' id="'.$field['id'].'-select-'.$sort.'"', $content);
					//$content = str_replace('redux-field redux-container-','redux-field_redux-container-', $content);

					//$content = str_replace(' id="',' id="|', $content);
					//$content = str_replace('redux-color-init','bredux-color-init', $content);
					$content = str_replace("><",">\n<", $content);

					//$content = str_replace('data-editor="','data-editor="|', $content);

					$_field = apply_filters('redux-support-group',$content, $field, 0);
					//ob_end_clean();
					echo $_field;

					echo '</td></tr>';
				}
			echo '</table>';
			echo $this->multi ? '<a href="javascript:void(0);" class="button deletion redux-groups-remove">' . esc_html__('Delete', 'redux-framework').' '. $this->field['groupname']. '</a>' : '';
			echo '</div>';
			echo $this->multi ? '</div>' : '';
		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since 		1.0.0
		 * @access		public
		 * @return		void
		 */
		public function enqueue() {
			wp_enqueue_script('redux-field-group-js', ReduxFramework::$_url . 'inc/fields/group/field_group.js', array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker'), time(), true);
			//wp_enqueue_style('redux-field-group-css', ReduxFramework::$_url . 'inc/fields/group/field_group.css', time(), true);
		}

		public function enqueue_dependencies($field_type) {
			$field_class = 'ReduxFramework_' . $field_type;
			if (!class_exists($field_class)) {
				$class_file = apply_filters('redux-typeclass-load', ReduxFramework::$_dir . 'inc/fields/' . $field_type . '/field_' . $field_type . '.php', $field_class);

				if ($class_file) {
					/** @noinspection PhpIncludeInspection */
					require_once( $class_file );
				}
			}

			if (class_exists($field_class) && method_exists($field_class, 'enqueue')) {
				$enqueue = new $field_class('', '', $this);
				//$enqueue->enqueue();
			}
		}

	}

}
