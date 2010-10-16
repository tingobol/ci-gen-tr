<?php

class Admin_mod extends MY_Model {

	var $tablo_adi = 'adminler';
	
	var $id;
	var $adi;
	var $mail;
	var $sifre;
	
	// bu bilgi 32 karakterli rasgele oluşturulmuş bir bilgidir.
	// admin şifresini vs. unuttuğunda doğrulama kodu için
	// bir geçici alan olarak kullanılacaktır.
	var $temp; 
	
	// şifremi değiştir sayfası için
	var $eski_sifre;
	var $yeni_sifre;
	var $yeni_sifre_tekrar;
	
	// adminlere bilgi göndermek için admin listesini verir
	function get_liste_1() {
	
		return $this->db->select('adi, mail')
						->get($this->tablo_adi);
	}
	
	function guncelle_temp_where_id() {
	
		parent::guncelle_x_where_id('temp');
	}
	
	function guncelle_sifre_where_id() {
	
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		
		parent::guncelle_x_where_id('sifre');
	}
	
	function is_var_where_id_and_sifre() {
	
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		
		return parent::is_var_where_id_and_x('sifre');
	}
	
	function is_var_where_id_and_temp() {
	
		return parent::is_var_where_id_and_x('temp');
	}
	
	function is_var_where_mail_and_sifre() {
	
		$this->sifre = $this->get_sifre_as_md5($this->sifre);
		
		return parent::is_var_where_x_and_y('mail', 'sifre');
	}
	
	function is_var_where_mail() {
	
		return parent::is_var_where_x('mail');
	}
	
	function get_id_where_mail() {
	
		return parent::get_id_where_x('mail');
	}
	
	function get_is_onayli_where_id() {
	
		return parent::get_x_where_id('is_onayli');
	}
}