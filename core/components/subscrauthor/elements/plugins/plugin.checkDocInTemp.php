<?php
$e = $modx->Event;
$docid = $e->params['id'];

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');
$templateId = $this->modx->getOption('subscrauthor_templateId', $config);

$d = $modx->newQuery('subscrAuthorDoc');
$tempDocs = $modx->getCollection('subscrAuthorDoc',$d);
if(count($tempDocs) > 0){
	$ready = 1;
}

if($modx->event->name == 'OnDocFormSave'){
  if($resource->published == 0){
	$ready = 0;
  }
}

if (($resource->template == $templateId)  && ($ready == 1)) {
    $doc_author = $resource->createdby;
    $author = $resource->getTVValue('author');
    if($author != ''){
       $doc_author = $author;
    }

    $modx->runSnippet(
        'mailNotify',
        array('author' => $doc_author, 'id' => $docid, 'pagetitle' => $resource->pagetitle)
    );
}