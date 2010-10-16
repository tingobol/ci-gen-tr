<?php 

class Etiket_mod extends MY_Model {

	var $tablo_adi = 'etiketler';

	var $id;
	var $adi; 
	
	/**
	 * veritabanına etiket eklenmeye çalışılmaktadır.
	 * eğer daha önce etiket eklenmiş ise mevcut 
	 * etiketin id numarası geri verilmektedir.
	 * eğer daha önce etiket eklenmediyse önce etiket 
	 * ekleniyor, sonra ise eklenen etiketin id 
	 * numarası geri veriliyor.
	 * 
	 * @return int
	 */
	function get_id_where_adi_yoksa_ekle() {
	
		$detay = $this->get_detay_where_adi();
		
		if (isset($detay->id)) return $detay->id;

		return $this->ekle();
	}
	
	function get_detay_where_adi() {
	
		return parent::get_detay_where_x('adi');
	}
	
	function ekle() {
	
		if (empty($this->adi)) throw new Exception('Etiket adı boş olamaz.');
		
		return parent::ekle(array('adi'));		
	}
}