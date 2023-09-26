<?php
$wp_customize->add_section(
    'pagination_options' ,
    array(
        'title' => __( 'Pagination Options', 'harati' ),
        'panel' => 'harati_option_panel',
    )
);

/* Pagination Type*/
$wp_customize->add_setting(
    'harati_options[pagination_type]',
    array(
        'default'           => $default_options['pagination_type'],
        'sanitize_callback' => 'harati_sanitize_select',
    )
);
$wp_customize->add_control(
    'harati_options[pagination_type]',
    array(
        'label'       => __( 'Pagination Type', 'harati' ),
        'section'     => 'pagination_options',
        'type'        => 'select',
        'choices'     => array(
            'default' => __( 'Default (Older / Newer Post)', 'harati' ),
            'numeric' => __( 'Numeric', 'harati' ),
            'ajax_load_on_click' => __( 'Load more post on click', 'harati' ),
            'ajax_load_on_scroll' => __( 'Load more posts on scroll', 'harati' ),
        ),
    )
);
