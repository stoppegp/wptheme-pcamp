<?php
include('groups/pcamp-groups.php');
include('addtopbox.php');
include('addauthorbox.php');

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
function pcamp_latestpost( $atts, $content="" ) {
	$recent_post = wp_get_recent_posts( array('numberposts' => 1, 'post_type' => 'post', 'post_status' => 'publish', 'meta_key' => '_pcamp_top', 'meta_value' => 'false', 'meta_compare' => '!='));
	$postid = $recent_post[0]['ID'];
	setup_postdata( $GLOBALS['post'] =& get_post($postid) );
	$content = apply_filters('the_content',get_the_content(null, false));
	$ret = '<span class="post-date">Top-Meldung vom '.get_the_date(null, $postid).'</span>';
	$ret .= '<h2 class="post-title"><a href="'.get_the_permalink($postid).'">'.get_the_title($postid).'</a></h2>';
	$ret .= '<div class="entry">'.$content.'</div>';
	 return $ret;
}
function pcamp_latestpostslist( $atts, $content="" ) {
	$nr = 5;
	
	$recent_post = wp_get_recent_posts( array('numberposts' => 6, 'post_type' => 'post', 'post_status' => 'publish'));
	
	$goon = true;
	$c = -1;
	$d = 0;
	
	$ret = "<ul>";
	$topd = false;
	while ($goon) {
		$c++;
		$postid = $recent_post[$c]['ID'];
		if (!is_array($recent_post[$c])) { $goon = false; break; }
		$top = get_post_meta ( $recent_post[$c]['ID'], "_pcamp_top", true );
		echo $top;
		echo $c;
		echo ".";
		if (($top != "false") && !$topd) {
			$topd = true;
			//echo $c;
			continue;
		}
		$ret .= "<li><a href=\"".get_permalink($postid)."\">".$recent_post[$c]['post_title']."</a></li>";
		$d++;
		
		if ($d >= $nr) $goon = false;
	}
		$ret .= "</ul>";
	 return $ret;
}
function breakpart() {
	return "</div><div class=\"part\">";
}
add_shortcode( 'pcamp-sidebar', 'pcamp_sidebar' );
add_shortcode( 'breakpart', 'breakpart' );
add_shortcode( 'pcamp-latestpost', 'pcamp_latestpost' );
add_shortcode( 'pcamp-latestpostslist', 'pcamp_latestpostslist' );
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
	$wp_customize->add_setting( 'pcamp_md_enable' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'pcamp_md_publisher' , array(
	    'default'     => '',
	    'transport'   => 'refresh',
	) );
	$wp_customize->add_setting( 'pcamp_md_logo' , array(
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
$wp_customize->add_section( 'pcamp_md' , array(
    'title'      => __( 'Microdata', 'pcamp' ),
    'priority'   => 30,
) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_md_enable', array(
	'label'        => __( 'Microdata aktivieren', 'pcamp' ),
	'section'    => 'pcamp_md',
	'settings'   => 'pcamp_md_enable',
    'type'      => 'checkbox'
) ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_md_publisher', array(
	'label'        => __( 'Publisher', 'pcamp' ),
	'section'    => 'pcamp_md',
	'settings'   => 'pcamp_md_publisher',
) ) );
$wp_customize->add_control(        new WP_Customize_Image_Control(
           $wp_customize,
           'pcamp_md_logo',
           array(
               'label'      => __( 'Logo hochladen', 'pcamp' ),
               'section'    => 'pcamp_md',
               'settings'   => 'pcamp_md_logo'
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
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
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
function pcamp_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($depth > 1) { ?>
	<?php printf( __( '<cite class="fn">%s</cite> <span class="says">antwortete am</span>' ), get_comment_author_link() ); ?>
	<?php } else { ?>
	<?php printf( __( '<cite class="fn">%s</cite> <span class="says">schrieb am</span>' ), get_comment_author_link() ); ?>
	<?php } ?>
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?>: <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "(Antworten)" ) ) ); ?><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
		?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
		<br />
	<?php endif; ?>

	<?php comment_text(); ?>

	<!--<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>-->
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_steckbrief',
		'title' => 'Steckbrief',
		'fields' => array (
			array (
				'key' => 'field_5159329a6f885',
				'label' => 'desc',
				'name' => 'desc',
				'type' => 'message',
				'message' => 'Wenn Name und Bild angegeben sind, wird neben dem Artikel ein Steckbrief angezeigt. Alternativ kann der Steckbrief des Post-Autoren angezeigt werden (rechts unter "Autor-Sichtbarkeit")',
			),
			array (
				'key' => 'field_5159319f55ff7',
				'label' => 'Name des Autors',
				'name' => 'text',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_5159316655ff6',
				'label' => 'Bild des Autors',
				'name' => 'image_url',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
			),
			array (
				'key' => 'field_515931d755ff9',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'text',
				'instructions' => 'Wenn angeben, wird die komplette Steckbrief-Box verlinkt.',
				'default_value' => '',
				'formatting' => 'none',
			),
		),
		'location' => array (
			'rules' => array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
add_action('acf/input/admin_head', 'my_acf_input_admin_head');
function my_acf_input_admin_head() {
?>
<script type="text/javascript">
jQuery(function(){
  jQuery('.acf_postbox').addClass('closed');
});
</script>
<?php
}
function get_theme_dir() {
	$url = get_bloginfo('template_url');
	return parse_url($url, PHP_URL_PATH);
}
?>
