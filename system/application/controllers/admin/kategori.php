<?php

class Kategori extends MY_AdminKontroller {

	function Kategori() {
	
		parent::MY_AdminKontroller();
		
		$this->load->helper('form');
		
		$this->template->write('menu_linkleri', $this->menu_lib->get_admin_linkleri());
	}
	
	function ekle() {
	
		$this->kullanici_lib->sadece_admin_gorebilir();
		
		$data['kategori'] = $this->kategori;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
		
			$this->kategori->adi = $this->input->post('adi');
		} else {
		
			
		}
	}
}