# WP On the fly (OTF) Regenerate Thumbnails

#### Regenerates thumbnails on the fly for WordPress. 

This plugin behaves similarly to [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) except that images are resized automatically / on the fly, when they are used. Once created, they won't be processed again.

Your thumbnails will now resize when:
* Image Sizes in **Settings > Media** is modified,
* Switching themes & plugins with different thumbnail / featured image sizes

No settings pages, just install and activate and things should work right away.

# What are you talking about?

Test it out. In your normal WordPress website set up, create a gallery using the **Add Media** button while editing a post or page and use thumbnails. Afterwards, check out your gallery.

Notice the size of your thumbnails, most likely they're **150 x 150**. Do you see it? Great.

Now head over to **Settings > Media** and change your thumbnail size to something cooler, something rectangular, let's try **400 x 200**. Save it.

Go back to your gallery that you previously created and refresh your browser. Most likely you *won't* be seeing **400 x 200** thumbnails there.

OTF Regenerate Thumbnails fixes this for you.

# Why?

**WordPress only generates thumbnails when they're uploaded**, that means that themes &amp; plugins that have different sized thumbnails won't have the right dimensions for images that already exist in your site. WordPress uses the closest size that it already has generated instead.

There are regenerate thumbnail plugins already existing for WordPress, but those are manually triggered and goes through all of your attachments (or lets you choose from them). That may take a while especially for large sites.

Lastly, WP functions allow [2-item array sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail) to be used for thumbnails; however those do not work as expected because of the resize behavior of WordPress.

This plugin solves all of the above. No need to regenerate anything anymore since they're done on the fly.

# Features

* Creates Resizes thumbnails on the fly
* Handles Image Size settings changes in **Settings > Media**
* Handles thumbnail / image size changes introduced by switching themes & plugins
* Works automatically, no setup needed
* All calls to `the_post_thumbnail` and other thumbnail functions are handled automatically
* Handles image sizes created from `add_image_size`,
* Handles [2-item array sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail)
* No **custom scripts that perform saving/resizing**, everything is performed by WordPress.

# Installation

1. Head over to Plugins > Add New in the admin
2. Search for "OFT Regenerate Thumbnails"
3. Install & activate the plugin

# History

**This plugin deprecates our old [bfi_thumb](https://github.com/bfintal/bfi_thumb) script.**

bfi_thumb was also an on-the-fly image resizer for WordPress, but it included features like modifying grayscale, opacity, resizing image up, etc. Practically speaking, we **rarely** used those other features. And I'm guessing in a few years filters will be purely CSS also. The script became buggy and most likely it's because of those features. The script itself definitely was not created ***the WordPress Way***.

So now, we've removed all of those unused features and now the script is a plain good ol' image resizer that uses WordPress' hooks to work, no fancy function calls that you'll need to call (ala-[timthumb](http://www.binarymoon.co.uk/projects/timthumb/) & ala-[bfi_thumb](https://github.com/bfintal/bfi_thumb)).

*Inspired by:*
* https://wordpress.stackexchange.com/questions/53344/how-to-generate-thumbnails-when-needed-only/124790#124790
* http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
