<?php

class Kategori extends MY_Model {

	var $tablo_adi = 'kategoriler';

	var $id;
	var $adi;
	var $radi;
	var $aciklama;
	var $arama;
	
	function get_liste_order_by_adi_asc() {
	
		return $this->db->order_by('kategoriler.adi', 'desc')
						->get('kategoriler')
						->result_object();
	}
	
	function is_var_where_adi() {
	
		return parent::is_var_where_x('adi');
	}
	
	function is_var_where_radi() {
	
		return parent::is_var_where_x('radi');
	}
	
	function ekle() {
	
		parent::ekle(array('adi', 'radi', 'aciklama', 'arama'));
	}
	
	function reset() {
	
		$this->id = 0;
		$this->adi = '';
		$this->radi = '';
		$this->aciklama = '';
		$this->arama = '';
	}
}