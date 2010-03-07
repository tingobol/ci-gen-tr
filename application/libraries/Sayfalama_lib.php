<?php

class Sayfalama_lib {

	var $adet;
	var $sayfa;
	var $toplam_kayit_sayisi;
	
	function is_yeni_kayit_var() { return $this->sayfa != 1; }
	function is_eski_kayit_var() { return ($this->sayfa * $this->adet) < $this->toplam_kayit_sayisi; }
	function get_limit_ilk() { return $this->adet * ($this->sayfa - 1); }
	function set_sayfa($sayfa) { if ($sayfa < 1) $this->sayfa = 1; else $this->sayfa = $sayfa; }
	function get_eski_sayfa() { return $this->sayfa + 1; }
	function get_yeni_sayfa() { return $this->sayfa - 1; }
}