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
	
		$this->kategori->id = (int) $id;
		
		if (!$this->kategori->is_var_where_id())
			redirect(SAYFA_MISAFIR_0);
		
		$this->load->model('yazi');
		$this->yazi->kategori_id = $this->kategori->id;
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = 10;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi->get_adet_2();
		
		$data['yazilar'] = $this->yazi->get_liste_4($this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		// $this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['kategori_id'] = $this->yazi->kategori_id;
		
		$this->smarty->view('misafir/kategoriler/yazilari_listele.tpl', $data);
	}
}