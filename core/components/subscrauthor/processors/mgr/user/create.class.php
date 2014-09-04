<?php
/**
 * Create an User
 */
class subscrAuthorUserCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('subscrAuthorUser', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('subscrauthor_user_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'subscrAuthorUserCreateProcessor';