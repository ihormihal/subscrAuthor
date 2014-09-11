<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

if(isset($_GET['email']) && isset($_GET['author']) && isset($_GET['hash'])){
    $user_email = $_GET['email'];
    $author = $_GET['author'];
    $hash = $_GET['hash'];
}else{
    return $modx->lexicon('subscrauthor_error_not_unsubscr');
}


$salt = "unsubscribe_my_email_please";

if($hash != md5($user_email.$salt)){
    return $modx->lexicon('subscrauthor_error_not_unsubscr');
}else{
    /* Удаляем подписку из базы */
    require_once(MODX_CORE_PATH."components/subscr/config/core.php");
    $db = new MyDB();
    $db->connect();
    $delquery = "DELETE FROM subscribers_authors WHERE author = '$author' AND user_email = '$user_email'";
    $db->run($delquery);
    if($db->result == 1){
        echo $modx->lexicon('subscrauthor_success_unsubscr');
    }else{
        echo $modx->lexicon('subscrauthor_error_not_unsubscr');
    }
    $db->stop();
}