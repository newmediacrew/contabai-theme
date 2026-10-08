<?php

use ContabaiTheme\Heroicon;

$listingsPage = get_page_by_path('contabai-listings');
$listingsUrl  = $listingsPage ? get_permalink($listingsPage) : home_url('/contabai-listings/');
?>
<section class="py-16 sm:py-20">
    <div class="contabai-reveal mx-auto max-w-7xl px-4">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="max-w-2xl">
                <p class="contabai-eyebrow text-sm font-semibold uppercase tracking-wide"><?php echo esc_html__('Handpicked', 'contabai-theme'); ?></p>
                <h2 class="contabai-heading mt-2 text-3xl text-[color:var(--heading-color,#111827)] sm:text-4xl"><?php echo esc_html__('Stays worth the trip', 'contabai-theme'); ?></h2>
                <p class="contabai-body mb-[var(--content-paragraph-spacing)] mt-3 text-base text-[color:var(--content-text-color,#374151)]"><?php echo esc_html__('A fresh pick of homes and villas from across the catalogue — every one booked direct with the host.', 'contabai-theme'); ?></p>
            </div>
            <a href="<?php echo esc_url($listingsUrl); ?>" class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap text-sm font-semibold text-[color:var(--content-link-color,#ff5400)] contabai-link transition hover:opacity-80"><?php echo esc_html__('Browse all listings', 'contabai-theme'); ?><?php echo Heroicon::solid('chevron-right', 'w-4 h-4'); ?></a>
        </div>
    </div>
    <?php echo do_shortcode('[contabai_random_listings count="8"]'); ?>
</section>
