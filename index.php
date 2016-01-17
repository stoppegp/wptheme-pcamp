<?php get_header(); ?>
	<div class="cbanner">
	<span class="banner-caption">Aktuelles</span>
		<div class="post-image">

		<img src="<?php bloginfo('template_url'); ?>/res/images/defaultbild-presse.jpg" id="headerlogo"/></div>
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
					<div class="part">
						<span class="post-date"><?php the_date(); ?> </span>
						<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
						<div class="entry">
							<?php the_content("Weiterlesen... " . the_title('', '', false)); ?>
						</div>
					</div>
				<?php endwhile; ?>
				<?php get_template_part("pagelinks"); ?>
				<?php endif; ?>

</div>
<?php get_sidebar('side'); ?>
</div>
<?php get_footer(); ?>
