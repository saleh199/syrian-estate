<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
            
            <div class="col-md-3 user-menu">
                  <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#">عقاراتي</a></li>
                        <li><a href="#">معلومات الحساب</a></li>
                        <li><a href="#">تغيير كلمة المرور</a></li>
                        <li><a href="#">مشاريع عقارية</a></li>
                        <li><a href="#">تسجيل خروج</a></li>
                  </ul>
            </div> <!-- /.user-menu -->

            <div class="col-md-9">
                  <ol class="breadcrumb">
                        <li><a href="#">حسابي</a></li>
                        <li class="active">عقاراتي</li>
                  </ol>

                  <div class="row property-list">
                        <div class="col-md-12">
                        <?php foreach($results as $item) { ?>
                              <div class="media property-item">
                                    <a href="<?php echo $item->images[0]->image_fullpath ;?>" class="pull-right">
                                          <img src="<?php echo $item->images[0]->image_fullpath ;?>" class="media-object" width="100px" height="100px">
                                    </a>
                                    <div class="media-body">
                                          <h4><?php echo $item->title;?></h4>
                                          <b>السعر : </b> <?php echo $item->price;?> ل.س <br>
                                          <b>المساحة : </b> <?php echo $item->area ;?>
                                          
                                                <button class="btn btn-primary btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span> تعديل</button>

                                                <button class="btn btn-danger btn-sm btn-delete"><span class="glyphicon glyphicon-remove"></span> حذف</button>

                                                <span class="date-added" dir="ltr"><?php echo $item->date_added_human;?></span>
                                          
                                    </div>
                              </div>
                        <?php } ?>
                        </div>
                  </div>
            </div>
      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>