<?php
class ThemeSettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $conf;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_page_menu'));
        add_action('admin_init', array($this, 'add_page_fields'));
        $this->conf = array(
            array(
                'name'   => 'theme_section_tab1',
                'label'  => 'Tab 1',
                'html'   => 'print_section_html111',
                'fields' => array(
                    array(
                        'name'  => 'theme_field_slug1',
                        'label' => 'Field 1',
                        'html'  => 'text', // Type
                        'option_name'     => 'theme_option',
                        'option_sanitize' => 'sanitize_save',
                    )
                )
            )
        );
    }

    /**
     * Add options page
     */
    public function add_page_menu()
    {
        add_menu_page(
            'Theme Settings',
            'Theme Settings',
            'manage_options',
            'theme-settings',
            array($this, 'print_page_html'),
            ''
            ,
            99
        );
    }

    /**
     * Options page callback
     */
    public function print_page_html()
    {
        // Set class property
        $this->options = get_option('theme_option');
        var_dump($this->options);
        ?>
        <div class="wrap">
            <h1>Theme Settings</h1>
            <form method="post" action="options.php">
            <?php
            // This prints out all hidden setting fields
            settings_fields('theme_option');
            do_settings_sections('theme_section_tab1');
            submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function add_page_fields()
    {
        // /**
        //  * theme_option
        //  * Option
        //  */
        // register_setting(
        //     'theme_option', // Option group
        //     'theme_option', // Option name
        //     array($this, 'sanitize_save') // Sanitize
        // );

        // /**
        //  * theme_section_tab1
        //  * Section
        //  * Option > Section
        //  */
        // add_settings_section(
        //     'theme_section_tab1', // ID
        //     'Tab Settings 1', // Title
        //     array($this, 'print_section_html'), // Callback
        //     'theme_sections' // Page (sections)
        // );

        // /**
        //  * theme_section_tab2
        //  * Section
        //  * Option > Section
        //  */
        // add_settings_section(
        //     'theme_section_tab2', // ID
        //     'Tab Settings 2', // Title
        //     array($this, 'print_section_html'), // Callback
        //     'theme_sections' // Page (sections)
        // );

        // /**
        //  * Field
        //  * Option > Section > Field
        //  */
        // add_settings_field(
        //     'id_number', // ID
        //     'ID Number', // Title
        //     array($this, 'id_number_callback'), // Callback
        //     'theme_sections', // Page (sections)
        //     'theme_section_tab1' // Section
        // );

        // /**
        //  * Field
        //  * Option > Section > Field
        //  */
        // add_settings_field(
        //     'title',
        //     'Title',
        //     array($this, 'title_callback'),
        //     'theme_sections', // Page (sections)
        //     'theme_section_tab1'
        // );

        // /**
        //  * Field
        //  * Option > Section > Field
        //  */
        // add_settings_field(
        //     'theme_field_slug',
        //     'Text',
        //     array($this, 'text_callback'),
        //     'theme_sections', // Page (sections)
        //     'theme_section_tab2',
        //     array(
        //         'label_for' => 'theme_field_slug',
        //         'class' => 'theme_field_slug',
        //         'field_name' => 'theme_field_slug',
        //         'option_name' => 'theme_option',
        //     )
        // );

        foreach ($this->conf as $s_key => $section) {
            add_settings_section(
                $section['name'], // Section ID
                $section['label'], // Section Title
                // array($this, $section['html']), // Callback (String)
                array($this, function($section){
                    echo $section['html'];
                }), // Callback (String)
                $section['name'] // Page (sections)
            );
            foreach ($section['fields'] as $f_key => $field) {
                register_setting(
                    $field['name'], // Option group
                    $field['name'], // Option name
                    array($this, $field['option_sanitize']) // Sanitize
                );
                add_settings_field(
                    $field['name'], // Field ID
                    $field['label'], // Field Title
                    array($this, $field['html'] . '_callback'), // Callback (Type)
                    $section['name'], // Page (sections)
                    $section['name'], // Section ID
                    array(
                        'label_for'   => $field['name'],
                        'class'       => $field['name'],
                        'field_name'  => $field['name'],
                        'option_name' => $field['name'],
                    )
                );
            }
        }
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize_save($input)
    {
        $new_input = array();
        if (isset($input['id_number'])) {
            $new_input['id_number'] = absint($input['id_number']);
        }

        if (isset($input['title'])) {
            $new_input['title'] = sanitize_text_field($input['title']);
        }

        if (isset($input['theme_field_slug'])) {
            $new_input['theme_field_slug'] = sanitize_text_field($input['theme_field_slug']);
        }

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_html($args)
    {
        var_dump($args);
        print 'Enter your settings below:';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="theme_option[id_number]" value="%s" />',
            isset($this->options['id_number']) ? esc_attr($this->options['id_number']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="theme_option[title]" value="%s" />',
            isset($this->options['title']) ? esc_attr($this->options['title']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function text_callback($args)
    {
        printf(
            '<input type="text" id="%s" name="%s[%s]" value="%s">',
            $args['field_name'], // ID
            $args['option_name'], // Input Name
            $args['field_name'], // Input Name
            $this->get_field_name($args['field_name']) // Value
        );
    }

    public function get_field_name($name)
    {
        return isset($this->options[$name]) ? esc_attr($this->options[$name]) : '';
    }
}

if (is_admin()) {
    $theme_settings_page = new ThemeSettingsPage();
}
