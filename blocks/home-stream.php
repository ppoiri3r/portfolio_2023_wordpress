<?php 

  global $post;
  

  $title = get_field('page_title');
  $stream_title = get_field('stream_title');
  $featured_posts = get_field('featured_posts');
  $post_type = 'projects';

  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => 4,
  );  

  if($featured_posts) {
      $args['post__in'] = $featured_posts;
  }

  $featured_posts = new WP_Query($args);

  ?>
<section class="home-stream-block">
  <a href="<?php get_home_url(); ?>"><h1 class="block-title"><?php echo $title; ?>.</h1></a>
  <!-- container for social aside and stream -->
  <div class="flex">
    <!-- social aside -->
    <div>
      <?php get_template_part('template-parts/logo-p'); ?>
      <?php get_template_part('template-parts/social-aside'); ?>
    </div>

    <!-- stream -->
    <div class="stream-container">
      <h2><?php echo $stream_title; ?></h2>
          <div class="feature__works stream">
            <?php if($featured_posts->have_posts()): ?>
            <ul>
              <?php while($featured_posts->have_posts( )): $featured_posts->the_post(); 
              $live_link = get_field('live_site', $post->ID);
              if($post_type == 'projects') {
                $project_types = get_the_terms( $post->ID, 'project-type');
              };
              ?>
                <li>
                  <?php if($project_types): ?>
                    <?php foreach ($project_types as $project_type): 
                    $name = $project_type->name; ?>
                    <span class="term"><?php echo $name; ?></span>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <h3><?php the_title(); ?><?php if($name == 'Wordpress'): ?>
                  <span><?php get_template_part('template-parts/wordpress-logo'); ?></span>
                  <?php endif; ?><?php if($name == 'Shopify'): ?><?php get_template_part('template-parts/shopify-logo'); ?><?php endif; ?></h3>
                  <?php if(get_the_excerpt() != null): ?>
                    <p class="entry-excerpt">
                      <?= get_the_excerpt(); ?>
                    </p>
                  <?php endif; ?>
                  <?php if($live_link): ?>
                  <div class="links">
                    <a class="secondary" href="<?php echo $live_link['url']; ?>" target="<?php echo $live_link['target']; ?>"><?php echo $live_link['title']; ?></a>
                  </div>
                  <?php endif; ?>
                </li>
              <?php endwhile; ?>
            </ul>
            <?php endif; ?>
            <?php wp_reset_postdata(  ) ; ?>
            <?php 
              $cta = get_field('cta'); 
              ?>
              <?php if($cta): ?>
              <a href="<?php echo get_home_url(); ?><?php echo $cta['url']; ?>" class="primary"><?php echo $cta['title']; ?></a>
              <?php endif; ?>
        </div>

      </div>
    </section>