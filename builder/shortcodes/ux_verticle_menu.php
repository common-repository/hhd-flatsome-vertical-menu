<?php
/**
 * Registers the Verticel Menu element in UX Builder.
 *
 * @package flatsome
 */
$layoutOptions = require( huuhadev_get_flatsome_ux_builder_path('shortcodes/commons/repeater-options.php') );
$layoutOptions['options']['type']['default'] = 'row';
$layoutOptions['options']['type']['options'] = [
    'row' => 'Row'
];
add_ux_builder_shortcode('ux_vertical_menu', array(
    'type' => 'container',
    'name' => __('Vertical Menu', 'flatsome'),
    'category' => __('Content', 'flatsome'),
    'allow' => array('ux_menu_title', 'ux_submenu_link'),
    'thumbnail' => hhdfvm_ux_builder_thumbnail('ux_verticale_menu'),
    'template' => get_hhdfvm_ux_builder_directory_templates('ux_vertical_menu.html'),
    'info' => '{{ label }}',
    'nested' => true,
    'scripts' => array(
        'huuhadev-vertical-menu-script' => get_stylesheet_directory_uri() . '/assets/js/huuhadev-vertical-menu.js'
    ),
    'styles' => array(
        'huuhadev-vertical-menu-style' => get_stylesheet_directory_uri() . '/assets/css/huuhadev-vertical-menu.css',
    ),
    'presets' => array(
        array(
            'name' => __('Default', 'flatsome'),
            'content' => '
				[ux_vertical_menu divider="solid"]
					[ux_submenu_link text="Menu link 1"]
					[ux_submenu_link text="Menu link 2"]
					[ux_submenu_link text="Menu link 3"]
					[ux_submenu_link text="Menu link 4"]
				[/ux_vertical_menu]
			',
        ),
    ),
    'options' => array(
        'behavior' => array(
            'type' => 'select',
            'heading' => __('Reveal', 'flatsome'),
            'default' => 'hover',
            'options' => [
                'hover' => __('On hover', 'flatsome'),
                'click' => __('On click', 'flatsome'),
            ],
        ),
        'divider' => array(
            'type' => 'radio-buttons',
            'heading' => __('Divider', 'flatsome'),
            'responsive' => true,
            'default' => '',
            'options' => array(
                '' => array('title' => __('None', 'flatsome')),
                'solid' => array('title' => __('Solid', 'flatsome')),
            ),
        ),
        'layout_options' => array(
            'type' => 'group',
            'heading' => __('Layout', 'flatsome'),
            'options' => array(
                'design' => array(
                    'type' => 'select',
                    'heading' => __('Design', 'flatsome'),
                    'default' => 'container-width',
                    'options' => [
                        'container-width' => __('Container width', 'flatsome'),
                        'full-width' => __('Full width', 'flatsome'),
                    ],
                ),
                'bg' => array(
                    'type' => 'image',
                    'heading' => __( 'BG Image' ),
                    'thumb_size' => 'bg_size',
                ),
                'bg_color' => array(
                    'type' => 'colorpicker',
                    'heading' => __('Bg Color'),
                    'format' => 'rgb',
                    'alpha' => true,
                    'position' => 'bottom right',
                    'helpers' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/helpers/colors.php')
                ),
                'height' => array(
                    'type' => 'scrubfield',
                    'responsive' => true,
                    'heading' => __('Height content'),
                    'default' => '',
                    'placeholder' => __('Auto'),
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                    'helpers' => require huuhadev_get_flatsome_ux_builder_path('/shortcodes/helpers/heights.php'),
                ),
                'style' => array( //row
                    'type' => 'radio-buttons',
                    'heading' => 'Column Spacing',
                    'full_width' => true,
                    'default' => '',
                    'options' => array(
                        '' => array( 'title' => 'Normal'),
                        'small' => array( 'title' => 'Small' ),
                        'large' => array( 'title' => 'Large' ),
                        'collapse' => array( 'title' => 'Collapse' ),
                    ),
                ),

                'padding' => array(
                    'type' => 'margins',
                    'heading' => 'Padding',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ),

                'margin' => array(
                    'type' => 'margins',
                    'heading' => 'Margin',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                ),
            ),
        ),
        'left_options' => array(
            'type' => 'group',
            'heading' => __('Left col options', 'flatsome'),
            'options' => array(
                'span' => array( //col
                    'type' => 'col-slider',
                    'heading' => 'Width',
                    'full_width' => true,
                    'responsive' => true,
                    'auto_focus' => true,
                    'default' => 4,
                    'max' => 8,
                    'min' => 1,
                ),

                'align' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Text align',
                    'default' => '',
                    'options' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/values/align-radios.php')
                ),
                'col_style' => array(
                    'type' => 'radio-buttons',
                    'heading' => 'Column Style',
                    'full_width' => true,
                    'default' => '',
                    'options' => array(
                        '' => array( 'title' => 'Normal'),
                        'divided' => array( 'title' => 'Divided'),
                        'dashed' => array( 'title' => 'Dashed'),
                        'solid' => array( 'title' => 'Solid'),
                    ),
                ),
                'col_padding' => array(
                    'type' => 'margins',
                    'heading' => 'Padding',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ),

                'col_margin' => array(
                    'type' => 'margins',
                    'heading' => 'Margin',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                ),
                'col_bg_color' => array(
                    'type' => 'colorpicker',
                    'heading' => __('Bg color'),
                    'format' => 'rgb',
                    'alpha' => true,
                    'position' => 'bottom right',
                    'helpers' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/helpers/colors.php')
                ),
                'text_depth' => array(
                    'type' => 'slider',
                    'heading' => __('Text Shadow'),
                    'default' => '0',
                    'unit' => '+',
                    'max' => '5',
                    'min' => '0',
                ),
            ),
        ),
        'right_options' => array(
            'type' => 'group',
            'heading' => __('Right content', 'flatsome'),
            'options' => array(
                'right_padding' => array(
                    'type' => 'margins',
                    'heading' => 'Padding',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ),
                'right_margin' => array(
                    'type' => 'margins',
                    'heading' => 'Margin',
                    'full_width' => true,
                    'responsive' => true,
                    'min' => -500,
                    'max' => 500,
                    'step' => 1,
                ),
                'right_bg_color' => array(
                    'type' => 'colorpicker',
                    'heading' => __('Bg Color'),
                    'format' => 'rgb',
                    'alpha' => true,
                    'position' => 'bottom right',
                    'helpers' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/helpers/colors.php')
                ),
            )
        ),
        'advanced_options' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/commons/advanced.php')
    ),
));
