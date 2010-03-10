<?php

class Yazi_yonetimi extends MY_EditorKontroller {
	
	function onay_bekleyenler() {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_editor;
		
		$this->smarty->view('editor/yazi_yonetimi/onay_bekleyenler.tpl', $data);
	} 
}