var app = {};

$(function(){
	app.mapInitialize = function (){
		var mapOptions = {
			center: new google.maps.LatLng(32.7129167,36.5491359),
			zoom: 7,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById(arguments[0]), mapOptions);
	}
});