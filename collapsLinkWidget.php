<?php

function collapsLinkWidget($args, $widget_args=1) {
  extract($args, EXTR_SKIP);
  if ( is_numeric($widget_args) )
    $widget_args = array( 'number' => $widget_args );
  $widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
  extract($widget_args, EXTR_SKIP);

  $options = get_option('collapsLinkOptions');
  if ( !isset($options[$number]) )
    return;

  $title = ($options[$number]['title'] != "") ? $options[$number]['title'] : ""; 

    echo $before_widget . $before_title . $title . $after_title;
       if( function_exists('collapsLink') ) {
        collapsLink($number);
       } else {
        echo "<ul>\n";
        wp_list_links('sort_column=name&optioncount=1&hierarchical=0');
        echo "</ul>\n";
       }

    echo $after_widget;
  }


function collapsLinkWidgetInit() {
if ( !$options = get_option('collapsLinkOptions') )
    $options = array();
  $control_ops = array('width' => 400, 'height' => 350, 'id_base' => 'collapsLink');
	$widget_ops = array('classname' => 'collapsLink', 'description' => __('Links expand and collapse to show sublinks and/or posts'));
  $name = __('Collapsing Links');

  $id = false;
  foreach ( array_keys($options) as $o ) {
    // Old widgets can have null values for some reason
    if ( !isset($options[$o]['title']) || !isset($options[$o]['title']) )
      continue;
    $id = "collapsLink-$o"; // Never never never translate an id
    wp_register_sidebar_widget($id, $name, 'collapsLinkWidget', $widget_ops, array( 'number' => $o ));
    wp_register_widget_control($id, $name, 'collapsLinkWidgetControl', $control_ops, array( 'number' => $o ));
  }

  // If there are none, we register the widget's existance with a generic template
  if ( !$id ) {
    wp_register_sidebar_widget( 'collapsLink-1', $name, 'collapsLinkWidget', $widget_ops, array( 'number' => -1 ) );
    wp_register_widget_control( 'collapsLink-1', $name, 'collapsLinkWidgetControl', $control_ops, array( 'number' => -1 ) );
  }

}

// Run our code later in case this loads prior to any required plugins.
if (function_exists('collapsLink')) {
	add_action('widgets_init', 'collapsLinkWidgetInit');
} else {
	$fname = basename(__FILE__);
	$current = get_settings('active_plugins');
	array_splice($current, array_search($fname, $current), 1 ); // Array-fu!
	update_option('active_plugins', $current);
	do_action('deactivate_' . trim($fname));
	header('Lolinkion: ' . get_settings('siteurl') . '/wp-admin/plugins.php?deactivate=true');
	exit;
}

	function collapsLinkWidgetControl($widget_args) {
  global $wp_registered_widgets;
  static $updated = false;

  if ( is_numeric($widget_args) )
    $widget_args = array( 'number' => $widget_args );
  $widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
  extract( $widget_args, EXTR_SKIP );

  $options = get_option('collapsLinkOptions');
  if ( !is_array($options) )
    $options = array();

  if ( !$updated && !empty($_POST['sidebar']) ) {
    $sidebar = (string) $_POST['sidebar'];

    $sidebars_widgets = wp_get_sidebars_widgets();
    if ( isset($sidebars_widgets[$sidebar]) )
      $this_sidebar =& $sidebars_widgets[$sidebar];
    else
      $this_sidebar = array();

    foreach ( $this_sidebar as $_widget_id ) {
      if ( 'collapsLinkWidget' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
        $widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
        if ( !in_array( "collapsLink-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
          unset($options[$widget_number]);
      }
    }
    include('updateOptions.php');
  }
  include('processOptions.php');


    echo '<p style="text-align:right;"><label for="collapsLink-title-'.$number.'">' . __('Title:') . '<input class="widefat" style="width: 200px;" id="collapsLink-title-'.$number.'" name="collapsLink['.$number.'][title]" type="text" value="'.$title.'" /></label></p>';
  include('options.txt');
  ?>
   <?php
    echo '<input type="hidden" id="collapsLink-submit-'.$number.'" name="collapsLink['.$number.'][submit]" value="1" />';

	}
?>
