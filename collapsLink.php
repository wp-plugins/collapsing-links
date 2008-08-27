<?php
/*
Plugin Name: Collapsing Links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Description: Uses javascript to expand and collapse links to show the posts that belong to the link category 
Author: Robert Felty
Version: 0.1.1
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

add_action( 'wp_head', array('collapsLink','get_head'));
add_action('activate_collapsing-links/collapsLink.php', array('collapsLink','init'));
add_action('admin_menu', array('collapsLink','setup'));

class collapsLink {

	function init() {
    $options=array(
			'showLinkCount'=> 'yes' ,
			'catSort'=> 'catName' ,
			'catSortOrder'=> 'ASC' ,
			'sort'=> 'linkName' ,
			'sortOrder'=> 'ASC' ,
			'exclude'=> '' ,
			'expand'=> 0 ,
			'defaultExpand'=> ''
    );
    $collapsLinkOptions=$options;
		if( function_exists('add_option') ) {
//      add_option( 'collapsLinkOptions', $collapsLinkOptions);
		}
	}

	function setup() {
	}

	function get_head() {
		$url = get_settings('siteurl');
    echo "<style type='text/css'>
		@import '$url/wp-content/plugins/collapsing-links/collapsLink.css';
    </style>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "// <![CDATA[\n";
		echo "// These variables are part of the Collapsing Links Plugin version: 0.1.1\n// Copyright 2007 Robert Felty (robfelty.com)\n";
    echo "function expandLink( e, expand ) {
    if (expand==1) {
      expand='+';
      collapse='&mdash;';
    } else if (expand==2) {
      expand='[+]';
      collapse='[&mdash;]';
    } else {
      expand='&#9658;';
      collapse='&#9660;';
    }
    if( e.target ) {
      src = e.target;
    }
    else {
      src = window.event.srcElement;
    }

    srcList = src.parentNode;
    childList = null;

    for( i = 0; i < srcList.childNodes.length; i++ ) {
      if( srcList.childNodes[i].nodeName.toLowerCase() == 'ul' ) {
        childList = srcList.childNodes[i];
      }
    }

    if( src.getAttribute( 'class' ) == 'collapsLink hide' ) {
      childList.style.display = 'none';
      src.setAttribute('class','collapsLink show');
      src.setAttribute('title','click to expand');
      src.innerHTML=expand;
    }
    else {
      childList.style.display = '';
      src.setAttribute('class','collapsLink hide');
      src.setAttribute('title','click to collapse');
      src.innerHTML=collapse;
    }

    if( e.preventDefault ) {
      e.preventDefault();
    }

    return false;
  }\n";

		echo "// ]]>\n</script>\n";
	}
}


		include( 'collapsLinkList.php' );
function collapsLink($number) {
	list_links($number);
}
include('collapsLinkWidget.php');
?>
