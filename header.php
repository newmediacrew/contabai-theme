<?php

use ContabaiTheme\Heroicon;

$accountUrl = home_url('/' . (defined('CONTABAI_ACCOUNT_PAGE_SLUG') ? CONTABAI_ACCOUNT_PAGE_SLUG : 'contabai-account'));
$chatUrl    = home_url('/' . (defined('CONTABAI_CHAT_PAGE_SLUG') ? CONTABAI_CHAT_PAGE_SLUG : 'contabai-chat'));

$brandLogo     = (string) get_option('theme_logo', '');
$brandName     = get_option('theme_site_name', '') !== '' ? (string) get_option('theme_site_name', '') : get_bloginfo('name');
$brandPayoff   = (string) get_option('theme_payoff', '');
$brandShowText = get_option('theme_show_brand_text', '1') === '1';
$stickyHeader  = get_option('theme_sticky_header', '1') === '1';

$ctaLabel = (string) get_option('theme_cta_label', '');
$ctaUrl   = (string) get_option('theme_cta_url', '');
$ctaShow  = get_option('theme_cta_enabled', '0') === '1' && $ctaLabel !== '' && $ctaUrl !== '';
?>
<!doctype html>
<html lang="<?php echo esc_attr(substr(get_locale(), 0, 2)); ?>">   
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>
<body class="min-h-screen bg-neutral-50 text-neutral-900 antialiased">

