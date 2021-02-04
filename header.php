<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
<link
      href="style/stylesheets/screen.css"
      media="screen, projection"
      rel="stylesheet"
      type="text/css"
    />
</head>

<body <?php body_class(); ?>>
<header>
  <div class="container">
    <div class="logo">
      <!-- <a href="<?php echo bloginfo('url'); ?>"> -->
      <span>   <?php echo bloginfo('name'); ?>  </span>  
      <!-- </a> -->
    </div>
      <?php if (function_exists(clean_custom_menus())) clean_custom_menus(); ?>
  </div>
</header>