<h2>Create / Edit News Posts</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>'); ?>

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script> 
<!-- <link rel="stylesheet" href="<?php base_url(); ?>style/contents.css">	 -->

<div id="admin-body" class="col-sm-12">
<?php 
	echo form_open_multipart('news/submit/'.$update_id);
?>
	<legend for="news_headline">News Headline: </legend>
	<input name="news_headline" id="news_headline" value="<?php echo $news_headline; ?>" /><br/>
	<legend for="news_content">News Content: </legend>
	<?php
		$data = array(
			'name' => 'news_content',
			'id' => 'edi',
			'value' => $news_content
			);
		echo form_textarea($data);
	?>
    <script>
	    CKEDITOR.replace( 'edi');
	</script>
	<br/>
	<legend for="category">Category:</legend>
	<?php if($category){ ?>
		<input type="radio" name="category" value="economics" <?php if($category == 'economics'){ echo "checked"; } ?> >Economics</input>
		<input type="radio" name="category" value="politics"<?php if($category == 'politics'){ echo "checked"; } ?> >Politics</input>
		<input type="radio" name="category" value="sports"<?php if($category == 'sports'){ echo "checked"; } ?> >Sports</input>
		<input type="radio" name="category" value="technology"<?php if($category == 'technology'){ echo "checked"; } ?> >Technology</input>
		<input type="radio" name="category" value="others" <?php if($category == 'others'){ echo "checked"; } ?> >Others</input>
	<?php }else{ ?>
		<input type="radio" name="category" value="economics" >Economics</input>
		<input type="radio" name="category" value="politics" >Politics</input>
		<input type="radio" name="category" value="sports" >Sports</input>
		<input type="radio" name="category" value="technology" >Technology</input>
		<input type="radio" name="category" value="others" >Others</input>
	<?php } ?>
	<br/><br/>
	<?php
		echo form_submit('submit', 'Make Post');
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