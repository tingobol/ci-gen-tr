<?php

class Kullanici_oturumu extends MY_Model {

	var $tablo_adi = 'kullanici_oturumlari';

	var $kullanici_id;
	
	function ekle() {
	
		parent::ekle(array('kullanici_id', 'oturum_id', 'zaman'));
	}
	
	function sil_where_oturum_id() {
	
		parent::sil_where_x('oturum_id');
	}
}