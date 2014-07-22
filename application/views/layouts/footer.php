</div> <!-- /.site-wrapper -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url("assets/js/jquery-1.11.1.min.js");?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
	<script src="<?php echo base_url("assets/js/docs.min.js");?>"></script>

	<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	function initialize() {
		var mapOptions = {
			center: new google.maps.LatLng(32.7129167,36.5491359),
			zoom: 7,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</body>
</html>