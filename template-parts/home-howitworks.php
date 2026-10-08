<?php

$steps = [
    ['title' => __('Search & discover', 'contabai-theme'),  'text' => __('Tell us where, when and with how many. Filter by type, price and amenities.', 'contabai-theme')],
    ['title' => __('Message the host', 'contabai-theme'),   'text' => __('Ask anything and agree the details straight with the owner — real answers from the person who knows the place best.', 'contabai-theme')],
    ['title' => __('Book direct', 'contabai-theme'),        'text' => __('Agree the price and pay the host directly — we never touch the money or step into your booking.', 'contabai-theme')],
];
?>
<section id="how-it-works" class="mx-auto w-full max-w-7xl scroll-mt-24 px-4 py-16 sm:py-20">
    <div class="contabai-reveal max-w-2xl">
        <p class="contabai-eyebrow text-sm font-semibold uppercase tracking-wide"><?php echo esc_html__('Simple by design', 'contabai-theme'); ?></p>
        <h2 class="contabai-heading mt-2 text-3xl text-[color:var(--heading-color,#111827)] sm:text-4xl"><?php echo esc_html__('Book in three steps', 'contabai-theme'); ?></h2>
    </div>
    <div class="contabai-reveal mt-12 grid grid-cols-1 gap-8 sm:grid-cols-3 sm:gap-10">
        <?php foreach ($steps as $i => $step) : ?>
            <div class="flex gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[color:var(--theme-color,#ff5400)] text-lg font-bold text-white"><?php echo esc_html((string) ($i + 1)); ?></div>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900"><?php echo esc_html($step['title']); ?></h3>
                    <p class="contabai-body mb-[var(--content-paragraph-spacing)] mt-1.5 text-base text-[color:var(--content-text-color,#374151)]"><?php echo esc_html($step['text']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <p class="contabai-body mb-[var(--content-paragraph-spacing)] mx-auto mt-10 max-w-2xl text-center text-sm text-neutral-500"><?php echo esc_html__('Messaging a host and booking need a free, verified account — a quick sign-up keeps guests and hosts safe.', 'contabai-theme'); ?></p>
</section>
