<?php use ContabaiTheme\Heroicon; ?>
<?php set_query_var('contabai_overlay_header', true); ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php $categories = get_the_category(); ?>
    <article itemscope itemtype="https://schema.org/Article">
        <?php ob_start(); ?>
        <?php if (get_option('theme_breadcrumbs_enabled', '1') === '1') : ?>
        <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"
             class="no-scrollbar mb-6 flex items-center gap-1 overflow-x-auto text-sm text-neutral-500">
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
                <a href="<?php echo esc_url(home_url()); ?>" itemprop="item" title="<?php esc_attr_e('Home', 'contabai-theme'); ?>" class="inline-flex items-center py-1 no-underline transition hover:text-neutral-900"><?php echo Heroicon::outline('home', 'w-4 h-4'); ?><span itemprop="name" class="sr-only"><?php esc_html_e('Home', 'contabai-theme'); ?></span></a>
                <meta itemprop="position" content="1">
            </span>
            <?php if (! empty($categories)) :
                $category = $categories[0]; ?>
                <?php echo Heroicon::outline('chevron-right', 'w-4 h-4 flex-none text-neutral-400'); ?>
                <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" itemprop="item" class="inline-flex items-center whitespace-nowrap py-1 no-underline transition hover:text-neutral-900"><span itemprop="name"><?php echo esc_html($category->name); ?></span></a>
                    <meta itemprop="position" content="2">
                </span>
            <?php endif; ?>
            <?php echo Heroicon::outline('chevron-right', 'w-4 h-4 flex-none text-neutral-400'); ?>
            <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
                <span itemprop="name" class="inline-flex items-center whitespace-nowrap py-1 font-medium text-neutral-600"><?php the_title(); ?></span>
                <meta itemprop="position" content="<?php echo ! empty($categories) ? '3' : '2'; ?>">
            </span>
        </nav>
        <?php endif; ?>
        <?php
        $crumbs = (string) ob_get_clean();
        get_template_part('template-parts/photo-hero', null, [
            'image'      => \ContabaiTheme\PhotoHero::image(get_the_ID()),
            'alt'        => \ContabaiTheme\PhotoHero::alt(get_the_ID()),
            'title'      => get_the_title(),
            'title_attr' => ' itemprop="headline"',
            'eyebrow'    => implode(' · ', array_filter([! empty($categories) ? $categories[0]->name : '', get_the_date()])),
            'crumbs'     => $crumbs,
        ]);
        ?>
        <div class="mx-auto max-w-7xl px-4 py-10">
            <div class="entry-content" itemprop="articleBody"><?php the_content(); ?></div>

            <?php if (! empty($categories)) : ?>
                <footer class="mt-10 border-t border-neutral-200 pt-6">
                    <div class="flex flex-wrap items-center gap-2">
                        <?php foreach ($categories as $cat) :
                            $badge_tag = 'a';
                            $badge_variant = 'bg-neutral-100 text-neutral-700 hover:bg-neutral-200';
                            $badge_extra = 'no-underline transition';
                            $badge_attrs = 'href="' . esc_url(get_category_link($cat->term_id)) . '"';
                            $badge_body = esc_html($cat->name);
                            include get_template_directory() . '/template-parts/badge.php';
                        endforeach; ?>
                    </div>
                </footer>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>
<?php get_footer(); ?>
