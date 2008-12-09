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


		//$title		= wp_specialchars($options['title']);
    // Here is our little form segment. Notice that we don't need a
    // complete form. This will be embedded into the existing form.
    echo '<p style="text-align:right;"><label for="collapsLink-title-'.$number.'">' . __('Title:') . '<input class="widefat" style="width: 200px;" id="collapsLink-title-'.$number.'" name="collapsLink['.$number.'][title]" type="text" value="'.$title.'" /></label></p>';
  ?>
    <p>
     <input type="checkbox" name="collapsLink[<?php echo $number ?>][showLinkCount]" <?php if ($showLinkCount=='yes')  echo 'checked'; ?> id="collapsLink-showLinkCount-<?php echo $number ?>"></input> <label for="collapsLinkShowLinkCount">Show Link Count </label>
    </p>
    <p>Sort Link Categories by:<br />
     <select name="collapsLink[<?php echo $number ?>][catSort]">
     <option <?php if($catSort=='linkName') echo 'selected'; ?> id="sortLinkName" value='linkName'>Link category name</option>
     <option <?php if($catSort=='linkId') echo 'selected'; ?> id="sortLinkId" value='linkId'>Link category id</option>
     <option <?php if($catSort=='linkSlug') echo 'selected'; ?> id="sortLinkSlug" value='linkSlug'>Link category Slug</option>
     <option <?php if($catSort=='linkOrder') echo 'selected'; ?> id="sortLinkOrder" value='linkOrder'>Link category (term) Order</option>
     <option <?php if($catSort=='linkCount') echo 'selected'; ?> id="sortLinkCount" value='linkCount'>Link category Count</option>
    </select>
     <input type="radio" name="collapsLink[<?php echo $number ?>][catSortOrder]" <?php if($catSortOrder=='ASC') echo 'checked'; ?> id="collapsLink-catSortASC-<?php echo $number ?>" value='ASC'></input> <label for="collapsLinkCatSortASC">Ascending</label>
     <input type="radio" name="collapsLink[<?php echo $number ?>][catSortOrder]" <?php if($catSortOrder=='DESC') echo 'checked'; ?> id="collapsLink-catSortDESC-<?php echo $number ?>" value='DESC'></input> <label for="collapsLinkCatSortDESC">Descending</label>
    </p>
    <p>Sort Links by:<br />
     <select name="collapsLink[<?php echo $number ?>][linkSort]">
     <option <?php if($linkSort=='linkName') echo 'selected'; ?> id="sortLinkName-<?php echo $number ?>" value='linkName'>Link name</option>
     <option <?php if($linkSort=='linkId') echo 'selected'; ?> id="sortLinkId-<?php echo $number ?>" value='linkId'>Link id</option>
     <option <?php if($linkSort=='linkUrl') echo 'selected'; ?> id="sortLinkUrl-<?php echo $number ?>" value='linkUrl'>Link Url</option>
     <option <?php if($linkSort=='linkRating') echo 'selected'; ?> id="sortLinkOrder-<?php echo $number ?>" value='linkRating'>Link Rating</option>
    </select>
     <input type="radio" name="collapsLink[<?php echo $number ?>][linkSortOrder]" <?php if($linkSortOrder=='ASC') echo 'checked'; ?> id="linkSortASC" value='ASC'></input> <label for="linkPostASC">Ascending</label>
     <input type="radio" name="collapsLink[<?php echo $number ?>][linkSortOrder]" <?php if($linkSortOrder=='DESC') echo 'checked'; ?> id="linkPostDESC" value='DESC'></input> <label for="linkPostDESC">Descending</label>
    </p>
    <p>Expanding and collapse characters:<br />
     html: <input type="radio" name="collapsLink[<?php echo $number ?>][expand]" <?php if($expand==0) echo 'checked'; ?> id="expand0" value='0'></input> <label for="expand0">&#9658;&nbsp;&#9660;</label>
     <input type="radio" name="collapsLink[<?php echo $number ?>][expand]" <?php if($expand==1) echo 'checked'; ?> id="expand1" value='1'></input> <label for="expand1">+&nbsp;&mdash;</label>
     <input type="radio" name="collapsLink[<?php echo $number ?>][expand]"
     <?php if($expand==2) echo 'checked'; ?> id="expand2" value='2'></input>
     <label for="expand2">[+]&nbsp;[&mdash;]</label><br />
     images:
     <input type="radio" name="collapsLink[<?php echo $number ?>][expand]"
     <?php if($expand==3) echo 'checked'; ?> id="expand0" value='3'></input>
     <label for="expand3"><img src='<?php echo get_settings('siteurl') .
     "/wp-content/plugins/collapsing-links/" ?>img/collapse.gif' />&nbsp;<img
     src='<?php echo get_settings('siteurl') .
     "/wp-content/plugins/collapsing-links/" ?>img/expand.gif' /></label>
    </p>
    <p>Auto-expand these link categories (separated by commas):<br />
     <input type="text" name="collapsLink[<?php echo $number ?>][defaultExpand]" value="<?php echo $defaultExpand ?>" id="collapsLink-defaultExpand-<?php echo $number ?>"</input> 
    </p>
    <p> 
     <select name="collapsLink[<?php echo $number ?>][inExclude]">
     <option  <?php if($inExclude=='include') echo 'selected'; ?> id="inExcludeInclude-<?php echo $number ?>" value='include'>Include</option>
     <option  <?php if($inExclude=='exclude') echo 'selected'; ?> id="inExcludeExclude-<?php echo $number ?>" value='exclude'>Exclude</option>
     </select>
     these link categories (separated by commas):<br />
    <input type="text" name="collapsLink[<?php echo $number ?>][inExcludeCats]" value="<?php echo $inExcludeCats ?>" id="collapsLink-inExcludeCats-<?php echo $number ?>"</input> 
    </p>
   <p>
   <input type="checkbox" name="collapsLink[<?php echo $number
   ?>][animate]" <?php if ($animate==1) echo
   'checked'; ?> id="animate-<?php echo $number ?>"></input> <label
   for="animate">Animate collapsing and expanding</label>
   </p>
   <?php
    echo '<input type="hidden" id="collapsLink-submit-'.$number.'" name="collapsLink['.$number.'][submit]" value="1" />';

	}
?>
