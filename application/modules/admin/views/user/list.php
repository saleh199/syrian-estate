<?php $this->view('layouts/header'); ?>

<div class="container-fluid">
      <div class="row">
        <?php echo $this->view('layouts/sidebar'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        	<div class="row">
        		<div class="col-md-12">
        			<h1><?php echo (strpos($this->uri->uri_string(), 'admin/user/admin') === FALSE)? 'إدارة الأعضاء' : 'الإدارة' ; ?></h1>
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
        						<a href="<?php echo $insert_btn;?>" class="btn btn-primary pull-left">
        							<i class="fa fa-plus-circle fa-lg"></i> <?php echo ($this->uri->uri_string() == 'admin/user/admin' )? 'إضافة مدير جديد' :'إضافة عضو جديد'; ?>
        						</a>
        					</div>
        				</header>
        				<div class="main-box-body clearfix">
        					<table class="table">
        						<thead>
        							<tr>
        								<th width="10%">#</th>
        								<th >الاسم الكامل</th>
    	    							<th>اسم المستخدم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>رقم الهاتف</th>
	        							<th width="15%"></th>
        							</tr>
        						</thead>
        						<tbody>
        						<?php foreach($results as $item) { ?>
        							<tr>
        								<td><?php echo $item->id;?></td>
        								<td><?php echo $item->first_name . ' ' . $item->last_name;?></td>
                                        <td><?php echo $item->username ;?></td>
                                        <td><a href="mailto:<?php echo $item->email ;?>?from=admin@syrian-estate.com"><?php echo $item->email ;?></a></td>
                                        <td><?php echo $item->phone ;?></td>
        								<td>
        									<a href="<?php echo $update_btn . '/'.$item->id;?>" class="table-link">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>
<!--
        									<a href="<?php echo $delete_btn.'?id='.$item->id;?>" class="table-link danger">
        										<span class="fa-stack">
        											<i class="fa fa-square fa-stack-2x"></i>
        											<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
        										</span>
        									</a>
-->
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
