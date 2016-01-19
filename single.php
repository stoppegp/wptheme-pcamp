<?php get_header(); ?>


	<div class="cbanner longtitle <?php echo (has_post_thumbnail())?"":"titleonly"; ?> ">
		<span class="banner-caption"><?php the_title(); ?></span>
		<?php 
		if ( has_post_thumbnail() ) { 
		  ?>		
		<div class="post-image"><?php the_post_thumbnail(); ?></div>
		<?php } ?>
	</div>
		
		<div class="content">
			<div class="contentrow">
<div class="cleft">
<?php while ( have_posts() ) : the_post(); ?>
<div class="post single">	
	<div>
		<?php /*
if ( !has_post_thumbnail() ) { 
?>
		<div class="part titlecontainer"><h1 class="post-title"><span><?php the_title(); ?></span></h1></div>
<?php } */ ?>
		<div class="post-content"><div class="part">

<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
        </div></div>
    </div>
		
</div>
<?php if (comments_open()) { ?>
<div class="part">
	<?php comments_template(); ?>
</div>
<?php } ?>
</div>
			<div class="cright">
			<?php get_sidebar('pcamp'); ?>		
			<aside class="widget">
						Veröffentlicht am <?=get_the_time('j. F Y');?> um <?=get_the_time('H:i');?> Uhr<?php
		if (get_the_category()) { ?> unter <?php the_category(', '); ?><?php } ?><?php the_tags(" und tagged ", ', ', ""); ?>.		
			</aside>
			<?php if (!comments_open()) { ?>
<aside class="widget">
	<?php comments_template(); ?>
</aside>
<?php } ?>
			</div>
</div>
</div>
<?php get_footer(); ?>
