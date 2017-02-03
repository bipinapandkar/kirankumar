<?php

class Project_Backend_Customer extends Curry_Backend {
	    
    public static function getGroup() {
        return 'Project';
    }
	public function showMain()
	{   
		$customer = CustomerQuery::create()
						->orderByCreatedAt('desc');
		
		$CustomerForm = new Curry_ModelView_Form('Customer', array(
			'columnElements' => array(),
		));
		$CustomerList = new Curry_ModelView_List($customer, array(
			'maxPerPage' => 10,
			'modelForm' => $CustomerForm,
			'columns' => array(
			    'created_at' => true,
			    'updated_at' => false,
				'slug' => false,
			),
			
		));
		
		$CustomerList->show($this);			
	}

}
