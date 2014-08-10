<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>لوحة التحكم</h1>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-3 col-md-offset-3">
        			<div class="main-box infographic-box">
        				<i class="fa fa-user red-bg"></i>
        				<span class="headline">المسجلون</span>
        				<span class="value">200</span>
        			</div>
        		</div>

        		<div class="col-md-3">
        			<div class="main-box infographic-box">
        				<i class="fa fa-home blue-bg"></i>
        				<span class="headline">عقارات جديدة</span>
        				<span class="value">16</span>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>
<?php $this->view('layouts/footer');?>
