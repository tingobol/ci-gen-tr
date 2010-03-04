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
	
	// yazı eklerken drop down liste için kullanılmaktadır.
	function get_liste_1() {
	
		$items = $this->db
					->select('id, adi')
					->order_by('adi', 'asc')
					->get('kategoriler')
					->result_object();
			
		$return = array(0 => 'Kategori Seçiniz');	
						
		foreach ($items as $item) {
		
			$return[$item->id] = $item->adi;
		}		
		
		return $return;
	}
	
	// misafire sol tarafda kategorilerin bağlantılarını göstermek için
	function get_liste_2() {
	
		return $this->db
					->select('id, adi')
					->order_by('adi', 'asc')
					->get('kategoriler');
	}
	
	function is_var_where_adi() {
	
		return parent::is_var_where_x('adi');
	}
	
	function is_var_where_radi() {
	
		return parent::is_var_where_x('radi');
	}
	
	function is_var_where_adi_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('adi');
	}
	
	function is_var_where_radi_and_not_id() {
	
		return parent::is_var_where_x_and_not_id('radi');
	}
	
	// adminin kategori eklemesi için kullanılmaktadır
	function ekle_1() {
	
		parent::ekle(array('adi', 'radi', 'aciklama', 'arama'));
	}
	
	// adminin kategori güncellemesi için kullanmaktadır
	function guncelle_1() {
	
		$data = array(
					'adi' => $this->adi, 
					'radi' => $this->radi, 
					'aciklama' => $this->aciklama, 
					'arama' => $this->arama);
					
		parent::guncelle_where_id($data);
	}
	
	function reset($reset_id = true) {
	
		/* 
		 * id resetlenmek istemiyorsa, prosedüre false 
		 * parametresi verilerek kullanılmalıdır. 
		 * 
		 * burada amaçlanan şey, düzenleme işlemlerinde 
		 * form gönderildikten sonra bilgi mesajı ekrara 
		 * verildikten sonra tekrar güncelleme formu 
		 * görünecek. hidden olarak saklanacak id bilgisinin 
		 * formda tanımlı olması gerekmektedir. bu yüzden 
		 * id bilgisini burada resetlemiyoruz.
		 */
		if ($reset_id) $this->id = 0;
		
		$this->adi = '';
		$this->radi = '';
		$this->aciklama = '';
		$this->arama = '';
	}
}