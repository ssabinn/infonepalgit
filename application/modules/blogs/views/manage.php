<h2>Blogs</h2>
<br/>

<div class="admin-make">
<?php
	echo anchor('blogs/create', '+ Make New Post');
?>
</div>

<br/>
<br/>

<table class="col-sm-12">

	<tr><th class="col-sm-8">Blogs Title</th><th class="col-sm-2">Edit</th><th class="col-sm-2">Delete</th></tr>
	<?php
	foreach ($query->result() as $row) {
		$edit_url = base_url()."blogs/create/".$row->id;
		$delete_url = base_url()."blogs/deleteconf/".$row->id;
	?>
	<tr><td class="col-sm-8"><?php echo $row->blog_title; ?></td>
	<td class="col-sm-2"><?php echo anchor($edit_url, 'Edit'); ?></td>
	<td class="col-sm-2"><?php 
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