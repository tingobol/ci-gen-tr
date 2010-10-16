<?php

class Ping_lib {

	// $id = yazı id
	function yaziyi_weblogsa_gonder($id) {
	
		$url = 'http://rpc.weblogs.com/pingSiteForm?';
		
		$url .= 'name=' . AYAR_11 . '&url=' . urlencode(SAYFA_MISAFIR_0) . '&changesURL=' . urlencode(sprintf(SAYFA_MISAFIR_23, $id));
		
		@file_get_contents($url);
	}
}