  <h1 class="theme-options-title"><?php echo $title; ?></h1>
  <?php if(have_rows('account', 'options')) : ?>
  <div class="flexed-content">
    <aside class="social-contact">
      <ul>
      <?php while(have_rows('account', 'options')) : the_row(); 
      $url = get_sub_field('url');
      $link_label = $url['title'];
      $link_url = $url['url'];
      $link_target = $url['target'];
      $type = get_sub_field('type');
      $show = get_sub_field('show');

      ?>
        <?php if($show): ?>
          <li class="<?php if($link_target == '_blank'):?>external<?php endif; ?>">
            <a target="<?php echo $link_target; ?>" href="<?php echo $link_url; ?>"><?php echo $link_label; ?></a>
          </li>
        <?php endif; ?>
      <?php endwhile; ?>
      </ul>
    </aside>
  <?php endif; ?>
</div>