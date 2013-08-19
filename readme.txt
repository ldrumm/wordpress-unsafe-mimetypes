=== Unsafe Mimetypes ===
Contributors: ldrumm
Tags: filetypes, security
Requires at least: 3.0.1
Tested up to: 3.6
Stable tag: 0.1.0
License: zlib
License URI: http://zlib.net/zlib_license.html

Unsafe Mimetypes allows a WordPress admin to decide which file formats can be uploaded to the media library

== Description ==

Unsafe Mimetypes allows users to define extra media types not allowed by the standard WordPress installation.  Users will often encounter the message 'Sorry, this file type is not permitted for security reasons.'

This plugin allows the site admin to upload and distribute files other than the basic set WordPress allows by default.  This plugin allows the user to define a list of extensions they wish to allow.  Administrators can choose to allow only Administrators or all Media Uploaders to be able to add the defined types to the library.

Note: This plugin does not permit the user to change the maximum upload size, which may be needed for large multimedia files.

== Installation ==

1. unpack the zip file to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Once I've added a filetype to the whitelist, can I then use the WordPress media manager to include uploaded files in my Post/Page? =

Yes.  This is the expected usage.  The author uses it to distribute `.wav` and `.flac` audio files, and upload `.png` images as part of the post.

= Is is safe to allow users to upload `php` files? =

**Never do this** unless you're using it to upload your own `php` files, you're admin, _and_ you know the risks involved.

== Screenshots ==

1. This is the error message you will see from the media manager when trying to upload many non-standard filetypes.
2. This is admin interface where you can define a list of file extensions you wish to add to the whitelist. If you trust your editors you can also choose to grant the same permissions to them also.

== Changelog ==

= 0.1.0 =

* First public release.

== Translation ==

Currently, the interface offers English and Spanish versions.  Spanish translation by Mariana.
