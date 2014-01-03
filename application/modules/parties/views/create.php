<h2>Create / Edit Parties</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>'); 
?>

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php base_url(); ?>style/contents.css">	

<div id="admin-body" class="col-sm-12">
<?php 

	echo form_open_multipart('parties/submit/'.$update_id);
?>
	<legend for="party_name">Party Name: </legend>
	<input name="party_name" id="party_name" value="<?php echo $party_name; ?>" /><br/>
	<legend for="chief">Party Chief: </legend>
	<input name="chief" value="<?php echo $chief; ?>" /><br/>
	<legend for="address">Address: </legend>
	<input name="address" value="<?php echo $address; ?>" /><br/>
	<legend for="symbol">Election Symbol: </legend>
	<input name="symbol" value="<?php echo $symbol; ?>" /><br/><br/>
	<legend for="flag">Flag:</legend>
	<input id="flag-field" type="file" name="userfile" value=""/>
	<?php 
		if($flag){
			echo "<img src='".base_url().$flag."' width='80' height='80' />"; ?>
			<input name="flagname" value="<?php echo $flag; ?>" style="display:none;" />
	<?php
		} 
	?>
	<legend for="reg_date">Decision Date: </legend>
	<input type="date" name="reg_date" value="<?php echo $reg_date; ?>" /><br/><br/>
	<legend for="manifesto">Party Manifesto: </legend>
	<?php
		$data = array(
			'name' => 'manifesto',
			'id' => 'edi',
			'value' => $manifesto
			);
		echo form_textarea($data);
	?>
    <script>CKEDITOR.replace('edi');</script>
	
	<br/><br/>
	<?php
		echo form_submit('submit', 'Add Party');
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