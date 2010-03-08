<?php

class Kullanici extends MY_Model {

	var $tablo_adi = 'kullanicilar';

	var $id;
	var $adi;
	var $mail; 
	var $sifre;
	var $temp;
	var $onay = 0;
	var $uye_olma_zamani;
	var $turu;
	var $favori_konulari;
	var $referanslari;
	
	var $eski_sifre;
	var $yeni_sifre;
	var $yeni_sifre_tekrar;
	
	const TUR_MISAFIR = 0;
	const TUR_EDITOR = 1;
	const TUR_YAZAR = 10;
	const TUR_ADMIN = 100;
	
	const ONAY_BEKLIYOR = 0;
	const ONAYLI = 1;

	function Kullanici() {
	
		parent::MY_Model();
		
		$this->uye_olma_zamani = $this->zaman;
	}
	
	/**
	 * Onaylı admin kullanıcılarının listesini verir
	 */
	function get_liste_1() {
	
		return $this->db->select('adi, mail')
						->where('turu', Kullanici::TUR_ADMIN)
						->where('onay', Kullanici::ONAYLI)
						->get($this->tablo_adi);
	}
	
	/*
	 * bir kimse sistemde yazar olmak başvuru yapmak istediğinde 
	 * yazarlık başvuru formunu dolduracak. submit edilen formdan 
	 * gelen bilgiler kontrol edildikten sonra bu fonksiyon ile 
	 * sisteme kaydedilecektir.
	 */
	function yazarlik_basvurusu_yap() {
	
		$this->turu = self::TUR_YAZAR;
		
		parent::ekle(array('adi', 'mail', 'uye_olma_zamani', 'turu', 'favori_konulari', 'referanslari'));
	}
	
	// editörlük başvuruları için
	function editorluk_basvurusu_yap() {
	
		$this->turu = self::TUR_EDITOR;
		
		parent::ekle(array('adi', 'mail', 'uye_olma_zamani', 'turu', 'referanslari'));
	}

	function get_detay_for_kullanici_lib() {
	
		return $this->db->select('kullanicilar.*')
						->join('kullanici_oturumlari', 'kullanicilar.id = kullanici_oturumlari.kullanici_id')
						->where('kullanici_oturumlari.oturum_id', $this->oturum_id)
						->where('kullanicilar.turu', $this->turu)
						->limit(1)
						->get('kullanicilar')
						->first_row();
				
	}
	
	function is_var_admin_where_mail_and_sifre() {
		
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		$this->turu = Kullanici::TUR_ADMIN;
		
		return parent::is_var_where_x_and_y_and_z('mail', 'sifre', 'turu');
	}
	
	function is_var_yazar_where_mail_and_sifre() {
		
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		$this->turu = Kullanici::TUR_YAZAR;
		
		return parent::is_var_where_x_and_y_and_z('mail', 'sifre', 'turu');
	}
	
	function is_var_editor_where_mail_and_sifre() {
	
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		$this->turu = Kullanici::TUR_EDITOR;
		
		return parent::is_var_where_x_and_y_and_z('mail', 'sifre', 'turu');
	}
	
	function is_var_yazar_where_id_and_sifre() {
		
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		$this->turu = Kullanici::TUR_YAZAR;
		
		return parent::is_var_where_x_and_y_and_z('id', 'sifre', 'turu');
	}
	
	function is_var_admin_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
		return parent::is_var_where_x_and_y('mail', 'turu');
	}
	
	function is_var_yazar_where_mail() {
	
		$this->turu = Kullanici::TUR_YAZAR;
		return parent::is_var_where_x_and_y('mail', 'turu');
	}
	
	function is_var_editor_where_mail() {
	
		$this->turu = Kullanici::TUR_EDITOR;
		return parent::is_var_where_x_and_y('mail', 'turu');
	}
	
	function is_var_where_id_and_temp() {
	
		return parent::is_var_where_id_and_x('temp');
	}
	
	function is_var_where_id_and_sifre() {
	
		$this->sifre = $this->get_hashed($this->sifre);
		
		return parent::is_var_where_id_and_x('sifre');
	}
	
	function is_onayli_where_id() {
		
		$this->onay = 1;
		return parent::is_var_where_id_and_x('onay');
	}
	
	function get_admin_id_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
		return parent::get_id_where_x_and_y('mail', 'turu');
	}
	
	function get_yazar_id_where_mail() {
	
		$this->turu = Kullanici::TUR_YAZAR;
		return parent::get_id_where_x_and_y('mail', 'turu');
	}
	
	function get_editor_id_where_mail() {
	
		$this->turu = Kullanici::TUR_EDITOR;
		return parent::get_id_where_x_and_y('mail', 'turu');
	}
	
	function get_admin_detay_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
		return parent::get_detay_where_x_and_y('mail', 'turu');
	}
	
	function get_yazar_detay_where_mail() {
	
		$this->turu = Kullanici::TUR_YAZAR;
		return parent::get_detay_where_x_and_y('mail', 'turu');
	}
	
	function get_editor_detay_where_mail() {
	
		$this->turu = Kullanici::TUR_EDITOR;
		return parent::get_detay_where_x_and_y('mail', 'turu');
	}
	
	function guncelle_temp_where_id() {
	
		parent::guncelle_x_where_id('temp');
	}
	
	function guncelle_sifre_where_id() {
	
		$this->sifre = $this->get_hashed($this->sifre);
		
		parent::guncelle_x_where_id('sifre');
	}
	
	function get_rasgele_sifre() {

		return substr($this->get_rasgele_md5(), mt_rand(0, 26), 4);
	}
}