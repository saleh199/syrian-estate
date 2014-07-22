 <!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Syrian Estate</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/bootstrap-theme.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/bootstrap-rtl.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/main.css");?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url("assets/js/html5shiv.min.js");?>"></script>
      <script src="<?php echo base_url("assets/js/respond.min.js");?>"></script>
    <![endif]-->
  </head>
  <body class="map">
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

    </div> <!-- /.site-wrapper -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php echo base_url("assets/js/jquery-1.11.1.min.js");?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
	<script src="<?php echo base_url("assets/js/docs.min.js");?>"></script>

	<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	function initialize() {
		var mapOptions = {
			center: new google.maps.LatLng(32.7129167,36.5491359),
			zoom: 7,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</body>
</html>