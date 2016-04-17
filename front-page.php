<?php get_header(); ?>

<div class="fp">
<?php while ( have_posts() ) : the_post(); ?>

<div class="part">
<?php the_content(); ?>
</div>

<!-- Buttons -->
<?php
$b0_text = get_theme_mod( 'pcamp_fp_0text', "" );
$b1_text = get_theme_mod( 'pcamp_fp_1text', "" );
$b2_text = get_theme_mod( 'pcamp_fp_2text', "" );
$b3_text = get_theme_mod( 'pcamp_fp_3text', "" );
$b4_text = get_theme_mod( 'pcamp_fp_4text', "" );
$b0_url = get_theme_mod( 'pcamp_fp_0url', "" );
$b1_url = get_theme_mod( 'pcamp_fp_1url', "" );
$b2_url = get_theme_mod( 'pcamp_fp_2url', "" );
$b3_url = get_theme_mod( 'pcamp_fp_3url', "" );
$b4_url = get_theme_mod( 'pcamp_fp_4url', "" );
$b0_image = get_theme_mod( 'pcamp_fp_0image', "" );
$b1_image = get_theme_mod( 'pcamp_fp_1image', "" );
$b2_image = get_theme_mod( 'pcamp_fp_2image', "" );
$b3_image = get_theme_mod( 'pcamp_fp_3image', "" );
$b4_image = get_theme_mod( 'pcamp_fp_4image', "" );

if (($b0_text != "") && ($b0_url != "") && ($b0_image != "")) {
	?>
	
		<div class="homebutton">
			<a href="<?php echo $b0_url; ?>" title="<?php echo $b0_text; ?>"><img src="<?php echo get_attachment_by_url($b0_image, "fp-bigbutton")[0]; ?>" alt="<?php echo $b0_text; ?>"><span class="mtext"><?php echo $b0_text; ?></span></a>
		</div>

	
	<?php
}

if (($b1_text != "") && ($b2_text != "") && ($b1_image != "") && ($b2_image != "") && ($b1_url != "") && ($b2_url != "")) {
	?>
	<div class="homebuttonrow">
	
		<div class="homebutton">
			<a href="<?php echo $b1_url; ?>" title="<?php echo $b1_text; ?>"><img src="<?php echo get_attachment_by_url($b1_image, "fp-button")[0]; ?>" alt="<?php echo $b1_text; ?>"><span class="mtext"><?php echo $b1_text; ?></span></a>
		</div>
		
		<div class="homebutton">
			<a href="<?php echo $b2_url; ?>" title="<?php echo $b2_text; ?>"><img src="<?php echo get_attachment_by_url($b2_image, "fp-button")[0]; ?>" alt="<?php echo $b2_text; ?>"><span class="mtext"><?php echo $b2_text; ?></span></a>
		</div>
	
	</div>
	
	<?php
}
if (($b3_text != "") && ($b4_text != "") && ($b3_image != "") && ($b4_image != "") && ($b3_url != "") && ($b4_url != "")) {
	?>
	<div class="homebuttonrow">
	
		<div class="homebutton">
			<a href="<?php echo $b3_url; ?>" title="<?php echo $b3_text; ?>"><img src="<?php echo get_attachment_by_url($b3_image, "fp-button")[0]; ?>" alt="<?php echo $b3_text; ?>"><span class="mtext"><?php echo $b3_text; ?></span></a>
		</div>
		
		<div class="homebutton">
			<a href="<?php echo $b4_url; ?>" title="<?php echo $b4_text; ?>"><img src="<?php echo get_attachment_by_url($b4_image, "fp-button")[0]; ?>" alt="<?php echo $b4_text; ?>"><span class="mtext"><?php echo $b4_text; ?></span></a>
		</div>
	
	</div>
	
	<?php
}
?>

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
	<p style="text-align:right;clear:both;"><a href="<?php  echo get_permalink( get_option('page_for_posts' ) ); ?>">weitere Meldungen</a></p>
</div>

<div class="fp-posts">


<?php
	$recent_post = wp_get_recent_posts( array('numberposts' => 3, 'post_type' => 'post', 'post_status' => 'publish', 'post__not_in' => array($posttopid)));
	for ($c = 0; $c < 3; $c++) {
		$postid = $recent_post[$c]['ID'];
		setup_postdata( $GLOBALS['post'] =& get_post($postid) );
		?>
<div><div class="part notab"><span class="post-date">Meldung vom <?php echo get_the_date(); ?></span><h2 class="post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2><?php the_content(); ?><a class="readmore" href="<?php the_permalink();?>">weiterlesen...</a></div></div>
		<?php
	}
	?>


</div>
<script>
$(document).ready(function () {
    $('.notab p a').attr('tabindex', '-1');
});
</script>

<?php endwhile; // end of the loop. ?>

<?php get_sidebar('pcampfront'); ?>

</div>

<?php get_footer(); ?>
