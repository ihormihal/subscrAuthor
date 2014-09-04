<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

$c = $modx->newQuery('subscrAuthorUser');

$subscribers = $modx->getCollection('subscrAuthorUser',$c);

foreach ($subscribers as $subscriber) {
	echo $subscriber->user_email;
}
