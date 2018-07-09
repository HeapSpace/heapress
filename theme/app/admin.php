<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector'        => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        },
    ]);

    // COLORS

    $hs_colors = array(
        'red'   => 'Red',
        'blue'  => 'Blue',
        'beige' => 'Beige',
        'black' => 'Black',
    );

    $wp_customize->add_section(
        'content',
        array(
            'title'       => 'Content',
            'description' => 'Change some content related settings.',
            'priority'    => 130,
        )
    );

    $wp_customize->add_setting('primary_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
        array(
            'default'    => 'red', //Default setting/value to save
            'type'       => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            //'transport'  => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
        )
    );
    $wp_customize->add_control(new \WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'primary_color', //Set a unique ID for the control
        array(
            'label'       => __('Primary color name', 'primary_color'), //Admin-visible name of the control
            'description' => __('Primary color for non-sections'),
            'settings'    => 'primary_color', //Which setting to load and manipulate (serialized is okay)
            'priority'    => 10, //Determines the order this control appears in for the specified section
            'section'     => 'content', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'        => 'select',
            'choices'     => $hs_colors,
        )
    ));

    $wp_customize->add_setting(
        'footer_slug',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'footer_slug',
        array(
            'label'    => 'Footer slug',
            'section'  => 'content',
            'settings' => 'footer_slug',
        )
    );

    $wp_customize->add_setting('footer_color',
        array(
            'default'    => 'black',
            'type'       => 'theme_mod',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control(new \WP_Customize_Control(
        $wp_customize, //Pass the $wp_customize object (required)
        'footer_color', //Set a unique ID for the control
        array(
            'label'       => __('Footer color name', 'footer_color'), //Admin-visible name of the control
            'description' => __('Footer color'),
            'settings'    => 'footer_color', //Which setting to load and manipulate (serialized is okay)
            'priority'    => 30, //Determines the order this control appears in for the specified section
            'section'     => 'content', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'type'        => 'select',
            'choices'     => $hs_colors,
        )
    ));

    // SOCIAL

    $wp_customize->add_section(
        'social',
        array(
            'title'       => 'Social',
            'description' => 'Manage the social accounts.',
            'priority'    => 140,
        )
    );

    $wp_customize->add_setting(
        'twitter',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'twitter',
        array(
            'label'    => 'Twitter',
            'section'  => 'social',
            'settings' => 'twitter',
        )
    );
    $wp_customize->add_setting(
        'facebook',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'facebook',
        array(
            'label'    => 'Facebook',
            'section'  => 'social',
            'settings' => 'facebook',
        )
    );
    $wp_customize->add_setting(
        'linkedin',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'linkedin',
        array(
            'label'    => 'LinkedIn',
            'section'  => 'social',
            'settings' => 'linkedin',
        )
    );

});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
