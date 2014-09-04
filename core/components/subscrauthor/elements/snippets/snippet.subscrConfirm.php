<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

if($_GET['email']) $user_email = $_GET['email'];
if($_GET['author']) $author = $_GET['author'];
if($_GET['hash']) $hash = $_GET['hash'];

$salt = "subscribe_my_email_please";

if($hash != md5($user_email.$salt)){
    return '<h1 style="color: #c00;">Ошибка. Вы не подписаны на рассылку.</h1>';
}

/* Записываем подписчика в базу */
$subscriber = $modx->getObject('subscrAuthorUser', array('user_email' => $user_email));
if($subscriber){
	echo '<h1 style="color: #c00;">Вы уже подписаны на этого автора.</h1>';
}else{
	$subscriber = $modx->newObject('subscrAuthorUser',array('user_email' => $user_email));
	$user = $modx->getUser();
	if($user){
		$subscriber->set('user_id',$user->get('id'))
	}
	if($subscriber->save()){
		echo '<h1 style="color: #c00;">Подписка оформлена!</h1>';
	}
}



