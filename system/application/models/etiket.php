<?php 

class Etiket extends MY_Model {

	var $tablo_adi = 'etiketler';

	var $id;
	var $adi; 
	
	function get_id_where_adi_yoksa_ekle() {
	
		$detay = $this->get_detay_where_adi();
		
		if (isset($detay->id)) return $detay->id;

		return $this->ekle();
	}
	
	function get_detay_where_adi() {
	
		return parent::get_detay_where_x('adi');
	}
	
	function ekle() {
	
		return parent::ekle(array(
						'adi'));		
	}
}