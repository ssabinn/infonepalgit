<?php
class Rss_reader extends MX_controller{
	

	function get_rss(){
		//loading rssparser library
		// $this->load->library('rssparser');

		// setting the rss url to be used source: cnn.com
			//address for top stories
			//address for world news
			// $this->rssparser->set_feed_url('http://rss.cnn.com/rss/edition_world.rss');
			// //address for business news
			// $this->rssparser->set_feed_url('http://rss.cnn.com/rss/edition_business.rss');
			// //address for sports
			// $this->rssparser->set_feed_url('http://rss.cnn.com/rss/edition_sport.rss');

		// rss results limit to 6 number of records
		// $data['channel'] = $this->rssparser->getChannelData();
		$rss_news1= $this->rssparser->set_feed_url('http://www.aljazeera.com/Services/Rss/?PostingId=2007731105943979989')->set_cache_life(60)->getFeed(5);
		// $rss_news2= $this->rssparser->set_feed_url('http://rt.com/rss/')->set_cache_life(60)->getFeed(6);
		// $rss_news1 += $this->rssparser->getChannelData();
		$rss_news3= $this->rssparser->set_feed_url('http://rss.cnn.com/rss/edition.rss')->set_cache_life(60)->getFeed(5);
		// $rss_news4= $this->rssparser->set_feed_url('http://feeds.bbci.co.uk/news/rss.xml')->set_cache_life(60)->getFeed(5);
		// $rss_news5= $this->rssparser->set_feed_url('http://feeds.reuters.com/reuters/topNews')->set_cache_life(60)->getFeed(5);
		$rss_news6= $this->rssparser->set_feed_url('http://hosted2.ap.org/atom/APDEFAULT/cae69a7523db45408eeb2b3a98c0c9c5')->set_cache_life(60)->getFeed(5);
		/**
		 * @param $news contains only 5 fields by default: 
		 * title, description, pubDate, link, author
		 */

		// var_dump($data);
		// var_dump($rss_news);
		// var_dump($rss_news[0]);

		// cache life in minutes
		// $this->rssparser->set_cache_life(60); 
		
		//testing the result by echoing
		// foreach($news as $records){
			// echo '<b> Title: </b>' . $records['title'].'<br>';
			// echo '<b> Description: </b>' . $records['description'].'<br>';
			// echo '<b> Published Date: </b>' . $records['pubDate'].'<br>';
			// echo '<b> Anchor: </b>' . $records['link'].'<br>';
			// echo '<b> Author: </b>' . $records['author'].'<br><br><br>';
			//echo '<pre>'.print_r($news).'</pre><br>';
		// }

		$data['rss_news'] = array_merge($rss_news1, $rss_news3, $rss_news6);
		return $data;
		//loading into the view
	}
}