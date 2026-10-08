<?php use ContabaiTheme\Heroicon; ?>
<?php get_header(); ?>
<div class="mx-auto max-w-7xl px-4 py-10">
    <?php while (have_posts()) : the_post(); ?>
        <?php if (get_option('theme_breadcrumbs_enabled', '1') === '1') : ?>
        <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"
             class="no-scrollbar mb-6 flex items-center gap-1 overflow-x-auto text-sm text-neutral-500">
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
                <a href="<?php echo esc_url(home_url()); ?>" itemprop="item" title="<?php esc_attr_e('Home', 'contabai-theme'); ?>" class="inline-flex items-center py-1 no-underline transition hover:text-neutral-900"><?php echo Heroicon::outline('home', 'w-4 h-4'); ?><span itemprop="name" class="sr-only"><?php esc_html_e('Home', 'contabai-theme'); ?></span></a>
                <meta itemprop="position" content="1">
            </span>
            <?php echo Heroicon::outline('chevron-right', 'w-4 h-4 flex-none text-neutral-400'); ?>
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
                <span itemprop="name" class="inline-flex items-center whitespace-nowrap py-1 font-medium text-neutral-600"><?php the_title(); ?></span>
                <meta itemprop="position" content="2">
            </span>
        </nav>
        <?php endif; ?>
        <div class="entry-content"><?php the_content(); ?></div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>
