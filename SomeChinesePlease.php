<?php
/*
Plugin Name: Some Chinese Please!
Plugin URI: http://bingu.net/blog
Description: 这是一个给用中文写作的blogger准备的防御spam的插件。
Author: 冰古
Version: 1.0.1
Author URI: http://bingu.net
License: GNU General Public License 2.0 http://www.gnu.org/licenses/gpl.html
*/
if ( !defined('WP_PLUGIN_URL') )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );                           //  plugin url

define('SCP_BASENAME', plugin_basename(__FILE__));                                       //  SomeChinesePlease.php
define('SCP_BASEFOLDER', plugin_basename(dirname(__FILE__)));                            //  SomeChinesePlease
define('SCP_FILENAME', str_replace(SCP_BASEFOLDER.'/', '', plugin_basename(__FILE__)));  //  /SomeChinesePlease/SomeChinesePlease.php

// 初始化选项
register_activation_hook(__FILE__, 'scp_set_options');

/**
 * 初始化选项
 */
function scp_set_options() {
    $message = '<strong>NOTICE:</strong> You should type some Chinese word (like “你好”) in your comment to pass the spam-check, thanks for your patience!';
    $show_message = 'show';
    $options = array('message'=>$message, 'show_message'=>$show_message);
    add_option('scp_options', $options, '', 'yes');
}

/**
 * 得到选项
 * @return array
 */
function scp_get_options(){
    return get_option('scp_options', TRUE);
}

// 增加一个名为‘scp_message’的过滤器
add_filter('scp_message', 'wp_filter_kses');
add_filter('scp_message', 'wptexturize');

// 增加一个名为‘display_smilies’的过滤器
add_filter('display_smilies', 'convert_smilies');

if (is_admin()){
    require 'scp-admin.php';
    add_filter('plugin_action_links_' . $plugin, 'scp_set_plugin_meta');
    add_action('admin_menu', 'scp_add_setting_page');
}
else{
    require 'scp-front.php';
    wp_enqueue_script('jquery');
    add_action('wp_footer', 'scp_js');
    add_action('wp_head', 'scp_css');
    add_filter('preprocess_comment', 'scp_check_comment');
}
/* EOF SomeChinesePlease.php */