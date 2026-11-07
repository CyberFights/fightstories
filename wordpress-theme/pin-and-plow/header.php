<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="theme-color" content="#0d0e0d" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-shell" id="top">
  <header class="site-header">
    <div class="header-inner container">
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Pin and Plow Press, back to home', 'pin-and-plow'); ?>">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/press-badge.png'); ?>" alt="Pin &amp; Plow Press" width="75" height="70" />
        <span class="brand-tagline">FICTION FOR AFTER<br />THE BELL.</span>
      </a>
      <button class="menu-toggle" type="button" aria-label="<?php esc_attr_e('Open navigation', 'pin-and-plow'); ?>" aria-expanded="false" aria-controls="main-nav"><span></span><span></span></button>
      <nav class="main-nav" id="main-nav" aria-label="<?php esc_attr_e('Main navigation', 'pin-and-plow'); ?>">
        <?php
        if (has_nav_menu('primary')) {
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'depth'          => 1,
            ));
        } else {
            pin_plow_default_menu();
        }
        ?>
        <a class="nav-cta" href="<?php echo esc_url(pin_plow_account_url()); ?>"><?php echo is_user_logged_in() ? 'MY CORNER' : 'GET IN THE CORNER'; ?></a>
      </nav>
    </div>
  </header>
