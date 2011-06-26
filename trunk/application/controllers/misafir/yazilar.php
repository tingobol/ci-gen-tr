<?php 

class Yazilar extends MY_MisafirKontroller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('yazi_mod');
	}
	
	function detay($id = 0) {

		$this->load->model('yazi_etiketi_mod');
		
		$this->yazi_mod->id = (int) $id;	
		
		// yazı sistemde mevcut değilse ana sayfaya yönlendiriliyor
		if (!$this->yazi_mod->is_var_where_id()) 
			redirect(SAYFA_MISAFIR_11);
			
		// yazının hitini artir
		$this->yazi_mod->artir_hit_where_id();
			
		$temp_yazi = $this->yazi_mod->get_detay_1();
		
		if ($temp_yazi->durum != Yazi_mod::DURUM_ONAYLI) {
			
			// yazının hiti artırılmıştı, tekrar azaltılsın
			$this->yazi_mod->azalt_hit_where_id();
			
			// yazı durumu onaylı olmadığı için ana sayfaya yönlendiriliyor
			redirect(SAYFA_MISAFIR_11);
		}
			
		$this->yazi_etiketi_mod->yazi_id = $this->yazi_mod->id;
		
		
		$data['yazi_etiketleri'] = $this->yazi_etiketi_mod->get_liste_1();
		
		$data['yazi'] = $temp_yazi;
		
		// navigasyon için
		$this->load->model('kategori_mod');
		$data['nav_kategoriler'] = $this->kategori_mod->get_liste_2();
		
		$data['meta_baslik'] = $temp_yazi->baslik;
		
		$data['icerik'] = $this->smarty->view('misafir/yazilar/detay.tpl', $data, TRUE);

		$this->smarty->view( 'misafir/layout1.tpl', $data );
	}
}