<?php
/*
Plugin Name: Collapsing Links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Description: Uses javascript to expand and collapse links to show the posts that belong to the link category 
Author: Robert Felty
Version: 0.2
Author URI: http://robfelty.com
Tags: sidebar, widget, links

Copyright 2007 Robert Felty

This file is part of Collapsing Links

		Collapsing Links is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License as published by 
    the Free Software Foundation; either version 2 of the License, or (at your
    option) any later version.

    Collapsing Links is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Collapsing Links; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/ 

add_action('wp_head', wp_enqueue_script('collapsFunctions', "$url/wp-content/plugins/collapsing-links/collapsFunctions.js"));
add_action('wp_head', wp_enqueue_script('scriptaculous-effects'));
add_action( 'wp_head', array('collapsLink','get_head'));
add_action('activate_collapsing-links/collapsLink.php', array('collapsLink','init'));
add_action('admin_menu', array('collapsLink','setup'));

class collapsLink {

	function init() {
    if (!get_option('collapsLinkOptions')) {
      $options=array('%i%' => array(
        'showLinkCount'=> 'yes' ,
        'catSort'=> 'linkName' ,
        'catSortOrder'=> 'ASC' ,
        'linkSort'=> 'linkName' ,
        'linkSortOrder'=> 'ASC' ,
        'exclude'=> '' ,
        'expand'=> '0' ,
        'defaultExpand'=> '',
        'animate' => '1'
      ));
      if( function_exists('add_option') ) {
        add_option( 'collapsLinkOptions', $options);
      }
    }
	}

	function setup() {
		if( function_exists('add_options_page') ) {
			add_options_page(__('Collapsing Links'),__('Collapsing
      Links'),1,basename(__FILE__),array('collapsLink','ui'));
		}
	}
	function ui() {
		include_once( 'collapsPageUI.php' );
	}

	function get_head() {
		$url = get_settings('siteurl');
    echo "<style type='text/css'>
		@import '$url/wp-content/plugins/collapsing-links/collapsLink.css';
    </style>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "// <![CDATA[\n";
		echo "// These variables are part of the Collapsing Links Plugin version: 0.2\n// Copyright 2007 Robert Felty (robfelty.com)\n";
    $expandSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/expand.gif' alt='expand' />";
    $collapseSym="<img src='". get_settings('siteurl') .
         "/wp-content/plugins/collapsing-links/" . 
         "img/collapse.gif' alt='collapse' />";
    echo "var expandSym=\"$expandSym\";";
    echo "var collapseSym=\"$collapseSym\";";
    echo"
    addLoadEvent(function() {
      autoExpandCollapse('collapsLink');
    });
    ";
		echo "// ]]>\n</script>\n";
	}
}


		include( 'collapsLinkList.php' );
function collapsLink($number) {
	list_links($number);
}
include('collapsLinkWidget.php');
?>
