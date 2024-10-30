<?php
/**
 * Renders the `ux_submenu_link` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */
function hhdfvm_render_ux_submenu_link_shortcode( $atts, $content, $tag ) {
    global $wp_query;
    $atts = shortcode_atts(
        array(
            'visibility' => '',
            'block_id' => '',
            'behavior' => '',
            'class'      => '',
            'text'       => '',
            'label'      => '',
            'icon'       => '',
            'post'       => '',
            'term'       => '',
            'link'       => '',
            'target'     => '_self',
            'rel'        => '',
        ),
        $atts,
        $tag
    );
    $block_id = $atts['block_id'];
    $design = $atts['design'];

    $object            = null;
    $object_id         = null;
    $object_type       = null;
    $queried_object    = $wp_query->get_queried_object();
    $queried_object_id = (int) $wp_query->queried_object_id;

    $classMenu = array( 'ux-menu-link flex menu-item' );
    $link    = trim( $atts['link'] );
    $icon    = $atts['icon'] ? get_flatsome_icon( 'ux-menu-link__icon text-center ' . $atts['icon'] ) : '';

    if ( ! empty( $atts['post'] ) ) {
        $object_type = 'post_type';
        $object_id   = (int) $atts['post'];
        $object      = get_post( $object_id );
        $link        = get_permalink( $object_id );
    } elseif ( ! empty( $atts['term'] ) ) {
        $object_type = 'taxonomy';
        $object_id   = (int) $atts['term'];
        $object      = get_term_by( 'term_taxonomy_id', $object_id );
        $link        = get_term_link( $object_id );
    }

    if ( ! is_string( $link ) ) {
        $link = '';
    }

    // Ensure paths (except hash) are rendered as full URLs.
    if ( substr( $link, 0, 1 ) !== '#' && ! wp_http_validate_url( $link ) ) {
        $link = site_url( $link );
    }

    if ( ! empty( $atts['class'] ) )      $classMenu[] = $atts['class'];
    if ( ! empty( $atts['label'] ) )      $classMenu[] = $atts['label'];
    if ( ! empty( $atts['visibility'] ) ) $classMenu[] = $atts['visibility'];

    if (
        $object &&
        $queried_object &&
        $queried_object_id === $object_id &&
        (
            ( $object_type === 'post_type' && $wp_query->is_singular ) ||
            ( $object_type === 'taxonomy' && $queried_object->taxonomy === $object->taxonomy )
        )
    ) {
        $classMenu[] = 'ux-menu-link--active';
    }

    $link_rels = explode( ' ', $atts['rel'] );
    $link_atts = array(
        'target' => $atts['target'],
        'rel'    => array_filter( $link_rels ),
    );
    if(!empty($block_id)){
        $classMenu[] = " has-dropdown";
        if($design == 'full-right') {
            $classMenu[] = 'submenu-design-full-left';
        }
    }
    ob_start();

    ?>
    <div class="<?php echo esc_attr( implode( ' ', $classMenu ) ); ?>">
        <a class="ux-menu-link__link flex" href="<?php echo esc_attr( $link ); ?>"<?php echo flatsome_parse_target_rel( $link_atts ); ?>>
            <?php echo $icon; ?>
            <span class="ux-menu-link__text">
				<?php echo esc_html( $atts['text'] ); ?>
			</span>
        </a>
        <?php if(!empty($block_id)){ ?>
            <div class="sub-menu nav-dropdown nav-dropdown-full-width">
                <?php echo do_shortcode( '[block id="' . $block_id . '"]' ); ?>
            </div>
        <?php } ?>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode( 'ux_submenu_link', 'hhdfvm_render_ux_submenu_link_shortcode' );


// Register scripts
function hhdfvm_shortcode_scripts() {
    wp_register_style( 'huuhadev-vertical-menu-style', plugin_dir_url(__FILE__) . '/assets/css/huuhadev-vertical-menu.css');
    wp_register_script( 'huuhadev-vertical-menu-script', plugin_dir_url(__FILE__) . '/assets/js/huuhadev-vertical-menu.js');
}
add_action( 'wp_enqueue_scripts', 'hhdfvm_shortcode_scripts' );

/**
 * Renders the `ux_vertical_menu` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */
function hhdfvm_render_ux_vertical_menu_shortcode( $atts, $content, $tag ) {
    extract( $atts = shortcode_atts( array(
        '_id' => 'vertical-menu-'.rand(),
        'visibility' => '',
        'class'      => 'huuhadev-vertical-menu',
        'divider'    => '',
        'behavior'    => '',
        'design' => 'full-width',
        'bg' => '',
        'bg_color' => '',
        'padding' => '',
        'margin' => '',
        'style' => 'small',
        'height' => '',
        'depth' => '',
        'depth_hover' => '',
        //Col style
        'span' => '4',
        'span__md' => isset( $atts['span'] ) ? $atts['span'] : '',
        'align' => 'left',
        'text_depth' => '',
        'col_padding' => '',
        'col_margin' => '',
        'col_bg_color' => '',
        'right_padding' => '',
        'right_margin' => '',
        'right_bg_color' => '',
    ), $atts ) );
    wp_enqueue_style('huuhadev-vertical-menu-style');
    wp_enqueue_script('huuhadev-vertical-menu-script');

    // Vertical menu class
    $classMenu = array( 'ux-menu', 'stack', 'stack-col', 'justify-start', 'menu-inner' );
    /* Full height banner */
    if(strpos($height, '100%') !== false) {
        $classMenu[] = 'is-full-height';
    }

    if ( $class )      $classMenu[] = $class;
    if ( $divider )    $classMenu[] = 'ux-menu--divider-' . $divider;
    if ( $visibility ) $classMenu[] = $visibility;
    // Depth
    if($depth) $classMenu[] = 'box-shadow-'.$depth;
    if($depth_hover) $classMenu[] = 'box-shadow-'.$depth_hover.'-hover';

    //Row class
    $classRow[] = 'row';

    // Add Row style
    if($style) $classRow[] = 'row-'.$style;

    // Column style
    if($col_style) $classRow[] = 'row-'.$col_style;

    // Add Row Width
    $classRow[] = ($design == 'full-width') ? 'row-full-width' : 'row-collapse';

    // Add background image
    if($bg) {
        $bg = flatsome_get_image_url($bg);
    }

    $classCol[] = 'col';
    if($span__md) $classCol[] = 'medium-'.$span__md;
    if($span) $classCol[] = 'large-'.$span;


    $classInner[] = 'col-inner vertical-menu';
    if($behavior == 'click'){
        $classInner[] = 'nav-dropdown-click';
    }else{
        $classInner[] = 'nav-dropdown-hover';
    }
    // Add Align Class
    if($align) $classInner[] = 'text-'.$align;
    // Add Depth Class
    if($text_depth) $classInner[] = 'text-shadow-'.$text_depth;

    // Inline CSS
    $css_args = array(
        'height'          => array(
            'attribute' => 'height',
            'value'     => $height,
        ),
        'padding'          => array(
            'attribute' => 'padding',
            'value'     => $padding
        ),
        'margin'    => array(
            'attribute' => 'margin',
            'value'     => $margin
        ),
        'bg_color'      => array(
            'attribute' => 'background-color',
            'value'     => $bg_color,
        ),
    );
    if(!empty($bg)){
        $css_args['bg'] = array(
            'attribute' => 'background-image',
            'value'     => 'url('.$bg.')',
        );
    }

    $col_args = array(
        'col_padding' => array(
            'selector' => ' > .row > .col > .col-inner',
            'property' => 'padding',
        ),
        'col_margin' => array(
            'selector' => ' > .row > .col > .col-inner',
            'property' => 'margin',
        ),
        'col_bg_color' => array(
            'selector' => ' > .row > .col > .col-inner',
            'property' => 'background-color',
        )
    );
    ob_start();
    ?>

    <!--Vertical menu -->
    <div id="<?php echo $_id; ?>" class="<?php echo esc_attr( implode( ' ', $classMenu ) ); ?>" <?php echo get_shortcode_inline_css( $css_args ); ?>>
        <!--Row-->
        <div  class="<?php echo esc_attr( implode( ' ', $classRow ) ); ?>">
            <!--Col-->
            <div  class="<?php echo esc_attr( implode( ' ', $classCol ) ); ?>" >
                <!--Col Inner-->
                <div class="<?php echo esc_attr( implode( ' ', $classInner ) ); ?>">
                    <?php echo flatsome_contentfix( $content ); ?>
                </div>
            </div>
        </div>
        <?php echo ux_builder_element_style_tag($_id, $col_args, $atts) ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'ux_vertical_menu', 'hhdfvm_render_ux_vertical_menu_shortcode' );
