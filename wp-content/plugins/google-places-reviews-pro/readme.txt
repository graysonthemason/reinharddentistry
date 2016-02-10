=== Google Places Reviews Pro ===
Contributors: dlocc, wordimpress
Donate link: http://wordimpress.com/
Tags: google, reviews, google reviews, google places, google places reviews, google review widget, google business reviews, google review, review, google place review
Requires at least: 3.8
Tested up to: 4.3

Google Places Reviews makes it a breeze for you to display reviews on your WordPress website that help boost consumer confidence and search engine optimization.

== Description ==

Easily display Google Reviews on your WordPress website using a powerful and intuitive widget. Ensure you're positively impacting your customer's journey by displaying reviews from Google on your business website. Great for restaurants, retail stores, franchisees, real estate firms, hotels and hospitality, and nearly any business with a website and reviews on Google.

Positive reviews on websites like Google help businesses gain additional exposure and further enhance their online credibility. A [recent study](http://marketingland.com/survey-customers-more-frustrated-by-how-long-it-takes-to-resolve-a-customer-service-issue-than-the-resolution-38756) conducted by Dimensional Research found that the buying decisions of 90% of consumers are influenced by positive online reviews. Additionally, a [2012 study published on Search Engine Land](http://searchengineland.com/study-72-of-consumers-trust-online-reviews-as-much-as-personal-recommendations-114152 "View the Article Online") shows that 72% of consumers trust online reviews as much as personal recommendations. If you do the research it quickly becomes clear. Positive reviews add substantial credibility to any business and can lead to increased conversion rates and higher sales.

There is significant data that shows how much consumers care about online reviews but very little information about what businesses are doing to respond to this phenomenon. Here's an idea: Display reviews on your WordPress website from Google!

Google Places Reviews allows you to display up to 3 business reviews with the free version and 5 with the Pro version. Setup is quick and easy. Simply install the plugin, insert your Google API (free and documented), and drag the widget into any sidebar to configure the options.

= Plugin Features =

* Google Business Reviews - Display up to 3 business reviews per location.
* Detailed Business Information - Show the business name, website, Google+ page and more.
* Versatile Widget Themes - Choose from a selection of stunning widget themes that fit light and dark color schemes that make integration with your website design effortless.
* Google Places Autocomplete - Easily lookup businesses in your area through the widget interface using the power of Google search.
* Actively Supported and Developed - We are a team of expert developers based in San Diego, California and we stand by our work. Got a problem? Hit us up.

= Google Places Reviews Pro Version =

Google Places Reviews Pro is a significant upgrade to Google Places Reviews that adds many features to the core plugin:

* More Reviews - Display up to 5 reviews using the Google Places API
* Powerful Shortcode - Display reviews in your post and page content
* Review concatenation - Some reviews returned by Google may be very long which could result in a very long widget. The Pro version includes a customizable feature for collapsing and expanding long reviews with "Read more" and "Close" links.
* Priority Support - Get fast and responsive support from WordPress experts in the USA for the lifetime of your license.

== Installation ==

1. Upload the `google-places-reviews` folder and it's contents to the `/wp-content/plugins/` directory or install via the WP plugins panel in your WordPress admin dashboard
2. Activate the plugin through the 'Plugins' menu in WordPress
3. That's it! You should now be able to use the widget.

Note: If you have WordPress 2.7 or above (and I hope you are) you can simply go to 'Plugins' &gt; 'Add New' in the WordPress admin and search for "Google Places Reviews" and install it from there.

== Frequently Asked Questions ==

= Why does the widget look funny in my theme? =

Most likely your theme has conflicting CSS that is interfering with the themes included with the plugin. If you're handy with CSS this can be an easy fix. If you are new to CSS then try out the Bare Bones theme to see if that looks nicer. Otherwise, you may have to hit up your coding friends to help you out.

= Are style (CSS) and/or theme compatibility issues supported? =

We do our best to support the free version of the plugin but it's not our priority. The premium plugin is where we spend most of our support time. If you are experiencing a style issue and need help, either upgrade to the Premium version or post in the WordPress.org support forum and we will do our darnedest to get it set up nicely for your theme.

= Are there prebuilt styles included in the plugin? =

Yes, there are three basic themes included in the free version of the plugin. The premium version has many more options and themes.

== Roadmap ==

* Important: Switch from using soon to be deprecated Google reference ID to new place ID
* Important: Provide alternate means for users to lookup business if lookup field does not work (JS conflict, etc).

== Changelog ==

= 1.3.4 =
* Fix: Compatibility with WordPress 4.3

= 1.3.3 =
* New: Image upload option to set a Avatar. Rejoice! :)

