<?php 

class Yazilar extends MY_MisafirKontroller {
	
	function Yazilar() {
	
		parent::MY_MisafirKontroller();
		
		$this->load->model('yazi');
	}
	
	function detay($kategori_id = 0, $yazi_id = 0) {

		$this->load->model('yazi_etiketi');
		
		$this->yazi->kategori_id = (int) $kategori_id;
		$this->yazi->id = (int) $yazi_id;	
		
		// yazı sistemde mevcut değilse ana sayfaya yönlendiriliyor
		if (!$this->yazi->is_var_where_id_and_kategori_id()) 
			redirect(SAYFA_MISAFIR_11);
			
		// yazının hitini artir
		$this->yazi->artir_hit_where_id();
			
		$temp_yazi = $this->yazi->get_detay_1();
		
		if ($temp_yazi->durum != SABIT_YAZI_DURUM_ONAYLI) {
			
			// yazının hiti artırılmıştı, tekrar azaltılsın
			$this->yazi->azalt_hit_where_id();
			
			// yazı durumu onaylı olmadığı için ana sayfaya yönlendiriliyor
			redirect(SAYFA_MISAFIR_11);
		}
			
		$this->yazi_etiketi->yazi_id = $temp_yazi->id;
		$temp_yazi_etiketleri = $this->yazi_etiketi->get_liste_1();
		
		$data['yazi'] = $temp_yazi;
		$data['yazi_etiketleri'] = $temp_yazi_etiketleri;
		
		$data['k_t'] = k_t_yeni_gelmis_misafir;
		
		// navigasyon için
		$this->load->model('kategori');
		$data['nav_kategoriler'] = $this->kategori->get_liste_2();
		
		$data['meta_baslik'] = $temp_yazi->baslik;
		
		$this->smarty->view('misafir/yazilar/detay.tpl', $data);
	}
}