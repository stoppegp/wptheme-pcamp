<?php get_header(); ?>
<?php 
if ( has_post_thumbnail() ) { 
  ?>
	<div class="cbanner">
		<div class="post-image"><?php the_post_thumbnail(); ?></div>

				<span class="banner-caption"><?php the_title(); ?></span>
	</div>
  <?php
} 
?>
		<div class="content">
			<div class="contentrow">
<?php while ( have_posts() ) : the_post(); ?>
<div class="page">	
		<?php	if ( !has_post_thumbnail() ) { ?>
		<div class="part titlecontainer"><h1 class="post-title"><span><?php the_title(); ?></span></h1></div>
		<?php } ?>
		<div class="post-content"><div class="part">

<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
        </div></div>
</div>
</div></div>
<?php get_footer(); ?>