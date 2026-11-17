<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#c7d6bb">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
<header class="kr-header" id="kr-header">
 <a class="kr-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Kriyarth home">
  <?php if(has_custom_logo()) echo wp_get_attachment_image(get_theme_mod('custom_logo'),'full',false,['class'=>'kr-logo__img','alt'=>'Kriyarth']); else echo '<span class="kr-logo__dv" lang="hi">क्रियार्थ</span>'; ?>
 </a>
 <nav class="kr-nav" aria-label="Primary">
  <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'kr-menu','fallback_cb'=>'kr_fallback_menu','depth'=>2]); ?>
 </nav>
 <div class="kr-actions">
  <button class="kr-ib" type="button" data-search aria-label="Search" aria-expanded="false"><?php echo kr_icon('search'); ?></button>
  <a class="kr-ib" href="<?php echo esc_url(kr_url('contact')); ?>" aria-label="Contact"><?php echo kr_icon('mail'); ?></a>
  <button class="kr-ib kr-burger" type="button" data-burger aria-label="Menu" aria-expanded="false"><span></span><span></span></button>
 </div>
 <div class="kr-search" id="kr-search" hidden><?php get_search_form(); ?></div>
</header>
<main id="main">
