<?php

// yazarların eklediği yazı özetlerini ve içeriklerini filtrelemek için kullanılır.
function html_filtrele_1($icerik) {

	return strip_tags($icerik, '<p><br><hr><b><i><u><ul><ol><li><pre><img><table><tr><td><th><thead><tbody><tfoot><code>');
}

/*
function html_r_cevir($girdi) {

	$dizi_tr = array('  ', '   ', ' - ', 'ı','ğ','ü','ş','İ','ö','ç','Ğ','Ü','Ş','Ö','Ç', ' ','?');
	$dizi_en = array('',   '',    '-',   'i','g','u','s','i','o','c','g','u','s','o','c', '-','');
	
	return strtolower(str_replace($dizi_tr, $dizi_en, $girdi));
}


http://forum.ceviz.net/php/17267-kutuphane-2.html
function cevir ($girdi,$dil) {
    $dizi_tr = array('ı','ğ','ü','ş','İ','ö','ç','Ğ','Ü','Ş','Ö','Ç');
    $dizi_en = array('i;tr','g;tr','u;tr','s;tr','I;tr','o;tr','c;tr','G;tr','U;tr','S;tr','O;tr','C;tr');
    if ( $dil == "TR"     ) { $girdi = str_replace($dizi_en,$dizi_tr,$girdi); return $girdi; }
    elseif ( $dil == "EN" ) { $girdi = str_replace($dizi_tr,$dizi_en,$girdi); return $girdi; }
    else { return 0; }
}  */