<?php
/* Template Name: Location (country / city) */

use Contabai\Controllers\AiSeoRenderer;

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $id        = get_the_ID();
    $generated = class_exists('Contabai\\Controllers\\AiSeoRenderer') && AiSeoRenderer::is_generated($id);
    ?>
    <div class="mx-auto max-w-7xl px-4 pt-8">
        <?php

        $crumbs = [['label' => __('Home', 'contabai-theme'), 'url' => home_url('/')]];
        foreach (array_reverse(get_post_ancestors($id)) as $ancestorId) {
            $crumbs[] = ['label' => get_the_title($ancestorId), 'url' => get_permalink($ancestorId)];
        }
        $crumbs[] = ['label' => get_the_title(), 'url' => null];
        echo \Contabai\View::render('components.breadcrumb', ['crumbs' => $crumbs]);
        ?>

        <?php if (! $generated) : ?>
            <h1 class="contabai-heading text-3xl text-[color:var(--heading-color,#111827)]"><?php echo esc_html(get_the_title()); ?></h1>
            <?php if (has_excerpt()) : ?>
                <div class="entry-content mt-4 max-w-3xl"><?php echo wp_kses_post(get_the_excerpt()); ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if ($generated) : ?>
        <div class="-mt-6"><?php the_content(); ?></div>
        <?php
        echo AiSeoRenderer::content($id);
        echo AiSeoRenderer::related($id);
        echo AiSeoRenderer::jsonld($id);
        ?>
    <?php else : ?>
        <?php the_content(); ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
