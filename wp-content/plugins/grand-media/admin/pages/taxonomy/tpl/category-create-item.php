<?php
/**
 * Add Album Form
 */
global $gmProcessor, $gmGallery;
$gmedia_url = $gmProcessor->url;

$_orderby   = $gmGallery->options['in_category_orderby'];
$_order     = $gmGallery->options['in_category_order'];
?>
<form method="post" id="gmedia-edit-term" name="gmAddTerms" class="panel-body" action="<?php echo $gmedia_url; ?>" style="padding-bottom:0; border-bottom:1px solid #ddd;">
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label><?php _e('Name', 'grand-media'); ?></label>
                <input type="text" class="form-control input-sm" name="term[name]" placeholder="<?php _e('Category Name', 'grand-media'); ?>" required/>
            </div>
            <div class="form-group">
                <label><?php _e('Description', 'grand-media'); ?></label>
                <textarea class="form-control input-sm" style="height:49px;" rows="2" name="term[description]"></textarea>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group row">
                <div class="col-xs-6">
                    <label><?php _e('Order gmedia', 'grand-media'); ?></label>
                    <select name="term[meta][_orderby]" class="form-control input-sm">
                        <option value="ID"<?php selected($_orderby, 'ID'); ?>><?php _e('by ID', 'grand-media'); ?></option>
                        <option value="title"<?php selected($_orderby, 'title'); ?>><?php _e('by title', 'grand-media'); ?></option>
                        <option value="gmuid"<?php selected($_orderby, 'gmuid'); ?>><?php _e('by filename', 'grand-media'); ?></option>
                        <option value="date"<?php selected($_orderby, 'date'); ?>><?php _e('by date', 'grand-media'); ?></option>
                        <option value="modified"<?php selected($_orderby, 'modified'); ?>><?php _e('by last modified date', 'grand-media'); ?></option>
                        <option value="rand"<?php selected($_orderby, 'rand'); ?>><?php _e('Random', 'grand-media'); ?></option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <label><?php _e('Sort order', 'grand-media'); ?></label>
                    <select name="term[meta][_order]" class="form-control input-sm">
                        <option value="DESC"<?php selected($_order, 'DESC'); ?>><?php _e('DESC', 'grand-media'); ?></option>
                        <option value="ASC"<?php selected($_order, 'ASC'); ?>><?php _e('ASC', 'grand-media'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>&nbsp;</label>
                <?php
                wp_original_referer_field(true, 'previous');
                wp_nonce_field('GmediaTerms', 'term_save_wpnonce');
                ?>
                <input type="hidden" name="term[taxonomy]" value="gmedia_category"/>
                <button style="display:block" type="submit" class="btn btn-primary btn-sm" name="gmedia_category_save"><?php _e('Add New Category', 'grand-media'); ?></button>
            </div>
        </div>
    </div>
</form>
