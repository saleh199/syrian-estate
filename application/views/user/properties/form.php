<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
            
            <?php echo $this->view("user/user_menu"); ?>

            <div class="col-md-9">
                  <ol class="breadcrumb">
                        <li><a href="#">حسابي</a></li>
                        <li class="active">عقاراتي</li>
                  </ol>

                  <div class="row property-info">
                        <div class="col-md-12">
                              <?php echo $form_action;?>
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
                                                <button class="btn btn-success"> حفظ </button>
                                          </div>
                                    </div>
                              <?php echo form_close();?>
                        </div>
                  </div> <!-- /.property-info -->
            </div>
      </div> <!-- /.main -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
      <script type="text/javascript">
            $(function(){
                  app.mapInitialize("map-canvas");
            })
      </script>
    <?php echo $this->view("layouts/footer"); ?>