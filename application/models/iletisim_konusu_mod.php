<?php

class Iletisim_konusu_mod extends MY_Model {

	var $tablo_adi = 'iletisim_konulari';

	var $id;
	var $adi;
	
	function get_adi_where_id() {
	
		return parent::get_x_where_id('adi');
	}
	
	// iletişim formunda kullanılmaktadır.
	function get_liste_1() {
	
		$items = $this->db
						->order_by('adi', 'asc')
						->get($this->tablo_adi);

		$return['values'] = array(0);
		$return['output'] = array('Konu Seçiniz');	

		foreach ($items->result() as $item) {
		
			$return['values'][] = $item->id;
			$return['output'][] = $item->adi;
		}		

		return $return;
	}
	
	// html select için
	function get_liste_2() {
	
		return $this->db->select('id, adi')
						->order_by('adi', 'ASC')
						->get($this->tablo_adi);
	}
}