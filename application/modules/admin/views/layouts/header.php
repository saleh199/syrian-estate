<!DOCTYPE html>
<html lang="en" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>لوحة التحكم</title>

    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js');?>" type="text/JavaScript" language="javascript"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link href="<?php echo base_url('assets/css/bootstrap-rtl.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/admin/main.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-awesome.min.css');?>" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url("assets/js/jquery-1.11.1.min.js");?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/docs.min.js");?>"></script>

    <script type="text/javascript" src="<?php echo base_url("assets/js/admin/app.js");?>"></script>

    <script type="text/javascript">
      app.config = {
        csrf_token_name : '<?php echo $this->config->item("csrf_token_name"); ?>',
        sitePath : '<?php echo site_url(); ?>',
        assetsPath : '<?php echo base_url("assets"); ?>/'
      };
    </script>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">لوحة التحكم</a>
        </div>
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-left" role="search"><a class="btn btn-danger navbar-left" href="<?php echo site_url('admin/dashboard/logout');?>">تسجيل خروج</a></form>
          </ul>
        </div>
      </div>
    </div>