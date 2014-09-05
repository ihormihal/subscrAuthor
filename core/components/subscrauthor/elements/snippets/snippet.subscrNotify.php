<?php
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

/* base config */
$mail_from = $this->modx->getOption('mail_from', $config);
$mail_from_name = $this->modx->getOption('mail_from_name', $config);
$mail_subject_conform = $this->modx->getOption('mail_subject_confirm', $config);
$mail_subject = $this->modx->getOption('mail_subject', $config);
$unsubscr = $this->modx->getOption('unsubscr', $config);
$tpl = $this->modx->getOption('mailtpl', $config);

$doc_author = $modx->getOption('author',$scriptProperties,'author');
$docid = $modx->getOption('id',$scriptProperties,'1');
$doc_pagetitle = $modx->getOption('pagetitle',$scriptProperties,'pagetitle');

/* base functions */

$unsubscr_doc_url = $modx->makeUrl($unsubscr);

$modx->setPlaceholder('author',$doc_author);
$modx->setPlaceholder('pagetitle',$doc_pagetitle);
$modx->setPlaceholder('url',$doc_url);

$salt = "unsubscribe_my_email_please";

$doc_url = $modx->getOption('site_url').'?id='.$docid;

/* Получаем подписчиков из базы */
$c = $modx->newQuery('subscrAuthorUser');
$subscribers = $modx->getCollection('subscrAuthorUser',$c);

/* Делаем рассылку */

foreach ($subscribers as $email) {
    $user_email = $subscriber->user_email;
    $unsubscr_url = $unsubscr_doc_url.'?author='.$doc_author.'&email='.$user_email.'&hash='.md5($user_email.$salt);
    $modx->setPlaceholder('unsubscr_url',$unsubscr_url);

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
 
if ($doc->remove() == false) {
    $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to delete docid='.$docid.' from queue to publish');
}