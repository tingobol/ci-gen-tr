<?php

class MY_Email extends CI_Email {

    function My_Email()
    {
        parent::CI_Email();
		
		$this->useragent = sabit_1;
        
		$config['wordwrap'] = FALSE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'UTF-8';
		$config['useragent'] = sabit_1;
		
		$this->initialize($config);
		
		$this->from(sabit_2, sabit_3);
    }
}
