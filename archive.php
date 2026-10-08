<?php use ContabaiTheme\Heroicon; ?>
<?php set_query_var('contabai_overlay_header', true); ?>
<?php get_header(); ?>
<?php ob_start(); ?>
    <?php if (get_option('theme_breadcrumbs_enabled', '1') === '1') : ?>
    <nav aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList"
         class="no-scrollbar mb-6 flex items-center gap-1 overflow-x-auto text-sm text-neutral-500">
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
            <a href="<?php echo esc_url(home_url()); ?>" itemprop="item" title="<?php esc_attr_e('Home', 'contabai-theme'); ?>" class="inline-flex items-center py-1 no-underline transition hover:text-neutral-900"><?php echo Heroicon::outline('home', 'w-4 h-4'); ?><span itemprop="name" class="sr-only"><?php esc_html_e('Home', 'contabai-theme'); ?></span></a>
            <meta itemprop="position" content="1">
        </span>
        <?php echo Heroicon::outline('chevron-right', 'w-4 h-4 flex-none text-neutral-400'); ?>
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex flex-none items-center">
            <span itemprop="name" class="inline-flex items-center whitespace-nowrap py-1 font-medium text-neutral-600"><?php single_cat_title(); ?></span>
            <meta itemprop="position" content="2">
        </span>
    </nav>
    <?php endif; ?>
<?php
$crumbs = (string) ob_get_clean();
get_template_part('template-parts/photo-hero', null, [
    'image'    => \ContabaiTheme\PhotoHero::image(0),
    'title'    => single_cat_title('', false),
    'subtitle' => category_description(),
    'crumbs'   => $crumbs,
]);
?>
<div class="mx-auto max-w-7xl px-4 py-10">
    <div>
        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>"
                       class="group flex flex-col overflow-hidden rounded-xl border border-neutral-200 bg-white no-underline transition">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="aspect-[16/10] overflow-hidden bg-neutral-100">
                                <?php the_post_thumbnail('medium', ['class' => 'h-full w-full object-cover transition duration-300 group-hover:scale-105 !rounded-none']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex flex-1 flex-col p-5">
                            <h2 class="contabai-heading text-[color:var(--heading-color,#111827)]"><?php the_title(); ?></h2>
                            <p class="contabai-body mt-2 line-clamp-3 flex-1 text-sm text-[color:var(--content-text-color,#374151)]"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 25)); ?></p>
                            <span class="mt-4 text-xs text-neutral-400"><?php echo esc_html(get_the_date()); ?></span>
                        </div>
                    </a>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>

            <?php
            $paged = max(1, (int) get_query_var('paged'));
            $max = (int) $GLOBALS['wp_query']->max_num_pages;
            if ($max > 1) :
                $total = (int) $GLOBALS['wp_query']->found_posts;
                $perPage = (int) get_query_var('posts_per_page');
                $from = ($paged - 1) * $perPage + 1;
                $to = min($paged * $perPage, $total);
                $delta = 1;
                $range = [];
                for ($i = 1; $i <= $max; $i++) {
                    if ($i == 1 || $i == $max || ($i >= $paged - $delta && $i <= $paged + $delta)) {
                        $range[] = $i;
                    }
                }
            ?>
                <div class="mt-10 flex w-full flex-col items-center gap-3 border-t border-neutral-200 px-3 pt-4 text-sm sm:flex-row sm:justify-between">
                    <p class="contabai-body pl-2 text-[color:var(--content-text-color,#374151)]"><?php printf(esc_html__('Showing %1$s to %2$s of %3$s results', 'contabai-theme'), '<span class="font-medium">' . $from . '</span>', '<span class="font-medium">' . $to . '</span>', '<span class="font-medium">' . $total . '</span>'); ?></p>
                    <nav>
                        <ul class="flex h-9 items-center rounded border border-neutral-200 bg-white leading-tight text-neutral-500">
                            <li class="h-full">
                                <?php if ($paged > 1) : ?>
                                    <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" class="inline-flex h-full items-center rounded-l px-3 no-underline transition hover:bg-[var(--theme-color)] hover:text-white"><?php esc_html_e('Previous', 'contabai-theme'); ?></a>
                                <?php else : ?>
                                    <span class="inline-flex h-full items-center rounded-l px-3 opacity-40"><?php esc_html_e('Previous', 'contabai-theme'); ?></span>
                                <?php endif; ?>
                            </li>
                            <?php $prev = 0; foreach ($range as $i) : ?>
                                <?php if ($i - $prev > 1) : ?>
                                    <li class="hidden h-full md:block"><div class="inline-flex h-full items-center bg-neutral-100 px-2.5">…</div></li>
                                <?php endif; $prev = $i; ?>
                                <li class="hidden h-full md:block">
                                    <?php if ($i == $paged) : ?>
                                        <span class="inline-flex h-full items-center bg-[var(--theme-color)] px-3 text-white"><?php echo $i; ?></span>
                                    <?php else : ?>
                                        <a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="inline-flex h-full items-center px-3 no-underline transition hover:bg-[var(--theme-color)] hover:text-white"><?php echo $i; ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                            <li class="h-full">
                                <?php if ($paged < $max) : ?>
                                    <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" class="inline-flex h-full items-center rounded-r px-3 no-underline transition hover:bg-[var(--theme-color)] hover:text-white"><?php esc_html_e('Next', 'contabai-theme'); ?></a>
                                <?php else : ?>
                                    <span class="inline-flex h-full items-center rounded-r px-3 opacity-40"><?php esc_html_e('Next', 'contabai-theme'); ?></span>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <p class="contabai-body py-16 text-center text-[color:var(--content-text-color,#374151)]"><?php esc_html_e('No posts found in this category.', 'contabai-theme'); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
