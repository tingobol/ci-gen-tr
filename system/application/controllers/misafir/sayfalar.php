<?php

class Sayfalar extends MY_MisafirKontroller {

	function Sayfalar() {
	
		parent::MY_MisafirKontroller();
	}
	
	function iletisim() {
	
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		$this->load->view('misafir/sayfalar/iletisim', $data);
	}
}