<?php

class Panel extends MY_YazarKontroller {
	
	function index() {
		
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		$data = array();
		
		$data['icerik'] = $this->smarty->view('yazar/panel/index.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout2.tpl', $data );
	} 
	
	function giris() {
		
		$this->yazar_lib->sadece_yazar_goremez();
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazar_mod->mail = trim($this->input->post('mail'));
			$this->yazar_mod->sifre = trim($this->input->post('sifre'));
			
			try {
			
				if (empty($this->yazar_mod->mail)) throw new Exception('Mail adresiniz yazınız.');
				if (!form_is_mail($this->yazar_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				if (empty($this->yazar_mod->sifre)) throw new Exception('Şifrenizi yazınız.');				
				if (!$this->yazar_mod->is_var_mail_and_sifre()) throw new Exception('Lütfen bilgileriniz kontrol ederek yeniden deneyiniz.');
				
				$this->yazar_mod->id = (int) $this->yazar_mod->get_id_where_mail();
				
				// yazar onaylı olması gerekir
				if ($this->yazar_mod->get_is_onayli_where_id() == 0) throw new Exception('Yazarlığınız onay beklemektedir. Onaylandıktan sonra mail ile bildirim alacaksınız.');

				// yazar giriş yapabilir
				$this->yazar_lib->giris_yaptir($this->yazar_mod->id);
				
				// yazarı panele gönder
				redirect(SAYFA_YAZAR_0);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['yazar_mod'] = $this->yazar_mod;
		
		$data['meta_baslik'] = 'Yazar Girişi';
		
		$data['icerik'] = $this->smarty->view('yazar/panel/giris.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout1.tpl', $data );
	}
	
	function cikis() {
		
		$this->yazar_lib->sadece_yazar_gorebilir();
		
		$this->yazar_lib->cikis_yaptir();
		
		redirect(SAYFA_YAZAR_1);
	}
	
	function sifremi_unuttum() {
		
		$this->yazar_lib->sadece_yazar_goremez();
		
		$data['yazar_mod'] = $this->yazar_mod;
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			
			// formdan gelen bilgileri al
			$this->yazar_mod->mail = trim($this->input->post('mail'));
			
			// hata kontrollerine başlayalım
			try {
				
				// formdan gelen bilgilerin geçerlilik kontrolü yapılıyor
				if (empty($this->yazar_mod->mail)) throw new Exception('Mail adresinizi yazınız.');
				if (!form_is_mail($this->yazar_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				// girilen mail adresi sistemde kayıtlı olması şart
				if (!$this->yazar_mod->is_var_where_mail()) throw new Exception('Mail adresi bulunamadı.');
				
				// yazara ait id numarasını öğrenelim
				$this->yazar_mod->id = $this->yazar_mod->get_id_where_mail();
				
				// o halde üyelik onay bekliyor olmaması gerekiyor
				if ($this->yazar_mod->get_is_onayli_where_id() == 0) throw new Exception('Yazarlığınız onay beklemektedir. Lütfen onaylanmasını bekleyiniz. Onaylandıktan sonra size bilgi gönderilecektir.');

				// bu satıra geldiğimizde artık girilen mail adresini 
				// kullanan bir yazarımız olduğuna emin oluyoruz.
				
				// yazara ait bilgileri veritabanından alıyoruz
				$temp_yazar = $this->yazar_mod->get_detay_where_id();
				
				// şifresini unutan yazarın bilgileri artık elimizde
				$this->yazar_mod->adi = $temp_yazar->adi;

				// bu satıra gelindiğinde ise, artık şifresini unutan 
				// yazarımıza yeni şifresini belirlemesi için mail 
				// adresine gerekli yönergeleri göndererek onu yönlendirebiliriz
				
				// yazar için yeni temp bilgisi oluştur ve güncelle
				$this->yazar_mod->temp = $this->yazar_mod->get_rasgele_md5();
				$this->yazar_mod->guncelle_temp_where_id();
				
				// üyenin şifresini sıfırlaması için kullanacağı url
				$data['url1'] = sprintf(SAYFA_YAZAR_4, $this->yazar_mod->id, $this->yazar_mod->temp);
				
				// basla mail
				$this->load->library('email');

				$this->email->to($this->yazar_mod->mail, $this->yazar_mod->adi);
				$this->email->subject('Şifrenizi Sıfırlayınız');
				$this->email->message($this->smarty->view('yazar/panel/mailler/sifremi_unuttum.tpl', $data, true));
				
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
		
		$data['icerik'] = $this->smarty->view('yazar/panel/sifremi_unuttum.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout1.tpl', $data );
	}
	
	function sifreyi_sifirla($id = 0, $temp = '') {
		
		$this->yazar_lib->sadece_yazar_goremez();
		
		$data['yazar_mod'] = $this->yazar_mod;
		
		// şifresi sıfırlanacak kullanıcıya ait bilgiler belirleniyor
		$this->yazar_mod->id = (int) $id;
		$this->yazar_mod->temp = $temp;
		
		// muhtemel hatalar kontrol edilecek
		try {
		
			// yazara ait temp bilgisi sistemde mevcut olmalı
			if (!$this->yazar_mod->is_var_where_id_and_temp()) throw new Exception('Lütfen yeniden şifremi unuttum formunu doldurunuz.');

			// sistemde böyle birinin olduğunu anladık
			// peki yazar onaylı mı?
			if ($this->yazar_mod->get_is_onayli_where_id() == 0) throw new Exception('Yazarlığınız onay beklemektedir. Lütfen onaylandıktan sonra tekrar deneyiniz. Ayrıca yazarlığınız onaylandığında bildirim mesajı alacaksınız.');

			// yazarımız onaylı ve şifresini unutmuş ve 
			// formu doldurmuş ve göndermiş, arkasından 
			// sistem yazara mail mesajı göndermiş ve
			// o mesajdaki bağlantıya tıklayan yazar bu 
			// satırlara kadar ulaşmış
			// o halde bundan sonra yazara yeni şifresini 
			// oluşturup mail adresine gönderebiliriz.
			
			// öncelikle yapmamız gereken temp bilgisini 
			// değiştirmek olmalıdır. böylece temp bilgisi 
			// yeniden kullanılamaz hale gelecektir.
			$this->yazar_mod->temp = $this->yazar_mod->get_rasgele_md5();
			$this->yazar_mod->guncelle_temp_where_id();
			
			// yazara ait bilgileri veritabanından alıyoruz
			$temp_yazar = $this->yazar_mod->get_detay_where_id();
			
			$this->yazar_mod->adi = $temp_yazar->adi;
			$this->yazar_mod->mail = $temp_yazar->mail;
			
			// yazarın şifresi değiştiriliyor
			$temp_sifre = $this->yazar_mod->get_rasgele_sifre();
			$this->yazar_mod->sifre = $temp_sifre;
			$this->yazar_mod->guncelle_sifre_where_id();
			$data['temp_sifre'] = $temp_sifre;

			// yazarın giriş yapabileceği url
			$data['url1'] = SAYFA_YAZAR_1;

			// basla mail
			$this->load->library('email');

			$this->email->to($this->yazar_mod->mail, $this->yazar_mod->adi);
			$this->email->subject('Yeni Şifreniz');
			$this->email->message($this->smarty->view('yazar/panel/mailler/sifreyi_sifirla.tpl', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
			
			$data['tamam'] = 'Şifreniz sıfırlandı ve mail adresinize gönderildi.';
		} catch (Exception $ex) {
		
			$data['hata'] = $ex->getMessage();
		}
		
		$data['icerik'] = $this->smarty->view('yazar/panel/sifreyi_sifirla.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout1.tpl', $data );
	}
	
	function sifre_degistir() {
	
		$this->yazar_lib->sadece_yazar_gorebilir();
	
		$this->yazar_mod->id = $this->yazar_lib->get_yazar_id();
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			$this->yazar_mod->eski_sifre = trim($this->input->post('eski_sifre'));
			$this->yazar_mod->yeni_sifre = trim($this->input->post('yeni_sifre'));
			$this->yazar_mod->yeni_sifre_tekrar = trim($this->input->post('yeni_sifre_tekrar'));
			
			try {
			
				// formdan gelen bilgilerin boş olmaması gerekiyor
				if (empty($this->yazar_mod->eski_sifre)) throw new Exception('Lütfen eski şifrenizi yazınız.');
				if (empty($this->yazar_mod->yeni_sifre)) throw new Exception('Lütfen yeni şifrenizi yazınız.');
				if (empty($this->yazar_mod->yeni_sifre_tekrar)) throw new Exception('Lütfen yeni şifrenizi tekrar yazınız.');
				if ($this->yazar_mod->yeni_sifre != $this->yazar_mod->yeni_sifre_tekrar) throw new Exception('Lütfen yeni şifre ile yeni şifre (tekrar)\'ı aynı yazınız.');
				if ($this->yazar_mod->eski_sifre == $this->yazar_mod->yeni_sifre) throw new Exception('Lütfen yeni şifrenizi eski şifrenizden farklı yazınız.');
				
				// yazar eski şifresini doğru girmiş mi?
				$this->yazar_mod->sifre = $this->yazar_mod->eski_sifre;
				if (!$this->yazar_mod->is_var_where_id_and_sifre()) throw new Exception('Lütfen eski şifrenizi doğru yazınız.');
				
				// yazarın yeni şifresini güncelle
				$this->yazar_mod->sifre = $this->yazar_mod->yeni_sifre;
				$this->yazar_mod->guncelle_sifre_where_id();
				
				$data['tamam'] = 'Şifreniz değiştirilmiştir. Sisteme yeniden girmek istediğinizde yeni şifrenizi kullanacaksınız.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır form submit edilmemiş
			
			$data = array();
		}
		
		$data['icerik'] = $this->smarty->view('yazar/panel/sifre_degistir.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout2.tpl', $data );
	}
	
	function basvuru_yap() {
		
		$this->yazar_lib->sadece_yazar_goremez();
		
		$data['yazar_mod'] = $this->yazar_mod;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->yazar_mod->adi = trim($this->input->post('adi'));
			$this->yazar_mod->mail = trim($this->input->post('mail'));
			$this->yazar_mod->favori_konulari = nl2br(html_filtrele_1(trim($this->input->post('favori_konulari', TRUE))));
			$this->yazar_mod->referanslari = nl2br(html_filtrele_1(trim($this->input->post('referanslari', TRUE))));
			
			try {
			
				if (empty($this->yazar_mod->adi)) throw new Exception('Lütfen adınızı yazınız.');
				if (empty($this->yazar_mod->mail)) throw new Exception('Lütfen mail adresinizi yazınız.');
				if (!form_is_mail($this->yazar_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if ($this->yazar_mod->is_var_where_mail()) throw new Exception('Mail adresi yazar olarak kayıtlıdır. Lütfen yazar girişi yapmayı deneyiniz.');
				if (empty($this->yazar_mod->favori_konulari)) throw new Exception('Lütfen favori konularınızı yazınız.');
				if (empty($this->yazar_mod->referanslari)) throw new Exception('Lütfen referanslarınızı yazınız.');
				
				// başvuruyu kaydet
				$this->yazar_mod->ekle_1(); 
				
				// ana sayfanın url bilgisi
				$data['url1'] = SAYFA_MISAFIR_11;
				
				// başvuru yapana mail gönder
				// basla mail
				$this->load->library('email');

				$this->email->to($this->yazar_mod->mail, $this->yazar_mod->adi);
				$this->email->subject('Yazarlık Başvurusunda Bulundunuz');
				$this->email->message($this->smarty->view('yazar/panel/mailler/basvuru_yap.tpl', $data, true));
				
				$this->email->send();
				
				// echo $this->email->print_debugger();
				// bitti mail
				
				// adminlere mail gönder
				
				$data['url2'] = SAYFA_ADMIN_0;
				
				$this->load->library('email');
				$this->load->model('admin_mod');
				$adminler = $this->admin_mod->get_liste_1();
				foreach ($adminler->result() as $admin) {
				
					$data['admin'] = $admin;
					
					// basla mail
					$this->email->to($admin->mail, $admin->adi);
					$this->email->subject('Yeni Yazar Başvurusunda Bulunuldu');
					$this->email->message($this->smarty->view('yazar/panel/mailler/basvuru_yapildi.tpl', $data, true));
					
					$this->email->send();
					
					// echo $this->email->print_debugger();
					// bitti mail
				}
				
				$data['tamam'] = 'Yazarlık başvurunuz alınmıştır. En kısa zamanda değerlendirilecektir.';
				
			} catch (Exception $ex) {
				
				$data['hata'] = $ex->getMessage();
			} // try
		} else { 
		
			
		} // if
		
		$data['meta_baslik'] = 'Yazarlık Başvurusu Yap';
		
		$data['icerik'] = $this->smarty->view('yazar/panel/basvuru_yap.tpl', $data, TRUE);

		$this->smarty->view( 'yazar/layout1.tpl', $data );
	}
}