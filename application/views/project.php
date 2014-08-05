<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
            <div class="col-md-12">
                  <div class="page-header">
                        <h3>أضف مشروعك العقاري</h3>
                  </div>
            </div>
            <div class="col-md-4 col-md-offset-3">
                  <form>
                        <div class="form-group">
                              <label class="label-control">اسم المشروع</label>
                              <?php echo $input_project_name;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">المنطقة</label>
                              <?php echo $input_zone_dropdown;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">اسم الشركة</label>
                              <?php echo $input_company_name;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">نوع الشركة</label>
                              <?php echo $input_company_types_dropdown;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">اسمك</label>
                              <?php echo $input_person_name;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">البريد الإلكتروني</label>
                              <?php echo $input_email;?>
                        </div>

                        <div class="form-group">
                              <label class="label-control">رقم الهاتف</label>
                              <?php echo $input_mobile;?>
                        </div>
                  </form>
            </div>

      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>