<?php

class Yazi_mod extends MY_Model {

	var $tablo_adi = 'yazilar';

	var $id;
	var $baslik;
	var $ozet;
	var $icerik;
	var $eklenme_zamani;
	var $guncellenme_zamani;
	var $hit;
	var $durum;
	var $yazar_id;
	var $kategori_id;
	
	const DURUM_EDITOR_KONTROL_EDECEK = 0;
	const DURUM_ONAYLI = 1;
	const DURUM_YAYINDAN_KALKMIS = 2;
	const DURUM_ADMIN_KONTROL_EDECEK = 3;
	const DURUM_YAZAR_KONTROL_EDECEK = 4;
	
	function Yazi_mod() {
	
		parent::MY_Model();
		
		$this->eklenme_zamani = $this->zaman;
		$this->guncellenme_zamani = $this->zaman;
	}
	
	function get_durum_as_yazi1($durum = 0) {
	
		if ($durum == self::DURUM_EDITOR_KONTROL_EDECEK) return 'Onay Bekliyor';
		if ($durum == self::DURUM_ONAYLI) return 'Onaylı';
		if ($durum == self::DURUM_YAYINDAN_KALKMIS) return 'Yayından Kalkmış';
		if ($durum == self::DURUM_ADMIN_KONTROL_EDECEK) return 'Admin Kontrol Edecek';
		if ($durum == self::DURUM_YAZAR_KONTROL_EDECEK) return 'Yazar Kontrol Edecek';
		 
		// buraya kadar gelebilirse sistemde sıkıntı var demektir.
		throw new Exception('Sistemde ciddi bir sorun var. Lütfen hatayı yönetime bildiriniz. Dosya: ' . __FILE__ . ', Satır: ' . __LINE__);
	}
	
	// yazı detay sayfasında yazıyı göstermek için
	function get_detay_1() {
	
		return $this->db->select('
							yazilar.*,
							kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.id', $this->id)
						->get($this->tablo_adi)
						->first_row();
	}
	
	// id bilgisine göre yazının detayını verir
	function get_detay_2() {
	
		return $this->db->select('
							yazilar.*,
							kategoriler.adi AS kategori_adi, 
							yazarlar.adi AS yazar_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->join('yazarlar', 'yazilar.yazar_id = yazarlar.id')
						->where('yazilar.id', $this->id)
						->get($this->tablo_adi)
						->first_row();
	}
	
	function get_liste_1() {
	
		if (empty($this->yazar_id)) throw new Exception('Yazar Id boş geçilemez.');
		
		return $this->db->where('yazar_id', $this->yazar_id)
						->order_by('id', 'desc')
						->get($this->tablo_adi);
	}
	
	function get_liste_2() {
	
		return $this->db->where('durum', Yazi_mod::DURUM_ONAYLI)
						->order_by('id', 'desc')
						->limit(10)
						->get('yazilar')
						->result_object();
	}
	
	// misafir/yazilar/liste
	function get_liste_3($adet, $limit_ilk) {
	
		return $this->db->where('durum', Yazi_mod::DURUM_ONAYLI)
						->order_by('id', 'desc')
						->limit($adet, $limit_ilk)
						->get('yazilar')
						->result_object();
	}
	
	/**
	 * Bir kategorideki onaylı yazıların listesini verir
	 *  
	 * @return array
	 */
	function get_liste_4($adet, $limit_ilk) {
	
		if (empty($this->kategori_id)) throw new Exception('Kategori Id boş geçilemez.');
		
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi_mod::DURUM_ONAYLI)
						->where('yazilar.kategori_id', $this->kategori_id)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get($this->tablo_adi);
	}
	
	/**
	 * Onaylanmış yazıların listesini verir.
	 * 
	 * @param int $adet
	 * @param int $limit_ilk
	 */
	function get_liste_5($adet, $limit_ilk) {
	
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi_mod::DURUM_ONAYLI)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get($this->tablo_adi);
	}
	
