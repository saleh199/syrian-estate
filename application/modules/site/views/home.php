<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
      	
      	<div class="col-md-12 site-desc">
      		<div class="jumbotron">
      			<div class="container">
      				<h1>عقارات سوريا</h1>
      				<p>بوابتك الأولى للبحث عن العقار</p>
      				<p><a class="btn btn-primary" role="button" href="<?php echo site_url('map');?>">تصفح الخريطة</a> <a class="btn btn-primary" role="button">بحث بالقائمة</a></p>
      			</div>
      		</div>
      	</div> <!-- /.site-desc -->

      	<div class="col-md-12 featured-projects">
      		<div class="page-header">
  				<h2>مشاريع عقارية</h2>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="list-group" role="tablist">
                                    <?php foreach($projects as $project){ ?>
						<a href="#project_<?php echo $project->project_id;?>" role="tab" data-toggle="tab" class="list-group-item"><?php echo $project->project_name;?></a>
                                    <?php } ?>
                                    <a href="#project_6" role="tab" data-toggle="tab" class="list-group-item"><span class="glyphicon glyphicon-tower"></span> مشروعك العقاري !!!</a>
					</div>
				</div>

				<div class="col-md-9 tab-content">
                              <?php foreach($projects as $project){ ?>
                              <div class="media tab-pane fade" id="project_<?php echo $project->project_id;?>">
                                    <a class="pull-right" href="<?php echo site_url('project/view/'.$project->project_id);?>">
                                          <img class="media-object thumbnail" src="<?php echo $project->image;?>" width="200px">
                                    </a>
                                    <div class="media-body">
                                          <h4 class="media-heading"><?php echo $project->project_name;?></h4>
                                          <?php echo $project->description;?>
                                    </div>
                              </div>
                              <?php } ?>
                              <div class="media tab-pane fade" id="project_6">
                                    <div class="media-body text-center">
                                          <h4 class="media-heading">لديك مشروع عقاري و تريد الإعلان عنه ؟</h4>
                                          <hr><br><br><br>
                                          <a href="<?php echo site_url('project');?>" class="btn btn-primary">أرسل طلب إضافة</a>
                                    </div>
                              </div>
				</div>
			</div>
      	</div> <!-- /.featured-projects -->
            

      	<div class="col-md-12 featured-properties">
      		<div class="page-header">
  				<h2>عقارات مميزة</h2>
			</div>

      		<div class="row">
                        <?php foreach($featured as $item) { ?>
      			<div class="col-md-3">
      				<a href="<?php echo $item->property_view_href;?>" class="thumbnail">
      					<img src="<?php echo $item->image;?>" width="210px">
      					<div class="caption">
      						<h4><?php echo $item->title;?></h4>
      					</div>
      				</a>
      			</div>
                        <?php } ?>
      		</div>
      	</div> <!-- /.featured-properties -->

      </div> <!-- /.main -->
      <script type="text/javascript">
      $('.featured-projects a.list-group-item:first').addClass('active').tab('show');
      $('.featured-projects a.list-group-item').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
            $('.featured-projects a.list-group-item').removeClass('active');
            $(this).addClass('active');
      });
      </script>
    <?php echo $this->view("layouts/footer"); ?>