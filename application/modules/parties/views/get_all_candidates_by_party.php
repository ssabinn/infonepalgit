<div id="party-candidates" class="lists col-xs-12" >
<table >
<?php

    $party_id = $this->uri->segment(3);

    $this->load->module('candidates');
	$query = $this->candidates->get_all_candidates_by_party($party_id);

	foreach ($query->result() as $row) { 
		// $id = $row->id - 1;
?>
<?php

		echo "<tr class='border-bottom'>";
		echo "<td class='listbck col-xs-1'><span>".$row->id."</span></td>";

		if($row->party_id){
			$this->load->module('parties');
			$party_query = $this->parties->get_where($row->party_id);
			foreach ($party_query->result() as $party_row) {
				$flag_id = $party_row->flag;
				echo "<td class='listbck col-xs-2'><a href=".base_url()."parties/single/".$row->party_id."><img src=".base_url().$flag_id." width='60' height='60'/></a></td>";
			}
		}else{
			echo "<td class='listbck col-xs-2'><img src='' width='60' height='60'/><span></span></td>";
		}
		// echo "<td class='listbck col-xs-3'><img src=".base_url().$row->flag." width='60' height='60'/></td>";
		echo "<td class='listbck col-xs-4'><a href=".base_url()."candidates/single/".$row->id."><span>".$row->candidate_name."</span></a></td>";
		
		$this->load->module('districts');
		$district_query = $this->districts->get_where($row->district_id);
		foreach ($district_query->result() as $district_row) {
			// $district_name = $district_row->district_name;
			echo "<td class='listbck col-xs-3'><a href=".base_url()."districts/single/".strtolower($district_row->district_name)."><span>".$district_row->district_name."</span></a></td>";
		}	

		echo "<td class='listbck col-xs-2'><a href=".base_url()."candidates/single/".$row->id."><span>Area: ".$row->area."</span></td>";
		echo "</tr>";
	}
?>
</table>
</div>