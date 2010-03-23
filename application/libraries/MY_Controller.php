<?php

class MY_Controller extends Controller 
{
	/**
	 * 
	 * @var Kullanici
	 */
	var $yazar;
	
	/**
	 * 
	 * @var Kullanici_lib
	 */
	var $kullanici_lib;
	
	/**
	 * 
	 * @var CI_Smarty
	 */
	var $smarty;
	
	/**
	 * 
	 * @var Kullanici
	 */
	var $kullanici;
	
	/**
	 * 
	 * @var Iletisim_konusu
	 */
	var $iletisim_konusu;
	
	/**
	 * 
	 * @var Yazi_etiketi
	 */
	var $yazi_etiketi;
	
	/**
	 * 
	 * @var Yazi
	 */
	var $yazi;
	
	/**
	 * 
	 * @var Sayfalama_lib
	 */
	var $sayfalama_lib;
	
	/**
	 * 
	 * @var Kategori
	 */
	var $kategori;
	
	/**
	 * 
	 * @var Kullanici_tempi_lib
	 */
	var $kullanici_tempi_lib;
	
	function MY_Controller() 
	{
		parent::Controller();

		if (LOCAL) $this->output->enable_profiler(TRUE);
	}
}

class MY_KullaniciKontroller extends MY_Controller {

	function MY_KullaniciKontroller() {
	
		parent::MY_Controller();

		$this->load->model('kullanici');
		$this->load->model('kullanici_oturumu');
		
		$this->load->library('kullanici_lib');
		
		// Metaları Ayarla
		$this->smarty->assign('meta_baslik', AYAR_11);
		$this->smarty->assign('meta_aciklama', AYAR_12);
		$this->smarty->assign('meta_arama', AYAR_13);
	}
}

class MY_AdminKontroller extends MY_KullaniciKontroller {

	function MY_AdminKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		$this->kullanici_lib->init(Kullanici::TUR_ADMIN);
	}
}

class MY_YazarKontroller extends MY_KullaniciKontroller {

	function MY_YazarKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		$this->kullanici_lib->init(Kullanici::TUR_YAZAR);
	}
}

class MY_EditorKontroller extends MY_KullaniciKontroller {

	function MY_EditorKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		$this->kullanici_lib->init(Kullanici::TUR_EDITOR);
	}
}
class MY_MisafirKontroller extends MY_KullaniciKontroller {

	function MY_MisafirKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		$this->load->library('Etiket_lib');
		$this->load->library('taggly');
		
		$this->smarty->assign('etiket_bulutu', $this->taggly->cloud($this->etiket_lib->get_etiket_bulutu()));
		
		$this->smarty->assign('k_t', k_t_yeni_gelmis_misafir);
	}
}