<?php set_query_var('contabai_overlay_header', true); ?>
<?php get_header(); ?>
<?php
get_template_part('template-parts/photo-hero', null, [
    'image'    => \ContabaiTheme\PhotoHero::image(0),
    'title'    => __('404 Oops', 'contabai-theme'),
    'subtitle' => esc_html__('Page not found.', 'contabai-theme'),
]);
?>
<div class="mx-auto flex max-w-lg flex-col items-center px-4 py-12 text-center">
    <a href="<?php echo esc_url(home_url()); ?>"
       class="contabai-accent-bg inline-flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-medium text-white no-underline transition hover:opacity-90"><?php esc_html_e('Back to home', 'contabai-theme'); ?></a>
</div>
<?php get_footer(); ?>
