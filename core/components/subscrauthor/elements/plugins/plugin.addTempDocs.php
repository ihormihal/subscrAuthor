<?php
$e = $modx->Event;
$docid = $e->params['id'];

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');
$templateId = $this->modx->getOption('subscrauthor_templateId', $config);

if ($mode != 'new' && ($resource->template != $templateId)) {
	
} else {
    //Устанавливаем автора в ТВ
    if($mode == 'new'){
    	$resource->setTVValue('author', $modx->getUser()->get('id'));
    }

    //Записываем id в хранилище очереди (еще не опубликованные)
    $doc = $modx->newObject('subscrAuthorDoc',array('doc_id' => $docid));
	$doc->save();
}