<?php

class Bbcode_lib {

	function BBCode2Html($text) {
	
		$text = trim($text);

		$text = htmlspecialchars($text);
		
		// BBCode [php_kodu]
		if (!function_exists('escape_php_kodu')) {
			function escape_php_kodu($s) {
				$code = $s[1];
				$code = str_replace("[", "&#91;", $code);
				$code = str_replace("]", "&#93;", $code);
				return '<pre class="brush: php;">'.$code.'</pre>';
			}	
		}

		$text = preg_replace_callback('/\[php_kodu\](.*?)\[\/php_kodu\]/ms', "escape_php_kodu", $text);
		
		// BBCode to find...
		$in = array(
				'/\[p\](.*?)\[\/p\]/ms',  
				'/\[b\](.*?)\[\/b\]/ms', 
				'/\[i\](.*?)\[\/i\]/ms', 
				'/\[u\](.*?)\[\/u\]/ms', 
				'/\[url\="?(.*?)"?\](.*?)\[\/url\]/ms', 
				'/\[ol_list\](.*?)\[\/ol_list\]/ms', 
				'/\[ul_list\](.*?)\[\/ul_list\]/ms', 
				'/\[\*\]\s?(.*?)\n/ms');
		
		// And replace them by...
		$out = array(
				'<p>\1</p>', 
				'<strong>\1</strong>', 
				'<em>\1</em>', 
				'<u>\1</u>', 
				'<a href="\1">\2</a>', 
				'<ol>\1</ol>', 
				'<ul>\1</ul>', 
				'<li>\1</li>');
		
		$text = preg_replace($in, $out, $text);
		
		return $text;
		
		$text = str_replace("\r", "", $text);
		$text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
		$text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);
		
		return $text;
		
		// paragraphs
		$text = str_replace("\r", "", $text);
		$text = "<p>".preg_replace("/(\n){2,}/", "</p><p>", $text)."</p>";
		$text = nl2br($text);
		
		// clean some tags to remain strict
		// not very elegant, but it works. No time to do better ;)
		if (!function_exists('removeBr')) {
			function removeBr($s) {
				$return = str_replace("<br />", "", $s[0]);
				return str_replace("<br>", "", $return);
			}
		}	
		$text = preg_replace_callback('/<pre(.*?)>(.*?)<\/pre>/ms', "removeBr", $text);
		$text = preg_replace('/<p><pre>(.*?)<\/pre><\/p>/ms', "<pre>\\1</pre>", $text);
		
		$text = preg_replace_callback('/<ul>(.*?)<\/ul>/ms', "removeBr", $text);
		$text = preg_replace('/<p><ul>(.*?)<\/ul><\/p>/ms', "<ul>\\1</ul>", $text);
		
		return $text;
	}
}