=== Post Archive ===

Description:	Posts Archive (multi-site compatible) based on Ozh Tweet Archive Theme; archive can be displayed in a widget, post or page.
Version:		1.3.2
Tags:			post, posts, archive, page, widget
Author:			azurecurve
Author URI:		https://development.azurecurve.co.uk/
Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/post-archive/
Download link:	https://github.com/azurecurve/azrcrv-post-archive/releases/download/v1.3.2/azrcrv-post-archive.zip
Donate link:	https://development.azurecurve.co.uk/support-development/
Requires PHP:	5.6
Requires:		1.0.0
Tested:			4.9.99
Text Domain:	post-archive
Domain Path:	/languages
License: 		GPLv2 or later
License URI: 	http://www.gnu.org/licenses/gpl-2.0.html

Posts Archive (multi-site compatible) based on Ozh Tweet Archive Theme; archive can be displayed in a widget, post or page.

== Description ==

# Description

The Post Archive plugin is based on [Ozh Tweet Archive - a theme for Wordpress](http://planetozh.com/blog/my-projects/ozh-tweet-archive-theme-for-wordpress/). The tweet archive was extracted, enhanced and turned into this plugin which lets the posts archive to be displayed in a page or in a widget.

Widgets can be limited in the number of years they display as well as have footer text, such as a link to a page containing the full archive in a shortcode.

This plugin is multisite compatible; each site will need settings to be configured in the admin dashboard.

== Installation ==

# Installation Instructions

 * Download the latest release of the plugin from [GitHub](https://github.com/azurecurve/azrcrv-post-archive/releases/latest/).
 * Upload the entire zip file using the Plugins upload function in your ClassicPress admin panel.
 * Activate the plugin.
 * Configure relevant settings via the configuration page in the admin control panel (azurecurve menu).

== Frequently Asked Questions ==

# Frequently Asked Questions

### Can I translate this plugin?
Yes, the .pot file is in the plugins languages folder; if you do translate this plugin, please sent the .po and .mo files to translations@azurecurve.co.uk for inclusion in the next version (full credit will be given).

### Is this plugin compatible with both WordPress and ClassicPress?
This plugin is developed for ClassicPress, but will likely work on WordPress.

== Changelog ==

# Changelog

### [Version 1.3.2](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.3.2)
 * Update azurecurve menu.
 * Update readme files.

### [Version 1.3.1](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.3.1)
 * Update azurecurve menu and logo.
 
### [Version 1.3.0](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.3.0)
 * Add limit to number of years in widget.
 * Add field to store text at bottom of widget (such as link to archive page).
 
### [Version 1.2.0](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.2.0)
 * Fix plugin action link to use admin_url() function.
 * Add plugin icon and banner.
 * Update azurecurve plugin menu.
 * Amend to only load css when shortcode on page.

### [Version 1.1.4](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.1.4)
 * Fix bug with plugin menu.
 * Update plugin menu css.

### [Version 1.1.3](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.1.3)
 * Upgrade azurecurve plugin to store available plugins in options.
 
### [Version 1.1.2](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.1.2)
 * Update Update Manager class to v2.0.0.
 * Update action link.
 * Update azurecurve menu icon with compressed image.
 
### [Version 1.1.1](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.1.1)
 * Fix bug with incorrect language load text domain.

### [Version 1.1.0](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.1.0)
 * Add integration with Update Manager for automatic updates.
 * Fix issue with display of azurecurve menu.
 * Change settings page heading.
 * Add load_plugin_textdomain to handle translations.

### [Version 1.0.2](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.0.2)
 * Update azurecurve menu for easier maintenance.
 * Move require of azurecurve menu below security check.
 
### [Version 1.0.1](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.0.1)
 * Fix bug in shortcode output.

### [Version 1.0.0](https://github.com/azurecurve/azrcrv-post-archive/releases/tag/v1.0.0)
 * Initial release for ClassicPress forked from azurecurve Post Archive WordPress Plugin.

== Other Notes ==

# About azurecurve

**azurecurve** was one of the first plugin developers to start developing for Classicpress; all plugins are available from [azurecurve Development](https://development.azurecurve.co.uk/) and are integrated with the [Update Manager plugin](https://directory.classicpress.net/plugins/update-manager) for fully integrated, no hassle, updates.

Some of the other plugins available from **azurecurve** are:
 * Avatars - [details](https://development.azurecurve.co.uk/classicpress-plugins/avatars/) / [download](https://github.com/azurecurve/azrcrv-avatars/releases/latest/)
 * Contact Forms - [details](https://development.azurecurve.co.uk/classicpress-plugins/contact-forms/) / [download](https://github.com/azurecurve/azrcrv-contact-forms/releases/latest/)
 * Estimated Read Time - [details](https://development.azurecurve.co.uk/classicpress-plugins/estimated-read-time/) / [download](https://github.com/azurecurve/azrcrv-estimated-read-time/releases/latest/)
 * Events - [details](https://development.azurecurve.co.uk/classicpress-plugins/events/) / [download](https://github.com/azurecurve/azrcrv-events/releases/latest/)
 * Filtered Categories - [details](https://development.azurecurve.co.uk/classicpress-plugins/filtered-categories/) / [download](https://github.com/azurecurve/azrcrv-filtered-categories/releases/latest/)
 * Images - [details](https://development.azurecurve.co.uk/classicpress-plugins/images/) / [download](https://github.com/azurecurve/azrcrv-images/releases/latest/)
 * Sidebar Login - [details](https://development.azurecurve.co.uk/classicpress-plugins/sidebar-login/) / [download](https://github.com/azurecurve/azrcrv-sidebar-login/releases/latest/)
 * SMTP - [details](https://development.azurecurve.co.uk/classicpress-plugins/smtp/) / [download](https://github.com/azurecurve/azrcrv-smtp/releases/latest/)
 * To Twitter - [details](https://development.azurecurve.co.uk/classicpress-plugins/to-twitter/) / [download](https://github.com/azurecurve/azrcrv-to-twitter/releases/latest/)
 * Widget Announcements - [details](https://development.azurecurve.co.uk/classicpress-plugins/widget-announcements/) / [download](https://github.com/azurecurve/azrcrv-widget-announcements/releases/latest/)
