<?php
/**
 * 更新选项
 * 
 * @param array $options 选项内容
 */
function scp_update_options($options){
    update_option('scp_options', $options);
}

/**
 * @version WP 2.7
 * Add action link(s) to plugins page
 */
function scp_set_plugin_meta($links) {
	$settings_link = sprintf( '<a href="options-general.php?page=%s">%s</a>', SCP_BASEFOLDER . '/scp-admin.php', __('Settings') );
	array_unshift( $links, $settings_link );
	return $links;
}

/**
 * 在设置中添加名为‘SCP Setting’的子菜单
 */
function scp_add_setting_page() {
    add_options_page('SCP Setting', 'SCP Setting', 8, __FILE__, 'scp_setting_page');
}

/**
 * ‘SCP Setting’中的界面与处理
 */
function scp_setting_page() {
    //如果确定更新，给出更新的提示
    if( $_POST['scp_submit_hidden'] === 'yes' ) {
        $options['message'] = stripslashes(apply_filters('scp_message', $_POST['scp_block_message']));
        $_POST['show_message'] === 'show'
            ? $options['show_message'] = 'show'
            : $options['show_message'] = 'close';
        scp_update_options($options);
        
?>
<div class="updated"><p><strong>设置已保存！</strong></p></div>
<?php
    }
    $scp_options = scp_get_options();
    $scp_blogk_message = attribute_escape($scp_options['message']);
?>
<div class="wrap">
    <h2>"Some Chinese Please!"设置</h2>
    <form name="form1" method="post" action="<?php echo wp_nonce_url('./options-general.php?page=' . SCP_BASEFOLDER . '/scp-admin.php'); ?>">
        <input type="hidden" name="scp_submit_hidden" value="yes">
        <p>
            <label for="scp_block_message">"Some Chinese Please!"捕获无中文内容评论时的提示：</label><br />
            <textarea name="scp_block_message" cols="80" rows="5" id="scp_block_message" class="scp_setting"><?php echo $scp_blogk_message; ?></textarea>
        </p>
        <p>
            <label for="show_message">是否显示在评论框下：</label><input type="checkbox" name="show_message" id="show_message" <?php if ($scp_options['show_message'] == 'show') echo 'checked="checked"';?> value="show" />
        </p>
        <p class="submit">
            <input type="submit" name="Submit" value="更新" />
        </p>
    </form>
</div>
<?php
}

/* EOF scp-admin.php */