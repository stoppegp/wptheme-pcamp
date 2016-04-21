<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<title><?php wp_title( '»', true, "right" ); ?><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" href="<?php echo get_theme_dir(); ?>/res/layout_r7.css" type="text/css" media="all" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/res/favicon_r1.ico" />
	<script src="<?php bloginfo('template_url'); ?>/res/jquery-1.11.1.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/res/doubletaptogo_r1.min.js"></script>
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
<script>
$(document).ready(function() {
	$("a, input").focus(function() {
		$("#mainnav li").removeClass("hover");
		if ($(this).is("#mainnav a")) {
			$(this).parentsUntil("#mainnav > div > ul", "li").addClass("hover");
		}
	});	

});
</script>
    <?php wp_head(); ?>
</head>
<body>
<div id="iecontainer">
<div id="pagecontainer">
		<header id="mainheader">
			<?php $kandidatenimg = absint(get_theme_mod( 'pcamp_kandidatenimg', '' )); 
			if ($kandidatenimg) {?>
		<img id="headerimage" src="<?php echo wp_get_attachment_image_src($kandidatenimg, array(500, 500))[0]; ?>">
<?php } ?>
			<a class="homelink" href="<?php bloginfo('url'); ?>"><h1><?php echo get_theme_mod( 'pcamp_pagetitle', 'Piratenpartei' ); ?>
</h1><h2><?php echo get_theme_mod( 'pcamp_pagesubtitle', 'Baden-Württemberg' ); ?></h2></a>
		</header>
		<a class="extrahomelink" id="extrahomelink" href="<?php bloginfo('url'); ?>"><h1>Piratenpartei</h1><h2>Baden-Württemberg</h2></a>
		<input type="checkbox" id="cbmenu" />
		<nav id="mainnav">
				 <label id="lmenu" for="cbmenu"><span></span><span></span><span></span></label>
		<div>

		<?php // wp_nav_menu( array( 'theme_location' => 'mainmenu' ) ); ?>
		<?php wp_nav_menu( array('menu_class' => 'menu',
                                    'container' => 'div',
                                    'container_class' => 'main-menu-container',
                                    'theme_location' => 'mainmenu',
                                    'walker'=> new pcamp_Nav_Menu()
                                    ) ); ?>
		<?php get_search_form(); ?>
		</div>
		</nav>
		<div id="shadowbox"></div>
	<div id="wrapper">
