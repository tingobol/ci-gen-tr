<?php

class Yazilar extends MY_AdminController {

	function Yazilar() {
	
		parent::MY_AdminController();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->model('vt/yazi');
	}
	
	function ekle() {
	
		$this->admin_lib->is_giris_yapmis_olmali();
		
		$this->load->model('vt/kategori');
		
		$data['yazi'] = $this->yazi;
		
		$temp_view = 'admin/yazilar/ekle';
		
		if ($this->input->post('yazi_ekle')) {
			
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->icerik = $this->input->post('icerik');
			$this->yazi->kategori_id = $this->input->post('kategori_id');
			
			try {
			
				if ( ! CI_Form_validation::required($this->yazi->baslik)) throw new Exception('Başlık alanı boş geçilemez.');
				if ( ! CI_Form_validation::required($this->yazi->icerik)) throw new Exception('İçerik alanı boş geçilemez.');
				if ( ! CI_Form_validation::required($this->yazi->kategori_id)) throw new Exception('Kategori alanı boş geçilemez.');
				
				throw new Exception('Yazı veritabanına eklenecek');
				// @todo Yazı veritabanına eklenecek
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['kategoriler'] = $this->kategori->get_liste_as_select();
		
		$this->template->write_view('icerik', $temp_view, $data);
		
		$this->template->render();
	}
}