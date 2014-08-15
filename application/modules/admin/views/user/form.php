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
                <?php if($message) { ?>
                <div class="col-md-8">
                    <div class="alert alert-danger"><?php echo $message;?></div>
                </div>
                <?php } ?>
                <?php echo $form_action;?>
        		<div class="col-md-6">
        			<div class="main-box clearfix">
        				<header class="main-box-header clearfix">
                            <h2>معلومات الحساب</h2>
        				</header>
        				<div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>الاسم الاول</label>
                                <?php echo $input_first_name;?>
                            </div>

                            <div class="form-group">
                                <label>الكنية</label>
                                <?php echo $input_last_name;?>
                            </div>

                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <?php echo $input_email;?>
                            </div>

                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <?php echo $input_phone;?>
                            </div>
        				</div>
        			</div>
        		</div>
                <div class="col-md-6">
                    <div class="main-box clearfix">
                        <header class="main-box-header clearfix">
                            <h2>كلمة المرور</h2>
                        </header>
                        <div class="main-box-body clearfix">
                            <div class="form-group">
                                <label>كلمة المرور</label>
                                <?php echo $input_password;?>
                            </div>

                            <div class="form-group">
                                <label>تأكيد كلمة المرور</label>
                                <?php echo $input_password_confirm;?>
                            </div>

                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
        	</div>
        </div>
      </div>
    </div>
<?php $this->view('layouts/footer');?>
