<?php

class Kontrol_bekleyenler extends MY_AdminKontroller {
	
	function liste() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi');
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kontrol Bekleyen Yazılar Listesi';
		
		$data['yazilar'] = $this->yazi->get_liste_8();
		
		$data['tamam'] = $this->session->flashdata('tamam');
		
		$this->smarty->view('admin/yazi_yonetimi/kontrol_bekleyenler/liste.tpl', $data);
	}
	
	function detay($id = 0) {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi');
		$this->load->model('yazi_etiketi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_ADMIN_21);
			
		$temp_yazi = $this->yazi->get_detay_2();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi->durum != SABIT_YAZI_DURUM_ADMIN_KONTROL_EDECEK)
			redirect(SAYFA_ADMIN_21);
			
		$this->yazi_etiketi->yazi_id = $this->yazi->id;
			
		$data['yazi'] = $temp_yazi; unset($temp_yazi);
		$data['yazi_etiketleri'] = $this->yazi_etiketi->get_liste_2();
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kontrol Bekleyen Yazı Detay';
		
		$this->smarty->view('admin/yazi_yonetimi/kontrol_bekleyenler/detay.tpl', $data);
	}
	
	function editore_gonder($id = 0) {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_ADMIN_21);
			
		$temp_yazi_durum = $this->yazi->get_durum_where_id();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi_durum != SABIT_YAZI_DURUM_ADMIN_KONTROL_EDECEK)
			redirect(SAYFA_ADMIN_21);
			
		$this->yazi->durum = SABIT_YAZI_DURUM_EDITOR_KONTROL_EDECEK;
		
		$this->yazi->guncelle_durum_where_id();
		
		$this->session->set_flashdata('tamam', 'Yazıyı editörler inceleyecek.');
		
		redirect(SAYFA_ADMIN_21);
	}
}