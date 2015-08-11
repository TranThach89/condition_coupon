=== YITH WooCommerce Zoom Magnifier ===

Contributors: yithemes
Tags: zoom, magnifier, woocommerce, product image, themes, yit, e-commerce, shop, thumbnail, thumbnail slider, zoom image, carousel, image carousel
Requires at least: 3.5.1
Tested up to: 4.2.2
Stable tag: 1.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

YITH WooCommerce Zoom Magnifier add zoom effect to product images and a customizable image slider.

== Description ==

= Improve the user experience, improve your sales =

Offer to your visitors a chance to inspect in detail the quality of your products. With YITH WooCommerce Zoom Magnifier you can add a zoom effect to all your product images.
The Wordpress plugin also adds a slider below the featured image with your product gallery images.

= Main features =

* Show a bigger size product image on mouseover.
* Customize zoom area width and height and the size of the image to show as zoomed image.
* Enable or disable it on mobile devices.
* Add a slider showing product image thumbnails.
* Customize the slider behavior.

For a more detailed list of options and features of the plugin, please look at the [official documentation](http://yithemes.com/docs-plugins/yith_woocommerce_magnifier/ "Yith WooCommerce Zoom Magnifier official documentation").

Discover all the features of the plugin and install it in your theme: the result will be extremely satisfying.

== Installation ==
Important: First of all, you have to download and activate WooCommerce plugin, which is mandatory for Yith WooCommerce Zoom Magnifier to be working.

1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `YITH WooCommerce Zoom Magnifier` from Plugins page

= Configuration =

YITH WooCommerce Zoom Magnifier will add a new tab called "Zoom Magnifier" in "YIT Plugins" menu item. There, you will find all Yithemes plugins with quick access to plugin setting page.

== Frequently Asked Questions ==

= The size of the Zoom image is not the size I setted. Why? =
If you enabled the plugin after you uploaded the images of the product you need to [regenerate the thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/ "regenerate the thumbnails") before to use it. Another reason could be that the size setted for the zoom images is greather than the original image size.

= I'm not able to change the sizes of Zoom Image. Why? =
The size of the Zoom Image is automatically setted. If you want to change these values you just need to untick the option Forcing Zoom Image sizes.

== Screenshots ==

1. The General plugin settings page. You can disable the plugin for mobile devices.
2. The Magnifier settings page. Choose the size of the zoom area, the size of the image to be shown in zoom area and the its position (on the right or over the image).
3. The slider settings page. You can choose to use the slider for product image thumbnails, set how many images to show within the slider, and the behavior of the slider, choosing if circular, infinite or standard carousel.
4. The zoom applied to a product image, showing zoomed image on the right side.
5. The zoom applied to a product image, showing zoomed image over the same image.
6. Choose how many items the slider should show, the image thumbnails will fit the available width.

== Changelog ==

= Version 1.2.5 - RELEASED: JUL 23, 2015 =

* Added: italian language.

= Version 1.2.4 - RELEASED: JUN 26, 2015 =

* Added: support to srcset and src-orig attributes.

= Version 1.2.3 - RELEASED: MAY 29, 2015 =

* Added: included jquery-migrate as prerequisite.

= Version 1.2.2 - RELEASED: MAY 22, 2015 =

* Fixed: CSS fix for EssentialGrid conflicts.

= Version 1.2.1 - RELEASED: MAY 04, 2015 =

* Fixed: removed z-index that made the zoom area hiding other elements in certain themes.

= Version 1.2.0 - RELEASED: APR 22, 2015 =

* Fix : security issue (https://make.wordpress.org/plugins/2015/04/20/fixing-add_query_arg-and-remove_query_arg-usage/)
* Tweak : support up to Wordpress 4.2

= 1.1.8 =

* Fixed: compatibility with some YITHEMES themes.

= 1.1.7 =

* Fixed: Unwanted expand link on product image.

= 1.1.6 =

* Added: the plugin can be disabled on mobile devices.

= 1.1.5 =

* Fixed: multiple wrap

= 1.1.4 =

* Tweak: WooCommerce 2.2. support
* Fixed: Placeholder in product without featured image
* Fixed: Slider items number options doesn't work

= 1.1.3 =

* Added: Support to WC 2.2.2
* Updated: Plugin Core Framework

= 1.1.2 =

* Restored: Image size options on WC 2.1.x
* Fixed: Items number option on thumb slider 
* Fixed: Hard crop issue on WC 2.1.x

= 1.1.1 =

* Fixed: Thumbnails slider direction on single product page

= 1.1.0 =

* Added: Support to WooCommerce 2.1.x

= 1.0.8 =

* Added: ability to change the slider programmatically

= 1.0.7 =

* Fixed: zoomed image did not change when select a variation

= 1.0.6 =

* Removed white space from frontend.php

= 1.0.5 =

* Fixed: magnifier override the plugin for featured video

= 1.0.4 =

* Minor bugs fixes

= 1.0.3 =

* Added ability to load the plugin even when WooCommerce is installed in a different folder

= 1.0.2 =

* Fixed fatal error to yit_debug with yit themes

= 1.0.1 =

* Optimized images
* Updated internal framework

= 1.0.0 =

* Initial release

== Suggestions ==

If you have suggestions about how to improve YITH WooCommerce Zoom Magnifier, you can [write us](mailto:plugins@yithemes.com "Your Inspiration Themes") so we can bundle them into YITH Zoom WooCommerce Magnifier.

== Translators ==

= Available Languages =
* English (Default)
* Italiano

If you have created your own language pack, or have an update for an existing one, you can send [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress")
[use](http://yithemes.com/contact/ "Your Inspiration Themes") so we can bundle it into YITH WooCommerce Zoom Magnfier Languages.

== Documentation ==

Full documentation is available [here](http://yithemes.com/docs-plugins/yith_woocommerce_magnifier/).

== Upgrade notice ==

= 1.0.0 =

Initial release