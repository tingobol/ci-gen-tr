<?php

class Ana_sayfa extends MY_MisafirKontroller {

	function index() {
	
		$this->smarty->view('misafir/ana_sayfa/index.tpl');
	}
}
