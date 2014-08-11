<?php echo $this->view("layouts/header", array("map" => false)); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugin/lightbox/js/lightbox.min.js');?>"></script>
<?php echo link_tag("assets/plugin/lightbox/css/lightbox.css") . "\n"; ?>

      <div class="row main">

      	<div class="col-md-12 property-view">
                  <div class="col-md-9">
                        <div class="page-header">
                              <h4><?php echo $property_info->title;?></h4>
                        </div>
                        <div class="row">
                              <div class="col-md-6">
                                    <dl class="dl-horizontal">
                                          <dt>السعر : </dt>
                                          <dd><h4 class="price"><?php echo $property_info->price; ?> ل.س</h4></dd>

                                          <dt>مساحة العقار : </dt>
                                          <dd><b><?php echo $property_info->area; ?></b> متر مربع</dd>

                                          <dt>عنوان العقار : </dt>
                                          <dd><?php echo $property_info->address; ?></dd>

                                    </dl>
                              </div>
                              <div class="col-md-6">
                                    <div class="row">
                                          <p>للتواصل مع المعلن</p>
                                          <div class="col-md-12"><button type="button" class="btn btn-danger btn-block">عرض رقم الموبايل</button></div>
                                    </div>
                              </div>
                              <div class="col-md-12">
                                    <dl class="dl-horizontal">

                                          <dt>تفاصيل الإعلان : </dt>
                                          <dd><?php echo $property_info->description; ?></dd>

                                          <dt>الخدمات الملحقة : </dt>
                                          <dd><?php echo $property_info->services; ?></dd>
                                    </dl>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                        <div class="row">
                              <div class="col-md-12 image-viewer">
                                    <h4>صور العقار</h4>
                                    <a href="<?php echo $property_info->image;?>" class="thumbnail" data-lightbox="property-gallery"><img src="<?php echo $property_info->image;?>" width="100%"></a>
                                    <?php foreach($property_info->images as $image){ ?>
                                    <div class="col-md-4 thumb"><a href="<?php echo $image->image_fullpath;?>" data-lightbox="property-gallery"><img src="<?php echo $image->image_fullpath;?>" class="img-thumbnail"></a></div>
                                    <?php } ?>
                              </div>
                              <div class="col-md-12">
                                    <h4>الموقع على الخريطة</h4>
                                    <img src="<?php echo $property_info->google_map_static_image; ?>" width="100%" class="img-thumbnail">
                              </div>
                        </div>
                  </div>
      	</div> <!-- /.property-view -->

      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>