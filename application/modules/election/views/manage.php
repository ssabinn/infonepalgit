<h2>Candidates for <?php echo $district ?> - <?php echo $area ?></h2>
<br/>
<div class="admin-make">
<a href="<?php echo base_url(); ?>election/addResult">Go back</a>
<?php
	// echo anchor('candidates/create', '+ Add Candidate');
	// var_dump($query);
	
	$count = 0;
?>
</div>

<br/>
<br/>

<table class="col-sm-12">
	<tr><th class="col-sm-2">Party</th><th class="col-sm-4">Name</th><th class="col-sm-3">Vote Count</th><th class="col-sm-3">Vote Percent</th></tr>
	<?php
	echo form_open('election/candidate_submit?district='.$district.'&area='.$area);

	foreach ($query->result() as $row){
		$edit_url = base_url()."election/create/".$row->id;
		$delete_url = base_url()."election/deleteconf/".$row->id;
	?>
	<tr><td class="col-sm-2"><?php

		$this->load->module('parties');
		$party_query = $this->parties->get_where($row->party_id);
		foreach ($party_query->result() as $party_row) {
			$flag_id = $party_row->flag;
			echo "<img src=".base_url().$flag_id." width='60' height='60'/>";
		}	
	?></td>
	<td class="col-sm-4"><?php echo $row->candidate_name; ?></td>

	<td class="col-sm-3"><input name="candidate[<?php echo $count; ?>][vote_count]" value="<?php echo $row->vote_count; ?>" style="width:50px"/></td>
	<td class="col-sm-3"><input name="candidate[<?php echo $count; ?>][vote_percent]" value="<?php echo $row->vote_percent; ?>" style="width:50px"/></td>

	<input name="candidate[<?php echo $count; ?>][id]" value="<?php echo $row->id; ?>" style="width:50px; display:none; "/>

	</tr>
	<?php
		$count++;
	}
	?>

<tr><td class="col-sm-3"></td><td class="col-sm-6"></td><td class="col-sm-3">
	<input name="count" value="<?php echo $count; ?>" style="display:none;" />
<?php
	echo form_submit('submit', 'OK');
	echo form_close();
?>
</td></tr>
</table>