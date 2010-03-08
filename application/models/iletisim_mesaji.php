<?php

class Iletisim_mesaji extends MY_Model {

	var $tablo_adi = 'iletisim_mesajlari';

	var $id;
	var $adi; 
	var $mail;
	var $mesaj;
	// var $zaman; MY_Model'de var
	var $ip;
	var $is_okundu = 0;
	var $konu_id;
	
	function Iletisim_mesaji() {
	
		parent::MY_Model();
		
		$this->ip = @$_SERVER['REMOTE_ADDR'];
	}
	
	function ekle_1() {
	
		return parent::ekle(array(
								'adi', 
								'mail', 
								'mesaj', 
								'zaman', 
								'ip', 
								'konu_id'));
	}
}