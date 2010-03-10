<?php

class Panel extends MY_AdminKontroller {
	
	function index() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$data['admin_adi'] = $this->kullanici_lib->kullanici_adi;
		
		$this->smarty->view('admin/panel/index.tpl', $data);
	} 
	
	function giris() {
		
		$data['k_t'] = k_t_giris_yapacak_admin;
		
		$data['kullanici'] = $this->kullanici;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kullanici->mail = $this->input->post('mail');
			$this->kullanici->sifre = $this->input->post('sifre');
			
			try {
			
				if (form_is_bos($this->kullanici->mail)) throw new Exception('Mail adresiniz yazınız.');
				if (!form_is_mail($this->kullanici->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if (form_is_bos($this->kullanici->sifre)) throw new Exception('Şifrenizi yazınız.');				
				if (!$this->kullanici->is_var_admin_where_mail_and_sifre()) throw new Exception('Lütfen bilgileriniz kontrol ederek yeniden deneyiniz.');

				$this->kullanici_oturumu->kullanici_id = (int) $this->kullanici->get_admin_id_where_mail();

				$this->kullanici_oturumu->ekle();
				
				redirect(SAYFA_ADMIN_0);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		}
		
		$data['meta_baslik'] = 'Admin Girişi';
		
		$this->smarty->view('admin/panel/giris.tpl', $data);
	}
	
	function cikis() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$this->kullanici_oturumu->sil_where_oturum_id();
		
		redirect(SAYFA_ADMIN_1);
	} 
	
	function sifremi_unuttum() {
		
		// kütüphaneleri yükle
		$this->load->library('kullanici_tempi_lib');
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			
			// formdan gelen bilgileri al
			$this->kullanici->mail = $this->input->post('mail');
			
			// hata kontrollerine başlayalım
			try {
				
				// formdan gelen bilgilerin geçerlilik kontrolü yapılıyor
				if (form_is_bos($this->kullanici->mail)) throw new Exception('Mail adresinizi yazınız.');
				if (!form_is_mail($this->kullanici->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				// girilen mail adresi sistemde admin olarak kayıtlı olması şart
				if (!$this->kullanici->is_var_admin_where_mail()) throw new Exception('Mail adresi bulunamadı.');
				
				// bu satıra geldiğimizde artık girilen mail adresini 
				// kullanan bir adminimiz olduğuna emin oluyoruz.
				
				// admine ait bilgileri veritabanından alıyoruz
				$temp_kullanici = $this->kullanici->get_admin_detay_where_mail();
				
				// şifresini unutan adminin bilgileri artık elimizde
				$this->kullanici->id = $temp_kullanici->id;
				$this->kullanici->adi = $temp_kullanici->adi;
				
				// bu satıra gelindiğinde ise, artık şifresini unutan 
				// adminimize yeni şifresini belirlemesi için mail 
				// adresine gerekli yönergeleri göndererek onu yönlendirebiliriz
				
				// admin için yeni temp bilgisi oluştur
				$this->kullanici->temp = $this->kullanici_tempi_lib->yeni_temp_kaydet($this->kullanici->id);
				
				// adminin şifresini sıfırlaması için kullanacağı url
				$data['url1'] = sprintf(SAYFA_ADMIN_4, $this->kullanici->id, $this->kullanici->temp);
				
				// kullanıcı bilgisi view lerde kullanılacak
				$data['kullanici'] = $this->kullanici;
				
				// basla mail
				$this->load->library('email');

				$this->email->to($this->kullanici->mail, $this->kullanici->adi);
				$this->email->subject('Şifrenizi Sıfırlayınız');
				$this->email->message($this->smarty->view('admin/panel/mailler/sifremi_unuttum.tpl', $data, true));
				
				$this->email->send();
				
				// echo $this->email->print_debugger();
				// bitti mail
				
				$data['tamam'] = 'Yeni şifrenizi belirlemek için mail adresinizi kontrol ediniz.';
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır form submit edilmiş
		}
		
		$data['k_t'] = k_t_giris_yapacak_admin;
		
		$data['meta_baslik'] = 'Şifremi Unuttum';
		
		$this->smarty->view('admin/panel/sifremi_unuttum.tpl', $data);
	}
	
	function sifreyi_sifirla($id = 0, $temp = '') {
		
		// kütüphaneleri yükle
		$this->load->library('kullanici_tempi_lib');
		
		// modelleri yükle
		$this->load->model('kullanici_tempi');
		
		// şifresi sıfırlanacak kullanıcıya ait bilgiler belirleniyor
		$this->kullanici_tempi->kullanici_id = (int) $id;
		$this->kullanici_tempi->temp = $temp;
		
		// muhtemel hatalar kontrol edilecek
		try {
			
			// kullanıcıya ait temp bilgisi sistemde mevcut olmalı
			if (!$this->kullanici_tempi->is_var_where_kullanici_id_and_temp()) throw new Exception('Lütfen yeniden şifremi unuttum formunu doldurunuz.');
			
			// kullanıcıya ait temp bilgisini silebiliriz
			$this->kullanici_tempi->sil_where_temp();
			
			// kullanıcıya ait yeni şifre belirleme ve kaydetme 
			// işlemleri için kullanıcı id bilgisini alıyoruz
			$this->kullanici->id = $this->kullanici_tempi->kullanici_id;
			
			// kullanıcının bilgileri veritabanından alınıyor
			$temp_kullanici = $this->kullanici->get_detay_where_id();
			
			$this->kullanici->adi = $temp_kullanici->adi;
			$this->kullanici->mail = $temp_kullanici->mail;
			
			// kullanıcının şifresi değiştiriliyor
			$temp_sifre = $this->kullanici->get_rasgele_sifre();
			$this->kullanici->sifre = $temp_sifre;
			$this->kullanici->guncelle_sifre_where_id();
			$data['temp_sifre'] = $temp_sifre;
			
			$data['url1'] = SAYFA_ADMIN_1;
			
			$data['kullanici'] = $this->kullanici;
			
			// basla mail
			$this->load->library('email');

			$this->email->to($this->kullanici->mail, $this->kullanici->adi);
			$this->email->subject('Yeni Şifreniz');
			$this->email->message($this->smarty->view('admin/panel/mailler/sifreyi_sifirla.tpl', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
			
			$data['tamam'] = 'Şifreniz sıfırlandı ve mail adresinize gönderildi.';
		} catch (Exception $ex) {
		
			$data['hata'] = $ex->getMessage();
		}
		
		$data['k_t'] = k_t_giris_yapacak_admin;
		
		$this->smarty->view('admin/panel/sifreyi_sifirla.tpl', $data);
	}
	
	function sifre_degistir() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['kullanici'] = $this->kullanici;
		
		$this->kullanici->id = $this->kullanici_lib->kullanici_id;
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			$this->kullanici->eski_sifre = $this->input->post('eski_sifre');
			$this->kullanici->yeni_sifre = $this->input->post('yeni_sifre');
			$this->kullanici->yeni_sifre_tekrar = $this->input->post('yeni_sifre_tekrar');
			
			try {
			
				// formdan gelen bilgilerin boş olmaması gerekiyor
				if (form_is_bos($this->kullanici->eski_sifre)) throw new Exception('Lütfen eski şifrenizi yazınız.');
				if (form_is_bos($this->kullanici->yeni_sifre)) throw new Exception('Lütfen yeni şifrenizi yazınız.');
				if (form_is_bos($this->kullanici->yeni_sifre_tekrar)) throw new Exception('Lütfen yeni şifrenizi tekrar yazınız.');
				if ($this->kullanici->yeni_sifre != $this->kullanici->yeni_sifre_tekrar) throw new Exception('Lütfen yeni şifre ile yeni şifre (tekrar)\'ı aynı yazınız.');
				if ($this->kullanici->eski_sifre == $this->kullanici->yeni_sifre) throw new Exception('Lütfen yeni şifrenizi eski şifrenizden farklı yazınız.');
				
				// admin eski şifresini doğru girmiş mi?
				$this->kullanici->sifre = $this->kullanici->eski_sifre;
				if (!$this->kullanici->is_var_where_id_and_sifre()) throw new Exception('Lütfen eski şifrenizi doğru yazınız.');
				
				// editörün yeni şifresini güncelle
				$this->kullanici->sifre = $this->kullanici->yeni_sifre;
				$this->kullanici->guncelle_sifre_where_id();
				
				$data['tamam'] = 'Şifreniz değiştirilmiştir. Sisteme yeniden girmek istediğinizde yeni şifrenizi kullanacaksınız.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır form submit edilmemiş
		}
		
		$data['k_t'] = k_t_giris_yapmis_admin;
		
		$this->smarty->view('admin/panel/sifre_degistir.tpl', $data);
	}
}