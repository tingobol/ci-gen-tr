<?php

class Yazi extends MY_Model {

	var $tablo_adi = 'yazilar';

	var $id;
	var $baslik;
	var $rbaslik;
	var $icerik;
	var $eklenme_zamani;
	var $guncellenme_zamani;
	var $hit;
	var $durum;
	var $yazar_id;
	var $kategori_id;
	
	function Yazi() {
	
		parent::MY_Model();
		
		$this->eklenme_zamani = $this->zaman;
		$this->guncellenme_zamani = $this->zaman;
	}
	
	// yazarın kategorileri listelemesi için kullanılmaktadır.
	function get_liste_1() {
	
		return $this->db->where('yazar_id', $this->yazar_id)
						->order_by('id', 'desc')
						->get('yazilar')
						->result_object();
	}
	
	// yazarın yazı eklemesi için kullanılmaktadır
	function ekle_1() {
	
		parent::ekle(array('baslik', 'rbaslik', 'icerik', 'eklenme_zamani', 'guncellenme_zamani', 'yazar_id', 'kategori_id'));
	}
	
	function is_var_where_rbaslik() {
	
		return parent::is_var_where_x('rbaslik');
	}
	
	function is_var_where_id_and_yazar_id() {
	
		return parent::is_var_where_id_and_x('yazar_id');
	}
	
	function is_var_where_rbaslik_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('rbaslik');
	}
	
	function guncelle_1() {
	
		$data = array(
					'baslik' => $this->baslik, 
					'rbaslik' => $this->rbaslik, 
					'icerik' => $this->icerik, 
					'kategori_id' => $this->kategori_id, 
					'guncellenme_zamani' => $this->guncellenme_zamani, 
					'durum' => $this->durum);
					
		parent::guncelle_where_id($data);
	}
	
	/*
	
	function is_var_where_radi() {
	
		return parent::is_var_where_x('radi');
	}
	
	function is_var_where_adi_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('adi');
	}
	
	function is_var_where_radi_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('radi');
	}
	*/
}