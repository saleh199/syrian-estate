 <!DOCTYPE html>
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
  </head>
  <body <?php echo ($map) ? 'class="map"' : '';?>>
    <div class="container site-wrapper">
      <header class="row">
        <div class="col-md-6 text-right"><img src="<?php echo base_url('assets/image/right1.png');?>" width="447px" height="114px"></div>
        <div class="col-md-6 text-left">
          <a href="#"><img src="<?php echo base_url('assets/image/left.png');?>" width="302px" height="110px"></a>
        </div>
      </header>
      
      <div class="row menu">
      	<div class="col-md-12">
      		<ul class="nav nav-pills">
      			<li><a href="#">الصفحة الرئيسية</a></li>
      			<li><a href="#">عقارات للإيجار</a></li>
      			<li><a href="#">عقارات للبيع</a></li>
      			<li class="pull-left"><a href="#">أضف عقارك</a></li>
      		</ul>
      	</div>
      </div> <!-- /.menu -->