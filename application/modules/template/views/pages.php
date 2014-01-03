<?php
	if(!isset($view_file)){
		$view_file =""; 
	}

	if(!isset($module)){
		$module = $this->uri->segment(1);
	}
	if(($view_file!="") && ($module!="")){
		$path = $module."/".$view_file;
		// $this->load->view($path);
	}
?>



<div id='content'>
	<h2 id="page-header" class="col-sm-12"><?php echo $page_title; ?></h2>
	<div class="clearfix"></div>
	<div id="page_content" class="col-sm-9">
		<div id="page-body">
			<?php
				$this->load->view($path);
			?>
		</div>
	</div>
	<div id="sidebar" class="col-sm-3">
		<iframe src="http://www.ashesh.com.np/calendarlink/calendar.php?api=8701y8d392" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" style="border:none; overflow:hidden; width:260px; height:180px;" allowtransparency="true">
</iframe><br /><font size="1">© <a title="Nepali Calendar" href="http://www.ashesh.com.np/nepali-calendar/">Nepali calendar</a></font>
	</div>
</div>


<?php
	$this->load->view('footer');
?>