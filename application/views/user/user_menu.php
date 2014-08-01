			<div class="col-md-3 user-menu">
                  <ul class="nav nav-pills nav-stacked">
                        <li <?php echo ($this->uri->uri_string() == 'user/properties' )? 'class="active"' :''; ?>><a href="<?php echo site_url('user/properties');?>">عقاراتي</a></li>
                        <li><a href="#">معلومات الحساب</a></li>
                        <li <?php echo ($this->uri->uri_string() == 'user/profile/password' )? 'class="active"' :''; ?>><a href="<?php echo site_url('user/profile/password');?>">تغيير كلمة المرور</a></li>
                        <li><a href="<?php echo site_url('user/profile/logout');?>">تسجيل خروج</a></li>
                  </ul>
            </div> <!-- /.user-menu -->