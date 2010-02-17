<?php

class MY_Model extends Model {
	
	var $oturum_id;
	var $zaman;
	
	var $CI;
	
	function MY_Model() {
	
		parent::Model();
		
		$this->CI =& get_instance();
		
		$this->oturum_id = $this->CI->session->userdata('session_id');
		
		$tarih = getdate();
		$this->zaman = $tarih[0];
	}
	
	function get_detay_where_x($x) {
	
		return $this->db->where($x, $this->$x)
						->get($this->tablo_adi)
						->first_row();
	}
	
	function get_detay_where_id() {
	
		return $this->get_detay_where_x('id');
	}
	
	function get_detay_where_x_and_y($x, $y) {
	
		return $this->db->where($x, $this->$x)
						->where($y, $this->$y)
						->get($this->tablo_adi)
						->first_row();
	}
	
	function is_var_where_x($x) {
	
		return $this->db->where($x, $this->$x)
						->limit(1)
						->get($this->tablo_adi)
						->num_rows() == 1;
	}
	
	function is_var_where_id() {
	
		return $this->is_var_where_x('id');
	}
	
	function is_var_where_x_and_y($x, $y) {
	
		return $this->db->where($x, $this->$x)
						->where($y, $this->$y)
						->get($this->tablo_adi)
						->num_rows() == 1;
	}
	
	function is_var_where_id_and_x($x) {
	
		return $this->is_var_where_x_and_y('id', $x);
	}
	
	function is_var_where_x_and_y_and_z($x, $y, $z) {
	
		return $this->db->where($x, $this->$x)
						->where($y, $this->$y)
						->where($z, $this->$z)
						->get($this->tablo_adi)
						->num_rows() == 1;
	}
	
	function is_var_where_x_and_not_y($x, $y) {
	
		return $this->db->where($x, $this->$x)
						->where($y . ' !=', $this->$y)
						->get($this->tablo_adi)
						->num_rows() == 1;
	}
	
	function is_var_where_x_and_not_id($x) {
	
		return $this->is_var_where_x_and_not_y($x, 'id');
	}
	
	function is_var_where_x_and_y_and_not_z($x, $y, $z) {
	
		return $this->db->where($x, $this->$x)
						->where($y, $this->$y)
						->where($z . ' !=', $this->$z)
						->get($this->tablo_adi)
						->num_rows() == 1;
	}
	
	function is_var_where_x_and_y_and_not_id($x, $y) {
	
		return $this->is_var_where_x_and_y_and_not_z($x, $y, 'id');
	}
	
	function sil_where_x($x) {
	
		$this->db->where($x, $this->$x)
			 	 ->delete($this->tablo_adi);
	}
	
	function sil_where_id() {
	
		$this->sil_where_x('id');
	}
	
	function sil_where_x_and_y($x, $y) {
	
		$this->db->where($x, $this->$x)
				 ->where($y, $this->$y)
				 ->delete($this->tablo_adi);
	}

	function sil_where_x_or_y($x, $y) {
	
		$this->db->where($x, $this->$x)
				 ->or_where($y, $this->$y)
				 ->delete($this->tablo_adi);
	}
	
	function guncelle_where_id($data = array()) {
		
		$this->db->where('id', $this->id)
				 ->update($this->tablo_adi, $data);
	}
	
	function guncelle_x_where_y($x, $y) {
	
		$data = array($x => $this->$x);
		
		$this->db->where($y, $this->$y)
				 ->update($this->tablo_adi, $data);
	}
	
	function guncelle_x_where_id($x) {
	
		$this->guncelle_x_where_y($x, 'id');
	}
	
	function get_x_where_y($x, $y) {
	
		$satir = $this->db->select($x)
						  ->where($y, $this->$y)
						  ->get($this->tablo_adi)
						  ->first_row();
						  
		return $satir->$x;
	}
	
	function get_x_where_id($x) {
	
		return $this->get_x_where_y($x, 'id');
	}
	
	function get_id_where_x($x) {
	
		return $this->get_x_where_y('id', $x);
	}
	
	function get_x_where_y_and_z($x, $y, $z) {
	
		$satir = $this->db->select($x)
						  ->where($y, $this->$y)
						  ->where($z, $this->$z)
						  ->get($this->tablo_adi)
						  ->first_row();
						  
		return $satir->$x;
	}
	
	function get_id_where_x_and_y($x, $y) {
	
		return $this->get_x_where_y_and_z('id', $x, $y);
	}
	
	function ekle($alanlar) {
	
		$data = array();
		foreach ($alanlar as $alan) $data[$alan] = $this->$alan;
		$this->db->insert($this->tablo_adi, $data);
		return $this->insert_id();
	}
	
	function get_rasgele_md5() {
	
		return md5(md5(mt_rand(1111, 9999)) . md5(mt_rand(1111, 9999)) . md5(mt_rand(1111, 99999)));
	}
	
	function get_sifre_as_md5($value) {
	
		return md5(md5($value));
	}
	
	function get_hashed($value) {
	
		return md5(md5($value));
	}
	
	function insert_id() {
	
		return $this->db->insert_id();
	}
}