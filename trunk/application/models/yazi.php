<?php

class Yazi extends MY_Model {

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
	
	const DURUM_ONAY_BEKLIYOR = 0;
	const DURUM_ONAYLI = 1;
	const DURUM_YAYINDAN_KALKMIS = 2;
	
	function Yazi() {
	
		parent::MY_Model();
		
		$this->eklenme_zamani = $this->zaman;
		$this->guncellenme_zamani = $this->zaman;
	}
	
	function get_detay_1() {
	
		return $this->db->select('
							yazilar.*,
							kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
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
	
		return $this->db->where('durum', Yazi::DURUM_ONAYLI)
						->order_by('id', 'desc')
						->limit(10)
						->get('yazilar')
						->result_object();
	}
	
	// misafir/yazilar/liste
	function get_liste_3($adet, $limit_ilk) {
	
		return $this->db->where('durum', Yazi::DURUM_ONAYLI)
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
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
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
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get($this->tablo_adi);
	}
	
	function get_liste_6($etiket_id, $adet, $limit_ilk) {
		
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('yazi_etiketleri', 'yazi_etiketleri.yazi_id = yazilar.id')
						->join('etiketler', 'yazi_etiketleri.etiket_id = etiketler.id')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
						->where('yazi_etiketleri.etiket_id', $etiket_id)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get($this->tablo_adi);
	}

	/**
	 * Onaylı yazıların kaç tane olduğunu verir.
	 * 
	 * @see misafir/yazilar/liste
	 * @return int
	 */
	function get_adet_1() {
	
		$ret = $this->db->select('COUNT(*) AS adet')
						->where('durum', Yazi::DURUM_ONAYLI)
						->get($this->tablo_adi)
						->row();
						
		return $ret->adet;
	}
	
	/**
	 * Bir kategoride kaç tane onaylı yazı var?
	 * 
	 * @return int
	 */
	function get_adet_2() {
	
		if (empty($this->kategori_id)) throw new Exception('Kategori Id boş geçilemez.');
		
		$ret = $this->db->select('COUNT(*) AS adet')
						->where('durum', Yazi::DURUM_ONAYLI)
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
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
						->where('yazi_etiketleri.etiket_id', $etiket_id)
						->get($this->tablo_adi)
						->row();
						
		return $ret->adet;
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
	
	function artir_hit_where_id() { parent::artir_x_where_id('hit'); }
	function azalt_hit_where_id() { parent::azalt_x_where_id('hit'); }
}