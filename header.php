<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

  <?php wp_head(); ?>
</head>

<?php
$bg_img = get_field('body_background_image', 'options'); 
$bg_img_arc = get_field('body_background_image_archive', 'options'); 
?>

<style>
  body.home {
    background-image:url('<?php echo $bg_img['url']; ?>');
  }
  body.archive {
    background-image:url('<?php echo $bg_img_arc['url']; ?>');
  }
</style>

<body <?php body_class(); ?>>
<div class="overlay"></div>
<!-- the marquee -->
<?php if(have_rows('scroll_repeater', 'options')) : ?>
  <div class="marquee">
    <ul aria-hidden="true">
      <?php while(have_rows('scroll_repeater', 'options')) : the_row(); 
        $item = get_sub_field('marquee_item');
      ?>
      <li><?php echo $item; ?></li>
      <?php endwhile; ?>
    </ul>
    <ul>
      <?php while(have_rows('scroll_repeater', 'options')) : the_row(); 
        $item = get_sub_field('marquee_item');
      ?>
      <li><?php echo $item; ?></li>
      <?php endwhile; ?>
    </ul>
</div>
  <?php endif; ?>
  <!-- end of marquee -->
 <!-- <a href="#maincontent" class="skiplink">Go to Main Content</a> -->

<header class="wrapper">
  <div class="main-nav">
    <div class="wrapper flex">
      <button class="menu-button">
        <span></span>
        <span></span>
        <span></span>
        <span class="visuallyhidden">Menu</span>
      </button>
      <?php wp_nav_menu( array(
        'theme_location' => 'primary',
        'container_class' => 'menu'
      )); ?>
    </div>
  </div>
</header>


<main class="wrapper" id="maincontent">
