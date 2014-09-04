<?php

$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/',$scriptProperties);
if (!($subscrAuthor instanceof subscrAuthor)) return '';

/**
 * Do your snippet code here. This demo grabs 5 users from our custom table.
 */
$tpl = $modx->getOption('tpl',$scriptProperties,'User');
$sortBy = $modx->getOption('sortBy',$scriptProperties,'name');
$sortDir = $modx->getOption('sortDir',$scriptProperties,'ASC');
$limit = $modx->getOption('limit',$scriptProperties,5);
$outputSeparator = $modx->getOption('outputSeparator',$scriptProperties,"\n");

/* build query */
$c = $modx->newQuery('subscrAuthorUser');
$c->sortby($sortBy,$sortDir);
$c->limit($limit);
$users = $modx->getCollection('subscrAuthorUser',$c);

/* iterate through users */
$list = array();
/* @var subscrAuthorUser $user */
foreach ($users as $user) {
	$userArray = $user->toArray();
	$list[] = $modx->getChunk($tpl,$userArray);
}

/* output */
$output = implode($outputSeparator,$list);
$toPlaceholder = $modx->getOption('toPlaceholder',$scriptProperties,false);
if (!empty($toPlaceholder)) {
	/* if using a placeholder, output nothing and set output to specified placeholder */
	$modx->setPlaceholder($toPlaceholder,$output);
	return '';
}
/* by default just return output */
return $output;