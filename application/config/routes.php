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

$route['default_controller'] = "misafir/ana_sayfa";
$route['404_override'] = '';

// sabit sayfalar
$route['iletisim'] = 'misafir/sayfalar/iletisim';
$route['arama'] = 'misafir/sayfalar/arama';

$route['etiket/(:num)/sayfa/(:num)'] = 'misafir/yazi_etiketleri/yazilari_listele/$1/$2';
$route['etiket/(:num)'] = 'misafir/yazi_etiketleri/yazilari_listele/$1';

$route['kategori/(:num)/sayfa/(:num)'] = 'misafir/kategoriler/yazilari_listele/$1/$2';
$route['kategori/(:num)'] = 'misafir/kategoriler/yazilari_listele/$1';

$route['yazi/(:num)'] = "misafir/yazilar/detay/$1";

// ana sayfada yazıların sayfalanması için
$route['sayfa/(:num)'] = 'misafir/ana_sayfa/index/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */