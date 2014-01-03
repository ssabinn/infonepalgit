<h2>Create / Edit Candidates</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>'); 
?>

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php base_url(); ?>style/contents.css">	

<div id="admin-body" class="col-sm-12">
<?php 

	echo form_open_multipart('candidates/submit/'.$update_id);
?>
	<legend for="candidate_name">Candidate Name: </legend>
	<input name="candidate_name" value="<?php echo $candidate_name; ?>" /><br/><br/>
	

	<legend for="party_id">Affiliated Party : </legend>
	<select name="party_id" class="">
		<option value="0" >Select Party:</option>
		<?php
			$this->load->module('parties');
			$query = $this->parties->get('id');
			foreach ($query->result() as $row) {
				if($party_id == $row->id){echo "<option value=".$party_id." selected >".$row->party_name."</option>";}
				echo "<option value=".$row->id.">".$row->party_name."</option>";
			} 
		?>

	
    </select><br/><br/>

	<legend for="district_id">District: </legend>
	<select name="district_id" class="">
		<option value="0" >Select District</option>
		<?php
			$this->load->module('districts');
			$query = $this->districts->get('district_name');
			foreach ($query->result() as $row) {
				if($district_id == $row->id){echo "<option value=".$district_id." selected >".$row->district_name."</option>";}
				echo "<option value=".$row->id.">".$row->district_name."</option>";
			}
		?>
    </select><br/><br/>

	<legend for="area">Area No: </legend>
	<select name="area" class="">
			<option value="0">Select Area</option>
		<?php if($area){?>
			<option value="1" <?php if($area == '1'){ echo "selected";}?>>1</option>
	        <option value="2" <?php if($area == '2'){ echo "selected";}?>>2</option>
	        <option value="3" <?php if($area == '3'){ echo "selected";}?>>3</option>
	        <option value="4" <?php if($area == '4'){ echo "selected";}?>>4</option>
	        <option value="5" <?php if($area == '5'){ echo "selected";}?>>5</option>
	        <option value="6" <?php if($area == '6'){ echo "selected";}?>>6</option>
	        <option value="7" <?php if($area == '7'){ echo "selected";}?>>7</option>
	        <option value="8" <?php if($area == '8'){ echo "selected";}?>>8</option>
	        <option value="9" <?php if($area == '9'){ echo "selected";}?>>9</option>
	        <option value="10" <?php if($area == '10'){ echo "selected";}?>>10</option>
	    <?php }else{ ?>
	    	<option value="1">1</option>
	        <option value="2">2</option>
	        <option value="3">3</option>
	        <option value="4">4</option>
	        <option value="5">5</option>
	        <option value="6">6</option>
	        <option value="7">7</option>
	        <option value="8">8</option>
	        <option value="9">9</option>
	        <option value="10">10</option>
	    <?php } ?>    
    </select><br/><br/>

    <legend for="age">Age: </legend>
	<input name="age" value="<?php echo $age; ?>" style="width:50px"/><br/><br/>


    <legend for="gender">Gender: </legend>
    <select name="gender" class="">
		<option value="0" disabled>Select Gender</option>
		<?php if($gender){?>
			<option value="male" <?php if($gender == 'male'){ echo "selected";}?> >Male</option>
	        <option value="female" <?php if($gender == 'female'){ echo "selected";}?> >Female</option>
	        <option value="other" <?php if($gender == 'other'){ echo "selected";}?>>Other</option>
	    <?php }else{ ?>
	    	<option value="male">Male</option>
	        <option value="female">Female</option>
	        <option value="other">Other</option>
	    <?php } ?>   
    </select>
	
	<br/><br/>
	<?php
		echo form_submit('submit', 'Add Candidate');
	?>
	<?php
	// foreach ($query->result() as $row) {
	// 	$edit_url = base_url()."pages/create/".$row->id;
	// 	$delete_url = base_url()."pages/deleteconf/".$row->id;
	// }
	?>

<?php
	echo form_close();
?>

</div>