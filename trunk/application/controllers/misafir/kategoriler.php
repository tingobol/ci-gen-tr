<?php

class Kategoriler extends MY_MisafirKontroller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('kategori_mod');
	}
	
	/**
	 * Bir kategorideki onaylanmış yazıları listelemek için
	 */
	function yazilari_listele($id = 0, $sayfa = 1) {
	
		$this->load->model('yazi_mod');
		
		$this->kategori_mod->id = (int) $id;
		
		if (!$this->kategori_mod->is_var_where_id())
			redirect(SAYFA_MISAFIR_11);
		
		$temp_kategori = $this->kategori_mod->get_detay_where_id();
			
		$this->yazi_mod->kategori_id = $this->kategori_mod->id;
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = AYAR_21;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi_mod->get_adet_2();
		
		$data['yazilar'] = $this->yazi_mod->get_liste_4($this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		// navigasyon için
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();
		
		$data['kategori'] = $temp_kategori;
		
		if ($sayfa != 1) $data['meta_baslik'] = $temp_kategori->adi . ' - Sayfa: ' . $sayfa;
		else $data['meta_baslik'] = $temp_kategori->adi; 
		
		$data['icerik'] = $this->smarty->view('misafir/kategoriler/yazilari_listele.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
}