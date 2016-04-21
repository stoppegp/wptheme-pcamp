
	
	</div>
	
	<footer id="mainfooter">
		<?php wp_nav_menu( array(
			'theme_location'  => 'footermenu',
	'container'       => 'div',
	'container_class'	=>	'footermenu',
	'depth'           => 1,
		)); ?>
	</footer>
	
    <?php wp_footer(); ?>
    </div>
    </div>
    	<script type="text/javascript">
	$(window).resize(function() {
		if ( $('#mainnav').css("position") != "fixed") {
		$( '#mainnav .main-menu-container li:has(ul)' ).doubleTapToGo();
		}
	}).resize()
		</script>
</body>
</html>
