<?php

class Panel extends MY_EditorKontroller {
	
	function index() {
	
		$this->editor_lib->sadece_editor_gorebilir();
		
		$data = array();
		
		$data['icerik'] = $this->smarty->view('editor/panel/index.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout2.tpl', $data );
	} 
	
	function giris() {
		
		$this->editor_lib->sadece_editor_goremez();
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->editor_mod->mail = trim($this->input->post('mail'));
			$this->editor_mod->sifre = trim($this->input->post('sifre'));
			
			try {
			
				if (empty($this->editor_mod->mail)) throw new Exception('Mail adresiniz yazınız.');
				if (!form_is_mail($this->editor_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				if (empty($this->editor_mod->sifre)) throw new Exception('Şifrenizi yazınız.');				
				if (!$this->editor_mod->is_var_where_mail_and_sifre()) throw new Exception('Lütfen bilgileriniz kontrol ederek yeniden deneyiniz.');
				
				$this->editor_mod->id = $this->editor_mod->get_id_where_mail();
				
				// editör onaylı olması gerekir
				if ($this->editor_mod->get_is_onayli_where_id() == 0) throw new Exception('Editörlüğünüz onay beklemektedir. Onaylandıktan sonra mail ile bildirim alacaksınız.');
				
				// editör giriş yapabilir
				$this->editor_lib->giris_yaptir($this->editor_mod->id);
								
				// editörü panele gönder
				redirect(SAYFA_EDITOR_0);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			
		}
		
		$data['editor_mod'] = $this->editor_mod;
		
		$data['meta_baslik'] = 'Editör Girişi';
		
		$data['icerik'] = $this->smarty->view('editor/panel/giris.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout1.tpl', $data );
	}
	
	function cikis() {
	
		$this->editor_lib->sadece_editor_gorebilir();
		
		$this->editor_lib->cikis_yaptir();
		
		redirect(SAYFA_EDITOR_1);
	} 
	
	function sifremi_unuttum() {
		
		$this->editor_lib->sadece_editor_goremez();
		
		$data['editor_mod'] = $this->editor_mod;
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			
			// formdan gelen bilgileri al
			$this->editor_mod->mail = trim($this->input->post('mail'));
			
			// hata kontrollerine başlayalım
			try {
				
				// formdan gelen bilgilerin geçerlilik kontrolü yapılıyor
				if (empty($this->editor_mod->mail)) throw new Exception('Mail adresinizi yazınız.');
				if (!form_is_mail($this->editor_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				
				// girilen mail adresi sistemde editor olarak kayıtlı olması şart
				if (!$this->editor_mod->is_var_where_mail()) throw new Exception('Mail adresi bulunamadı.');
				
				// editöre ait id numarasını öğrenelim
				$this->editor_mod->id = $this->editor_mod->get_id_where_mail();
				
				// üyelik onay bekliyor olmaması gerekiyor
				if ($this->editor_mod->get_is_onayli_where_id() == 0) throw new Exception('Editörlüğünüz onay beklemektedir. Onaylandıktan sonra mail ile bildirim alacaksınız.');
				
				// bu satıra geldiğimizde artık girilen mail adresini 
				// kullanan bir editörümüz olduğuna emin oluyoruz.
				
				// editöre ait bilgileri veritabanından alıyoruz
				$temp_editor = $this->editor_mod->get_detay_where_id();
				
				// şifresini unutan editörün bilgileri artık elimizde
				$this->editor_mod->adi = $temp_editor->adi;

				// bu satıra gelindiğinde ise, artık şifresini unutan 
				// editörümüze yeni şifresini belirlemesi için mail 
				// adresine gerekli yönergeleri göndererek onu yönlendirebiliriz
				
				// editör için yeni temp bilgisi oluştur ve güncelle
				$this->editor_mod->temp = $this->editor_mod->get_rasgele_md5();
				$this->editor_mod->guncelle_temp_where_id();
				
				// editörün şifresini sıfırlaması için kullanacağı url
				$data['url1'] = sprintf(SAYFA_EDITOR_4, $this->editor_mod->id, $this->editor_mod->temp);
				
				// basla mail
				$this->load->library('email');

				$this->email->to($this->editor_mod->mail, $this->editor_mod->adi);
				$this->email->subject('Şifrenizi Sıfırlayınız');
				$this->email->message($this->smarty->view('editor/panel/mailler/sifremi_unuttum.tpl', $data, true));
				
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
		
		$data['icerik'] = $this->smarty->view('editor/panel/sifremi_unuttum.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout1.tpl', $data );
	}
	
	function sifreyi_sifirla($id = 0, $temp = '') {
		
		$this->editor_lib->sadece_editor_goremez();
		
		$data['editor_mod'] = $this->editor_mod;
		
		// şifresi sıfırlanacak editöre ait bilgiler belirleniyor
		$this->editor_mod->id = (int) $id;
		$this->editor_mod->temp = $temp;
		
		// muhtemel hatalar kontrol edilecek
		try {
			
			// editöre ait temp bilgisi sistemde mevcut olmalı
			if (!$this->editor_mod->is_var_where_id_and_temp()) throw new Exception('Lütfen yeniden şifremi unuttum formunu doldurunuz.');
			
			// sistemde böyle birinin olduğunu anladık
			// peki editör onaylı mı?
			if ($this->editor_mod->get_is_onayli_where_id() == 0) throw new Exception('Editörlüğünüz onay beklemektedir. Lütfen onaylandıktan sonra tekrar deneyiniz. Ayrıca editörlüğünüz onaylandığında bildirim mesajı alacaksınız.');

			// temp bilgisi değiştirilebilir
			$this->editor_mod->temp = $this->editor_mod->get_rasgele_md5();
			$this->editor_mod->guncelle_temp_where_id();
			
			// editör bilgileri veritabanından alınıyor
			$temp_editor = $this->editor_mod->get_detay_where_id();
			
			$this->editor_mod->adi = $temp_editor->adi;
			$this->editor_mod->mail = $temp_editor->mail;
			
			// editörün şifresi değiştiriliyor
			$temp_sifre = $this->editor_mod->get_rasgele_sifre();
			$this->editor_mod->sifre = $temp_sifre;
			$this->editor_mod->guncelle_sifre_where_id();
			$data['temp_sifre'] = $temp_sifre;
			
			// editörün giriş yapabileceği url
			$data['url1'] = SAYFA_EDITOR_1;
			
			// basla mail
			$this->load->library('email');

			$this->email->to($this->editor_mod->mail, $this->editor_mod->adi);
			$this->email->subject('Yeni Şifreniz');
			$this->email->message($this->smarty->view('editor/panel/mailler/sifreyi_sifirla.tpl', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
			
			$data['tamam'] = 'Şifreniz sıfırlandı ve mail adresinize gönderildi.';
		} catch (Exception $ex) {
		
			$data['hata'] = $ex->getMessage();
		}
		
		$data['icerik'] = $this->smarty->view('editor/panel/sifreyi_sifirla.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout1.tpl', $data );
	}
	
	function sifre_degistir() {
		
		$this->editor_lib->sadece_editor_gorebilir();
		
		$this->editor_mod->id = $this->editor_lib->get_editor_id();
		
		// form submit edilmiş mi?
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			// evet form submit edilmiş
			$this->editor_mod->eski_sifre = trim($this->input->post('eski_sifre'));
			$this->editor_mod->yeni_sifre = trim($this->input->post('yeni_sifre'));
			$this->editor_mod->yeni_sifre_tekrar = trim($this->input->post('yeni_sifre_tekrar'));
			
			try {
			
				// formdan gelen bilgilerin boş olmaması gerekiyor
				if (empty($this->editor_mod->eski_sifre)) throw new Exception('Lütfen eski şifrenizi yazınız.');
				if (empty($this->editor_mod->yeni_sifre)) throw new Exception('Lütfen yeni şifrenizi yazınız.');
				if (empty($this->editor_mod->yeni_sifre_tekrar)) throw new Exception('Lütfen yeni şifrenizi tekrar yazınız.');
				if ($this->editor_mod->yeni_sifre != $this->editor_mod->yeni_sifre_tekrar) throw new Exception('Lütfen yeni şifre ile yeni şifre (tekrar)\'ı aynı yazınız.');
				if ($this->editor_mod->eski_sifre == $this->editor_mod->yeni_sifre) throw new Exception('Lütfen yeni şifrenizi eski şifrenizden farklı yazınız.');
				
				// editör eski şifresini doğru girmiş mi?
				$this->editor_mod->sifre = $this->editor_mod->eski_sifre;
				if (!$this->editor_mod->is_var_where_id_and_sifre()) throw new Exception('Lütfen eski şifrenizi doğru yazınız.');
				
				// editörün yeni şifresini güncelle
				$this->editor_mod->sifre = $this->editor_mod->yeni_sifre;
				$this->editor_mod->guncelle_sifre_where_id();
				
				$data['tamam'] = 'Şifreniz değiştirilmiştir. Sisteme yeniden girmek istediğinizde yeni şifrenizi kullanacaksınız.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
		
			// hayır form submit edilmemiş
			
			$data = array();
		}
		
		$data['icerik'] = $this->smarty->view('editor/panel/sifre_degistir.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout2.tpl', $data );
	}
	
	function basvuru_yap() {
		
		$this->editor_lib->sadece_editor_goremez();
		
		$data['editor_mod'] = $this->editor_mod;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->editor_mod->adi = trim($this->input->post('adi'));
			$this->editor_mod->mail = trim($this->input->post('mail'));
			$this->editor_mod->referanslari = nl2br(html_filtrele_1($this->input->post('referanslari', TRUE)));
			
			try {
			
				if (empty($this->editor_mod->adi)) throw new Exception('Lütfen adınızı yazınız.');
				if (empty($this->editor_mod->mail)) throw new Exception('Lütfen mail adresinizi yazınız.');
				if (!form_is_mail($this->editor_mod->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if ($this->editor_mod->is_var_where_mail()) throw new Exception('Mail adresi editör olarak kayıtlıdır. Lütfen editör girişi yapmayı deneyiniz.');
				if (empty($this->editor_mod->referanslari)) throw new Exception('Lütfen referanslarınızı yazınız.');
				
				// başvuruyu kaydet
				$this->editor_mod->ekle_1(); 
				
				// ana sayfa
				$data['url1'] = SAYFA_EDITOR_0;
				
				// başvuru yapana mail gönder
				// basla mail
				$this->load->library('email');

				$this->email->to($this->editor_mod->mail, $this->editor_mod->adi);
				$this->email->subject('Editörlük Başvurusunda Bulundunuz');
				$this->email->message($this->smarty->view('editor/panel/mailler/basvuru_yap.tpl', $data, true));
				
				$this->email->send();
				
				// echo $this->email->print_debugger();
				// bitti mail
				
				$data['url2'] = SAYFA_ADMIN_0;
				
				$this->load->library('email');
				$this->load->model('admin_mod');
				$adminler = $this->admin_mod->get_liste_1();
				foreach ($adminler->result() as $admin) {
				
					$data['admin'] = $admin;
					
					// basla mail
					$this->email->to($admin->mail, $admin->adi);
					$this->email->subject('Yeni Editör Başvurusunda Bulunuldu');
					$this->email->message($this->smarty->view('editor/panel/mailler/basvuru_yapildi.tpl', $data, true));
					
					$this->email->send();
					
					// echo $this->email->print_debugger();
					// bitti mail
				}
				
				$data['tamam'] = 'Editörlük başvurunuz alınmıştır. En kısa zamanda değerlendirilecektir.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			} // try
		} else { 
		
			
		} // if
		
		$data['meta_baslik'] = 'Editörlük Başvurusu Yap';
		
		$data['icerik'] = $this->smarty->view('editor/panel/basvuru_yap.tpl', $data, TRUE);

		$this->smarty->view( 'editor/layout1.tpl', $data );
	}
}