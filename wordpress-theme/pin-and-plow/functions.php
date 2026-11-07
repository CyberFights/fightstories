<?php
/** Theme setup and WooCommerce integration. @package PinAndPlow */
if (!defined('ABSPATH')) {
    exit;
}

function pin_plow_setup() {
    load_theme_textdomain('pin-and-plow', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    register_nav_menus(array('primary' => __('Header navigation', 'pin-and-plow')));
}
add_action('after_setup_theme', 'pin_plow_setup');

function pin_plow_body_class($classes) {
    $classes[] = is_front_page() ? 'pin-plow-front' : 'pin-plow-inner';
    return $classes;
}
add_filter('body_class', 'pin_plow_body_class');

function pin_plow_assets() {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('pin-plow-fonts', $uri . '/assets/fonts.css', array(), filemtime($dir . '/assets/fonts.css'));
    wp_enqueue_style('pin-plow-site', $uri . '/assets/site.css', array('pin-plow-fonts'), filemtime($dir . '/assets/site.css'));
    wp_enqueue_style('pin-plow-wordpress', $uri . '/assets/wp.css', array('pin-plow-site'), filemtime($dir . '/assets/wp.css'));
    if (pin_plow_has_woocommerce()) {
        wp_enqueue_style('pin-plow-commerce', $uri . '/assets/commerce.css', array('pin-plow-wordpress'), filemtime($dir . '/assets/commerce.css'));
    }
    wp_enqueue_script('pin-plow-interactions', $uri . '/assets/theme.js', array(), filemtime($dir . '/assets/theme.js'), true);
}
add_action('wp_enqueue_scripts', 'pin_plow_assets', 20);

function pin_plow_has_woocommerce() {
    return class_exists('WooCommerce') && function_exists('wc_get_product');
}

/** A customer account is required for checkout, including block checkout. */
function pin_plow_no_guest_checkout() {
    return 'no';
}
function pin_plow_allow_account_creation() {
    return 'yes';
}
add_filter('pre_option_woocommerce_enable_guest_checkout', 'pin_plow_no_guest_checkout');
add_filter('pre_option_woocommerce_enable_signup_and_login_from_checkout', 'pin_plow_allow_account_creation');
add_filter('pre_option_woocommerce_enable_myaccount_registration', 'pin_plow_allow_account_creation');
add_filter('woocommerce_checkout_registration_required', '__return_true');
add_filter('woocommerce_checkout_registration_enabled', '__return_true');

/** Link to a section on the front page from any URL. */
function pin_plow_section_url($section) {
    return home_url('/#' . $section);
}

function pin_plow_shop_url() {
    if (pin_plow_has_woocommerce()) {
        $url = wc_get_page_permalink('shop');
        if ($url) {
            return $url;
        }
    }
    return pin_plow_section_url('shop');
}

function pin_plow_account_url() {
    if (pin_plow_has_woocommerce()) {
        $url = wc_get_page_permalink('myaccount');
        if ($url) {
            return $url;
        }
    }
    return pin_plow_section_url('membership');
}

function pin_plow_downloads_url() {
    if (pin_plow_has_woocommerce()) {
        return wc_get_account_endpoint_url('downloads');
    }
    return pin_plow_section_url('membership');
}

/** Default menu; a WordPress menu assigned to Header navigation overrides it. */
function pin_plow_default_menu() {
    $items = array(
        array(pin_plow_shop_url(), __('SHOP', 'pin-and-plow')),
        array(pin_plow_account_url(), __('MEMBERSHIP', 'pin-and-plow')),
        array(pin_plow_section_url('about'), __('ABOUT', 'pin-and-plow')),
        array(pin_plow_section_url('contact'), __('CONTACT', 'pin-and-plow')),
    );
    echo '<ul class="nav-list">';
    foreach ($items as $item) {
        echo '<li><a href="' . esc_url($item[0]) . '">' . esc_html($item[1]) . '</a></li>';
    }
    echo '</ul>';
}

/** Show only published, catalog-visible simple products with downloadable files. */
function pin_plow_pdf_products($limit = 3) {
    if (!pin_plow_has_woocommerce()) {
        return array();
    }
    $ids = get_posts(array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => max(12, $limit * 4),
        'fields'         => 'ids',
        'meta_query'     => array(array('key' => '_downloadable', 'value' => 'yes')),
        'tax_query'      => array(
            'relation' => 'AND',
            array('taxonomy' => 'product_type', 'field' => 'slug', 'terms' => 'simple'),
            array('taxonomy' => 'product_visibility', 'field' => 'name', 'terms' => array('exclude-from-catalog'), 'operator' => 'NOT IN'),
        ),
    ));
    $products = array();
    foreach ($ids as $id) {
        $product = wc_get_product($id);
        if ($product && $product->is_downloadable() && $product->get_downloads() && $product->is_visible()) {
            $products[] = $product;
            if (count($products) >= $limit) {
                break;
            }
        }
    }
    return $products;
}

