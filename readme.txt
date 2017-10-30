=== Remove Query Strings From Static Resources ===

Contributors: littlebizzy
Tags: remove, query, strings, string, from, static, resources, css, js, seo, speed
Requires at least: 4.4
Tested up to: 4.8
Requires PHP: 7.0
Stable tag: 1.2.5
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: RMQRST

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

== Description ==

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

* [Plugin Homepage](https://www.littlebizzy.com/plugins/remove-query-strings)
* [Plugin GitHub](https://github.com/littlebizzy/remove-query-strings/)

Remove Query Strings is a simple plugin that automatically removes query strings from static resources on your WordPress website. By activating the plugin and refreshing your website on the frontend and then checking its source code (clear any caches), you will be able to see that query string have been removed from source URLs.

By default, this plugin only removes these query strings:

    ?=
    ?v=
    ?ver=
    ?version=

Prior to version 1.2, only `?=ver` was removed, but after further testing showed extensive use of other versioning strings we added three others to the list. The logic behind this is that common versioning strings are perhaps 90% or more of the common strings that can be safely removed to improve caching; moreover, the "keyless" strings `?=` are also removed by default because they are impossible to define as a constant anyways. In other words, the plugin assumes that keyless and common versioning strings are the exact reason why you would install a plugin such as this.

Example: (i.e. `?ver=1.12.4` is removed from the end of the URL source for jQuery, etc).

To remove more types of query strings (unlimited), simply use the following constant in your `wp-config.php` file to define which strings to remove:

    define('REMOVE_QUERY_STRING_ARGS', 'v,ver,version,my-arg,other-arg');

Please note that if using this defined constant, the default "ver" string removal will be disabled, meaning that you should re-define the "ver" string in the comma-separated list shown above to ensure that it's properly removed. Even when using the defined constant, the keyless strings will still be removed, since they are impossible to define.

While the necessity of this function has been debated, most SEO and loading speed tools such as GTMetrix, Pingdom, etc still recommend removing all query strings from static resources. The reason being that some proxy servers (etc) that are part of the internet's underlying infrastructure (or your unique browsing connection) will be able to cache your website's content better when query strings do not exist. In other words, having query strings on static resources makes those resources look like many different resources rather than a single resource. It is also a valuable performance enhancing method if your web server (esp. Nginx) is using a caching method such as FastCGI or proxy_pass (reverse proxy caches).

While programmers often argue that query strings help to "break caches" and ensure the proper version of a static file is loading correctly, sometimes this is not necessarily true depending on your setup. For example, if your site is behind CloudFlare or another similar proxy setup that caches static file content for 24 hours (example) regardless of query strings, then "breaking" the cache doesn't work; in other cases, query strings can directly impact loading speed.

By using this plugin, your site may see a performance boost in certain situations or for certain apps/users. Keep in mind that you may wish to consult your IT or server team to see if it will help or hurt your unique setup.

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

#### Compatibility ####

This plugin has been designed for use on LEMP (Nginx) web servers with PHP 7.0 and MySQL 5.7 to achieve best performance. All of our plugins are meant for single site WordPress installations only; for both performance and security reasons, we highly recommend against using WordPress Multisite for the vast majority of projects.

#### Admin Notices ####

This plugin generates 2 [https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices](Admin Notices) in the WP Admin dashboard. The first is a notice that fires during plugin activation which recommends several related free plugins that we believe will enhance this plugin's features; this notice will re-appear approximately once every 5 months, as our code and recommendations evolve. The second is a notice that fires a few days after plugin activation which asks for a 5-star rating of this plugin on its WordPress.org profile page. This notice will re-appear approximately once every 8 months. These notices can be dismissed by clicking the (x) symbol in the upper right of the notice box. These notices may confuse certain users, but are appreciated by the majority of our users, who understand these notices help to support our free contributions to the WordPress community. If you feel that these notices are too "annoying" than we encourage you to consider one or more of our upcoming premium plugins that combine several free plugin features into a single control panel. Another alternative would be to develop your own plugins for WordPress, if you feel that supporting free plugin authors is not something that interests you.

#### Plugin Features ####

* Settings Page: No
* Upgrade Available: No
* Includes Media: No
* Includes CSS: No
* Database Storage: No
  * Transients: No
  * Options: Yes
* Database Queries: Backend only
* Must-Use Support: Yes
* Multi-site Support: No
* Uninstalls Data: Yes

#### Code Inspiration ####

This plugin was partially inspired either in "code or concept" by the open-source software and discussions mentioned below:

* [Remove Query Strings From Static Resources](https://wordpress.org/plugins/remove-query-strings-from-static-resources/)
* [Query Strings Remover](https://wordpress.org/plugins/query-strings-remover/)
* [Remove Query Strings From Static Resources Like CSS & JS Files](https://wordpress.org/plugins/remove-query-strings/)

#### Recommended Plugins ####

We invite you to check out a few other related free plugins that our team has also produced that you may find especially useful:

* [Disable Emojis](https://wordpress.org/plugins/disable-emojis-littlebizzy/)
* [Disable XML-RPC](https://wordpress.org/plugins/disable-xml-rpc-littlebizzy/)
* [Remove Category Base](https://wordpress.org/plugins/remove-category-base-littlebizzy/)
* [Disable Author Pages](https://wordpress.org/plugins/disable-author-pages-littlebizzy/)
* [404 To Homepage](https://wordpress.org/plugins/404-to-homepage-littlebizzy/)
* [Force HTTPS](https://wordpress.org/plugins/force-https-littlebizzy/)
* [Server Status](https://wordpress.org/plugins/server-status-littlebizzy/)

#### Special Thanks ####

We thank the following groups for their generous contributions to the WordPress community which have particularly benefited us in developing our own free plugins and paid services:

* [Automattic](https://automattic.com)
* [Delicious Brains](https://deliciousbrains.com)
* [Roots](https://roots.io)
* [rtCamp](https://rtcamp.com)
* [WP Tavern](https://wptavern.com)

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep the above mentioned goals in mind, thanks!

== Installation ==

1. Upload to `/wp-content/plugins/remove-query-strings-littlebizzy`
2. Activate via WP Admin > Plugins
3. Use the defined constant for optional customization

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is a settings page where you can exclude certain types of query strings.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Changelog ==

= 1.2.5 =
* optimized plugin code
* updated recommended plugins
* added rating request

= 1.2.4 =
* minor code tweaks
* updated plugin meta

= 1.2.3 =
* updated recommended plugins

= 1.2.2 =
* recommended plugins

= 1.2.1 =
* updated plugin meta
* tested with WordPress 4.8

= 1.2.0 =
* added three more default string types

= 1.1.1 =
* updated plugin meta

= 1.1.0 =
* removed settings page
* added defined constant option

= 1.0.0 =
* initial release
