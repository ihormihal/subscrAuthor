<?php
/**
 * Update an Item
 */
class subscrAuthorItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'subscrAuthorItem';
	public $classKey = 'subscrAuthorItem';
	public $languageTopics = array('subscrauthor');
	public $permission = 'edit_document';
}

return 'subscrAuthorItemUpdateProcessor';
