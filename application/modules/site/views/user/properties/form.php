<?php echo $this->view("layouts/header", array("map" => false)); ?>
<script type="text/javascript">
      app.deleteImage = '<?php echo site_url("user/properties/delete_image");?>';
      app.uploadImage = '<?php echo site_url("user/properties/upload"); ?>';
      app.property_id = '<?php echo $property_info->property_id;?>';
</script>

      <div class="row main">
            
            <?php echo $this->view("user/user_menu"); ?>

            <div class="col-md-9">
                  <ol class="breadcrumb">
                        <li><a href="#">حسابي</a></li>
                        <li class="active">عقاراتي</li>
                  </ol>

                  <div class="row property-info">
                        <div class="col-md-12">
                              <ul class="nav nav-tabs" role="tablist">
                                    <li class="active">
                                          <a href="#main-details" role="tab" data-toggle="tab">المعلومات الرئيسية</a>
                                    </li>
                                    <li>
                                          <a href="#images" role="tab" data-toggle="tab">صور العقار</a>
                                    </li>
                              </ul>
                        </div>
                        <div class="tab-content col-md-12">
                              <div class="tab-pane active" id="main-details">
                                    <?php echo $form_action;?>
                                    <?php echo $hidden_map_lat;?>
                                    <?php echo $hidden_map_lng;?>
                                    <?php echo $hidden_map_zoom;?>

                                    <?php if(isset($errors) && $errors) { ?>
                                    <div class="alert alert-danger" role="alert">
                                          <?php echo $errors;?>
                                    </div>
                                    <?php }

                                    if (isset($success) && $success) { ?>
                                    <div class="alert alert-success" role="alert">
                                          <?php echo $success;?>
                                    </div>
                                    <?php } ?>
                                          <div class="form-group">
                                                <label class="control-label col-md-2">عنوان الإعلان      :</label>
                                                <div class="col-md-6">
                                                      <?php echo $input_title;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">حالة العقار :</label>
                                                <div class="col-md-6">
                                                      <?php echo $dropdown_property_status;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">نوع العقار :</label>
                                                <div class="col-md-6">
                                                      <?php echo $dropdown_property_type;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">سعر العقار :</label>
                                                <div class="col-md-6">
                                                      <?php echo $input_price;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">مساحة العقار :</label>
                                                <div class="col-md-6">
                                                      <?php echo $area_input;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">وصف العقار :</label>
                                                <div class="col-md-6">
                                                      <?php echo $input_description;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">العنوان :</label>
                                                <div class="col-md-6">
                                                      <?php echo $input_address;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">الخدمات الملحقة :</label>
                                                <div class="col-md-6">
                                                      <?php echo $input_services;?>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <label class="control-label col-md-2">المنطقة</label>
                                                <div class="col-md-6">
                                                      <?php echo $dropdown_zone;?>
                                                </div>
                                          </div>

                                          <div class="row">
                                                <div class="col-md-12 map-holder">
                                                      <div id="map-canvas"></div>
                                                </div>
                                          </div>

                                          <div class="form-group">
                                                <div class="col-md-12">
                                                      <button type="submit" class="btn btn-success"> حفظ </button>
                                                </div>
                                          </div>
                                    <?php echo form_close();?>
                              </div><!-- /#main-details -->

                              <div class="tab-pane" id="images">
                                    <br>
                                    <p class="text-success"><b>ملاحظة: أول صورة ستحمل هي صورة العقار</b></p>
                                    <br>
                                    <p class="text-danger"><b>يجب تحميل صورة واحدة على الأقل ليتم عرض العقار</b></p>
                                    <br>
                                    <div class="row images-list">
                                          <?php foreach($property_info->images as $image) { ?>
                                          <div class="col-md-3 image-item">
                                                <div class="thumbnail" data-image-id="<?php echo $image->property_image_id;?>">
                                                      <img src="<?php echo $image->image_fullpath; ?>" width="147px" height="147px">
                                                      <a class="text-danger tools-btn remove">
                                                            <span class="glyphicon glyphicon-trash"></span>
                                                      </a>
                                                </div>
                                          </div>
                                          <?php } ?>
                                    </div> <!-- /.images-list -->
                                    <div class="row">
                                          <div class="col-md-12">
                                                <?php echo $form_image_action; ?>
                                                <div class="form-group col-md-5">
                                                      <?php echo $input_image; ?>
                                                </div>
                                                <div class="form-group col-md-2 text-center">
                                                      <button class="btn btn-primary uploadimg-btn" type="button">تحميل</button>
                                                </div>
                                                <div class="col-md-5 text-center">
                                                      <div class="progress hidden" style="margin-top: 7px;">
                                                            <div class="progress-bar "  role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"></div>
                                                      </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                          </div>
                                    </div>
                              </div><!-- /#images -->
                        </div>
                  </div> <!-- /.property-info -->
            </div>
      </div> <!-- /.main -->
      <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js');?>"></script>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.16&language=ar"></script>
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

                  app.imagesManagement('#propertyimagefrm');
            })
      </script>
    <?php echo $this->view("layouts/footer"); ?>