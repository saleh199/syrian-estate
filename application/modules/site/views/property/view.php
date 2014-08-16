<?php echo $this->view("layouts/header", array("map" => false)); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugin/lightbox/js/lightbox.min.js');?>"></script>
<?php echo link_tag("assets/plugin/lightbox/css/lightbox.css") . "\n"; ?>

      <div class="row main">

      	<div class="col-md-12 property-view">
                  <div class="col-md-9">
                        <div class="page-header">
                              <h3><?php echo $property_info->title;?> <small>(<?php echo $property_info->ref_number_text; ?>)</small></h3>
                        </div>
                        <div class="row">
                              <div class="col-md-6">
                                    <dl class="dl-horizontal">
                                          <dt>السعر : </dt>
                                          <dd><h4 class="price"><?php echo $property_info->price; ?> ل.س</h4></dd>

                                          <?php if($property_info->area){ ?>
                                          <dt>مساحة العقار : </dt>
                                          <dd><b><?php echo $property_info->area; ?></b> متر مربع</dd>
                                          <?php } ?>

                                          <?php if($property_info->address){ ?>
                                          <dt>عنوان العقار : </dt>
                                          <dd><?php echo $property_info->address; ?></dd>
                                          <?php } ?>

                                    </dl>
                              </div>
                              <div class="col-md-6">
                                    <div class="row">
                                          <p>للتواصل مع المعلن</p>
                                          <div class="col-md-12">
                                                <button type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-danger btn-block">عرض رقم الموبايل</button>
                                                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                  <?php if($this->ion_auth->logged_in() && !$this->ion_auth->is_admin()){ ?>
                                                                  <div class="modal-body">
                                                                        رقم الهاتف للتواصل مع صاحب الإعلان هو <h4 class="price"><?php echo $property_info->user->phone; ?></h4>
                                                                  </div>
                                                                  <?php }else{ ?>
                                                                  <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4>تسجيل الدخول</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        يجب تسجيل الدخول قبل عرض رقم التواصل <a href="<?php echo site_url('login').'?redirect_url='.current_url();?>">تسجيل الدخول</a>
                                                                  </div>
                                                                  <?php } ?>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-md-12">
                                    <dl class="dl-horizontal">
                                          <?php if($property_info->description){ ?>
                                          <dt>تفاصيل الإعلان : </dt>
                                          <dd><?php echo $property_info->description; ?></dd>
                                          <?php } ?>

                                          <?php if($property_info->services){ ?>
                                          <dt>الخدمات الملحقة : </dt>
                                          <dd><?php echo $property_info->services; ?></dd>
                                          <?php } ?>
                                    </dl>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                        <div class="row">
                              <div class="col-md-12 image-viewer">
                                    <h4>صور العقار</h4>
                                    <a href="<?php echo $property_info->image;?>" class="thumbnail" data-lightbox="property-image"><img src="<?php echo $property_info->image;?>" width="100%"></a>
                                    <?php foreach($property_info->images as $image){ ?>
                                    <div class="col-md-4 thumb"><a href="<?php echo $image->image_fullpath;?>" data-lightbox="property-gallery"><img src="<?php echo $image->image_fullpath;?>" class="img-thumbnail"></a></div>
                                    <?php } ?>
                              </div>
                              <div class="col-md-12">
                                    <h4>الموقع على الخريطة</h4>
                                    <a href="<?php echo $property_info->google_map_static_image; ?>" data-lightbox="static-map"><img src="<?php echo $property_info->google_map_static_image; ?>" width="100%" class="img-thumbnail"></a>
                                    <hr>
                              </div>
                              <?php if($property_info->ref_number !== NULL){ ?>
                              <?php if(file_exists('assets/image/ref_image/'.$property_info->ref_number.".png")) { ?>
                              <div class="col-md-12">
                                    <h4>المخطط العقاري</h4>
                                    <a  data-lightbox="tabo-map" href="<?php echo base_url('assets/image/ref_image/'.$property_info->ref_number.".png");?>" data-lightbox="property-gallery"><img src="<?php echo base_url('assets/image/ref_image/'.$property_info->ref_number.".png");?>" width="100%" class="img-thumbnail"></a>
                                    
                              </div>
                              <?php } ?>
                              <?php } ?>
                        </div>
                  </div>
      	</div> <!-- /.property-view -->

      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>