<?php
$topbarColumns = [];
if (get_option('theme_topbar_enabled', '1') === '1') {
    for ($topbarIndex = 1; $topbarIndex <= 4; $topbarIndex++) {
        $topbarTitle = trim((string) get_option('theme_topbar_col' . $topbarIndex . '_title', ''));
        $topbarText = trim((string) get_option('theme_topbar_col' . $topbarIndex . '_text', ''));
        if ($topbarTitle === '' && $topbarText === '') {
            continue;
        }
        $topbarIcon = (string) get_option('theme_topbar_col' . $topbarIndex . '_icon', 'check');
        $topbarColumns[] = [
            'n' => $topbarIndex,
            'title' => $topbarTitle,
            'text' => $topbarText,
            'icon' => $topbarIcon !== '' ? $topbarIcon : 'check',
        ];
    }
}
?>
<?php if ($topbarColumns !== []) : ?>
<div class="contabai-topbar relative h-10 w-full text-sm"
     x-data="{ open: false }" x-on:click.outside="open = false">
    <div class="contabai-topbar-inner topbar-accordion absolute inset-x-0 top-0 z-40 cursor-pointer select-none" x-bind:class="{ 'is-open': open }"
         role="button" tabindex="0" x-bind:aria-expanded="open"
         x-on:click="open = !open" x-on:keydown.enter.prevent="open = !open" x-on:keydown.space.prevent="open = !open">
        <div class="topbar-strip no-scrollbar mx-auto flex max-w-7xl gap-x-2 px-4 text-center md:gap-x-6"
             x-bind:class="open ? 'h-auto flex-wrap items-start justify-center py-3' : 'h-10 flex-nowrap items-center overflow-x-auto'">
            <?php foreach ($topbarColumns as $topbarColumn) : ?>
            <div class="topbar-widget">
                <?php if ($topbarColumn['title'] !== '') : ?>
                <div class="topbar-widget-title"><?php echo Heroicon::solid($topbarColumn['icon'], 'w-4 h-4 flex-none mr-1 contabai-topbar-icon-' . $topbarColumn['n']); ?><?php echo esc_html($topbarColumn['title']); ?></div>
                <?php endif; ?>
                <?php if ($topbarColumn['text'] !== '') : ?>
                <div class="textwidget"><div><?php echo wp_kses_post($topbarColumn['text']); ?></div></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<header class="contabai-header <?php echo $stickyHeader ? 'sticky top-0 ' : ''; ?>z-30 border-b border-neutral-200 bg-white/90 backdrop-blur"
        x-data="{ scrolled: false }" x-on:scroll.window="scrolled = window.scrollY > 12" x-bind:class="scrolled ? 'is-scrolled' : ''">
    <nav class="mx-auto flex min-h-16 max-w-7xl items-center justify-between gap-4 px-4 py-2">
        <!-- Brand -->
        <a href="<?php echo esc_url(home_url()); ?>" class="flex min-w-0 items-center gap-2 no-underline">
            <?php if ($brandLogo !== '') : ?>
                <img src="<?php echo esc_url($brandLogo); ?>" alt="<?php echo esc_attr($brandName); ?>" class="header-logo block w-auto shrink-0 object-contain">
            <?php else : ?>
                <svg viewBox="0 0 48 48" fill="none" class="header-logo-mark block shrink-0" role="img" aria-label="<?php echo esc_attr($brandName); ?>">
                    <path d="M10 37V14l14 12 14-12v23" stroke="currentColor" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            <?php endif; ?>
            <?php if ($brandShowText) : ?>
                <span class="flex min-w-0 flex-col leading-tight">
                    <span class="truncate text-lg font-bold text-neutral-900"><?php echo esc_html($brandName); ?></span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Desktop nav -->
        <div class="desktop-nav hidden lg:block">
            <?php
            wp_nav_menu([
                'theme_location' => 'header_navigation',
                'container'      => false,
                'depth'          => 2,
                'fallback_cb'    => false,
                'walker'         => new \ContabaiTheme\DropdownWalker(),
                'items_wrap'     => '<ul class="flex items-center gap-1 list-none m-0 p-0">%3$s</ul>',
            ]);
            ?>
        </div>

        <!-- Auth button + mobile menu trigger -->
        <div class="flex shrink-0 items-center gap-2">
            <a href="<?php echo esc_url($chatUrl); ?>" title="<?php esc_attr_e('Chats', 'contabai-theme'); ?>" aria-label="<?php esc_attr_e('Chats', 'contabai-theme'); ?>"
               class="relative inline-flex items-center justify-center rounded-md p-2 text-neutral-700 no-underline transition hover:bg-neutral-100">
                <?php echo Heroicon::outline('chat-bubble-left-right', 'w-5 h-5'); ?>
                <span class="js-chat-unread contabai-chat-badge absolute -right-1 -top-1 inline-flex min-w-[1.25rem] items-center justify-center rounded-full px-1.5 py-0.5 text-xs font-semibold leading-none text-white ring-2 ring-white"></span>
            </a>

            <?php if ($ctaShow) : ?>
                <a href="<?php echo esc_url($ctaUrl); ?>" title="<?php echo esc_attr($ctaLabel); ?>" aria-label="<?php echo esc_attr($ctaLabel); ?>"
                   class="contabai-accent-bg inline-flex items-center gap-2 rounded-md border border-transparent px-2.5 py-2 text-sm font-semibold text-white no-underline transition hover:opacity-90 xl:px-4">
                    <?php echo Heroicon::solid('plus', 'w-4 h-4'); ?>
                    <span class="hidden xl:inline"><?php echo esc_html($ctaLabel); ?></span>
                </a>
            <?php endif; ?>

            <a href="<?php echo esc_url($accountUrl); ?>" title="<?php esc_attr_e('My hub', 'contabai-theme'); ?>"
               class="inline-flex items-center gap-2 rounded-md border border-neutral-200 px-4 py-2 text-sm font-medium text-neutral-700 no-underline transition hover:bg-neutral-100">
                <?php echo Heroicon::solid('user-circle', 'w-4 h-4'); ?>
                <span class="hidden sm:inline"><?php esc_html_e('My hub', 'contabai-theme'); ?></span>
            </a>

            <?php get_template_part('template-parts/mobile-menu'); ?>
        </div>
    </nav>
</header>

<script>
// Runs after Alpine finishes (incl. x-teleport), so #mobile-menu exists in its teleported spot.
document.addEventListener('alpine:initialized', function () {
    let mobileMenu = document.getElementById('mobile-menu');
    if (!mobileMenu) return;
    let parents = mobileMenu.querySelectorAll('.menu-item-has-children');
    parents.forEach(function (parent) {
        let subMenu = parent.querySelector('.sub-menu');
        if (!subMenu) return;
        subMenu.style.display = 'none';
        let link = parent.querySelector(':scope > a');
        link.setAttribute('aria-expanded', 'false');
        link.addEventListener('click', function (e) {
            e.preventDefault();
            let open = subMenu.style.display === 'none';
            subMenu.style.display = open ? '' : 'none';
            link.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    });
});
</script>

<main class="min-h-[60vh]">
