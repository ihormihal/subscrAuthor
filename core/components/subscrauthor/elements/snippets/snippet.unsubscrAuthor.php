<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

if($_GET['email']) $user_email = $_GET['email'];
if($_GET['author']) $author = $_GET['author'];
if($_GET['hash']) $hash = $_GET['hash'];

$salt = "unsubscribe_my_email_please";

if($hash != md5($user_email.$salt)){
    return '<h1 style="color: #c00;">Ошибка. Вы не одписались от рассылки.</h1>';
}else{
    /* Удаляем подписку из базы */
    require_once(MODX_CORE_PATH."components/subscr/config/core.php");
    $db = new MyDB();
    $db->connect();
    $delquery = "DELETE FROM subscribers_authors WHERE author = '$author' AND user_email = '$user_email'";
    $db->run($delquery);
    if($db->result == 1){
        echo '<h1 style="color: #c00;">Вы успешно отписались от рассылки.</h1>';
    }else{
        echo '<h1 style="color: #c00;">Ошибка. Вы не отписались от рассылки.</h1>';
    }
    $db->stop();
}