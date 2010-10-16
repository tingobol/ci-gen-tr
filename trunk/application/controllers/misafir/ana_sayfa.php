<?php

class Ana_sayfa extends MY_MisafirKontroller {
	
	function index($sayfa = 1) {
	
		$this->load->model('yazi_mod');
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = AYAR_21;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi_mod->get_adet_1();
		
		$data['yazilar'] = $this->yazi_mod->get_liste_5($this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		// navigasyon için
		$this->load->model('kategori_mod');
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();

		if ($sayfa != 1) $data['meta_baslik'] = AYAR_11 . ' - Sayfa: ' . $sayfa;
		
		$data['icerik'] = $this->smarty->view('misafir/ana_sayfa/liste.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
}