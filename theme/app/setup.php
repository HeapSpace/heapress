<?php

namespace App;

use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'language_switcher' => __('Language Switcher', 'sage'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ];
    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id'   => 'sidebar-primary',
    ] + $config);
    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id'   => 'sidebar-footer',
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

//------------------------------------------------------------------------------------------------- igr

// SHORTCUT: section

add_shortcode('hs-section', function($atts, $content = "") {
    extract(shortcode_atts(array(
        'color' => 'red',
        'page'  => '',
    ), $atts));

    if (!empty($page)) {
        $content = get_page_by_path($page, OBJECT)->post_content;
        $content = apply_filters('the_content', $content);
    }
    return '<section class="grid bg-' . $color . '"><div class="content-wrap">' . $content . '</div></section>';
});

// SHORTCUT: columns

function insertColumn($columnsNo, $isLast, $content) {
    $content = '<div class="column column-' . $columnsNo . '">' . $content . '</div>';

    if (false !== $isLast) {
        $content .= "<div class='clear_column'></div>";
    }

    return $content;
}

add_shortcode('hs-col-2', function($atts, $content = "") {
    return insertColumn('2', false, $content);
});
add_shortcode('hs-col-2-last', function($atts, $content = "") {
    return insertColumn('2', true, $content);
});
add_shortcode('hs-col-3', function($atts, $content = "") {
    return insertColumn('3', false, $content);
});
add_shortcode('hs-col-3-last', function($atts, $content = "") {
    return insertColumn('3', true, $content);
});
add_shortcode('hs-col-3-1', function($atts, $content = "") {
    return insertColumn('3-1', false, $content);
});
add_shortcode('hs-col-3-23', function($atts, $content = "") {
    return insertColumn('3-23', true, $content);
});


// BUTTON

function register_button($buttons)
{
    array_push($buttons, "|", "hssection");
    return $buttons;
}
function add_plugin($plugin_array)
{
    $plugin_array['hssection'] = get_template_directory_uri() . '/assets/scripts/section-button.js';
    return $plugin_array;
}
function my_recent_posts_button()
{
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    if (get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', __NAMESPACE__ . '\\add_plugin');
        add_filter('mce_buttons', __NAMESPACE__ . '\\register_button');
    }
}
add_action('init', __NAMESPACE__ . '\\my_recent_posts_button');
