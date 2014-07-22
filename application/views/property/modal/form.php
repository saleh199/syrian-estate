          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h5 class="modal-title">أضف عقارك</h5>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6" style="border-left: 1px solid #CCC;">
                <div class="form-group">
                  <label class="control-label">حالة العقار</label>
                  <select class="form-control">
                    <option>حالة العقار</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">نوع العقار</label>
                  <select class="form-control">
                    <option>نوع العقار</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">سعر العقار</label>
                  <input type="text" class="form-control" placeholder="سعر العقار">
                </div>

                <div class="form-group">
                  <label class="control-label">وصف العقار</label>
                  <textarea class="form-control" rows="4" placeholder="وصف العقار"></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">المنطقة</label>
                  <select class="form-control">
                    <option>المنطقة</option>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">صورة العقار</label>
                  <input type="file" class="form-control" placeholder="صورة العقار">
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button> -->
            <button type="button" class="btn btn-primary" id="addressFromBtn">تحديد على الخريطة</button>
          </div>