	function get_liste_6($etiket_id, $adet, $limit_ilk) {
		
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('yazi_etiketleri', 'yazi_etiketleri.yazi_id = yazilar.id')
						->join('etiketler', 'yazi_etiketleri.etiket_id = etiketler.id')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi_mod::DURUM_ONAYLI)
						->where('yazi_etiketleri.etiket_id', $etiket_id)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get($this->tablo_adi);
	}
	
	// editörün kontrol edeceği yazıların listesini verir.
	function get_liste_7() {
		
		return $this->db->select('
							yazilar.id, 
							yazilar.baslik, 
							kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi_mod::DURUM_EDITOR_KONTROL_EDECEK)
						->order_by('yazilar.id', 'ASC')
						->get($this->tablo_adi);
	}
	
	function get_liste_8() {
	
		return $this->db->select('
							yazilar.id, 
							yazilar.baslik, 
							kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', SABIT_YAZI_DURUM_ADMIN_KONTROL_EDECEK)
						->order_by('yazilar.id', 'ASC')
						->get($this->tablo_adi);
	}

	// kaç tane onaylı yazı var
	function get_adet_1() {
	
		$ret = $this->db->select('COUNT(*) AS adet')
						->where('durum', Yazi_mod::DURUM_ONAYLI)
						->get($this->tablo_adi)
						->row();
						
		return $ret->adet;
	}
	
	// kategorideki onaylı yazı sayısını verir
	function get_adet_2() {
	
		if (empty($this->kategori_id)) throw new Exception('Kategori Id boş geçilemez.');
		
		$ret = $this->db->select('COUNT(*) AS adet')
						->where('durum', Yazi_mod::DURUM_ONAYLI)
						->where('kategori_id', $this->kategori_id)
						->get($this->tablo_adi)
						->row();
						
		return $ret->adet;
	}
	
	/**
	 * $etiket_id ile etiketli onaylanmış yazıların adetini verir.
	 * 
	 * @param int $etiket_id
	 */
	function get_adet_3($etiket_id) {
	
		$ret = $this->db->select('COUNT(yazilar.id) AS adet')
						->join('yazi_etiketleri', 'yazi_etiketleri.yazi_id = yazilar.id')
						->join('etiketler', 'yazi_etiketleri.etiket_id = etiketler.id')
						->where('yazilar.durum', Yazi_mod::DURUM_ONAYLI)
						->where('yazi_etiketleri.etiket_id', $etiket_id)
						->get($this->tablo_adi)
						->row();
						
		return $ret->adet;
	}
	
	function get_durum_where_id() {
	
		return parent::get_x_where_id('durum');
	}
	
	function get_yazar_id_where_id() {
	
		return (int) parent::get_x_where_id('yazar_id');
	}
	
	// yazarın yazı eklemesi için kullanılmaktadır
	function ekle_1() {
	
		return parent::ekle(array(
								'baslik', 
								'ozet', 
								'icerik', 
								'eklenme_zamani', 
								'guncellenme_zamani', 
								'yazar_id', 
								'kategori_id'));
	}
	
	function is_var_where_id_and_yazar_id() {
	
		return parent::is_var_where_id_and_x('yazar_id');
	}
	
	function is_var_where_id_and_kategori_id() {
	
		return parent::is_var_where_id_and_x('kategori_id');
	}
	
	function is_var_where_kategori_id() {
	
		return parent::is_var_where_x('kategori_id');
	}
	
	// yazar kendi yazısına ait yazıyı güncellemek istediğinde
	function guncelle_1() {
	
		$data = array(
					'baslik' => $this->baslik,  
					'ozet' => $this->ozet, 
					'icerik' => $this->icerik, 
					'kategori_id' => $this->kategori_id, 
					'guncellenme_zamani' => $this->guncellenme_zamani, 
					'durum' => $this->durum);
					
		parent::guncelle_where_id($data);
	}
	
	function guncelle_durum_where_id() {
	
		parent::guncelle_x_where_id('durum');
	}
	
	function artir_hit_where_id() { parent::artir_x_where_id('hit'); }
	function azalt_hit_where_id() { parent::azalt_x_where_id('hit'); }
}