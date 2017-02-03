<?php

class Project_Module_Enquiry extends Curry_Module {

    protected $thankyoucontent = '';
    protected $subject = '';
    protected $contactemail = '';
	
	public function toTwig() {
	    $req = $this->getRequest();
		if($req->isPost()) {
			//$req = $this->getRequest();
			$name = $req->getParam('name');
			$companyname = $req->getParam('company');
			$email = $req->getParam('email');
			$telno = $req->getParam('telno');
			$address = $req->getParam('address');
			$enquirydetails = $req->getParam('enquirytext');

			$secret = '6LfuQRIUAAAAABc2gMcYSq_o623PfCtKQHJ2n9g8';
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);
			if($responseData->success){
					/*save bookings*/
					$customerentry = new Customer();
					$customerentry->setName($name);
					$customerentry->setAddress($address);
					$customerentry->setEmail($email);
					$customerentry->setTelno($telno);
					$customerentry->setCompanyName($companyname);		
					$customerentry->setEnquiryDescription($enquirydetails);
		
					$customerentry->save();
					
					/* send email to Admin*/
					$email_subject = $this->subject;
					$toEmail = $this->contactemail;
					$message = '';
					$tplPath = __DIR__;
		            $cachePath = Curry_Core::$config->curry->projectPath . '/data/cache/templates';
		            $templatePath = Curry_Core::$config->curry->projectPath .'/templates/';
		            $twig = Curry_Twig_Template::getSharedEnvironment();
		            $twig->getLoader()->prependPath($templatePath);
		
					$message .= 'Name: '.$name.'<br />';
					$message .= 'Company Name: '.$companyname.'<br />';
					$message .= 'Address: '.$address.'<br />';
					$message .= 'E-mail: '.$email.'<br />';
					$message .= 'Tel No: '.$telno.'<br /><br />';
					$message .= 'Enquiry: '.$enquirydetails.'<br /><br />';
					
					$mail = new Curry_Mail();
					$mail->addTo(Curry_Core::$config->curry->adminEmail);
		
					$mail->setFrom('admin@techrameshwar.in', 'Kumar Engineering');
					$mail->addTo($toEmail);
					$body = $message;
					$mail->setSubject($email_subject);
					$mail->setBodyHtml($body);
					$mail->setBodyText(strip_tags($body));
					$mail->send(); 
					
					/* send email to visitor */
					$visitor_email_subject = "Thank you for contacting us";
					$baseurl = Curry_Core::$config->curry->baseUrl;			
					$mail2 = new Curry_Mail();
					$mail2->addTo($email);
					$mail2->setFrom('admin@techrameshwar.in', 'Kumar Engineering');
		            $tpl = $twig->loadTemplate('Emailer.twig');               
		            $content = $tpl->render(array(
		                'baseUrl' => Curry_Core::$config->curry->baseUrl, 
		            	'Thankyou' => $this->thankyoucontent
		            ));              
		         
					$body2 = $content;	
					$mail2->setSubject($visitor_email_subject);
					$mail2->setBodyHtml($body2);
					$mail2->setBodyText(strip_tags($body2));
					$mail2->send();  
			}
			else{
				return array(
					'CaptchaError'	=> 'Invalid Captcha',
				);
			}
		}
        return array(
        	'Retailer'	=> $retailer,
        	'ThankYouText' => $this->thankyoucontent,
            'EmailSubject' => $this->subject,
            'ContactEmail' => $this->contactemail,
        );
    }
    

    public function showBack() {
        $form = new Curry_Form_SubForm(array(
            'elements' => array(
                'thankyoucontent' => array('tinyMCE', array(
                    'label' => 'Thank you text',
                    'required' => false,
                    'value' => $this->thankyoucontent,
                )),
                'subject' => array('text', array(
                    'label' => 'Email Subject',
                    'required' => false,
                    'value' => $this->subject,
                )),
                 'contactemail' => array('text', array(
                    'label' => 'Contact Email',
                    'required' => false,
                    'value' => $this->contactemail,
                )),
            )
        ));

        return $form;
    }

    public function saveBack(Zend_Form_SubForm $form)
    {
        $values = $form->getValues(true);
        $this->thankyoucontent = $values['thankyoucontent'];
        $this->subject = $values['subject'];
        $this->contactemail = $values['contactemail'];
        
    }

}
