<?php 
class collapsLinkWidget extends WP_Widget {
  function collapsLinkWidget() {
    $widget_ops = array('classname' => 'widget_collapslink', 'description' => 'A list with your feeds links' );
    $this->WP_Widget('collapslink', 'Collapsing Links', $widget_ops);
  }
 
  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
    echo $before_widget . $before_title . $title . $after_title;
       if( function_exists('collapsLink') ) {
        collapsLink($instance);
       } else {
        echo "<ul>\n";
        wp_list_links('sort_column=name&optioncount=1&hierarchical=0');
        echo "</ul>\n";
       }

    echo $after_widget;
  }
 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    include('updateOptions.php');
    //$instance['title'] = strip_tags($new_instance['title']);
 
    return $instance;
  }
 
  function form($instance) {
    $title = strip_tags($instance['title']);
?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
    include('options.txt');
?>
  <p>Style can be set from the <a
  href='options-general.php?page=collapsLink.php'>options page</a></p>
<?php
  }
}
function registerCollapsLinkWidget() {
  register_widget('collapsLinkWidget');
}
	add_action('widgets_init', 'registerCollapsLinkWidget');
