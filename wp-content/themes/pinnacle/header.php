<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?> >
<!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri() . '/assets/js/vendor/respond.min.js';?>"></script>
    <![endif]-->
<div id="wrapper" class="container">
  <?php
    do_action('get_header');
    get_template_part('templates/header');
  ?>
<div class="wrap contentclass" role="document">