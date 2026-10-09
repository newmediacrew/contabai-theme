<?php
$heroImage   = (string) ($args['image'] ?? '');
$heroTitle   = (string) ($args['title'] ?? '');
$heroTag     = ($args['tag'] ?? 'h1') === 'p' ? 'p' : 'h1';
$heroAttr    = (string) ($args['title_attr'] ?? '');
$heroEyebrow = (string) ($args['eyebrow'] ?? '');
$heroSub     = (string) ($args['subtitle'] ?? '');
$heroCrumbs  = (string) ($args['crumbs'] ?? '');
$heroSize    = ($args['size'] ?? '') === 'xl' ? ' is-xl' : '';
?>
<section class="contabai-photo-hero">
    <?php if ($heroImage !== '') : ?>
        <img src="<?php echo esc_url($heroImage); ?>" alt="" fetchpriority="high" decoding="async" class="contabai-photo-hero-img" />
    <?php endif; ?>
    <div class="contabai-photo-hero-inner mx-auto w-full max-w-7xl px-4">
        <?php echo $heroCrumbs; ?>
        <?php if ($heroEyebrow !== '') : ?>
            <p class="contabai-photo-hero-eyebrow"><?php echo esc_html($heroEyebrow); ?></p>
        <?php endif; ?>
        <<?php echo $heroTag; ?> class="contabai-photo-hero-title<?php echo $heroSize; ?>"<?php echo $heroAttr; ?>><?php echo esc_html($heroTitle); ?></<?php echo $heroTag; ?>>
        <?php if ($heroSub !== '') : ?>
            <div class="contabai-photo-hero-sub"><?php echo wp_kses_post($heroSub); ?></div>
        <?php endif; ?>
    </div>
</section>
