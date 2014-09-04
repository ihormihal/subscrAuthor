<?php
/**
 * Remove an Users
 */
class subscrAuthorUsersRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor');

	public function process() {

        foreach (explode(',',$this->getProperty('users')) as $id) {
            $user = $this->modx->getObject($this->classKey, $id);
            $user->remove();
        }
        
        return $this->success();

	}

}

return 'subscrAuthorUsersRemoveProcessor';