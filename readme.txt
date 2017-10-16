=== Remove Query Strings ===
Contributors: littlebizzy
Donate link:
Tags: remove, query, strings, from, static, resources, css, js, seo, scores
Requires at least: 4.4
Tested up to: 4.7.1
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

== Description ==

Remove Query Strings is a simple plugin that automatically removes query strings from static resources in your WordPress website. By activating the plugin and refreshing your website on the frontend and then checking its source code (clear any caches), you will be able to see that query string URLs have been removed.

While the necessity of this function has been debated, most SEO and loading speed tools such as GTMetrix, Pingdom, etc still recommend remove all query strings from static resources. The reason being that some proxy servers (etc) that are part of the internet's underlying infrastructure (or your unique browsing connection) will be able to cache your website content better when query strings do not exist. In other words, having query strings on static resources makes those resources look like many different resources rather than a single resource.

While programmers often argue that query strings help to "break caches" and ensure the proper version of a static file is loading correctly, sometimes this is not necessary depending on your setup. For example, if your site is behind CloudFlare or another reverse proxy that is already caching file content each 24 hours (example), then "breaking" the cache doesn't work regardless and is only serving to hurt caching ability in such cases.

By using this plugin, your site may see a performance boost in certain situations or for certain apps/users. Keep in mind that you may wish to consult your IT or server team to see if it will help or hurt your unique setup.

Also, in version 1.0 we've included a settings page so you can exclude certain types of query strings.

Compatibility:

* Meant for Linux servers
* Minimum PHP version: 5.4.3
* Designed for: PHP 7+ and MySQL 5.7+
* Can be used as a "Must Use" plugin (mu-plugins)

Future plugin goals:

* Localization (translation support)
* Transient experimentation (settings stored in wp_options)
* More features (based on user suggestions)
* Code maintenance/improvements

Code inspired by:

* [Remove Query Strings From Static Resources](https://wordpress.org/plugins/remove-query-strings-from-static-resources/)
* [Query Strings Remover](https://wordpress.org/plugins/query-strings-remover/)
* [Remove Query Strings From Static Resources Like CSS & JS Files](https://wordpress.org/plugins/remove-query-strings/)

NOTE: We released this plugin in response to our managed hosting clients asking for better access to their server environment, and our primary goal will likely remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you consider all of the above mentioned goals before leaving reviews of this plugin, thanks!

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/remove-query-strings-littlebizzy`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the settings page to exclude certain types of query strings if needed

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is a settings page where you can exclude certain types of query strings.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Screenshots ==

== Changelog ==

= 1.0 =
* Initial release inspired by other plugins, including settings page to exclude certain query strings.

== Other Notes ==