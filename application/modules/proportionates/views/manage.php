<h2>Proportionate Candidates for Party</h2>
<br/>
<div class="admin-make">
<?php
	echo anchor('proportionates/create', '+ Add Candidate');
?>
</div>

<br/>
<br/>

<table class="col-sm-12">

	<tr><th class="col-sm-1">Party</th><th class="col-sm-4">Name</th><th class="col-sm-2">District</th><th class="col-sm-1">Area</th><th class="col-sm-2">Gender</th><th class="col-sm-1">Edit</th><th class="col-sm-1">Delete</th></tr>
	<?php
	foreach ($query->result() as $row) {
		$edit_url = base_url()."proportionates/create/".$row->id;
		$delete_url = base_url()."proportionates/deleteconf/".$row->id;
	?>
	<tr><td class="col-sm-1"><?php

		$this->load->module('parties');
		$party_query = $this->parties->get_where($row->party_id);
		foreach ($party_query->result() as $party_row) {
			$flag_id = $party_row->flag;
			echo "<img src=".base_url().$flag_id." width='60' height='60'/>";
		}	

	?></td>
	<td class="col-sm-4"><?php echo $row->proportionate_name; ?></td>
	<td class="col-sm-2"><?php 
		$this->load->module('districts');
		$district_query = $this->districts->get_where($row->district_id);
		foreach ($district_query->result() as $district_row) {
			$district_name = $district_row->district_name;
			echo $district_name;
		}	
	 ?></td>
	<td class="col-sm-1"><?php echo $row->area; ?></td>
	<td class="col-sm-2"><?php echo $row->gender; ?></td>
	<!-- <td class="col-sm-1"><img src="<?php echo base_url().$row->area; ?>" width="100" height="100" /></td> -->


	<td class="col-sm-1"><?php echo anchor($edit_url, 'Edit'); ?></td>
	<td class="col-sm-1"><?php 
		// $page_url = $row->page_url;
		// if(($page_url == "") || ($page_url == "news") || ($page_url == "contact") || ($page_url == "blog")){
		// 	echo "-";
		// }else{
			echo anchor($delete_url,'Delete');
		// }
		?>
	</td></tr>
	<?php
	}
	?>

</table>