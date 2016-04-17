<?php
/*
Template Name: Mit leerer Sidebar
*/
?>
<?php get_header(); ?>
<?php 
$parents = get_post_ancestors( get_the_ID());
$thumbid = get_the_ID();
if (!has_post_thumbnail()) $thumbid = ($parents) ? $parents[count($parents)-1]: get_the_ID();
if ( has_post_thumbnail($thumbid) ) { 
  ?>
	<div class="cbanner">
		<div class="post-image"><?php echo get_the_post_thumbnail($thumbid, "banner"); ?></div>

				<span class="banner-caption"><?php echo get_the_title($thumbid); ?></span>
	</div>
  <?php
}  else {
?>
	<div class="cbanner titleonly">

				<span class="banner-caption"><?php the_title(); ?></span>

	</div>
<?php } ?>
		<div class="content">
			<div class="contentrow">
<div class="cleft">
<?php while ( have_posts() ) : the_post(); ?>
<div class="page">	
		<div class="post-content"><div class="part">

<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
        </div></div>
</div>
</div>
		<?php get_sidebar('group'); ?></div></div>
<?php get_footer(); ?>
