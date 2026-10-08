<?php

namespace ContabaiTheme\ThemeSettings;

use ContabaiTheme\Heroicon;

class ThemeSettings
{
    private array $google_fonts = [
        'Abel', 'Albert Sans', 'Amatic SC', 'Anton', 'Archivo',
        'Arimo', 'Asap', 'Asap Condensed', 'Atkinson Hyperlegible', 'Baloo 2',
        'Barlow', 'Be Vietnam Pro', 'Bitter', 'Brawler', 'Bricolage Grotesque',
        'Cabin', 'Cairo', 'Caladea', 'Catamaran', 'Chivo',
        'Commissioner', 'Cormorant Garamond', 'Crimson Text', 'DM Sans', 'Dosis',
        'EB Garamond', 'Encode Sans', 'Exo 2', 'Figtree',
        'Fira Sans', 'Fira Sans Condensed', 'Francois One', 'Gabarito', 'Hanken Grotesk', 'Heebo',
        'Hind', 'IBM Plex Sans', 'Inconsolata', 'Instrument Sans', 'Inter',
        'Josefin Sans', 'Josefin Slab', 'Jost', 'Kanit', 'Karla',
        'Lato', 'Lexend', 'Libre Baskerville', 'Libre Franklin', 'Lora',
        'Manrope', 'Merriweather', 'Merriweather Sans', 'Montserrat', 'Mukta',
        'Mulish', 'Nanum Gothic', 'Noto Sans', 'Noto Serif',
        'Nunito', 'Nunito Sans', 'Onest', 'Open Sans', 'Oswald',
        'Outfit', 'Overpass', 'Oxygen', 'PT Sans', 'PT Serif',
        'Playfair Display', 'Plus Jakarta Sans', 'Poppins', 'Prompt', 'Quicksand',
        'Raleway', 'Red Hat Display', 'Righteous', 'Roboto', 'Roboto Condensed',
        'Rokkitt', 'Rubik', 'Russo One', 'Sarabun', 'Signika',
        'Signika Negative', 'Slabo 27px', 'Sora',
        'Space Mono', 'Spectral', 'Titillium Web', 'Ubuntu', 'Ubuntu Condensed',
        'Urbanist', 'Varela Round', 'Vollkorn', 'Work Sans', 'Yanone Kaffeesatz',
    ];

