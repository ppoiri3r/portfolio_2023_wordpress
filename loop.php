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
		<?php 
		$term = get_queried_object();
		// var_dump($post);
		if(is_tax() == 'true') {
			echo '<h2>'. $term->name .' '.$post->post_type .' Archive</h2>';
		}
		if($post_type) {
			echo '<h2>'.$post_type.' Archives</h2>';
		}
		?>
		<?php if($post_type): ?>
		<div class="form-container">
			<button id="clear">Clear Filters</button>
			<form action="#" id="filter">
				<fieldset>
					<p>Filter by:</p>
					<?php 
					$terms = get_terms();
					// echo '<input name="type" id="all" value="all" type="radio">';
					// echo '<label for="all">Clear Filters</label>';
					foreach($terms as $t) {
						if($t->taxonomy == 'project-type') {
							echo '<div class="input-container">';
							echo '<input name="type" id="'.$t->slug.'" value="'.$t->term_id.'" type="radio"></>';
							echo '<label for="'.$t->slug.'">'.$t->name.'</label>';
							echo '</div>';
						}
					}
					?>
				</fieldset>
			</form>
		</div>
		<?php endif; ?>
		<div class="feature__works stream">
			<div class="progress container">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<ul>
			<?php while ( have_posts() ) : the_post(); 
			$live_link = get_field('live_site', $post->ID);
			$retired = get_field('retired', $post->ID);
			$screenshots = get_field('show_screenshots', $post->ID);
			$screenshot_cta = get_field('screenshot_cta', $post->ID);
			$featured_cta = get_field('featured_cta', $post->ID);
			if($post_type == 'projects') {
        $project_types = get_the_terms( $post->ID, 'project-type');
				foreach($project_types as $project_type) {
					$name = $project_type->name;
				}
      };
			// var_dump($post_type);
			?>
				<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h3 class="entry-title"><?php the_title(); ?><?php if($name == 'Wordpress'): ?><span><?php get_template_part('template-parts/wordpress-logo'); ?></span><?php endif; ?><?php if($name == 'Shopify'): ?><?php get_template_part('template-parts/shopify-logo'); ?><?php endif; ?>
					</h3>
					<?php if(get_the_excerpt() != null): ?>
						<p class="entry-excerpt">
							<?= get_the_excerpt(); ?>
						</p>
          <?php endif; ?>
					<div class="links">
						<?php if($featured_cta): ?>
							<a class="secondary internal" href="<?php echo the_permalink(); ?>"><?php echo $featured_cta; ?></a>
						<?php endif; ?>
						<?php if($live_link): ?>
							<!-- <a class="secondary internal" href="<?php the_permalink(); ?>">Learn more</a> -->
							<a class="secondary" href="<?php echo $live_link['url']; ?>" target="<?php echo $live_link['target']; ?>"><?php echo $live_link['title']; ?></a>
							<?php endif; ?>
          </div>


				</li><!-- #post-## -->
			<?php endwhile; // End the loop. Whew. ?>
			</ul>

<!-- end of the stream container which was opened in archive.php -->
		</div>
<!-- end of the flex container that opened in archive.php -->
	<!-- </div>	 -->
<!-- end of the home-stream-block section that opened in archive.php -->
<!-- </section> -->

<?php // Display navigation to next/previous pages when applicable ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
  <p class="alignleft"><?php next_posts_link('&laquo; Older Entries'); ?></p>
  <p class="alignright"><?php previous_posts_link('Newer Entries &raquo;'); ?></p>
<?php endif; ?>
