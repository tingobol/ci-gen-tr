<?php

// SABİTLER
define('SABIT_1', 'ci.gen.tr'); // mail gönderirken user agent olarak kullanılacak
define('SABIT_2', 'bilgi@ci.gen.tr'); // sitenin mail adresi
define('SABIT_3', 'ci.gen.tr'); // mail gönderirken kullanılacak ad
define('SABIT_4', 'http://localhost:8080/tr.gen.ci'); // LOCAL ROOT Url
define('SABIT_5', 'http://www.ci.gen.tr'); // LIVE ROOT Url

define('SABIT_GIRIS_YAPACAK_ADMIN', 1);
define('SABIT_GIRIS_YAPMIS_ADMIN', 2);
define('SABIT_GIRIS_YAPACAK_YAZAR', 3);
define('SABIT_GIRIS_YAPMIS_YAZAR', 4);
define('SABIT_GIRIS_YAPACAK_EDITOR', 5);
define('SABIT_GIRIS_YAPMIS_EDITOR', 6);
define('SABIT_YENI_GELMIS_MISAFIR', 7); // yeni gelmiş bir misafir, her hangi bir kullanıcı olabilir.

// Yazı Durumları
define('SABIT_YAZI_DURUM_EDITOR_KONTROL_EDECEK', 0);
define('SABIT_YAZI_DURUM_ONAYLI', 1);
define('SABIT_YAZI_DURUM_YAYINDAN_KALKMIS', 2);
define('SABIT_YAZI_DURUM_ADMIN_KONTROL_EDECEK', 3);
define('SABIT_YAZI_DURUM_YAZAR_KONTROL_EDECEK', 4);