<?php

function pcamp_customize_register( $wp_customize ) {
	$sections = array("pagetitlegroup" => "Seitenkopf", "fp" => "Startseite", "md" => "Microdata", "def" => "Standardeinstellungen");

	$options = array(
		"pagetitle"	=> array(
			"name"		=>	"Seitentitel",
			"section"	=>	"pagetitlegroup",
			"type"		=>	"text",
			"default"	=>	"Piratenpartei"
		),
		"pagesubtitle"	=> array(
			"name"		=>	"Seitenuntertitel",
			"section"	=>	"pagetitlegroup",
			"type"		=>	"text",
			"default"	=>	"Baden-Württemberg"
		),
		"kandidatenimg"	=> array(
			"name"		=>	"Seitentitel",
			"section"	=>	"pagetitlegroup",
			"type"		=>	"image",
			"default"	=>	""
		),
		"md_enable"	=> array(
			"name"		=>	"Microdata einbinden",
			"section"	=>	"md",
			"type"		=>	"checkbox",
			"default"	=>	""
		),
		"md_publisher"	=> array(
			"name"		=>	"Publisher",
			"section"	=>	"md",
			"type"		=>	"text",
			"default"	=>	""
		),
		"md_logo"	=> array(
			"name"		=>	"Logo",
			"section"	=>	"md",
			"type"		=>	"image",
			"default"	=>	""
		),
		/* Startseite */
		"fp_0text"		=> array(
			"name"		=>	"Aktionsbutton - Text",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_0url"		=> array(
			"name"		=>	"Aktionsbutton - Link",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_0image"		=> array(
			"name"		=>	"Aktionsbutton - Bild",
			"section"	=>	"fp",
			"type"		=>	"cropimage",
			"width"		=>	1024,
			"height"	=>  306,
			"default"	=>	""
		),
		"fp_1text"		=> array(
			"name"		=>	"Button 1 - Text",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_1url"		=> array(
			"name"		=>	"Button 1 - Link",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_1image"		=> array(
			"name"		=>	"Button 1 - Bild",
			"section"	=>	"fp",
			"type"		=>	"cropimage",
			"width"		=>	502,
			"height"	=>  150,
			"default"	=>	""
		),
		"fp_2text"		=> array(
			"name"		=>	"Button 2 - Text",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_2url"		=> array(
			"name"		=>	"Button 2 - Link",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_2image"		=> array(
			"name"		=>	"Button 2 - Bild",
			"section"	=>	"fp",
			"type"		=>	"cropimage",
			"width"		=>	502,
			"height"	=>  150,
			"default"	=>	""
		),
		"fp_3text"		=> array(
			"name"		=>	"Button 3 - Text",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_3url"		=> array(
			"name"		=>	"Button 3 - Link",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_3image"		=> array(
			"name"		=>	"Button 3 - Bild",
			"section"	=>	"fp",
			"type"		=>	"cropimage",
			"width"		=>	502,
			"height"	=>  150,
			"default"	=>	""
		),
		"fp_4text"		=> array(
			"name"		=>	"Button 4 - Text",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_4url"		=> array(
			"name"		=>	"Button 4 - Link",
			"section"	=>	"fp",
			"type"		=>	"text",
			"default"	=>	""
		),
		"fp_4image"		=> array(
			"name"		=>	"Button 4 - Bild",
			"section"	=>	"fp",
			"type"		=>	"cropimage",
			"width"		=>	502,
			"height"	=>  150,
			"default"	=>	""
		),
		"def_news"		=> array(
			"name"		=>	"Seitenkopf News",
			"section"	=>	"def",
			"type"		=>	"image",
			"default"	=>	""
		),
	);

	$prio = 1000;
	if (is_array($sections) && (count($sections) > 0)) {
		foreach ($sections as $slug => $name) {
			$wp_customize->add_section( 'pcamp_'.$slug , array(
				'title'      => __( $name, 'pcamp' ),
				'priority'   => $prio++,
			) );
		}
	}

	if (is_array($options) && (count($options) > 0)) {
		foreach ($options as $slug => $opt) {
			$wp_customize->add_setting( 'pcamp_'.$slug , array(
				'default'     => $opt['default']
			) );
			switch ($opt['type']) {
			case "text":
				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_'.$slug, array(
					'label'        => __( $opt['name'], 'mytheme' ),
					'section'    => 'pcamp_'.$opt['section'],
					'settings'   => 'pcamp_'.$slug
				) ) );
				break;
			case "image":
				$wp_customize->add_control( new WP_Customize_Media_Control($wp_customize,
				   'pcamp_'.$slug,
				   array(
					   'label'      => __( $opt['name'], 'pcamp' ),
					   'section'    => 'pcamp_'.$opt['section'],
					   'settings'   => 'pcamp_'.$slug,
					   'mime_type'	=> 'image'
				   )
				) );
				break;
			case "cropimage":
				$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize,
				   'pcamp_'.$slug,
				   array(
					   'label'      => __( $opt['name'], 'pcamp' ),
					   'section'    => 'pcamp_'.$opt['section'],
					   'settings'   => 'pcamp_'.$slug,
					   'width'		=> $opt['width'],
					   'height'		=> $opt['height'],
				   )
				) );
				break;
			case "checkbox":
				$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pcamp_'.$slug, array(
					'label'        => __( $opt['name'], 'mytheme' ),
					'section'    => 'pcamp_'.$opt['section'],
					'settings'   => 'pcamp_'.$slug,
					 'type'      => 'checkbox'
				) ) );
				break;
			}
		}
	}
}
add_action( 'customize_register', 'pcamp_customize_register' );
?>
