<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
 
// admin sayfaları
define('sayfa_admin_1', 'admin/panel/giris');
define('sayfa_admin_2', 'admin/panel');
define('sayfa_admin_3', 'admin/panel/sifremi_unuttum');
define('sayfa_admin_4', 'admin/panel/cikis');
define('sayfa_admin_5', 'admin/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp

define('sayfa_admin_11', 'admin/kategori_yonetimi/liste');
define('sayfa_admin_12', 'admin/kategori_yonetimi/ekle');
define('sayfa_admin_13', 'admin/kategori_yonetimi/duzenle');
define('sayfa_admin_14', 'admin/kategori_yonetimi/sil');

// site genelinde kullanılan sabitler
define('sabit_1', 'Bulsam.Net Blog'); // mail gönderirken user agent olarak kullanılacak
define('sabit_2', 'blog@bulsam.net'); // sitenin mail adresi
define('sabit_3', 'Bulsam.Net Blog'); // mail gönderirken kullanılacak ad

// URL Sayfaları
define('misafir_sayfa_1', 'yazilar/detay/%d');
define('misafir_sayfa_2', 'kategoriler/detay/%d');

// Genel sabitler
define('sabit_oturum_id', session_id());

// Kullanıcı Türleri
define('k_t_giris_yapacak_admin', 1); // giriş yapacak admin
define('k_t_giris_yapmis_admin', 2); // giriş yapmış admin

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */