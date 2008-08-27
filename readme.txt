=== Collapsing Links ===
Contributors: robfelty
Donate link: http://blog.robfelty.com/plugins/collapsing-links
Plugin URI: http://blog.robfelty.com/plugins/collapsing-links
Tags: links, sidebar, widget
Requires at least: 2.3
Tested up to: 2.6.1
Stable tag: 0.1.1

This widget uses Javascript to dynamically expand or collapsable the set of
links for each link category.

== Description ==

This is a very simple plugin that uses Javascript to form a collapsable set of
links in the sidebar for the links (blogroll). Every link corresponding to a
given link category will be expanded.

You can use multiple instances of the widget, each with its own set of options. In this way you could have one set of links for certain categories one place on your page, and another widget with a different set of links somewhere else.

It is based off of the Collapsing Categories and Collapsing Pages plugins.

== Installation ==

Unpackage contents to wp-content/plugins/ so that the files are in a
collapsing-links directory. Activate the plugin in your Wordpress Admin
interface -- Collapsing Links. Then simply go the Presentation > Widgets
section and drag over the Collapsing Links Widget.

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

== CAVEAT ==

Currently this plugin relies on Javascript to expand and collapse the links.
If a user's browser doesn't support javascript they won't see the links to the
posts, but the links to the links will still work (which is the default
behavior in wordpress anyways)

The option to show the number of links currently uses the number stored in the
database, which includes both visible and invisible links. If you have
invisible links, this number will be wrong.

== HISTORY ==

0.1.1:
  * Changing default title to 'Blogroll'

* 0.1:
	Initial Release
