<? global $groupslug; ?>
<div class="cright"><?php get_sidebar('pcamp'); ?><?php if ( !function_exists('dynamic_sidebar') ||
			   !dynamic_sidebar('sidebar-pcamp-groups-'.$groupslug) ) : ?>
	<?php endif; ?></div>
