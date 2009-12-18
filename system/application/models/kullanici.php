<?php

class Kullanici extends MY_Model {

	var $tablo_adi = 'kullanicilar';

	var $id;
	var $adi;
	var $mail;
	var $sifre;
	var $temp;
	var $onay;
	var $uye_olma_zamani;
	var $turu;
	
	const TUR_MISAFIR = 0;
	const TUR_EDITOR = 1;
	const TUR_YAZAR = 10;
	const TUR_ADMIN = 100;

	function Kullanici() {
	
		parent::MY_Model();
		
		$this->uye_olma_zamani = $this->zaman;
	}

	function get_detay_for_kullanici_lib() {
	
		return $this->db->select('kullanicilar.*')
						->join('kullanici_oturumlari', 'kullanicilar.id = kullanici_oturumlari.kullanici_id')
						->where('kullanici_oturumlari.oturum_id', $this->oturum_id)
						->limit(1)
						->get('kullanicilar')
						->first_row();
				
	}
	
	function is_var_admin_where_mail_and_sifre() {
		
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		$this->turu = Kullanici::TUR_ADMIN;
		
		return parent::is_var_where_x_and_y_and_z('mail', 'sifre', 'turu');
	}
	
	function is_var_admin_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
		return parent::is_var_where_x_and_y('mail', 'turu');
	}
	
	function is_var_where_id_and_temp() {
	
		return parent::is_var_where_id_and_x('temp');
	}
	
	function get_admin_id_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
		return parent::get_id_where_x_and_y('mail', 'turu');
	}
	
	function get_admin_detay_where_mail() {
	
		$this->turu = Kullanici::TUR_ADMIN;
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