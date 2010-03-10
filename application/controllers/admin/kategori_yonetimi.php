<?php

class Kategori_yonetimi extends MY_AdminKontroller {
	
	function Kategori_yonetimi() {
	
		parent::MY_AdminKontroller();
		
		$this->load->model('kategori');
	}
	
	function index() {
	
		redirect(SAYFA_ADMIN_11);
	}
	
	function liste() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kategori Listesi';
		
		$data['kategoriler'] = $this->kategori->get_liste_3();
		
		$data['tamam'] = $this->session->flashdata('tamam');
		$data['ikaz'] = $this->session->flashdata('ikaz');
		
		$this->smarty->view('admin/kategori_yonetimi/liste.tpl', $data);
	}
	
	function ekle() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['kategori'] = $this->kategori;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori->adi = $this->input->post('adi');
			$this->kategori->radi = $this->input->post('radi');
			$this->kategori->aciklama = $this->input->post('aciklama');
			$this->kategori->arama = $this->input->post('arama');
			
			try {
			
				if (form_is_bos($this->kategori->adi)) throw new Exception('Kategori adı boş geçilemez.');
				if ($this->kategori->is_var_where_adi()) throw new Exception('Bu kategori adı daha önce eklenmiş.');
				
				if (form_is_bos($this->kategori->radi)) throw new Exception('Kategori rewrite adı boş geçilemez.');
				if ($this->kategori->is_var_where_radi()) throw new Exception('Bu kategori rewrite adı daha önce eklenmiş.');
				
				$this->kategori->ekle_1();
				
				$this->session->set_flashdata('tamam', 'Yeni kategori eklenmiştir.');
				
				redirect(SAYFA_ADMIN_11);

			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kategori Ekle';
		
		$this->smarty->view('admin/kategori_yonetimi/ekle.tpl', $data);	
	}
	
	function duzenle($id = 0) {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['kategori'] = $this->kategori;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori->id = (int) $this->input->post('id');
			$this->kategori->adi = $this->input->post('adi');
			$this->kategori->radi = $this->input->post('radi');
			$this->kategori->aciklama = $this->input->post('aciklama');
			$this->kategori->arama = $this->input->post('arama');
		} else {
		
			$this->kategori->id = (int) $id;
		}
		
		// kategori sistemde var mı?
		if (!$this->kategori->is_var_where_id())
			redirect(SAYFA_ADMIN_11);
			
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			try {
			
				if (form_is_bos($this->kategori->adi)) throw new Exception('Kategori adı boş geçilemez.');
				if ($this->kategori->is_var_where_adi_and_not_id()) throw new Exception('Bu kategori adı daha önce eklenmiş.');
				
				if (form_is_bos($this->kategori->radi)) throw new Exception('Kategori rewrite adı boş geçilemez.');
				if ($this->kategori->is_var_where_radi_and_not_id()) throw new Exception('Bu kategori rewrite adı daha önce eklenmiş.');
				
				$this->kategori->guncelle_1();
				
				$this->session->set_flashdata('tamam', 'Değişiklikler kaydedildi.');
				
				redirect(SAYFA_ADMIN_11);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			$data['kategori'] = $this->kategori->get_detay_where_id();	
		}
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kategori Düzenle';
	
		$this->smarty->view('admin/kategori_yonetimi/duzenle.tpl', $data);
	}
	
	function sil($id = 0) {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$this->kategori->id = (int) $id;
		
		// kategori sistemde var mı?
		if (!$this->kategori->is_var_where_id())
			redirect(SAYFA_ADMIN_11);
			
		// kategori içerisinde yazı var mı? var sa kategori silinememeli
		$this->load->model('yazi');
		$this->yazi->kategori_id = $this->kategori->id;
		if ($this->yazi->is_var_where_kategori_id()) {
		
			$this->session->set_flashdata('ikaz', 'İçerisinde yazı bulunan kategori silinemez.');
			redirect(SAYFA_ADMIN_11);
		}
			
		// @TODO kategoriye ait ilişkiler temizlenecek
		
		$this->kategori->sil_where_id();
		
		$this->session->set_flashdata('tamam', 'Kategori silinmiştir.');
		
		redirect(SAYFA_ADMIN_11);
	}
}