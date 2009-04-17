<?php
/*
Plugin Name: Collapsing Links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Description: Uses javascript to expand and collapse links to show the posts that belong to the link category 
Author: Robert Felty
Version: 0.2.7
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

$url = get_settings('siteurl');
if (!is_admin()) {
  add_action('wp_head', wp_enqueue_script('collapsFunctions',
  "$url/wp-content/plugins/collapsing-links/collapsFunctions.js", '', '1.2'));
  add_action('wp_head', wp_enqueue_script('scriptaculous-effects'));
  add_action( 'wp_head', array('collapsLink','get_head'));
  add_action( 'wp_footer', array('collapsLink','get_foot'));
}
add_action('activate_collapsing-links/collapsLink.php', array('collapsLink','init'));
add_action('admin_menu', array('collapsLink','setup'));

class collapsLink {

	function init() {
    $style="span.collapsLink {border:0;
padding:0; 
margin:0; 
cursor:pointer;
/* font-family: Monaco, 'Andale Mono', Courier, monospace;*/
}

#sidebar li.collapsLink:before {content:'';} 
#sidebar li.collapsLink {list-style-type:none}
#sidebar li.collapsLinkItem {
       text-indent:-1em;
       margin:0 0 0 1em;}
li.widget.collapsLink ul {margin-left:.5em;}
#sidebar li.collapsLinkItem:before {content: '\\\\00BB \\\\00A0' !important;} 
#sidebar li.collapsLink .sym {
   font-size:1.2em;
   font-family:Monaco, 'Andale Mono', 'FreeMono', 'Courier new', 'Courier', monospace;
    padding-right:5px;}";
    if( function_exists('add_option') ) {
      update_option( 'collapsLinkOrigStyle', $style);
    }
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
        'animate' => '0',
        'nofollow' => '1',
        'debug' => '0'
      ));
      if( function_exists('add_option') ) {
        add_option( 'collapsLinkOptions', $options);
      }
      if( function_exists('add_option') ) {
        add_option( 'collapsLinkStyle', $style);
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
		include_once( 'collapsLinkUI.php' );
	}

	function get_head() {
		$url = get_settings('siteurl');
    $style=stripslashes(get_option('collapsLinkStyle'));
    echo "<style type='text/css'>
    $style
    </style>\n";
	}
  function get_foot() {
		echo "<script type=\"text/javascript\">\n";
		echo "// <![CDATA[\n";
		echo "// These variables are part of the Collapsing Links Plugin version: 0.2.7\n// Copyright 2007 Robert Felty (robfelty.com)\n";
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
