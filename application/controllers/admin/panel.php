<?php

class Panel extends MY_AdminKontroller {
	
	function index() {
		
		$this->admin_lib->sadece_admin_gorebilir();
		
		$data = array();
		
		$data['icerik'] = $this->smarty->view('admin/panel/index.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	} 
	
	function giris() {
		
		$this->admin_lib->sadece_admin_goremez();
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->admin_mod->mail = trim($this->input->post('mail'));
			$this->admin_mod->sifre = trim($this->input->post('sifre'));
			
			try {
			
				if (empty($this->admin_mod->mail)) throw new Exception('Mail adresiniz yazınız.');
				if (!form_is_mail($this->admin_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				if (empty($this->admin_mod->sifre)) throw new Exception('Şifrenizi yazınız.');				
				if (!$this->admin_mod->is_var_where_mail_and_sifre()) throw new Exception('Lütfen bilgileriniz kontrol ederek yeniden deneyiniz.');
				
				// admin giriş yapabilir
				$this->admin_lib->giris_yaptir($this->admin_mod->get_id_where_mail());
				
				// admini panele gönder
				redirect(SAYFA_ADMIN_0);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['admin_mod'] = $this->admin_mod;
		
		$data['meta_baslik'] = 'Admin Girişi';
		
		$data['icerik'] = $this->smarty->view('admin/panel/giris.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout1.tpl', $data );
	}
	
	function cikis() {
	
		$this->admin_lib->sadece_admin_gorebilir();
		
		$this->admin_lib->cikis_yaptir();
		
		redirect(SAYFA_ADMIN_1);
	} 
	
	function sifremi_unuttum() {
		
		$this->admin_lib->sadece_admin_goremez();
		
		$data['admin_mod'] = $this->admin_mod;
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			
			// formdan gelen bilgileri al
			$this->admin_mod->mail = trim($this->input->post('mail'));
			
			// hata kontrollerine başlayalım
			try {
				
				// formdan gelen bilgilerin geçerlilik kontrolü yapılıyor
				if (empty($this->admin_mod->mail)) throw new Exception('Mail adresinizi yazınız.');
				if (!form_is_mail($this->admin_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				// girilen mail adresi sistemde admin olarak kayıtlı olması şart
				if (!$this->admin_mod->is_var_where_mail()) throw new Exception('Mail adresi bulunamadı.');
				
				// bu satıra geldiğimizde artık girilen mail adresini 
				// kullanan bir adminimiz olduğuna emin oluyoruz.
				
				// adminimizin id numarasını set ediyoruz
				$this->admin_mod->id = $this->admin_mod->get_id_where_mail();
				
				// admine ait bilgileri veritabanından alıyoruz
				$temp_admin = $this->admin_mod->get_detay_where_id();
				
				// şifresini unutan adminin bilgileri artık elimizde
				$this->admin_mod->adi = $temp_admin->adi;
				
				// bu satıra gelindiğinde ise, artık şifresini unutan 
				// adminimize yeni şifresini belirlemesi için mail 
				// adresine gerekli yönergeleri göndererek onu yönlendirebiliriz
				
				// admin için yeni temp bilgisi oluştur ve güncelle
				$this->admin_mod->temp = $this->admin_mod->get_rasgele_md5();
				$this->admin_mod->guncelle_temp_where_id();
				
				// adminin şifresini sıfırlaması için kullanacağı url
				$data['url1'] = sprintf(SAYFA_ADMIN_4, $this->admin_mod->id, $this->admin_mod->temp);
				
				// basla mail
				$this->load->library('email');

				$this->email->to($this->admin_mod->mail, $this->admin_mod->adi);
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
		
		$data['meta_baslik'] = 'Şifremi Unuttum';
		
		$data['icerik'] = $this->smarty->view('admin/panel/sifremi_unuttum.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout1.tpl', $data );
	}
	
	function sifreyi_sifirla($id = 0, $temp = '') {
		
		$this->admin_lib->sadece_admin_goremez();
		
		$data['admin_mod'] = $this->admin_mod;
		
		// şifresi sıfırlanacak admine ait bilgiler belirleniyor 
		$this->admin_mod->id = (int) $id;
		$this->admin_mod->temp = $temp;
		
		// muhtemel hatalar kontrol edilecek
		try {
			
			// kullanıcıya ait temp bilgisi sistemde mevcut olmalı
			if (!$this->admin_mod->is_var_where_id_and_temp()) throw new Exception('Lütfen yeniden şifremi unuttum formunu doldurunuz.');
			
			// temp bilgisi değiştirilebilir
			$this->admin_mod->temp = $this->editor_mod->get_rasgele_md5();
			$this->admin_mod->guncelle_temp_where_id();
			
			// admin bilgileri veritabanından alınıyor
			$temp_admin = $this->admin_mod->get_detay_where_id();
			
			$this->admin_mod->adi = $temp_admin->adi;
			$this->admin_mod->mail = $temp_admin->mail;
			
			// adminin şifresi değiştiriliyor
			$temp_sifre = $this->admin_mod->get_rasgele_sifre();
			$this->admin_mod->sifre = $temp_sifre;
			$this->admin_mod->guncelle_sifre_where_id();
			$data['temp_sifre'] = $temp_sifre;
			
			// adminin giriş yapabileceği adres
			$data['url1'] = SAYFA_ADMIN_1;
			
			// basla mail
			$this->load->library('email');

			$this->email->to($this->admin_mod->mail, $this->admin_mod->adi);
			$this->email->subject('Yeni Şifreniz');
			$this->email->message($this->smarty->view('admin/panel/mailler/sifreyi_sifirla.tpl', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
			
			$data['tamam'] = 'Şifreniz sıfırlandı ve mail adresinize gönderildi.';
		} catch (Exception $ex) {
		
			$data['hata'] = $ex->getMessage();
		}
		
		$data['icerik'] = $this->smarty->view('admin/panel/sifreyi_sifirla.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout1.tpl', $data );
	}
	
	function sifre_degistir() {
		
		$this->admin_lib->sadece_admin_gorebilir();
		
		$this->admin_mod->id = $this->admin_lib->get_admin_id();
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			$this->admin_mod->eski_sifre = trim($this->input->post('eski_sifre'));
			$this->admin_mod->yeni_sifre = trim($this->input->post('yeni_sifre'));
			$this->admin_mod->yeni_sifre_tekrar = trim($this->input->post('yeni_sifre_tekrar'));
			
			try {
			
				// formdan gelen bilgilerin boş olmaması gerekiyor
				if (empty($this->admin_mod->eski_sifre)) throw new Exception('Lütfen eski şifrenizi yazınız.');
				if (empty($this->admin_mod->yeni_sifre)) throw new Exception('Lütfen yeni şifrenizi yazınız.');
				if (empty($this->admin_mod->yeni_sifre_tekrar)) throw new Exception('Lütfen yeni şifrenizi tekrar yazınız.');
				if ($this->admin_mod->yeni_sifre != $this->admin_mod->yeni_sifre_tekrar) throw new Exception('Lütfen yeni şifre ile yeni şifre (tekrar)\'ı aynı yazınız.');
				if ($this->admin_mod->eski_sifre == $this->admin_mod->yeni_sifre) throw new Exception('Lütfen yeni şifrenizi eski şifrenizden farklı yazınız.');
				
				// admin eski şifresini doğru girmiş mi?
				$this->admin_mod->sifre = $this->admin_mod->eski_sifre;
				if (!$this->admin_mod->is_var_where_id_and_sifre()) throw new Exception('Lütfen eski şifrenizi doğru yazınız.');
				
				// adminin yeni şifresini güncelle
				$this->admin_mod->sifre = $this->admin_mod->yeni_sifre;
				$this->admin_mod->guncelle_sifre_where_id();
				
				$data['tamam'] = 'Şifreniz değiştirilmiştir. Sisteme yeniden girmek istediğinizde yeni şifrenizi kullanacaksınız.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır form submit edilmemiş
			
			$data = array();
		}
		
		$data['icerik'] = $this->smarty->view('admin/panel/sifre_degistir.tpl', $data, TRUE);

		$this->smarty->view( 'admin/layout2.tpl', $data );
	}
}