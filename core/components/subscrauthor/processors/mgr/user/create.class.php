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
			'user_id' => $this->getProperty('user_id'),
			'user_email' => $this->getProperty('user_email'),
			'author_id' => $this->getProperty('author_id')
		));
		if ($alreadyExists) {
			$this->modx->error->addField('user_email', $this->modx->lexicon('subscrauthor_user_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'subscrAuthorUserCreateProcessor';