<div id="single" class="post col-xs-10">

	<div class='post-header'><h3><?php echo $blog_title; ?></h3></div>
	<div class='post-detail'><p>Posted by: <?php echo $blog_posted_by; ?> on <?php echo $blog_timestamp; ?></p></div>
	<div class='post-body'><p><?php echo $blog_content; ?></p></div>

	<br/>
	<hr>
	<div class="fb-comments" data-href="http://infonepal.net/blogs/posts/<?php echo $blog_id; ?>" data-colorscheme="light" data-numposts="10"></div>

</div>