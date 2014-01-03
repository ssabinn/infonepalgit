<!DOCTYPE html> 

<?php 
	$current_page = $this->uri->segment(1); 

	// echo $this->session->userdata('is_a');	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Info Nepal :: All about Nepal </title>

		<!-- <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico">
		<link rel="apple-touch-icon" href="<?php echo base_url();?>images/favicon.ico"> -->

		<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css" media="screen" />
		<link type="text/css" rel="Stylesheet" href="<?php echo base_url();?>css/bjqs.css" />

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600|PT+Serif:400,400italic'>

		<script src="<?php echo base_url();?>js/jquery.js"></script>
		<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

		<script type="text/javascript">

		$(function(){
		    // var BigDay = new Date("20 Nov 2013, 00:00:00");
		    // var msPerDay = 24 * 60 * 60 * 1000 ;

		    // window.setInterval(function(){
		    //     var today = new Date();
		    //     var timeLeft = (BigDay.getTime() - today.getTime());

		    //     var e_daysLeft = timeLeft / msPerDay;
		    //     var daysLeft = Math.floor(e_daysLeft);

		    //     // var e_hrsLeft = (e_daysLeft - daysLeft)*24;
		    //     // var hrsLeft = Math.floor(e_hrsLeft);

		    //     // var e_minsLeft = (e_hrsLeft - hrsLeft)*60;
		    //     // var minsLeft = Math.floor(e_minsLeft);

		    //     // var e_secsLeft = (e_minsLeft - minsLeft)*60;
		    //     // var secsLeft = Math.floor(e_secsLeft);


		    //     var timeString = daysLeft;
		    //     // alert(timeString);
		    //     $('#days-left').html(timeString);
		    // }, 1000);
		})
		</script>
	</head>

	<body>
		<div id="full-wrap">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=517454468350078";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<img id="background" src="<?php echo base_url();?>images/back.png"/>

		<div id="header-wrap">
			<header class="container">
				<div id="topbar" class="col-sm-12">
					<div class="col-md-3">
						<div id="logo" class="col-xs-12">
							<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo2.png" /></a>
						</div>
						<div id="logo-event" class="" style="display:none;">
							<span>ELECTION</span>
							<div class="clearfix"></div>
							<span id="days-left"></span>
							<div class="clearfix"></div>
							<span>DAYS LEFT</span>
						</div>
					</div>
				
					<div id="header-text" class="col-md-4">
						<p style="color:#e51717;">हामी नेपाली । हाम्रो नेपाल । जय नेपाल ।</p>
					</div>
					<div class="col-md-5">
						<div class="col-sm-12">
							<img id="nepal-flag" src="<?php echo base_url();?>images/nepal_flag.gif"/>
						</div>
						<div class="clearfix"></div>
						<div id="navigation" class="navbar navbar-collapse col-sm-12">
							<ul>
							<?php 
							$user_id = $this->session->userdata('user_id');
							if($user_id){ ?>
								<li><a id="nav-dashboard" href="<?php echo base_url();?>dashboard/home/" style="color: #fdfdfd; ">Dashboard</a></li>
								<?php }?>

								<li><a id="home" href="<?php echo base_url();?>" class="<?php if($current_page == ''){ echo 'active'; } ?>" target="_blank">HOME</a></li>
								<li><a id="election" href="<?php echo base_url();?>parties/all" class="<?php if($current_page == 'election'){ echo 'active'; } ?>" target="_blank">ELECTION 2013</a></li>
								<li><a id="news" href="<?php echo base_url();?>news/" class="<?php if($current_page == 'news'){ echo 'active'; } ?>" target="_blank">NEWS</a></li>
								<li><a id="blog" href="<?php echo base_url();?>blogs/" class="<?php if($current_page == 'blogs'){ echo 'active'; } ?>" target="_blank">BLOG</a></li>
							</ul>
						</div>
		
				</div>
				<div class="clearfix"></div>

				<!-- <div id="header-right" class="col-sm-12">
					
				</div> -->

			</header>
		</div>

<div id="content-wrap">
<div class="container">