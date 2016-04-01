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
						  <meta itemprop="dateModified" content="<?php echo get_the_modified_date("c"); ?>">
						  <link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />
						   <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
							<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							  <meta itemprop="url" content="<?php echo get_theme_mod( 'pcamp_md_logo', '' ); ?>">
							  <?php
									echo '<meta itemprop="width" content="'; echo get_attachment_by_url(get_theme_mod( 'pcamp_md_logo', '' ), null)[1]; echo '">';  
									echo '<meta itemprop="height" content="'; echo get_attachment_by_url(get_theme_mod( 'pcamp_md_logo', '' ), null)[2]; echo '">'; 
							  ?>
							</div>
							<meta itemprop="name" content="<?php echo get_theme_mod( 'pcamp_md_publisher', '' ); ?>">
						  </div>
						<?php 
						if ( has_post_thumbnail() ) { 
						  ?>		
		<div class="post-image" <?php echo  'itemprop="image" itemscope itemtype="http://schema.org/ImageObject"'; ?>>
		<?php
			echo '<meta itemprop="url" content="'; the_post_thumbnail_url(); echo '">';
			echo '<meta itemprop="width" content="'; echo wp_get_attachment_image_src(get_post_thumbnail_id(), null)[1]; echo '">';  
			echo '<meta itemprop="height" content="'; echo wp_get_attachment_image_src(get_post_thumbnail_id(), null)[2]; echo '">'; 
		 ?></div>
						<?php } ?>
						
       <?php
		$custom_fields = get_post_custom();
        if (  
		( isset($custom_fields['text']) && isset($custom_fields['image_url']) && 
		   ($custom_fields['image_url'][0]<>'') && ($custom_fields['text'][0]<>'')))             
            {   ?>
            <div <?php echo 'itemprop="author" itemscope itemtype="https://schema.org/Person"'; ?>>
                
                <?php

                if (isset($custom_fields['image_url']) &&  $custom_fields['image_url'][0]<>'') {
				 echo '<meta itemprop="image" content="'.wp_get_attachment_image_src( $custom_fields['image_url'][0], array(300,300))[0].'">'; 
                } ?>
                <meta <?php echo 'itemprop="name"'; ?> content="<?php echo nl2br(do_shortcode(get_post_meta($post->ID, 'text', $single = true))); ?>">

           </div>
           </aside>
           <?php 
        }   ?>
						
						<?php } ?>
					</div>
				<?php endwhile; ?>
				<?php get_template_part("pagelinks"); ?>
				<?php endif; ?>

</div>
<?php get_sidebar('side'); ?>
</div>
<?php get_footer(); ?>
