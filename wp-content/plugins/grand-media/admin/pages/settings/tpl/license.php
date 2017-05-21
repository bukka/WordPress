<?php
// don't load directly
if( !defined('ABSPATH')){
    die('-1');
}

/**
 * License Key
 */
?>
<fieldset id="gmedia_premium" class="tab-pane active">
    <p><?php _e('Enter Gmedia Premium Key to remove backlink label from premium gallery modules and unlock settings below.') ?></p>

    <div class="row">
        <div class="form-group col-xs-5">
            <label><?php _e('Gmedia Premium Key', 'grand-media') ?>: <?php if(isset($gmGallery->options['license_name'])){
                    echo '<em>' . $gmGallery->options['license_name'] . '</em>';
                } ?></label>
            <input type="text" name="set[purchase_key]" id="purchase_key" class="form-control input-sm" value="<?php echo $pk; ?>"/>

            <div class="manual_license_activate"<?php echo(('manual' == $gmCore->_get('license_activate'))? '' : ' style="display:none;"'); ?>>
                <label style="margin-top:7px;"><?php _e('License Name', 'grand-media') ?>:</label>
                <input type="text" name="set[license_name]" id="license_name" class="form-control input-sm" value="<?php echo $gmGallery->options['license_name']; ?>"/>
                <label style="margin-top:7px;"><?php _e('License Key', 'grand-media') ?>:</label>
                <input type="text" name="set[license_key]" id="license_key" class="form-control input-sm" value="<?php echo $lk; ?>"/>
                <label style="margin-top:7px;"><?php _e('Additional Key', 'grand-media') ?>:</label>
                <input type="text" name="set[license_key2]" id="license_key2" class="form-control input-sm" value="<?php echo $gmGallery->options['license_key2']; ?>"/>
            </div>
        </div>
        <?php if( !('manual' == $gmCore->_get('license_activate') || !empty($pk))){ ?>
            <div class="form-group col-xs-7">
                <label>&nbsp;</label>
                <button style="display:block;" class="btn btn-success btn-sm" type="submit" name="license-key-activate"><?php _e('Activate Key', 'grand-media'); ?></button>
            </div>
        <?php } ?>
    </div>
    <fieldset <?php echo (empty($gmGallery->options['license_name'])? 'disabled' : ''); ?>>
        <hr/>
        <div class="form-group">
            <label><?php _e('Delete original images', 'grand-media') ?>:</label>
            <div class="checkbox" style="margin:0;">
                <input type="hidden" name="set[delete_originals]" value="0"/>
                <label><input type="checkbox" name="set[delete_originals]" value="1" <?php checked($gmGallery->options['delete_originals'], '1'); ?> /> <?php _e('Do not keep original images on the server', 'grand-media'); ?>
                </label>
            </div>
            <p class="help-block"><?php _e('Warning: You can\'t undo this operation. Checking this option you agree to delete original images. You will not be able: restore images after modification in the Image Editor; re-create web-optimized images; ...', 'grand-media'); ?></p>
        </div>

        <hr/>
        <div class="form-group">
            <label><?php _e('Gmedia Tags & Categories', 'grand-media'); ?></label>
            <div class="checkbox" style="margin:0;">
                <input type="hidden" name="set[wp_term_related_gmedia]" value="0"/>
                <label><input type="checkbox" name="set[wp_term_related_gmedia]" value="1" <?php checked($gmGallery->options['wp_term_related_gmedia'], '1'); ?> /> <?php _e('Show Related Media from Gmedia library for Wordpress native tags & categories', 'grand-media'); ?>
                </label>
            </div>
            <div class="checkbox" style="margin:0;">
                <input type="hidden" name="set[wp_post_related_gmedia]" value="0"/>
                <label><input type="checkbox" name="set[wp_post_related_gmedia]" value="1" <?php checked($gmGallery->options['wp_post_related_gmedia'], '1'); ?> /> <?php _e('Show Related Media from Gmedia library for Wordpress Posts based on tags', 'grand-media'); ?>
                </label>
            </div>
            </div>

        <hr/>
        <div class="form-group">
            <label><?php _e('Show "Any Feedback?" in the Sidebar', 'grand-media') ?>:</label>
            <div class="checkbox" style="margin:0;">
                <input type="hidden" name="set[feedback]" value="0"/>
                <label><input type="checkbox" name="set[feedback]" value="1" <?php checked($gmGallery->options['feedback'], '1'); ?> /> <?php _e('Show "Any Feedback?"', 'grand-media'); ?>
                </label>
            </div>
            <p class="help-block"><?php _e('I\'d be very happy if you leave positive feedback about plugin on the WordPress.org Directory. Thank You!', 'grand-media'); ?></p>
        </div>
        <div class="form-group">
            <label><?php _e('Show Twitter News in the Sidebar', 'grand-media') ?>:</label>
            <div class="checkbox" style="margin:0;">
                <input type="hidden" name="set[twitter]" value="0"/>
                <label><input type="checkbox" name="set[twitter]" value="1" <?php checked($gmGallery->options['twitter'], '1'); ?> /> <?php _e('Show Twitter News', 'grand-media'); ?>
                </label>
            </div>
            <p class="help-block"><?php _e('Follow Gmedia on twitter to not miss info about new modules and plugin updates.', 'grand-media'); ?></p>
        </div>
    </fieldset>

</fieldset>
