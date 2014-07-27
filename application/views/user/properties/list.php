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
                              <div class="media property-item">
                                    <a href="#" class="pull-right">
                                          <img src="holder.js/100x100" class="media-object">
                                    </a>
                                    <div class="media-body">
                                          <h4>عقار 1</h4>
                                          <b>السعر : </b> 344444 ل.س
                                          <p>
                                                <button class="btn btn-primary btn-sm pull-left"><span class="glyphicon glyphicon-pencil"></span> تعديل</button>

                                                <button class="btn btn-danger btn-sm pull-left btn-delete"><span class="glyphicon glyphicon-remove"></span> حذف</button>
                                          </p>
                                    </div>
                              </div>

                              <div class="media property-item">
                                    <a href="#" class="pull-right">
                                          <img src="holder.js/100x100" class="media-object">
                                    </a>
                                    <div class="media-body">
                                          <h4>عقار 1</h4>
                                          <b>السعر : </b> 344444 ل.س
                                          <p>
                                                <button class="btn btn-primary btn-sm pull-left"><span class="glyphicon glyphicon-pencil"></span> تعديل</button>

                                                <button class="btn btn-danger  btn-sm pull-left btn-delete"><span class="glyphicon glyphicon-remove"></span> حذف</button>
                                          </p>
                                    </div>
                              </div>

                              <div class="media property-item">
                                    <a href="#" class="pull-right">
                                          <img src="holder.js/100x100" class="media-object">
                                    </a>
                                    <div class="media-body">
                                          <h4>عقار 1</h4>
                                          <b>السعر : </b> 344444 ل.س
                                          <p>
                                                <button class="btn btn-primary btn-sm pull-left"><span class="glyphicon glyphicon-pencil"></span> تعديل</button>

                                                <button class="btn btn-danger btn-sm pull-left btn-delete"><span class="glyphicon glyphicon-remove"></span> حذف</button>
                                          </p>
                                    </div>
                              </div>

                              <div class="media property-item">
                                    <a href="#" class="pull-right">
                                          <img src="holder.js/100x100" class="media-object">
                                    </a>
                                    <div class="media-body">
                                          <h4>عقار 1</h4>
                                          <b>السعر : </b> 344444 ل.س
                                          <p>
                                                <button class="btn btn-primary btn-sm pull-left"><span class="glyphicon glyphicon-pencil"></span> تعديل</button>

                                                <button class="btn btn-danger btn-sm pull-left btn-delete"><span class="glyphicon glyphicon-remove"></span> حذف</button>
                                          </p>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>