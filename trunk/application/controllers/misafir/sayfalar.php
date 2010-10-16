<?php

class Sayfalar extends MY_MisafirKontroller {

	function Sayfalar() {
	
		parent::MY_MisafirKontroller();
	}
	
	function iletisim() {
	
		// modelleri yükle
		$this->load->model('iletisim_konusu_mod');
		$this->load->model('iletisim_mesaji_mod');
		
		$data['iletisim_konusu_mod'] = $this->iletisim_konusu_mod;
		$data['iletisim_mesaji_mod'] = $this->iletisim_mesaji_mod;
		
		// mesaj göndermek için form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet mesaj gönderme formu submit edilmiş
			
			// formdan gelen bilgileri alalım
			$this->iletisim_mesaji_mod->konu_id = (int) trim($this->input->post('konu_id'));
			$this->iletisim_mesaji_mod->adi = trim($this->input->post('adi'));
			$this->iletisim_mesaji_mod->mail = trim($this->input->post('mail'));
			$this->iletisim_mesaji_mod->mesaj = nl2br(html_filtrele_1(trim($this->input->post('mesaj', TRUE))));
			
			// post bilgilerini kontrole başlayalım
			try {

				// doldurulması zorunlu alanların kontrolü
				if (empty($this->iletisim_mesaji_mod->konu_id)) throw new Exception('Lütfen mesajınız için bir konu seçiniz.');
				if (empty($this->iletisim_mesaji_mod->adi)) throw new Exception('Lütfen adınızı yazınız.');
				if (empty($this->iletisim_mesaji_mod->mail)) throw new Exception('Lütfen mail adresinizi yazınız.');
				if (!form_is_mail($this->iletisim_mesaji_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if (empty($this->iletisim_mesaji_mod->mesaj)) throw new Exception('Lütfen mesajınızı yazınız.');

				// mesaj gönderilirken seçilen konunun sistemde 
				// olup olmadığına bakılıyor
				$this->iletisim_konusu_mod->id = $this->iletisim_mesaji_mod->konu_id;				
				if (!$this->iletisim_konusu_mod->is_var_where_id()) throw new Exception('Lütfen listeden bir konu seçiniz.');

				// mesajı veritabanına kaydet
				$this->iletisim_mesaji_mod->ekle_1();

				// adminlere mail gönderirken bilgi amaçlı kullanılacak 
				$this->iletisim_konusu_mod->adi = $this->iletisim_konusu_mod->get_adi_where_id();

				// adminlere mail gönder
				$data['url1'] = SAYFA_ADMIN_0;
				
				$this->load->library('email');
				$this->load->model('admin_mod');
				$adminler = $this->admin_mod->get_liste_1();
				foreach ($adminler->result() as $admin) {
				
					$data['admin'] = $admin;
					
					// basla mail
					$this->email->to($admin->mail, $admin->adi);
					$this->email->subject('İletişim Formundan Mesaj Gönderildi');
					$this->email->message($this->smarty->view('misafir/sayfalar/mailler/iletisim.tpl', $data, true));
					
					$this->email->send();
					
					// echo $this->email->print_debugger();
					// bitti mail
				}
				
				$data['tamam'] = 'Mesajınız kaydedilmiştir. En kısa zamanda incelenecektir.';				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
			
			$this->iletisim_mesaji_mod->konu_id = 0;
		}
		
		// html kategori select
		$this->load->library('iletisim_konusu_lib');
		$data['html_select_iletisim_konulari'] = $this->iletisim_konusu_lib->get_html_select1($this->iletisim_mesaji_mod->konu_id);
		
		// navigasyon için
		$this->load->model('kategori_mod');
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();
		
		$data['meta_baslik'] = 'İletişim Sayfası';
		
		$data['icerik'] = $this->smarty->view('misafir/sayfalar/iletisim.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
	
	function arama() {
		
		// navigasyon için
		$this->load->model('kategori_mod');
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();
		
		$data['icerik'] = $this->smarty->view('misafir/sayfalar/arama.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
}