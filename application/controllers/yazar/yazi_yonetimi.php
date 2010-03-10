<?php

class Yazi_yonetimi extends MY_YazarKontroller {
	
	function Yazi_yonetimi() {
	
		parent::MY_YazarKontroller();
		
		$this->load->model('yazi');
	}
	
	function index() {
	
		redirect(SAYFA_YAZAR_11);
	}
	
	function liste() {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$data['meta_baslik'] = 'Yazı Listesi';
		
		$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
		
		$data['yazilar'] = $this->yazi->get_liste_1();
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$this->smarty->assign('tamam', $this->session->flashdata('tamam'));
		
		$this->smarty->view('yazar/yazi_yonetimi/liste.tpl', $data);
	}
	
	function ekle() {
	
		// sayfayı sadece yazar görebilecek
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		// modelleri yüklenmesi
		$this->load->model('kategori');
		
		// kütüphanelerin yüklenmesi
		$this->load->library('etiket_lib');
		
		// yazı ekleme formu submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet yazı ekleme formu submit edilmiş
			
			// post bilgilerini yazı objemize alalım
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->ozet = html_filtrele_1($this->input->post('ozet'));
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = (int) $this->input->post('kategori_id');
			
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
			
			$this->smarty->assign('kategori_selected_id', $this->yazi->kategori_id);
			
			// post bilgilerini kontrole başlayalım
			try {
			
				// doldurulması zorunlu alanların kontrolü
				if (form_is_bos($this->yazi->kategori_id)) throw new Exception('Lütfen yazınız için bir kategori seçiniz.');

				// yazı eklenirken seçilen kategorinin sistemde 
				// olup olmadığına bakılıyor
				$this->kategori->id = (int) $this->yazi->kategori_id;				
				if (!$this->kategori->is_var_where_id()) throw new Exception('Belirtilen kategori sistemde bulunmamaktadır. Lütfen listeden bir kategori seçiniz.');
				
				// doldurulması zorunlu alanların kontrolü
				if (form_is_bos($this->yazi->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');
				if (form_is_bos($this->yazi->ozet)) throw new Exception('Yazı özeti boş geçilemez.');
				
				// yazarın id'si alınıyor
				$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
				
				// yazı veritabanına eklenip, eklenen yazının 
				// id numarası Etiket kütüphanesine verilerek 
				// yazıya ait etiketler oluşturuluyor
				$this->etiket_lib->yazi_eklendi($this->yazi->ekle_1());
				
				$data['tamam'] = 'Yazı eklenmiştir, editörlerimiz incelendikten sonra yayınlanacaktır.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır yazı ekleme formu submit edilmemiş
			
			$this->smarty->assign('kategori_selected_id', 0);
		}
		
		// sayfa sisteme giriş yapmış yazar için
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Ekle';
		
		$data['yazi'] = $this->yazi;
		
		$data['etiketler'] = $this->etiket_lib->etiketler_string;
		
		// drop down kategori seçmek için
		$kategoriler = $this->kategori->get_liste_1();
		$this->smarty->assign('kategori_ids', $kategoriler['values']);
		$this->smarty->assign('kategori_names', $kategoriler['output']); 
		
		$this->smarty->view('yazar/yazi_yonetimi/ekle.tpl', $data);	
	}
	
	function duzenle($id = 0) {
		
		// sayfayı sadece yazar görebilecek
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		// modelleri yüklenmesi
		$this->load->model('kategori');
		
		// kütüphanelerin yüklenmesi
		$this->load->library('etiket_lib');
		
		// yazı düzenleme formu submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			// evet yazı düzenleme formu submit edilmiş
			
			// post bilgilerini yazı objemize alalım
			$this->yazi->id = (int) $this->input->post('id');
			$this->yazi->baslik = $this->input->post('baslik');
			$this->yazi->ozet = html_filtrele_1($this->input->post('ozet'));
			$this->yazi->icerik = html_filtrele_1($this->input->post('icerik'));
			$this->yazi->kategori_id = $this->input->post('kategori_id');
			
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
		} else {
		
			// hayır yazı düzenleme formu submit edilmemiş
			$this->yazi->id = (int) $id;
		}
		
		// yazı sistemde var mı?
		if (!$this->yazi->is_var_where_id())
			redirect(sayfa_yazar_10);
			
		// yazının yazar id numarası et edilmekte
		$this->yazi->yazar_id = (int) $this->kullanici_lib->kullanici_id;
		
		// yazı yazara mı ait gerçekten
		if (!$this->yazi->is_var_where_id_and_yazar_id())
			redirect(sayfa_yazar_10);
			
		// yazı düzenleme formu submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			// evet yazı düzenleme formu submit edilmiş
			
			$this->smarty->assign('kategori_selected_id', $this->yazi->kategori_id);
			
			// öncelikle yazıda her hangi bir değişiklik
			// yapılıp yapılmadığını kontrol edeceğiz.
			// eğer yazıda bir değişiklik yapıldıysa, 
			// yazı beklemeye alınacak ve editörlerin 
			// kontrolünden geçtikten sonra tekrar 
			// yayınlanacaktır.
			
			// ilk iş olarak veritabanından yazıya ait mevcut bilgileri alıyoruz
			$temp_yazi = $this->yazi->get_detay_where_id();
			
			// yazıya ait bilgiler de değişiklik olmuş mu?
			$b1 = $this->yazi->baslik == $temp_yazi->baslik;
			$b3 = $this->yazi->ozet == $temp_yazi->ozet;
			$b4 = $this->yazi->icerik == $temp_yazi->icerik;
			$b5 = $this->yazi->kategori_id == (int) $temp_yazi->kategori_id;

			// etiketlerde bir değişiklik yapılmış mı?
			$b6 = $this->etiket_lib->is_etiketler_degisti($this->yazi->id);
			
			// yazı bilgilerinde değişiklik yapılmış mı?
			if ($b1 && $b3 && $b4 && $b5 && !$b6) {
			
				// evet yazı bilgilerinde değişiklik yapılmış
				$this->yazi->durum = $temp_yazi->durum;
			} else {
			
				// hayır yazı bilgilerinde değişiklik yapılmamış
				
				// eğer yazının durumu onaylı ise
				if ($temp_yazi->durum == Yazi::DURUM_ONAYLI) {
					
					$this->yazi->durum = Yazi::DURUM_ONAY_BEKLIYOR;
				} else { 
					
					$this->yazi->durum = $temp_yazi->durum;
				}
			}
		
			try {
			
				if (form_is_bos($this->yazi->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');
				if (form_is_bos($this->yazi->ozet)) throw new Exception('Yazı özeti boş geçilemez.');
				if (form_is_bos($this->yazi->kategori_id)) throw new Exception('Yazı kategorisi boş geçilemez.');
				
				$this->kategori->id = (int) $this->yazi->kategori_id;
				
				// kategori sistemde var mı?
				if (!$this->kategori->is_var_where_id()) throw new Exception('Belirtilen kategori sistemde bulunmamaktadır. Lütfen listeden bir kategori seçiniz.');
				
				$this->yazi->guncelle_1();
				
				$this->etiket_lib->yazi_duzenlendi($this->yazi->id);
				
				$this->session->set_flashdata('tamam', 'Değişiklikler kaydedildi.');
		
				// yazı listesine yönlendir
				redirect(SAYFA_YAZAR_11);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
			
			$data['yazi'] = $this->yazi;
			
			$data['etiketler'] = $this->etiket_lib->etiketler_string;
		} else {
			
			// hayır yazı düzenleme formu submit edilmemiş
			
			// veritabanından yazı bilgisini alıyoruz
			$data['yazi'] = $this->yazi->get_detay_where_id();

			// yazının etiketlerini veritabanından almak için 
			// bazı işlemler yapılmaktadır. ilişki tablosundan
			// yazının etiketleri çekilmekte ve input içerisine 
			// yazılacak şekilde ayarlanmaktadır.
			
			// yazı etikiketi için yazı id numarasını set ediyoruz
			$this->yazi_etiketi->yazi_id = $this->yazi->id;
			
			// yazıya ait etiketler veritabanından çekiliyor
			$yazi_etiketleri = $this->yazi_etiketi->get_liste_2();
			
			// yaziya ait etiketler bir diziye aktarılacak
			$yazi_etiketleri_array = array();
			
			// veritabanından çekilmiş kayıtlar üzerinde dönülerek
			// etiketler bir diziye aktarılmaktadır
			foreach ($yazi_etiketleri->result() as $yazi_etiketi) 
				$yazi_etiketleri_array[] = $yazi_etiketi->adi;
				
			// etiket dizini bir input için implode ediyoruz
			$data['etiketler'] = implode(', ', $yazi_etiketleri_array);
			
			$this->smarty->assign('kategori_selected_id', $data['yazi']->kategori_id);
		}
		
		$data['k_t'] = k_t_giris_yapmis_yazar;
		
		$data['meta_baslik'] = 'Yazı Düzenle';
		
		// drop down kategori seçmek için
		$kategoriler = $this->kategori->get_liste_1();
		$this->smarty->assign('kategori_ids', $kategoriler['values']);
		$this->smarty->assign('kategori_names', $kategoriler['output']); 
	
		$this->smarty->view('yazar/yazi_yonetimi/duzenle.tpl', $data);
	}
	
	function sil($id = 0) {
	
		$this->kullanici_lib->sadece_yazar_gorebilir();
		
		$this->yazi->id = (int) $id;
		
		// yazı sistemde var mı?
		if (!$this->yazi->is_var_where_id())
			redirect(SAYFA_YAZAR_11);
			
		// @TODO yazıya ait ilişkiler temizlenecek
		
		// yazıya ait ilişkili etiketleri sil
		$this->load->model('yazi_etiketi');
		$this->yazi_etiketi->yazi_id = $id;
		$this->yazi_etiketi->sil_where_yazi_id();
		
		$this->yazi->sil_where_id();
		
		$this->session->set_flashdata('tamam', 'Yazı ve yazıya ait bilgiler silindi.');
		
		redirect(SAYFA_YAZAR_11);
	}
}