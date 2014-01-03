
<div id="content">
	<div id="election-data">
		<div id="map" class="col-md-8">
			<h4>VIEW CANDIDATES</h4>

			<?php 
				$this->load->module('map');
				$this->map->show_map();
			?>

			<style type="text/css">
				[id^='district'] path{
			        cursor:pointer;
					-webkit-transform:scale(1,1);

			    }
			    [id^='district']:hover path{
			        fill:#e41616;
			        }   
			        
			    [id^='district'] text{
			        cursor:pointer;
					display:none;
					font-family:Arial,San-serif;
			    }
			</style>

			
			<div id="view-candidate" class="col-sm-12 view-candidate">
				<form name="district_form" method="post" action="districts/districtArea" class="form-horizontal">
					
					<div class="col-sm-5">
					<label for="district">DISTRICT : </label>
					
						<select class="select-district" name="district" class="">
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
					<label for="district">AREA : </label>					
						<select class="select-area" name="area" class="">
							<option value="0" disabled>Select Area:</option>
          
                        </select>
                    </div>
                    <div class="col-sm-2">
                    	<input type="submit" name="submit" value="VIEW">
                    </div>
                   
				</form>				
			</div>
			<!-- <div id="view-candidate-small" class="col-xs-12">
				<form name="district_form" method="post" action="districts/districtArea" class="form-horizontal">

					<label for="district">DISTRICT : </label>

						<select class="select-district" name="district" class="">
                			<option value="0" disabled selected>Select District</option>
							<?php
								$this->load->module('districts');
								$query = $this->districts->get('district_name');
								foreach ($query->result() as $row) {
									echo "<option value=".strtolower($row->district_name).">".$row->district_name."</option>";
								}
							?>
                        </select>
					<br/><br/>
					<label for="district">AREA : </label>
		
						<select class="select-area" name="area" class="">
							<option value="0" disabled>Select Area:</option>
          
                        </select>
                    <br/><br/>
                    <input type="submit" name="submit" value="View"><br/>

				</form>				
			</div> -->
		</div>
		<div id="election-overview" class="col-md-4">
			<h4>OVERVIEW</h4>
			<div id="district-name-details"></div>
			<div class="overview-details" id="overview-details-all">
				<span><b style="color:#3887be;">Election Zones: &nbsp;</b></span><br/>
				<span><b>Total Zones: &nbsp;</b>240</span><br/>
				<span><b>Total Locations: &nbsp;</b>10,013</span><br/>
				<span><b>Total Booths: &nbsp;</b>18,456</span><br/><br/>
				<span><b style="color:#3887be;">Voting Population: &nbsp;</b></span><br/>
				<span><b>Male : &nbsp;</b>59,80,881</span><br/>
				<span><b>Female : &nbsp;</b>61,66,829</span><br/>
				<span><b>3rd Gender : &nbsp;</b>155</span><br/>
				<span><b>Total : &nbsp;</b>1,21,47,865</span><br/><br/>
				<span><b style="color:#3887be;">Candidates: &nbsp;</b></span><br/>
				<span><b>Total: &nbsp;</b>17,131</span><br/>
				<span><b>Direct Voting : &nbsp;</b>6,128</span><br/>
				<span><b>Proportionate : &nbsp;</b>11,300</span><br/><br/>
				<span><b>Competing Parties: &nbsp;</b>130</span><br/>
				<span><b>Budget: &nbsp;</b>Rs. 7,75,00,00,000</span><br/>
				<span><b>Security Officers: &nbsp;</b>2,10,000</span><br/>
				<span><b>Deployed Govt. Officers: &nbsp;</b>2,15,000</span><br/>
				<span><b>Election Supervisors: &nbsp;</b>74,000</span><br/><br/>

				

				<!-- <span ><b>What You Need For Election:</b></span><br/><br/> -->
				
				<!-- <div id="election-extra-details">
					<p>	(क) संघ/संस्था दर्ताको प्रमाणपत्रको प्रतिलिपि,</p>
					<p>	(ख) त्यस्तो संघ/संस्था नवीकरण भएको निस्साको प्रतिलिपि,</p>
					<p>	(ग) संघ/संस्थाको विधानको प्रतिलिपि,</p>
					<p>	(घ) संघ/संस्थाको कार्यक्रम एवं लेखापरीक्षण प्रतिवेदनको प्रतिलिपि,</p>
					<p>	(ङ) संस्थाका कार्य समितिका पदाधिकारीहरूको नामावली,</p>
					<p>	(च) विगतमा गरेका राष्ट्रिय/अन्तर्राष्ट्रिय निर्वाचन पर्यवेक्षणको अनुभव भए सो को प्रमाण,</p>
					<p>	(छ) पर्यवेक्षण सम्बन्धमा संघ/संस्थाले तयार पारेको ब्रोसर, पुस्तिका, निर्देशिका वा अन्य कुनै प्रकाशन भए सो समेत,</p>
					<p>	(ज) संघ/संस्थाले तयार गरेको पर्यवेक्षक परिचालन सम्वन्धी नीति ।</p>
				</div> -->
			</div>
			<div class="overview-details" id="overview-details" style="display:none;">
				
			</div>
		</div>


	</div>
	<div class="clearfix"></div>

	<div id="charts" class="col-sm-12" style="display:none;">
		<div class="col-sm-6" id="chart_div" class="col-md-6">
			<img src="<?php echo base_url(); ?>/images/chart1.png" class="img-responsive" />
			<div class="clearfix"></div>
			<h4><b>Total Voting Population in Past Years</b></h4>
		</div>
		<div class="col-sm-6" id="chart_div" class="col-md-6">
			<img src="<?php echo base_url(); ?>/images/chart2.png" class="img-responsive" />
			<div class="clearfix"></div>
			<h4><b>Percentage change in Voting Population</b></h4>
		</div>
	</div>

	<div class="clearfix"></div>

	<div id="recent-posts">		
		<!-- RSS FEED stuffs from here -->
		<div id="rss-feed" class="recent col-md-4">
			<h2>International News</h2>	
			<ul class="ticker">
			<?php 
			shuffle($rss_news);
			foreach ($rss_news as $row) { ?>
				<li>
					<span><a href="<?php echo $row['link']; ?>"><?php echo $row['title']; ?></a></span><br/>
					<span style="color:#999; font-weight: normal; font-size: 0.8em">
						<?php 
							if(strpos($row['link'], 'cnn.com')){ 
								echo "(CNN)"; 
							}elseif (strpos($row['link'], 'bbc')) {
								echo "(BBC)"; 
							}elseif (strpos($row['link'], 'aljazeera')) {
								echo "(Al Jazzera)"; 
							}elseif (strpos($row['link'], 'reuters')) {
								echo "(Reuters)"; 
							}elseif (strpos($row['link'], 'ap')) {
								echo "(AP)"; 
							}else{
								echo "";
							} 
						?>
					</span>
					<p><?php echo $row['description']; ?></p>
				</li>
			<?php }?>
			</ul>
		</div>

		<!-- RSS FEED stuffs ends here -->

		<div id="recent-news" class="recent col-md-4 effect2">
			<h2 class="">National News</h2>
			<ul class="nticker">
			<?php foreach ($news_query->result() as $row) { ?>
				<li>
				<span><a href="news/posts/<?php echo $row->news_url; ?>"><?php echo $row->news_headline; ?></a></span>
				<article>
					<?php 
						$this->load->helper('text');
						echo word_limiter($row->news_content, 20); 
					?>
				</article>
				</li>
			<?php } ?>
			</ul>
			<!-- <a href="news/posts/<?php echo $news_url?>" class="btn btn-default">Read More</a> -->
		</div>
		<!-- <div id="recent-blog" class="recent col-md-6">
			<h2>Blog</h2>
			<h3><a href="blogs/posts/<?php echo $blog_url; ?>"><?php echo $blog_title; ?></a></h3>
			<p><?php echo word_limiter($blog_content, 100); ?></p>
			<a href="blogs/posts/<?php echo $blog_url?>" class="btn btn-default">Read More</a>
		</div> -->

		<div id="recent-ads" class="recent col-md-4">
			<div id="ads" class="col-md-12">
			    <ul class="bjqs col-md-12">
			    	<?php
			    		$this->load->module('ads');
			    		$ads_query = $this->ads->get('id');
			    		foreach ($ads_query->result() as $row) {
			  			 	if($row->ads_category == '1'){
			  			    	echo '<li class="col-md-12 bjqs-slide"><a href="'.$row->ads_href.'"><img src="'.$row->ads_url.'" alt="'.$row->ads_name.'"/></a></li>';
			    			}
			    		}
			    	?>
			    </ul>
			</div>
			<div id="ads2" class="col-md-12">
			    <ul class="bjqs col-md-12">
			    	<?php
			    		$this->load->module('ads');
			    		$ads_query = $this->ads->get('id');
			    		foreach ($ads_query->result() as $row) {
			  			 	if($row->ads_category == '2'){
			  			    	echo '<li class="col-md-12 bjqs-slide"><a href="'.$row->ads_href.'" target="_blank"><img src="'.$row->ads_url.'" alt="'.$row->ads_name.'"/></a></li>';
			    			}
			    		}
			    	?>
			    </ul>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="recent-sports" class="recent col-md-4 effect2">
			<h2 class="">Sports News</h2>
			<ul class="ntickersports">
			<?php foreach ($sports_query->result() as $row) { 
			?>
				<li>
				<span><a href="news/posts/<?php echo $row->news_url; ?>"><?php echo $row->news_headline; ?></a></span>
				<article>
					<?php 
						$this->load->helper('text');
						echo word_limiter($row->news_content, 20); 
					?>
				</article>
				</li>
			<?php 
			}
			?>
			</ul>
			<!-- <a href="news/posts/<?php echo $news_url?>" class="btn btn-default">Read More</a> -->
		</div>

		<div id="recent-economics" class="recent col-md-4 effect2">
			<h2 class="">Economics News</h2>
			<ul class="ntickereconomics">
			<?php foreach ($economics_query->result() as $row) { ?>
				<li>
				<span><a href="news/posts/<?php echo $row->news_url; ?>"><?php echo $row->news_headline; ?></a></span>
				<article>
					<?php 
						$this->load->helper('text');
						echo word_limiter($row->news_content, 20); 
					?>
				</article>
				</li>
			<?php 
			}
			?>
			</ul>
			<!-- <a href="news/posts/<?php echo $news_url?>" class="btn btn-default">Read More</a> -->
		</div>
		
		<div id="facebook-like" class="recent col-md-4">
			<div class="fb-like-box" data-href="http://www.facebook.com/infonepal.net" data-width="360px" data-height="400px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
		</div>

	</div>
