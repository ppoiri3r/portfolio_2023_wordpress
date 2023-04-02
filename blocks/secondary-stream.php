<?php 
global $post; 
$post_id = $post->ID; 
?>
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
        $live_link = get_field('live_site', $post_id);
      ?>
        <li>
          <h2><?php echo $overview_title ?></h2>
          <div class="feature__works stream">
            <p class="content-container">
            <?php echo $overview_content; ?>
            </p>
            <a class="secondary" target="<?php $live_link['target']; ?> "href="<?php echo $live_link['url']; ?>"><?php echo $live_link['title']; ?></a>
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
          $single_feature_link = get_sub_field('single_feature_link');
          // $single_feat_link_url = $single_feature_link['url'];
          // $single_feat_link_title = $single_feature_link['title'];
          // $single_feat_link_target = $single_feature_link['target'];
          // var_dump($single_feature_link);
          echo '<li><h3>'.$single_feature_title.'</h3>';
          echo '<p>'. $single_feature_descrip .'</p>';
          if($single_feature_link) {
            echo '<a class="secondary" href="'.$single_feature_link['url'].'" target="'.$single_feature_link['target'].'">'.$single_feature_link['title'].'</a></li>';
          }
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