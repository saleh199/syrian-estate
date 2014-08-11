<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>إدارة المشاريع العقارية</h1>
        		</div>
        	</div>
        	<div class="row">
                <?php if($message){ ?>
                <div class="col-md-6">
                    <div class="alert alert-warning"><?php echo $message; ?></div>
                </div>
                <?php } ?>
        		<div class="col-md-12">
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
        					<div class="pull-right">
        						<a href="<?php echo site_url('admin/project');?>?status=1" class="btn btn-link"><span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span> معروض</a> |
        						<a href="<?php echo site_url('admin/project');?>?status=2" class="btn btn-link"><span class="label label-warning"><i class="glyphicon glyphicon-eye-close"></i></span> جديد</a>
        					</div>
        					<!--<div class="filter-block pull-left">
        						<a href="#" class="btn btn-primary pull-left">
        							<i class="fa fa-plus-circle fa-lg"></i> إضافة
        						</a>
        					</div> -->
        				</header>
        				<div class="main-box-body clearfix">
        					<table class="table">
        						<thead>
        							<tr>
        								<th width="10%">#</th>
        								<th width="15%"></th>
        								<th width="30%">اسم المشروع</th>
        								<th>الحالة</th>
    	    							<th>المنطقة</th>
        								<th>تاريخ الإضافة</th>
	        							<th width="15%"></th>
        							</tr>
        							<form id="searchfrm" action="<?php echo site_url('admin/project');?>">
        							<tr>
        								<th><input type="text" name="project_id" class="form-control"></th>
        								<th></th>
        								<th></th>
        								<th></th>
        								<th>
        									<?php echo $zones_dropdown; ?>
        								</th>
        								<th></th>
        								<th></th>
        							</tr>
        							</form>
        						</thead>
        						<tbody>
        						<?php foreach($results as $item) { ?>
        							<tr>
        								<td><?php echo $item->project_id;?></td>
        								<td><img src="<?php echo $item->image;?>" width="90px" class="thumbnail"></td>
        								<td><?php echo $item->project_name;?></td>
        								<td>
        								<?php if($item->status == 1){ ?>
        									<span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span>
        								<?php }else{ ?>
        									<span class="label label-warning"><i class="glyphicon glyphicon-eye-close"></i></span>
        								<?php } ?>
        								</td>
        								<td><?php echo $item->zone->zone_name;?></td>
        								<td><?php echo $item->date_added_human;?></td>
        								<td>
        									<a href="<?php echo site_url('admin/project/update/'.$item->project_id);?>" class="table-link">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>

        									<a href="<?php echo site_url('admin/project/delete?project_id='.$item->project_id);?>" class="table-link danger">
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
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>
<?php $this->view('layouts/footer');?>
