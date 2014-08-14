          <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js');?>"></script>
          <script type="text/javascript">
            app.initializeAddProperty();
          </script>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5 class="modal-title">أضف عقارك</h5>
          </div>
          <div class="modal-body">
            <div class="row">
            <?php echo $form_action; ?>
              <div class="col-md-6" style="border-left: 1px solid #CCC;">
                <p class="text-danger">* جميع الحقول مطلوبة</p>
                <div class="form-group">
                  <label class="control-label">حالة العقار</label>
                  <?php echo $property_status_dropdown;?>
                </div>

                <div class="form-group">
                  <label class="control-label">نوع العقار</label>
                  <?php echo $property_type_dropdown;?>
                </div>

                <div class="form-group">
                  <label class="control-label">رقم العقار</label>
                  <?php echo $ref_number_input;?>
                </div>

                <div class="form-group">
                  <label class="control-label">سعر العقار</label>
                  <?php echo $price_input;?>
                </div>

                <div class="form-group">
                  <label class="control-label">وصف العقار</label>
                  <?php echo $description_input;?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">المنطقة</label>
                  <?php echo $zone_dropdown;?>
                </div>

                <div class="form-group">
                  <label class="control-label">صورة العقار</label>
                  <?php echo $image_input;?>
                </div>
                <div>
                  <div class="progress hidden">
                    <div class="progress-bar "  role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      70%
                    </div>
                  </div>
                </div>

              </div>
            <?php form_close();?>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button> -->
            <button type="button" class="btn btn-primary" id="addpropertybtn">تحديد على الخريطة</button>
          </div>