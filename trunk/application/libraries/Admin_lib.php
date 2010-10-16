<?php

class Admin_lib {

	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;
	
	function Admin_lib() {
	
		$this->CI =& get_instance();
	}
	
	function giris_yaptir($id = 0) {
	
		$this->CI->session->set_userdata('admin_id', $id);
	}
	
	function cikis_yaptir() {
	
		$this->CI->session->unset_userdata('admin_id');
	}
	
	function sadece_admin_gorebilir() {
	
		if (!$this->is_admin()) redirect(SAYFA_ADMIN_1);
	}
	
	function sadece_admin_goremez() {
	
		if ($this->is_admin()) redirect(SAYFA_ADMIN_0);
	}
	
	function is_admin() {
	
		 return $this->get_admin_id() > 0;
	}
	
	function get_admin_id() {
	
		return (int) $this->CI->session->userdata('admin_id');
	}
}