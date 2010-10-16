<?php

class Yazar_lib {

	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;
	
	function Yazar_lib() {
	
		$this->CI =& get_instance();
	}
	
	function giris_yaptir($id = 0) {
	
		$this->CI->session->set_userdata('yazar_id', $id);
	}
	
	function cikis_yaptir() {
	
		$this->CI->session->unset_userdata('yazar_id');
	}
	
	function sadece_yazar_gorebilir() {
	
		if (!$this->is_yazar()) redirect(SAYFA_YAZAR_1);
	}
	
	function sadece_yazar_goremez() {
	
		if ($this->is_yazar()) redirect(SAYFA_YAZAR_0);
	}
	
	function is_yazar() {
	
		 return $this->get_yazar_id() > 0;
	}
	
	function get_yazar_id() {
	
		return (int) $this->CI->session->userdata('yazar_id');
	}
}