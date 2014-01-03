<?php
	foreach ($query->result() as $row) { 
?>
	<article class="post col-xs-10">
<?php
		echo "<div class='post-header'><h3><a href='posts/".$row->news_url."'>".$row->news_headline."</a></h3></div>";
		echo "<div class='post-detail'><p>Posted by: ".$row->posted_by." on ".$row->timestamp."</p></div>";
		echo "<div class='post-body'><p>".word_limiter($row->news_content, 100)."</p></div>";
		echo "<a href='posts/".$row->news_url."' class='btn btn-default'>Read More</a>";
?>	
	</article>
<?php
	}
?>
<div class="clearfix"></div>

<?php 
	echo $this->pagination->create_links();
?>	
