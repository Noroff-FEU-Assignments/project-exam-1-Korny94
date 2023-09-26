<?php
$wp_customize->add_section(
    'archive_options' ,
    array(
        'title' => __( 'Archive Options', 'harati' ),
        'panel' => 'harati_option_panel',
    )
);

/* Global Layout*/
$wp_customize->add_setting(
    'harati_options[global_sidebar_layout]',
    array(
        'default'           => $default_options['global_sidebar_layout'],
        'sanitize_callback' => 'harati_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Harati_Radio_Image_Control(
        $wp_customize,
        'harati_options[global_sidebar_layout]',
        array(
            'label' => __( 'Global Sidebar Layout', 'harati' ),
            'section' => 'archive_options',
            'choices' => harati_get_general_layouts()
        )
    )
);

// Hide Side Bar on Mobile
$wp_customize->add_setting(
    'harati_options[hide_global_sidebar_mobile]',
    array(
        'default'           => $default_options['hide_global_sidebar_mobile'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[hide_global_sidebar_mobile]',
    array(
        'label'       => __( 'Hide Global Sidebar on Mobile', 'harati' ),
        'section'     => 'archive_options',
        'type'        => 'checkbox',
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_archive_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_archive_1',
        array(
            'settings' => 'harati_section_seperator_archive_1',
            'section' => 'archive_options',
        )
    )
);

/* Archive Style */
$wp_customize->add_setting(
    'harati_options[archive_style]',
    array(
        'default'           => $default_options['archive_style'],
        'sanitize_callback' => 'harati_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Harati_Radio_Image_Control(
        $wp_customize,
        'harati_options[archive_style]',
        array(
            'label'	=> __( 'Archive Style', 'harati' ),
            'section' => 'archive_options',
            'choices' => harati_get_archive_layouts()
        )
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_archive_2',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_archive_2',
        array(
            'settings' => 'harati_section_seperator_archive_2',
            'section' => 'archive_options',
        )
    )
);

/* Archive Meta */
$wp_customize->add_setting(
    'harati_options[archive_post_meta_1]',
    array(
        'default'           => $default_options['archive_post_meta_1'],
        'sanitize_callback' => 'harati_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Harati_Checkbox_Multiple(
        $wp_customize,
        'harati_options[archive_post_meta_1]',
        array(
            'label'	=> __( 'Archive Post Meta', 'harati' ),
            'description'	=> __( 'Please select which post meta data you would like to appear on the listings for archived posts.', 'harati' ),
            'section' => 'archive_options',
            'choices' => array(
                'author' => __( 'Author', 'harati' ),
                'date' => __( 'Date', 'harati' ),
                'comment' => __( 'Comment', 'harati' ),
                'category' => __( 'Category', 'harati' ),
                'tags' => __( 'Tags', 'harati' ),
            ),
            'active_callback' => 'harati_archive_poost_meta_1',
        )

    )
);
/* Archive Meta */
$wp_customize->add_setting(
    'harati_options[archive_post_meta_2]',
    array(
        'default'           => $default_options['archive_post_meta_2'],
        'sanitize_callback' => 'harati_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Harati_Checkbox_Multiple(
        $wp_customize,
        'harati_options[archive_post_meta_2]',
        array(
            'label' => __( 'Archive Post Meta', 'harati' ),
            'description'   => __( 'Please select which post meta data you would like to appear on the listings for archived posts.', 'harati' ),
            'section' => 'archive_options',
            'choices' => array(
                'author' => __( 'Author', 'harati' ),
                'date' => __( 'Date', 'harati' ),
                'category' => __( 'Category', 'harati' ),
            ),
            'active_callback' => 'harati_archive_poost_meta_2',

        )
    )
);

/* Archive Meta */
$wp_customize->add_setting(
    'harati_options[archive_post_meta_3]',
    array(
        'default'           => $default_options['archive_post_meta_3'],
        'sanitize_callback' => 'harati_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Harati_Checkbox_Multiple(
        $wp_customize,
        'harati_options[archive_post_meta_3]',
        array(
            'label' => __( 'Archive Post Meta', 'harati' ),
            'description'   => __( 'Please select which post meta data you would like to appear on the listings for archived posts.', 'harati' ),
            'section' => 'archive_options',
            'choices' => array(
                'author' => __( 'Author', 'harati' ),
                'date' => __( 'Date', 'harati' ),
                'category' => __( 'Category', 'harati' ),
            ),
            'active_callback' => 'harati_archive_poost_meta_3',

        )
    )
);

/* Archive Meta */
$wp_customize->add_setting(
    'harati_options[archive_post_meta_4]',
    array(
        'default'           => $default_options['archive_post_meta_4'],
        'sanitize_callback' => 'harati_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Harati_Checkbox_Multiple(
        $wp_customize,
        'harati_options[archive_post_meta_4]',
        array(
            'label' => __( 'Archive Post Meta', 'harati' ),
            'description'   => __( 'Please select which post meta data you would like to appear on the listings for archived posts.', 'harati' ),
            'section' => 'archive_options',
            'choices' => array(
                'category' => __( 'Category', 'harati' ),
            ),
            'active_callback' => 'harati_archive_poost_meta_4',

        )
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_archive_3',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_archive_3',
        array(
            'settings' => 'harati_section_seperator_archive_3',
            'section' => 'archive_options',
        )
    )
);

$wp_customize->add_setting('harati_options[excerpt_length]',
    array(
        'default'           => $default_options['excerpt_length'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'harati_sanitize_number_range',
    )
);
$wp_customize->add_control('harati_options[excerpt_length]',
    array(
        'label'       => esc_html__('Excerpt Length', 'harati'),
        'description'       => esc_html__( 'Max number of words. Set it to 0 to disable. (step-1)', 'harati' ),
        'section'     => 'archive_options',
        'type'        => 'range',
        'input_attrs' => array(
                       'min'   => 0,
                       'max'   => 100,
                       'step'   => 1,
                    ),
    )
);
