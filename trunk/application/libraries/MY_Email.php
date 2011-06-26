<?php

class MY_Email extends CI_Email {

    public function __construct()
    {
        parent::__construct();
        
        if (LOCAL) {
	        	
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.ci.gen.tr';
			$config['smtp_user'] = 'mail_ci_gen_tr';
			$config['smtp_pass'] = 'mail_ci_gen_tr';
			$config['smtp_port'] = 25;
			$config['wordwrap'] = FALSE;
			$config['mailtype'] = 'html';
			$config['charset'] = 'UTF-8';
        } else {
        
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'UTF-8';
			$config['wordwrap'] = FALSE;
			$config['mailtype'] = 'html';
		}
		
		$config['useragent'] = SABIT_1;
		
		$this->initialize($config);
		
		$this->from(SABIT_2, SABIT_3);
    }
    
    public function send() {
    
    	if (!LOCAL)
    		parent::send();
    }
}
