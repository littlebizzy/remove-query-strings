=== Remove Query Strings From Static Resources ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: remove, query, strings, static, resources
Requires at least: 4.4
Tested up to: 5.0
Requires PHP: 7.0
Multisite support: No
Stable tag: 1.4.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: RMQRST

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

== Description ==

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

* [**Join our FREE Facebook group for support**](https://www.facebook.com/groups/littlebizzy/)
* [**Worth a 5-star review? Thank you!**](https://wordpress.org/support/plugin/remove-query-strings-littlebizzy/reviews/?rate=5#new-post)
* [Plugin Homepage](https://www.littlebizzy.com/plugins/remove-query-strings)
* [Plugin GitHub](https://github.com/littlebizzy/remove-query-strings)

#### Current Features ####

Remove Query Strings is a simple plugin that automatically removes query strings from static resources on your WordPress website. By activating the plugin and refreshing your website on the frontend and then checking its source code (clear any caches), you will be able to see that query string have been removed from source URLs.

By default, the following are removed: `?=, ?v=, ?ver=, ?version=`

Prior to version 1.2, only `?=ver` was removed, but after further testing showed extensive use of other versioning strings we added three others to the list. The logic behind this is that common versioning strings are perhaps 90% or more of the common strings that can be safely removed to improve caching; moreover, the "keyless" strings `?=` are also removed by default because they are impossible to define as a constant anyways. In other words, the plugin assumes that keyless and common versioning strings are the exact reason why you would install a plugin such as this.

Example: (i.e. `?ver=1.12.4` is removed from the end of the URL source for jQuery, etc).

To remove more types of query strings (unlimited), simply use the following constant in your `wp-config.php` file to define which strings to remove (below)

Please note that even when using the defined constant, the keyless strings will still be removed, since they are impossible to define anyways.

While the necessity of this function has been debated, most SEO and loading speed tools such as GTMetrix, Pingdom, etc still recommend removing all query strings from static resources. The reason being that some proxy servers (etc) that are part of the internet's underlying infrastructure (or your unique browsing connection) will be able to cache your website's content better when query strings do not exist. In other words, having query strings on static resources makes those resources look like many different resources rather than a single resource. It is also a valuable performance enhancing method if your web server (esp. Nginx) is using a caching method such as FastCGI or proxy_pass (reverse proxy caches).

While programmers often argue that query strings help to "break caches" and ensure the proper version of a static file is loading correctly, sometimes this is not necessarily true depending on your setup. For example, if your site is behind CloudFlare or another similar proxy setup that caches static file content for 24 hours (example) regardless of query strings, then "breaking" the cache doesn't work; in other cases, query strings can directly impact loading speed.

By using this plugin, your site may see a performance boost in certain situations or for certain apps/users. Keep in mind that you may wish to consult your IT or server team to see if it will help or hurt your unique setup.

#### Compatibility ####

This plugin has been designed for use on [SlickStack](https://slickstack.io) web servers with PHP 7.2 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and usability reasons, we highly recommend avoiding WordPress Multisite for the vast majority of projects.

Any of our WordPress plugins may also be loaded as "Must-Use" plugins by using our free [Autoloader](https://github.com/littlebizzy/autoloader) script in the `mu-plugins` directory.

#### Defined Constants ####

    /* Plugin Meta */
    define('DISABLE_NAG_NOTICES', true);
    
    /* Remove Query Strings Functions */
    define('REMOVE_QUERY_STRINGS_ARGS', 'v,ver,version');

#### Technical Details ####

* Prefix: RMQRST
* Parent Plugin: [**Speed Demon**](https://wordpress.org/plugins/speed-demon-littlebizzy/)
* Disable Nag Notices: [Yes](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices#Disable_Nag_Notices)
* Settings Page: No
* PHP Namespaces: No
* Object-Oriented Code: No
* Includes Media (images, icons, etc): No
* Includes CSS: No
* Database Storage: Yes
  * Transients: No
  * WP Options Table: Yes
  * Other Tables: No
  * Creates New Tables: No
  * Creates New WP Cron Jobs: No
* Database Queries: Backend Only (Options API)
* Must-Use Support: [Yes](https://github.com/littlebizzy/autoloader)
* Multisite Support: No
* Uninstalls Data: Yes

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep these conditions in mind, and refrain from slandering, threatening, or harassing our team members in order to get a feature added, or to otherwise get "free" support. The only place you should be contacting us is in our free [**Facebook group**](https://www.facebook.com/groups/littlebizzy/) which has been setup for this purpose, or via GitHub if you are an experienced developer. Thank you!

== Installation ==

1. Upload to `/wp-content/plugins/remove-query-strings-littlebizzy`
2. Activate via WP Admin > Plugins
3. Use the defined constant for optional customization: `define('REMOVE_QUERY_STRINGS_ARGS', 'v,ver,version');`
4. Purge all caches
5. Test plugin is working by checking source code

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is no settings page for best performance. Instead, use the defined constant.

= Are custom filters available? =

About filters, you can add the code in functions.php or in other plugin. There are two ways to handle the filter, with or withour $src extra parameter, for example:

    // Only $unwanted_args array parameter (for example if you do not want to modify the wp-config.php)
    add_filter('rmqrst_unwanted_args', 'remove_query_strings_test');
    function remove_query_strings_test($unwanted_args) {
	return array('my-custom-arg', 'another-arg);
    }

    // Parameters $unwanted_args array and URL $src that will be modified (if you want to change the args to remove only for specific URLs)
    add_filter('rmqrst_unwanted_args', 'remove_query_strings_test_2', 10, 2);
    function remove_query_strings_test_2($unwanted_args, $src) {
	// Add 'test' arg to remove, only for this URL
	if ($src == 'http://myhost/wp-includes/js/jquery/jquery.js?ver=1.12.4&test=on') {
		$unwanted_args[] = 'test';
	}
	return $unwanted_args;
    }

This filter provides full control about what the plugin is doing, so an advanced user can customize the remove arg feature even for specific URLs.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Changelog ==

= 1.4.0 =
* tested with WP 5.0
* updated plugin meta

= 1.3.2 =
* updated recommended plugins

= 1.3.1 =
* updated plugin meta

= 1.3.0 =
* BREAKING CHANGE: the defined constant is now `REMOVE_QUERY_STRINGS_ARGS`
* (old spelling no longer supported: `REMOVE_QUERY_STRING_ARGS`)
* added warning for Multisite installations
* updated recommended plugins

= 1.2.8 =
* better support for `DISABLE_NAG_NOTICES`

= 1.2.7 =
* partial support for `DISABLE_NAG_NOTICES`
* updated plugin meta

= 1.2.6 =
* tested with WP 4.9
* updated recommended plugins
* updated plugin meta

= 1.2.5 =
* added rating request notice
* optimized plugin code
* updated recommended plugins

= 1.2.4 =
* optimized plugin code
* updated plugin meta

= 1.2.3 =
* updated recommended plugins

= 1.2.2 =
* added recommended plugins notice

= 1.2.1 =
* tested with WP 4.8
* updated plugin meta

= 1.2.0 =
* now removes query strings `?=, ?v=, ?ver=, ?version=` by default

= 1.1.1 =
* updated plugin meta

= 1.1.0 =
* added support for `REMOVE_QUERY_STRING_ARGS`
* removed settings page
* (no longer any database queries)

= 1.0.0 =
* initial release
* tested with PHP 7.0
* removes query strings `?ver=` by default
