<?php
/*Header Options*/
$wp_customize->add_section(
    'general_settings' ,
    array(
        'title' => __( 'General Settings', 'harati' ),
        'panel' => 'harati_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'harati_options[show_lightbox_image]',
    array(
        'default'           => $default_options['show_lightbox_image'],
        'sanitize_callback' => 'harati_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'harati_options[show_lightbox_image]',
    array(
        'label'    => __( 'Show LightBox Image', 'harati' ),
        'section'  => 'general_settings',
        'type'     => 'checkbox',
    )
);
