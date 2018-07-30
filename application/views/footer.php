   

<div class="footer text-center"> Copyright © 2018 Webosys Technologies. All rights reserved.</div>
	<script src="<?php echo base_url();?>assets/exam/js/jquery-2.1.4.min.js"></script>
	<script src="<?php echo base_url();?>assets/exam/js/bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/exam/js/move-top.js"></script>
	<script src="<?php echo base_url();?>assets/exam/js/smoothscroll.js"></script>
	<script src="<?php echo base_url();?>assets/exam/js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url();?>assets/exam/js/grayscale.js"></script>
	
	<script>
			// You can also use "$(window).load(function() {"
			$(function () {
				// Slideshow 4
				$("#slider4").responsiveSlides({
					auto: true,
					pager: true,
					nav: true,
					speed: 500,
					namespace: "callbacks",
					before: function () {
						$('.events').append("<li>before event fired.</li>");
					},
					after: function () {
						$('.events').append("<li>after event fired.</li>");
					}
				});

			});
	</script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: false,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<script src="js/responsiveslides.min.js"></script>
	<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
	<!-- //stats -->
	
	
<!-- js for gallery -->
<script type="text/javascript" src="<?php echo base_url();?>assets/exam/js/jquery.chocolat.js"></script>
<script>
$(function(){
                $('#gal').Chocolat({
                    imageSize: 'contain'
                });
            });
</script>
	<script type="text/javascript">
	$(document).ready(function() {
	var defaults = {
	containerID: 'toTop', // fading element id
	containerHoverID: 'toTopHover', // fading element hover id
	scrollSpeed: 1200,
	easingType: 'linear' 
	};
	$().UItoTop({ easingType: 'easeOutQuart' });

	});
	</script>
<!-- //js for gallery -->	
</body>
</html>