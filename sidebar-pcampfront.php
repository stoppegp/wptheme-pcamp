<?php
				global $PCAMP_SIDEBAR; global $PCAMP_SIDEBAR_AFTER;
				if (is_array($PCAMP_SIDEBAR) && (count($PCAMP_SIDEBAR) > 0)) {
					foreach ($PCAMP_SIDEBAR as $val) {
						?>
						<div class="part">
						<?php echo do_shortcode($val['content']); ?>
						</div>
						<?php
					}
				}			
				if (is_array($PCAMP_SIDEBAR_AFTER) && (count($PCAMP_SIDEBAR_AFTER) > 0)) {
					foreach ($PCAMP_SIDEBAR_AFTER as $val) {
						?>
						<div class="part">
						<?php echo do_shortcode($val['content']); ?>
						</div>
						<?php
					}
				}	
				?>
