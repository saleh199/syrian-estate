<?php $this->view('layouts/header'); ?>
<script type="text/javascript">
      app.deleteImage = '<?php echo site_url("admin/project/delete_image");?>';
      app.uploadImage = '<?php echo site_url("admin/project/upload"); ?>';
      app.project_id = '<?php echo $project_info->project_id;?>';
</script>
<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>إدارة المشاريع العقارية</h1>
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
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
                            <h2>معلومات التواصل</h2>
        				</header>
        				<div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>اسم التواصل</label>
                                <?php echo $input_person_name;?>
                            </div>

                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <?php echo $input_email;?>
                            </div>

                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <?php echo $input_mobile;?>
                            </div>

                            <div class="form-group">
                                <label>اسم الشركة</label>
                                <?php echo $input_company_name;?>
                            </div>

                            <div class="form-group">
                                <label>نوع الشركة</label>
                                <?php echo $input_company_types_dropdown;?>
                            </div>
        				</div>
        			</div>
                    <div class="main-box clearfix">
                        <header class="main-box-header clearfix">
                            <h2>معلومات المشروع</h2>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>اسم المشروع</label>
                                <?php echo $input_project_name;?>
                            </div>

                            <div class="form-group">
                                <label>مساحة المشروع</label>
                                <?php echo $input_area;?>
                            </div>

                            <div class="form-group">
                                <label>عنوان المشروع</label>
                                <?php echo $input_address;?>
                            </div>

                            <div class="form-group">
                                <label>وصف العقار</label>
                                <?php echo $input_description;?>
                            </div>

                            <div class="form-group">
                                <label>الخدمات الملحقة</label>
                                <?php echo $input_services;?>
                            </div>

                            <div class="form-group">
                                <label>عنوان الفيديو (Youtube)</label>
                                <?php echo $input_youtube_url;?>
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
                <div class="col-md-7">
                    <div class="main-box clearfix">
                        <header class="main-box-header clearfix">
                            <h2>ألبوم صور المشروع</h2>
                        </header>
                        <div class="main-box-body clearfix">
                                <div class="row images-list">
                                    <?php foreach($project_info->project_images as $image){ ?>
                                    <div class="col-md-4 image-item">
                                        <div class="thumbnail" data-image-id="<?php echo $image->project_image_id;?>">
                                            <img src="<?php echo $image->image_fullpath;?>" width="164px" height="164px">
                                            <a class="text-danger tools-btn remove"><span class="glyphicon glyphicon-trash"></span></a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
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
                        </div>
                    </div>
                </div>
        	</div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js');?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
            $(function(){
                  var center = {};

                  if($("#projectfrm input[name=map_lat]").val() != '' && $("#projectfrm input[name=map_lng]").val() != ''){
                        center.lat = $("#projectfrm input[name=map_lat]").val();
                        center.lng = $("#projectfrm input[name=map_lng]").val();
                        center.zoom = parseInt($("#projectfrm input[name=map_zoom]").val());
                  }else{
                        center.lat = 32.71252485795853;
                        center.lng = 36.56646966934204;
                        center.zoom = 15;
                  }

                  app.mapInitialize("map-canvas", center, function(zoom){
                        $("#projectfrm input[name=map_zoom]").val(zoom);
                  });

                  app.addMarker({
                        position : app.map.getCenter(),
                        map: app.map,
                        draggable : true
                  }, function (latlng){
                        $("#projectfrm input[name=map_lat]").val(latlng.lat());
                        $("#projectfrm input[name=map_lng]").val(latlng.lng());
                  });

                  app.imagesManagement('#projectimagefrm');
            })
      </script>
<?php $this->view('layouts/footer');?>
