<?php
include('addtopbox.php');
include('settings.php');

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
	
	$args = array(
		'parent' => 0,
		'post_type' => 'page'
	); 
	$tlpages = get_pages( $args );
	if (is_array($tlpages) && (count($tlpages) > 0)) {
		foreach ($tlpages as $tlpage) {
			$subp = get_pages('child_of='.$tlpage->ID);
				if (is_array($subp) && (count($subp) > 0)) {
				register_sidebar( array(
					'name' => __( 'Seitengruppe: '.$tlpage->post_title, 'pcamp' ),
					'id' => 'sidebar-pagegroup-'.$tlpage->ID,
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>",
					'before_title' => '<div class="widget-title">',
					'after_title' => '</div>',
				) );
			}
		}
	}
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
	global $PCAMP_SIDEBAR_AFTER;
	if (isset($atts['title'])) $array['title'] = $atts['title'];
	$array['content'] = $content;
	if (($atts[0] == "after")) $PCAMP_SIDEBAR_AFTER[] = $array; else $PCAMP_SIDEBAR[] = $array;
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
add_image_size( 'banner', 1024, 200, true);
$args = array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption'
);
add_theme_support( 'html5', $args );


add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">weiterlesen...</a>';
}
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
