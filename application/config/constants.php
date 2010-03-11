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
 
// site genelinde kullanılan sabitler
define('sabit_1', 'ci.gen.tr'); // mail gönderirken user agent olarak kullanılacak
define('sabit_2', 'bilgi@ci.gen.tr'); // sitenin mail adresi
define('sabit_3', 'ci.gen.tr'); // mail gönderirken kullanılacak ad

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
define('k_t_yeni_gelmis_misafir', 7); // yeni gelmiş bir misafir, her hangi bir kullanıcı olabilir.

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */