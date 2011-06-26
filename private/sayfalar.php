<?php

// ROOT Dizinler
define('DIZIN_ROOT_0', HOME_ROOT);
define('DIZIN_ROOT_1_1', DIZIN_ROOT_0 . '/fw3/Smarty308');
define('DIZIN_ROOT_1_2', DIZIN_ROOT_0 . '/fw3/Smarty_plugins');
define('DIZIN_ROOT_2_1', DIZIN_ROOT_0 . '/cache/templates_c');
define('DIZIN_ROOT_3', DIZIN_ROOT_0 . '/templates');

// URL Dizinler
define('DIZIN_URL_1', HOME_URL);
define('DIZIN_URL_2', DIZIN_URL_1 . '/public');
define('DIZIN_URL_3', DIZIN_URL_1 . '/public/resimler/ikonlar');
define('DIZIN_URL_4', DIZIN_URL_1 . '/public/js/syntaxhighlighter');

// SAYFALAR

// Admin Sayfaları
define('SAYFA_ADMIN_0', DIZIN_URL_1 . '/admin/panel');
define('SAYFA_ADMIN_1', DIZIN_URL_1 . '/admin/panel/giris');
define('SAYFA_ADMIN_2', DIZIN_URL_1 . '/admin/panel/sifremi_unuttum');
define('SAYFA_ADMIN_3', DIZIN_URL_1 . '/admin/panel/cikis');
define('SAYFA_ADMIN_4', DIZIN_URL_1 . '/admin/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp
define('SAYFA_ADMIN_6', DIZIN_URL_1 . '/admin/panel/sifre_degistir');

define('SAYFA_ADMIN_11', DIZIN_URL_1 . '/admin/kategori_yonetimi/liste');
define('SAYFA_ADMIN_12', DIZIN_URL_1 . '/admin/kategori_yonetimi/ekle');
define('SAYFA_ADMIN_13', DIZIN_URL_1 . '/admin/kategori_yonetimi/duzenle');
define('SAYFA_ADMIN_13_1', DIZIN_URL_1 . '/admin/kategori_yonetimi/duzenle/%d'); // %d: id
define('SAYFA_ADMIN_14', DIZIN_URL_1 . '/admin/kategori_yonetimi/sil/%d'); // %d: id

define('SAYFA_ADMIN_21', DIZIN_URL_1 . '/admin/yazilar_kontrol_bekleyenler/liste');
define('SAYFA_ADMIN_22', DIZIN_URL_1 . '/admin/yazilar_kontrol_bekleyenler/detay/%d');
define('SAYFA_ADMIN_23', DIZIN_URL_1 . '/admin/yazilar_kontrol_bekleyenler/editore_gonder/%d');

// Editör Sayfaları

define('SAYFA_EDITOR_0', DIZIN_URL_1 . '/editor/panel');
define('SAYFA_EDITOR_1', DIZIN_URL_1 . '/editor/panel/giris');
define('SAYFA_EDITOR_2', DIZIN_URL_1 . '/editor/panel/sifremi_unuttum');
define('SAYFA_EDITOR_3', DIZIN_URL_1 . '/editor/panel/cikis');
define('SAYFA_EDITOR_4', DIZIN_URL_1 . '/editor/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp
define('SAYFA_EDITOR_5', DIZIN_URL_1 . '/editor/panel/basvuru_yap');
define('SAYFA_EDITOR_6', DIZIN_URL_1 . '/editor/panel/sifre_degistir');

define('SAYFA_EDITOR_11', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyenler');
define('SAYFA_EDITOR_12', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyen_detay/%d'); // %d: yazi_id
define('SAYFA_EDITOR_13', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyen_yayinla/%d'); // %d: yazi_id
define('SAYFA_EDITOR_14', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyeni_admin_kontrol_etsin/%d'); // %d: yazi_id
define('SAYFA_EDITOR_15', DIZIN_URL_1 . '/editor/yazi_yonetimi/onay_bekleyeni_yazar_kontrol_etsin/%d'); // %d: yazi_id

// Yazar Sayfaları

define('SAYFA_YAZAR_0', DIZIN_URL_1 . '/yazar/panel');
define('SAYFA_YAZAR_1', DIZIN_URL_1 . '/yazar/panel/giris');
define('SAYFA_YAZAR_2', DIZIN_URL_1 . '/yazar/panel/sifremi_unuttum');
define('SAYFA_YAZAR_3', DIZIN_URL_1 . '/yazar/panel/cikis');
define('SAYFA_YAZAR_4', DIZIN_URL_1 . '/yazar/panel/sifreyi_sifirla/%d/%s'); // %d: id, %s: temp
define('SAYFA_YAZAR_5', DIZIN_URL_1 . '/yazar/panel/basvuru_yap');
define('SAYFA_YAZAR_6', DIZIN_URL_1 . '/yazar/panel/sifre_degistir');

define('SAYFA_YAZAR_11', DIZIN_URL_1 . '/yazar/yazi_yonetimi/liste');
define('SAYFA_YAZAR_12', DIZIN_URL_1 . '/yazar/yazi_yonetimi/ekle');
define('SAYFA_YAZAR_13', DIZIN_URL_1 . '/yazar/yazi_yonetimi/duzenle');
define('SAYFA_YAZAR_13_1', DIZIN_URL_1 . '/yazar/yazi_yonetimi/duzenle/%d'); // %d: id
define('SAYFA_YAZAR_14', DIZIN_URL_1 . '/yazar/yazi_yonetimi/sil/%d'); // %d: id
define('SAYFA_YAZAR_15', DIZIN_URL_1 . '/yazar/yazi_yonetimi/yayindan_kaldir/%d'); // %d: id

// Misafir Sayfaları

define('SAYFA_MISAFIR_0', DIZIN_URL_1);

// define('SAYFA_MISAFIR_11', DIZIN_URL_1 . '/misafir/ana_sayfa');
define('SAYFA_MISAFIR_11', DIZIN_URL_1);
// define('SAYFA_MISAFIR_12', DIZIN_URL_1 . '/misafir/ana_sayfa/index/%d'); // %d: sayfa_no
// define('SAYFA_MISAFIR_12', DIZIN_URL_1 . '/sayfa-%d'); // %d: sayfa_no
define('SAYFA_MISAFIR_12', DIZIN_URL_1 . '/sayfa/%d'); // %d: sayfa_no

// define('SAYFA_MISAFIR_23', DIZIN_URL_1 . '/misafir/yazilar/detay/%d'); // %s: id
// define('SAYFA_MISAFIR_23', DIZIN_URL_1 . '/kategori-%d/yazi-%d'); // %d: kategori_id, %d: yazi_id
define('SAYFA_MISAFIR_23', DIZIN_URL_1 . '/yazi/%d'); // %d: yazi_id

// define('SAYFA_MISAFIR_31', DIZIN_URL_1 . '/misafir/kategoriler/yazilari_listele/%d'); // %d: kategori_id
// define('SAYFA_MISAFIR_31', DIZIN_URL_1 . '/kategori-%d'); // %d: kategori_id
define('SAYFA_MISAFIR_31', DIZIN_URL_1 . '/kategori/%d'); // %d: kategori_id
// define('SAYFA_MISAFIR_32', DIZIN_URL_1 . '/misafir/kategoriler/yazilari_listele/%d/%d'); // %d: kategori_id, %d: sayfa_no
// define('SAYFA_MISAFIR_32', DIZIN_URL_1 . '/kategori-%d/sayfa-%d'); // %d: kategori_id, %d: sayfa_no
define('SAYFA_MISAFIR_32', DIZIN_URL_1 . '/kategori/%d/sayfa/%d'); // %d: kategori_id, %d: sayfa_no

// define('SAYFA_MISAFIR_41', DIZIN_URL_1 . '/misafir/sayfalar/iletisim');
define('SAYFA_MISAFIR_41', DIZIN_URL_1 . '/iletisim');
// define('SAYFA_MISAFIR_42', DIZIN_URL_1 . '/misafir/sayfalar/arama');
define('SAYFA_MISAFIR_42', DIZIN_URL_1 . '/arama');

// define('SAYFA_MISAFIR_51', DIZIN_URL_1 . '/misafir/yazi_etiketleri/yazilari_listele/%d'); // %d: etiket_id
// define('SAYFA_MISAFIR_51', DIZIN_URL_1 . '/etiket-%d'); // %d: etiket_id
define('SAYFA_MISAFIR_51', DIZIN_URL_1 . '/etiket/%d'); // %d: etiket_id
// define('SAYFA_MISAFIR_52', DIZIN_URL_1 . '/misafir/yazi_etiketleri/yazilari_listele/%d/%d'); // %d: etiket_id, %d: sayfa_no
// define('SAYFA_MISAFIR_52', DIZIN_URL_1 . '/etiket-%d/sayfa-%d'); // %d: etiket_id, %d: sayfa_no
define('SAYFA_MISAFIR_52', DIZIN_URL_1 . '/etiket/%d/sayfa/%d'); // %d: etiket_id, %d: sayfa_no