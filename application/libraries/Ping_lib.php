<?php

class Ping_lib {

	// $id = yazı id
	function yaziyi_weblogsa_gonder($id) {
	
		$url = 'http://rpc.weblogs.com/pingSiteForm?';
		
		$url .= urlencode('name=' . AYAR_11 . '&url=' . SAYFA_MISAFIR_0 . '&changesURL=' . sprintf(SAYFA_MISAFIR_23, $id));
		
		@file_get_contents($url);
	}
}