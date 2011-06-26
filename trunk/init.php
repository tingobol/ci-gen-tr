<?php

/*
 * Kendi bilgisayarımızda geliştirme yaparken 
 * sitenin bazı kısımlarına ihtiyaç duymadığımız zaman 
 * kullanabileceğimiz bir LOCAL değişkeni ayarlıyoruz.
 * 
 * Kodların her hangi bir yerinde sadece lokalde 
 * çalışmasını istediğimiz bir kod varsa bunu 
 * 
 * if (LOCAL) {
 * 
 * 		echo 'Sadece Lokalde';
 * }
 * 
 * şeklinde kullanabiliriz. Aynı şekilde 
 * sadece yayında iken çalıştırılacak kodları da
 * 
 * if (!LOCAL) {
 * 
 * 		echo 'Sadece Gerçek Sunucuda';
 * }
 * 
 * şeklinde kullanabiliriz.
 */
define('LOCAL', $_SERVER['SERVER_NAME'] == 'localhost' ? true : false);

/*
 * index.php dosyasının kök dizinini verecektir. 
 * bu bilgiyi sistemdeki dosyalara arkaplanda 
 * ulaşmak için kullanılacaktır. Örneğin
 * 
 * require_once HOME_ROOT . '/ayarlar.php';
 * 
 * şeklinde kullanılabilir.
 * 
 * windows'da C:\Program Files ... şeklinde olacaktır
 * linux da /var/www/vhosts ... şeklinde olacaktır
 */
define('HOME_ROOT', dirname(__FILE__));


/*
 * Siteyi sunucuya attıktan sonra genel anlamda 
 * ihtiyaç duyulacak tüm ayarlar burada toplanmaya 
 * çalışıldı. 
 */
require_once HOME_ROOT . '/private/ayarlar.php';

/*
 * Proje içerisinde kullanılan tüm sabitler burada 
 * tanımlandı. Ayrıca sitenin url sayfaları da 
 * burada tanımlanmıştır.
 */
require_once HOME_ROOT . '/private/sabitler.php';

// Local demiyiz?
if (LOCAL) {
	
	// Evet
	define('HOME_URL', SABIT_4);
	
	// Hata raporlamayı etkinleştir.
	error_reporting(E_ALL);
} else {
	
	// Hayır
	define('HOME_URL', SABIT_5);
	
	// Hata raporlamayı kapat
	error_reporting(0);
}

/*
 * Sitede kullanılan tüm root, url ve sayfa 
 * adresleri burada tanımlanmıştır.
 */
require_once HOME_ROOT . '/private/sayfalar.php';

// incs