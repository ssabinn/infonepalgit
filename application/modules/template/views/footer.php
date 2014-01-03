</div>
</div>

<div id="footer-wrap">
<div class="container">
	<footer class='col-xs-12'>
		<div class="footerdiv col-xs-8">
			<p>Copyright © Data Research and Analysis Center<a href="#">Terms & Condition  |</a>

			<?php 
				$user_id = $this->session->userdata('user_id');
				if(!$user_id){
			?>
			<a href="<?php echo base_url();?>users/login/">Login   |</a>
			<?php 
				}else{
			?>
			<a href="<?php echo base_url();?>users/logout/">Logout    |</a>
			<?php	
			}
			?>	
			<a href="<?php echo base_url();?>contact/">Contact</a> </p>
		</div>
		<div class="footerdiv right col-xs-4">
			<p> Powered by <a href="#">Team InfoNepal</a></p>
		</div>

	</footer>
	</div>
	</div>
	</div>

</body>

<!-- Script for slider -->

<script src="<?php echo base_url();?>js/bjqs.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $('#ads').bjqs({
	        'height' : 300,
	        'width' : 600,
	        'responsive' : true,
			'animtype' : 'fade', // accepts 'fade' or 'slide'
			showcontrols : false,
	    });
	    $('#ads2').bjqs({
	        'height' : 300,
	        'width' : 600,
	        'responsive' : true,
			'animtype' : 'fade', // accepts 'fade' or 'slide'
			showcontrols : false,
	    });
	});
</script>

<script>
$(window).scroll(function(){
    if ($(window).scrollTop() > 40){
        $("#header-wrap").addClass("fixed").addClass("shadow");
    } else {
        $("#header-wrap").removeClass("fixed").removeClass("shadow");
    }
});
</script>

<!-- Script for loading district names -->
<script type="text/javascript">

	$(function(){
		$("svg").on("click", "[id^=district]" ,function(){
	         var newId;
	         var newDistrictName;
	         var id=$(this).children('path').attr('id');
	         var district = $(this).attr('id');
	         newId=id.substring(id.indexOf("d")+1);
	         newDistrictName=district.substring(district.indexOf('-')+1);
	         window.location='districts/single/' + newDistrictName;
	         // alert('ID '+newId+' And District '+newDistrictName);
	    });

		$("svg").on('mouseout','[id^=district]',function(){
	        $("#district-name-details").hide();
	        $("#overview-details").hide();
	        $("#overview-details-all").show();
	    });
	    
	    $("svg").on('mouseenter','[id^=district]',function(){
	        var district = $(this).attr('id');
	        var newDistrictName;
	        newDistrictName=district.substring(district.indexOf('-')+1);
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
	    });

	// $("#select-district").on("change", function(){
			// 	var district = $(this).val();
			// 	$.post("districts/get_where_district/"+district, function(data){
			// 	// console.log(data);
			// 		$("#select-area").html("");
			// 		for(i=1; i<= parseInt(data); i++){
			// 			$("#select-area").append('<option value="'+i+'">'+i+'</option>');
			// 		}
			// 	}); 
			// });
	});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45611918-1', 'infonepal.net');
  ga('send', 'pageview');

</script>

</html>