<h2>Create / Edit Advertisment</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>'); 
?>

<div id="admin-body" class="col-sm-12">
<?php 
	echo form_open_multipart('ads/submit/'.$update_id);
?>
	<legend for="ads_name">Advertisment Name: </legend>
	<input name="ads_name" value="<?php echo $ads_name; ?>" /><br/><br/>	

	<legend for="ads_image">Image:</legend>
	<input id="ads_url" type="file" name="userfile" value=""/>
	<span style="color: #aaa">(For optimum presentation upload image with resolution 600 X 300)</span><br/>
	<?php 
		if($ads_url){
			echo "<img src='".base_url().$ads_url."' width='200' height='100' />"; ?>
			<input name="ads_url_old" value="<?php echo $ads_url; ?>" style="display:none;" />
	<?php
		} 
	?>
	<br/><br/>
	<legend for="ads_href">Link: </legend>
	<input name="ads_href" value="<?php echo $ads_href; ?>" />

	<legend for="ads_category">Category: </legend>
    <select name="ads_category" class="">
		<option value="0" disabled>Select Category</option>
		<?php if($ads_category){?>
			<option value="1" <?php if($ads_category == '1'){ echo "selected";}?> >1</option>
	        <option value="2" <?php if($ads_category == '2'){ echo "selected";}?> >2</option>
	    <?php }else{ ?>
	    	<option value="1">1</option>
	        <option value="2">2</option>
	    <?php } ?>   
    </select>
	<span style="color: #aaa">Category 1 for top ads and 2 for bottom ads</span><br/>


    <br/>

	<?php
		echo form_submit('submit', 'Submit');
	?>
	<?php
	?>

<?php
	echo form_close();
?>

</div>