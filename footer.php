<?php use ContabaiTheme\Heroicon; ?>
</main>
<?php
$privacy = (string) get_option('theme_privacy', '');
$terms   = (string) get_option('theme_terms', '');

$legalBody = '';
if ($privacy !== '') {
    $legalBody .= '<div x-show="doc === \'privacy\'" class="entry-content">' . wp_kses_post($privacy) . '</div>';
}
if ($terms !== '') {
    $legalBody .= '<div x-show="doc === \'terms\'" class="entry-content">' . wp_kses_post($terms) . '</div>';
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
<footer class="mt-16 border-t border-neutral-200 bg-white" x-data="{ legal: false, doc: '' }" x-on:keydown.escape.window="legal = false">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-5 text-sm text-neutral-500 sm:flex-row">
        <div class="flex flex-col items-center gap-1 md:items-start">
            <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
                <span>&copy; <?php echo esc_html(date('Y')); ?> <?php echo esc_html(get_bloginfo('name')); ?></span>
                <?php if ($privacy !== '') : ?>
                    <span aria-hidden="true" class="text-neutral-300">&middot;</span>
                    <button type="button" x-on:click="doc = 'privacy'; legal = true" class="contabai-link text-neutral-500 transition hover:text-neutral-900"><?php esc_html_e('Privacy', 'contabai-theme'); ?></button>
                <?php endif; ?>
                <?php if ($terms !== '') : ?>
                    <span aria-hidden="true" class="text-neutral-300">&middot;</span>
                    <button type="button" x-on:click="doc = 'terms'; legal = true" class="contabai-link text-neutral-500 transition hover:text-neutral-900"><?php esc_html_e('Terms', 'contabai-theme'); ?></button>
                <?php endif; ?>
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

    <?php
    if ($legalBody !== '') {
        get_template_part('template-parts/modal', null, [
            'state' => 'legal',
            'title' => "doc === 'privacy' ? '" . esc_js(__('Privacy policy', 'contabai-theme')) . "' : '" . esc_js(__('Terms of service', 'contabai-theme')) . "'",
            'body'  => $legalBody,
        ]);
    }
    ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
