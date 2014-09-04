<?php
/**
 * Get an User
 */
class subscrAuthorUserGetProcessor extends modObjectGetProcessor {
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor:default');
}

return 'subscrAuthorUserGetProcessor';