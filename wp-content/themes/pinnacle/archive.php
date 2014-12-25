  <?php get_header(); ?>
      <?php get_template_part('templates/page', 'header'); ?>

       <?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';}
  global $pinnacle, $postcolumn; 
  if(isset($pinnacle['category_post_summary']) && $pinnacle['category_post_summary'] == 'full'){
    $summary = 'full'; $postclass = "single-article fullpost";
  } else if(isset($pinnacle['category_post_summary']) && $pinnacle['category_post_summary'] == 'grid'){
        if(isset($pinnacle['category_post_grid_columns'])) {$blog_grid_column = $pinnacle['category_post_grid_columns'];} else {$blog_grid_column = '3';}
        $summary = 'grid'; $postclass = 'postlist';
        if ($blog_grid_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2';} 
        else if ($blog_grid_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3';} 
        else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '4';}
  } else {$summary = 'normal'; $postclass = 'postlist';} ?>
    <div id="content" class="container">
      <div class="row">
      <div class="main <?php echo kadence_main_class(); ?>  <?php echo $postclass .' '. $fullclass; ?>" role="main">

<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'pinnacle'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>
<?php  if($summary == 'full'){
            if($display_sidebar){
               while (have_posts()) : the_post();
                get_template_part('templates/content', 'fullpost'); 
               endwhile;
             } else {
                while (have_posts()) : the_post(); 
                get_template_part('templates/content', 'fullpostfull');
                endwhile;
             }
      } else if($summary == 'grid') { ?>
                <div id="kad-blog-grid" class="rowtight">
                <?php while (have_posts()) : the_post(); ?>
                <div class="<?php echo $itemsize;?> b_item kad_blog_item">
                 <?php  get_template_part('templates/content', 'post-grid'); ?>
                </div>
                <?php endwhile; ?>
                </div>
                <script type="text/javascript">
               <script type="text/javascript">jQuery( window ).load(function () {var $container = jQuery('#kad-blog-grid');$container.masonry({itemSelector: '.b_item'});});</script>
               <?php
      } else {
          if($display_sidebar){
               while (have_posts()) : the_post();
                    get_template_part('templates/content', get_post_format());
               endwhile;
             } else {
                while (have_posts()) : the_post(); 
                    get_template_part('templates/content', 'fullwidth');
                endwhile;
             }
      }

    if ($wp_query->max_num_pages > 1) : ?>
        <?php if(function_exists('kad_wp_pagenavi')) { ?>
              <?php kad_wp_pagenavi(); ?>   
            <?php } else { ?>      
              <nav class="post-nav">
                <ul class="pager">
                  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></li>
                  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></li>
                </ul>
              </nav>
            <?php } ?> 
        <?php endif; ?>

</div><!-- /.main -->
<?php get_sidebar(); ?>
      </div><!-- /.row-->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php get_footer(); ?>
