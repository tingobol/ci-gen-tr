<?php

class Kategori_mod extends MY_Model {

	var $tablo_adi = 'kategoriler';

	var $id;
	var $adi;
	var $meta_aciklama;
	var $meta_arama;
	
	// yazı eklerken drop down liste için kullanılmaktadır.
	function get_liste_1() {
	
		$items = $this->db->order_by('adi', 'asc')
						  ->get($this->tablo_adi);

		$return['values'] = array(0);
		$return['output'] = array('Kategori Seçiniz');	

		foreach ($items->result() as $item) {
		
			$return['values'][] = $item->id;
			$return['output'][] = $item->adi;
		}		

		return $return;
	}
	
	
	// misafire sol tarafda kategorilerin bağlantılarını göstermek için
	function get_liste_2() {
	
		return $this->db->select('id, adi')
						->order_by('adi', 'asc')
						->get($this->tablo_adi);
	}
	
	function get_liste_3() {
	
		return $this->db->select('id, adi')
						->order_by('adi', 'desc')
						->get($this->tablo_adi);
	}
	
	// html select içinde göstermek için 
	function get_liste_4() {
	
		return $this->db->select('id, adi')
						->order_by('adi', 'ASC')
						->get($this->tablo_adi);
	}
	
	function is_var_where_adi() {
	
		return parent::is_var_where_x('adi');
	}
	
	function is_var_where_adi_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('adi');
	}
	
	// adminin kategori eklemesi için kullanılmaktadır
	function ekle_1() {
	
		parent::ekle(array('adi', 'meta_aciklama', 'meta_arama'));
	}
	
	// adminin kategori güncellemesi için kullanmaktadır
	function guncelle_1() {
	
		$data = array(
					'adi' => $this->adi, 
					'meta_aciklama' => $this->meta_aciklama, 
					'meta_arama' => $this->meta_arama);
					
		parent::guncelle_where_id($data);
	}
}