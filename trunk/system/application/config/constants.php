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

define('sayfa_admin_10', 'admin/kategori_yonetimi');
define('sayfa_admin_11', 'admin/kategori_yonetimi/liste');
define('sayfa_admin_12', 'admin/kategori_yonetimi/ekle');
define('sayfa_admin_13', 'admin/kategori_yonetimi/duzenle');
define('sayfa_admin_13_1', 'admin/kategori_yonetimi/duzenle/%d'); // %d: id
define('sayfa_admin_14', 'admin/kategori_yonetimi/sil/%d'); // %d: id

// yazar sayfaları
define('sayfa_yazar_0', 'yazar/panel');
define('sayfa_yazar_1', 'yazar/panel/giris');
define('sayfa_yazar_2', 'yazar/panel/sifremi_unuttum');
define('sayfa_yazar_3', 'yazar/panel/cikis');
define('sayfa_yazar_4', 'yazar/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp
define('sayfa_yazar_5', 'yazar/panel/basvuru_yap');

define('sayfa_yazar_10', 'yazar/yazi_yonetimi');
define('sayfa_yazar_11', 'yazar/yazi_yonetimi/liste');
define('sayfa_yazar_12', 'yazar/yazi_yonetimi/ekle');
define('sayfa_yazar_13', 'yazar/yazi_yonetimi/duzenle');
define('sayfa_yazar_13_1', 'yazar/yazi_yonetimi/duzenle/%d'); // %d: id
define('sayfa_yazar_14', 'yazar/yazi_yonetimi/sil/%d'); // %d: id
define('sayfa_yazar_15', 'yazar/yazi_yonetimi/yayindan_kaldir/%d'); // %d: id

// editör sayfaları
define('sayfa_editor_0', 'editor/panel');
define('sayfa_editor_1', 'editor/panel/giris');
define('sayfa_editor_2', 'editor/panel/sifremi_unuttum');
define('sayfa_editor_3', 'editor/panel/cikis');
define('sayfa_editor_4', 'editor/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp
define('sayfa_editor_5', 'editor/panel/basvuru_yap');

define('sayfa_editor_10', 'editor/yazi_yonetimi');
define('sayfa_editor_11', 'editor/yazi_yonetimi/onay_bekleyenler');

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
define('k_t_giris_yapacak_yazar', 3); // giriş yapacak yazar
define('k_t_giris_yapmis_yazar', 4); // giriş yapmış yazar
define('k_t_giris_yapacak_editor', 5); // giriş yapacak editör
define('k_t_giris_yapmis_editor', 6); // giriş yapmış editör

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */