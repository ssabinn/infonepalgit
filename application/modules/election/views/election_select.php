<h2>Select District and Area</h2>
<br/>
<div class="admin-make">
</div>

<br/>
<br/>

<div id="admin-view-candidate" class="col-sm-12">
	<form name="district_form" method="post" action="<?php echo base_url(); ?>election/manage">
		<label for="district">DISTRICT : </label>
		<select id="admin-select-district" name="district">
			<option value="0" disabled selected>Select District</option>
			<?php
				$this->load->module('districts');
				$query = $this->districts->get('district_name');
				foreach ($query->result() as $row) {
					echo "<option value=".strtolower($row->district_name).">".$row->district_name."</option>";
				}
			?>
        </select><br/>
		<label for="district">AREA : </label>					
		<select id="admin-select-area" name="area">
			<option value="0" disabled>Select Area:</option>

        </select><br/>
        <input type="submit" name="submit" value="VIEW">       
	</form>				
</div>

<script type="text/javascript">
	$("#admin-select-district").on("change", function(){
		// alert($("#admin-select-district").val());

		// get area select options
		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>districts/get_where_district/"+$("#admin-select-district").val(), 
			dataType: "text",  
			success: 
			  function(data){				
			  	// alert(data);
			  	// alert($("#admin-select-district").val());
			    $("#admin-select-area").html("");
					for(i=1; i<= parseInt(data); i++){
						$("#admin-select-area").append('<option value="'+i+'">'+i+'</option>');
					}
				}
		});
		return false;
	});
</script>