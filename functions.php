<?php
include('groups/pcamp-groups.php');

function pcamp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Artikelübersicht-Sidebar', 'pcamp' ),
		'id' => 'sidebar-side',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Einzelartikel-Sidebar', 'pcamp' ),
		'id' => 'sidebar-single',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Standard Seiten-Sidebar', 'pcamp' ),
		'id' => 'sidebar-side2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => __( 'Header-Sidebar', 'pcamp' ),
		'id' => 'sidebar-header',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
}



function register_my_menus() {
	register_nav_menus(
		array(
		'mainmenu' => __( 'Hauptmenu' ),
		'footermenu' => __( 'Footermenu' )
		)
	);
}
function pcamp_sidebar( $atts, $content="" ) {
	global $PCAMP_SIDEBAR;
	if ($atts['title']) $array['title'] = $atts['title'];
	$array['content'] = $content;
	 $PCAMP_SIDEBAR[] = $array;
	 return "";
}
function breakpart() {
	return "</div><div class=\"part\">";
}
add_shortcode( 'pcamp-sidebar', 'pcamp_sidebar' );
add_shortcode( 'breakpart', 'breakpart' );
add_action( 'widgets_init', 'pcamp_widgets_init' );
add_action( 'init', 'register_my_menus' );
add_filter('widget_text', 'do_shortcode');
add_theme_support('post-thumbnails');
$args = array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption'
);
add_theme_support( 'html5', $args );


function pcamp_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'pcamp_pagetitle' , array(
	    'default'     => 'Piratenpartei',
	    'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'pcamp_pagesubtitle' , array(
	    'default'     => 'Baden-Württemberg',
	    'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'pcamp_kandidatenimg' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	) );
$wp_customize->add_section( 'pcamp_pagetitlegroup' , array(
    'title'      => __( 'Seitenkopf', 'pcamp' ),
    'priority'   => 30,
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_pagetitle', array(
	'label'        => __( 'Seitentitel', 'mytheme' ),
	'section'    => 'pcamp_pagetitlegroup',
	'settings'   => 'pcamp_pagetitle',
) ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_pagesubtitle', array(
	'label'        => __( 'Seitenuntertitel', 'mytheme' ),
	'section'    => 'pcamp_pagetitlegroup',
	'settings'   => 'pcamp_pagesubtitle',
) ) );
$wp_customize->add_control(        new WP_Customize_Image_Control(
           $wp_customize,
           'kandidatenimg',
           array(
               'label'      => __( 'Headerbild hochladen', 'pcamp' ),
               'section'    => 'pcamp_pagetitlegroup',
               'settings'   => 'pcamp_kandidatenimg',
           )
       ) );
}
add_action( 'customize_register', 'pcamp_customize_register' );

class pcamp_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;           

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

                // new addition for active class on the a tag
                if(in_array('current-menu-item', $classes)) {
                    $attributes .= ' class="active"';
                }

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
       /**
         * Starts the list before the elements are added.
         *
         * @see Walker::start_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
                $indent = str_repeat("\t", $depth);
                $output .= "\n$indent<div class=\"lvl\"><ul class=\"sub-menu\">\n";
        }

        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker::end_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
                $indent = str_repeat("\t", $depth);
                $output .= "$indent</ul></div>\n";
        }
}

?>
