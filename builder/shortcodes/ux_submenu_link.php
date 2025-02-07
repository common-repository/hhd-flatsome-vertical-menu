<?php
/**
 * Registers the Submenu link element in UX Builder.
 *
 * @package flatsome
 */

$flatsome_ux_menu_link_options = require huuhadev_get_flatsome_ux_builder_path('shortcodes/commons/links.php');
__DIR__ . '/commons/links.php';

$flatsome_ux_menu_link_options['options'] = flatsome_array_insert(
	$flatsome_ux_menu_link_options['options'],
	array(
		'post' => array(
			'type'       => 'select',
			'full_width' => true,
			'conditions' => '!term && !link',
			'config'     => array(
				'placeholder' => __( 'Select post..', 'flatsome' ),
				'postSelect'  => array(),
			),
		),
		'term' => array(
			'type'       => 'select',
			'full_width' => true,
			'conditions' => '!post && !link',
			'config'     => array(
				'placeholder' => __( 'Select category..', 'flatsome' ),
				'termSelect'  => array(
					'taxonomies' => array(
						'post_tag',
						'category',
						'product_cat',
						'product_tag',
					),
				),
			),
		),
	),
	0
);

$flatsome_ux_menu_link_options['options']['link']['conditions'] = '!post && !term';

add_ux_builder_shortcode('ux_submenu_link', array(
    'name' => __('Submenu link', 'flatsome'),
    'category' => __('Content', 'flatsome'),
    'info' => '{{ label }}',
    'require' => array('ux_vertical_menu'),
    'template' => get_hhdfvm_ux_builder_directory_templates('ux_submenu_link.html'),
    'wrap' => false,
    'presets' => array(
        array(
            'name' => __('Default', 'flatsome'),
            'content' => '[ux_submenu_link text="Submenu link"]',
        ),
    ),
    'options' => array(
        'block_id' => array(
            'type' => 'select',
            'heading' => __( 'Block', 'flatsome' ),
            'full_width' => true,
            'config' => array(
                'placeholder' => __( 'Select', 'flatsome' ),
                'postSelect' => array(
                    'post_type' => array( 'blocks' )
                ),
            )
        ),
        'text' => array(
            'type' => 'textfield',
            'heading' => __('Text', 'flatsome'),
            'default' => '',
            'auto_focus' => true,
        ),
        'icon' => array(
            'type' => 'select',
            'heading' => __('Icon', 'flatsome'),
            'options' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/values/icons.php'),
        ),
        'label' => array(
            'type' => 'select',
            'heading' => __('Label', 'flatsome'),
            'options' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/values/menu-labels.php'),
        ),
        'link_options' => $flatsome_ux_menu_link_options,
        'advanced_options' => require huuhadev_get_flatsome_ux_builder_path('shortcodes/commons/advanced.php')
    ),
));
