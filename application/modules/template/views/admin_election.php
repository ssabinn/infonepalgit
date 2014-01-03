<?php $this->load->view('admin_header'); ?>


<div id="left-sidebar" class="col-sm-3">
	<a class="sidelink col-xs-12" href="<?php echo base_url()."dashboard/home";?>">Dashboard</a>
	<a class="sidelink col-xs-12" href="<?php echo base_url()."election/addResult";?>">Election Result</a>
	<a class="sidelink col-xs-12" href="<?php echo base_url()."parties/manage";?>">Parties</a>
	<a class="sidelink col-xs-12" href="<?php echo base_url()."candidates/manage";?>">Candidates (Direct)</a>
	<a class="sidelink col-xs-12" href="<?php echo base_url()."proportionates/manage";?>">Candidates (Proportionate)</a>
</div>

<div id="admin-content" class="col-sm-9">
<?php
	$this->load->view($module."/".$view_file);
?>
</div>

