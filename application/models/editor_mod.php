<?php

class Editor_mod extends MY_Model {

	var $tablo_adi = 'editorler';
	
	var $id;
	var $adi;
	var $mail;
	var $sifre;
	
	// bu bilgi 32 karakterli rasgele oluşturulmuş bir bilgidir.
	// editör şifresini vs. unuttuğunda doğrulama kodu için
	// bir geçici alan olarak kullanılacaktır.
	var $temp; 
	var $is_onayli;
	var $kayit_zamani;
	
	// extra
	var $referanslari;
	
	// şifremi değiştir sayfası için
	var $eski_sifre;
	var $yeni_sifre;
	var $yeni_sifre_tekrar;
	
	function Editor_mod() {
	
		parent::MY_Model();
		
		$this->kayit_zamani = $this->zaman;
	}
	
	// editörlük başvurusunu eklemek için
	function ekle_1() {
	
		return parent::ekle(array('adi', 'mail', 'referanslari', 'kayit_zamani'));
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