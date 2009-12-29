<?php

class MY_Controller extends Controller 
{
	function MY_Controller() 
	{
		parent::Controller();

		$this->output->enable_profiler(TRUE);
	}
}

class MY_KullaniciKontroller extends MY_Controller {

	function MY_KullaniciKontroller() {
	
		parent::MY_Controller();

		$this->load->model('kullanici');
		$this->load->model('kullanici_oturumu');
		
		$this->load->library('kullanici_lib');
		
		$this->kullanici_lib->init();
	}
}

class MY_AdminKontroller extends MY_KullaniciKontroller {

	function MY_AdminKontroller() {
	
		parent::MY_KullaniciKontroller();
	}
}

class MY_YazarKontroller extends MY_KullaniciKontroller {

	function MY_YazarKontroller() {
	
		parent::MY_KullaniciKontroller();
	}
}

class MY_EditorKontroller extends MY_KullaniciKontroller {

	function MY_EditorKontroller() {
	
		parent::MY_KullaniciKontroller();
	}
}

class MY_MisafirKontroller extends MY_Controller
{
	function MY_MisafirKontroller() 
	{
		parent::MY_Controller();
		
		// header init
		$this->init_header();
		
		// sidebar init
		$this->init_sidebar();
	}
	
	function init_header() 
	{
		// set title
		$this->template->write('title', 'Bulsam.Net Blog');
	}
	
	function init_sidebar() 
	{
		// hoşgeldiniz
		$this->template->write_view('sidebar_hosgeldiniz', 'misafir/sidebar/hosgeldiniz');
		
		// kategoriler
		$this->load->model('vt/kategori');
		$data['kategoriler'] = $this->kategori->get_liste();
		$this->template->write_view('sidebar_kategoriler', 'misafir/sidebar/kategoriler', $data);
	}
}

class MY_AdminController extends MY_Controller
{
	function MY_AdminController() 
	{
		parent::MY_Controller();
		
		$this->load->library('admin_lib');
		
		$this->load->model('admin');
		$this->load->model('admin_oturumu');
		
		$this->admin_lib->init($this->admin, $this->admin_oturumu);
		
		// header init
		$this->init_header();
		
		// sidebar init
		$this->init_sidebar();
	}
	
	function init_header() 
	{
		// set title
		$this->template->write('title', 'Bulsam.Net Blog Admin');
	}
	
	function init_sidebar() 
	{
		// admin menü
		if ($this->admin_lib->is_giris_yapmis()) {
			
			$this->template->write_view('admin_sidebar_menu', 'admin/sidebar/menu');
		}
	}
}