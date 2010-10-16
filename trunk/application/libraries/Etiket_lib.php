<?php

class Etiket_lib {
	
	/**
	 * 
	 * Enter description here ...
	 * @var MY_Controller
	 */
	var $CI;

	var $etiketler = array();
	var $etiketler_string = '';
	
	function Etiket_lib() {
	
		$this->CI =& get_instance();
		
		$this->CI->load->model('etiket_mod');
		$this->CI->load->model('yazi_etiketi_mod');
	}
	
	/**
	 * Sisteme yazı eklendiğinde yazıya ait etiketler 
	 * ilgili tablolara yazı ile ilişkilendirilerek 
	 * eklenmektedir. Eğer etiket yazılmadıysa her 
	 * hangi bir işlem yapılmamaktadır.
	 * 
	 * @param int $yazi_id
	 */
	function yazi_eklendi($yazi_id) {
	
		if (empty($this->etiketler_string)) return;
		
		// etiketlerin arası , ile ayrılarak yazılmıştı
		// öncelikli olarak etiketler bir diziye aktarılıyor
		$this->etiketler = explode(',', trim($this->etiketler_string));
		
		// etiketleri tek bir yazı ile ilişkilendireceğimiz 
		// için burada yazı id'sini ilgili değişkenen atıyoruz
		$this->CI->yazi_etiketi_mod->yazi_id = $yazi_id;
		
		// yazarın yazdığı her bir etiket için ekleme işlemi
		for ($i = 0; $i < count($this->etiketler); $i++) {
			
			// etiket adı trimlenerek değişkene atanıyor
			$this->CI->etiket_mod->adi = trim($this->etiketler[$i]);

			// etiket sisteme daha önce eklenmiş ise id numarasını 
			// eğer eklenmemişse, önce ekleyip sonra id numarasını alıyoruz
			$this->CI->yazi_etiketi_mod->etiket_id = $this->CI->etiket_mod->get_id_where_adi_yoksa_ekle();

			// yazı etiketi daha önce eklenmiş mi 
			// burada mükerrer kayıtları engellemiş olacağız
			if (!$this->CI->yazi_etiketi_mod->is_var_where_yazi_id_and_etiket_id()) {
			
				// hayır daha önce eklenmemiş
				
				// yazı etiketi veritabanına ekleniyor
				$this->CI->yazi_etiketi_mod->ekle_1();
			} // else yazmaya gerek kalmadı
		}
	}
	
	/**
	 * yazıya ait yeni etiketler eklenmeden önce sistemdeki 
	 * yazıya ait mevcut etiketler silinecek ve daha sonra 
	 * sanki yeni bir yazı eklenmiş gibi etiketler yeniden 
	 * eklenecektir.
	 * 
	 * @param int $yazi_id
	 */
	function yazi_duzenlendi($yazi_id) {
	
		// yazı etiketi için yazı id numarasını set ediyoruz.
		$this->CI->yazi_etiketi_mod->yazi_id = $yazi_id;
		
		// yazıya ait tüm etiket ilişkilerini sil
		$this->CI->yazi_etiketi_mod->sil_where_yazi_id();
		
		// sanki yeni bir yazı eklenmiş gibi etiketler yeniden ekleniyor
		$this->yazi_eklendi($yazi_id);
	}
	
	// öncelikle yeni girilen etiketler explode edilecek ve bir 
	// temp değişkeninde bekletilecek. düzenlenen yazı id numarasına 
	// göre mevcut etiketler veritabanından alınacak ve bire bir 
	// eşleme yapılacak. yani önce yenilerin içinde eskiler aranacak 
	// sonra eskilerin içinde yeniler aranacak.
	// eğer her iki durumda da bir değişiklik bulunamazsa FALSE dönecek
	function is_etiketler_degisti($yazi_id) {
	
		// mevcut etiketler explode ile bir diziye aktarılıyor
		$exploded_etiketler = explode(',', trim($this->etiketler_string));
		
		$yeni_etiketler = array();
		
		foreach ($exploded_etiketler as $exploded_etiket) 
			$yeni_etiketler[] = trim($exploded_etiket);
		
		// yazının veritabanındaki etiketlerini almak için 
		// yazı id numarası set ediliyor
		$this->CI->yazi_etiketi_mod->yazi_id = $yazi_id;
		
		// veritabanındaki etiketler alınıyor
		$mevcut_etiketler = $this->CI->yazi_etiketi_mod->get_liste_1();
		
		$eski_etiketler = array();
		
		foreach ($mevcut_etiketler->result() as $mevcut_etiket)
			$eski_etiketler[] = $mevcut_etiket->adi;
			
		// bundan sonra $return değişkeninde bir değişiklik 
		// yapılmazsa false olarak dönüş yapılacak
		$return = FALSE;
		
		// yeni etiketlerin içerisinde dönülmeye başlanıyor
		for ($i = 0; $i < count($yeni_etiketler); $i++)
			if (!in_array($yeni_etiketler[$i], $eski_etiketler))
				$return = TRUE;

		// eski etiketlerin içinde dönülmeye başlanıyor
		for ($i = 0; $i < count($eski_etiketler); $i++)
			if (!in_array($eski_etiketler[$i], $yeni_etiketler))
				$return = TRUE;
				
		return $return;
	}
	
	function get_etiket_bulutu() {
	
		$etiketler = $this->CI->yazi_etiketi_mod->get_liste_4();
		
		$return = array();
		
		foreach ($etiketler->result() as $etiket) {

			$return[] = array($etiket->adet, $etiket->adi, sprintf(SAYFA_MISAFIR_51, $etiket->id));
		}
		
		return $return;
	}
}