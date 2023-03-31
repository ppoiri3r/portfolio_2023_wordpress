<?php get_header(); ?>

<div class="wrapper">
  <?php get_template_part('template-parts/secondary-sidebar', ''); ?>
  <!-- <div> -->


    

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
    echo '<section class="home-stream-block">';
    echo '<div class="flex">';
    get_template_part( 'loop', 'archive' );
    echo '</div>';
    echo '</section>';
    ?>


  <!-- </div> -->
  <!-- content -->

</div> 

<?php get_footer(); ?>