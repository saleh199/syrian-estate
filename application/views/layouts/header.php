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

    <script type="text/javascript" src="<?php echo base_url("assets/js/app.js");?>"></script>

    <script type="text/javascript">
      app.config = {
        csrf_token_name : '<?php echo $this->config->item("csrf_token_name"); ?>',
        sitePath : '<?php echo site_url(); ?>',
        assetsPath : '<?php echo base_url("assets"); ?>/'
      };
    </script>

  </head>
  <body <?php echo ($map) ? 'class="map"' : '';?>>
    <div class="container site-wrapper">
      <div class="row user-top">
        <div class="col-md-12">
          <a href="#" class="btn btn-link">دخول</a> |
          <a href="#" class="btn btn-link">تسجيل جديد</a>
        </div>
      </div>
      <header class="row">
        <div class="col-md-6 text-right"><img src="<?php echo base_url('assets/image/right1.png');?>" width="447px" height="114px"></div>
        <div class="col-md-6 text-left">
          <a href="#"><img src="<?php echo base_url('assets/image/left.png');?>" width="302px" height="110px"></a>
        </div>
      </header>
      
      <div class="row menu">
      	<div class="col-md-12">
      		<ul class="nav nav-pills">
      			<li><a href="<?php echo site_url(); ?>">الصفحة الرئيسية</a></li>
      			<li><a href="#">عقارات للإيجار</a></li>
      			<li><a href="#">عقارات للبيع</a></li>
      			<li class="pull-left"><a href="#" id="menuAddHandler">أضف عقارك</a></li>
      		</ul>
      	</div>
      </div> <!-- /.menu -->