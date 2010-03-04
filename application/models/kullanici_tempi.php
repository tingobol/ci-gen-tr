<?php

class Kullanici_tempi extends MY_Model {

	var $tablo_adi = 'kullanici_templeri';

	var $kullanici_id;
	var $temp;
	
	function is_var_where_temp() {
	
		return parent::is_var_where_x('temp');
	}
	
	function is_var_where_kullanici_id_and_temp() {
	
		return parent::is_var_where_x_and_y('kullanici_id', 'temp');
	}
	
	function ekle_1() {
	
		return parent::ekle(array('kullanici_id', 'temp', 'zaman'));
	}
	
	function sil_where_temp() {
	
		parent::sil_where_x('temp');
	}
}