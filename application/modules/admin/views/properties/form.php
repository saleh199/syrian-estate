<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>إدارة الإعلانات العقارية</h1>
        		</div>
        	</div>
        	<div class="row">
                <?php if($message) { ?>
                <div class="col-md-8">
                    <div class="alert alert-danger"><?php echo $message;?></div>
                </div>
                <?php } ?>
                <?php echo $form_action;?>
                <?php echo $input_map_lat;?>
                <?php echo $input_map_lng;?>
                <?php echo $input_map_zoom;?>
        		<div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-box clearfix">
                                <header class="main-box-header clearfix">
                                    <h2>حالة العقار</h2>
                                </header>
                                <div class="main-box-body clearfix">
                                    <div class="form-group">
                                        <?php echo $input_status_1;?>
                                        عرض
                                
                                        <?php echo $input_status_2;?>
                                        رفض
                                    </div>
                                </div>
                            </div>
                            <div class="main-box clearfix">    
                                <header class="main-box-header clearfix">
                                    <h2>عقار مميز</h2>
                                </header>
                                <div class="main-box-body clearfix">
                                    <div class="form-group">
                                        <?php echo $input_featured_1;?>
                                        نعم
                                
                                        <?php echo $input_featured_2;?>
                                        لا
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
                            <h2>تعديل الإعلان</h2>
        				</header>
        				<div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>عنوان الإعلان</label>
                                <?php echo $input_title;?>
                            </div>

                            <div class="form-group">
                                <label>حالة العقار</label>
                                <?php echo $dropdown_property_status;?>
                            </div>

                            <div class="form-group">
                                <label>نوع العقار</label>
                                <?php echo $dropdown_property_type;?>
                            </div>

                            <div class="form-group">
                                <label>السعر</label>
                                <?php echo $input_price;?>
                            </div>

                            <div class="form-group">
                                <label>مساحة العقار</label>
                                <?php echo $input_area;?>
                            </div>

                            <div class="form-group">
                                <label>وصف العقار</label>
                                <?php echo $input_description;?>
                            </div>

                            <div class="form-group">
                                <label>الخدمات الملحقة</label>
                                <?php echo $input_services;?>
                            </div>
        				</div>
        			</div>
        		</div>
                <div class="col-md-7">
                    <div class="main-box clearfix">
                        <header class="main-box-header clearfix">
                            <h2>تحديد الإعلان على الخريطة</h2>
                        </header>

                        <div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>المنطقة</label>
                                <?php echo $dropdown_zone;?>
                            </div>

                            <div class="form-group">
                                <div id="map-canvas" style="height:350px;"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
        	</div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
            $(function(){
                  var center = {};

                  if($("#propertyfrm input[name=map_lat]").val() != '' && $("#propertyfrm input[name=map_lng]").val() != ''){
                        center.lat = $("#propertyfrm input[name=map_lat]").val();
                        center.lng = $("#propertyfrm input[name=map_lng]").val();
                        center.zoom = parseInt($("#propertyfrm input[name=map_zoom]").val());
                  }else{
                        center.lat = 32.71252485795853;
                        center.lng = 36.56646966934204;
                        center.zoom = 15;
                  }

                  app.mapInitialize("map-canvas", center, function(zoom){
                        $("#propertyfrm input[name=map_zoom]").val(zoom);
                  });

                  app.addMarker({
                        position : app.map.getCenter(),
                        map: app.map,
                        draggable : true
                  }, function (latlng){
                        $("#propertyfrm input[name=map_lat]").val(latlng.lat());
                        $("#propertyfrm input[name=map_lng]").val(latlng.lng());
                  });

                  //app.imagesManagement('#propertyimagefrm');
            })
      </script>
<?php $this->view('layouts/footer');?>
