<?php

class Yazilar_kontrol_bekleyenler extends MY_AdminKontroller {
	
	function liste() {
		
		$this->admin_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi_mod');
		
		$data['yazilar'] = $this->yazi_mod->get_liste_8();
		
		$data['meta_baslik'] = 'Kontrol Bekleyen Yazılar Listesi';
		
		// flash datalar set ediliyor
		$data['tamam'] = $this->session->flashdata('tamam');
		
		$data['icerik'] = $this->smarty->view('admin/yazilar_kontrol_bekleyenler/liste.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
	
	function detay($id = 0) {
	
		$this->admin_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi_mod');
		$this->load->model('yazi_etiketi_mod');
		
		$this->yazi_mod->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi_mod->is_var_where_id())
			redirect(SAYFA_ADMIN_21);
			
		// yazının durumu admin kontrol edecek olmalı
		if ($this->yazi_mod->get_durum_where_id() != Yazi_mod::DURUM_ADMIN_KONTROL_EDECEK)
			redirect(SAYFA_ADMIN_21);

		$this->yazi_etiketi_mod->yazi_id = $this->yazi_mod->id;
			
		$data['yazi'] = $this->yazi_mod->get_detay_2();
		$data['yazi_etiketleri'] = $this->yazi_etiketi_mod->get_liste_2();
		
		$data['meta_baslik'] = 'Kontrol Bekleyen Yazı Detay';
		
		$data['icerik'] = $this->smarty->view('admin/yazilar_kontrol_bekleyenler/detay.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
	
	function editore_gonder($id = 0) {
	
		$this->admin_lib->sadece_admin_gorebilir();
		
		$this->load->model('yazi_mod');
		
		$this->yazi_mod->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi_mod->is_var_where_id())
			redirect(SAYFA_ADMIN_21);
			
		// yazının durumu admin kontrol edecek olmalı
		if ($this->yazi_mod->get_durum_where_id() != Yazi_mod::DURUM_ADMIN_KONTROL_EDECEK)
			redirect(SAYFA_ADMIN_21);
			
		// yazının durumunu güncelle
		$this->yazi_mod->durum = Yazi_mod::DURUM_EDITOR_KONTROL_EDECEK;
		$this->yazi_mod->guncelle_durum_where_id();
		
		$this->session->set_flashdata('tamam', 'Yazıyı editörler inceleyecek.');
		
		redirect(SAYFA_ADMIN_21);
	}
}