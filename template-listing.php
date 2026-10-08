<?php
/* Template Name: Listing (no breadcrumb) */

$isListingDetail = (bool) get_query_var('contabai_listing_id');
if (! $isListingDetail) {
    set_query_var('contabai_overlay_header', true);
}
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php if ($isListingDetail) : ?>
        <?php the_content(); ?>
    <?php else : ?>
        <?php
        get_template_part('template-parts/photo-hero', null, [
            'image' => \ContabaiTheme\PhotoHero::image(get_the_ID()),
            'title' => get_the_title(),
        ]);
        ?>
        <div class="contabai-photo-body"><?php the_content(); ?></div>
    <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
