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
    $subscriber = $modx->getObject('subscrAuthorUser',array('user_email' => $user_email, 'author_id' => $author));
    if($subscriber !== null){
        if ($subscriber->remove() == false) {
            return $modx->lexicon('subscrauthor_error_not_unsubscr');
        }
        return $modx->lexicon('subscrauthor_success_unsubscr');
    }else{
        $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to find subscriber');
    }
}