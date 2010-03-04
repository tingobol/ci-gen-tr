<?php

class Kategoriler extends MY_MisafirKontroller {

	function Kategoriler() {
	
		parent::MY_MisafirKontroller();
		
		$this->load->model('kategori');
	}
	
	/**
	 * Bir kategorideki onaylanmış yazıları listelemek için
	 * 
	 * @param int $id
	 */
	function yazilari_listele($id, $sayfa = 1) {
	
		// navigasyon için
		// $this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		if ($sayfa < 1) 
			$sayfa = 1;
	
		$data['k_t'] = k_t_yeni_gelmis_misafir;
	
		$adet = 10;
		$limit_ilk = $adet * ($sayfa - 1);
		
		$this->load->helper('date');
		
		$this->load->model('yazi');
		$toplam_yazi_sayisi = $this->yazi->get_adet_2($id);
		
		$yazilar = $this->yazi->get_liste_4($id, $adet, $limit_ilk);
		
		$yazilar_count = count($yazilar);
		
		if ($sayfa == 1) $yeni_yazilar_varmi = FALSE;
		else $yeni_yazilar_varmi = TRUE;
		
		if (($sayfa * $adet) >= $toplam_yazi_sayisi) $eski_yazilar_varmi = FALSE;
		else $eski_yazilar_varmi = TRUE;
		
		$data['yeni_yazilar_varmi'] = $yeni_yazilar_varmi;
		$data['eski_yazilar_varmi'] = $eski_yazilar_varmi;
		
		$data['sayfa'] = $sayfa;
		
		$data['yazilar'] = $yazilar;
		
		$data['kategori_id'] = $id;
		
		$this->load->view('misafir/kategoriler/yazilari_listele', $data);
	}
}