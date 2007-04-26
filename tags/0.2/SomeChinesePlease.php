<?php
/*
Plugin Name: Some Chinese Please!
Plugin URI: http://bingu.net/blog
Description:a anti-spam plugin for Chinese wordpress users.Base on Mark's plugin - <a href="http://www.marksw.com/blog/wordpress/2007/02/06/dieonspam-yet-another-anti-spam-plugin/">DieOnSpam</a>
Author: Bingu
Version: 0.1 Alpha
Author URI: http://bingu.net/blog
License: GNU General Public License 2.0 http://www.gnu.org/licenses/gpl.html
*/
function SCP_check_chinese ( $comment ) {
global $JC_BlockMessage;
    $str = $comment['comment_content'];
    $f = 0;   
    if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$str) || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$str) || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$str)){
	    $f = 1;
	}

    if ($f == 0) {
        die('Your comment message must contain at least one chinese word!');
     }

	return $comment;
}
add_filter('preprocess_comment', 'SCP_check_chinese');
?>