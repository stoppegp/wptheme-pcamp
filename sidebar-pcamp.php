<?php
				global $PCAMP_SIDEBAR;
				if (is_array($PCAMP_SIDEBAR) && (count($PCAMP_SIDEBAR) > 0)) {
					foreach ($PCAMP_SIDEBAR as $val) {
						?>
						<aside class="widget">
						<?php
						if ($val['title']) {
						?>
							<div class="widget-title"><?php echo $val['title']; ?></div>
						<?php
						}
						?>
						<?php echo do_shortcode($val['content']); ?>
						</aside>
						<?php
					}
				}			
				?>
