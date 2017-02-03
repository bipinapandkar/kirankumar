<?php

class Project_Backend_Termcondition extends Curry_Backend {
	    
    public static function getGroup() {
        return 'Project';
    }
    protected function addMenu()
    {
    	$this->addMenuItem('Delivery', url('', array('module','view'=> 'Main')));
    	$this->addMenuItem('Payment Terms', url('', array('module','view'=> 'Paymentterm')));
    	$this->addMenuItem('Fright', url('', array('module','view'=> 'TermFright')));
    	$this->addMenuItem('OCT/Insurance', url('', array('module','view'=> 'TermOctinsurance')));
    	$this->addMenuItem('Validity', url('', array('module','view'=> 'TermValidity')));
    	$this->addMenuItem('Warranty', url('', array('module','view'=> 'TermWarranty')));
    }
	public function showMain()
	{   
		$this->addMenu();
		$DeliverForm = new Curry_ModelView_Form('TermDelivery', array(
			'columnElements' => array(),
		));
		$DeliverList = new Curry_ModelView_List('TermDelivery', array(
			'maxPerPage' => 10,
			'modelForm' => $DeliverForm			
		));
		
		$DeliverList->show($this);			
	}
	public function showPaymentterm()
	{
		$this->addMenu();
		$TermPaymentForm = new Curry_ModelView_Form('TermPayment', array(
				'columnElements' => array(),
		));
		$TermPaymentList = new Curry_ModelView_List('TermPayment', array(
				'maxPerPage' => 10,
				'modelForm' => $TermPaymentForm
		));
	
		$TermPaymentList->show($this);
	}
	public function showTermFright()
	{
		$this->addMenu();
		$TermFrightForm = new Curry_ModelView_Form('TermFright', array(
				'columnElements' => array(),
		));
		$TermFrightList = new Curry_ModelView_List('TermFright', array(
				'maxPerPage' => 10,
				'modelForm' => $TermFrightForm
		));
	
		$TermFrightList->show($this);
	}
	public function showTermOctinsurance()
	{
		$this->addMenu();
		$TermOctinsuranceForm = new Curry_ModelView_Form('TermOctinsurance', array(
				'columnElements' => array(),
		));
		$TermOctinsuranceList = new Curry_ModelView_List('TermOctinsurance', array(
				'maxPerPage' => 10,
				'modelForm' => $TermOctinsuranceForm
		));
	
		$TermOctinsuranceList->show($this);
	}
	public function showTermValidity()
	{
		$this->addMenu();
		$TermValidityForm = new Curry_ModelView_Form('TermValidity', array(
				'columnElements' => array(),
		));
		$TermValidityList = new Curry_ModelView_List('TermValidity', array(
				'maxPerPage' => 10,
				'modelForm' => $TermValidityForm
		));
	
		$TermValidityList->show($this);
	}
	public function showTermWarranty()
	{
		$this->addMenu();
		$TermWarrantyForm = new Curry_ModelView_Form('TermWarranty', array(
				'columnElements' => array(),
		));
		$TermWarrantyList = new Curry_ModelView_List('TermWarranty', array(
				'maxPerPage' => 10,
				'modelForm' => $TermWarrantyForm
		));
	
		$TermWarrantyList->show($this);
	}

}
