<?php
$e = $modx->Event;
$docid = $e->params['id'];

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

$doc = $modx->getObject('subscrAuthorDoc', array('doc_id' => $docid));
if($doc !== null){
	if ($doc->remove() == false) {
	    $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to remove docid='.$docid.' from queue to publish');
	}
}
