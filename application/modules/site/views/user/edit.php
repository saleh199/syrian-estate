<?php echo $this->view("layouts/header", array("map" => false)); ?>

      <div class="row main">
            
            <?php echo $this->view("user/user_menu"); ?>

            <div class="col-md-9">
                  <ol class="breadcrumb">
                        <li><a href="#">حسابي</a></li>
                        <li class="active">معلومات الحساب</li>
                  </ol>

                  <div class="row password-info">
                        <div class="tab-content col-md-12">
                              <div class="tab-pane active" id="main-details">
                                    <?php echo $form_action;?>

                                    <?php if(isset($errors) && $errors) { ?>
                                    <div class="alert alert-danger" role="alert">
                                          <?php echo $errors;?>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                          <label class="control-label col-md-3">الاسم الاول :</label>
                                          <div class="col-md-6">
                                                <?php echo $input_first_name;?>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <label class="control-label col-md-3">الكنية :</label>
                                          <div class="col-md-6">
                                                <?php echo $input_last_name;?>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <label class="control-label col-md-3">رقم الموبايل :</label>
                                          <div class="col-md-6">
                                                <?php echo $input_phone;?>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <div class="col-md-12">
                                                <button type="submit" class="btn btn-success"> حفظ </button>
                                          </div>
                                    </div>
                                    <?php echo form_close();?>
                              </div><!-- /#main-details -->

                        </div>
                  </div> <!-- /.property-info -->
            </div>
      </div> <!-- /.main -->
    <?php echo $this->view("layouts/footer"); ?>