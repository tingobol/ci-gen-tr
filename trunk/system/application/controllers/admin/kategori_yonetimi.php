<?php

class Kategori_yonetimi extends MY_AdminKontroller {
	
	function Kategori_yonetimi() {
	
		parent::MY_AdminKontroller();
		
		$this->load->model('kategori');
	}
	
	function index() {
	
		redirect('admin/kategori/liste');
	}
	
	function liste() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kategori Listesi';
		
		$data['kategoriler'] = $this->kategori->get_liste_order_by_adi_asc();
		
		$this->load->view('admin/kategori/liste', $data);
	}
	
	function ekle() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['meta_baslik'] = 'Kategori Ekle';
		
		$data['kategori'] = $this->kategori;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori->adi = $this->input->post('adi');
			$this->kategori->radi = $this->input->post('radi');
			$this->kategori->aciklama = $this->input->post('aciklama');
			$this->kategori->arama = $this->input->post('arama');
			
			try {
			
				if (form_is_bos($this->kategori->adi)) throw new Exception('Kategori adı boş geçilemez.');
				if ($this->kategori->is_var_where_adi()) throw new Exception('Bu kategori daha önce eklenmiş.');
				
				if (form_is_bos($this->kategori->radi)) throw new Exception('Kategori rewrite adı boş geçilemez.');
				if ($this->kategori->is_var_where_radi()) throw new Exception('Bu kategori rewrite adı daha önce eklenmiş.');
				$this->kategori->ekle();
				
				$this->kategori->reset();
				
				$data['tamam'] = 'Yeni kategori eklenmiştir, kategori eklemeye devam edebilirsiniz.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$this->load->view('admin/kategori/ekle', $data);
	}
}