<?php

class Iletisim_konusu extends MY_Model {

	var $tablo_adi = 'iletisim_konulari';

	var $id;
	var $adi;
	
	// iletişim formunda kullanılmaktadır.
	function get_liste_1() {
	
		$items = $this->db
					->select('id, adi')
					->order_by('adi', 'asc')
					->get('iletisim_konulari');
			
		$return = array(0 => 'Konu Seçiniz');	
						
		foreach ($items->result() as $item) {
		
			$return[$item->id] = $item->adi;
		}		
		
		return $return;
	}
}