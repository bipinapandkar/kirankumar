<?php

class Project_Application extends Curry_Application
{
	/* Rebuild your model search index dynamically */
	public static function rebuildModelSearchIndex($index_model)
	{
	
		$curr_model = get_class($index_model);
		if (!in_array('Curry_ISearchable', class_implements($curr_model))) {
			return false;
		}
	
		$index = Curry_Core::getSearchIndex();
		$doc = $index_model->getSearchDocument();
		$hits = $index->find('model:'.$curr_model);
	
		foreach ($hits as $hit) {
			// id is the model id stored in the index.
			if ($hit->id == $index_model->getPrimaryKey()) {
				$index->delete($hit->id);
				break;
			}
		}
	
		if ($doc) {
			// add document to index.
			$doc->addField(Zend_Search_Lucene_Field::Keyword('model', get_class($index_model)));
			$doc->addField(Zend_Search_Lucene_Field::Keyword('model_id', serialize($index_model->getPrimaryKey())));
			$index->addDocument($doc);
		}
	}
}
