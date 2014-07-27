<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
            
            <?php echo $this->view("user/user_menu"); ?>

            <div class="col-md-9">
                  <ol class="breadcrumb">
                        <li><a href="#">حسابي</a></li>
                        <li class="active">عقاراتي</li>
                  </ol>

                  <div class="row property-list">
                        <div class="col-md-12">
                        <?php foreach($results as $item) { ?>
                              <div class="media property-item">
                                    <a href="<?php echo $item->image ;?>" class="pull-right">
                                          <img src="<?php echo $item->image ;?>" class="media-object" width="100px" height="100px">
                                    </a>
                                    <div class="media-body">
                                          <h4><?php echo $item->title;?></h4>
                                          <b>السعر : </b> <?php echo $item->price;?> ل.س <br>
                                          <b>المساحة : </b> <?php echo $item->area ;?>
                                          
                                                <a href="<?php echo $item->href_edit;?>" class="btn btn-primary btn-sm btn-edit"><span class="glyphicon glyphicon-pencil"></span> تعديل</a>

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