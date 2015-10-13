<?php get_header(); ?>
			<div class="content">
			<div class="contentrow">
			<div class="cleft">		
				<?php global $wp_query;
$resultc = $wp_query->found_posts;
if ($resultc > 0) {
?>
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
			Ergebnisse für die Suche nach <em><?php echo get_search_query(); ?></em><br><?php
 echo $resultc; ?> <?php echo _n("Eintrag", "Einträge", $resultc); ?> gefunden
			</aside>
			</div>
</div></div>
<?php get_footer(); ?>
