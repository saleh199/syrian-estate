<?php echo $this->view("layouts/header", array("map" => true)); ?>
      <script type="text/javascript">
            app.mapSearchURL = '<?php echo site_url("map/search");?>';
            app.propertyView = '<?php echo site_url("property/view");?>';
      </script>
      <div class="row main">

      	<div class="col-md-3 search-box">
      		<h4>بحث عن عقار</h4>
                  
                  <?php echo $form_action ;?>
                        <div class="form-group">
                           <label class="control-label">المنطقة</label>
                           <?php echo $dropdown_zone; ?>
                        </div>

                        <div class="form-group">
                              <label class="control-label">نوع العقار</label>
                              <?php echo $dropdown_property_type; ?>
                        </div>

                        <div class="form-group">
                              <label class="control-label">حالة العقار</label>
                              <?php echo $dropdown_property_status; ?>
                        </div>

                        <div class="form-group">
                              <label class="control-label">أعلى سعر</label>
                              <?php echo $input_max_price; ?>
                        </div>

                        <div class="form-group">
                              <label class="control-label">اقل سعر</label>
                              <?php echo $input_min_price; ?>
                        </div>

                        <button id="mapsearchbtn" class="btn btn-danger btn-block" type="button">بحث</button>
                  <?php echo form_close(); ?>

      	</div> <!-- /.search-box -->

      	<div class="col-md-9 map-holder">
      		<div id="map-canvas"></div>
                  <div class="search-loader hidden">جاري البحث</div>
      	</div> <!-- /.map-holder -->

      </diyv> <!-- /.main -->
      <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.parseparams.js');?>"></script>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
      <script type="text/javascript">
      	$(function(){
      		app.mapInitialize("map-canvas");
                  app.initializeMapSearch("#mapsearchfrm");
      	})
      </script>

    <?php echo $this->view("layouts/footer"); ?>