<?php get_header(); ?>
<div class="mx-auto flex min-h-[50vh] max-w-lg flex-col items-center justify-center px-4 py-16 text-center">
    <p class="text-6xl font-bold text-neutral-300">404</p>
    <h1 class="contabai-heading mt-4 text-2xl text-[color:var(--heading-color,#111827)]"><?php esc_html_e('404 Oops', 'contabai-theme'); ?></h1>
    <p class="contabai-body mt-2 text-[color:var(--content-text-color,#374151)]"><?php esc_html_e('Page not found.', 'contabai-theme'); ?></p>
    <a href="<?php echo esc_url(home_url()); ?>"
       class="contabai-accent-bg mt-6 inline-flex items-center gap-2 rounded-md px-5 py-2.5 text-sm font-medium text-white no-underline transition hover:opacity-90"><?php esc_html_e('Back to home', 'contabai-theme'); ?></a>
</div>
<?php get_footer(); ?>
