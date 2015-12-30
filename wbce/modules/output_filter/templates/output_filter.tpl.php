<?php if ( $msgTxt != '') :?>
<div class="<?php echo $msgCls?>"><?php echo $msgTxt?></div>
<?php endif; ?>
<h2><?php echo $MOD_MAIL_FILTER['HEADING']; ?></h2>
<p><?php echo $MOD_MAIL_FILTER['HOWTO']; ?></p>
<form name="store_settings" action="<?php echo $returnUrl; ?>" method="post">
    <?php echo $admin->getFTAN(); ?>
    <input type="hidden" name="action" value="save" />
    <table width="98%" cellspacing="0" cellpadding="5px" class="row_a">
    <tr><td colspan="2"><strong><?php echo $MOD_MAIL_FILTER['BASIC_CONF'];?>:</strong></td></tr>
    <tr >
        <td width="35%">Enable/Disable all old Outputfilter:</td>
        <td>
            <input type="radio" <?php echo ($data['suppress_old_opf']=='0') ?'checked="checked"' :'';?>
                name="suppress_old_opf" value="0"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['suppress_old_opf'])=='1') ?'checked="checked"' :'';?>
                name="suppress_old_opf" value="1"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
                
        </td>
    </tr>
    <tr><td colspan="2" style="border-top: 1px dotted black !important; ">&nbsp;</td></tr>
    <tr>
        <td width="35%">Droplets filter:</td>
        <td>
            <input type="radio" <?php echo ($data['droplets']=='1') ? 'checked="checked"' :'';?>
                name="droplets" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['droplets'])=='0') ? 'checked="checked"' :'';?>
                name="droplets" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
        <tr>
        <td width="35%">WB Link Filter:</td>
        <td>
            <input type="radio" <?php echo ($data['wblink']=='1') ? 'checked="checked"' :'';?>
                name="wblink" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['wblink'])=='0') ? 'checked="checked"' :'';?>
                name="wblink" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    </tr>
        <tr>
        <td width="35%">CSS, JS, Meta Insert Filter:</td>
        <td>
            <input type="radio" <?php echo ($data['insert']=='1') ? 'checked="checked"' :'';?>
                name="insert" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['insert'])=='0') ? 'checked="checked"' :'';?>
                name="insert" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td width="35%"><?php echo $MOD_MAIL_FILTER['SYS_REL'];?>:</td>
        <td>
            <input type="radio" <?php echo ($data['sys_rel']=='1') ? 'checked="checked"' :'';?>
                name="sys_rel" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['sys_rel'])=='0') ? 'checked="checked"' :'';?>
                name="sys_rel" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td width="35%"><?php echo $MOD_MAIL_FILTER['EMAIL_FILTER'];?>:</td>
        <td>
            <input type="radio" <?php echo ($data['email_filter']=='1') ?'checked="checked"' :'';?>
                name="email_filter" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['email_filter'])=='0') ?'checked="checked"' :'';?>
                name="email_filter" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td><?php echo $MOD_MAIL_FILTER['MAILTO_FILTER'];?>:</td>
        <td>
            <input type="radio" <?php echo ($data['mailto_filter']=='1') ?'checked="checked"' :'';?>
                name="mailto_filter" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['mailto_filter'])=='0') ?'checked="checked"' :'';?>
                name="mailto_filter" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td width="35%">Use Javascript on Mailtofilter:</td>
        <td>
            <input type="radio" <?php echo ($data['js_mailto']=='1') ?'checked="checked"' :'';?>
                name="js_mailto" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['js_mailto'])=='0') ?'checked="checked"' :'';?>
                name="js_mailto" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td width="35%">Use short url filter:</td>
        <td>
            <input type="radio" <?php echo ($data['short_url']=='1') ?'checked="checked"' :'';?>
                name="short_url" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['short_url'])=='0') ?'checked="checked"' :'';?>
                name="short_url" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    <tr>
        <td width="35%">Use CSS to head:</td>
        <td>
            <input type="radio" <?php echo ($data['css_to_head']=='1') ?'checked="checked"' :'';?>
                name="css_to_head" value="1"><?php echo $MOD_MAIL_FILTER['ENABLED'];?>
            <input type="radio" <?php echo (($data['css_to_head'])=='0') ?'checked="checked"' :'';?>
                name="css_to_head" value="0"><?php echo $MOD_MAIL_FILTER['DISABLED'];?>
        </td>
    </tr>
    
    
    
    
    
    <tr><td colspan="2"><br /><strong><?php echo $MOD_MAIL_FILTER['REPLACEMENT_CONF'];?>:</strong></td></tr>
    <tr>
        <td><?php echo $MOD_MAIL_FILTER['AT_REPLACEMENT'];?>:</td>
        <td><input type="text" style="width: 160px" value="<?php echo $data['at_replacement'];?>" 
            name="at_replacement"/></td>
    </tr>
    <tr>
        <td><?php echo $MOD_MAIL_FILTER['DOT_REPLACEMENT'];?>:</td>
        <td><input type="text" style="width: 160px" value="<?php echo $data['dot_replacement'];?>" 
            name="dot_replacement"/></td>
    </tr>
    </table>
    <input type="submit" style="margin-top:10px; width:140px;" value="<?php echo $TEXT['SAVE']; ?>" />
</form>
