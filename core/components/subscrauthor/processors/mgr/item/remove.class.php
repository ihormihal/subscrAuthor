<?php
/**
 * Remove an Item
 */
class subscrAuthorItemRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorItem';
	public $classKey = 'subscrAuthorItem';
	public $languageTopics = array('subscrauthor');

}

return 'subscrAuthorItemRemoveProcessor';