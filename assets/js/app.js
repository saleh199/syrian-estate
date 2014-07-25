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

	app.initializeAddProperty = function(){
		var $form 	= $('#addpropertyfrm'),
			$bar	= $form.find('.progress-bar');
		$form.ajaxForm({
			dataType: 'JSON',
			type: 'POST',
			beforeSend: function(){
				$bar.attr('aria-valuenow', 0);
				$bar.width(0 + '%');
				$bar.html(0 + '%');

				$form.find('.progress').removeClass('hidden');
			},
			uploadProgress: function(event, position, total, percentComplete){
				$bar.attr('aria-valuenow', percentComplete);
				$bar.width(percentComplete + '%');
				$bar.html(percentComplete + '%');
			},
			success: function(){
				$bar.attr('aria-valuenow', 100);
				$bar.width('100%');
				$bar.html('100%');
			},
			complete: function(xhr){
				$form.find('.progress').addClass('hidden');
			}
		});
	}
});