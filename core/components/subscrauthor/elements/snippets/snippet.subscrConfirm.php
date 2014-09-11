<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

if(isset($_GET['email']) && isset($_GET['author']) && isset($_GET['hash'])){
	$user_email = $_GET['email'];
	$author = $_GET['author'];
	$hash = $_GET['hash'];
}else{
	header("HTTP/1.x 404 Not Found");
}
$salt = "subscribe_my_email_please";

if($hash !== md5($user_email.$salt)){
    return $modx->lexicon('subscrauthor_error_not_subscr');
}

/* Записываем подписчика в базу */
$subscriber = $modx->getObject('subscrAuthorUser', array('user_email' => $user_email));
if($subscriber){
	echo $modx->lexicon('subscrauthor_error_already_subscr');
}else{
	$subscriber = $modx->newObject('subscrAuthorUser',array('user_email' => $user_email, 'author_id' => $author));
	$user = $modx->getUser();
	if($user){
		$subscriber->set('user_id',$user->get('id'));
	}
	if($subscriber->save()){
		echo $modx->lexicon('subscrauthor_success_subscr');
	}
}