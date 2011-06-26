<?php

class Yazi_yonetimi extends MY_YazarKontroller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('yazi_mod');
	}
	
	function liste() {
	
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		// flash datalar set ediliyor
		$this->smarty->assign('tamam', $this->session->flashdata('tamam'));
		
		// yazarın yazıları listeye alınıyor
		$this->yazi_mod->yazar_id = $this->yazar_lib->get_yazar_id();
		$data['yazilar'] = $this->yazi_mod->get_liste_1();
		
		// meta ayarları
		$data['meta_baslik'] = 'Yazı Listesi';
		
		$data['yazi_mod'] = $this->yazi_mod;
		
		$data['icerik'] = $this->smarty->view('yazar/yazi_yonetimi/liste.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout2.tpl', $data );
	}
	
	function ekle() {
	
		// sayfayı sadece yazar görebilecek
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		// kütüphanelerin yüklenmesi
		$this->load->library('etiket_lib');
		
		// modellerin yüklenmesi
		$this->load->model('kategori_mod');
		$this->load->model('yazi_mod');
		
		// yazı ekleme formu submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet yazı ekleme formu submit edilmiş
			
			// post bilgilerini yazı objemize alalım
			$this->yazi_mod->kategori_id = (int) $this->input->post('kategori_id');
			$this->yazi_mod->baslik = trim($this->input->post('baslik'));
			$this->yazi_mod->ozet = trim($this->input->post('ozet', FALSE));
			$this->yazi_mod->icerik = trim($this->input->post('icerik', FALSE));
			
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
			
			// post bilgilerini kontrole başlayalım
			try {
			
				// doldurulması zorunlu alanların kontrolü
				if (empty($this->yazi_mod->kategori_id)) throw new Exception('Lütfen yazınız için bir kategori seçiniz.');

				// yazı eklenirken seçilen kategorinin sistemde 
				// olup olmadığına bakılıyor
				$this->kategori_mod->id = (int) $this->yazi_mod->kategori_id;				
				if (!$this->kategori_mod->is_var_where_id()) throw new Exception('Lütfen listeden bir kategori seçiniz.');

				// doldurulması zorunlu alanların kontrolü
				if (empty($this->yazi_mod->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');

				if (empty($this->yazi_mod->ozet)) throw new Exception('Yazı özeti boş geçilemez.');

				// yazarın id'si alınıyor
				$this->yazi_mod->yazar_id = $this->yazar_lib->get_yazar_id();

				// yazı veritabanına eklenip, eklenen yazının 
				// id numarası Etiket kütüphanesine verilerek 
				// yazıya ait etiketler oluşturuluyor
				$this->etiket_lib->yazi_eklendi($this->yazi_mod->ekle_1());

				$data['tamam'] = 'Yazı eklenmiştir, editörlerimiz inceledikten sonra yayınlanacaktır.';
			} catch (Exception $ex) {

				$data['hata'] = $ex->getMessage();
			}
		} else {

			// hayır yazı ekleme formu submit edilmemiş
			
			$this->yazi_mod->kategori_id = 0;
		}
		
		// html kategori select
		$this->load->library('kategori_lib');
		$data['html_select_kategoriler'] = $this->kategori_lib->get_html_select1($this->yazi_mod->kategori_id);
		
		$data['yazi_mod'] = $this->yazi_mod;
		
		$data['etiketler'] = $this->etiket_lib->etiketler_string;
		
		// drop down kategori seçmek için
		//$kategoriler = $this->kategori->get_liste_1();
		//$this->smarty->assign('kategori_ids', $kategoriler['values']);
		//$this->smarty->assign('kategori_names', $kategoriler['output']); 
		
		//$data['meta_baslik'] = 'Yazı Ekle';
		
		$data['icerik'] = $this->smarty->view('yazar/yazi_yonetimi/ekle.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout2.tpl', $data );
	}
	
	function duzenle($id = 0) {
		
		// sayfayı sadece yazar görebilecek
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		// kütüphanelerin yüklenmesi
		$this->load->library('etiket_lib');
		
		// modellerin yüklenmesi
		$this->load->model('kategori_mod');
		$this->load->model('yazi_mod');
		
		$this->yazi_mod->id = (int) $id;
		
		// yazı sistemde var mı?
		if (!$this->yazi_mod->is_var_where_id())
			redirect(SAYFA_YAZAR_11);
		
		// yazı yazara mı ait gerçekten
		$this->yazi_mod->yazar_id = $this->yazar_lib->get_yazar_id();
		if (!$this->yazi_mod->is_var_where_id_and_yazar_id())
			redirect(SAYFA_YAZAR_11);
			
		// yazı düzenleme formu submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			// evet yazı düzenleme formu submit edilmiş
			
			// post bilgilerini yazı objemize alalım
			$this->yazi_mod->baslik = $this->input->post('baslik');
			$this->yazi_mod->ozet = $this->input->post('ozet', FALSE);
			$this->yazi_mod->icerik = $this->input->post('icerik', FALSE);
			$this->yazi_mod->kategori_id = (int) $this->input->post('kategori_id');
			
			$this->etiket_lib->etiketler_string = $this->input->post('etiketler');
			
			// öncelikle yazıda her hangi bir değişiklik
			// yapılıp yapılmadığını kontrol edeceğiz.
			// eğer yazıda bir değişiklik yapıldıysa, 
			// yazı beklemeye alınacak ve editörlerin 
			// kontrolünden geçtikten sonra tekrar 
			// yayınlanacaktır.
			
			// ilk iş olarak veritabanından yazıya ait mevcut bilgileri alıyoruz
			$temp_yazi = $this->yazi_mod->get_detay_where_id();
			
			// yazıya ait bilgiler de değişiklik olmuş mu?
			$b1 = $this->yazi_mod->baslik == $temp_yazi->baslik;
			$b3 = $this->yazi_mod->ozet == $temp_yazi->ozet;
			$b4 = $this->yazi_mod->icerik == $temp_yazi->icerik;
			$b5 = $this->yazi_mod->kategori_id == (int) $temp_yazi->kategori_id;

			// etiketlerde bir değişikyazi_modlik yapılmış mı?
			$b6 = $this->etiket_lib->is_etiketler_degisti($this->yazi_mod->id);
			
			// yazı bilgilerinde değişiklik yapılmış mı?
			if ($b1 && $b3 && $b4 && $b5 && !$b6) {
			
				// hayır yazı bilgilerinde değişiklik yapılmamış
				// aynı durumda kalacak
				$this->yazi_mod->durum = $temp_yazi->durum;
			} else {
			
				// evet yazı bilgilerinde değişiklik yapılmış
				
				// eğer yazının durumu onaylı ise veya yazar kontrol edecek ise
				if ($temp_yazi->durum == Yazi_mod::DURUM_ONAYLI || $temp_yazi->durum == Yazi_mod::DURUM_YAZAR_KONTROL_EDECEK) {
					
					// editör kontrol edecek
					$this->yazi_mod->durum = Yazi_mod::DURUM_EDITOR_KONTROL_EDECEK;
				} else { 
					
					// aynı durumda kalacak
					$this->yazi_mod->durum = $temp_yazi->durum;
				}
			}
		
			try {
			
				if (empty($this->yazi_mod->kategori_id)) throw new Exception('Yazı kategorisi boş geçilemez.');
				if (empty($this->yazi_mod->baslik)) throw new Exception('Yazı başlığı boş geçilemez.');
				if (empty($this->yazi_mod->ozet)) throw new Exception('Yazı özeti boş geçilemez.');
				
				$this->kategori_mod->id = $this->yazi_mod->kategori_id;
				
				// kategori sistemde var mı?
				if (!$this->kategori_mod->is_var_where_id()) throw new Exception('Lütfen listeden bir kategori seçiniz.');
				
				// güncelleme işlemi yapılabilir
				$this->yazi_mod->guncelle_1();
				
				// yazıya ait etiketleri de güncelliyoruz
				$this->etiket_lib->yazi_duzenlendi($this->yazi_mod->id);
				
				// duruma göre bilgilendirme yazısı ayarlanıyor
				if ($this->yazi_mod->durum == Yazi_mod::DURUM_EDITOR_KONTROL_EDECEK) 
					$this->session->set_flashdata('tamam', 'Değişiklikler kaydedildi. Yazınız editörler inceledikten sonra yayınlanacaktır.');
				else 
					$this->session->set_flashdata('tamam', 'Değişiklikler kaydedildi.');
				
				// yazı listesine yönlendir
				redirect(SAYFA_YAZAR_11);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
			
			
			
			$data['etiketler'] = $this->etiket_lib->etiketler_string;
		} else {
			
			// hayır yazı düzenleme formu submit edilmemiş
			
			// veritabanından yazı bilgisini alıyoruz
			$temp_yazi = $this->yazi_mod->get_detay_where_id();
			
			$this->yazi_mod->baslik = $temp_yazi->baslik;
			$this->yazi_mod->ozet = $temp_yazi->ozet;
			$this->yazi_mod->icerik = $temp_yazi->icerik;
			$this->yazi_mod->kategori_id = (int) $temp_yazi->kategori_id;

			// yazının etiketlerini veritabanından almak için 
			// bazı işlemler yapılmaktadır. ilişki tablosundan
			// yazının etiketleri çekilmekte ve input içerisine 
			// yazılacak şekilde ayarlanmaktadır.
			
			// yazı etikiketi için yazı id numarasını set ediyoruz
			$this->yazi_etiketi_mod->yazi_id = $this->yazi_mod->id;
			
			// yazıya ait etiketler veritabanından çekiliyor
			$yazi_etiketleri = $this->yazi_etiketi_mod->get_liste_2();
			
			// yaziya ait etiketler bir diziye aktarılacak
			$yazi_etiketleri_array = array();
			
			// veritabanından çekilmiş kayıtlar üzerinde dönülerek
			// etiketler bir diziye aktarılmaktadır
			foreach ($yazi_etiketleri->result() as $yazi_etiketi) 
				$yazi_etiketleri_array[] = $yazi_etiketi->adi;
				
			// etiket dizini bir input için implode ediyoruz
			$data['etiketler'] = implode(', ', $yazi_etiketleri_array);
		}
		
		// html kategori select
		$this->load->library('kategori_lib');
		$data['html_select_kategoriler'] = $this->kategori_lib->get_html_select1($this->yazi_mod->kategori_id);
		
		$data['yazi_mod'] = $this->yazi_mod;
		
		$data['meta_baslik'] = 'Yazı Düzenle';
		
		$data['icerik'] = $this->smarty->view('yazar/yazi_yonetimi/duzenle.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout2.tpl', $data );
	}
	
	function sil($id = 0) {
	
		// sayfayı sadece yazar görebilecek
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		$this->yazi_mod->id = (int) $id;
		
		// yazı sistemde var mı?
		if (!$this->yazi_mod->is_var_where_id())
			redirect(SAYFA_YAZAR_11);
			
		// yazı kendisine mi ait?
		$this->yazi_mod->yazar_id = $this->yazar_lib->get_yazar_id();
		if (!$this->yazi_mod->is_var_where_id_and_yazar_id())
			redirect(SAYFA_YAZAR_11);
			
		// @TODO yazıya ait ilişkiler temizlenecek
		
		// yazıya ait ilişkili etiketleri sil
		$this->load->model('yazi_etiketi_mod');
		$this->yazi_etiketi_mod->yazi_id = $id;
		$this->yazi_etiketi_mod->sil_where_yazi_id();
		
		$this->yazi_mod->sil_where_id();
		
		$this->session->set_flashdata('tamam', 'Yazı ve yazıya ait bilgiler silindi.');
		
		redirect(SAYFA_YAZAR_11);
	}
}