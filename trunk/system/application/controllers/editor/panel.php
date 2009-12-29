<?php

class Panel extends MY_EditorKontroller {
	
	function index() {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$data['k_t'] = k_t_giris_yapmis_editor;
		
		$data['kullanici_adi'] = $this->kullanici_lib->kullanici_adi;
		
		$this->load->view('editor/panel/index', $data);
	} 
	
	function giris() {
		
		$data['k_t'] = k_t_giris_yapacak_editor;
		
		$data['kullanici'] = $this->kullanici;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kullanici->mail = $this->input->post('mail');
			$this->kullanici->sifre = $this->input->post('sifre');
			
			try {
			
				if (form_is_bos($this->kullanici->mail)) throw new Exception('Mail adresiniz yazınız.');
				if (!form_is_mail($this->kullanici->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if (form_is_bos($this->kullanici->sifre)) throw new Exception('Şifrenizi yazınız.');				
				if (!$this->kullanici->is_var_editor_where_mail_and_sifre()) throw new Exception('Lütfen bilgileriniz kontrol ederek yeniden deneyiniz.');
				
				$this->kullanici->id = (int) $this->kullanici->get_editor_id_where_mail();
				
				if (!$this->kullanici->is_onayli_where_id()) throw new Exception('Editörlüğünüz onay beklemektedir. Onaylandıktan sonra mail ile bildirim alacaksınız.');

				$this->kullanici_oturumu->kullanici_id = (int) $this->kullanici->id;

				$this->kullanici_oturumu->ekle();
				
				redirect(sayfa_editor_0);
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		}
		
		$this->load->view(sayfa_editor_1, $data);
	}
	
	function cikis() {
	
		$this->kullanici_lib->sadece_editor_gorebilir();
		
		$this->kullanici_oturumu->sil_where_oturum_id();
		
		redirect(sayfa_editor_1);
	} 
	
	function sifremi_unuttum() {
		
		$data['k_t'] = k_t_giris_yapacak_editor;
	
		$data['kullanici'] = $this->kullanici;
	
		if ($this->input->server('REQUEST_METHOD') == 'POST') {	
		
			$this->kullanici->mail = $this->input->post('mail');
			
			try {
			
				if (form_is_bos($this->kullanici->mail)) throw new Exception('Mail adresinizi yazınız.');
				if (!form_is_mail($this->kullanici->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if (!$this->kullanici->is_var_editor_where_mail()) throw new Exception('Mail adresi bulunamadı.');
				
				// kullanıcı bilgilerini al
				$temp_kullanici = $this->kullanici->get_editor_detay_where_mail();
				
				$this->kullanici->id = $temp_kullanici->id;
				$this->kullanici->adi = $temp_kullanici->adi;
				
				if (!$this->kullanici->is_onayli_where_id()) throw new Exception('Editörlüğünüz onay beklemektedir. Onaylandıktan sonra mail ile bildirim alacaksınız.');
				
				// yeni temp bilgisi oluştur
				$this->kullanici->temp = $this->kullanici->get_rasgele_md5();

				// temp bilgisini güncelle
				$this->kullanici->guncelle_temp_where_id();
				
				// üyenin şifresini sıfırlaması için kullanacağı url
				$data['url1'] = site_url(sprintf(sayfa_editor_4, $this->kullanici->id, $this->kullanici->temp));
				
				// basla mail
				$this->load->library('email');

				$this->email->to($this->kullanici->mail, $this->kullanici->adi);
				$this->email->subject('Şifrenizi Sıfırlayınız');
				$this->email->message($this->load->view('editor/panel/mailler/sifremi_unuttum', $data, true));
				
				$this->email->send();
				
				// echo $this->email->print_debugger();
				// bitti mail
				
				$data['tamam'] = 'Yeni şifrenizi belirlemek için mail adresinizi kontrol ediniz.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			}
		} else {
			
		}
		
		$this->load->view(sayfa_editor_2, $data);
	}
	
	function sifreyi_sifirla($id = 0, $temp = '') {
		
		$data['k_t'] = k_t_giris_yapacak_editor;
		
		$data['kullanici'] = $this->kullanici;
		
		$this->kullanici->id = (int) $id;
		$this->kullanici->temp = $temp;
		
		try {
		
			if (!$this->kullanici->is_var_where_id_and_temp()) throw new Exception('Lütfen yeniden şifremi unuttum formunu doldurunuz.');
			
			$temp_kullanici = $this->kullanici->get_detay_where_id();
			
			$this->kullanici->adi = $temp_kullanici->adi;
			$this->kullanici->mail = $temp_kullanici->adi;
			
			$temp_sifre = $this->kullanici->get_rasgele_sifre();
			$this->kullanici->sifre = $temp_sifre;
			$this->kullanici->guncelle_sifre_where_id();
			$data['temp_sifre'] = $temp_sifre;
			
			$this->kullanici->temp = $this->kullanici->get_rasgele_md5();
			$this->kullanici->guncelle_temp_where_id();
			
			$data['url1'] = site_url(sayfa_editor_1);
			
			// basla mail
			$this->load->library('email');

			$this->email->to($this->kullanici->mail, $this->kullanici->adi);
			$this->email->subject('Yeni Şifreniz');
			$this->email->message($this->load->view('editor/panel/mailler/sifreyi_sifirla', $data, true));
			
			$this->email->send();
			
			// echo $this->email->print_debugger();
			// bitti mail
			
			$data['tamam'] = 'Şifreniz sıfırlanıp yeni şifreniz mail adresinize gönderilmiştir.';
		} catch (Exception $ex) {
		
			$data['hata'] = $ex->getMessage();
		}
		
		$this->load->view('editor/panel/sifreyi_sifirla', $data);
	}
	
	function basvuru_yap() {
	
		$data['k_t'] = k_t_giris_yapacak_editor;
		
		$data['meta_baslik'] = 'Editörlük Başvurusu Yap';
		
		$data['kullanici'] = $this->kullanici;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kullanici->adi = $this->input->post('adi');
			$this->kullanici->mail = $this->input->post('mail');
			$this->kullanici->referanslari = $this->input->post('referanslari');
			
			try {
			
				if (form_is_bos($this->kullanici->adi)) throw new Exception('Lütfen adınızı yazınız.');
				if (form_is_bos($this->kullanici->mail)) throw new Exception('Lütfen mail adresinizi yazınız.');
				if (!form_is_mail($this->kullanici->mail)) throw new Exception('Lütfen geçerli bir mail adresi giriniz.');
				if ($this->kullanici->is_var_yazar_where_mail()) throw new Exception('Mail adresi yazar olarak kayıtlıdır. Lütfen yazar girişi yapmayı deneyiniz.');
				if (form_is_bos($this->kullanici->referanslari)) throw new Exception('Lütfen referanslarınızı yazınız.');
				
				// başvuruyu kaydet
				$this->kullanici->editorluk_basvurusu_yap(); 
				
				// başvuru yapana mail gönder
				// basla mail
				$this->load->library('email');

				$this->email->to($this->kullanici->mail, $this->kullanici->adi);
				$this->email->subject('Editörlük Başvurusunda Bulundunuz');
				$this->email->message($this->load->view('editor/panel/mailler/basvuru_yap', $data, true));
				
				$this->email->send();
				
				// echo $this->email->print_debugger();
				// bitti mail
				
				// @TODO adminler bilgilendirme alacak
				
				$data['tamam'] = 'Editörlük başvurunuz alınmıştır. En kısa zamanda değerlendirilecektir.';
				
			} catch (Exception $ex) {
			
				$data['hata'] = $ex->getMessage();
			} // try
		} else { 
		
			
		} // if
		
		$this->load->view(sayfa_editor_5, $data);
	}
}