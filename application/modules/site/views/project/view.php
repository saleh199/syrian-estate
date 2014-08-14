<?php echo $this->view("layouts/header", array("map" => false)); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugin/lightbox/js/lightbox.min.js');?>"></script>
<?php echo link_tag("assets/plugin/lightbox/css/lightbox.css") . "\n"; ?>

      <div class="row main">

      	<div class="col-md-12 project-view">
                  <div class="page-header">
                        <h4><?php echo $project_info->project_name;?></h4>
                  </div>            
                  <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                              <div id="carousel-project-images" class="carousel slide col-md-12" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                          <?php $i=0;foreach($project_info->project_images as $image){ ?>
                                          <li data-target="#carousel-project-images" data-slide-to="<?php echo $i;?>"></li>
                                          <?php $i++;} ?>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                    <?php foreach($project_info->project_images as $image){ ?>
                                          <div class="item">
                                                <img src="<?php echo $image->image_fullpath;?>" style="height:266px;width:439px;">
                                                <div class="carousel-caption"></div>
                                          </div>
                                    <?php } ?>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <hr>
                  <div class="row">
                        <div class="col-md-12">
                              <dl class="dl-horizontal">
                                    <dt>مساحة المشروع : </dt>
                                    <dd><?php echo $project_info->area; ?> متر مربع</h4></dd>
<hr>
                                    <dt>عنوان المشروع : </dt>
                                    <dd><?php echo $project_info->address; ?></dd>
<hr>
                                    <dt>مواصفات المشروع : </dt>
                                    <dd><?php echo $project_info->description; ?></dd>
<hr>
                                    <dt>خدمات ملحقة بالمشروع : </dt>
                                    <dd><?php echo $project_info->description; ?></dd>
                              </dl>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-md-6">
                              <object width="100%" height="300" data="http://www.youtube.com/v/<?php echo $project_info->youtube_id;?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $project_info->youtube_id;?>" /></object>
                        </div>

                        <div class="col-md-6">
                              <img src="<?php echo base_url('project/static_img/' . $project_info->project_id);?>" width="469px">
                        </div>
                  </div>
      	</div> <!-- /.project-view -->

      </div> <!-- /.main -->
<script type="text/javascript">
      $('.carousel-inner>.item:first').addClass('active');
      $('.carousel-indicators>li:first').addClass('active');
</script>
    <?php echo $this->view("layouts/footer"); ?>