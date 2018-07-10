<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment',
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );
    return template_path(locate_template(["views/{$comments_template}", $comments_template]) ?: $comments_template);
}, 100);

/**
 * Add custom buttons in a second row.
 */
add_filter("mce_buttons_2", function ($buttons) {
//    $buttons[] = 'fontselect';
    //    $buttons[] = 'fontsizeselect';
    //    array_unshift($buttons, 'visualaid');
    //    array_unshift($buttons, 'hr');
    //    array_unshift($buttons, 'charmap');
    array_unshift($buttons, 'cut');
    array_unshift($buttons, 'copy');
    array_unshift($buttons, 'backcolor');
    array_unshift($buttons, 'styleselect');

    return $buttons;
});

/**
 * Force the kitchen sink to always be on.
 * Add HS styles.
 */
add_filter('tiny_mce_before_init', function ($args) {
    $args['wordpress_adv_hidden'] = false;

    $style_formats = array(
        array(
            'title'   => 'Big Link',
            'selector' => 'a',
            'classes' => 'btn',
        ),
    );
    $args['style_formats'] = json_encode($style_formats);

    return $args;
});
