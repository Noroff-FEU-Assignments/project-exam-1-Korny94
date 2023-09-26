<?php

$wp_customize->add_section(
    'single_options' ,
    array(
        'title' => __( 'Single Options', 'harati' ),
        'panel' => 'harati_option_panel',
    )
);

/* Global Layout*/
$wp_customize->add_setting(
    'harati_options[single_sidebar_layout]',
    array(
        'default'           => $default_options['single_sidebar_layout'],
        'sanitize_callback' => 'harati_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Harati_Radio_Image_Control(
        $wp_customize,
        'harati_options[single_sidebar_layout]',
        array(
            'label' => __( 'Single Sidebar Layout', 'harati' ),
            'section' => 'single_options',
            'choices' => harati_get_general_layouts()
        )
    )
);

// Hide Side Bar on Mobile
$wp_customize->add_setting(
    'harati_options[hide_single_sidebar_mobile]',
    array(
        'default'           => $default_options['hide_single_sidebar_mobile'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[hide_single_sidebar_mobile]',
    array(
        'label'       => __( 'Hide Single Sidebar on Mobile', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'checkbox',
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_single_1',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_single_1',
        array(
            'settings' => 'harati_section_seperator_single_1',
            'section'       => 'single_options',
        )
    )
);

/* Post Meta */
$wp_customize->add_setting(
    'harati_options[single_post_meta]',
    array(
        'default'           => $default_options['single_post_meta'],
        'sanitize_callback' => 'harati_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Harati_Checkbox_Multiple(
        $wp_customize,
        'harati_options[single_post_meta]',
        array(
            'label' => __( 'Single Post Meta', 'harati' ),
            'description'   => __( 'Choose the post meta you want to be displayed on post detail page', 'harati' ),
            'section' => 'single_options',
            'choices' => array(
                'author' => __( 'Author', 'harati' ),
                'date' => __( 'Date', 'harati' ),
                'comment' => __( 'Comment', 'harati' ),
                'category' => __( 'Category', 'harati' ),
                'tags' => __( 'Tags', 'harati' ),
            )
        )
    )
);


$wp_customize->add_setting(
    'harati_section_seperator_single_2',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control( 
        $wp_customize,
        'harati_section_seperator_single_2',
        array(
            'settings' => 'harati_section_seperator_single_2',
            'section'       => 'single_options',
        )
    )
);

/*Show Author Info Box
*-------------------------------*/
$wp_customize->add_setting(
    'harati_options[show_author_info]',
    array(
        'default'           => $default_options['show_author_info'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[show_author_info]',
    array(
        'label'    => __( 'Show Author Info Box', 'harati' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_single_3',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_single_3',
        array(
            'settings' => 'harati_section_seperator_single_3',
            'section'       => 'single_options',
        )
    )
);

/*Show Related Posts
*-------------------------------*/
$wp_customize->add_setting(
    'harati_options[show_related_posts]',
    array(
        'default'           => $default_options['show_related_posts'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[show_related_posts]',
    array(
        'label'    => __( 'Show Related Posts', 'harati' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

/*Related Posts Text.*/
$wp_customize->add_setting(
    'harati_options[related_posts_text]',
    array(
        'default'           => $default_options['related_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'harati_options[related_posts_text]',
    array(
        'label'    => __( 'Related Posts Text', 'harati' ),
        'section'  => 'single_options',
        'type'     => 'text',
        'active_callback' => 'harati_is_related_posts_enabled',
    )
);

/* Number of Related Posts */
$wp_customize->add_setting(
    'harati_options[no_of_related_posts]',
    array(
        'default'           => $default_options['no_of_related_posts'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'harati_options[no_of_related_posts]',
    array(
        'label'       => __( 'Number of Related Posts', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'number',
        'active_callback' => 'harati_is_related_posts_enabled',
    )
);

/*Related Posts Orderby*/
$wp_customize->add_setting(
    'harati_options[related_posts_orderby]',
    array(
        'default'           => $default_options['related_posts_orderby'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[related_posts_orderby]',
    array(
        'label'       => __( 'Orderby', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'date' => __('Date', 'harati'),
            'id' => __('ID', 'harati'),
            'title' => __('Title', 'harati'),
            'rand' => __('Random', 'harati'),
        ),
        'active_callback' => 'harati_is_related_posts_enabled',
    )
);

/*Related Posts Order*/
$wp_customize->add_setting(
    'harati_options[related_posts_order]',
    array(
        'default'           => $default_options['related_posts_order'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[related_posts_order]',
    array(
        'label'       => __( 'Order', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'asc' => __('ASC', 'harati'),
            'desc' => __('DESC', 'harati'),
        ),
        'active_callback' => 'harati_is_related_posts_enabled',
    )
);

$wp_customize->add_setting(
    'harati_section_seperator_single_4',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Harati_Seperator_Control(
        $wp_customize,
        'harati_section_seperator_single_4',
        array(
            'settings' => 'harati_section_seperator_single_4',
            'section'       => 'single_options',
        )
    )
);
/*Show Author Posts
*-----------------------------------------*/
$wp_customize->add_setting(
    'harati_options[show_author_posts]',
    array(
        'default'           => $default_options['show_author_posts'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[show_author_posts]',
    array(
        'label'    => __( 'Show Author Posts', 'harati' ),
        'section'  => 'single_options',
        'type'     => 'checkbox',
    )
);

/*Author Posts Text.*/
$wp_customize->add_setting(
    'harati_options[author_posts_text]',
    array(
        'default'           => $default_options['author_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'harati_options[author_posts_text]',
    array(
        'label'    => __( 'Author Posts Text', 'harati' ),
        'section'  => 'single_options',
        'type'     => 'text',
        'active_callback' => 'harati_is_author_posts_enabled',
    )
);

/* Number of Author Posts */
$wp_customize->add_setting(
    'harati_options[no_of_author_posts]',
    array(
        'default'           => $default_options['no_of_author_posts'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'harati_options[no_of_author_posts]',
    array(
        'label'       => __( 'Number of Author Posts', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'number',
        'active_callback' => 'harati_is_author_posts_enabled',
    )
);

/*Author Posts Orderby*/
$wp_customize->add_setting(
    'harati_options[author_posts_orderby]',
    array(
        'default'           => $default_options['author_posts_orderby'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[author_posts_orderby]',
    array(
        'label'       => __( 'Orderby', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'date' => __('Date', 'harati'),
            'id' => __('ID', 'harati'),
            'title' => __('Title', 'harati'),
            'rand' => __('Random', 'harati'),
        ),
        'active_callback' => 'harati_is_author_posts_enabled',
    )
);

/*Author Posts Order*/
$wp_customize->add_setting(
    'harati_options[author_posts_order]',
    array(
        'default'           => $default_options['author_posts_order'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[author_posts_order]',
    array(
        'label'       => __( 'Order', 'harati' ),
        'section'     => 'single_options',
        'type'        => 'select',
        'choices' => array(
            'asc' => __('ASC', 'harati'),
            'desc' => __('DESC', 'harati'),
        ),
        'active_callback' => 'harati_is_author_posts_enabled',
    )
);