<div class="col-sm-3 col-md-2 sidebar">
  <div class="text-center">
    <img src="<?php echo base_url('assets/image/logo.png');?>" width="100%"><br><br>
  </div>
  <ul class="nav nav-sidebar">
    <li  <?php echo ($this->uri->uri_string() == 'admin/dashboard' )? 'class="active"' :''; ?>><a href="<?php echo site_url('admin/dashboard');?>">الصفحة الرئيسية</a></li>
    <li <?php echo ($this->uri->uri_string() == 'admin/properties' )? 'class="active"' :''; ?>><a href="<?php echo site_url('admin/properties');?>">إدارة الإعلانات العقارية</a></li>
    <li <?php echo ($this->uri->uri_string() == 'admin/zone' )? 'class="active"' :''; ?>><a href="<?php echo site_url('admin/zone');?>">إدارة المناطق</a></li>
    <li <?php echo ($this->uri->uri_string() == 'admin/project' )? 'class="active"' :''; ?>><a href="<?php echo site_url('admin/project');?>">إدارة المشاريع العقارية</a></li>
    <li><a href="<?php echo site_url('admin/dashboard');?>">إدارة الأعضاء</a></li>
    <hr>
    <li><a href="<?php echo site_url('admin/dashboard');?>">الإدارة</a></li>

  </ul>
</div>