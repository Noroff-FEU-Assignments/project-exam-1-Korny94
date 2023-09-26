<?php
/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __( 'Front Page Options', 'harati' ),
        'description' => __( 'Contains all front page settings', 'harati'),
        'priority' => 50
    )
);
/**/
$wp_customize->add_section(
    'home_page_banner_option',
    array(
        'title'      => __( 'Front Page Banner Options', 'harati' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'harati_options[enable_banner_section]',
    array(
        'default'           => $default_options['enable_banner_section'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[enable_banner_section]',
    array(
        'label'   => __( 'Enable Banner Section', 'harati' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'harati_options[banner_section_slider_layout]',
    array(
        'default'           => $default_options['banner_section_slider_layout'],
        'sanitize_callback' => 'harati_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Harati_Radio_Image_Control(
        $wp_customize,
        'harati_options[banner_section_slider_layout]',
        array(
            'label' => __( 'Banner Slider Layout', 'harati' ),
            'section' => 'home_page_banner_option',
            'choices' => harati_get_slider_layouts()
        )
    )
);


$wp_customize->add_setting(
    'harati_options[number_of_slider_post]',
    array(
        'default'           => $default_options['number_of_slider_post'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[number_of_slider_post]',
    array(
        'label'       => __( 'Post In Slider', 'harati' ),
        'section'     => 'home_page_banner_option',
        'type'        => 'select',
        'choices'     => array(
            '3' => __( '3', 'harati' ),
            '4' => __( '4', 'harati' ),
            '5' => __( '5', 'harati' ),
            '6' => __( '6', 'harati' ),
        ),
    )
);


$wp_customize->add_setting(
    'harati_options[slider_post_content_alignment]',
    array(
        'default'           => $default_options['slider_post_content_alignment'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[slider_post_content_alignment]',
    array(
        'label'       => __( 'Slider Content Alignment', 'harati' ),
        'section'     => 'home_page_banner_option',
        'type'        => 'select',
        'choices'     => array(
            'text-right' => __( 'Align Right', 'harati' ),
            'text-center' => __( 'Align Center', 'harati' ),
            'text-left' => __( 'Align Left', 'harati' ),
        ),
    )
);

$wp_customize->add_setting(
    'harati_options[banner_section_cat]',
    array(
        'default'           => $default_options['banner_section_cat'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[banner_section_cat]',
    array(
        'label'   => __( 'Choose Banner Category', 'harati' ),
        'section' => 'home_page_banner_option',
            'type'        => 'select',
        'choices'     => harati_post_category_list(),
    )
);

$wp_customize->add_setting(
    'harati_options[enable_banner_post_description]',
    array(
        'default'           => $default_options['enable_banner_post_description'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[enable_banner_post_description]',
    array(
        'label'   => __( 'Enable Post Description', 'harati' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'harati_options[enable_banner_cat_meta]',
    array(
        'default'           => $default_options['enable_banner_cat_meta'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[enable_banner_cat_meta]',
    array(
        'label'   => __( 'Enable Category Meta', 'harati' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'harati_options[enable_banner_authro_meta]',
    array(
        'default'           => $default_options['enable_banner_authro_meta'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[enable_banner_authro_meta]',
    array(
        'label'   => __( 'Enable Authro Meta', 'harati' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'harati_options[enable_banner_date_meta]',
    array(
        'default'           => $default_options['enable_banner_date_meta'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[enable_banner_date_meta]',
    array(
        'label'   => __( 'Enable Date On Banner', 'harati' ),
        'section' => 'home_page_banner_option',
        'type'    => 'checkbox',
    )
);