<?php $this->view('layouts/header'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/plugin/elevateZoom/jquery.elevateZoom-3.0.8.min.js');?>"></script>
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
                <?php if($message){ ?>
                <div class="col-md-6">
                    <div class="alert alert-warning"><?php echo $message; ?></div>
                </div>
                <?php } ?>
        		<div class="col-md-12">
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
        					<div class="pull-right">
        						<a href="<?php echo site_url('admin/properties');?>?status=1" class="btn btn-link"><span class="label label-success"><i class="glyphicon glyphicon-eye-open"></i></span> معروض</a> |
        						<a href="<?php echo site_url('admin/properties');?>?status=2" class="btn btn-link"><span class="label label-danger"><i class="glyphicon glyphicon-eye-close"></i></span> مرفوض</a> | 
        						<a href="<?php echo site_url('admin/properties');?>?status=0" class="btn btn-link"><span class="label label-warning"><i class="glyphicon glyphicon-eye-close"></i></span> جديد</a>
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
        								<th width="30%">العنوان</th>
                                        <th width="15%"></th>
                                        <th></th>
        								<th>الحالة</th>
    	    							<th>المنطقة</th>
        								<th width="15%">تاريخ الإضافة</th>
	        							<th width="15%"></th>
        							</tr>
        							<form id="searchfrm" action="<?php echo site_url('admin/properties');?>">
        							<tr>
        								<th><input type="text" name="property_id" class="form-control"></th>
        								<th></th>
        								<th></th>
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
        								<td><?php echo $item->property_id;?></td>
        								<td><img src="<?php echo $item->image;?>" width="90px" class="thumbnail"></td>
        								<td><?php echo $item->title;?></td>
                                        <td><?php echo $item->ref_number;?></td>
                                        <td><img src="<?php echo base_url('assets/image/kroki.png');?>" data-zoom-image="<?php echo base_url('assets/image/kroki.png');?>" width="90px" class="thumbnail kroki-image"></td>
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
        									<a href="<?php echo site_url('admin/properties/update/'.$item->property_id);?>" class="table-link">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>

        									<a href="<?php echo site_url('admin/properties/delete?property_id='.$item->property_id);?>" class="table-link danger">
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
<!--        					<ul class="pagination pull-left">
        						<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
        						<li><a href="#">1</a></li>
        						<li><a href="#">2</a></li>
        						<li><a href="#">3</a></li>
        						<li><a href="#">4</a></li>
        						<li><a href="#">5</a></li>
        						<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
        					</ul> -->
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
        $(".kroki-image").each(function(s, d){
            $(d).elevateZoom({scrollZoom : true});
        });
    </script>
<?php $this->view('layouts/footer');?>