/** Keep the main shop focused on downloadable stories, not physical products. */
function pin_plow_catalog_downloads_only($query) {
    if (is_admin()) {
        return;
    }
    $meta_query = $query->get('meta_query');
    $meta_query = is_array($meta_query) ? $meta_query : array();
    $meta_query[] = array('key' => '_downloadable', 'value' => 'yes');
    $query->set('meta_query', $meta_query);
}
add_action('woocommerce_product_query', 'pin_plow_catalog_downloads_only');

/** Split a product title across two card lines without allowing product HTML. */
function pin_plow_card_title($title) {
    $words = preg_split('/\s+/u', trim($title)) ?: array($title);
    if (count($words) < 2) {
        return esc_html($title);
    }
    $middle = (int) ceil(count($words) / 2);
    return esc_html(implode(' ', array_slice($words, 0, $middle))) . '<br />' . esc_html(implode(' ', array_slice($words, $middle)));
}

/** Explain the dependency to the owner; never expose a fake checkout to visitors. */
function pin_plow_woocommerce_notice() {
    if (!current_user_can('activate_plugins') || pin_plow_has_woocommerce()) {
        return;
    }
    echo '<div class="notice notice-warning"><p>' . esc_html__('Pin & Plow Press needs WooCommerce for member accounts, PDF purchases, secure downloads, and payments. Install and activate WooCommerce to open the shop.', 'pin-and-plow') . '</p></div>';
}
add_action('admin_notices', 'pin_plow_woocommerce_notice');

function pin_plow_customize($customizer) {
    $customizer->add_section('pin_plow_home', array(
        'title'    => __('Pin & Plow front page', 'pin-and-plow'),
        'priority' => 30,
    ));
    $settings = array(
        'pin_plow_intro' => array(
            'label'   => __('Hero description', 'pin-and-plow'),
            'default' => 'Short, hard-hitting stories from the ropes, the locker room, and the long walk home.',
            'type'    => 'textarea',
        ),
        'pin_plow_about' => array(
            'label'   => __('About text', 'pin-and-plow'),
            'default' => 'Pin & Plow Press makes room for the stories behind the fight: the work, the waiting, and everything that follows the final bell. Short fiction with a long reach.',
            'type'    => 'textarea',
        ),
        'pin_plow_email' => array(
            'label'   => __('Contact email', 'pin-and-plow'),
            'default' => 'hello@pinandplow.press',
            'type'    => 'email',
        ),
    );
    foreach ($settings as $id => $setting) {
        $customizer->add_setting($id, array(
            'default'           => $setting['default'],
            'sanitize_callback' => $setting['type'] === 'email' ? 'sanitize_email' : 'sanitize_textarea_field',
        ));
        $customizer->add_control($id, array(
            'label'   => $setting['label'],
            'section' => 'pin_plow_home',
            'type'    => $setting['type'],
        ));
    }
}
add_action('customize_register', 'pin_plow_customize');
