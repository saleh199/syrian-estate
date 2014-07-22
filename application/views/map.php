<?php echo $this->view("layouts/header", array("map" => true)); ?>

      <div class="row main">

      	<div class="col-md-3 search-box">
      		<h4>بحث عن عقار</h4>
      		<div class="form-group">
      			<label class="control-label">نوع العقار</label>
      			<select class="form-control">
      				<option>نوع العقار</option>
      			</select>
      		</div>

      		<div class="form-group">
      			<label class="control-label">المنطقة</label>
      			<select class="form-control">
      				<option>المنطقة</option>
      			</select>
      		</div>

      		<div class="form-group">
      			<label class="control-label">أعلى سعر</label>
      			<select class="form-control">
      				<option>أعلى سعر</option>
      			</select>
      		</div>

      		<div class="form-group">
      			<label class="control-label">اقل سعر</label>
      			<select class="form-control">
      				<option>أقل سعر</option>
      			</select>
      		</div>

      		<button class="btn btn-danger btn-block">بحث</button>
      	</div> <!-- /.search-box -->

      	<div class="col-md-9 map-holder">
      		<div id="map-canvas"></div>
      	</div> <!-- /.map-holder -->

      </div> <!-- /.main -->

    <?php echo $this->view("layouts/footer"); ?>