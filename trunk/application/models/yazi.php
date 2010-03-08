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
	
	// yazarın kategorileri listelemesi için kullanılmaktadır.
	function get_liste_1() {
	
		return $this->db->where('yazar_id', $this->yazar_id)
						->order_by('id', 'desc')
						->get('yazilar')
						->result_object();
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
	 * @param $kategori_id
	 * @return array
	 */
	function get_liste_4($kategori_id, $adet, $limit_ilk) {
	
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('durum', Yazi::DURUM_ONAYLI)
						->where('kategori_id', $kategori_id)
						->order_by('id', 'desc')
						->limit($adet, $limit_ilk)
						->get('yazilar');
	}
	
	function get_liste_5($adet, $limit_ilk) {
	
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get('yazilar');
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
						->get('yazilar')
						->row();
						
		return $ret->adet;
	}
	
	/**
	 * Bir kategoride kaç tane onaylı yazı var?
	 * 
	 * @param int $kategori_id
	 * @return int
	 */
	function get_adet_2($kategori_id) {
	
		$ret = $this->db->select('COUNT(*) AS adet')
						->where('durum', Yazi::DURUM_ONAYLI)
						->where('kategori_id', $kategori_id)
						->get('yazilar')
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
	
	function artir_hit_where_id() {
	
		parent::artir_x_where_id('hit');
	}
}