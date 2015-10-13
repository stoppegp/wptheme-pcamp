<?php get_header(); ?>

	<div class="cbanner">
		<div class="post-image">
		<img src="<?php bloginfo('template_url'); ?>/res/images/defaultbild-presse.jpg" id="headerlogo"/></div>

			
 <?php /* If this is a category archive */ if (is_category()) { ?>

<h1 class="post-title">Kategorie <em><?php single_cat_title( '', true ); ?></em></h1>

<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

<h1 class="post-title">Tag <em><?php single_tag_title( '', true ); ?></em></h1>

<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

<h1 class="post-title">Archiv <em><?php the_time('d. F Y'); ?></em></h1>

<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

<h1 class="post-title">Archiv <em><?php the_time('F Y'); ?></em></h1>

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

<h1 class="post-title">Archiv <em><?php the_time('Y'); ?></em></h1>

<?php /* If this is an author archive */ } elseif (is_author()) { ?>

<h1 class="post-title">Autor Archiv</h1>

<?php } elseif (is_post_type_archive()) {?>

<h1 class="post-title"><?php post_type_archive_title(); ?></h1>

<?php } ?>
	</div>
			<div class="content">
			<div class="contentrow">
			<div class="cleft">		
				<?php global $wp_query;
$resultc = $wp_query->found_posts;
if ($resultc > 0) {
?><!--<div><?php
 echo $resultc; ?> <?php echo _n("Eintrag", "Einträge", $resultc); ?> gefunden</div>-->
				<div class="post-content">
				<?php // The Query ?>
	 
				<?php // The Loop ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="part">
						<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div class="post-datum">
				<?php
				$infostring = translate("Vom")." ".get_the_time('j. F Y').", ".get_the_time('H:i')." ".translate("Uhr");
				echo $infostring;
				?>
		</div>	
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php get_template_part("pagelinks"); ?>
				<?php endif; ?>
			
			</div>
<?php } else { ?>
<div class="post-content part">Keine Einträge gefunden.</div>
<?php
}
?>
</div>
			<div class="cright">		
			<aside class="widget">
						
 <?php /* If this is a category archive */ if (is_category()) { ?>

<span class="post-title">Kategorie <em><?php single_cat_title( '', true ); ?></em></span>

<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>

<span class="post-title">Tag <em><?php single_tag_title( '', true ); ?></em></span>

<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

<span class="post-title">Archiv <em><?php the_time('d. F Y'); ?></em></span>

<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

<span class="post-title">Archiv <em><?php the_time('F Y'); ?></em></span>

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

<span class="post-title">Archiv <em><?php the_time('Y'); ?></em></span>

<?php /* If this is an author archive */ } elseif (is_author()) { ?>

<span class="post-title">Autor Archiv</span>

<?php } elseif (is_post_type_archive()) {?>

<span class="post-title"><?php post_type_archive_title(); ?></span>

<?php } ?><br><?php
 echo $resultc; ?> <?php echo _n("Eintrag", "Einträge", $resultc); ?> gefunden
			</aside>
			</div>
</div></div>
<?php get_footer(); ?>
