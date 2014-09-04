<?php
/**
 * Create an Temps
 */
class subscrAuthorTempsCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'subscrAuthorTemps';
	public $classKey = 'subscrAuthorTemps';
	public $languageTopics = array('subscrauthor');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('subscrAuthorTemps', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('subscrauthor_temps_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'subscrAuthorTempsCreateProcessor';