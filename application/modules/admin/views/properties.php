<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>إدارة الإعلانات العقارية</h1>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-md-12">
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
        					<div class="pull-right">
        						<a href="<?php echo site_url('admin/properties');?>?status=1" class="btn btn-link"><span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span> معروض</a> |
        						<a href="<?php echo site_url('admin/properties');?>?status=2" class="btn btn-link"><span class="label label-danger"><i class="glyphicon glyphicon-eye-close"></i></span> مرفوض</a> | 
        						<a href="<?php echo site_url('admin/properties');?>?status=0" class="btn btn-link"><span class="label label-warning"><i class="glyphicon glyphicon-eye-close"></i></span> جديد</a>
        					</div>
        					<div class="filter-block pull-left">
        						<a href="#" class="btn btn-primary pull-left">
        							<i class="fa fa-plus-circle fa-lg"></i> إضافة
        						</a>
        					</div>
        				</header>
        				<div class="main-box-body clearfix">
        					<table class="table">
        						<thead>
        							<tr>
        								<th width="5%">#</th>
        								<th width="15%"></th>
        								<th width="30%">العنوان</th>
        								<th>الحالة</th>
    	    							<th>المنطقة</th>
        								<th>تاريخ الإضافة</th>
	        							<th width="15%"></th>
        							</tr>
        						</thead>
        						<tbody>
        						<?php foreach($results as $item) { ?>
        							<tr>
        								<td><?php echo $item->property_id;?></td>
        								<td><img src="<?php echo $item->image;?>" width="90px" class="thumbnail"></td>
        								<td><?php echo $item->title;?></td>
        								<td>
        								<?php if($item->status == 1){ ?>
        									<span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span>
        								<?php }elseif($item->status == 2){ ?>
        									<span class="label label-danger"><i class="glyphicon glyphicon-eye-close"></i></span>
        								<?php }else{ ?>
        									<span class="label label-warning"><i class="glyphicon glyphicon-eye-close"></i></span>
        								<?php } ?>
        								</td>
        								<td><?php echo $item->zone->zone_name;?></td>
        								<td><?php echo $item->date_added_human;?></td>
        								<td>
        									<a href="#" class="table-link">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>

        									<a href="#" class="table-link danger">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>
        								</td>
        							</tr>
        						<?php } ?>
        						</tbody>
        					</table>
        					<ul class="pagination pull-left">
        						<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
        						<li><a href="#">1</a></li>
        						<li><a href="#">2</a></li>
        						<li><a href="#">3</a></li>
        						<li><a href="#">4</a></li>
        						<li><a href="#">5</a></li>
        						<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
        					</ul>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>
<?php $this->view('layouts/footer');?>
