
<?php get_header(); ?>

	<div class="cbanner">
		<div class="post-image">
		<img src="<?php echo $group['image']; ?>" id="headerlogo"/></div>
		<span class="banner-caption"><?php echo $group['name']; ?></span>
	</div>

		<div class="content">
			<div class="contentrow">

<?php while ( have_posts() ) : the_post(); ?>
<div class="page">	
		
		<div class="part titlecontainer"><h1 class="post-title"><span><?php the_title(); ?></span></h1></div>
		<div class="post-content"><div class="part">

<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
        </div></div>

</div></div></div>
<?php get_footer(); ?>