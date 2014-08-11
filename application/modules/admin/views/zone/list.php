<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1>إدارة المناطق</h1>
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
        					<div class="filter-block pull-left">
        						<a href="<?php echo site_url('admin/zone/insert');?>" class="btn btn-primary pull-left">
        							<i class="fa fa-plus-circle fa-lg"></i> إضافة منطقة
        						</a>
        					</div>
        				</header>
        				<div class="main-box-body clearfix">
        					<table class="table">
        						<thead>
        							<tr>
        								<th width="10%">#</th>
        								<th width="50%">اسم المنطقة</th>
    	    							<th>تاريخ الإضافة</th>
	        							<th width="15%"></th>
        							</tr>
        						</thead>
        						<tbody>
        						<?php foreach($results as $item) { ?>
        							<tr>
        								<td><?php echo $item->zone_id;?></td>
        								<td><?php echo $item->zone_name;?></td>
        								<td><?php echo $item->date_added_human;?></td>
        								<td>
        									<a href="<?php echo site_url('admin/zone/update/'.$item->zone_id);?>" class="table-link">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>

        									<a href="<?php echo site_url('admin/zone/delete?zone_id='.$item->zone_id);?>" class="table-link danger">
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
