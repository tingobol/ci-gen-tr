<?php

class Kategori_lib {

	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;

	function Kategori_lib() {

		$this->CI =& get_instance();
		
		// lazım olacak modelleri yükle
		$this->CI->load->model('kategori_mod');
	}
	
	function get_html_select1($selected_id = 0) {

		$sonuclar = $this->CI->kategori_mod->get_liste_4();
		
		$return = '<select name="kategori_id" title="Yazı kategorisini seçiniz.">' . "\n";
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