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
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = 10;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi->get_adet_1();
		
		$data['yazilar'] = $this->yazi->get_liste_5($this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$this->smarty->view('misafir/yazilar/liste.tpl', $data);
	}
	
	function detay($id = 0) {

		$this->load->model('yazi_etiketi');
		
		$this->yazi->id = (int) $id;		
		
		if (!$this->yazi->is_var_where_id()) 
			redirect(SAYFA_MISAFIR_21);
			
		$temp_yazi = $this->yazi->get_detay_1();
		
		if ($temp_yazi->durum != Yazi::DURUM_ONAYLI) 
			redirect(SAYFA_MISAFIR_21);
			
		// yazının hitini artir
		$this->yazi->artir_hit_where_id();
			
		$this->yazi_etiketi->yazi_id = $temp_yazi->id;
		$temp_yazi_etiketleri = $this->yazi_etiketi->get_liste_1();
		
		$data['yazi'] = $temp_yazi;
		$data['yazi_etiketleri'] = $temp_yazi_etiketleri;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$this->smarty->view('misafir/yazilar/detay.tpl', $data);
	}
}