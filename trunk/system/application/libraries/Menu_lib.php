<?php

class Menu_link {

	var $id;
	var $adi;
	var $adresi;
	
	function Menu_link($id, $adi, $adresi) {
	
		$this->id = $id;
		$this->adi = $adi;
		$this->adresi = $adresi;
	}
}

class Menu_lib {

	var $CI;

	var $linkler;
	
	function Menu_lib() {
	
		$this->CI =& get_instance();
	}
	
	function link_ekle($link) {
	
		$this->linkler[] = $link;
	}
	
	function get_linkler($id = '') {
	
		$return = '';
	
		foreach ($this->linkler as $link) {
		
			$selected = ($link->id == $id) ? (' class="current_page_item"') : ('');
		
			$return .= '<li' . $selected . '>' . anchor($link->adresi, $link->adi) . '</li>';
		}
		
		return $return;
							
	}
	
	function get_admin_linkleri($id = 'ana_sayfa') {
	
		$this->linkler = array();
		
		if ($this->CI->kullanici_lib->is_admin()) {
		
			$this->link_ekle(new Menu_link('ana_sayfa', 'Ana Sayfa', sayfa_admin_0));
			$this->link_ekle(new Menu_link('cikis', 'Çıkış', sayfa_admin_3));
		} else {
		
			$this->link_ekle(new Menu_link('giris_yap', 'Giriş Yap', sayfa_admin_1));
			$this->link_ekle(new Menu_link('sifremi_unuttum', 'Şifremi Unuttum', sayfa_admin_2));
		}
		
		return $this->get_linkler($id);
	}
}