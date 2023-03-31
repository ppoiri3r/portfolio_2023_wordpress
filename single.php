<?php get_header(); ?>
<div class="wrapper">
  <div class="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php get_template_part('template-parts/secondary-sidebar'); ?>

      <?php 
      // echo '<section class="home-stream-block">';
      // echo '<div class="flex entry-content">';
      the_content();
      // echo '</div>';
      // echo '</section>'; 
      ?>


      <div id="nav-below" class="navigation">
      </div><!-- #nav-below -->

    <?php endwhile; // end of the loop. ?>

  </div> <!-- /.content -->

</div>

<?php get_footer(); ?>