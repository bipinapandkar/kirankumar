<?php

class Project_Backend_Product extends Curry_Backend {
	public static function getGroup() {
		return 'Project';
	}
	public function showMain()
	{	
		$PumpModelForm = new Curry_ModelView_Form('PumpModel', array(
			'columnElements' => array(
				'created_at' => false,
				'updated_at' => false,
				'slug' => false
			),
		));
		$PumpModelList = new Curry_ModelView_List('PumpModel', array(
			'maxPerPage' => 10,
			'modelForm' => $PumpModelForm,
			'columns' => array(				
				'slug' => false,
				'created_at' => false
			)
		));

		$PumpCategory = new Curry_ModelView_List('PumpCategory', array(
			'modelForm' => new Curry_ModelView_Form('PumpCategory', array(
				'columnElements' => array(
					'created_at' => false,
					'updated_at' => false,
					'slug' => false
				),
			)),
			'columns' => array(
				'title' => array(
					'action' => 'PumpModelList',
				),
				'slug' => false,
				'created_at' => false
			),
			'actions' => array(
				'PumpModelList' => array(
					'action' => $PumpModelList,
					'single' => true,
					'class' => 'inline',
				)
			)
		));
		$PumpCategory->show($this);
	}


}
