<?php

use ContabaiTheme\Heroicon;

$heroEyebrow = (string) get_option('theme_hero_eyebrow', 'Direct-booking holiday rentals');
$heroHeading = (string) get_option('theme_hero_heading', 'Your place in the sun, booked direct.');
$heroSub     = (string) get_option('theme_hero_subheading', 'Handpicked homes and villas around the world. No booking fees, no middlemen — just you and the host.');

$badgeDefaults = [
    1 => ['text' => 'Book direct with hosts', 'icon' => 'shield-check'],
    2 => ['text' => 'No platform fees', 'icon' => 'banknotes'],
    3 => ['text' => 'Worldwide selection', 'icon' => 'globe-europe-africa'],
];
$badges = [];
for ($i = 1; $i <= 3; $i++) {
    $text = trim((string) get_option('theme_hero_badge' . $i . '_text', $badgeDefaults[$i]['text']));
    if ($text === '') {
        continue;
    }
    $badges[] = ['n' => $i, 'text' => $text, 'icon' => (string) get_option('theme_hero_badge' . $i . '_icon', $badgeDefaults[$i]['icon'])];
}

$heroImages = [];
$files = glob(get_theme_file_path('assets/img/hero/holiday-*.webp')) ?: [];
if ($files !== []) {
    shuffle($files);
    foreach (array_slice($files, 0, 3) as $file) {
        $heroImages[] = get_theme_file_uri('assets/img/hero/' . basename($file));
    }
}

$heroAlign = get_option('theme_hero_align', 'center');
if (! in_array($heroAlign, ['left', 'center', 'right'], true)) {
    $heroAlign = 'center';
}

$heroAnim = get_option('theme_hero_animation', 'zoom-in');
if (! in_array($heroAnim, ['zoom-in', 'zoom-out', 'pan-left', 'pan-right', 'pan-up', 'pan-down', 'diagonal', 'fade', 'breathe', 'static'], true)) {
    $heroAnim = 'zoom-in';
}
?>
<section class="contabai-hero align-<?php echo esc_attr($heroAlign); ?> contabai-hero-anim-<?php echo esc_attr($heroAnim); ?>">
    <div class="contabai-hero-bgs">
        <?php foreach ($heroImages as $idx => $image) : ?>
            <?php if ($idx === 0) : ?>
                <div class="contabai-hero-bg" style="background-image:url('<?php echo esc_url($image); ?>')"></div>
            <?php else : ?>
                <div class="contabai-hero-bg" data-hero-bg="<?php echo esc_url($image); ?>"></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="contabai-hero-overlay"></div>
    <div class="contabai-hero-inner mx-auto w-full max-w-7xl px-4">
        <?php if ($heroEyebrow !== '') : ?>
            <div class="contabai-hero-eyebrow"><?php echo esc_html($heroEyebrow); ?></div>
        <?php endif; ?>
        <?php if ($heroHeading !== '') : ?>
            <h1 class="contabai-hero-title"><?php echo esc_html($heroHeading); ?></h1>
        <?php endif; ?>
        <?php if ($heroSub !== '') : ?>
            <p class="contabai-hero-sub"><?php echo esc_html($heroSub); ?></p>
        <?php endif; ?>
        <?php if ($badges !== []) : ?>
            <div class="contabai-hero-badges">
                <?php foreach ($badges as $badge) : ?>
                    <span class="contabai-hero-badge contabai-hero-badge-<?php echo (int) $badge['n']; ?>"><?php echo Heroicon::solid($badge['icon'], 'w-4 h-4'); ?><?php echo esc_html($badge['text']); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (shortcode_exists('contabai_search')) : ?>
            <div class="contabai-hero-search"><?php echo do_shortcode('[contabai_search]'); ?></div>
        <?php endif; ?>
    </div>
</section>
<script>
(function () {
    const run = function () {
        document.querySelectorAll('.contabai-hero-bg[data-hero-bg]').forEach(function (el) {
            el.style.backgroundImage = "url('" + el.getAttribute('data-hero-bg') + "')";
            el.removeAttribute('data-hero-bg');
        });
    };
    if (document.readyState === 'complete') { run(); } else { window.addEventListener('load', run); }
})();
</script>
