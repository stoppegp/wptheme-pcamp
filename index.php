<?php
if (get_theme_mod( 'pcamp_md_enable', false )) $incmicrodata = true;
?>
<?php get_header(); ?>
	<div class="cbanner">
	<span class="banner-caption">Aktuelles</span>
		<div class="post-image">

		<?php
			if (get_theme_mod( 'pcamp_def_news', false )) {
				$himg = get_attachment_by_url(get_theme_mod( 'pcamp_def_news', false ), "banner")[0];
			} else {
				$himg = get_bloginfo('template_url')."/res/images/defaultbild-presse.jpg";
			}
		?>

		<img src="<?php echo $himg; ?>" id="headerlogo"/></div>
</div>
		<div class="content">

			<div class="cleft">			
				<?php // The Query ?>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args=array(
				'posts_per_page'=>5,
				'caller_get_posts'=>1,
				'paged'=>$paged,
				);
				//query_posts($args);?>
	 
				<?php // The Loop ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="part" <?php echo ($incmicrodata) ? 'itemscope itemtype="http://schema.org/NewsArticle"' : ''; ?>>
						<span class="post-date"><?php the_date(); ?> </span>
						<h2 class="post-title"><a href="<?php the_permalink() ?>"><span <?php echo ($incmicrodata) ? 'itemprop="headline"' : ''; ?>><?php the_title(); ?></span></a></h2>
						<div class="entry">
							<?php the_content("Weiterlesen... " . the_title('', '', false)); ?>
						</div>
						<?php if ($incmicrodata) { ?>
							  <meta itemprop="url" content="<?php the_permalink(); ?>">
						 <meta itemprop="datePublished" content="<?php echo get_the_date("c"); ?>">
						   <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							  <meta itemprop="url" content="<?php echo get_theme_mod( 'pcamp_md_logo', '' ); ?>">
							</div>
							<meta itemprop="name" content="<?php echo get_theme_mod( 'pcamp_md_publisher', '' ); ?>">
						  </div>
						<?php 
						if ( has_post_thumbnail() ) { 
						  ?>		
						<div class="post-image" <?php echo ($incmicrodata) ? 'itemprop="image" itemscope itemtype="http://schema.org/ImageObject"' : ''; ?>><?php if ($incmicrodata) { echo '<meta itemprop="url" content="'; the_post_thumbnail_url(); echo '">'; } ?></div>
						<?php } ?>
						<?php } ?>
					</div>
				<?php endwhile; ?>
				<?php get_template_part("pagelinks"); ?>
				<?php endif; ?>

</div>
<?php get_sidebar('side'); ?>
</div>
<?php get_footer(); ?>
