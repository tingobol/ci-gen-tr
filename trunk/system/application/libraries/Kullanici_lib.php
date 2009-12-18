<?php

class Kullanici_lib {

	var $CI;
	
	var $kullanici_id ;
	var $kullanici_adi;
	var $kullanici_mail;
	var $kullanici_turu; 
	
	function Kullanici_lib() {
	
		$this->CI =& get_instance();
		
		$this->kullanici_turu = Kullanici::TUR_MISAFIR;
	}
	
	function init() {
		
		if ($detay = $this->CI->kullanici->get_detay_for_kullanici_lib()) {
		
			$this->kullanici_id = $detay->id;
			$this->kullanici_adi = $detay->adi;
			$this->kullanici_mail = $detay->mail;
			$this->kullanici_turu =  $detay->turu;
		}
	}
	
	function sadece_admin_gorebilir() {
	
		if (!$this->is_admin()) redirect(sayfa_admin_1);
	}
	
	function sadece_misafir_gorebilir() {
	
		if (!$this->is_misafir()) redirect(sayfa_admin_2);
	}
	
	function is_misafir() {
	
		return $this->kullanici_turu == Kullanici::TUR_MISAFIR;
	}
	
	function is_admin() {
	
		return $this->kullanici_turu == Kullanici::TUR_ADMIN;
	}
}