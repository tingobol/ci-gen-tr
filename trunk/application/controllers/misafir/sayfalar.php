<?php

class Sayfalar extends MY_MisafirKontroller {

	function Sayfalar() {
	
		parent::MY_MisafirKontroller();
	}
	
	function iletisim() {
	
		// modelleri yükle
		$this->load->model('kategori');
		$this->load->model('iletisim_konusu');
		$this->load->model('iletisim_mesaji');
		
		$data['iletisim_mesaji'] = $this->iletisim_mesaji;
		
		// mesaj göndermek için form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet mesaj gönderme formu submit edilmiş
			
			// formdan gelen bilgileri alalım
			$this->iletisim_mesaji->adi = $this->input->post('adi');
			$this->iletisim_mesaji->mail = $this->input->post('mail');
			$this->iletisim_mesaji->mesaj = html_filtrele_1($this->input->post('mesaj'));
			$this->iletisim_mesaji->iletisim_konu_id = (int) $this->input->post('iletisim_konu_id');
			
			// post bilgilerini kontrole başlayalım
			try {
			
				// doldurulması zorunlu alanların kontrolü
				if (form_is_bos($this->iletisim_mesaji->iletisim_konu_id)) throw new Exception('Lütfen mesajınız için bir konu seçiniz.');
				if (form_is_bos($this->iletisim_mesaji->adi)) throw new Exception('Lütfen adınızı yazınız.');
				if (form_is_bos($this->iletisim_mesaji->mail)) throw new Exception('Lütfen mail adresinizi yazınız.');
				if (!form_is_mail($this->iletisim_mesaji->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if (form_is_bos($this->iletisim_mesaji->mesaj)) throw new Exception('Lütfen mesajınızı yazınız.');
				
				// mesaj gönderilirken seçilen konunun sistemde 
				// olup olmadığına bakılıyor
				$this->iletisim_konusu->id = (int) $this->iletisim_mesaji->iletisim_konu_id;				
				if (!$this->iletisim_konusu->is_var_where_id()) throw new Exception('Belirtilen konu sistemde bulunmamaktadır. Lütfen listeden bir konu seçiniz.');
				
				// mesajı veritabanına kaydet
				$this->iletisim_mesaji->ekle_1();
				
				// @TODO yöneticilere bilgi mesajı gönderilecek
				
				$data['tamam'] = 'Mesajınız kaydedilmiştir. En kısa zamanda incelenecektir.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['iletisim_konusu_listesi'] = $this->iletisim_konusu->get_liste_1();
		
		$this->load->view('misafir/sayfalar/iletisim', $data);
	}
}