 <?php echo doctype('html5') . "\n" ; ?>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Syrian Estate</title>

    <!-- Bootstrap -->
    <?php echo link_tag("assets/css/bootstrap.min.css") . "\n"; ?>
    <?php echo link_tag("assets/css/bootstrap-theme.min.css") . "\n"; ?>
    <?php echo link_tag("assets/css/bootstrap-rtl.min.css") . "\n"; ?>
    <?php echo link_tag("assets/css/main.css") . "\n"; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url("assets/js/html5shiv.min.js");?>"></script>
      <script src="<?php echo base_url("assets/js/respond.min.js");?>"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url("assets/js/jquery-1.11.1.min.js");?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/docs.min.js");?>"></script>

    <script type="text/javascript">
      app.config = {
        csrf_token_name : '<?php echo $this->config->item("csrf_token_name"); ?>',
        sitePath : '<?php echo site_url(); ?>',
        assetsPath : '<?php echo base_url("assets"); ?>/'
      };
    </script>
  </head>
  <body>
  	<div class="container">
  		<div class="row menu">
  			<div class="col-md-12">
      			<ul class="nav nav-pills">
      				<li><a href="<?php echo site_url(); ?>">الصفحة الرئيسية</a></li>
      				<li><a href="<?php echo site_url('map').'#property_status_id=4';?>">عقارات للإيجار</a></li>
            <li><a href="<?php echo site_url('map').'#property_status_id=3';?>">عقارات للبيع</a></li>
      			</ul>
      		</div>
      	</div> <!-- /.menu -->

      	<div class="row">
      		<div class="col-md-12 text-center">
      			<img src="<?php echo base_url('assets/image/logo.png');?>">
      		</div>
      	</div>

      	<div class="row">
      		<div class="col-md-4 col-md-offset-4">
      			<hr>
      			<?php if(isset($message) && $message != ''){ ?>
      			<div class="alert alert-danger"><?php echo $message;?></div>
      			<?php } ?>
      			<?php echo $form_action;?>
      				<div class="form-group">
      					<!-- <label class="label-control">الاسم الاول</label> -->
      					<?php echo $input_firstname;?>
      				</div>

      				<div class="form-group">
      					<!-- <label class="label-control">الكنية</label> -->
      					<?php echo $input_lastname;?>
      				</div>

      				<div class="form-group">
      					<!-- <label class="label-control">البريد الإلكتروني</label> -->
      					<?php echo $input_email;?>
      				</div>

      				<div class="form-group">
      					<!-- <label class="label-control">رقم الموبايل</label> -->
      					<?php echo $input_phone;?>
      				</div>

      				<div class="form-group">
      					<!-- <label class="label-control">كلمة المرور</label> -->
      					<?php echo $input_password;?>
      				</div>

      				<div class="form-group">
      					<!-- <label class="label-control">تأكيد كلمة المرور</label> -->
      					<?php echo $input_passwordconfirm;?>
      				</div>
      				
      				<div class="form-group">
      					<button class="btn btn-primary btn-block">تسجيل الدخول</button>
      				</div>
      			<?php echo form_close(); ?>
      		</div>
      	</div>

      	<hr>
  	</div>
    <script type="text/javascript">
    $('input[name=phone]').tooltip();
    </script>
  </body>
  </html>