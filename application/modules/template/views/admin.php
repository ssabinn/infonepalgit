<?php $this->load->view('admin_header'); ?>


<div id="left-sidebar" class="col-sm-3">
	<a class="sidelink col-xs-12" href="<?php echo base_url()."dashboard/home";?>">Dashboard</a>
	<?php 	if($this->session->userdata('is_a') == 'admin'){?><a class="sidelink col-xs-12" href="<?php echo base_url()."ads/manage";?>">Advertisements</a><?php }?>
	<?php 	if($this->session->userdata('is_a') == 'admin'){?><a class="sidelink col-xs-12" href="<?php echo base_url()."election/dashboard";?>">Election 2013</a><?php }?>
	<a class="sidelink col-xs-12" href="<?php echo base_url()."news/manage";?>">News</a>
	<?php 	if($this->session->userdata('is_a') == 'admin'){?><a class="sidelink col-xs-12" href="<?php echo base_url()."blogs/manage";?>">Blog</a><?php }?>
</div>

<div id="admin-content" class="col-sm-9">
<?php
	$this->load->view($module."/".$view_file);
?>
</div>