    private array $topbar_icons = [
        'check', 'check-circle', 'check-badge', 'shield-check', 'star',
        'heart', 'home', 'home-modern', 'key', 'map-pin',
        'globe-europe-africa', 'users', 'user-group', 'wifi', 'banknotes',
        'currency-euro', 'wallet', 'credit-card', 'sparkles', 'hand-thumb-up',
        'chat-bubble-left-right', 'phone', 'clock', 'calendar-days', 'gift',
        'tag', 'receipt-percent', 'trophy', 'lock-closed', 'fire',
        'sun', 'building-storefront', 'truck', 'ticket', 'lifebuoy',
        'bolt', 'rocket-launch',
    ];

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_menu']);
        add_action('admin_init', [$this, 'register_theme_settings']);
        add_action('wp_head', [$this, 'add_theme_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_media_uploader']);
        add_filter('use_block_editor_for_post', [$this, 'maybe_classic_editor']);
        add_action('wp_enqueue_scripts', [$this, 'maybe_dequeue_block_css'], 100);
    }

    public function sanitize_site_name($value): string
    {
        $value = sanitize_text_field((string) $value);
        if (trim($value) !== '') {
            update_option('blogname', $value);
        }
        return $value;
    }

    public function sanitize_payoff($value): string
    {
        $value = sanitize_text_field((string) $value);
        update_option('blogdescription', $value);
        return $value;
    }

    public function maybe_classic_editor($use)
    {
        return get_option('theme_classic_editor', '0') === '1' ? false : $use;
    }

    public function maybe_dequeue_block_css(): void
    {
        if (get_option('theme_classic_editor', '0') !== '1') {
            return;
        }
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');
    }

    private function tabs(): array
    {
        return [
            'branding' => __('Branding', 'contabai-theme'),
            'hero' => __('Hero', 'contabai-theme'),
            'topbar' => __('Top bar', 'contabai-theme'),
            'typography' => __('Typography', 'contabai-theme'),
            'background' => __('Background', 'contabai-theme'),
            'footer' => __('Footer', 'contabai-theme'),
            'socials' => __('Socials', 'contabai-theme'),
            'updates' => __('Updates', 'contabai-theme'),
            'advanced' => __('Advanced', 'contabai-theme'),
        ];
    }

    private function fields(): array
    {
        $fields = [
            ['theme_site_name', __('Site name', 'contabai-theme'), 'text', '', 'branding'],
            ['theme_payoff', __('Payoff', 'contabai-theme'), 'text', '', 'branding'],
            ['theme_show_brand_text', __('Show brand text', 'contabai-theme'), 'checkbox', '1', 'branding'],
            ['theme_color_schema', __('Theme color', 'contabai-theme'), 'color', '#ff5400', 'branding'],
            ['theme_cta_enabled', __('Call-to-action button', 'contabai-theme'), 'checkbox', '0', 'branding'],
            ['theme_cta_label', __('CTA label', 'contabai-theme'), 'text', '', 'branding'],
            ['theme_cta_url', __('CTA URL', 'contabai-theme'), 'url', '', 'branding'],
            ['theme_sticky_header', __('Sticky header', 'contabai-theme'), 'checkbox', '1', 'branding'],
            ['theme_breadcrumbs_enabled', __('Breadcrumbs', 'contabai-theme'), 'checkbox', '1', 'branding'],

            ['theme_hero_enabled', __('Show hero on homepage', 'contabai-theme'), 'checkbox', '1', 'hero'],
            ['theme_hero_eyebrow', __('Eyebrow', 'contabai-theme'), 'text', 'Direct-booking holiday rentals', 'hero'],
            ['theme_hero_eyebrow_color', __('Eyebrow color', 'contabai-theme'), 'color', '#ffd9c9', 'hero'],
            ['theme_hero_heading', __('Heading', 'contabai-theme'), 'text', 'Your place in the sun, booked direct.', 'hero'],
            ['theme_hero_heading_color', __('Heading color', 'contabai-theme'), 'color', '#ffffff', 'hero'],
            ['theme_hero_subheading', __('Subheading', 'contabai-theme'), 'textarea', 'Handpicked homes and villas around the world. No booking fees, no middlemen — just you and the host.', 'hero'],
            ['theme_hero_subheading_color', __('Subheading color', 'contabai-theme'), 'color', '#e7ecef', 'hero'],
            ['theme_hero_badge1_text', __('Badge 1 text', 'contabai-theme'), 'text', 'Book direct with hosts', 'hero'],
            ['theme_hero_badge1_icon', __('Badge 1 icon', 'contabai-theme'), 'icon', 'shield-check', 'hero'],
            ['theme_hero_badge1_icon_color', __('Badge 1 icon color', 'contabai-theme'), 'color', '#22c55e', 'hero'],
            ['theme_hero_badge2_text', __('Badge 2 text', 'contabai-theme'), 'text', 'No platform fees', 'hero'],
            ['theme_hero_badge2_icon', __('Badge 2 icon', 'contabai-theme'), 'icon', 'banknotes', 'hero'],
            ['theme_hero_badge2_icon_color', __('Badge 2 icon color', 'contabai-theme'), 'color', '#22c55e', 'hero'],
            ['theme_hero_badge3_text', __('Badge 3 text', 'contabai-theme'), 'text', 'Worldwide selection', 'hero'],
            ['theme_hero_badge3_icon', __('Badge 3 icon', 'contabai-theme'), 'icon', 'globe-europe-africa', 'hero'],
            ['theme_hero_badge3_icon_color', __('Badge 3 icon color', 'contabai-theme'), 'color', '#22c55e', 'hero'],
            ['theme_hero_animation', __('Background animation', 'contabai-theme'), 'hero_anim', 'zoom-in', 'hero'],
            ['theme_hero_overlay_color', __('Overlay color', 'contabai-theme'), 'color', '#0f171e', 'hero'],
            ['theme_hero_overlay_opacity', __('Overlay opacity', 'contabai-theme'), 'hero_overlay_opacity', '50', 'hero'],
            ['theme_hero_align', __('Text alignment', 'contabai-theme'), 'hero_align', 'center', 'hero'],

            ['theme_topbar_enabled', __('Show top bar', 'contabai-theme'), 'checkbox', '1', 'topbar'],
            ['theme_topbar_bg', __('Background', 'contabai-theme'), 'color', '#1f2d3d', 'topbar'],
            ['theme_topbar_text', __('Text color', 'contabai-theme'), 'color', '#ffffff', 'topbar'],

            ['theme_font_schema', __('Body font', 'contabai-theme'), 'font', 'Inter', 'typography'],
            ['theme_heading_font', __('Heading font', 'contabai-theme'), 'font', 'Inter', 'typography'],
            ['theme_base_font_size', __('Base font size', 'contabai-theme'), 'font_size', '16', 'typography'],
            ['theme_base_line_height', __('Line height', 'contabai-theme'), 'line_height', '1.6', 'typography'],
            ['theme_body_text_color', __('Body text color', 'contabai-theme'), 'color', '#374151', 'typography'],
            ['theme_paragraph_spacing', __('Paragraph spacing', 'contabai-theme'), 'paragraph_spacing', 'normal', 'typography'],
            ['theme_heading_weight', __('Heading weight', 'contabai-theme'), 'heading_weight', '700', 'typography'],
            ['theme_heading_line_height', __('Heading line height', 'contabai-theme'), 'heading_line_height', '1.2', 'typography'],
            ['theme_heading_color', __('Heading color', 'contabai-theme'), 'color', '#111827', 'typography'],
            ['theme_link_color', __('Link color', 'contabai-theme'), 'color', '#ff5400', 'typography'],
            ['theme_link_underline', __('Link underline', 'contabai-theme'), 'link_underline', 'always', 'typography'],

            ['theme_bg_type', __('Type', 'contabai-theme'), 'bg_type', 'color', 'background'],
            ['theme_bg_color', __('Color', 'contabai-theme'), 'color', '#f3f4f6', 'background'],
            ['theme_bg_gradient', __('Gradient', 'contabai-theme'), 'bg_gradient', '1', 'background'],
            ['theme_bg_image', __('Image', 'contabai-theme'), 'media', '', 'background'],
            ['theme_bg_repeat', __('Repeat', 'contabai-theme'), 'bg_repeat', 'no-repeat', 'background'],
            ['theme_bg_size', __('Size', 'contabai-theme'), 'bg_size', 'cover', 'background'],
            ['theme_bg_position', __('Position', 'contabai-theme'), 'bg_position', 'center center', 'background'],
            ['theme_content_opacity', __('Content opacity', 'contabai-theme'), 'content_opacity', '100', 'background'],

            ['theme_privacy', __('Privacy statement', 'contabai-theme'), 'html', '', 'footer'],
            ['theme_terms', __('Terms statement', 'contabai-theme'), 'html', '', 'footer'],

            ['theme_social_facebook', __('Facebook', 'contabai-theme'), 'url', '', 'socials'],
            ['theme_social_x', __('X', 'contabai-theme'), 'url', '', 'socials'],
            ['theme_social_instagram', __('Instagram', 'contabai-theme'), 'url', '', 'socials'],
            ['theme_social_linkedin', __('LinkedIn', 'contabai-theme'), 'url', '', 'socials'],
            ['theme_social_youtube', __('YouTube', 'contabai-theme'), 'url', '', 'socials'],
            ['theme_social_tiktok', __('TikTok', 'contabai-theme'), 'url', '', 'socials'],

            ['theme_classic_editor', __('Classic editor', 'contabai-theme'), 'checkbox', '0', 'advanced'],
            ['theme_dev_mode', __('Development mode', 'contabai-theme'), 'checkbox', '0', 'advanced', __('Switches off theme updates from GitHub. Turn ON for a local development site that is a git checkout. Leave OFF in production.', 'contabai-theme')],
        ];

        $topbarDefaults = [
            1 => ['title' => __('Direct contact', 'contabai-theme'),      'text' => __('Message hosts directly for honest answers and local tips.', 'contabai-theme'),          'icon' => 'chat-bubble-left-right'],
            2 => ['title' => __('No booking fees', 'contabai-theme'),     'text' => __('The price you see is the price you pay — nothing added at checkout.', 'contabai-theme'),  'icon' => 'banknotes'],
            3 => ['title' => __('Worldwide selection', 'contabai-theme'), 'text' => __('Homes and villas from the Dutch Caribbean to the rest of the world.', 'contabai-theme'),   'icon' => 'globe-europe-africa'],
            4 => ['title' => __('Stays for everyone', 'contabai-theme'),  'text' => __('From snug studios to grand villas — room for couples, families and groups.', 'contabai-theme'), 'icon' => 'user-group'],
        ];
        for ($i = 1; $i <= 4; $i++) {
            $fields[] = ['theme_topbar_col' . $i . '_title', sprintf(__('Column %d title', 'contabai-theme'), $i), 'text', $topbarDefaults[$i]['title'], 'topbar'];
            $fields[] = ['theme_topbar_col' . $i . '_text', sprintf(__('Column %d text', 'contabai-theme'), $i), 'inline', $topbarDefaults[$i]['text'], 'topbar'];
            $fields[] = ['theme_topbar_col' . $i . '_icon', sprintf(__('Column %d icon', 'contabai-theme'), $i), 'icon', $topbarDefaults[$i]['icon'], 'topbar'];
            $fields[] = ['theme_topbar_col' . $i . '_icon_color', sprintf(__('Column %d icon color', 'contabai-theme'), $i), 'color', '#22c55e', 'topbar'];
        }

        return $fields;
    }

    public function register_menu(): void
    {
        add_menu_page(
            __('Contabai Theme', 'contabai-theme'),
            __('Contabai Theme', 'contabai-theme'),
            'edit_theme_options',
            'contabai-theme-options',
            [$this, 'render_settings_page'],
            'dashicons-art',
            59
        );
    }

    public function sanitize_font(string $value): string
    {
        if ($value === '') {
            return '';
        }

        if (in_array($value, $this->google_fonts, true)) {
            return $value;
        }

        return 'Inter';
    }

    public function sanitize_icon(string $value): string
    {
        return in_array($value, $this->topbar_icons, true) ? $value : 'check';
    }

    private function humanize(string $icon): string
    {
        return ucwords(str_replace('-', ' ', $icon));
    }

    public function enqueue_media_uploader(string $hook): void
    {
        if ($hook !== 'toplevel_page_contabai-theme-options') {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_style('contabai-theme-admin', get_template_directory_uri() . '/assets/css/admin.css', [], '3');
    }

    public function register_theme_settings(): void
    {
        foreach (array_keys($this->tabs()) as $tab) {
            add_settings_section($tab . '_section', '', '__return_false', 'contabai-theme-' . $tab);
        }

        foreach ($this->fields() as $field) {
            [$key, $label, $type, $default, $tab] = $field;

            $callback = 'sanitize_text_field';
            if ($type === 'media' || $type === 'url') {
                $callback = 'esc_url_raw';
            } elseif ($type === 'number') {
                $callback = 'absint';
            } elseif ($type === 'color') {
                $callback = 'sanitize_hex_color';
            } elseif ($type === 'font') {
                $callback = [$this, 'sanitize_font'];
            } elseif ($type === 'html') {
                $callback = 'wp_kses_post';
            } elseif ($type === 'icon') {
                $callback = [$this, 'sanitize_icon'];
            } elseif ($type === 'textarea') {
                $callback = 'sanitize_textarea_field';
            } elseif ($type === 'inline') {
                $callback = [$this, 'sanitize_inline_html'];
            }

            if ($key === 'theme_site_name') {
                $callback = [$this, 'sanitize_site_name'];
            } elseif ($key === 'theme_payoff') {
                $callback = [$this, 'sanitize_payoff'];
            }

            register_setting('contabai_theme_' . $tab, $key, [
                'type' => 'string',
                'sanitize_callback' => $callback,
                'default' => $default,
            ]);

            add_settings_field($key, $label, [$this, 'render_field_' . $type], 'contabai-theme-' . $tab, $tab . '_section', ['key' => $key, 'default' => $default, 'description' => $field[5] ?? '']);
        }
    }

    public function render_settings_page(): void
    {
        if (! current_user_can('edit_theme_options')) {
            return;
        }

        $tabs = $this->tabs();
        $current = isset($_GET['tab']) ? sanitize_key(wp_unslash($_GET['tab'])) : 'branding';
        if (! isset($tabs[$current])) {
            $current = 'branding';
        }

        if (isset($_GET['settings-updated'])) {
            add_settings_error('contabai_theme_messages', 'saved', __('Settings saved.', 'contabai-theme'), 'updated');
        }

        ?>
        <div class="wrap contabai-admin">
            <h1><?php esc_html_e('Contabai Theme', 'contabai-theme'); ?></h1>
            <?php settings_errors('contabai_theme_messages'); ?>

            <h2 class="nav-tab-wrapper">
                <?php foreach ($tabs as $key => $label) : ?>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=contabai-theme-options&tab=' . $key)); ?>" class="nav-tab<?php echo $key === $current ? ' nav-tab-active' : ''; ?>"><?php echo esc_html($label); ?></a>
                <?php endforeach; ?>
            </h2>

            <?php if ($current === 'updates') : ?>
                <?php \ContabaiTheme\ThemeUpdater::render_status(); ?>
            <?php else : ?>
            <form method="post" action="options.php">
                <?php
                settings_fields('contabai_theme_' . $current);
                do_settings_sections('contabai-theme-' . $current);
                submit_button();
                ?>
            </form>
            <?php endif; ?>

            <?php
            $this->render_media_script();
            if ($current === 'topbar' || $current === 'hero') {
                $this->render_icon_picker_script();
            }
            ?>
        </div>
        <?php
    }

    private function render_media_script(): void
    {
        ?>
        <script>
        document.querySelectorAll('[data-media-btn]').forEach(function (b) {
            b.addEventListener('click', function (e) {
                e.preventDefault();
                const input = document.getElementById(b.getAttribute('data-media-btn'));
                const frame = wp.media({ multiple: false });
                frame.on('select', function () {
                    input.value = frame.state().get('selection').first().toJSON().url;
                });
                frame.open();
            });
        });
        document.querySelectorAll('[data-media-remove]').forEach(function (r) {
            r.addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById(r.getAttribute('data-media-remove')).value = '';
            });
        });
        </script>
        <?php
    }

    private function render_icon_picker_script(): void
    {
        ?>
        <script>
        document.querySelectorAll('.contabai-icon-grid').forEach(function (grid) {
            grid.querySelectorAll('input[type=radio]').forEach(function (r) {
                r.addEventListener('change', function () {
                    grid.querySelectorAll('.contabai-icon-option').forEach(function (o) { o.classList.remove('is-selected'); });
                    if (r.checked) { r.closest('.contabai-icon-option').classList.add('is-selected'); }
                });
            });
        });
        </script>
        <?php
    }

    public function render_field_color(array $args): void
    {
        $value = get_option($args['key'], $args['default']);
        if (empty($value)) {
            $value = $args['default'];
        }
        ?>
        <input type="color" name="<?php echo esc_attr($args['key']); ?>" value="<?php echo esc_attr($value); ?>">
        <?php
    }

    public function render_field_font(array $args): void
    {
        $selected = get_option($args['key'], $args['default']);
        ?>
        <select name="<?php echo esc_attr($args['key']); ?>">
            <?php foreach ($this->google_fonts as $font) : ?>
                <option value="<?php echo esc_attr($font); ?>" <?php selected($font, $selected); ?>><?php echo esc_html($font); ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function render_field_checkbox(array $args): void
    {
        $value = get_option($args['key'], $args['default'] ?? '0');
        ?>
        <label><input type="checkbox" name="<?php echo esc_attr($args['key']); ?>" value="1" <?php checked($value, '1'); ?>> <?php esc_html_e('Enable', 'contabai-theme'); ?></label>
        <?php if (($args['description'] ?? '') !== '') : ?>
            <p class="description"><?php echo esc_html($args['description']); ?></p>
        <?php endif; ?>
        <?php
    }

    public function render_field_text(array $args): void
    {
        $value = get_option($args['key'], $args['default'] ?? '');
        ?>
        <input type="text" name="<?php echo esc_attr($args['key']); ?>" value="<?php echo esc_attr($value); ?>" class="regular-text">
        <?php
    }

    public function render_field_url(array $args): void
    {
        $value = get_option($args['key'], '');
        ?>
        <input type="url" name="<?php echo esc_attr($args['key']); ?>" value="<?php echo esc_attr($value); ?>" class="regular-text" placeholder="https://">
        <?php
    }

    public function render_field_textarea(array $args): void
    {
        $value = get_option($args['key'], $args['default'] ?? '');
        ?>
        <textarea name="<?php echo esc_attr($args['key']); ?>" rows="2" class="large-text"><?php echo esc_textarea($value); ?></textarea>
        <?php
    }

    public function render_field_inline(array $args): void
    {
        $value = get_option($args['key'], '');
        wp_editor($value, $args['key'], [
            'textarea_name' => $args['key'],
            'textarea_rows' => 3,
            'teeny' => true,
            'media_buttons' => false,
        ]);
        ?>
        <p class="description"><?php esc_html_e('Bold, italic and links are kept; the top bar is a single line, so paragraphs and lists are not.', 'contabai-theme'); ?></p>
        <?php
    }

    public function sanitize_inline_html(string $value): string
    {
        return wp_kses_post($value);
    }

    public function render_field_icon(array $args): void
    {
        $key = $args['key'];
        $selected = get_option($key, $args['default']);
        if (! in_array($selected, $this->topbar_icons, true)) {
            $selected = 'check';
        }

        ?>
        <div class="contabai-icon-grid">
            <?php foreach ($this->topbar_icons as $icon) : ?>
                <label class="contabai-icon-option<?php echo $icon === $selected ? ' is-selected' : ''; ?>" title="<?php echo esc_attr($this->humanize($icon)); ?>">
                    <input type="radio" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($icon); ?>" <?php checked($icon, $selected); ?>>
                    <?php echo Heroicon::solid($icon, 'w-5 h-5'); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <?php
    }

    public function render_field_html(array $args): void
    {
        $value = get_option($args['key'], '');
        wp_editor($value, $args['key'], [
            'textarea_name' => $args['key'],
            'textarea_rows' => 16,
            'media_buttons' => false,
            'tinymce' => [
                'toolbar1' => 'formatselect,bold,italic,bullist,numlist,link,unlink,blockquote,undo,redo',
            ],
        ]);
        ?>
        <p class="description"><?php esc_html_e('Shown in a pop-up from the footer link.', 'contabai-theme'); ?></p>
        <?php
    }

    private function render_select(string $key, string $default, array $options): void
    {
        $value = get_option($key, $default);
        ?>
        <select name="<?php echo esc_attr($key); ?>">
            <?php foreach ($options as $val => $label) : ?>
                <option value="<?php echo esc_attr($val); ?>" <?php selected($value, (string) $val); ?>><?php echo esc_html($label); ?></option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    private function percent_options(): array
    {
        $options = [];
        for ($i = 10; $i <= 100; $i += 10) {
            $options[(string) $i] = $i . '%';
        }

        return $options;
    }

    public function render_field_font_size(array $args): void
    {
        $this->render_select($args['key'], $args['default'], ['14' => '14px', '15' => '15px', '16' => '16px', '17' => '17px', '18' => '18px']);
    }

    public function render_field_line_height(array $args): void
    {
        $this->render_select($args['key'], $args['default'], ['1.4' => '1.4', '1.5' => '1.5', '1.6' => '1.6', '1.75' => '1.75']);
    }

    public function render_field_paragraph_spacing(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'tight' => __('Tight', 'contabai-theme'),
            'normal' => __('Normal', 'contabai-theme'),
            'relaxed' => __('Relaxed', 'contabai-theme'),
        ]);
    }

    public function render_field_heading_weight(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            '500' => __('Medium', 'contabai-theme'),
            '600' => __('Semibold', 'contabai-theme'),
            '700' => __('Bold', 'contabai-theme'),
            '800' => __('Extra bold', 'contabai-theme'),
        ]);
    }

    public function render_field_heading_line_height(array $args): void
    {
        $this->render_select($args['key'], $args['default'], ['1.1' => '1.1', '1.2' => '1.2', '1.3' => '1.3']);
    }

    public function render_field_link_underline(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'always' => __('Always', 'contabai-theme'),
            'hover' => __('On hover', 'contabai-theme'),
            'none' => __('None', 'contabai-theme'),
        ]);
    }

    public function render_field_hero_align(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'left' => __('Left', 'contabai-theme'),
            'center' => __('Center', 'contabai-theme'),
            'right' => __('Right', 'contabai-theme'),
        ]);
    }

    public function render_field_hero_overlay_opacity(array $args): void
    {
        $options = [];
        for ($i = 0; $i <= 90; $i += 10) {
            $options[(string) $i] = $i . '%';
        }
        $this->render_select($args['key'], $args['default'], $options);
    }

    public function render_field_hero_anim(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'zoom-in' => __('Ken Burns — zoom in', 'contabai-theme'),
            'zoom-out' => __('Ken Burns — zoom out', 'contabai-theme'),
            'pan-left' => __('Pan left', 'contabai-theme'),
            'pan-right' => __('Pan right', 'contabai-theme'),
            'pan-up' => __('Pan up', 'contabai-theme'),
            'pan-down' => __('Pan down', 'contabai-theme'),
            'diagonal' => __('Diagonal drift', 'contabai-theme'),
            'fade' => __('Crossfade only', 'contabai-theme'),
            'breathe' => __('Breathe', 'contabai-theme'),
            'static' => __('Static (no motion)', 'contabai-theme'),
        ]);
    }

    public function render_field_content_opacity(array $args): void
    {
        $this->render_select($args['key'], $args['default'], $this->percent_options());
    }

    public function render_field_bg_type(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'color' => __('Color', 'contabai-theme'),
            'gradient' => __('Gradient', 'contabai-theme'),
            'image' => __('Image', 'contabai-theme'),
        ]);
    }

    public function render_field_bg_gradient(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            '1' => __('Top to bottom', 'contabai-theme'),
            '2' => __('Bottom to top', 'contabai-theme'),
            '3' => __('Left to right', 'contabai-theme'),
            '4' => __('Diagonal', 'contabai-theme'),
            '5' => __('Radial', 'contabai-theme'),
            '6' => __('Soft fade', 'contabai-theme'),
            '7' => __('Dual tone', 'contabai-theme'),
            '8' => __('Three stop', 'contabai-theme'),
            '9' => __('Angled soft', 'contabai-theme'),
            '10' => __('Mesh subtle', 'contabai-theme'),
        ]);
    }

    public function render_field_media(array $args): void
    {
        $key = $args['key'];
        $value = get_option($key, '');
        $id = 'media-' . $key;
        ?>
        <div>
            <input type="text" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" class="regular-text" readonly>
            <div class="contabai-media-actions">
                <button type="button" class="button" data-media-btn="<?php echo esc_attr($id); ?>"><?php esc_html_e('Choose file', 'contabai-theme'); ?></button>
                <button type="button" class="button" data-media-remove="<?php echo esc_attr($id); ?>"><?php esc_html_e('Remove', 'contabai-theme'); ?></button>
            </div>
            <?php if ($value) : ?>
                <img src="<?php echo esc_url($value); ?>" alt="" class="contabai-media-preview">
            <?php endif; ?>
        </div>
        <?php
    }

    public function render_field_number(array $args): void
    {
        $value = get_option($args['key'], $args['default']);
        ?>
        <input type="number" name="<?php echo esc_attr($args['key']); ?>" value="<?php echo esc_attr($value); ?>" min="16" max="80" step="1" class="small-text">
        <?php
    }

    public function render_field_bg_repeat(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'no-repeat' => __('No repeat', 'contabai-theme'),
            'repeat' => __('Repeat all', 'contabai-theme'),
            'repeat-x' => __('Repeat horizontal', 'contabai-theme'),
            'repeat-y' => __('Repeat vertical', 'contabai-theme'),
        ]);
    }

    public function render_field_bg_size(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'cover' => __('Cover', 'contabai-theme'),
            'contain' => __('Contain', 'contabai-theme'),
            'auto' => __('Auto', 'contabai-theme'),
            '100%' => __('100% width', 'contabai-theme'),
        ]);
    }

    public function render_field_bg_position(array $args): void
    {
        $this->render_select($args['key'], $args['default'], [
            'center center' => __('Center', 'contabai-theme'),
            'top center' => __('Top center', 'contabai-theme'),
            'bottom center' => __('Bottom center', 'contabai-theme'),
            'left center' => __('Left center', 'contabai-theme'),
            'right center' => __('Right center', 'contabai-theme'),
            'top left' => __('Top left', 'contabai-theme'),
            'top right' => __('Top right', 'contabai-theme'),
            'bottom left' => __('Bottom left', 'contabai-theme'),
            'bottom right' => __('Bottom right', 'contabai-theme'),
        ]);
    }

    private function get_gradient_css(string $preset, string $color): string
    {
        $darker = 'color-mix(in srgb, ' . $color . ' 70%, #000)';
        $lighter = 'color-mix(in srgb, ' . $color . ' 70%, #fff)';
        $complement = 'color-mix(in srgb, ' . $color . ' 50%, #666)';

        $gradients = [
            '1' => 'linear-gradient(to bottom, ' . $color . ', ' . $darker . ')',
            '2' => 'linear-gradient(to top, ' . $color . ', ' . $darker . ')',
            '3' => 'linear-gradient(to right, ' . $color . ', ' . $darker . ')',
            '4' => 'linear-gradient(135deg, ' . $color . ', ' . $darker . ')',
            '5' => 'radial-gradient(circle, ' . $color . ', ' . $darker . ')',
            '6' => 'linear-gradient(to bottom, ' . $lighter . ', ' . $color . ')',
            '7' => 'linear-gradient(to bottom right, ' . $color . ', ' . $complement . ')',
            '8' => 'linear-gradient(to bottom, ' . $lighter . ', ' . $color . ', ' . $darker . ')',
            '9' => 'linear-gradient(160deg, ' . $lighter . ' 0%, ' . $color . ' 50%, ' . $darker . ' 100%)',
            '10' => 'linear-gradient(135deg, ' . $color . ' 0%, ' . $lighter . ' 50%, ' . $color . ' 100%)',
        ];

        return $gradients[$preset] ?? $gradients['1'];
    }

    public function add_theme_styles(): void
    {
        $color = esc_attr(get_option('theme_color_schema', '#ff5400'));
        $contentOpacity = (int) get_option('theme_content_opacity', '100');
        if ($contentOpacity < 10 || $contentOpacity > 100) {
            $contentOpacity = 100;
        }
        $font = esc_attr(get_option('theme_font_schema', 'Inter'));
        $topbarBg = esc_attr(get_option('theme_topbar_bg', '#1f2d3d')) ?: '#1f2d3d';
        $topbarText = esc_attr(get_option('theme_topbar_text', '#ffffff')) ?: '#ffffff';
        $topbarIcon1 = esc_attr(get_option('theme_topbar_col1_icon_color', '#22c55e')) ?: '#22c55e';
        $topbarIcon2 = esc_attr(get_option('theme_topbar_col2_icon_color', '#22c55e')) ?: '#22c55e';
        $topbarIcon3 = esc_attr(get_option('theme_topbar_col3_icon_color', '#22c55e')) ?: '#22c55e';
        $topbarIcon4 = esc_attr(get_option('theme_topbar_col4_icon_color', '#22c55e')) ?: '#22c55e';
        $heroEyebrowColor = esc_attr(get_option('theme_hero_eyebrow_color', '#ffd9c9')) ?: '#ffd9c9';
        $heroHeadingColor = esc_attr(get_option('theme_hero_heading_color', '#ffffff')) ?: '#ffffff';
        $heroSubColor = esc_attr(get_option('theme_hero_subheading_color', '#e7ecef')) ?: '#e7ecef';
        $overlayColor = esc_attr(get_option('theme_hero_overlay_color', '#0f171e')) ?: '#0f171e';
        $overlayOpacity = (int) get_option('theme_hero_overlay_opacity', '50');
        if ($overlayOpacity < 0 || $overlayOpacity > 100) {
            $overlayOpacity = 50;
        }
        $overlayOpacity = $overlayOpacity / 100;
        $heroBadge1 = esc_attr(get_option('theme_hero_badge1_icon_color', '#22c55e')) ?: '#22c55e';
        $heroBadge2 = esc_attr(get_option('theme_hero_badge2_icon_color', '#22c55e')) ?: '#22c55e';
        $heroBadge3 = esc_attr(get_option('theme_hero_badge3_icon_color', '#22c55e')) ?: '#22c55e';

        $logoHeight = (int) get_option('theme_logo_height', 40);
        if ($logoHeight < 16 || $logoHeight > 80) {
            $logoHeight = 40;
        }

        $headingFont = esc_attr(get_option('theme_heading_font', 'Inter')) ?: 'Inter';
        $bodyTextColor = esc_attr(get_option('theme_body_text_color', '#374151')) ?: '#374151';
        $headingColor = esc_attr(get_option('theme_heading_color', '#111827')) ?: '#111827';
        $linkColor = esc_attr(get_option('theme_link_color', '#ff5400')) ?: '#ff5400';

        $baseFontSize = (string) get_option('theme_base_font_size', '16');
        if (! in_array($baseFontSize, ['14', '15', '16', '17', '18'], true)) {
            $baseFontSize = '16';
        }
        $lineHeight = (string) get_option('theme_base_line_height', '1.6');
        if (! in_array($lineHeight, ['1.4', '1.5', '1.6', '1.75'], true)) {
            $lineHeight = '1.6';
        }
        $paragraphMap = ['tight' => '0.75rem', 'normal' => '1rem', 'relaxed' => '1.5rem'];
        $paragraphSpacing = $paragraphMap[get_option('theme_paragraph_spacing', 'normal')] ?? '1rem';
        $headingWeight = (string) get_option('theme_heading_weight', '700');
        if (! in_array($headingWeight, ['500', '600', '700', '800'], true)) {
            $headingWeight = '700';
        }
        $headingLineHeight = (string) get_option('theme_heading_line_height', '1.2');
        if (! in_array($headingLineHeight, ['1.1', '1.2', '1.3'], true)) {
            $headingLineHeight = '1.2';
        }
        $linkUnderline = get_option('theme_link_underline', 'always');
        if (! in_array($linkUnderline, ['always', 'hover', 'none'], true)) {
            $linkUnderline = 'always';
        }
        if ($linkUnderline === 'always') {
            $underlineCss = '.entry-content a, .contabai-link { text-decoration: underline; }';
        } elseif ($linkUnderline === 'none') {
            $underlineCss = '.entry-content a, .contabai-link { text-decoration: none; }';
        } else {
            $underlineCss = '.entry-content a, .contabai-link { text-decoration: none; } .entry-content a:hover, .contabai-link:hover { text-decoration: underline; }';
        }

        $families = array_unique(array_filter([$font, $headingFont]));
        $fontFaces = '';
        foreach ($families as $family) {
            $slug = sanitize_title($family);
            $dir = get_template_directory() . '/assets/fonts/' . $slug;
            $uri = get_template_directory_uri() . '/assets/fonts/' . $slug;
            foreach (glob($dir . '/*.woff2') ?: [] as $file) {
                $weight = (int) basename($file, '.woff2');
                if ($weight < 100 || $weight > 900) {
                    continue;
                }
                $fontFaces .= '@font-face{font-family:"' . $family . '";font-style:normal;font-weight:' . $weight . ';font-display:swap;src:url("' . esc_url($uri . '/' . $weight . '.woff2') . '") format("woff2");}';
            }
        }
        if ($fontFaces !== '') {
            echo '<style id="contabai-fonts">' . $fontFaces . '</style>';
        }
        $bgType = get_option('theme_bg_type', 'color');
        $bgColor = esc_attr(get_option('theme_bg_color', '#f3f4f6'));

        if ($bgType === 'gradient') {
            $bgPreset = get_option('theme_bg_gradient', '1');
            $bgCss = 'background: ' . $this->get_gradient_css($bgPreset, $bgColor) . '; background-attachment: fixed;';
        } elseif ($bgType === 'image') {
            $bgImage = esc_url(get_option('theme_bg_image', ''));

            $bgRepeat = get_option('theme_bg_repeat', 'no-repeat');
            if (! in_array($bgRepeat, ['no-repeat', 'repeat', 'repeat-x', 'repeat-y'], true)) {
                $bgRepeat = 'no-repeat';
            }

            $bgSize = get_option('theme_bg_size', 'cover');
            if (! in_array($bgSize, ['cover', 'contain', 'auto', '100%'], true)) {
                $bgSize = 'cover';
            }

            $bgPosition = get_option('theme_bg_position', 'center center');
            if (! in_array($bgPosition, ['center center', 'top center', 'bottom center', 'left center', 'right center', 'top left', 'top right', 'bottom left', 'bottom right'], true)) {
                $bgPosition = 'center center';
            }
            if ($bgImage) {
                $bgCss = 'background: ' . $bgColor . ' url(\'' . $bgImage . '\') ' . $bgRepeat . ' ' . $bgPosition . '; background-size: ' . $bgSize . '; background-attachment: fixed;';
            } else {
                $bgCss = 'background: ' . $bgColor . ';';
            }
        } else {
            $bgCss = 'background: ' . $bgColor . ';';
        }

        echo '<style>:root {
            --theme-color: ' . $color . ';
            --content-opacity: ' . $contentOpacity . '%;
            --theme-font: "' . $font . '", sans-serif;
            --topbar-bg: ' . $topbarBg . ';
            --topbar-text: ' . $topbarText . ';
            --topbar-icon-1-color: ' . $topbarIcon1 . ';
            --topbar-icon-2-color: ' . $topbarIcon2 . ';
            --topbar-icon-3-color: ' . $topbarIcon3 . ';
            --topbar-icon-4-color: ' . $topbarIcon4 . ';
            --hero-eyebrow-color: ' . $heroEyebrowColor . ';
            --hero-heading-color: ' . $heroHeadingColor . ';
            --hero-subheading-color: ' . $heroSubColor . ';
            --hero-overlay-color: ' . $overlayColor . ';
            --hero-overlay-opacity: ' . $overlayOpacity . ';
            --hero-badge-1-color: ' . $heroBadge1 . ';
            --hero-badge-2-color: ' . $heroBadge2 . ';
            --hero-badge-3-color: ' . $heroBadge3 . ';
            --theme-heading-font: "' . $headingFont . '", sans-serif;
            --content-font-size: ' . $baseFontSize . 'px;
            --content-line-height: ' . $lineHeight . ';
            --content-text-color: ' . $bodyTextColor . ';
            --content-paragraph-spacing: ' . $paragraphSpacing . ';
            --heading-weight: ' . $headingWeight . ';
            --heading-line-height: ' . $headingLineHeight . ';
            --heading-color: ' . $headingColor . ';
            --content-link-color: ' . $linkColor . ';
            --logo-height: ' . $logoHeight . 'px;
        }
        * { font-family: var(--theme-font), system-ui, sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: var(--theme-heading-font, var(--theme-font)), system-ui, sans-serif; }
        html { font-size: var(--content-font-size, 16px); }
        body { ' . $bgCss . ' min-height: 100vh; }
        .text-primary-500, .text-primary-600, .text-primary-700 { color: var(--theme-color) !important; }
        .bg-primary-500 { background-color: var(--theme-color) !important; }
        .bg-primary-50 { background-color: color-mix(in srgb, var(--theme-color) 8%, #fff) !important; }
        .border-primary-500 { border-color: var(--theme-color) !important; }
        ' . $underlineCss . '
        </style>';
    }
}
