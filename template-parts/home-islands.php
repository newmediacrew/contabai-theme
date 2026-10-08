<?php

use ContabaiTheme\Heroicon;

$islands = [
    ['name' => __('Aruba', 'contabai-theme'),   'slug' => 'aruba',   'img' => 'aruba.webp'],
    ['name' => __('Curaçao', 'contabai-theme'), 'slug' => 'curacao', 'img' => 'curacao.webp'],
    ['name' => __('Bonaire', 'contabai-theme'), 'slug' => 'bonaire', 'img' => 'bonaire.webp'],
];
?>
<section class="mx-auto w-full max-w-7xl px-4 py-16 sm:py-20">
    <?php $listingsPage = get_page_by_path('contabai-listings'); $listingsUrl = $listingsPage ? get_permalink($listingsPage) : home_url('/contabai-listings/'); ?>
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="max-w-2xl">
            <p class="contabai-eyebrow text-sm font-semibold uppercase tracking-wide"><?php echo esc_html__('Where it all starts', 'contabai-theme'); ?></p>
            <h2 class="contabai-heading mt-2 text-3xl text-[color:var(--heading-color,#111827)] sm:text-4xl"><?php echo esc_html__('Our first islands', 'contabai-theme'); ?></h2>
            <p class="contabai-body mb-[var(--content-paragraph-spacing)] mt-3 text-base text-[color:var(--content-text-color,#374151)]"><?php echo esc_html__('We are starting close to home, in the Dutch Caribbean — and rolling out worldwide from there.', 'contabai-theme'); ?></p>
        </div>
        <a href="<?php echo esc_url($listingsUrl); ?>" class="inline-flex shrink-0 items-center gap-1.5 whitespace-nowrap text-sm font-semibold text-[color:var(--content-link-color,#ff5400)] contabai-link transition hover:opacity-80"><?php echo esc_html__('All destinations', 'contabai-theme'); ?><?php echo Heroicon::solid('chevron-right', 'w-4 h-4'); ?></a>
    </div>
    <div class="mt-10 grid grid-cols-2 gap-4 sm:gap-6 lg:grid-rows-2 lg:h-[36rem]">
        <?php foreach ($islands as $i => $island) :
            $page = get_page_by_path($island['slug']);
            $url  = $page ? get_permalink($page) : home_url('/' . $island['slug'] . '/');
            $big  = ($i === 0);
            $cardClass = $big
                ? 'col-span-2 aspect-[16/10] lg:col-span-1 lg:row-span-2 lg:aspect-auto lg:h-full'
                : 'col-span-1 aspect-[4/3] lg:aspect-auto lg:h-full';
        ?>
            <a href="<?php echo esc_url($url); ?>" class="group relative block overflow-hidden rounded-2xl shadow-sm ring-1 ring-neutral-200 transition hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-[color:var(--theme-color,#ff5400)] <?php echo $cardClass; ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/islands/' . $island['img']); ?>" alt="<?php echo esc_attr($island['name']); ?>" width="1200" height="900" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-2 p-4 sm:p-5">
                    <span class="text-lg font-semibold text-white sm:text-2xl <?php echo $big ? 'lg:text-3xl' : ''; ?>"><?php echo esc_html($island['name']); ?></span>
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur-sm transition group-hover:bg-[color:var(--theme-color,#ff5400)]"><?php echo Heroicon::solid('arrow-right', 'w-5 h-5'); ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="mt-10 rounded-2xl border border-neutral-200 bg-neutral-50 p-6 sm:p-8">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-neutral-900 sm:text-2xl"><?php echo esc_html__('Not on the map yet?', 'contabai-theme'); ?></h3>
                <p class="contabai-body mb-[var(--content-paragraph-spacing)] mt-2 text-base text-[color:var(--content-text-color,#374151)]"><?php echo esc_html__('Are you a host somewhere else? Tell us where you host and we’ll bring direct booking to your corner of the world.', 'contabai-theme'); ?></p>
            </div>
            <form id="mitabon-dest-req" class="flex w-full shrink-0 flex-col gap-3 sm:flex-row sm:flex-wrap lg:w-auto">
                <input type="text" name="country" required autocomplete="country-name" placeholder="<?php esc_attr_e('Country', 'contabai-theme'); ?>" class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 placeholder-neutral-400 focus:border-[color:var(--theme-color,#ff5400)] focus:outline-none focus:ring-1 focus:ring-[color:var(--theme-color,#ff5400)] sm:w-36" />
                <input type="text" name="city" placeholder="<?php esc_attr_e('City', 'contabai-theme'); ?>" class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 placeholder-neutral-400 focus:border-[color:var(--theme-color,#ff5400)] focus:outline-none focus:ring-1 focus:ring-[color:var(--theme-color,#ff5400)] sm:w-36" />
                <input type="text" name="area" placeholder="<?php esc_attr_e('Area', 'contabai-theme'); ?>" class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2.5 text-sm text-neutral-900 placeholder-neutral-400 focus:border-[color:var(--theme-color,#ff5400)] focus:outline-none focus:ring-1 focus:ring-[color:var(--theme-color,#ff5400)] sm:w-36" />
                <div aria-hidden="true" class="absolute -left-[9999px] h-px w-px overflow-hidden">
                    <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off" /></label>
                </div>
                <button type="submit" class="contabai-accent-bg inline-flex shrink-0 items-center justify-center gap-2 whitespace-nowrap rounded-lg px-5 py-2.5 text-sm font-semibold text-white no-underline transition hover:opacity-90"><?php echo esc_html__('Suggest your destination', 'contabai-theme'); ?></button>
            </form>
        </div>
    </div>
</section>
<script>
(function () {
    const form = document.getElementById('mitabon-dest-req');
    if (!form) { return; }

    const labels = {
        subject: <?php echo wp_json_encode(__('New destination request', 'contabai-theme')); ?>,
        intro: <?php echo wp_json_encode(__('I would like to host on Mitabon.', 'contabai-theme')); ?>,
        country: <?php echo wp_json_encode(__('Country', 'contabai-theme')); ?>,
        city: <?php echo wp_json_encode(__('City', 'contabai-theme')); ?>,
        area: <?php echo wp_json_encode(__('Area', 'contabai-theme')); ?>
    };

    const readyAt = Date.now();
    let hasInteracted = false;
    ['input', 'focusin'].forEach(function (eventName) {
        form.addEventListener(eventName, function () { hasInteracted = true; }, { once: true });
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (form.website && form.website.value !== '') { return; }
        if (! hasInteracted || Date.now() - readyAt < 1500) { return; }

        const country = (form.country.value || '').trim();
        const city = (form.city.value || '').trim();
        const area = (form.area.value || '').trim();
        if (! country) { form.country.focus(); return; }

        const subject = labels.subject + ': ' + [area, city, country].filter(Boolean).join(', ');
        const body = labels.intro + '\n\n' + labels.country + ': ' + country + '\n' + labels.city + ': ' + (city || '—') + '\n' + labels.area + ': ' + (area || '—');
        const recipient = atob(<?php echo wp_json_encode(base64_encode('hello@contabai.network')); ?>);
        window.location.href = 'mailto:' + recipient + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
    });
})();
</script>
