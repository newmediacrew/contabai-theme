<?php

use ContabaiTheme\Heroicon;

$bandImage = get_theme_file_uri('assets/img/hero/holiday-028.webp');
?>
<section class="contabai-wave-both relative isolate overflow-hidden">
    <img src="<?php echo esc_url($bandImage); ?>" alt="" width="1920" height="1280" loading="lazy" decoding="async" class="absolute inset-0 -z-10 h-full w-full object-cover" />
    <div class="contabai-band-overlay absolute inset-0 -z-10"></div>
    <div class="contabai-reveal mx-auto max-w-7xl px-4 py-28 sm:py-40">
        <div class="max-w-xl">
            <p class="contabai-eyebrow-on-dark text-sm font-semibold uppercase tracking-wide"><?php echo esc_html__('Golden hour, your own pool', 'contabai-theme'); ?></p>
            <h2 class="contabai-heading mt-3 text-4xl text-white sm:text-5xl"><?php echo esc_html__('Nobody in between you and the view.', 'contabai-theme'); ?></h2>
            <p class="contabai-body mt-5 text-base text-white/85 sm:text-lg"><?php echo esc_html__('You talk to the owner, agree the details and pay them directly. The price you see is the price the host sets.', 'contabai-theme'); ?></p>
            <a href="#how-it-works" class="mt-8 inline-flex items-center gap-2 rounded-full border border-white/70 px-6 py-3 text-sm font-semibold text-white no-underline transition hover:bg-white/10"><?php echo esc_html__('How direct booking works', 'contabai-theme'); ?><?php echo Heroicon::solid('arrow-down', 'w-4 h-4'); ?></a>
        </div>
    </div>
</section>
