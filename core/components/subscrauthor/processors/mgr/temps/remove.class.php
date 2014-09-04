<?php
/**
 * Remove an tempss
 */
class subscrAuthortempssRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'subscrAuthortemps';
	public $classKey = 'subscrAuthortemps';
	public $languageTopics = array('subscrauthor');

	public function process() {

        foreach (explode(',',$this->getProperty('user')) as $id) {
            $user = $this->modx->getObject($this->classKey, $id);
            $user->remove();
        }
        
        return $this->success();

	}

}

return 'subscrAuthortempssRemoveProcessor';