<?php
/**
 * Get a list of Tempss
 */
class subscrAuthorTempsGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'subscrAuthorTemps';
	public $classKey = 'subscrAuthorTemps';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	public $renderers = '';


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();

		return $array;
	}

}

return 'subscrAuthorTempsGetListProcessor';