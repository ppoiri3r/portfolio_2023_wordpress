<?php get_header(); ?>

<div class="wrapper">
  <div class="content">
    <section class="home-stream-block">
      <a href="<?php echo get_home_url(); ?>"><h1 class="block-title">Paula Poirier is a creative wordpress & shopify developer. <span class="reveal-text">These are her <?php echo $post_type; ?>.</span></h1></a>
  <!-- container for social aside and stream -->
  <div class="flex">
    <!-- social aside -->
    <div>
    <?php get_template_part('template-parts/logo-p'); ?>
    <?php get_template_part('template-parts/social-aside'); ?>
    </div>


    

    <?php
    /* Since we called the_post() above, we need to
      * rewind the loop back to the beginning that way
      * we can run the loop properly, in full.
      */
    rewind_posts();

    /* Run the loop for the archives page to output the posts.
      * If you want to overload this in a child theme then include a file
      * called loop-archives.php and that will be used instead.
      */
    get_template_part( 'loop', 'archive' );
    ?>

  </div><!--/content-->

  <?php get_sidebar(); ?>

</div> 

<?php get_footer(); ?>