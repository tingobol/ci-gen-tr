<?php

class Kullanici_oturumu extends MY_Model {

	var $tablo_adi = 'kullanici_oturumlari';

	var $kullanici_id;
	
	function ekle() {
		
		parent::ekle(array('kullanici_id', 'oturum_id', 'zaman'));
	}

	function sil_where_kullanici_id() {
	
		parent::sil_where_x('kullanici_id');
	}
	
	function sil_where_oturum_id() {
	
		parent::sil_where_x('oturum_id');
	}
	
	function sil_where_kullanici_id_or_oturum_id() {
	
		parent::sil_where_x_or_y('kullanici_id', 'oturum_id');
	}
}