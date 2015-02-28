=== OTF Regenerate Thumbnails ===
Contributors: bfintal
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=D2MK28E7BDLHC
Tags: thumbnail, thumbnails, resize, regenerate, automatic, featured image, feature image, on the fly, otf
Requires at least: 3.8
Tested up to: 4.1
Stable tag: 0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically regenerates your thumbnails on the fly when thumbnail sizes change.

== Description ==

This plugin behaves similarly to [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) except that images are resized automatically / on the fly, when they are used. Once created, they won't be processed again.

Your thumbnails will now resize when:

* Image Sizes in **Settings > Media** is modified,
* Switching themes & plugins with different thumbnail / featured image sizes

No settings pages, just install and activate and things should work right away.

Report bugs and help out in the code from the [Github repository](https://github.com/gambitph/WP-OTF-Regenerate-Thumbnails)

= What are you talking about? =

Test it out. In your normal WordPress website set up, create a gallery using the **Add Media** button while editing a post or page and use thumbnails. Afterwards, check out your gallery.

Notice the size of your thumbnails, most likely they're **150 x 150**. Do you see it? Great.

Now head over to **Settings > Media** and change your thumbnail size to something cooler, something rectangular, let's try **400 x 200**. Save it.

Go back to your gallery that you previously created and refresh your browser. Most likely you *won't* be seeing **400 x 200** thumbnails there.

OTF Regenerate Thumbnails fixes this for you.

= Usage =

OTF Regenerate Thumbnails should work right away, and your images should get resized when the dimensions get changed.

**For developers & tinkerers, ensuring your images get resized properly requires you to use WordPress' image functions to display featured images and image attachments.** Don't worry, this is a good thing.

Make sure you use these WordPress functions **every time you display images**:

* [`wp_get_attachment_image_src`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src)
* [`wp_get_attachment_image`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image)
* [`the_post_thumbnail`](http://codex.wordpress.org/Function_Reference/the_post_thumbnail)
* [`get_the_post_thumbnail`](http://codex.wordpress.org/Function_Reference/get_the_post_thumbnail)

You can also add size *names* using [`add_image_size`](http://codex.wordpress.org/Function_Reference/add_image_size)

= Features =

* Creates Resizes thumbnails on the fly
* Handles Image Size settings changes in **Settings > Media**
* Handles thumbnail / image size changes introduced by switching themes & plugins
* Works automatically, no setup needed
* All calls to `the_post_thumbnail` and other thumbnail functions are handled automatically
* Handles image sizes created from `add_image_size`,
* Handles [2-item array sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail)

== Installation ==

1. Head over to Plugins > Add New in the admin
2. Search for "OFT Regenerate Thumbnails"
3. Install & activate the plugin

== Screenshots ==

1. This is my Settings > Media screen, the thumbnails specified as 80 x 80
2. This is what my gallery looks like. Yup, it's 80 x 80
3. I just changed my Settings > Media thumbnails to 400 x 200
4. But, my gallery thumbnails still look like it's all 80 x 80 :(
5. After turning on the OTF Regenerate Thumbnails, my gallery now shows 400 x 200 thumbnails :)

== Frequently Asked Questions ==

* [OTF Regenerate Thumbnails GitHub Repository](https://github.com/gambitph/WP-OTF-Regenerate-Thumbnails)
* [Issue Tracker](https://github.com/gambitph/WP-OTF-Regenerate-Thumbnails/issues)

== Upgrade Notice ==

== Changelog ==

= 0.3 =

* Add new image size to attachment meta so WordPress can perform actions on the image

= 0.2 =

* Bug fix: image size names which do not exist

= 0.1 =

* First release
