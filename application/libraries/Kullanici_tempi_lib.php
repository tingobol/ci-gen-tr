<?php

class Kullanici_tempi_lib {

	var $CI;
	
	function Kullanici_tempi_lib() {
	
		$this->CI =& get_instance();
		
		$this->CI->load->model('kullanici_tempi');
	}
	
	/**
	 * Kullanıcı için yeni bir unique temp kaydeder ve kaydettiği tempi geri verir.
	 * 
	 * @param int $kullanici_id
	 * @return char[32]
	 */
	function yeni_temp_kaydet($kullanici_id) {
	
		$this->CI->kullanici_tempi->kullanici_id = $kullanici_id;
		
		$tarih = getdate();
		$this->CI->kullanici_tempi->zaman = $tarih[0];
		
		do {
		
			$this->CI->kullanici_tempi->temp = $this->get_rasgele_md5();
		} while ($this->CI->kullanici_tempi->is_var_where_temp());
		
		$this->CI->kullanici_tempi->ekle_1();
		
		return $this->CI->kullanici_tempi->temp;
	}
	
	/**
	 * Rasgele 32 karakter hash kodu verir
	 * 
	 * @return char[32]
	 */
	function get_rasgele_md5() {
	
		return md5(md5(mt_rand(1111, 9999)) . md5(mt_rand(1111, 9999)) . md5(mt_rand(1111, 99999)));
	}
}