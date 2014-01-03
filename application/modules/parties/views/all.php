<table class="lists col-xs-10">
<?php
	foreach ($query->result() as $row) { 
		$id = $row->id - 1;
?>
<?php
		echo "<tr class='border-bottom'>";
		echo "<td class='listbck col-xs-1'><span>".$id."</span></td>";
		echo "<td class='listbck col-xs-3'><img src=".base_url().$row->flag." width='60' height='60'/></td>";
		echo "<td class='listbck col-xs-8'><a href=".base_url()."parties/single/".$row->id."><span>".$row->party_name."</span></td>";
		echo "</tr>";
	}
?>
</table>
