<?php
				global $PCAMP_SIDEBAR_AFTER;
				if (is_array($PCAMP_SIDEBAR_AFTER) && (count($PCAMP_SIDEBAR_AFTER) > 0)) {
					foreach ($PCAMP_SIDEBAR_AFTER as $val) {
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