</div>



<script type="text/javascript">
		$(".select-district").on("change", function(){
			var newDistrictName = $(".select-district").val();
			$('.district path').css("fill", "#93c6ea");
			$('#district-'+newDistrictName+' path').css("fill", "#e51717");
			
			// show district details on sidebar

			$("#district-name-details").html("<h2>"+newDistrictName+"</h2>");
			$("#district-name-details").show();
			$("#overview-details-all").hide();
			$("#overview-details").show();

			var request = $.ajax({
					url: "districts/get_sidebar_option/",  // the file to be called
					type: "POST",	   // post method to be used
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


			// get area select options

			$.ajax({
				type: "GET",
				url: "<?php base_url();?>districts/get_where_district/"+$(".select-district").val(), 
				data: {district: $(".select-district").val()},
				dataType: "text",  
				cache:false,
				success: 
				  function(data){				
				  	// alert(data);
				    $(".select-area").html("");
						for(i=1; i<= parseInt(data); i++){
							$(".select-area").append('<option value="'+i+'">'+i+'</option>');
						}
					}
			});
			return false;
		});
</script>


<!-- script for the ticker -->

<script type="text/javascript">
	$(function(){
	    var ticker = function(){
	        setTimeout(function(){
	            $('.ticker li:first').animate( {marginTop: '-120px'}, 600, function(){
	                $(this).detach().appendTo('ul.ticker').removeAttr('style');
	            });
	            ticker();
	        }, 4000);
	    };
	    var nticker = function(){
	        setTimeout(function(){
	            $('.nticker li:first').animate( {marginTop: '-120px'}, 600, function(){
	                $(this).detach().appendTo('ul.nticker').removeAttr('style');
	            });
	            nticker();
	        }, 4000);
	    };
	    var ntickersports = function(){
	        setTimeout(function(){
	            $('.ntickersports li:first').animate( {marginTop: '-120px'}, 600, function(){
	                $(this).detach().appendTo('ul.ntickersports').removeAttr('style');
	            });
	            ntickersports();
	        }, 4000);
	    };
	    var ntickereconomics = function(){
	        setTimeout(function(){
	            $('.ntickereconomics li:first').animate( {marginTop: '-120px'}, 600, function(){
	                $(this).detach().appendTo('ul.ntickereconomics').removeAttr('style');
	            });
	            ntickereconomics();
	        }, 4000);
	    };
	    ticker();
	    nticker();
	    ntickersports();
	    ntickereconomics();
	});
</script>

		

<?php
	$this->load->view('footer');
?>