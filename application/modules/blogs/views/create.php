<h2>Create / Edit News Posts</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>'); ?>

<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php base_url(); ?>style/contents.css">

<div id="admin-body" class="col-sm-12">
<?php 
	echo form_open('blogs/submit/'.$update_id);
?>
	<legend for="blog_title">Blog title: </legend>
	<input name="blog_title" id="blog_title" value="<?php echo $blog_title; ?>" /><br/>
	<legend for="blog_content">Blog Content: </legend>
	<?php
		$data = array(
			'name' => 'blog_content',
			'id' => 'edi',
			'value' => $blog_content,
			);
		echo form_textarea($data);

		// echo $this->ckeditor->editor("blog_content",$blog_content);
	?>
	<!-- <textarea cols="80" id="edi" name="blog_content" rows="10" value="<?php echo $blog_content; ?>"></textarea> -->
    <script>CKEDITOR.replace('edi');</script>
	<legend for="tags">Tags:</legend>
	<input name="tags" id="tags" value="<?php echo $tags; ?>" /><br/>
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