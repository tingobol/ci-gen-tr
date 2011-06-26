<?php

class Kategori_yonetimi extends MY_AdminKontroller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('kategori_mod');
	}
	
	function liste() {
		
		$this->admin_lib->sadece_admin_gorebilir();		
		
		$data['kategoriler'] = $this->kategori_mod->get_liste_3();
		
		$data['meta_baslik'] = 'Kategori Listesi';
		
		// flash dataları set et
		$data['tamam'] = $this->session->flashdata('tamam');
		$data['ikaz'] = $this->session->flashdata('ikaz');
		
		$data['icerik'] = $this->smarty->view('admin/kategori_yonetimi/liste.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
	
	function ekle() {
	
		$this->admin_lib->sadece_admin_gorebilir();	
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori_mod->adi = trim($this->input->post('adi'));
			$this->kategori_mod->meta_aciklama = trim($this->input->post('meta_aciklama'));
			$this->kategori_mod->meta_arama = trim($this->input->post('meta_arama'));
			
			try {
			
				if (empty($this->kategori_mod->adi)) throw new Exception('Kategori adı boş geçilemez.');
				if ($this->kategori_mod->is_var_where_adi()) throw new Exception('Bu kategori adı daha önce eklenmiş.');
				
				$this->kategori_mod->ekle_1();
				
				$this->session->set_flashdata('tamam', 'Yeni kategori eklenmiştir.');
				
				redirect(SAYFA_ADMIN_11);

			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['kategori_mod'] = $this->kategori_mod;
		
		$data['meta_baslik'] = 'Kategori Ekle';
		
		$data['icerik'] = $this->smarty->view('admin/kategori_yonetimi/ekle.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
	
	function duzenle($id = 0) {
	
		$this->admin_lib->sadece_admin_gorebilir();	
		
		$this->kategori_mod->id = (int) $id;
		
		// kategori sistemde var mı?
		if (!$this->kategori_mod->is_var_where_id())
			redirect(SAYFA_ADMIN_11);
			
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori_mod->adi = trim($this->input->post('adi'));
			$this->kategori_mod->meta_aciklama = trim($this->input->post('meta_aciklama'));
			$this->kategori_mod->meta_arama = trim($this->input->post('meta_arama'));
			
			try {
			
				if (empty($this->kategori_mod->adi)) throw new Exception('Kategori adı boş geçilemez.');
				if ($this->kategori_mod->is_var_where_adi_and_not_id()) throw new Exception('Bu kategori adı daha önce eklenmiş.');
				
				$this->kategori_mod->guncelle_1();
				
				$this->session->set_flashdata('tamam', 'Değişiklikler kaydedildi.');
				
				redirect(SAYFA_ADMIN_11);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			$temp_kategori = $this->kategori_mod->get_detay_where_id();
			
			$this->kategori_mod->adi = $temp_kategori->adi;
			$this->kategori_mod->meta_aciklama = $temp_kategori->meta_aciklama;
			$this->kategori_mod->meta_arama = $temp_kategori->meta_arama;
		}
		
		$data['kategori_mod'] = $this->kategori_mod;
		
		$data['meta_baslik'] = 'Kategori Düzenle';
		
		$data['icerik'] = $this->smarty->view('admin/kategori_yonetimi/duzenle.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
	
	function sil($id = 0) {
	
		$this->admin_lib->sadece_admin_gorebilir();	
		
		$this->kategori_mod->id = (int) $id;
		
		// kategori sistemde var mı?
		if (!$this->kategori_mod->is_var_where_id())
			redirect(SAYFA_ADMIN_11);
			
		// kategori içerisinde yazı var mı? var sa kategori silinememeli
		$this->load->model('yazi_mod');
		$this->yazi_mod->kategori_id = $this->kategori_mod->id;
		if ($this->yazi_mod->is_var_where_kategori_id()) {
		
			$this->session->set_flashdata('ikaz', 'İçerisinde yazı bulunan kategori silinemez.');
			redirect(SAYFA_ADMIN_11);
		}
			
		// @TODO kategoriye ait ilişkiler temizlenecek
		
		$this->kategori_mod->sil_where_id();
		
		$this->session->set_flashdata('tamam', 'Kategori silinmiştir.');
		
		redirect(SAYFA_ADMIN_11);
	}
}