=== Remove Query Strings From Static Resources ===

Contributors: littlebizzy
Donate link: https://www.patreon.com/littlebizzy
Tags: remove, query, strings, static, resources
Requires at least: 4.4
Tested up to: 4.9
Requires PHP: 7.0
Multisite support: No
Stable tag: 1.3.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Prefix: RMQRST

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

== Description ==

Removes all query strings from static resources meaning that proxy servers and beyond can better cache your site content (plus, better SEO scores).

* [**JOIN OUR FREE FACEBOOK GROUP FOR SUPPORT!**](https://www.facebook.com/groups/littlebizzy/)
* [Plugin Homepage](https://www.littlebizzy.com/plugins/remove-query-strings)
* [Plugin GitHub](https://github.com/littlebizzy/remove-query-strings)
* [SlickStack](https://slickstack.io)
* [Starter](https://starter.littlebizzy.com)

#### The Long Version ####

Remove Query Strings is a simple plugin that automatically removes query strings from static resources on your WordPress website. By activating the plugin and refreshing your website on the frontend and then checking its source code (clear any caches), you will be able to see that query string have been removed from source URLs.

By default, only the following query string types are removed:

    ?=, ?v=, ?ver=, ?version=

Prior to version 1.2, only `?=ver` was removed, but after further testing showed extensive use of other versioning strings we added three others to the list. The logic behind this is that common versioning strings are perhaps 90% or more of the common strings that can be safely removed to improve caching; moreover, the "keyless" strings `?=` are also removed by default because they are impossible to define as a constant anyways. In other words, the plugin assumes that keyless and common versioning strings are the exact reason why you would install a plugin such as this.

Example: (i.e. `?ver=1.12.4` is removed from the end of the URL source for jQuery, etc).

To remove more types of query strings (unlimited), simply use the following constant in your `wp-config.php` file to define which strings to remove:

    define('REMOVE_QUERY_STRINGS_ARGS', 'v,ver,version');

Please note that even when using the defined constant, the keyless strings will still be removed, since they are impossible to define anyways.

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

#### Plugin Features ####

* Settings Page: No
* Premium Version Available: Yes ([Speed Demon](https://www.littlebizzy.com/plugins/speed-demon))
* Includes Media (Images, Icons, Etc): No
* Includes CSS: No
* Database Storage: Yes
  * Transients: No
  * Options: Yes
  * Creates New Tables: No
* Database Queries: Backend Only (Options API Cache)
* Must-Use Support: Yes (Use With [Autoloader](https://github.com/littlebizzy/autoloader))
* Multisite Support: No
* Uninstalls Data: Yes

#### WP Admin Notices ####

This plugin generates multiple [Admin Notices](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices) in the WP Admin dashboard. The first is a notice that fires during plugin activation which recommends several related free plugins that we believe will enhance this plugin's features; this notice will re-appear approximately once every 6 months as our code and recommendations evolve. The second is a notice that fires a few days after plugin activation which asks for a 5-star rating of this plugin on its WordPress.org profile page. This notice will re-appear approximately once every 9 months. These notices can be dismissed by clicking the **(x)** symbol in the upper right of the notice box. These notices may annoy or confuse certain users, but are appreciated by the majority of our userbase, who understand that these notices support our free contributions to the WordPress community while providing valuable (free) recommendations for optimizing their website.

If you feel that these notices are too annoying, than we encourage you to consider one or more of our upcoming premium plugins that combine several free plugin features into a single control panel, or even consider developing your own plugins for WordPress, if supporting free plugin authors is too frustrating for you. A final alternative would be to place the defined constant mentioned below inside of your `wp-config.php` file to manually hide this plugin's nag notices:

    define('DISABLE_NAG_NOTICES', true);

Note: This defined constant will only affect the notices mentioned above, and will not affect any other notices generated by this plugin or other plugins, such as one-time notices that communicate with admin-level users.

#### Code Inspiration ####

This plugin was partially inspired either in "code or concept" by the open-source software and discussions mentioned below:

* [Remove Query Strings From Static Resources](https://wordpress.org/plugins/remove-query-strings-from-static-resources/)
* [Query Strings Remover](https://wordpress.org/plugins/query-strings-remover/)
* [Remove Query Strings From Static Resources Like CSS & JS Files](https://wordpress.org/plugins/remove-query-strings/)

#### Recommended Plugins ####

We invite you to check out a few other related free plugins that our team has also produced that you may find especially useful:

* [404 To Homepage](https://wordpress.org/plugins/404-to-homepage-littlebizzy/)
* [CloudFlare](https://wordpress.org/plugins/cf-littlebizzy/)
* [Delete Expired Transients](https://wordpress.org/plugins/delete-expired-transients-littlebizzy/)
* [Disable Author Pages](https://wordpress.org/plugins/disable-author-pages-littlebizzy/)
* [Disable Cart Fragments](https://wordpress.org/plugins/disable-cart-fragments-littlebizzy/)
* [Disable Embeds](https://wordpress.org/plugins/disable-embeds-littlebizzy/)
* [Disable Emojis](https://wordpress.org/plugins/disable-emojis-littlebizzy/)
* [Disable Empty Trash](https://wordpress.org/plugins/disable-empty-trash-littlebizzy/)
* [Disable Image Compression](https://wordpress.org/plugins/disable-image-compression-littlebizzy/)
* [Disable jQuery Migrate](https://wordpress.org/plugins/disable-jq-migrate-littlebizzy/)
* [Disable Search](https://wordpress.org/plugins/disable-search-littlebizzy/)
* [Disable WooCommerce Status](https://wordpress.org/plugins/disable-wc-status-littlebizzy/)
* [Disable WooCommerce Styles](https://wordpress.org/plugins/disable-wc-styles-littlebizzy/)
* [Disable XML-RPC](https://wordpress.org/plugins/disable-xml-rpc-littlebizzy/)
* [Download Media](https://wordpress.org/plugins/download-media-littlebizzy/)
* [Download Plugin](https://wordpress.org/plugins/download-plugin-littlebizzy/)
* [Download Theme](https://wordpress.org/plugins/download-theme-littlebizzy/)
* [Duplicate Post](https://wordpress.org/plugins/duplicate-post-littlebizzy/)
* [Export Database](https://wordpress.org/plugins/export-database-littlebizzy/)
* [Force HTTPS](https://wordpress.org/plugins/force-https-littlebizzy/)
* [Force Strong Hashing](https://wordpress.org/plugins/force-strong-hashing-littlebizzy/)
* [Google Analytics](https://wordpress.org/plugins/ga-littlebizzy/)
* [Index Autoload](https://wordpress.org/plugins/index-autoload-littlebizzy/)
* [Maintenance Mode](https://wordpress.org/plugins/maintenance-mode-littlebizzy/)
* [Profile Change Alerts](https://wordpress.org/plugins/profile-change-alerts-littlebizzy/)
* [Remove Category Base](https://wordpress.org/plugins/remove-category-base-littlebizzy/)
* [Remove Query Strings](https://wordpress.org/plugins/remove-query-strings-littlebizzy/)
* [Server Status](https://wordpress.org/plugins/server-status-littlebizzy/)
* [StatCounter](https://wordpress.org/plugins/sc-littlebizzy/)
* [View Defined Constants](https://wordpress.org/plugins/view-defined-constants-littlebizzy/)
* [Virtual Robots.txt](https://wordpress.org/plugins/virtual-robotstxt-littlebizzy/)

#### Premium Plugins ####

We invite you to check out a few premium plugins that our team has also produced that you may find especially useful:

* [Speed Demon](https://www.littlebizzy.com/plugins/speed-demon)
* [SEO Genius](https://www.littlebizzy.com/plugins/seo-genius)
* [Great Migration](https://www.littlebizzy.com/plugins/great-migration)
* [Security Guard](https://www.littlebizzy.com/plugins/security-guard)
* [Genghis Khan](https://www.littlebizzy.com/plugins/genghis-khan)

#### Special Thanks ####

We thank the following groups for their generous contributions to the WordPress community which have particularly benefited us in developing our own free plugins and paid services:

* [Automattic](https://automattic.com)
* [Brad Touesnard](https://bradt.ca)
* [Daniel Auener](http://www.danielauener.com)
* [Delicious Brains](https://deliciousbrains.com)
* [Greg Rickaby](https://gregrickaby.com)
* [Matt Mullenweg](https://ma.tt)
* [Mika Epstein](https://halfelf.org)
* [Samuel Wood](http://ottopress.com)
* [Scott Reilly](http://coffee2code.com)
* [Jan Dembowski](https://profiles.wordpress.org/jdembowski)
* [Jeff Starr](https://perishablepress.com)
* [Jeff Chandler](https://jeffc.me)
* [Jeff Matson](https://jeffmatson.net)
* [John James Jacoby](https://jjj.blog)
* [Leland Fiegel](https://leland.me)
* [Rahul Bansal](https://profiles.wordpress.org/rahul286)
* [Roots](https://roots.io)
* [rtCamp](https://rtcamp.com)
* [Ryan Hellyer](https://geek.hellyer.kiwi)
* [WP Chat](https://wpchat.com)
* [WP Tavern](https://wptavern.com)

#### Disclaimer ####

We released this plugin in response to our managed hosting clients asking for better access to their server, and our primary goal will remain supporting that purpose. Although we are 100% open to fielding requests from the WordPress community, we kindly ask that you keep the above mentioned goals in mind, thanks!

== Installation ==

1. Upload to `/wp-content/plugins/remove-query-strings-littlebizzy`
2. Activate via WP Admin > Plugins
3. Use the defined constant for optional customization: `define('REMOVE_QUERY_STRINGS_ARGS', 'v,ver,version');`
4. Purge all caches
5. Test plugin is working by checking source code

== Frequently Asked Questions ==

= How can I change this plugin's settings? =

There is no settings page for best performance. Instead, use the defined constant.

= I have a suggestion, how can I let you know? =

Please avoid leaving negative reviews in order to get a feature implemented. Instead, we kindly ask that you post your feedback on the wordpress.org support forums by tagging this plugin in your post. If needed, you may also contact our homepage.

== Changelog ==

= 1.3.0 =
* BREAKING CHANGE: the defined constant is now `REMOVE_QUERY_STRINGS_ARGS`
* (old spelling no longer supported: `REMOVE_QUERY_STRING_ARGS`)
* added warning for Multisite installations
* updated recommended plugins

= 1.2.8 =
* better support for `define('DISABLE_NAG_NOTICES', true);`

= 1.2.7 =
* updated plugin meta
* partial support for `define('DISABLE_NAG_NOTICES', true);`

= 1.2.6 =
* tested with WP 4.9
* updated plugin meta
* updated recommended plugins

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
* tested with WP 4.8
* updated plugin meta

= 1.2.0 =
* added three more default string types

= 1.1.1 =
* updated plugin meta

= 1.1.0 =
* removed settings page
* added defined constant option

= 1.0.0 =
* initial release
