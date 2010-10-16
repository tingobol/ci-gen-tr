<?php

class Editor_lib {

	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;
	
	function Editor_lib() {
	
		$this->CI =& get_instance();
	}
	
	function giris_yaptir($id = 0) {
	
		$this->CI->session->set_userdata('editor_id', $id);
	}
	
	function cikis_yaptir() {
	
		$this->CI->session->unset_userdata('editor_id');
	}
	
	function sadece_editor_gorebilir() {
	
		if (!$this->is_editor()) redirect(SAYFA_EDITOR_1);
	}
	
	function sadece_editor_goremez() {
	
		if ($this->is_editor()) redirect(SAYFA_EDITOR_0);
	}
	
	function is_editor() {
	
		 return $this->get_editor_id() > 0;
	}
	
	function get_editor_id() {
	
		return (int) $this->CI->session->userdata('editor_id');
	}
}