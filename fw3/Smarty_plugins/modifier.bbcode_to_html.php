<?php

function smarty_modifier_bbcode_to_html($string)
{
	$CI =& get_instance();
	
	$CI->load->library('Bbcode_lib');
	
	return $CI->bbcode_lib->BBCode2Html($string);
}