<?php 

class Yazi_etiketi extends MY_Model {

	var $tablo_adi = 'yazi_etiketleri';

	var $yazi_id;
	var $etiket_id;
	
	/**
	 * Bir yazı ile etiketi ilişkilendirmek için 
	 * ilgili tabloya ekleme yapılıyor
	 * @see system/application/libraries/MY_Model#ekle($alanlar)
	 */
	function ekle() {
	
		parent::ekle(array(
						'yazi_id', 
						'etiket_id'));
	}
	
	// ilişkilendirilmiş yazı etiketlerini yazı id numarasına göre temizler
	function sil_where_yazi_id() { 
	
		parent::sil_where_x('yazi_id');
	}
	
	// bir yazıya ait etiketlerin listesini verir.
	function get_liste_1() {
	
		if (empty($this->yazi_id)) throw new Exception('Yazı Id boş geçilemez.');
		
		return $this->db->select('etiketler.*')
						->join('yazi_etiketleri', 'etiketler.id = yazi_etiketleri.etiket_id')
						->where('yazi_etiketleri.yazi_id', $this->yazi_id)
						->order_by('etiketler.adi', 'ASC')
						->get('etiketler');
	}
	
	/**
	 * Bir yazıya ait etiketlerin listesini verir.
	 */
	function get_liste_2() {
	
		if (empty($this->yazi_id)) throw new Exception('Yazı Id boş geçilemez.');
		
		return $this->db->select('etiketler.id, etiketler.adi')
						->join('yazi_etiketleri', 'etiketler.id = yazi_etiketleri.etiket_id')
						->where('yazi_etiketleri.yazi_id', $this->yazi_id)
						->order_by('etiketler.adi', 'ASC')
						->get('etiketler');
	}
	
	function get_liste_3() {
	
		return $this->db->select('yazilar.*, kategoriler.adi AS kategori_adi')
						->join('kategoriler', 'yazilar.kategori_id = kategoriler.id')
						->join('yazi_etiketleri', 'yazilar.')
						->where('yazilar.durum', Yazi::DURUM_ONAYLI)
						->where('yazi_etiketleri.etiket_id', $this->etiket_id)
						->order_by('yazilar.id', 'desc')
						->limit($adet, $limit_ilk)
						->get('yazilar');
	}
}