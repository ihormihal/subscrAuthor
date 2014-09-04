<?php
/**
 * Remove an User
 */
class subscrAuthorUserRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor');

}

return 'subscrAuthorUserRemoveProcessor';