<?php

use ContabaiTheme\Heroicon;

$points = [
    ['icon' => 'banknotes',   'title' => __('No platform commission', 'contabai-theme'), 'text' => __('Not a cent is skimmed off your booking.', 'contabai-theme')],
    ['icon' => 'tag',         'title' => __('Fairer prices', 'contabai-theme'),          'text' => __('No middleman markup baked into the nightly rate.', 'contabai-theme')],
    ['icon' => 'home-modern', 'title' => __('Hosts keep more', 'contabai-theme'),         'text' => __('More of what you pay reaches the person hosting you.', 'contabai-theme')],
];
?>
<section class="contabai-why-bg py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-4">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center lg:gap-16">
            <div class="max-w-xl">
                <p class="contabai-eyebrow-on-dark text-sm font-semibold uppercase tracking-wide"><?php echo esc_html__('Why Mitabon', 'contabai-theme'); ?></p>
                <h2 class="contabai-heading mt-2 text-3xl text-white sm:text-4xl"><?php echo esc_html__('Built to cut out the middleman', 'contabai-theme'); ?></h2>
                <div class="contabai-body mt-5 text-base text-neutral-300">
                    <p class="mb-[var(--content-paragraph-spacing)] last:mb-0"><?php echo esc_html__('The big rental platforms take a cut of nearly every booking — often around 15%. That money has to come from somewhere: a higher price for you, and less for the host who actually welcomes you in.', 'contabai-theme'); ?></p>
                    <p class="mb-[var(--content-paragraph-spacing)] last:mb-0"><?php echo esc_html__('We were tired of watching that. So Mitabon works the other way round — you book straight with the host, the money never passes through us, and no platform commission inflates the price. Fair for you, fair for the people who open their doors.', 'contabai-theme'); ?></p>
                </div>
            </div>
            <div class="space-y-4">
                <?php foreach ($points as $point) : ?>
                    <div class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-5">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[color:var(--theme-color,#ff5400)]/15 text-[color:var(--theme-color,#ff5400)]"><?php echo Heroicon::solid($point['icon'], 'w-6 h-6'); ?></div>
                        <div>
                            <h3 class="font-semibold text-white"><?php echo esc_html($point['title']); ?></h3>
                            <p class="mt-1 text-sm leading-relaxed text-neutral-400"><?php echo esc_html($point['text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
