<?php

class Etiket_lib {

	var $CI;

	var $etiketler = array();
	var $etiketler_string = '';
	
	function Etiket_lib() {
	
		$this->CI =& get_instance();
		
		$this->CI->load->model('etiket');
		$this->CI->load->model('yazi_etiketi');
	}
	
	function yazi_eklendi($yazi_id) {
	
		$this->etiketler = explode(',', trim($this->etiketler_string));
		
		$this->CI->yazi_etiketi->yazi_id = $yazi_id;
		
		for ($i = 0; $i < count($this->etiketler); $i++) {
			
			$this->CI->etiket->adi = trim($this->etiketler[$i]);

			$this->CI->yazi_etiketi->etiket_id = $this->CI->etiket->get_id_where_adi_yoksa_ekle();

			$this->CI->yazi_etiketi->ekle();
		}
	}
	
	// öncelikle yeni girilen etiketler explode edilecek ve bir 
	// temp değişkeninde bekletilecek. düzenlenen yazı id numarasına 
	// göre mevcut etiketler veritabanından alınacak ve bire bir 
	// eşleme yapılacak. yani önce yenilerin içinde eskiler aranacak 
	// sonra eskilerin içinde yeniler aranacak.
	// eğer her iki durumda da bir değişiklik bulunamazsa FALSE dönecek
	function is_etiketler_degisti($yazi_id) {
	
		$exploded_etiketler = explode(',', trim($this->etiketler_string));
		
		$this->yazi_etiketi->yazi_id = $yazi_id;
		
		$mevcut_etiketler = $this->yazi_etiketi->get_liste_1();
		
		$eski_etiketler = array();
		
		foreach ($mevcut_etiketler as $mevcut_etiket)
			$eski_etiketler[] = $mevcut_etiketler->adi;
			
		// diziler arasında eşleme yapılacak
	}
}