= 1.3.2 =
* New: English .POT file for translation
* Fix: Broken avatar images displayed for some reviews where the user had not set an avatar

= 1.3.1 =
* Fix: All images properly loaded over HTTPS now; no more non-green locks b/c of Google Places Widget!
* Fix: "Clear Cache" button under Advanced Options now actually clears the cache
* Fix: Thesis Framework CSS issues
* Fix: Minor typo in alert message

= 1.3 =
* New: Shortcode builder - no more struggling to create the perfect shortcode. Yippee!
* New: Language .pot file for translators
* New: Added additional widget field tooltips
* New: Place "Type" filter to help users find their locations' Place ID on Google
* New: Additional shortcode specific tooltips added to help understanding of the various options
* Update: Switched from Google Places API "Reference" to "Place ID"
* Update: Switched wpautop() to htmlentities_decode() in the pre_content and post_content options
* Update: Textdomain changed from 'google-places-reviews' to a much more manageable 'gpr'
* Update: Better tooltip output using new gpr_admin_tooltip function
* Fix: Several minor PHP warnings and notices
* Fix: Shortcode - title option not properly outputting within shortcode
* Fix: Shortcode bug not respecting review_char_limit option
* Fix: "Hide Google Logo" didn't work properly and the label wasn't clickable in the widget form.
* Fix: Minor admin CSS touch ups for WP 4.2

= 1.2.3.3 =
* Fix to display shortcode pre_content option
* Update to the banner content so it makes more sense
* License adjustment to work with new WordImpress host
* Removed usage of GPR_DEBUG in favor of SCRIPT_DEBUG constant
* CSS updates for dark theme body content coloring

= 1.2.3.2 =
* Fix for https on Mystery Man image.
* Fix for undefined error when Place ID not present.
* Fix for undefined error for when no author_url is present.
* Set https for user avatars.

= 1.2.3.1 =
* Updated plugin name for free/pro differentiation
* Incorporated activation update

= 1.2.3 =
* Added 'review_char_limit' parameter to the shortcodes

= 1.2.2.1 =
* Hot fix: Fixed issue plugin admin options broken CSS/JS

= 1.2.2 =
* New: Class based structure for plugin base
* Update: Ensure update process from the free version to pro version doesn't drop user's options or kick user back to free version if license isn't activated.
* Update: Fixed issue with WP Engine caching and occasional issues with cached license activation responses
* Update: EDD_SL_Plugin_Updater.php to v1.5
* Fix: PHP Notice on Shortcode reviews_link variable

= 1.2.1 =
* New: Updated CSS so reviewers' avatar image doesn't get cut off
* New: CSS improvement for Read More being too close to the review's last sentence

= 1.2.0 =
* New: Additional manual Google Reviews ID lookup field for those businesses where the search field doesn't work.
* New: "Review Character Limit" field now allows you to customize the amount of text displayed within each individual review
* New: Option to toggle the link to the reviewer's Google+ page
* Update: Fixed minor CSS issue with star counts collapsing below review avatar for some sidebars with tight widths; several padding reductions to support slimmer widths.
* Improved error handling from Google so that the user can see the bad result back from the API
* Removed schema.org tags - Google's guidelines state that the schema.org markup content must be of original content that you and your users have generated and is self-contained on the page
* Fix: Updated bad link to docs on site

= 1.1.0 =
* Version bump

= 1.0 =
* Initial Pro version release!
