<?php use ContabaiTheme\Heroicon; ?>
</main>
<?php
$legalLinks = [];
foreach ((array) get_option('theme_legal_pages', []) as $slug => $pageId) {
    if (get_post_status($pageId) === 'publish') {
        $legalLinks[] = ['url' => get_permalink($pageId), 'label' => $slug === 'privacy' ? __('Privacy', 'contabai-theme') : __('Terms', 'contabai-theme')];
    }
}

$socialDefs = [
    ['opt' => 'theme_social_facebook',  'icon' => 'facebook',  'label' => 'Facebook'],
    ['opt' => 'theme_social_x',         'icon' => 'x',         'label' => 'X'],
    ['opt' => 'theme_social_instagram', 'icon' => 'instagram', 'label' => 'Instagram'],
    ['opt' => 'theme_social_linkedin',  'icon' => 'linkedin',  'label' => 'LinkedIn'],
    ['opt' => 'theme_social_youtube',   'icon' => 'youtube',   'label' => 'YouTube'],
    ['opt' => 'theme_social_tiktok',    'icon' => 'tiktok',    'label' => 'TikTok'],
];
$socialLinks = [];
foreach ($socialDefs as $def) {
    $url = trim((string) get_option($def['opt'], ''));
    if ($url !== '') {
        $socialLinks[] = ['url' => $url, 'icon' => $def['icon'], 'label' => $def['label']];
    }
}
?>
<footer class="mt-16 border-t border-neutral-200 bg-white">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-sm text-neutral-500 sm:flex-row">
        <div class="flex flex-col items-center gap-1 md:items-start">
            <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
                <span>&copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?></span>
                <?php foreach ($legalLinks as $link) : ?>
                    <span aria-hidden="true" class="text-neutral-300">&middot;</span>
                    <a href="<?php echo esc_url($link['url']); ?>" class="contabai-link text-neutral-500 transition hover:text-neutral-900"><?php echo esc_html($link['label']); ?></a>
                <?php endforeach; ?>
            </div>
            <a href="https://www.contabai.network" target="_blank" rel="noopener noreferrer" class="text-xs text-neutral-400 contabai-link transition-colors hover:text-neutral-600"><?php esc_html_e('Powered by Contabai', 'contabai-theme'); ?></a>
        </div>
        <?php if ($socialLinks !== []) : ?>
            <div class="flex items-center gap-3">
                <?php foreach ($socialLinks as $social) : ?>
                    <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer"
                       title="<?php echo esc_attr($social['label']); ?>" aria-label="<?php echo esc_attr($social['label']); ?>"
                       class="text-neutral-400 no-underline transition hover:text-neutral-600">
                        <?php echo Heroicon::render($social['icon'], 'brands', 'w-4 h-4'); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
