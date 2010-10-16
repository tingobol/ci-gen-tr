<?php

class MY_Controller extends Controller 
{
	/**
	 * 
	 * @var CI_Smarty
	 */
	var $smarty;
	
	/**
	 * 
	 * Enter description here ...
	 * @var CI_Loader
	 */
	var $load;
	
	/**
	 * 
	 * Enter description here ...
	 * @var CI_Input
	 */
	var $input;
	
	/**
	 * 
	 * Enter description here ...
	 * @var CI_Session
	 */
	var $session;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Admin_lib
	 */
	var $admin_lib;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Admin_mod
	 */
	var $admin_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Editor_lib
	 */
	var $editor_lib;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Editor_mod
	 */
	var $editor_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Yazar_lib
	 */
	var $yazar_lib;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Yazar_mod
	 */
	var $yazar_mod;
	
	/**
	 * 
	 * @var Iletisim_konusu_mod
	 */
	var $iletisim_konusu_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Iletisim_mesaji_mod
	 */
	var $iletisim_mesaji_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Etiket_mod
	 */
	var $etiket_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Etiket_lib
	 */
	var $etiket_lib;
	
	/**
	 * 
	 * @var Yazi_etiketi_mod
	 */
	var $yazi_etiketi_mod;
	
	/**
	 * 
	 * @var Yazi_mod
	 */
	var $yazi_mod;
	
	/**
	 * 
	 * @var Sayfalama_lib
	 */
	var $sayfalama_lib;
	
	/**
	 * 
	 * @var Kategori_mod
	 */
	var $kategori_mod;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Kategori_lib
	 */
	var $kategori_lib;
	
	function MY_Controller($profiler = TRUE) 
	{
		parent::Controller();

		if (LOCAL) $this->output->enable_profiler($profiler);
	}
}

class MY_KullaniciKontroller extends MY_Controller {

	function MY_KullaniciKontroller() {
	
		parent::MY_Controller();

		// $this->load->model('kullanici');
		// $this->load->model('kullanici_oturumu');
		
		// $this->load->library('kullanici_lib');
		
		// Metaları Ayarla
		$this->smarty->assign('meta_baslik', AYAR_11);
		$this->smarty->assign('meta_aciklama', AYAR_12);
		$this->smarty->assign('meta_arama', AYAR_13);
	}
}

class MY_AdminKontroller extends MY_KullaniciKontroller {

	function MY_AdminKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		// gerekli kütüphaneler
		$this->load->library('admin_lib');
		
		// gerekli modeller
		$this->load->model('admin_mod');
	}
}

class MY_YazarKontroller extends MY_KullaniciKontroller {

	function MY_YazarKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		// gerekli kütüphaneler
		$this->load->library('yazar_lib');
		
		// gerekli modeller
		$this->load->model('yazar_mod');
	}
}

class MY_EditorKontroller extends MY_KullaniciKontroller {

	function MY_EditorKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		// gerekli kütüphaneler
		$this->load->library('editor_lib');
		
		// gerekli modeller
		$this->load->model('editor_mod');
	}
}

class MY_MisafirKontroller extends MY_KullaniciKontroller {

	function MY_MisafirKontroller() {
	
		parent::MY_KullaniciKontroller();
		
		$this->load->library('Etiket_lib');
		$this->load->library('taggly');
		
		$this->smarty->assign('etiket_bulutu', $this->taggly->cloud($this->etiket_lib->get_etiket_bulutu()));
	}
}