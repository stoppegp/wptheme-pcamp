<?php
include('addgroupbox.php');
add_action( 'admin_menu', 'pcamp_groups_main_menu');
function pcamp_groups_main_menu() {
//	add_menu_page( "Seitengruppen", "Seitengruppen", 'edit_theme_options', "pcamp_groups" , array('pcamp_groups', 'adminmenu'), '', 21);
	add_submenu_page( 'edit.php?post_type=page', "Seitengruppen", "Seitengruppen", 'edit_theme_options', "pcamp_groups", array("pcamp_groups", "adminmenu") );
}

  /* Add the media uploader script */
  function my_media_lib_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script( 'media-lib-uploader-js', get_template_directory_uri()."/groups/mediauploader.js", array('jquery') );
    wp_enqueue_script( 'media-lib-uploader-js' );
  }
  add_action('admin_enqueue_scripts', 'my_media_lib_uploader_enqueue');


class pcamp_groups {


	static public function adminmenu() {

		$options = get_option("pcamp-groups");		

		if ($_POST['pcamp-groups-action'] == "entry-add") {
			$data_name = htmlspecialchars(trim(stripslashes($_POST['pcamp_groups_name'])));
			$data_image = htmlspecialchars(trim(stripslashes($_POST['pcamp_groups_image'])));
			$slug = sanitize_title($data_name);
			$baseslug = $slug;
			$enr = 0;
			while (is_array($options[$slug])) {
				$enr++;
				$slug = $baseslug."-".$enr;
			}
			$options[$slug]['name'] = $data_name;
			$options[$slug]['image'] = $data_image;
			if (($data_name != "") && ($slug != "")) {
				update_option("pcamp-groups", $options);
			}
		}
		if ($_POST['pcamp-groups-action'] == "del") {
			$data_slug = $_POST['pcamp_groups_slug'];
			unset($options[$data_slug]);
			update_option("pcamp-groups", $options);
		}
		if ($_POST['pcamp-groups-action'] == "entry-edit") {
			$data_name = htmlspecialchars(trim(stripslashes($_POST['pcamp_groups_name'])));
			$data_image = htmlspecialchars(trim(stripslashes($_POST['pcamp_groups_image'])));
			$data_slug = $_POST['pcamp_groups_slug'];
			$options[$data_slug]['name'] = $data_name;
			$options[$data_slug]['image'] = $data_image;
			if (($data_name != "") && ($data_slug != "")) {
				update_option("pcamp-groups", $options);
			}
		}
		if ($_POST['pcamp-groups-action'] == "showedit") {
			$data_slug = $_POST['pcamp_groups_slug'];
			$data = $options[$data_slug];
			include(plugin_dir_path(__FILE__).'adminmenu-edit.php');
		} else {
			include(plugin_dir_path(__FILE__).'adminmenu.php');
		}

	}

	function init_sidebars() {
		$options = get_option("pcamp-groups");	
		if (is_array($options) && (count($options) > 0)) {
			foreach ($options as $slug => $c) {
				register_sidebar( array(
					'name' => __( $c['name'], 'pcamp' ),
					'id' => 'sidebar-pcamp-groups-'.$slug,
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => "</aside>",
					'before_title' => '<div class="widget-title">',
					'after_title' => '</div>',
				) );
			}
		}

	}
}

add_action( 'widgets_init', array('pcamp_groups', 'init_sidebars') );

?>
