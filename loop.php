<?php // If there are no posts to display, such as an empty archive page ?>

<?php if ( ! have_posts() ) : ?>

	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<section class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</section><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>

<?php // if there are posts, Start the Loop. ?>

	<div class="stream-container">
		<h2><?php echo $post_type; ?> Archive</h2>
		<div class="form-container">
			<form action="#" id="filter">
				<fieldset>
					<p>Filter by:</p>
					<?php 
					$terms = get_terms();
					echo '<input name="type" id="all" value="all" type="radio">';
					echo '<label for="all">Clear Filters</label>';
					foreach($terms as $t) {
						if($t->taxonomy == 'project-type') {
							echo '<div>';
							echo '<input name="type" id="'.$t->slug.'" value="'.$t->term_id.'" type="radio"></>';
							echo '<label for="'.$t->slug.'">'.$t->name.'</label>';
							echo '</div>';
						}
					}
					?>
				</fieldset>
			</form>
		</div>
		<div class="feature__works stream">
			<ul>
			<?php while ( have_posts() ) : the_post(); 
			$live_link = get_field('live_site', $post->ID);
			if($post_type == 'projects') {
        $project_types = get_the_terms( $post->ID, 'project-type');
      };
			foreach($project_types as $project_type) {
				$name = $project_type->name;
			}
			?>
				<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h3 class="entry-title"><?php the_title(); ?><?php if($name == 'Wordpress'): ?><span><?php get_template_part('template-parts/wordpress-logo'); ?></span><?php endif; ?><?php if($name == 'Shopify'): ?><?php get_template_part('template-parts/shopify-logo'); ?><?php endif; ?>
					</h3>
					<?php if(get_the_excerpt() != null): ?>
						<p class="entry-excerpt">
							<?= get_the_excerpt(); ?>
						</p>
          <?php endif; ?>
					<?php if($live_link): ?>
					<div class="links">
						<!-- <a class="secondary internal" href="<?php the_permalink(); ?>">Learn more</a> -->
						<a class="secondary" href="<?php echo $live_link['url']; ?>" target="<?php echo $live_link['target']; ?>"><?php echo $live_link['title']; ?></a>
          </div>
					<?php endif; ?>

					<!-- <section class="entry-content">
						<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
						<?php wp_link_pages( array(
							'before' => '<div class="page-link"> Pages:',
							'after' => '</div>'
						)); ?>
					</section>.entry-content -->


				</li><!-- #post-## -->
			<?php endwhile; // End the loop. Whew. ?>
			</ul>

<!-- end of the stream container which was opened in archive.php -->
		</div>
<!-- end of the flex container that opened in archive.php -->
	</div>	
<!-- end of the home-stream-block section that opened in archive.php -->
</section>

<?php // Display navigation to next/previous pages when applicable ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
  <p class="alignleft"><?php next_posts_link('&laquo; Older Entries'); ?></p>
  <p class="alignright"><?php previous_posts_link('Newer Entries &raquo;'); ?></p>
<?php endif; ?>
