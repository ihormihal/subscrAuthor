<?php
/**
 * Update an User
 */
class subscrAuthorUserUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor');
	public $permission = 'edit_document';
}

return 'subscrAuthorUserUpdateProcessor';
