<?php
	$theme = wp_get_theme();
  $theme_slug = $theme->get('TextDomain') . '_';
  $pbf_redeclares = array($theme_slug.'cws_callout_renderer',$theme_slug.'cws_tab_item_handler',$theme_slug.'cws_pricecol_renderer', $theme_slug.'cws_tabs_renderer', $theme_slug.'cws_toggle_renderer');
?>
