<?php

use ContabaiTheme\Heroicon;
?>
<div x-data="{ slideOverOpen: false }" class="lg:hidden">
    <button x-on:click="slideOverOpen = true" title="<?php esc_attr_e('Menu', 'contabai-theme'); ?>" aria-label="<?php esc_attr_e('Menu', 'contabai-theme'); ?>"
            class="contabai-header-icon inline-flex h-9 w-9 items-center justify-center rounded-full text-neutral-700 transition hover:bg-neutral-100">
        <?php echo Heroicon::solid('bars-3', 'w-4 h-4'); ?>
    </button>
    <template x-teleport="body">
        <div x-on:keydown.escape.window="slideOverOpen = false" class="relative z-[60]">
            <!-- backdrop -->
            <div x-show="slideOverOpen" x-cloak x-on:click="slideOverOpen = false"
                 x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-black/10"></div>
            <!-- panel -->
            <div id="mobile-menu" x-show="slideOverOpen" x-cloak
                 x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition-transform ease-in duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                 class="fixed right-0 top-0 z-10 flex h-full w-80 max-w-[85%] flex-col bg-white">
                <?php
                $mmName   = get_option('theme_site_name', '') !== '' ? (string) get_option('theme_site_name', '') : get_bloginfo('name');
                $mmPayoff = (string) get_option('theme_payoff', '');
                $mmLogo   = (string) get_option('theme_logo', '');
                ?>
                <div class="flex items-center justify-between border-b border-neutral-200 px-4 py-4">
                    <a href="<?php echo esc_url(home_url()); ?>" class="flex min-w-0 items-center gap-2 no-underline">
                        <?php if ($mmLogo !== '') : ?>
                            <img src="<?php echo esc_url($mmLogo); ?>" alt="<?php echo esc_attr($mmName); ?>" class="header-logo w-auto shrink-0 object-contain">
                        <?php else : ?>
                            <svg viewBox="0 0 48 48" fill="none" class="header-logo-mark shrink-0" role="img" aria-label="<?php echo esc_attr($mmName); ?>">
                                <path d="M10 37V14l14 12 14-12v23" stroke="currentColor" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <?php endif; ?>
                        <span class="flex min-w-0 flex-col leading-tight">
                            <span class="truncate text-lg font-bold text-neutral-900"><?php echo esc_html($mmName); ?></span>
                            <?php if ($mmPayoff !== '') : ?>
                                <span class="truncate text-xs font-normal text-neutral-500"><?php echo esc_html($mmPayoff); ?></span>
                            <?php endif; ?>
                        </span>
                    </a>
                    <button x-on:click="slideOverOpen = false" aria-label="<?php esc_attr_e('Close', 'contabai-theme'); ?>"
                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-neutral-500 transition hover:bg-neutral-100">
                        <?php echo Heroicon::outline('x-mark', 'w-4 h-4'); ?>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto p-4">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header_navigation',
                        'container'      => false,
                        'depth'          => 2,
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul class="space-y-1 list-none m-0 p-0">%3$s</ul>',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </template>
</div>
