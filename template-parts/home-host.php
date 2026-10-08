<?php

use ContabaiTheme\Heroicon;

$hostImage = get_template_directory_uri() . '/assets/img/host.webp';
$ctaLabel  = trim((string) get_option('theme_cta_label', '')) !== '' ? (string) get_option('theme_cta_label', '') : __('Become a host', 'contabai-theme');
$ctaUrl    = trim((string) get_option('theme_cta_url', '')) !== '' ? (string) get_option('theme_cta_url', '') : home_url('/');
?>
<section class="mx-auto w-full max-w-7xl px-4 py-16 sm:py-20">
    <div class="relative isolate overflow-hidden rounded-3xl">
        <img src="<?php echo esc_url($hostImage); ?>" alt="" width="1920" height="760" loading="lazy" decoding="async" class="absolute inset-0 -z-10 h-full w-full object-cover" />
        <div class="contabai-host-overlay absolute inset-0 -z-10"></div>
        <div class="max-w-xl px-6 py-16 sm:px-12 sm:py-20">
            <p class="text-sm font-semibold uppercase tracking-wide text-white/80"><?php echo esc_html__('Own a place?', 'contabai-theme'); ?></p>
            <h2 class="contabai-heading mt-2 text-3xl text-white sm:text-4xl"><?php echo esc_html__('List it on Mitabon — keep what you earn', 'contabai-theme'); ?></h2>
            <p class="contabai-body mt-4 text-base text-white/85"><?php echo esc_html__('Reach travellers worldwide and book them direct. No commission on the stay, no middleman between you and your guests — you set the price and keep what you earn.', 'contabai-theme'); ?></p>
            <a href="<?php echo esc_url($ctaUrl); ?>" class="contabai-accent-bg mt-7 inline-flex items-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold text-white no-underline shadow-sm transition hover:opacity-90"><?php echo esc_html($ctaLabel); ?><?php echo Heroicon::solid('arrow-right', 'w-4 h-4'); ?></a>
        </div>
    </div>
</section>
