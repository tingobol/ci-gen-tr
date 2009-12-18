<?php

class MY_Controller extends Controller 
{
	function MY_Controller() 
	{
		parent::Controller();
		
		$this->output->enable_profiler(TRUE);
			
		//$this->template->add_css('css/fix-ie.css');
		
	//	$this->template->add_css('css/print.css');
		$this->template->add_css('css/style.css');
//		$this->template->add_css('css/cforms.css');
		
 		// $this->template->add_css('css/eburhan_css.css');
		// $this->template->add_css('css/form.css');

		$this->template->add_js('js/cforms.js');
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
		
		// init headerlar
		$this->init_headerlar();
		
		// init menuler
		$this->init_menuler();
		
		// init sidebarlar
		$this->init_sidebarlar();
	}
	
	function init_headerlar() {
	
		// meta başlığını tanımla
		$this->template->write('meta_baslik', 'Admin Paneli');
	}
	
	function init_menuler() {
	
		$this->load->library('Menu_lib');
	}
	
	function init_sidebarlar() {
	
		// menü
		if ($this->kullanici_lib->is_admin())
			$this->template->write_view('admin_sidebar_menu', 'admin/sidebar/menu');
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