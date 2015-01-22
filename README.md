# WP On the fly (OTF) Regenerate Thumbnails

#### Regenerates thumbnails on the fly for WordPress. 

This plugin behaves similarly to [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) exept that images are resized automatically / on the fly, when they are used.

No settings pages, just install and activate and things should work right away.

# What? Why?

**WordPress only generates thumbnails when they're uploaded**, that means that themes &amp; plugins that have different sized thumbnails won't have the right dimensions for images that already exist in your site.

There are regenerate thumbnail plugins already existing for WordPress, but those are manually triggered and goes through your whole uploads folder. That may take a while especially for large sites.

Lastly, WP functions allow [2-item array sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail) to be used for thumbnails; however those do not work as expected because of the resize behavior of WordPress.

This plugin solves all of the above. No need to regenerate anything anymore.

# Features

* Creates Resizes thumbnails on the fly
* Works automatically, no setup needed
* All calls to `the_post_thumbnail` and other thumbnail functions are handled automatically
* Handles image sizes created from `add_image_size`,
* Handles [2-item array sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail)

# Usage

1. Install & activate in WordPress
2. Sit back and relax

# History

**This plugin deprecates our old [bfi_thumb](https://github.com/bfintal/bfi_thumb) script.**

bfi_thumb was also an on-the-fly image resizer for WordPress, but it included features like modifying grayscale, opacity, resizing image up, etc. Practically speaking, we **rarely** used those other features. And I'm guessing in a few years filters will be purely CSS also. The script became buggy and most likely it's because of those features. The script itself definitely was not created ***the WordPress Way***.

So now, we've removed all of those unused features and now the script is a plain good ol' image resizer that uses WordPress' hooks to work, no fancy function calls that you'll need to call (ala-[timthumb](http://www.binarymoon.co.uk/projects/timthumb/) & ala-[bfi_thumb](https://github.com/bfintal/bfi_thumb)).

Inspired by: https://wordpress.stackexchange.com/questions/53344/how-to-generate-thumbnails-when-needed-only/124790#124790
