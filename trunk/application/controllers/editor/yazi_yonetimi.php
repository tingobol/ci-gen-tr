<?php

class Yazi_yonetimi extends MY_EditorKontroller {
	
	function onay_bekleyenler() {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->load->model('yazi');
		
		$data['k_t'] = k_t_giris_yapmis_editor;
		
		$data['meta_baslik'] = 'Onay Bekleyen Yazılar Listesi';
		
		$data['yazilar'] = $this->yazi->get_liste_7();
		
		$data['tamam'] = $this->session->flashdata('tamam');
		
		$this->smarty->view('editor/yazi_yonetimi/onay_bekleyenler.tpl', $data);
	} 
	
	function onay_bekleyen_detay($id = 0) {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->load->model('yazi');
		$this->load->model('yazi_etiketi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_EDITOR_11);
			
		$temp_yazi = $this->yazi->get_detay_2();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi->durum != Yazi::DURUM_EDITOR_KONTROL_EDECEK)
			redirect(SAYFA_EDITOR_11);
			
		$this->yazi_etiketi->yazi_id = $this->yazi->id;
			
		$data['yazi'] = $temp_yazi; unset($temp_yazi);
		$data['yazi_etiketleri'] = $this->yazi_etiketi->get_liste_2();
		
		$data['k_t'] = k_t_giris_yapmis_editor;
		
		$data['meta_baslik'] = 'Onay Bekleyen Yazı Detay';
		
		$this->smarty->view('editor/yazi_yonetimi/onay_bekleyen_detay.tpl', $data);
	}
	
	/**
	 * editörün bekleyen yazıyı yayınlaması için kullanılır.
	 * 
	 * @param int $id yazı id
	 */
	function onay_bekleyen_yayinla($id = 0) {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->load->model('yazi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_EDITOR_11);
			
		$temp_yazi_durum = $this->yazi->get_durum_where_id();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi_durum != Yazi::DURUM_EDITOR_KONTROL_EDECEK)
			redirect(SAYFA_EDITOR_11);
			
		$this->yazi->durum = Yazi::DURUM_ONAYLI;
		
		$this->yazi->guncelle_durum_where_id();
		
		$this->load->model('kullanici', 'yazar');
		$this->yazar->id = (int) $this->yazi->get_yazar_id_where_id();
		
		$data['yazar'] = $this->yazar->get_detay_where_id();
		$data['url1'] = sprintf(SAYFA_MISAFIR_23, $this->yazi->id);
		
		// yazısı onaylanan yazara mail ile bilgi ver.
		// basla mail
		$this->load->library('email');
		
		$this->email->to($data['yazar']->mail, $data['yazar']->adi);
		$this->email->subject('Yazınız Onaylandı');
		$this->email->message($this->smarty->view('editor/yazi_yonetimi/mailler/yazi_onaylandi.tpl', $data, true));
		
		$this->email->send();
		
		// echo $this->email->print_debugger();
		// bitti mail
		
		$this->session->set_flashdata('tamam', 'Yazı onaylandı ve yazar bilgilendirildi.');
		
		redirect(SAYFA_EDITOR_11);
	}
	
	/*
	 * Editör isterse bir yazıyı adminlerin incelemesini isteyebilir
	 */
	function onay_bekleyeni_admin_kontrol_etsin($id = 0) {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->load->model('yazi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_EDITOR_11);
			
		$temp_yazi_durum = $this->yazi->get_durum_where_id();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi_durum != Yazi::DURUM_EDITOR_KONTROL_EDECEK)
			redirect(SAYFA_EDITOR_11);
			
		$this->yazi->durum = Yazi::DURUM_ADMIN_KONTROL_EDECEK;
		
		$this->yazi->guncelle_durum_where_id();

		// adminlere mail gönder
		$data['url1'] = SAYFA_ADMIN_0;
		
		$this->load->library('email');
		$adminler = $this->kullanici->get_liste_1();
		foreach ($adminler->result() as $admin) {
		
			$data['admin'] = $admin;
			
			// basla mail
			$this->email->to($admin->mail, $admin->adi);
			$this->email->subject('Editör Yazıyı Kontrol Etmenizi İstedi');
			$this->email->message($this->smarty->view('editor/yazi_yonetimi/mailler/admin_kontrol_etsin.tpl', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
		}
		
		$this->session->set_flashdata('tamam', 'Yazıyı adminler inceleyecek, gerekli bilgi gönderildi.');
		
		redirect(SAYFA_EDITOR_11);
	}
	
	/*
	 * editör isterse yazıyı yazan kişinin yazı üzerinde değişiklik yapmasını isteyebilir 
	 */
	function onay_bekleyeni_yazar_kontrol_etsin($id = 0) {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->load->model('yazi');
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde mevcut olmalı
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_EDITOR_11);
			
		$temp_yazi_durum = $this->yazi->get_durum_where_id();
		
		// yazının durumu editör kontrol edecek olmalı
		if ($temp_yazi_durum != Yazi::DURUM_EDITOR_KONTROL_EDECEK)
			redirect(SAYFA_EDITOR_11);
			
		$this->yazi->durum = Yazi::DURUM_YAZAR_KONTROL_EDECEK;
		
		$this->yazi->guncelle_durum_where_id();
		
		$this->load->model('kullanici', 'yazar');
		$this->yazar->id = (int) $this->yazi->get_yazar_id_where_id();
		
		$data['yazar'] = $this->yazar->get_detay_where_id();
		$data['url1'] = SAYFA_YAZAR_0;
		
		// yazıyı incelemesi gerektiğini yazara mail ile bildir
		// basla mail
		$this->load->library('email');
		
		$this->email->to($data['yazar']->mail, $data['yazar']->adi);
		$this->email->subject('Yazınızı Yeniden Gözden Geçiriniz');
		$this->email->message($this->smarty->view('editor/yazi_yonetimi/mailler/yazar_kontrol_etsin.tpl', $data, true));
		
		$this->email->send();
		
		// echo $this->email->print_debugger();
		// bitti mail
		
		$this->session->set_flashdata('tamam', 'Yazara durum hakkında bilgi gönderildi.');
		
		redirect(SAYFA_EDITOR_11);
	}
}