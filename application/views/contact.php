 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    * {
    box-sizing: border-box;
}

/* Style inputs */
input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
/*    margin-top: 6px;
    margin-bottom: 16px;*/
    resize: vertical;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

/* Style the container/contact section */
.container {
    border-radius: 5px;
    /*padding: 10px;*/
}

/* Create two columns that float next to eachother */
.column {
    float: left;
    width: 50%;
    margin-top: 6px;
    padding: 20px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}

/*.mapouter{text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}*/
</style>


	<!-- Breadcrumb section -->
	<div class="site-breadcrumb">
		<div class="container">
			<a href="#"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i>
			<span>Contact</span>
		</div>
	</div>
	<!-- Breadcrumb section end -->

<div style="text-align:center">
    <h2>Contact Us</h2>
    <!--<p>Swing by for a cup of coffee, or leave us a message:</p>-->
  </div>
	<!-- Courses section -->
	<section class="contact-page spad pt-0">
		<div class="container">
                    <div class="row">
                        <div class="col-md-6">
                    
			 <div class="map-section">
				<div class="contact-info-warp">
					<div class="contact-info">
						<h4>Address</h4>
						<p>DELTO (Dnyansankul e-Learning Training Organisation),
E1/1, State Bank Nagar, Behind Vanaz Co., Paud Road, Kothrud, Pune-411038, Maharashtra</p>
					</div>
					<div class="contact-info">
						<h4>Phone</h4>
						<p>09822280896 / 09822342224</p>
					</div>
					<div class="contact-info">
						<h4>Email</h4>
						<p>info@delto.in / dnyansankul@gmail.com</p>
					</div>
					<div class="contact-info">
						<h4>Working time</h4>
						<p>Monday - Saturday, 08:00AM - 08:00 PM</p>
					</div>
				</div>
                            
				<!-- Google map 
				<div class="map" id="map-canvas"></div> -->
			</div> 
                            </div>
                   
<div class="col-lg-6">
    <form action="<?php echo base_url();?>Home/contact_email" method="post">
        <label for="fname">Name</label>
        <input type="text" id="fname" name="name" placeholder="Your name..">
        <label for="lname">Email</label>
        <input type="text" id="email" name="email" placeholder="Your Email..">
        <label for="lname">Mobile No.</label>
        <input type="text" id="mobile" name="mobile" placeholder="Your Mobile No..">

        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
   
  <!--</div>-->
                        
                   
                        </div>
<!--			<div class="contact-form spad pb-0">
				<div class="section-title text-center">
					<h3>GET IN TOUCH</h3>
					 <p>Contact us for best deals and offer</p> 
				</div>
				<form class="comment-form contact">
					<div class="row">
						<div class="col-lg-4">
							<input type="text" placeholder="Your Name">
						</div>
						<div class="col-lg-4">
							<input type="text" placeholder="Your Email">
						</div>
						<div class="col-lg-4">
							<input type="text" placeholder="Subject">
						</div>
						<div class="col-lg-12">
							<textarea placeholder="Message"></textarea>
							<div class="text-center">
								<button class="site-btn">SUBMIT</button>
							</div>
						</div>
					</div>
				</form>
			</div>-->
<br>
<div class="mapouter">
    <div style=" border: 1px solid #85C1E9; margin: 50px; padding: 5px;" class="gmap_canvas">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15134.097834538823!2d73.8053088!3d18.5051874!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x97466f02eb98887f!2sDnyansankul+Prakashan!5e0!3m2!1sen!2sin!4v1536329162300" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div> 
    
		</div>
            
            <div class="container">

</div>

<!-- Initialize Google Maps -->
<script>
function myMap() {
  var myCenter = new google.maps.LatLng(51.508742,-0.120850);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
	</section>
	<!-- Courses section end-->


	<!-- Newsletter section -->
<!-- 	<section class="newsletter-section">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-lg-7">
					<div class="section-title mb-md-0">
					<h3>NEWSLETTER</h3>
					<p>Subscribe and get the latest news and useful tips, advice and best offer.</p>
				</div>
				</div>
				<div class="col-md-7 col-lg-5">
					<form class="newsletter">
						<input type="text" placeholder="Enter your email">
						<button class="site-btn">SUBSCRIBE</button>
					</form>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Newsletter section end -->	


