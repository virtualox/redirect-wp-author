=== Redirect WP Author ===
Contributors: virtualox
Tags: author, redirect, security
Requires at least: 4.9
Tested up to: 6.7
Stable tag: 1.1.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Redirects WordPress author pages to the homepage with configurable redirect type.
== Description ==
Redirect WP Author is a simple plugin that redirects all author pages to the homepage. This can be useful for security purposes or if you don't want to expose author information on your site.
Features:

Redirects all author pages to the homepage
Configurable redirect type (301 permanent or 302 temporary)
Removes author links from the admin area
Overrides author links in the frontend

== Installation ==

Upload the redirect-wp-author folder to the /wp-content/plugins/ directory
Activate the plugin through the 'Plugins' menu in WordPress
Configure the plugin settings under 'Settings > Redirect WP Author'

== Frequently Asked Questions ==
= Why should I redirect author pages? =
Redirecting author pages can improve security by making it harder for attackers to enumerate users on your WordPress site.
= What's the difference between 301 and 302 redirects? =
A 301 redirect is permanent and tells search engines that the page has moved permanently. A 302 redirect is temporary and indicates the page is temporarily moved. For SEO purposes, 301 is usually preferred.
== Changelog ==
= 1.1.0 =

Added settings page to configure redirect type (301 or 302)
Improved code organization
Added translation support

= 1.0.0 =

Initial release