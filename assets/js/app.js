var app = {};

$(function(){

	function loadRemoteModal(url){
		$("#modal").modal();
		$("#modal-cache").load(
			url,
			function(){
				$("#modal .modal-content").html($("#modal-cache").html());
			}
		);
	}

	app.init = function(){
		html = '<div class="modal fade" id="modal" role="dialog" tabindex="-1">';
		html = html + '<div class="modal-dialog">';
		html = html + '<div class="modal-content">';
		html = html + '</div><!-- /.modal-content -->';
		html = html + '</div><!-- /.modal-dialog -->';
		html = html + '</div><!-- /.modal -->';
		html = html + '<div id="modal-cache" class="hidden"></div>';
		$("body").append(html);
		
		// force modal to remove content on hidden
		$('#modal').on('hidden.bs.modal', function () {
			$(this).removeData('bs.modal');
			$("#modal .modal-content").empty();
		});

		$('#modal').on('show.bs.modal', function(){
			$("#modal .modal-content").html('<div class="ajax-loader text-center"><img src="'+ app.config.assetsPath +'image/ajax-loader.gif?ss" width="66px" height="66px"></div>');
		});


		/* start add property method */
		$("#menuAddHandler").click(function( event ){
			loadRemoteModal(app.config.sitePath + 'property/addModal');
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