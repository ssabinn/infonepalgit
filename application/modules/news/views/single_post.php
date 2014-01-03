<div id="single" class="post col-xs-10">

	<div class='post-header'><h3><?php echo $news_headline; ?></h3></div>
	<div class='post-detail'><p>Posted by: <?php echo $news_posted_by; ?> on <?php echo $news_timestamp; ?></p></div>
	<div class='post-body'><p><?php echo $news_content; ?></p></div>

	<div class="fb-comments col-xs-12" data-href="<?php echo base_url(); ?>news/posts/<?php echo $news_url; ?>" data-colorscheme="light" data-numposts="10"></div>

</div>