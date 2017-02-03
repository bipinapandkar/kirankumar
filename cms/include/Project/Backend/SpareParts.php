<?php

class Project_Backend_SpareParts extends Curry_Backend {
	public static function getGroup() {
		return 'Project';
	}
	public function showMain()
	{	
		$SparePartsForm = new Curry_ModelView_Form('SparePart', array(
			'columnElements' => array(
				'created_at' => false,
				'updated_at' => false,
				'slug' => false,
				'relation__pump_model' => array('multiselect', array(
						'label' => 'Pump Models',
						'class' => 'chosen',
				)),				
			),
			'withRelations' => array('PumpModel'),
		));
		$SparePartsList = new Curry_ModelView_List('SparePart', array(
			'maxPerPage' => 10,
			'modelForm' => $SparePartsForm,
			'columns' => array(				
				'slug' => false,
				'created_at' => false
			)
		));
		
		$SparePartsList->show($this);
	}


}
