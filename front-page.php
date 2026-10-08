<?php get_header(); ?>

<?php if (get_option('theme_hero_enabled', '1') === '1') : ?>
    <?php get_template_part('template-parts/hero'); ?>
<?php else : ?>
    <?php $tagline = get_bloginfo('description'); ?>
    <section class="mx-auto w-full max-w-7xl px-4 pb-6 pt-10 sm:pb-10 sm:pt-16">
        <h1 class="contabai-heading mx-auto max-w-3xl text-center text-3xl text-[color:var(--heading-color,#111827)] sm:text-5xl"><?php echo esc_html(get_bloginfo('name')); ?></h1>
        <?php if ($tagline !== ''): ?>
            <p class="contabai-body mx-auto mt-4 max-w-2xl text-center text-base text-[color:var(--content-text-color,#374151)] sm:text-lg"><?php echo esc_html($tagline); ?></p>
        <?php endif; ?>
        <?php if (shortcode_exists('contabai_search')): ?>
            <div class="mt-8 sm:mt-10"><?php echo do_shortcode('[contabai_search]'); ?></div>
        <?php endif; ?>
    </section>
<?php endif; ?>

<?php get_template_part('template-parts/home-islands'); ?>

<?php get_template_part('template-parts/home-band'); ?>

<?php get_template_part('template-parts/home-featured'); ?>

<?php get_template_part('template-parts/home-howitworks'); ?>

<?php get_template_part('template-parts/home-why'); ?>

<?php get_template_part('template-parts/home-host'); ?>

<script>
(function () {
    if (! ('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) { return; }
    const items = document.querySelectorAll('.contabai-reveal');
    document.documentElement.classList.add('contabai-reveal-on');
    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); }
        });
    }, { rootMargin: '0px 0px -8% 0px' });
    items.forEach(function (item) { observer.observe(item); });
})();
</script>

<?php get_footer(); ?>
