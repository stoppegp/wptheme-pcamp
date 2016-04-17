<?php global $thumbid; ?>
<div class="cright"><?php get_sidebar('pcamp'); ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-pagegroup-'.$thumbid) ) : ?>
	<?php endif; ?>
	<?php get_sidebar('pcamp-after'); ?></div>
