<?php
				global $PCAMP_SIDEBAR;
				if (is_array($PCAMP_SIDEBAR) && (count($PCAMP_SIDEBAR) > 0)) {
					foreach ($PCAMP_SIDEBAR as $val) {
						?>
						<div class="part">
						<?php echo do_shortcode($val['content']); ?>
						</div>
						<?php
					}
				}			
				?>
