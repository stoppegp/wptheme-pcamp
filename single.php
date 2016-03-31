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
<?php if (comments_open() || get_comments_number()) { ?>
<div class="part">
	<?php comments_template(); ?>
</div>
<?php } ?>
</div>
			<div class="cright">

			<?php
			 if (get_post_meta (get_the_ID(), '_pcamp_steckbrief', true ) === "true") {
			 ?>

			<aside class="widget">
            <div id="steckbrief">
                <?php
                if (get_the_author_meta('user_url', get_the_author_id())<>'') {
                    echo '<a href="'.get_the_author_meta('user_url', get_the_author_id()).'" class="steckbrief-link">';
                }
                ?>
			<?php echo get_avatar( get_the_author_id(), 512 ); ?> 
            <span class="text">
            	<strong><?php the_author(); ?></strong>
            	<?php
                if (get_the_author_meta('description', get_the_author_id())<>'') {
                    echo '<br>'.get_the_author_meta('description', get_the_author_id());
                }
                ?>
            </span>
                <?php
                if (get_the_author_meta('user_url', get_the_author_id())<>'') {
                    echo '</a>';
                }
                ?>
            </div>
            </aside>
			<?php
			} else {
			?>
			
       <?php
		$custom_fields = get_post_custom();
        if (  
		( isset($custom_fields['text']) && isset($custom_fields['image_url']) && 
		   ($custom_fields['image_url'][0]<>'') && ($custom_fields['text'][0]<>'')))             
            {   ?>
			<aside class="widget">
            <div id="steckbrief">
                
                <?php
                if ($custom_fields['link'][0]<>'') {
                    echo '<a href="'.$custom_fields['link'][0].'" class="steckbrief-link">';
                }
                if ($custom_fields['title'][0]<>'') {
                    echo '<span class="widget-title">'.$custom_fields['title'][0]."</span>";
                }
                if (isset($custom_fields['image_url']) &&  $custom_fields['image_url'][0]<>'') {
                    echo wp_get_attachment_image( $custom_fields['image_url'][0], array(300,300) ); 
                } ?>
                
                <span class="text">
                     <?php echo nl2br(do_shortcode(get_post_meta($post->ID, 'text', $single = true))); ?>
                </span>
                <?php
                if ($custom_fields['link'][0]<>'') {
                    echo '</a>';
                }
                ?>
           </div>
           </aside>
           <?php 
        } }  ?>
			<?php get_sidebar('pcamp'); ?>		
			<aside class="widget">
						Veröffentlicht am <?=get_the_time('j. F Y');?> um <?=get_the_time('H:i');?> Uhr<?php
		if (get_the_category()) { ?> unter <?php the_category(', '); ?><?php } ?><?php the_tags(" und tagged ", ', ', ""); ?>.		
			</aside>
	<?php if ( ! comments_open() && ! get_comments_number() ) { ?>
<aside class="widget">
<p>Kommentare sind für diesen Beitrag deaktiviert.</p>
</aside>
<?php } ?>
			<?php get_sidebar('single'); ?>
			</div>
</div>
</div>
<?php get_footer(); ?>
