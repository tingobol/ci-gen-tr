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
		
		$this->load->library('etiket_lib');
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Ekle';
		
		$this->load->model('kategori');
		$data['kategori_listesi'] = $this->kategori->get_liste_1();
		
		$data['yazi'] = $this->yazi;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->ozet = html_filtrele_1($this->input->post('ozet'));
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = (int) $this->input->post('kategori_id');
			
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
			
			try {
			
				if (form_is_bos($this->yazi->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');
				if (form_is_bos($this->yazi->ozet)) throw new Exception('Yazı özeti boş geçilemez.');
				if (form_is_bos($this->yazi->kategori_id)) throw new Exception('Yazı kategorisi boş geçilemez.');

				$this->kategori->id = (int) $this->yazi->kategori_id;
				
				if (!$this->kategori->is_var_where_id()) throw new Exception('Belirtilen kategori sistemde bulunmamaktadır. Lütfen listeden bir kategori seçiniz.');
				
				// yazarın id'si alınıyor
				$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
				
				$this->etiket_lib->yazi_eklendi($this->yazi->ekle_1());
				
				$data['tamam'] = 'Yazı eklenmiştir, editörlerimiz incelendikten sonra yayınlanacaktır.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['etiketler'] = $this->etiket_lib->etiketler_string;
		
		$this->load->view(sayfa_yazar_12, $data);	
	}
	
	function duzenle($id = 0) {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$this->load->library('etiket_lib');
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Düzenle';
		
		$this->load->model('kategori');
		$data['kategori_listesi'] = $this->kategori->get_liste_1();
		
		$data['yazi'] = $this->yazi;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazi->id = (int) $this->input->post('id');
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->ozet = html_filtrele_1($this->input->post('ozet'));
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = $this->input->post('kategori_id');
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
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
			$b3 = $this->yazi->ozet == $temp_yazi->ozet;
			$b4 = $this->yazi->icerik == $temp_yazi->icerik;
			$b5 = $this->yazi->kategori_id == (int) $temp_yazi->kategori_id;

			// etiketlerde bir değişiklik yapılıp yapılmadığını anlamak için
			$b6 = $this->etiket_lib->is_etiketler_degisti($this->yazi->id);
			
			if ($b1 && $b2 && $b3 && $b4 && $b5) {
			
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
				if (form_is_bos($this->yazi->ozet)) throw new Exception('Yazı özeti boş geçilemez.');
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
		
		// yazıya ait ilişkili etiketleri sil
		$this->load->model('yazi_etiketi');
		$this->yazi_etiketi->yazi_id = $id;
		$this->yazi_etiketi->sil_where_yazi_id();
		
		$this->yazi->sil_where_id();
		
		redirect(sayfa_yazar_10);
	}
}