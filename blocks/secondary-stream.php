<section class="secondary-stream home-stream-block">
  <div class="flex">
    <!-- stream -->
    <?php if(have_rows('streams')): ?>
    <div class="stream-container">
      <ul>
      <?php while(have_rows('streams')): the_row(); 
        $overview_group = get_sub_field('project_overview');
        $overview_title = $overview_group['overview_title'];
        $overview_content = $overview_group['overview_content'];
        $project_features_group = get_sub_field('project_features');
        $features_content = $project_features['features_content'];
      ?>
        <li>
          <h2><?php echo $overview_title ?></h2>
          <div class="feature__works stream">
            <p class="content-container">
            <?php echo $overview_content; ?>
            </p>
          </div>
        </li>
        <li class="features-list-item">
        <?php
        if( have_rows('project_features') ): while ( have_rows('project_features') ) : the_row();
        $features_title = get_sub_field('features_title');
        echo '<h2>'.$features_title.'</h2>';
        echo '<ul class="single-features-list">';
          if( have_rows('features_content') ): while ( have_rows('features_content') ) : the_row();     
          $single_feature_title = get_sub_field('single_feature_title');
          $single_feature_descrip = get_sub_field('single_feature_description');
          echo '<li><h3>'.$single_feature_title.'</h3>';
          echo '<p>'. $single_feature_descrip .'</p></li>';
          endwhile; endif;
        endwhile; endif;
        echo '</ul>';
        ?>
        </li>
      <?php endwhile; ?>
      </ul>
    </div>
    <?php endif; ?>

  </div>
</section>