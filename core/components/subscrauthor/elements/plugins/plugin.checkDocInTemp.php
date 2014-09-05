<?php
$e = $modx->Event;
$docid = $e->params['id'];

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');
$templateId = $modx->getOption('subscrauthor_templateId', $config);

$d = $modx->newQuery('subscrAuthorDoc');
$tempDocs = $modx->getCollection('subscrAuthorDoc',$d);
if(count($tempDocs) > 0){
	$ready = 1; //документ есть в очереди
}

if($modx->event->name == 'OnDocFormSave'){
  if($resource->published == 0){
	$ready = 0; //документ сохранен как не опубликован
  }
}

if (($resource->template == $templateId)  && ($ready == 1)) {
    //если темплейт совпадает и в очереди
    $doc_author = $resource->createdby;
    $author = $resource->getTVValue('author');
    //если ТВ заполнено
    if($author != ''){
       $doc_author = $author; 
    }
    //ЗАПУСКАЕМ РАССЫЛКУ
    $modx->runSnippet( 
        'subscrNotify',
        array('author' => $doc_author, 'id' => $docid, 'pagetitle' => $resource->pagetitle)
    );
}