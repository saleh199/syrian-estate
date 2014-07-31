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


		/* start add property method */
		$("#menuAddHandler").click(function( event ){
			loadRemoteModal(app.config.sitePath + 'property/addModal');
			event.preventDefault();
		});
		/* end add property method */
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

	app.addMarker = function(markerOpt, _dragend_callback){
		console.log(markerOpt);
		marker = new google.maps.Marker(markerOpt);
		app.markers.push(marker);

		if(typeof(_dragend_callback) == "function"){
			google.maps.event.addListener(marker, 'dragend', function(){
				_dragend_callback.call(window, marker.getPosition());
			});
		}
	}

	app.initializeAddProperty = function(){
		var $form 	= $('#addpropertyfrm'),
			$bar	= $form.find('.progress-bar');

		function validate(formData, jqForm, options){
			$form.find('.has-error').removeClass('has-error');
			$form.find('input, select, textarea').tooltip('destroy');

			var form = jqForm[0];
			if(!form.property_status.value){
				jQuery(form.property_status).parent('div.form-group').addClass('has-error');
				jQuery(form.property_status).tooltip({
					title : 'مطلوب'
				}).tooltip('show');
			}

			if(!form.property_type.value){
				jQuery(form.property_type).parent('div.form-group').addClass('has-error');
				jQuery(form.property_type).tooltip({
					title : 'مطلوب'
				}).tooltip('show');
			}

			if(!form.price.value){
				jQuery(form.price).parent('div.form-group').addClass('has-error');
				jQuery(form.price).tooltip({
					title : 'مطلوب'
				}).tooltip('show');
			}else{
				if((!isNaN(parseFloat(form.price.value)) && isFinite(form.price.value)) == false){
					jQuery(form.price).parent('div.form-group').addClass('has-error');
					jQuery(form.price).tooltip({
						title : 'السعر يجب أن يكون صحيح'
					}).tooltip('show');
				}
			}

			if(!form.description.value){
				jQuery(form.description).parent('div.form-group').addClass('has-error');
				jQuery(form.description).tooltip({
					title : 'مطلوب'
				}).tooltip('show');
			}

			if(!form.image.value){
				jQuery(form.image).parent('div.form-group').addClass('has-error');
				jQuery(form.image).tooltip({
					title : 'مطلوب'
				}).tooltip('show');
			}

			if($form.find('.has-error').length > 0){
				return false;
			}

			return true;
		}

		$(function(){
			$form.ajaxForm({
				dataType: 'JSON',
				type: 'POST',
				beforeSubmit: validate,
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
						app.Modal.modal('hide');
					}
				}
			});

			$('#addpropertybtn').on('click', function(){
				$form.submit();
			});
		});
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


	app.initializeMapSearch = function(_formId){
		function setAllMap(map) {
			for (var i = 0; i < app.markers.length; i++) {
				app.markers[i].setMap(map);
			}
		}

		function clearMarkers() {
			setAllMap(null);
		}

		function deleteMarkers() {
			clearMarkers();
			app.markers = [];
		}

		var $form = $(_formId);

		$(window).on("hashchange", function(){
			if(location.hash.length > 0){
				params = $.parseParams(location.hash);
				//console.log(params);

				$.ajax({
					url : app.mapSearchURL,
					dataType : 'json',
					type : 'get',
					success : function(){
						clearMarkers();
					},
					complete : function(xhr){
						json = xhr.responseJSON;

						$.each(json.results, function(index, item){
							if(item.map_lat && item.map_lng){
								app.addMarker({
									position : new google.maps.LatLng(item.map_lat, item.map_lng),
									map: app.map,
									title : item.title
								});
							}
						});
					}
				});
			}
		});

		$(window).on('load', function(){
			$(window).trigger('hashchange');
		});

		$('#mapsearchbtn').click(function(){
			querystring = $form.serialize();
			location.hash = querystring;
		});
	}

});