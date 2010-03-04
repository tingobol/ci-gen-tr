<?php

class Yazi_yonetimi extends MY_EditorKontroller {
	
	function onay_bekleyenler() {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_editor;
		
		$data['kullanici_adi'] = $this->kullanici_lib->kullanici_adi;
		
		$this->load->view('editor/yazi_yonetimi/onay_bekleyenler', $data);
	} 
}