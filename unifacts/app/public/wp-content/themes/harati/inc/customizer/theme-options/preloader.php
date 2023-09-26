<?php
/*Preloader Options*/
$wp_customize->add_section(
    'preloader_options' ,
    array(
        'title' => __( 'Preloader Options', 'harati' ),
        'panel' => 'harati_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'harati_options[show_preloader]',
    array(
        'default'           => $default_options['show_preloader'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[show_preloader]',
    array(
        'label'    => __( 'Show Preloader', 'harati' ),
        'section'  => 'preloader_options',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'harati_options[preloader_style]',
    array(
        'default'           => $default_options['preloader_style'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[preloader_style]',
    array(
        'label'       => __( 'Preloader Style', 'harati' ),
        'section'     => 'preloader_options',
        'type'        => 'select',
        'choices'     => array(
            'theme-preloader-spinner-1' => __( 'Style 1', 'harati' ),
            'theme-preloader-spinner-2' => __( 'Style 2', 'harati' ),
        ),
        'active_callback' => 'harati_is_show_preloader',

    )
);
