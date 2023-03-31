<section class="secondary home-stream-block">
  <a href="<?php echo get_home_url(); ?>">
    <h1 class="block-title">Paula Poirier is a creative wordpress & shopify developer. 
      <span><?php if(is_archive()): ?>These are her <?php echo $post_type; ?><?php endif;?><?php if(is_single()): ?>This is <?php the_title(); ?><?php endif;?>.</span>
    </h1>
  </a>
  <?php get_template_part('template-parts/logo-p'); ?>
  <?php get_template_part('template-parts/social-aside'); ?>
</section>