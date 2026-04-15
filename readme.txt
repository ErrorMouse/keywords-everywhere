=== Keywords Everywhere ===
Contributors:       Err
Donate link:        https://err-mouse.id.vn/donate
Tags:               keywords, seo, tags, taxonomy, rank math
Requires at least:  5.2
Tested up to:       6.9
Stable tag:         2.0
License:            GPLv2 or later
License URI:        https://www.gnu.org/licenses/gpl-2.0.html

Automatically uses post/product tags, categories, and Rank Math focus keywords to generate meta keywords for your WordPress content.

== Description ==

"Keywords Everywhere" is a lightweight SEO plugin designed to automatically populate the meta keywords tag for your WordPress posts, WooCommerce products, and taxonomy archive pages.

The plugin intelligently prioritizes keywords:

1.  **Rank Math Focus Keywords:** If you are using Rank Math SEO and have set focus keywords for a post, product, or term, this plugin will use those first.
2.  **Post Tags:** For regular blog posts, if no Rank Math focus keywords are found, the plugin will use the assigned post tags as keywords.
3.  **Product Tags & Categories:** For WooCommerce products, if no Rank Math focus keywords are set, the plugin will use both product tags and product categories as keywords.
4.  **Taxonomy Term Name:** For taxonomy archive pages (like category pages or product tag pages), if no Rank Math focus keywords are set for the term, the term's name itself will be used as a keyword.
5.  **Other Pages:** For any other types of pages where these specific conditions don't apply, the plugin will attempt to ensure Rank Math's own keyword output is shown (if Rank Math is active and configured to do so).

This plugin helps ensure your content has relevant meta keywords with minimal effort, leveraging the taxonomy you already use or your specific SEO plugin settings.

**Note:** While the direct SEO impact of meta keywords has diminished for major search engines like Google, they can still be useful for some internal site searches, smaller search engines, or specific SEO strategies.

== Installation ==

1.  Upload the `keywords-everywhere` folder to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  That's it! The plugin works automatically in the background. There are no settings pages to configure.

== Frequently Asked Questions ==

= Does this plugin have a settings page? =
No, "Keywords Everywhere" works out-of-the-box. It automatically detects your content type and applies keywords accordingly.

= How does it work with Rank Math SEO? =
The plugin is designed to work seamlessly with Rank Math. It prioritizes Rank Math's "focus keywords." If they are set for a post, product, or term, those will be used. Otherwise, it falls back to using tags/categories.

= What happens if I don't use Rank Math? =
The plugin will simply use your post tags, product tags, and product categories to generate meta keywords.

= Will it create duplicate meta keyword tags if my theme or another SEO plugin already adds them? =
This plugin adds its own `<meta name="keywords" ... />` tag. If another plugin or your theme also adds one, you might end up with multiple keyword meta tags. This is generally not harmful, but it's not ideal.
The plugin specifically tries to use Rank Math's keywords first to avoid this with Rank Math. For other SEO plugins, you might want to check their settings to see if they have an option to disable their own meta keyword generation if you prefer this plugin's logic.

= Where can I see the keywords? =
The keywords are added to the `<head>` section of your website's HTML source code. You can view them by right-clicking on your webpage, selecting "View Page Source" (or similar, depending on your browser), and searching for `<meta name="keywords"`.

== Changelog ==

= 2.0 =
* Initial public release.
* Feature: Automatically adds meta keywords based on post tags.
* Feature: Automatically adds meta keywords based on WooCommerce product tags and categories.
* Feature: Prioritizes Rank Math focus keywords for posts, products, and taxonomy terms.
* Feature: Uses term name as a keyword for taxonomy archives if no Rank Math keywords are present.
* Feature: Adds an animated "Donate" link in the plugin row.

== Upgrade Notice ==

= 2.0 =
This is the first version of the plugin. Enjoy automatic keyword generation!