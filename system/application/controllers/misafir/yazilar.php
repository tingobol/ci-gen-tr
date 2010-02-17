<?php 

class Yazilar extends MY_MisafirKontroller {

	function Yazilar() {
	
		parent::MY_MisafirKontroller();
		
		$this->load->model('yazi');
	}

	function index() {
	
		redirect(sayfa_misafir_21);
	}
	
	function liste($sayfa = 1) {
	
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		if ($sayfa < 1) 
			$sayfa = 1;
	
		$data['k_t'] = k_t_yeni_gelmis_misafir;
	
		$adet = 10;
		$limit_ilk = $adet * ($sayfa - 1);
		
		$this->load->helper('date');		
		
		$toplam_yazi_sayisi = $this->yazi->get_adet_1();
		
		$yazilar = $this->yazi->get_liste_3($adet, $limit_ilk);
		
		$yazilar_count = count($yazilar);
		
		if ($sayfa == 1) $yeni_yazilar_varmi = FALSE;
		else $yeni_yazilar_varmi = TRUE;
		
		if (($sayfa * $adet) >= $toplam_yazi_sayisi) $eski_yazilar_varmi = FALSE;
		else $eski_yazilar_varmi = TRUE;
		
		$data['yeni_yazilar_varmi'] = $yeni_yazilar_varmi;
		$data['eski_yazilar_varmi'] = $eski_yazilar_varmi;
		
		$data['sayfa'] = $sayfa;
		
		$data['yazilar'] = $yazilar;
		
		$this->load->view('misafir/yazilar/liste', $data);
	}
	
	function detay($id = 0) {
	
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
	
		$this->yazi->id = $id;		
		
		if (!$this->yazi->is_var_where_id()) 
			redirect(sayfa_misafir_21);
			
		$data['yazi'] = $this->yazi->get_detay_where_id();
		
		$this->load->view('misafir/yazilar/detay', $data);
	}
}