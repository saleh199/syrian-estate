var app = {};

$(function(){
	app.init = function(){
		html = '<div class="modal fade" id="modal" role="dialog" tabindex="-1">';
		html = html + '<div class="modal-dialog">';
		html = html + '<div class="modal-content">';
		html = html + '</div><!-- /.modal-content -->';
		html = html + '</div><!-- /.modal-dialog -->';
		html = html + '</div><!-- /.modal -->';
		$("body").append(html);
		
		// force modal to remove content on hidden
		$('#modal').on('hidden.bs.modal', function () {
			$(this).removeData('bs.modal');
		});


		/* start add property method */
		$("#menuAddHandler").click(function( event ){
			$("#modal").modal();

			event.preventDefault();
		});
		/* end add property method */
	};

	/* start initialize search map */
	app.mapInitialize = function (){
		var mapOptions = {
			center: new google.maps.LatLng(32.7129167,36.5491359),
			zoom: 7,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById(arguments[0]), mapOptions);
	}
	/* end initialize search map */
});