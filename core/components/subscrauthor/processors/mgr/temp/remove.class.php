<?php
/**
 * Remove an Temps
 */
class subscrAuthorTempsRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorTemps';
	public $classKey = 'subscrAuthorTemps';
	public $languageTopics = array('subscrauthor');

}

return 'subscrAuthorTempsRemoveProcessor';