<h2>Manage Advertisements</h2>
<br/>
<div class="admin-make">
<?php
	echo anchor('ads/create', '+ Add Advertisments');
?>
</div>

<br/>
<br/>

<table class="col-sm-12">

	<tr><th class="col-sm-6">Advertisements</th><th class="col-sm-4">Name</th><th class="col-sm-1">Edit</th><th class="col-sm-1">Delete</th></tr>
	<?php
	foreach ($query->result() as $row) {
		$edit_url = base_url()."ads/create/".$row->id;
		$delete_url = base_url()."ads/deleteconf/".$row->id;
	?>
	<tr><td class="col-sm-6"><?php
		echo "<img src=".base_url().$row->ads_url." width='200' height='100'/>";
	?></td>

	<td class="col-sm-4"><?php echo $row->ads_name; ?></td>
	<td class="col-sm-1"><?php echo anchor($edit_url, 'Edit'); ?></td>
	<td class="col-sm-1"><?php 
			echo anchor($delete_url,'Delete');
		?>
	</td></tr>
	<?php
	}
	?>

</table>