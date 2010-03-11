<?php

class MY_Email extends CI_Email {

    function My_Email()
    {
        parent::CI_Email();
		
		$this->useragent = SABIT_1;
        
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'UTF-8';
		
		$config['useragent'] = SABIT_1;
		
		$this->initialize($config);
		
		$this->from(SABIT_2, SABIT_3);
    }
}
