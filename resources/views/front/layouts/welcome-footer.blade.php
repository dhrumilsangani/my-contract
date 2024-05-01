	<!-- Start Footer Area -->
	
    <!--/ End Footer Area -->

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('front/js/jquery-3.6.0.js') }}"></script>
    
    <script type="text/javascript">
        var baseurl = <?php echo "'".url('/')."';"; ?>;
        var csrf_token = <?php echo "'".csrf_token()."';"; ?>
	</script>
	
	<script>
	// Set the date we're counting down to
	var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

	  // Get todays date and time
	  var now = new Date().getTime();

	  // Find the distance between now an the count down date
	  var distance = countDownDate - now;

	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Display the result in an element with id="demo"
	  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
	  + minutes + "m " + seconds + "s ";

	  // If the count down is finished, write some text
	  if (distance < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML = "EXPIRED";
	  }
	}, 1000);
	</script>