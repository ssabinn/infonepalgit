<?php
	foreach ($query->result() as $row) { 
?>
	<div class="post col-xs-10">
<?php
		echo "<div class='post-header'><h3><a href='posts/".$row->blog_url."'>".$row->blog_title."</a></h3></div>";
		echo "<div class='post-detail'><p>Posted by: ".$row->posted_by." on ".$row->timestamp."</p></div>";
		echo "<div class='post-body'><p>".word_limiter($row->blog_content, 100)."</p></div>";
		echo "<a href='posts/".$row->blog_url."' class='btn btn-default'>Read More</a>";
?>	
	</div>
<?php
	}
?>
