var app = {};
app.markers = [];

$(function(){

	function loadRemoteModal(url){
		app.Modal.modal();
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

		app.Modal = $("#modal");
		
		/*  force modal to remove content on hidden */
		app.Modal.on('hidden.bs.modal', function () {
			$(this).removeData('bs.modal');
			$("#modal .modal-content").empty();
		});

		app.Modal.on('show.bs.modal', function(){
			$("#modal .modal-content").html('<div class="ajax-loader text-center"><img src="'+ app.config.assetsPath +'image/ajax-loader.gif?ss" width="66px" height="66px"></div>');
		});
	};

	/* start initialize search map */
	app.mapInitialize = function (mapCanvas, options, _zoom_changed){
		if(typeof(options) == 'object'){
			var center = new google.maps.LatLng(options.lat,options.lng);
			zoom = options.zoom;
		}else{
			var center = new google.maps.LatLng(32.7129167,36.5491359);
			zoom = 13;
		}

		var mapOptions = {
			center: center,
			zoom: zoom,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl : false,
			overviewMapControl: false
		};

		/* console.log(mapOptions); */

		app.map = new google.maps.Map(document.getElementById(mapCanvas), mapOptions);

		if(typeof(_zoom_changed) == "function"){
			google.maps.event.addListener(app.map, 'zoom_changed', function() {
				_zoom_changed.call(window, app.map.getZoom());
			});
		}
	}
	/* end initialize search map */

	app.addMarker = function(markerOpt, _dragend_callback, _infoWindowContent){
		var marker = new google.maps.Marker(markerOpt);
		app.markers.push(marker);

		if(typeof(_dragend_callback) == "function"){
			google.maps.event.addListener(marker, 'dragend', function(){
				_dragend_callback.call(window, marker.getPosition());
			});

			google.maps.event.addListener(app.map, "click", function(event) {
				lat = event.latLng.lat();
				lng = event.latLng.lng();

				marker.setPosition(event.latLng);
				_dragend_callback.call(window, marker.getPosition());
			});
		}


		if(_infoWindowContent != ''){
			var infowindow = new google.maps.InfoWindow({
				content: _infoWindowContent
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(app.map,marker);
			});
		}
	}

	app.imagesManagement = function(_formId){
		var $form 	= $(_formId),
			$bar	= $form.find('.progress-bar');

		$(function(){
			$form.ajaxForm({
				dataType: 'JSON',
				type: 'POST',
				/* beforeSubmit: validate, */
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
					console.log(xhr.responseJSON);
					$form.find('.progress').addClass('hidden');
					json = xhr.responseJSON;

					if(json.result == 'fail'){
						$.each(json.errors, function(index, value){
							if(index == 'alert'){
								alert(value);
							}else{
								$form.find('#'+index).parent('div.form-group').addClass('has-error');
							}
						})
					}else if(json.result == 'success'){
						$form[0].reset();
						html = '<div class="col-md-3 image-item">';
						html = html + '<div class="thumbnail" data-image-id="'+json.inserted+'">';
						html = html + '<img src="'+json.image_src+'" width="147px" height="147px">';
						html = html + '<a class="text-danger tools-btn remove"><span class="glyphicon glyphicon-trash"></span></a>';
						html = html + '</div></div>';

						$('#images .images-list').append(html);
					}
				}
			});

			$('.uploadimg-btn').on('click', function(){
				$form.submit();
			});

			$('.images-list').delegate('.tools-btn.remove', 'click', function(){
				image_id = $(this).parent('.thumbnail').data('image-id');

				$.ajax({
					dataType : 'JSON',
					type : 'POST',
					url : app.deleteImage,
					context : $(this),
					data : 'property_image_id=' + image_id + '&'+app.config.csrf_token_name+'='+$form.find('input[name='+app.config.csrf_token_name+']').val()+'&property_id='+app.property_id,
					complete: function(xhr){
						console.log(xhr.responseJSON);
						json = xhr.responseJSON;

						if(json.result == 'fail'){
							alert('حدث خطأ اثناء العملية');
						}else if(json.result == 'success'){
							$(this).parent('.thumbnail').parent('.image-item').remove();
						}
					}
				});
			});
		});
	}
});