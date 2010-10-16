<?php

class Iletisim_konusu_lib {

	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;

	function Iletisim_konusu_lib() {

		$this->CI =& get_instance();
		
		// lazım olacak modelleri yükle
		$this->CI->load->model('iletisim_konusu_mod');
	}
	
	function get_html_select1($selected_id = 0) {

		$sonuclar = $this->CI->iletisim_konusu_mod->get_liste_2();
		
		$return = '<select name="konu_id" title="Konu Seçiniz">' . "\n";
		$return .= '<option value="0">Lütfen Seçiniz</option>' . "\n";
		
		foreach ($sonuclar->result() as $sonuc) {
			
			if ($sonuc->id == $selected_id) $selected = ' selected="selected"';
			else $selected = '';
			
			$return .= '<option value="' . $sonuc->id . '"' . $selected . '>' . $sonuc->adi . '</option>' . "\n";
		}
		
		$return .= '</select>' . "\n";
		
		return $return;
	}
}