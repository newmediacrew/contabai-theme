<?php
/* Template Name: Location (country / city) */

use Contabai\Controllers\AiSeoRenderer;

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $id        = get_the_ID();
    $generated = class_exists('Contabai\\Controllers\\AiSeoRenderer') && AiSeoRenderer::is_generated($id);

    $crumbs = [['label' => __('Home', 'contabai-theme'), 'url' => home_url('/')]];
    foreach (array_reverse(get_post_ancestors($id)) as $ancestorId) {
        $crumbs[] = ['label' => get_the_title($ancestorId), 'url' => get_permalink($ancestorId)];
    }
    $crumbs[] = ['label' => get_the_title(), 'url' => null];

    $heroImage = '';
    foreach (array_merge([$id], get_post_ancestors($id)) as $sourceId) {
        if (has_post_thumbnail($sourceId)) {
            $heroImage = (string) get_the_post_thumbnail_url($sourceId, 'full');
            break;
        }
    }
    if ($heroImage === '') {
        $files = glob(get_theme_file_path('assets/img/hero/holiday-*.webp')) ?: [];
        if ($files !== []) {
            sort($files);
            $heroImage = get_theme_file_uri('assets/img/hero/' . basename($files[$id % count($files)]));
        }
    }
    ?>
    <section class="contabai-dest-hero">
        <?php if ($heroImage !== '') : ?>
            <img src="<?php echo esc_url($heroImage); ?>" alt="" fetchpriority="high" decoding="async" class="contabai-dest-hero-img" />
        <?php endif; ?>
        <div class="contabai-dest-hero-inner mx-auto w-full max-w-7xl px-4">
            <?php echo \Contabai\View::render('components.breadcrumb', ['crumbs' => $crumbs]); ?>
            <?php if ($generated) : ?>
                <p class="contabai-dest-title"><?php echo esc_html(get_the_title()); ?></p>
            <?php else : ?>
                <h1 class="contabai-dest-title"><?php echo esc_html(get_the_title()); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <div class="contabai-dest-sub"><?php echo wp_kses_post(get_the_excerpt()); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
    <div class="contabai-dest-body"><?php the_content(); ?></div>
    <?php if ($generated) : ?>
        <?php
        echo AiSeoRenderer::content($id);
        echo AiSeoRenderer::related($id);
        echo AiSeoRenderer::jsonld($id);
        ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
