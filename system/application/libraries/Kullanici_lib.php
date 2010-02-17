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
	
	function init($kullanici_turu = 0) {
		
		$this->CI->kullanici->turu = $kullanici_turu;
		
		if ($detay = $this->CI->kullanici->get_detay_for_kullanici_lib()) {
		
			$this->kullanici_id = $detay->id;
			$this->kullanici_adi = $detay->adi;
			$this->kullanici_mail = $detay->mail;
			$this->kullanici_turu =  $detay->turu;
		}
	}
	
	function sadece_admin_gorebilir() { if (!$this->is_admin()) redirect(sayfa_admin_1); }
	function sadece_yazar_gorebilir() { if (!$this->is_yazar()) redirect(sayfa_yazar_1); }
	function sadece_editor_gorebilir() { if (!$this->is_editor()) redirect(sayfa_editor_1); }

	function is_admin() { return $this->kullanici_turu == Kullanici::TUR_ADMIN; }
	function is_yazar() { return $this->kullanici_turu == Kullanici::TUR_YAZAR; }
	function is_editor() { return $this->kullanici_turu == Kullanici::TUR_EDITOR; }
}