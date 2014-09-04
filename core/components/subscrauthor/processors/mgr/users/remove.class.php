<?php
/**
 * Remove an User
 */
class subscrAuthorUserRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorUser';
	public $classKey = 'subscrAuthorUser';
	public $languageTopics = array('subscrauthor');

	public function process() {

        foreach (explode(',',$this->getProperty('user')) as $id) {
            $user = $this->modx->getObject($this->classKey, $id);
            $user->remove();
        }
        
        return $this->success();

	}

}

return 'subscrAuthorUserRemoveProcessor';