<?php

function smarty_function_bulsam_duyuru($params, &$smarty)
{
	$CI = &get_instance();
	
	$CI->load->model('duyuru');
	
	return $CI->duyuru->get_rasgele_1();
}