<?php get_header(); ?>

<div class="fp">
<?php while ( have_posts() ) : the_post(); ?>

<div class="part">
<?php the_content(); ?>
</div>

<!-- Top-Meldung -->
<div class="part">
<?php
	$recent_post = wp_get_recent_posts( array('numberposts' => 1, 'post_type' => 'post', 'post_status' => 'publish', 'meta_key' => '_pcamp_top', 'meta_value' => 'false', 'meta_compare' => '!='));
	$postid = $recent_post[0]['ID'];
	setup_postdata( $GLOBALS['post'] =& get_post($postid) );
	$content = apply_filters('the_content',get_the_content(null, false));
	$ret = '<span class="post-date">Top-Meldung vom '.get_the_date(null, $postid).'</span>';
	$ret .= '<h2 class="post-title"><a href="'.get_the_permalink($postid).'">'.get_the_title($postid).'</a></h2>';
	$ret .= '<div class="entry">'.$content.'</div>';
	echo $ret;
	$posttopid = $postid;
	?>
</div>

<div class="fp-posts">

<?php
	$recent_post = wp_get_recent_posts( array('numberposts' => 3, 'post_type' => 'post', 'post_status' => 'publish', 'post__not_in' => array($posttopid)));
	for ($c = 0; $c < 3; $c++) {
		$postid = $recent_post[$c]['ID'];
		setup_postdata( $GLOBALS['post'] =& get_post($postid) );
		?>
<div><div class="part"><span class="post-date">Meldung vom <?php echo get_the_date(); ?></span><h2 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2><?php the_content(); ?><div class="readmore"><a href="<?php the_permalink();?>">weiterlesen...</a></div></div></div>
		<?php
	}
	?>


</div>

<?php endwhile; // end of the loop. ?>


</div>

<?php get_footer(); ?>
