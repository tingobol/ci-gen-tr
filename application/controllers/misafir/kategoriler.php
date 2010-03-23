<?php

class Kategoriler extends MY_MisafirKontroller {

	function Kategoriler() {
	
		parent::MY_MisafirKontroller();
		
		$this->load->model('kategori');
	}
	
	/**
	 * Bir kategorideki onaylanmış yazıları listelemek için
	 */
	function yazilari_listele($id = 0, $sayfa = 1) {
	
		$this->load->model('yazi');
		
		$this->kategori->id = (int) $id;
		
		if (!$this->kategori->is_var_where_id())
			redirect(SAYFA_MISAFIR_11);
		
		$temp_kategori = $this->kategori->get_detay_where_id();
			
		$this->yazi->kategori_id = $temp_kategori->id;
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = AYAR_21;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi->get_adet_2();
		
		$data['yazilar'] = $this->yazi->get_liste_4($this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		// $this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['kategori'] = $temp_kategori;
		
		if ($sayfa != 1) $data['meta_baslik'] = $temp_kategori->adi . ' - Sayfa: ' . $sayfa;
		else $data['meta_baslik'] = $temp_kategori->adi; 
		
		$this->smarty->view('misafir/kategoriler/yazilari_listele.tpl', $data);
	}
}