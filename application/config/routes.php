<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site/home";
$route['404_override'] = '';

$route['login'] = 'site/login';
$route['register'] = 'site/register';

$route['map'] = 'site/map';
$route['map/search'] = 'site/map/search';

$route['search'] = 'site/search';

$route['user/properties'] = 'site/user/properties';
$route['user/properties/add'] = 'site/user/properties/add';
$route['user/properties/delete'] = 'site/user/properties/delete';
$route['user/properties/delete_image'] = 'site/user/properties/delete_image';
$route['user/properties/edit/(:num)'] = 'site/user/properties/edit/property_id/$1';
$route['user/properties/upload'] = 'site/user/properties/upload';
$route['user/profile'] = 'site/user/profile';
$route['user/profile/edit'] = 'site/user/profile/edit';
$route['user/profile/password'] = 'site/user/profile/password';
$route['user/profile/logout'] = 'site/user/profile/logout';

$route['property/insert'] = 'site/property/insert';
$route['property/view/(:num)'] = 'site/property/view/property_id/$1';
$route['property/addModal'] = 'site/property/addModal';
$route['property/static_img/(:num)'] = 'site/property/google_static_map/property_id/$1';

$route['project'] = 'site/project';
$route['project/view/(:num)'] = 'site/project/view/project_id/$1';
$route['project/static_img/(:num)'] = 'site/project/google_static_map/project_id/$1';
$route['project/success'] = 'site/project/success';

$route['page/(:any)'] = 'site/pages/view/$1';

$route['admin'] = 'admin/login';
$route['admin/properties/update/(:num)'] = 'admin/properties/update/property_id/$1';

$route['admin/zone/update/(:num)'] = 'admin/zone/update/zone_id/$1';

$route['admin/project/update/(:num)'] = 'admin/project/update/project_id/$1';

$route['admin/user/members'] = 'admin/user/index/user_group/2';
//$route['admin/user/members/delete'] = 'admin/user/delete/user_group/2';
$route['admin/user/members/insert'] = 'admin/user/insert/user_group/2';
$route['admin/user/members/update/(:num)'] = 'admin/user/update/user_group/2/id/$1';

$route['admin/user/admin'] = 'admin/user/index/user_group/1';
//$route['admin/user/admin/delete'] = 'admin/user/delete/user_group/1';
$route['admin/user/admin/insert'] = 'admin/user/insert/user_group/1';
$route['admin/user/admin/update/(:num)'] = 'admin/user/update/user_group/1/id/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */