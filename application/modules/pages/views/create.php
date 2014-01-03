<h2>Create Page</h2>
<br/>
<?php
	echo validation_errors('<p style="color: red">', '</p>');
	echo form_open('pages/submit/'.$update_id);
?>
<br/>

<table width="600" cellspaceing="0" cellpadding="">

	<tr>Pages Title:
			<?php
				$data = array(
					'name' => 'page_title',
					'id' => 'page_title',
					'value' => $page_title,
					'max_length' => '240',
					'style' => 'width: 300px;'
					);
				echo form_input($data);
			?>
	</tr>
	<br/>
	<br/>
	<tr>Keyword:
			<?php
				$data = array(
					'name' => 'keyword',
					'id' => 'keyword',
					'value' => $keyword,
					'max_length' => '240',
					'style' => 'width: 300px;'
					);
				echo form_input($data);
			?>
	</tr>
	<br/>
	<br/>
	<tr>
		<?php
			echo form_submit('submit', 'Create Page');
		?>
	</tr>
	<?php
	// foreach ($query->result() as $row) {
	// 	$edit_url = base_url()."pages/create/".$row->id;
	// 	$delete_url = base_url()."pages/deleteconf/".$row->id;
	// }
	?>

</table>

<?php
	echo form_close();
?>