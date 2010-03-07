<?php

// SABİTLER
define('SABIT_1', 'deneme');

define('SABIT_GIRIS_YAPACAK_ADMIN', 1);
define('SABIT_GIRIS_YAPMIS_ADMIN', 2);
define('SABIT_GIRIS_YAPACAK_YAZAR', 3);
define('SABIT_GIRIS_YAPMIS_YAZAR', 4);
define('SABIT_GIRIS_YAPACAK_EDITOR', 5);
define('SABIT_GIRIS_YAPMIS_EDITOR', 6);
define('SABIT_YENI_GELMIS_MISAFIR', 7); // yeni gelmiş bir misafir, her hangi bir kullanıcı olabilir.

// ROOT Dizinler
define('DIZIN_ROOT_1', HOME_ROOT);
define('DIZIN_ROOT_2', DIZIN_ROOT_1 . '/private');
define('DIZIN_ROOT_3', DIZIN_ROOT_1 . '/private/Smarty');

// URL Dizinler
define('DIZIN_URL_1', HOME_URL);
define('DIZIN_URL_2', DIZIN_URL_1 . '/public');

define('DIZIN_URL_11', DIZIN_URL_1 . '/misafir/yazilar/detay');
define('DIZIN_URL_12', DIZIN_URL_1 . '/misafir/yazilar/liste');

define('DIZIN_URL_21', DIZIN_URL_1 . '/misafir/kategoriler/yazilari_listele');

// SAYFALAR

// Admin
define('SAYFA_ADMIN_0', DIZIN_URL_1 . '/admin/panel');
define('SAYFA_ADMIN_1', DIZIN_URL_1 . '/admin/panel/giris');
define('SAYFA_ADMIN_2', DIZIN_URL_1 . '/admin/panel/sifremi_unuttum');
define('SAYFA_ADMIN_3', DIZIN_URL_1 . '/admin/panel/cikis');

define('SAYFA_ADMIN_11', DIZIN_URL_1 . '/admin/kategori_yonetimi/liste');
define('SAYFA_ADMIN_12', DIZIN_URL_1 . '/admin/kategori_yonetimi/ekle');

// Yazar
define('SAYFA_YAZAR_0', DIZIN_URL_1 . '/yazar/panel');
define('SAYFA_YAZAR_1', DIZIN_URL_1 . '/yazar/panel/giris');
define('SAYFA_YAZAR_2', DIZIN_URL_1 . '/yazar/panel/sifremi_unuttum');
define('SAYFA_YAZAR_3', DIZIN_URL_1 . '/yazar/panel/cikis');
define('SAYFA_YAZAR_5', DIZIN_URL_1 . '/yazar/panel/basvuru_yap');
define('SAYFA_YAZAR_6', DIZIN_URL_1 . '/yazar/panel/sifre_degistir');

define('SAYFA_YAZAR_11', DIZIN_URL_1 . '/yazar/yazi_yonetimi/liste');
define('SAYFA_YAZAR_12', DIZIN_URL_1 . '/yazar/yazi_yonetimi/liste');

// Editör
define('SAYFA_EDITOR_0', DIZIN_URL_1 . '/editor/panel');
define('SAYFA_EDITOR_1', DIZIN_URL_1 . '/editor/panel/giris');
define('SAYFA_EDITOR_2', DIZIN_URL_1 . '/editor/panel/sifremi_unuttum');
define('SAYFA_EDITOR_3', DIZIN_URL_1 . '/editor/panel/cikis');
define('SAYFA_EDITOR_5', DIZIN_URL_1 . '/editor/panel/basvuru_yap');

define('SAYFA_EDITOR_11', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyenler');

// Misafir
define('SAYFA_MISAFIR_0', DIZIN_URL_1 . '/misafir/yazilar/liste');

define('SAYFA_MISAFIR_21', DIZIN_URL_1 . '/misafir/yazilar/liste');
define('SAYFA_MISAFIR_22', DIZIN_URL_1 . '/misafir/yazilar/liste/%d'); // %d: sayfa_no
define('SAYFA_MISAFIR_23', DIZIN_URL_1 . '/misafir/yazilar/detay/%d'); // $s: id

define('SAYFA_MISAFIR_31', DIZIN_URL_1 . '/misafir/kategoriler/yazilari_listele/%d'); // %d: kategori_id

define('SAYFA_MISAFIR_41', DIZIN_URL_1 . '/misafir/sayfalar/iletisim');
