<?php
/**
 * Remove an Items
 */
class subscrAuthorItemsRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'subscrAuthorItem';
	public $classKey = 'subscrAuthorItem';
	public $languageTopics = array('subscrauthor');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'subscrAuthorItemsRemoveProcessor';