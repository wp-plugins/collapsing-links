=== Collapsing Links ===
Contributors: robfelty
Donate link: http://blog.robfelty.com/plugins/collapsing-links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Tags: links, sidebar, widget
Requires at least: 2.3
Tested up to: 2.6.5
Stable tag: 0.2.7

This widget uses Javascript to dynamically expand or collapsable the set of
links for each link category.

== Description ==

This is a very simple plugin that uses Javascript to form a collapsable set of
links in the sidebar for the links (blogroll). Every link corresponding to a
given link category will be expanded.

You can use multiple instances of the widget, each with its own set of options. In this way you could have one set of links for certain categories one place on your page, and another widget with a different set of links somewhere else.

It is based off of the Collapsing Categories and Collapsing Pages plugins.

= What's new in 0.2.6? =
* Added option to use custom symbols

== Installation ==

IMPORTANT!
Please deactivate before upgrading, then re-activate the plugin.

Unpackage contents to wp-content/plugins/ so that the files are in a
collapsing-links directory. Activate the plugin in your Wordpress Admin
interface -- Collapsing Links. 

MANUAL INSTALLATION

To use the plugin manually,
change the following here appropriate (most likely sidebar.php):

Change From:

    <ul>
     `<?php get_links_list(); ?>`
    </ul>

To something of the following:
`
    <?php
     if( function_exists('collapsLink') ) {
      collapsLink('%i%');
     } else {
      echo "<ul>\n";
      get_links_list();
      echo "</ul>\n";
     }
    ?>
`
WIDGET INSTALLATION

simply go the Presentation > Widgets section and drag over the Collapsing Links Widget.

== Frequently Asked Questions ==

None yet.
   
== Screenshots ==

1. a few expanded links with default theme, showing multiple instances of the
widget
2. available options 

== Demo ==

You can see this on my test blog at http://robfelty.com/test


== OPTIONS AND CONFIGURATIONS ==

  * Show link counts in link category links
  * Sort by link category name, link category id, link category count etc.
  * Sort in ascending or descending order
  * Exclude certain link categories
  * Automatically expand certain link categories
  * Several different icons to choose from for expanding and collapsing
  * Add nofollow tag

== CAVEAT ==

Currently this plugin relies on Javascript to expand and collapse the links.
If a user's browser doesn't support javascript they won't see the links to the
posts, but the links to the links will still work (which is the default
behavior in wordpress anyways)

The option to show the number of links currently uses the number stored in the
database, which includes both visible and invisible links. If you have
invisible links, this number will be wrong.

== HISTORY ==

* 0.2.6 (2009.04.16)
    * Added option to use custom symbols

* 0.2.5 (2009.02.01)
    * Fixed settings panel

* 0.2.4: (2009.01.07)
    * Added nofollow option
    * Added version to javascript
    * not loading unnecessary code for admin pages (fixes interference with
      akismet stats page
    * fixed debugging option

* 0.2.3: (2009.01.06)
    * Finally fixed disappearing widget problem when trying to add to sidebar
    * Added debugging option to show the query used and the output
    * Moved style option to options page
    * tweaked default style

* 0.2.2: (2009.01.03)
  * Added title attributes so that "click to expand" shows on hover.
  * Now the collapse symbol and collapse text are clickable

* 0.2.1: (2009.01.02)
  * Fixed bug with not enqueing javascript file
	* Added feature such that link descriptions are added to the title attribute
	  (will show up on hover) 

* 0.2: (2008.12.08)
  * Can now use as a widget or manually
  * consolidated javascript to work with other collapsing plugins
  * Uses cookies to keep track of which link categories have been expanded /
    collapsed

* 0.1.4: (2008.10.29)
  * Fixed bug so that multi-word categories are correctly included / excluded


* 0.1.3: (2008.10.29)
  * Now opens links in specified target (blank,top,none)

* 0.1.2: (2008.10.06)
  * Fixed bug with leaving include/exclude categories blank
  * Added option to animate expanding and collapsing
  * Added option for images instead of text as collapsing symbols

* 0.1.1:
  * Changing default title to 'Blogroll'

* 0.1:
	Initial Release
