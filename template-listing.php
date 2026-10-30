<?php
/* Template Name: Listing (no breadcrumb) */

$isListingDetail = (bool) get_query_var('contabai_listing_id');
$overlay = ! $isListingDetail;
if ($isListingDetail && class_exists('Contabai\\Controllers\\ListingController')) {
    [$listingData] = \Contabai\Controllers\ListingController::get((int) get_query_var('contabai_listing_id'));
    $listingForHeader = $listingData['data']['listing'] ?? null;
    $overlay = $listingForHeader && ! empty($listingForHeader['photos']) && \Contabai\Controllers\ListingController::hostAllows($listingForHeader);
}
if ($overlay) {
    set_query_var('contabai_overlay_header', true);
}
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php if ($isListingDetail) : ?>
        <?php the_content(); ?>
    <?php else : ?>
        <?php
        $placeTitle = method_exists('Contabai\\Controllers\\ShortCodes', 'place_title') ? \Contabai\Controllers\ShortCodes::place_title() : null;
        get_template_part('template-parts/photo-hero', null, [
            'image'   => \ContabaiTheme\PhotoHero::image(get_the_ID()),
            'title'   => $placeTitle ?? get_the_title(),
            'crumbs'  => $placeTitle !== null ? \Contabai\View::render('components.breadcrumb', ['crumbs' => [['label' => __('Home', 'contabai-theme'), 'url' => home_url('/')], ['label' => $placeTitle, 'url' => null]]]) : '',
            'compact' => true,
        ]);
        ?>
        <div class="contabai-photo-body"><?php the_content(); ?></div>
    <?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
