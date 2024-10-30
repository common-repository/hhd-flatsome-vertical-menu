<?php
/*
 * Plugin Name: HHD Flatsome Vertical Menu
 * Plugin URI: https://huuhadev.com/wordpress/plugins/hhd-flatsome-vertical-menu
 * Description: An easy to use mega menu plugin for creating beautiful, customized menus on Flatsome theme
 * Version: 2.0.0
 * Requires at least: 5.4
 * Tested up to: 5.6
 * Stable tag: 5.3.2
 * Requires PHP: 5.4
 * Author: Huu Ha Dev
 * Author URI: https://huuhadev.com/
 * Text Domain: hhdfvm
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @since     1.0
 * @copyright Copyright (c) 2014, Huu Ha
 * @author    Huu Ha
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


define( 'HHDFVM_VERSION',        '2.0.0' );
define( 'HHDFVM_SLUG',           'hhdfvm' );
define( 'HHDFVM_FILE',           __FILE__ );
define( 'HHDFVM_PATH',           realpath( plugin_dir_path( HHDFVM_FILE ) ) . '/' );
define( 'HHDFVM_URL',            plugin_dir_url( HHDFVM_FILE ) );
define( 'HHDFVM_ASSETS_URL', HHDFVM_URL . 'assets' );

if ( ! defined( 'HHDFVM_BUILDER_PATH' ) ) {
    define( 'HHDFVM_BUILDER_PATH',           HHDFVM_PATH . '/builder' );
}
// Add custom Theme Functions here
if(!function_exists('huuhadev_get_flatsome_ux_builder_path')) {
    function huuhadev_get_flatsome_ux_builder_path($path)
    {
        return get_template_directory() . '/inc/builder/' . $path;
    }
}

if(!function_exists('hhdfvm_ux_builder_thumbnail')) {
    function hhdfvm_ux_builder_thumbnail($path)
    {
        return HHDFVM_URL . '/builder/shortcodes/thumbnails/' . $path.'.svg';
    }
}

if(!function_exists('get_hhdfvm_ux_builder_directory')) {
    function get_hhdfvm_ux_builder_directory($path = '')
    {
        return HHDFVM_BUILDER_PATH.$path;
    }
}

if(!function_exists('get_hhdfvm_ux_builder_directory_shortcodes')) {
    function get_hhdfvm_ux_builder_directory_shortcodes($path)
    {
        return get_hhdfvm_ux_builder_directory('/shortcodes'.$path);
    }
}

if(!function_exists('get_hhdfvm_ux_builder_directory_templates')) {
    function get_hhdfvm_ux_builder_directory_templates($path)
    {
        ob_start();
        include get_hhdfvm_ux_builder_directory_shortcodes('/templates/'.$path);
        return ob_get_clean();
    }
}

add_action( 'plugins_loaded', '_hhdfvm_init' );
/**
 * Plugin init.
 *
 * @since 1.0
 */
function _hhdfvm_init() {
    // Nothing to do during autosave.
    if ( defined( 'DOING_AUTOSAVE' ) ) {
        return;
    }

    // Check for Flatsome theme.
    $theme = wp_get_theme(); // gets the current theme
    if ( 'Flatsome' != $theme->parent_theme) {
        return;
    }
    load_plugin_textdomain(HHDFVM_SLUG, false, dirname(plugin_basename(__FILE__)) . '/languages/' );

    // Init the plugin.
    /**
     * Customs Shortcodes.
     */
    require __DIR__ . '/shortcodes.php';
    /**
     * Load custom UX Builder
     */
    require __DIR__ . '/builder/builder.php';
}
