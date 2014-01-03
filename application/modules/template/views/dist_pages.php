<?php

	// echo base_url(); 

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

	$uri_district = $this->uri->segment(3);
	$uri_area = $this->uri->segment(4);
?>

<div id="content">
	<div id="election-data">
		<div id="map" class="col-md-8">
			<h4>VIEW CANDIDATES</h4>
			<div id="view-candidate-dist" class="col-xs-12 view-candidate">
				<form name="district_form" method="post" action="<?php echo base_url();?>districts/districtArea" class="form-horizontal">
					<div class="col-sm-5">
							<label for="district">DISTRICT: </label>
							<select class="select-district-2" name="district">
	                			<option value="0" disabled selected>Select District</option>
								<?php
									$this->load->module('districts');
									$query = $this->districts->get('district_name');
									foreach ($query->result() as $row) {
										echo "<option value=".strtolower($row->district_name).">".$row->district_name."</option>";
									}
								?>
	                        </select>
					</div>

					<div class="col-sm-5">

							<label for="district">AREA: </label>
							<select class="select-area-2" name="area">
								<option value="0" disabled>Select Area:</option>          
	                        </select>
	                </div>
                    <div class="col-sm-2">
                    	<input type="submit" name="submit" value="VIEW">
                    </div>
				</form>	
			</div><br/>
			<h3>CANDIDATES: </h3>
			<div id="district-view-candidate" class="col-xs-12">
				<?php 
					if($area == ""){
						$this->load->module('candidates');
						$data['candidate_query'] = $this->candidates->get_candidate_by_district($district_id);
					}
					if($area != ""){
						$this->load->module('candidates');
						// var_dump($area);
						$data['candidate_query'] = $this->candidates->get_candidate_by_area($district_id, $area);
					}
				?>				
			</div>

			
		</div>
		<div id="election-overview" class="col-md-4">
			<?php
				$this->load->view($path);
			?>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- <div class="charts col-sm-12">
	<div class="col-sm-4" id="chart_div_text"><h3>Total Voters in Past Years in <b style="color:#3e3e3e;"><?php echo strtoupper($district); ?></b></h3></div>
		<div class="col-sm-8" id="chart_div_2" class="col-sm-6"style="width: 700px; height: 400px;;">
			
		<?php

			$this->load->view('districts/charts');
		?>

		</div>
	</div> -->


	<div class="clearfix"></div>
</div>

<script type="text/javascript">
	// $(function(){
	// 	$(".select-district").on("change", function(){
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "<?php base_url();?>districts/get_where_district/", 
	// 		data: {district: $(".select-district").val()},
	// 		dataType: "text",  
	// 		cache:false,
	// 		success: 
	// 		  function(data){
	// 		  	// alert(data);
	// 		    $(".select-area").html("");
	// 				for(i=1; i<= parseInt(data); i++){
	// 					$(".select-area").append('<option value="'+i+'">'+i+'</option>');
	// 				}
	// 			}
	// 		});
	// 		return false;
	// 	 });
	// });
</script>

<script type="text/javascript">
 $(function(){
	$(".select-district-2").on("change", function(){
			var newDistrictName = $(".select-district-2").val();
			$('.district path').css("fill", "#93c6ea");
			$('#district-'+newDistrictName+' path').css("fill", "#e51717");
			
			// show district details on sidebar

			$("#district-name-details").html("<h2>"+newDistrictName+"</h2>");
			$("#district-name-details").show();
			$("#overview-details-all").hide();
			$("#overview-details").show();

			var request = $.ajax({
					url: "<?php echo base_url(); ?>districts/get_sidebar_option/",  // the file to be called
					type: "GET",	   // post method to be used
					data: {district: newDistrictName},   // data to be sent (eg. username:nj)
					dataType: "text"        // type of data expected
			});
			request.done(function( data ) {
				$("#overview-details").html("");
				var parts = data.split('-');
				console.log(newDistrictName);
				console.log(parts[0]);
				console.log(parts[1]);
				$("#overview-details").append("<span><b>Election Zones: &nbsp;</b>"+parts[1]+"</span><br/><br/>");			
				$("#overview-details").append("<span><b>Voting Population: &nbsp;</b>"+parts[0]+"</span><br/><br/>");			
			});

			// what if there was an error?
			request.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});


		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>districts/get_where_district/"+$(".select-district-2").val(), 
			dataType: "text",  
			cache:false,
			success: 
			  function(data){
				console.log($(".select-district-2").val());
			  	console.log(data);
			    $(".select-area-2").html("");
					for(i=1; i<= parseInt(data); i++){
						$(".select-area-2").append('<option value="'+i+'">'+i+'</option>');
					}
				}
		});
		return false;
	});
});
</script>


<?php
	$this->load->view('footer');
?>