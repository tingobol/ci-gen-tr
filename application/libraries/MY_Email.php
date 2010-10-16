<?php

class MY_Email extends CI_Email {

    function My_Email()
    {
        parent::CI_Email();
		
		$this->useragent = SABIT_1;
        
		if (LOCAL) {

				
                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'mail.ci.gen.tr';
                $config['smtp_user'] = 'bilgi';
                $config['smtp_pass'] = 'pass';
                $config['smtp_port'] = 25;
                $config['mailtype'] = 'html';
                $config['charset'] = 'UTF-8';
			
		} else {
		
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$config['charset'] = 'UTF-8';
		}
		
		$config['useragent'] = SABIT_1;
		
		$this->initialize($config);
		
		$this->from(SABIT_2, SABIT_3);
    }
}
