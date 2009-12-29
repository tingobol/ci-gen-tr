<?php

class Yazi_yonetimi extends MY_YazarKontroller {
	
	function Yazi_yonetimi() {
	
		parent::MY_YazarKontroller();
		
		$this->load->model('yazi');
	}
	
	function index() {
	
		redirect(sayfa_yazar_11);
	}
	
	function liste() {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Listesi';
		
		$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
		
		$data['yazilar'] = $this->yazi->get_liste_1();
		
		$this->load->view(sayfa_yazar_11, $data);
	}
	
	function ekle() {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Ekle';
		
		$this->load->model('kategori');
		$data['kategori_listesi'] = $this->kategori->get_liste_1();
		
		$data['yazi'] = $this->yazi;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->rbaslik = $this->input->post('rbaslik');
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = (int) $this->input->post('kategori_id');
			
			try {
			
				if (form_is_bos($this->yazi->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');

				if (form_is_bos($this->yazi->rbaslik)) throw new Exception('Yazı rewrite başlığı boş geçilemez.');
				if ($this->yazi->is_var_where_rbaslik()) throw new Exception('Bu yazı rewrite başlığı daha önce kullanılmış.');
				
				if (form_is_bos($this->yazi->icerik)) throw new Exception('Yazı içeriği boş geçilemez.');
				
				if (form_is_bos($this->yazi->kategori_id)) throw new Exception('Yazı kategorisi boş geçilemez.');
				
				
				
				$this->kategori->id = (int) $this->yazi->kategori_id;
				
				if (!$this->kategori->is_var_where_id()) throw new Exception('Belirtilen kategori sistemde bulunmamaktadır. Lütfen listeden bir kategori seçiniz.');
				
				// yazarın id'si alınıyor
				$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
				
				$this->yazi->ekle_1();
				
				$data['tamam'] = 'Yazı eklenmiştir, editörlerimiz incelendikten sonra yayınlanacaktır.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$this->load->view(sayfa_yazar_12, $data);	
	}
	
	function duzenle($id = 0) {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Düzenle';
		
		$this->load->model('kategori');
		$data['kategori_listesi'] = $this->kategori->get_liste_1();
		
		$data['yazi'] = $this->yazi;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazi->id = (int) $this->input->post('id');
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->rbaslik = $this->input->post('rbaslik');
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = $this->input->post('kategori_id');
		} else {
		
			$this->yazi->id = (int) $id;
		}
		
		// yazı sistemde var mı?
		if (!$this->yazi->is_var_where_id())
			redirect(sayfa_yazar_10);
			
		$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
		
		// yazı yazara mı ait gerçekten
		if (!$this->yazi->is_var_where_id_and_yazar_id())
			redirect(sayfa_yazar_10);
			
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$temp_yazi = $this->yazi->get_detay_where_id();
			
			$b1 = $this->yazi->baslik == $temp_yazi->baslik;
			$b2 = $this->yazi->rbaslik == $temp_yazi->rbaslik;
			$b3 = $this->yazi->icerik == $temp_yazi->icerik;
			$b4 = $this->yazi->kategori_id == (int) $temp_yazi->kategori_id;
			
			if ($b1 && $b2 && $b3 && $b4) {
			
				// değişiklik olmamış
				$this->yazi->durum = $temp_yazi->durum;
			} else {
			
				// değişiklik olmuştur yazı beklemeye alınacak
				if ($temp_yazi->durum == 1)
					$this->yazi->durum = 0; 
				else 
					$this->yazi->durum = $temp_yazi->durum;
			}
		
			try {
			
				if (form_is_bos($this->yazi->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');

				if (form_is_bos($this->yazi->rbaslik)) throw new Exception('Yazı rewrite başlığı boş geçilemez.');
				if ($this->yazi->is_var_where_rbaslik_and_not_id()) throw new Exception('Bu yazı rewrite başlığı daha önce kullanılmış.');
				
				if (form_is_bos($this->yazi->icerik)) throw new Exception('Yazı içeriği boş geçilemez.');
				if (form_is_bos($this->yazi->kategori_id)) throw new Exception('Yazı kategorisi boş geçilemez.');
				
				$this->kategori->id = (int) $this->yazi->kategori_id;
				
				// kategori sistemde var mı?
				if (!$this->kategori->is_var_where_id()) throw new Exception('Belirtilen kategori sistemde bulunmamaktadır. Lütfen listeden bir kategori seçiniz.');
				
				$this->yazi->guncelle_1();
				
				$data['tamam'] = 'Değişiklikler kaydedildi.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			$data['yazi'] = $this->yazi->get_detay_where_id();	
		}
	
		$this->load->view(sayfa_yazar_13, $data);
	}
	
	function sil($id = 0) {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde var mı?
		if (!$this->yazi->is_var_where_id())
			redirect(sayfa_yazar_10);
			
		// @TODO yazıya ait ilişkiler temizlenecek
		
		$this->yazi->sil_where_id();
		
		redirect(sayfa_yazar_10);
	}
}