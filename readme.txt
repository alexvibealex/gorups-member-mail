=== Plugin Name ===
Contributors: alexhal
Donate link: http://www.poolgab.com
Tags: Buddypress,Groups,extension.mail,members,mass
Requires at least: 3.0.1
Tested up to: 4.6.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows Buddypress group Mods to send email to all group members .


== Description ==

Allows Buddypress group Mods to send email to all group members from group admin/manage section.



== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= Why is  this plugin for ? =

To send email to all members of you group

= how to send mail? =

just goto group admin -> manage -> email members tab ,Fill in subject and send he mail.



== Screenshots ==

1. Activation
https://plugins.svn.wordpress.org/groups-members-mail/assets/Screenshot_1.png
2. Preview Screen
https://plugins.svn.wordpress.org/groups-members-mail/assets/Screenshot_2.png

== Changelog ==

= 1.0 =
* A change since the previous version.


== Other notes ==

By default this "E-Mail Members" section is available to mods and admin .
To change it a filter is available and you can change the access like this :
To restrict this option to admins only 
`add_filter('bp_gmm_auhority',function(){
	return 'admin';		
});`