<h2>Parties of Nepal</h2>
<br/>
<div class="admin-make">
<?php
	echo anchor('parties/create', '+ Add Party');
?>
</div>

<br/>
<br/>

<table class="col-sm-12">

	<tr><th class="col-sm-4">Party Name</th><th class="col-sm-3">Chief</th><th class="col-sm-1">Symbol</th><th class="col-sm-1">Flag</th><th class="col-sm-1">Manifesto</th><th class="col-sm-1">Edit</th><th class="col-sm-1">Delete</th></tr>
	<?php
	foreach ($query->result() as $row) {
		$edit_url = base_url()."parties/create/".$row->id;
		$delete_url = base_url()."parties/deleteconf/".$row->id;
	?>
	<tr><td class="col-sm-4"><?php echo $row->party_name; ?></td>
	<td class="col-sm-3"><?php echo $row->chief; ?></td>
	<td class="col-sm-1"><?php echo $row->symbol; ?></td>
	<td class="col-sm-1"><img src="<?php echo base_url().$row->flag; ?>" width="100" height="100" /></td>
	<td class="col-sm-1">
		<?php 
			if($row->manifesto != ""){
				echo "Present";
			}else{
				echo "-";
			}
		?>
	</td>
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