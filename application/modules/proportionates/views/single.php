<div id="single" class="col-xs-10">

	<!-- <div class='col-xs-12'><h3><?php echo $party_name; ?></h3></div> -->
	<div class="col-sm-6">
		<img src="<?php echo base_url(); ?>images/candidate.png" width="300" />
	</div>

	<div id="single-candidate" class="col-sm-6">
		<span><b>District : &nbsp;</b><?php echo $district_id; ?></span><br/>
		<span><b>Area : &nbsp;</b><?php echo $area; ?></span><br/><br/><br/>

		<span><b>Affiliated Party : &nbsp;</b><br/><?php 
			$this->load->module('parties');
			$party_name = $this->parties->get_party_name($party_id);

			echo anchor(base_url()."parties/single/".$party_id,$party_name);
		?></span><br/><br/>

		<span><b>Age : &nbsp;</b><?php echo $age; ?></span><br/>
		<span><b>Gender : &nbsp;</b><?php echo $gender; ?></span><br/><br/><br/>
		<span><b>Vote : &nbsp;</b><?php if($vote_percent){ echo $vote_percent;}else{ echo "0"; } ?> %</span><br/>
	</div>
	

</div>