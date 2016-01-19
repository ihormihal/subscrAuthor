<?php
$e = $modx->Event;
$docid = $e->params['id'];

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');
$templateId = $modx->getOption('subscrauthor_templateId', $config);

$d = $modx->newQuery('subscrAuthorDoc', array('doc_id' => $docid));
$tempDocs = $modx->getCollection('subscrAuthorDoc',$d);
if(count($tempDocs) > 0){
  $ready = 1; //документ есть в очереди
}

if($modx->event->name == 'OnDocFormSave'){
  if($resource->published == 0){
    $ready = 0; //документ сохранен как не опубликованный
  }
}
//$modx->log(modX::LOG_LEVEL_ERROR,'Return='.$ready);
if ($resource->template == $templateId  && ($ready == 1)) {
    //если темплейт совпадает и в очереди
    $doc_author = $resource->createdby;
    //ЗАПУСКАЕМ РАССЫЛКУ
    $modx->runSnippet(
        'subscrNotify',
        array('author' => $doc_author, 'id' => $docid, 'pagetitle' => $resource->pagetitle)
    );
}