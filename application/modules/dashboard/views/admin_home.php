<div id="content">
		<h2>Dashboard</h2>
		<div class="admin-home col-sm-12">
			<?php 	if($this->session->userdata('is_a') == 'admin'){?><div class="admin-options col-sm-3"><?php echo anchor("ads/manage", "Advertisements"); ?></div><?php }?>
			<?php if($this->session->userdata('is_a') == 'admin'){?><div class="admin-options col-sm-3"><?php echo anchor("election/dashboard", "Election 2013"); ?></div><?php }?>
			<div class="admin-options col-sm-3"><?php echo anchor("news/manage", "News"); ?></div>
			<?php if($this->session->userdata('is_a') == 'admin'){?><div class="admin-options col-sm-3"><?php echo anchor("blogs/manage", "Blog"); ?></div><?php }?>
		</div>

</div>