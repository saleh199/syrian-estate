var app = {};

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
		
		// force modal to remove content on hidden
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
});