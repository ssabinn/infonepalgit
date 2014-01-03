<?php
	$this->load->view('header');
?>

			<div id="content" style="background: #efefef; width: 100%; height: 500px; z-index: 10;">

				<?php
					// foreach ($query->result() as $row) {
					// 	echo $row->candidate_name;
					// }
					if(!isset($view_file)){
						$view_file =""; 
					}

					if(!isset($module)){
						$module = $this->uri->segment(1);
					}
					if(($view_file!="") && ($module!="")){
						$path = $module."/".$view_file;
						$this->load->view($path);
					}
				?>

			</div>
		</div>

	</body>
</html>