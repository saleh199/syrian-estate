<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>لوحة التحكم</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-rtl.css');?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/admin/signin.css');?>" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <?php echo $form_action;?>
        <div class="text-center">
          <img src="<?php echo base_url('assets/image/logo.png');?>" width="300px">
          <h2>لوحة التحكم</h2><br>
        </div>
        <?php if($message) { ?>
         <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>
        <?php echo $input_email; ?>
        <br>
        <?php echo $input_password; ?>
        <button class="btn btn-lg btn-danger btn-block" type="submit">تسجيل الدخول</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>