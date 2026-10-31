<?php

use ContabaiTheme\Heroicon;

$mmName       = get_option('theme_site_name', '') !== '' ? (string) get_option('theme_site_name', '') : get_bloginfo('name');
$mmPayoff     = (string) get_option('theme_payoff', '');
$mmLogo       = (string) get_option('theme_logo', '');
$mmCtaShow    = ! empty($args['ctaShow']);
$mmCtaLabel   = (string) ($args['ctaLabel'] ?? '');
$mmCtaUrl     = (string) ($args['ctaUrl'] ?? '');
$mmAccountUrl = (string) ($args['accountUrl'] ?? home_url('/'));
$mmPhotos     = glob(get_theme_file_path('assets/img/hero/holiday-*.webp')) ?: [];
$mmPhoto      = $mmPhotos !== [] ? get_theme_file_uri('assets/img/hero/' . basename($mmPhotos[array_rand($mmPhotos)])) : '';
?>
<div x-data="{ slideOverOpen: false }" class="lg:hidden">
    <button x-on:click="slideOverOpen = true" title="<?php esc_attr_e('Menu', 'contabai-theme'); ?>" aria-label="<?php esc_attr_e('Menu', 'contabai-theme'); ?>"
            class="contabai-header-icon inline-flex h-9 w-9 items-center justify-center rounded-full text-neutral-700 transition hover:bg-neutral-100">
        <?php echo Heroicon::solid('bars-3', 'w-4 h-4'); ?>
    </button>
    <template x-teleport="body">
        <div id="mobile-menu" x-show="slideOverOpen" x-cloak role="dialog" aria-modal="true" aria-label="<?php esc_attr_e('Menu', 'contabai-theme'); ?>"
             x-on:keydown.escape.window="slideOverOpen = false"
             x-effect="document.body.style.overflow = slideOverOpen ? 'hidden' : ''"
             x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[60] overflow-hidden bg-[#16232e] text-white lg:hidden">
            <?php if ($mmPhoto !== '') : ?>
                <img src="<?php echo esc_url($mmPhoto); ?>" alt="" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full scale-105 object-cover">
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-b from-[#0f171e]/55 via-[#0f171e]/75 to-[#0f171e]/90"></div>

            <div class="relative flex h-full flex-col px-5 pb-7 pt-4">
                <div class="flex items-center justify-between gap-4">
                    <a href="<?php echo esc_url(home_url()); ?>" class="flex min-w-0 items-center gap-2 text-white no-underline">
                        <?php if ($mmLogo !== '') : ?>
                            <img src="<?php echo esc_url($mmLogo); ?>" alt="<?php echo esc_attr($mmName); ?>" class="header-logo w-auto shrink-0 object-contain">
                        <?php else : ?>
                            <svg viewBox="0 0 48 48" fill="none" class="h-9 w-9 shrink-0" role="img" aria-label="<?php echo esc_attr($mmName); ?>">
                                <path d="M9 40V18C9 9 20 8.5 24 21C28 8.5 39 9 39 18V40" stroke="currentColor" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="24" cy="33" r="4" fill="currentColor"/>
                            </svg>
                        <?php endif; ?>
                        <span class="contabai-display truncate text-[22px] font-semibold"><?php echo esc_html($mmName); ?></span>
                    </a>
                    <button x-on:click="slideOverOpen = false" aria-label="<?php esc_attr_e('Close', 'contabai-theme'); ?>"
                            class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/35 bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                        <?php echo Heroicon::outline('x-mark', 'w-5 h-5'); ?>
                    </button>
                </div>

                <div class="mt-9 min-h-0 flex-1 overflow-y-auto">
                    <?php if ($mmPayoff !== '') : ?>
                        <p class="contabai-hero-eyebrow mb-2"><?php echo esc_html($mmPayoff); ?></p>
                    <?php endif; ?>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header_navigation',
                        'container'      => false,
                        'depth'          => 2,
                        'fallback_cb'    => false,
                        'walker'         => new \ContabaiTheme\MobileMenuWalker(),
                        'items_wrap'     => '<ul class="m-0 flex list-none flex-col p-0">%3$s</ul>',
                    ]);
                    ?>
                </div>

                <div class="mt-6 flex flex-col gap-2.5">
                    <?php if ($mmCtaShow) : ?>
                        <a href="<?php echo esc_url($mmCtaUrl); ?>" class="contabai-accent-bg inline-flex h-13 items-center justify-center gap-2 rounded-full text-base font-semibold text-white no-underline transition hover:opacity-90">
                            <?php echo Heroicon::solid('plus', 'w-5 h-5'); ?><?php echo esc_html($mmCtaLabel); ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($mmAccountUrl); ?>" class="inline-flex h-13 items-center justify-center gap-2 rounded-full border border-white/45 bg-white/10 text-base font-semibold text-white no-underline backdrop-blur-sm transition hover:bg-white/20">
                        <?php echo Heroicon::solid('user-circle', 'w-5 h-5'); ?><?php esc_html_e('My hub', 'contabai-theme'); ?>
                    </a>
                </div>
            </div>
        </div>
    </template>
</div>
