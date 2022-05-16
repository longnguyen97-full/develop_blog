<?php
/**
 * https://preview.themeforest.net/item/passion-magazine-html5-template/full_screen_preview/6467868?_ga=2.74248151.470902490.1605255644-1870388611.1586163227
 * https://developer.wordpress.org/reference/hooks/customize_register/
 * https://developer.wordpress.org/reference/classes/wp_customize_manager/
 * https://thachpham.com/wordpress/wordpress-development/starter-theme-tao-customize-cho-giao-dien.html
 * get_theme_mod('stheme_options')
 */
function themename_customize_register($wp_customize){
    $wp_customize->add_section('theme_section_sample', array(
        'title'    => __('Sample', 'themename'),
        'description' => 'Mô tả sample',
        'priority' => 120,
    ));
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[text_test]', array(
        'default'        => 'value_xyz',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('themename_text_test', array(
        'section'    => 'theme_section_sample',
        'settings'   => 'themename_theme_options[text_test]',
        'label'      => __('Text Test', 'themename'),
    ));
    //  =============================
    $wp_customize->add_setting('themename_theme_options[text_test2]', array(
        'default'        => 'value_xyz2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('themename_text_test2', array(
        'section'    => 'theme_section_sample',
        'settings'   => 'themename_theme_options[text_test2]',
        'label'      => __('Text Test', 'themename'),
    ));
    //  =============================
    //  = Radio Input               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[color_scheme]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('themename_color_scheme', array(
        'section'    => 'theme_section_sample',
        'settings'   => 'themename_theme_options[color_scheme]',
        'label'      => __('Color Scheme', 'themename'),
        'type'       => 'radio',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
    //  =============================
    //  = Checkbox                  =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[checkbox_test]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));
    $wp_customize->add_control('display_header_text', array(
        'section'  => 'theme_section_sample',
        'settings' => 'themename_theme_options[checkbox_test]',
        'label'    => __('Display Header Text'),
        'type'     => 'checkbox',
    ));
    //  =============================
    //  = Select Box                =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[header_select]', array(
        'default'        => 'value2',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( 'example_select_box', array(
        'section' => 'theme_section_sample',
        'settings' => 'themename_theme_options[header_select]',
        'label'   => 'Select Something:',
        'type'    => 'select',
        'choices'    => array(
            'value1' => 'Choice 1',
            'value2' => 'Choice 2',
            'value3' => 'Choice 3',
        ),
    ));
    //  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[image_upload_test]', array(
        'default'           => 'image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'section'  => 'theme_section_sample',
        'settings' => 'themename_theme_options[image_upload_test]',
        'label'    => __('Image Upload Test', 'themename'),
    )));
    //  =============================
    //  = File Upload               =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[upload_test]', array(
        'default'           => 'arse',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
        'section'  => 'theme_section_sample',
        'settings' => 'themename_theme_options[upload_test]',
        'label'    => __('Upload Test', 'themename'),
    )));
    //  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[link_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'section'  => 'theme_section_sample',
        'settings' => 'themename_theme_options[link_color]',
        'label'    => __('Link Color', 'themename'),
    )));
    //  =============================
    //  = Page Dropdown             =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[page_test]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('themename_page_test', array(
        'section'    => 'theme_section_sample',
        'settings'   => 'themename_theme_options[page_test]',
        'label'      => __('Page Test', 'themename'),
        'type'    => 'dropdown-pages',
    ));
    // =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('themename_theme_options[cat_test]', array(
        'default' => $default
    ));
    $wp_customize->add_control( 'cat_select_box', array(
        'section'  => 'theme_section_sample',
        'settings' => 'themename_theme_options[cat_test]',
        'label'   => 'Select Category:',
        'type'    => 'select',
        'choices' => $cats,
    ));


    $wp_customize->add_setting( 'stheme_options[logo_url]', array(
        'default' => '',
        // 'type' => 'option',
        'capability' => 'edit_theme_options',
        'transport' => 'postMessage',
        )
);
$wp_customize->add_control( 'stheme_logo_url', array(
        'label' => __( 'Logo Url', 'html5blank' ),
        'section' => 'theme_section_sample',
        'settings' => 'stheme_options[logo_url]',
        'type' => 'textarea',
        'priority' => 10,
        )
);
}
add_action('customize_register', 'themename_customize_register');
