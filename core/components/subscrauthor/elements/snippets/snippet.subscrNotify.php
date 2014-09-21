<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

/* base config */
$mail_from = $modx->getOption('subscrauthor_mail_from', $config);
$mail_from_name = $modx->getOption('subscrauthor_mail_from_name', $config);

$mail_subject = $modx->getOption('subscrauthor_mail_subject', $config);
$unsubscr = $modx->getOption('subscrauthor_unsubscr', $config);
$tpl = $modx->getOption('subscrauthor_mailtpl', $config);

$doc_author = $modx->getOption('author',$scriptProperties,'author');
$docid = $modx->getOption('id',$scriptProperties,'1');
$doc_pagetitle = $modx->getOption('pagetitle',$scriptProperties,'pagetitle');

$author_name = $modx->getObject('modUser', $doc_author )->getOne('Profile')->get('fullname');

/* base functions */

$unsubscr_doc_url = $modx->makeUrl($unsubscr,'','','full');


$salt = "unsubscribe_my_email_please";

$doc_url = $modx->getOption('site_url').'?id='.$docid;

/* Получаем подписчиков из базы */
$c = $modx->newQuery('subscrAuthorUser');
$query->where(array(
   'author_id' => $doc_author,
));
$subscribers = $modx->getCollection('subscrAuthorUser',$c);

/* Делаем рассылку */
foreach ($subscribers as $subscriber) {
    $user_email = $subscriber->user_email;
    $unsubscr_url = $unsubscr_doc_url.'?author='.$doc_author.'&email='.$user_email.'&hash='.md5($user_email.$salt);

    $modx->setPlaceholders(array(
       'author' => $author_name,
       'pagetitle' => $doc_pagetitle,
       'url' => $doc_url,
       'unsubscr_url' => $unsubscr_url,
    ),'');

    $message = $modx->getChunk($tpl);

    $modx->getService('mail', 'mail.modPHPMailer');
    $modx->mail->set(modMail::MAIL_BODY,$message);
    $modx->mail->set(modMail::MAIL_FROM,$mail_from);
    $modx->mail->set(modMail::MAIL_FROM_NAME,$mail_from_name);
    $modx->mail->set(modMail::MAIL_SUBJECT,$mail_subject);
    $modx->mail->address('to',$user_email);
    
    /*Отправляем*/
    $modx->mail->setHTML(true);
    if (!$modx->mail->send()) {
        $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
    }
    $modx->mail->reset();
    sleep(0.1);
}
//Удаляем документ из очереди
$doc = $modx->getObject('subscrAuthorDoc', array('doc_id' => $docid));

if($doc !== null){ 
    if ($doc->remove() == false) {
        $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to delete docid='.$docid.' from queue to publish');
    }
}