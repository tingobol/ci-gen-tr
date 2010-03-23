<?php

class Yazi_etiketleri extends MY_MisafirKontroller {
	
	function Yazi_etiketleri() {
	
		parent::MY_MisafirKontroller();
		
		$this->load->model('etiket');
		$this->load->model('yazi_etiketi');
	}
	
	function yazilari_listele($etiket_id = 0, $sayfa = 1) {
		
		$this->etiket->id = (int) $etiket_id;
		
		if (!$this->etiket->is_var_where_id()) 
			redirect(SAYFA_MISAFIR_11);
			
		$temp_etiket = $this->etiket->get_detay_where_id();	
		
		$this->yazi_etiketi->etiket_id = $this->etiket->id;
			
		$this->load->model('yazi');
		
		$this->load->library('sayfalama_lib');
		
		$this->sayfalama_lib->adet = AYAR_21;
		$this->sayfalama_lib->set_sayfa($sayfa);
		$this->sayfalama_lib->toplam_kayit_sayisi = $this->yazi->get_adet_3($this->yazi_etiketi->etiket_id);
		
		$data['yazilar'] = $this->yazi->get_liste_6($this->yazi_etiketi->etiket_id, $this->sayfalama_lib->adet, $this->sayfalama_lib->get_limit_ilk());
		
		$data['sayfalama_lib'] = $this->sayfalama_lib;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['etiket'] = $temp_etiket;
		
		$data['meta_baslik'] = $temp_etiket->adi;
		$data['meta_aciklama'] = $temp_etiket->adi . ' etiketi ile etiketlenmiş yazıları gösterir.';
		
		if ($sayfa != 1) $data['meta_baslik'] = 'Etiket: ' . $temp_etiket->adi . ' - Sayfa: ' . $sayfa;
		else $data['meta_baslik'] = 'Etiket: ' . $temp_etiket->adi; 
		
		$this->smarty->view('misafir/yazi_etiketleri/yazilari_listele.tpl', $data);
	}
}