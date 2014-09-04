<?php
/**
 * Update an Temps
 */
class subscrAuthorTempsUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'subscrAuthorTemps';
	public $classKey = 'subscrAuthorTemps';
	public $languageTopics = array('subscrauthor');
	public $permission = 'edit_document';
}

return 'subscrAuthorTempsUpdateProcessor';
