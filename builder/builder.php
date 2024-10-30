<?php
/**
 * Registers the Huuhadev builder element in UX Builder after load builder setup.
 *
 * @package flatsome
 */
add_action('ux_builder_setup', 'huuhadev_ux_builder_element', 20);
function huuhadev_ux_builder_element()
{
    $theme = wp_get_theme(); // gets the current theme
    if ( 'Flatsome' == $theme->parent_theme || 'Flatsome' == $theme->name) {

        require_once __DIR__ . '/shortcodes/ux_submenu_link.php';
        require_once __DIR__ . '/shortcodes/ux_verticle_menu.php';

        if (get_theme_mod('fl_portfolio', 1)) {

        }

        if (class_exists('WPCF7')) {

        }

        // WooCommerce shortcodes
        if (class_exists('WooCommerce')) {

        }
    }
}
