<?php

class Yazi_etiketleri extends MY_MisafirKontroller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('etiket_mod');
		$this->load->model('yazi_etiketi_mod');
	}
	
	function yazilari_listele($etiket_id = 0, $sayfa = 1) {
		
		$this->etiket_mod->id = (int) $etiket_id;
		
		if (!$this->etiket_mod->is_var_where_id()) 
			redirect(SAYFA_MISAFIR_11);
			
		$temp_etiket = $this->etiket_mod->get_detay_where_id();	
		
		$this->yazi_etiketi_mod->etiket_id = $this->etiket_mod->id;
			
		$this->load->model('yazi_mod');
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = AYAR_21;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi_mod->get_adet_3($this->yazi_etiketi_mod->etiket_id);
		
		$data['yazilar'] = $this->yazi_mod->get_liste_6($this->yazi_etiketi_mod->etiket_id, $this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		// navigasyon için
		$this->load->model('kategori_mod');
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();
		
		$data['etiket'] = $temp_etiket;
		
		$data['meta_baslik'] = $temp_etiket->adi;
		$data['meta_aciklama'] = $temp_etiket->adi . ' etiketi ile etiketlenmiş yazıları gösterir.';
		
		if ($sayfa != 1) $data['meta_baslik'] = 'Etiket: ' . $temp_etiket->adi . ' - Sayfa: ' . $sayfa;
		else $data['meta_baslik'] = 'Etiket: ' . $temp_etiket->adi; 
		
		$data['icerik'] = $this->smarty->view('misafir/yazi_etiketleri/yazilari_listele.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
}