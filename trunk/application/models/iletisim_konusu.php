<?php

class Iletisim_konusu extends MY_Model {

	var $tablo_adi = 'iletisim_konulari';

	var $id;
	var $adi;
	
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
}