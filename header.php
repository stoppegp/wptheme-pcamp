<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title><?php wp_title( '»', true, "right" ); ?> <?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/res/layout_r1.css" type="text/css" media="all" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/res/favicon_r1.ico" />
	<script src="<?php bloginfo('template_url'); ?>/res/jquery-1.11.1.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/res/doubletaptogo_r1.min.js"></script>
	<script type="text/javascript">

	$(window).resize(function() {
		if ( $('#mainnav').css("position") == "fixed") {
		$( '#mainnav .main-menu-container li:has(ul)' ).doubleTapToGo();
				$('body').css("margin-top", $("#mainnav").height() + "px");
		} else {
			$('body').css("margin-top", "0");
		}
	}).resize()
		</script>
    <?php wp_head(); ?>
</head>
<body>
<div id="pagecontainer">
		<header id="mainheader">
			<a class="homelink" href="<?php bloginfo('url'); ?>"><h1>Piratenpartei</h1><h2>Baden-Württemberg</h2></a>
		</header>
		<a class="extrahomelink" id="extrahomelink" href="<?php bloginfo('url'); ?>"><h1>Piratenpartei</h1><h2>Baden-Württemberg</h2></a>
		<nav id="mainnav">
		<div id="logosmall"></div>
		<input type="checkbox" id="cbmenu" /> <label id="lmenu1" for="cbmenu">Menu  &#9660;</label><label id="lmenu2" for="cbmenu">Menu  &#9650;</label>

		<?php // wp_nav_menu( array( 'theme_location' => 'mainmenu' ) ); ?>
		<?php wp_nav_menu( array('menu_class' => 'menu',
                                    'container' => 'div',
                                    'container_class' => 'main-menu-container',
                                    'theme_location' => 'mainmenu',
                                    'walker'=> new pcamp_Nav_Menu()
                                    ) ); ?>
		<?php get_search_form(); ?>
		</nav>
		
	<div id="wrapper">








