<?php

use ContabaiTheme\Heroicon;
use ContabaiTheme\ThemeSettings\ThemeSettings;
use ContabaiTheme\ThemeUpdater;

require __DIR__ . '/vendor/autoload.php';

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('menus');

add_action('after_setup_theme', function () {
    load_theme_textdomain('contabai-theme', get_template_directory() . '/languages');
});

add_action('after_switch_theme', function () {
    foreach ([
        'theme_color_schema'        => '#b51a00',
        'theme_link_color'          => '#b51a00',
        'theme_font_schema'         => 'DM Sans',
        'theme_heading_font'        => 'Playfair Display',
        'theme_heading_weight'      => '500',
        'theme_heading_line_height' => '1.1',
        'theme_heading_color'       => '#1d1a17',
        'theme_body_text_color'     => '#3a332d',
        'theme_bg_type'             => 'color',
        'theme_bg_color'            => '#f7f1e8',
        'theme_cta_enabled'         => '1',
    ] as $option => $value) {
        add_option($option, $value);
    }
});

add_action('init', function () {
    register_nav_menus(['header_navigation' => esc_html__('Header navigation', 'contabai-theme')]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('contabai-theme-css', get_template_directory_uri() . '/assets/css/theme.css', [], '68');
});

add_action('wp_head', function () {
    if (has_site_icon()) {
        return;
    }
    $img = get_template_directory_uri() . '/assets/img';
    $accent = sanitize_hex_color((string) get_option('theme_color_schema', '#ff5400')) ?: '#ff5400';
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none"><path d="M10 37V14l14 12 14-12v23" stroke="' . $accent . '" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    echo '<link rel="icon" type="image/svg+xml" href="data:image/svg+xml,' . rawurlencode($svg) . '">';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($img . '/favicon-32.png') . '">';
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url($img . '/favicon-16.png') . '">';
    echo '<link rel="apple-touch-icon" href="' . esc_url($img . '/apple-touch-icon.png') . '">';
}, 5);

if (class_exists(ThemeSettings::class)) {
    new ThemeSettings();
}

if (class_exists(ThemeUpdater::class)) {
    new ThemeUpdater();
}

add_filter('nav_menu_item_title', function ($title, $item) {
    if (in_array('menu-item-has-children', $item->classes, true)) {
        $title .= Heroicon::outline('chevron-down', 'w-4 h-4');
    }
    return $title;
}, 10, 2);

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    }
    return $title;
});
