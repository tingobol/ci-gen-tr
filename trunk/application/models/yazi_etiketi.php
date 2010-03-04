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
	
		return $this->db->select('etiketler.id, etiketler.adi')
						->join('yazi_etiketleri', 'etiketler.id = yazi_etiketleri.etiket_id')
						->where('yazi_etiketleri.yazi_id', $this->yazi_id)
						->order_by('etiketler.adi', 'ASC')
						->get('etiketler')
						->result_object();
	}
	
	function get_liste_2() {
	
		return $this->db->select('etiketler.id, etiketler.adi')
						->join('yazi_etiketleri', 'etiketler.id = yazi_etiketleri.etiket_id')
						->where('yazi_etiketleri.yazi_id', $this->yazi_id)
						->order_by('etiketler.adi', 'ASC')
						->get('etiketler');
	}
}