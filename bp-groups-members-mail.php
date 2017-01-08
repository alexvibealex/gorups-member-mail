<?php
/* 
Plugin Name: Group Members Mail Plugin
Plugin URI: http://www.poolgab.com
Description: A simple WordPress plugin to send mails to all buddypress group members  
Version: 1.0
Author: alexhal
Author URI: http://www.poolgab.com
License: GPL2
*/
/*
Copyright 2014  VibeThemes  (email : alexvibealex@gmail.com)

c program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

Group member mail plugin program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with wplms_customizer program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/






if(class_exists('Group_Members_Mail'))
{	
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Group_Members_Mail', 'activate'));
    register_deactivation_hook(__FILE__, array('Group_Members_Mail', 'deactivate'));

    // instantiate the plugin class
    $Group_Members_Mail = new Group_Members_Mail();
}

function groups_member_mail_cssjs(){
   if( bp_is_group_admin_page() && 'group-members-mail' == bp_get_group_current_admin_tab()  ){
        wp_enqueue_style( 'groups-member-mail-css', plugins_url( 'css/gmm.css' , __FILE__ ));
        wp_enqueue_script( 'groups-member-mail-js', plugins_url( 'js/gmm.js' , __FILE__ ));
        wp_enqueue_script( 'tiny_mce' );
    }
}

add_action('bp_init','Group_Members_Mail');
function Group_Members_Mail(){
      add_action('wp_enqueue_scripts','groups_member_mail_cssjs'); 
      include_once 'classes/gmm.class.php';
}
function set_content_type( $content_type ) {
    return 'text/html';
}
add_action( 'plugins_loaded', 'group_members_mail_language_setup' );
function group_members_mail_language_setup(){
    $locale = apply_filters("plugin_locale", get_locale(), 'bp-gmm');
    
    $lang_dir = dirname( __FILE__ ) . '/languages/';
    $mofile        = sprintf( '%1$s-%2$s.mo', 'bp-gmm', $locale );
    $mofile_local  = $lang_dir . $mofile;
    $mofile_global = WP_LANG_DIR . '/plugins/' . $mofile;

    if ( file_exists( $mofile_global ) ) {
        load_textdomain( 'bp-gmm', $mofile_global );
    } else {
        load_textdomain( 'bp-gmm', $mofile_local );
    }   
}