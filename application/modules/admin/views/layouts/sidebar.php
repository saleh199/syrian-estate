<div class="col-sm-3 col-md-2 sidebar">
  <div class="text-center">
    <img src="<?php echo base_url('assets/image/logo.png');?>" width="100%"><br><br>
  </div>
  <ul class="nav nav-sidebar">
    <li  <?php echo (strpos($this->uri->uri_string(),'admin/dashboard') === FALSE)? '': 'class="active"'; ?>><a href="<?php echo site_url('admin/dashboard');?>">الصفحة الرئيسية</a></li>
    <li <?php echo (strpos($this->uri->uri_string(), 'admin/properties') === FALSE )? '': 'class="active"'; ?>><a href="<?php echo site_url('admin/properties');?>">إدارة الإعلانات العقارية</a></li>
    <li <?php echo (strpos($this->uri->uri_string(), 'admin/zone') === FALSE )? '': 'class="active"'; ?>><a href="<?php echo site_url('admin/zone');?>">إدارة المناطق</a></li>
    <li <?php echo (strpos($this->uri->uri_string(), 'admin/project') === FALSE )? '': 'class="active"'; ?>><a href="<?php echo site_url('admin/project');?>">إدارة المشاريع العقارية</a></li>
    <li <?php echo (strpos($this->uri->uri_string(), 'admin/user/members')  === FALSE)? '': 'class="active"'; ?>><a href="<?php echo site_url('admin/user/members');?>">إدارة الأعضاء</a></li>
    <hr>
    <li <?php echo (strpos($this->uri->uri_string(), 'admin/user/admin')  === FALSE)? '' : 'class="active"'; ?>><a href="<?php echo site_url('admin/user/admin');?>">الإدارة</a></li>

  </ul>
</div>