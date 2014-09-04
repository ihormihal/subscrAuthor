<?php
/**
 * Create an Item
 */
class subscrAuthorItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'subscrAuthorItem';
	public $classKey = 'subscrAuthorItem';
	public $languageTopics = array('subscrauthor');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('subscrAuthorItem', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('subscrauthor_item_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'subscrAuthorItemCreateProcessor';