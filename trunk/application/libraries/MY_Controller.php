<?php

class MY_Controller extends Controller 
{
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
	}
}