<div id="single" class="col-xs-10">

	<!-- <div class='col-xs-12'><h3><?php echo $party_name; ?></h3></div> -->
	<div class='col-sm-12'>
		<div class='col-sm-5'>
			<img src="<?php echo base_url().$flag;?>" />
		</div>
		<div id="single-des" class="col-sm-7">
		<br/>
			<span><b>पार्टी प्रमुख : &nbsp;</b><?php echo $chief; ?></span><br/><br/>
			<span><b>ठेगाना : &nbsp;</b><?php echo $address; ?></span><br/><br/>
			<span><b>चिन्ह : &nbsp;</b><?php echo $symbol; ?></span><br/><br/>
			<span><b>दर्ता मिती : &nbsp;</b><?php echo $reg_date; ?></span><br/>
		</div>
	</div>
	<div class="clearfix"></div>
	<!-- <div class='class-sm-12'><p></p><p><?php echo $manifesto; ?></p></div> -->
	<div class="clearfix"></div>
	<div class="col-xs-12">
		<br/><br/><p><b id="single-party">View Candidates:</b></p>
		<?php 
			$this->load->view('parties/get_all_candidates_by_party');
		?>
	</div>

</div>

