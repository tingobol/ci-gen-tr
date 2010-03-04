<?php

class MY_Email extends CI_Email {

    function My_Email()
    {
        parent::CI_Email();
		
		$this->useragent = sabit_1;
        
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.evrenshosting.com';
		$config['smtp_user'] = 'temp+evrenshosting.com';
		$config['smtp_pass'] = 'deneme123';
		$config['smtp_port'] = 26;
		$config['wordwrap'] = FALSE;
		$config['mailtype'] = 'html';
		$config['charset'] = 'UTF-8';
		
		$config['useragent'] = sabit_1;
		
		$this->initialize($config);
		
		$this->from(sabit_2, sabit_3);
    }
}
