<?php
$response = array('status'=>0,'msg'=>'');
$subscrAuthor = $modx->getService('subscrauthor','subscrAuthor',$modx->getOption('subscrauthor_core_path',null,$modx->getOption('core_path').'components/subscrauthor/').'model/subscrauthor/');

/* base config */
$tpl = $modx->getOption('tpl',$scriptProperties,'tpl.subscrConfirm');
$confirm = $modx->getOption('confirm',$scriptProperties,'1');

$mail_from = $modx->getOption('subscrauthor_mail_from', $config);
$mail_from_name = $modx->getOption('subscrauthor_mail_from_name', $config);
$mail_subject_confirm = $modx->getOption('subscrauthor_mail_subject_confirm', $config);

if(isset($_GET['email'])) $user_email = $_GET['email'];
if(isset($_GET['author'])) $author = $_GET['author'];

$salt = "subscribe_my_email_please";
$subscr_doc_url = $modx->getOption('site_url').$modx->makeUrl($confirm);
$subscr_url = $subscr_doc_url.'?email='.$user_email.'&author='.$author.'&hash='.md5($user_email.$salt);


$modx->setPlaceholder('author',$author);
$modx->setPlaceholder('subscr_url',$subscr_url);

$message = $modx->getChunk($tpl);

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY,$message);
$modx->mail->set(modMail::MAIL_FROM,$mail_from);
$modx->mail->set(modMail::MAIL_FROM_NAME,$mail_from_name);
$modx->mail->set(modMail::MAIL_SUBJECT,$mail_subject_confirm);
$modx->mail->address('to',$user_email);


$modx->mail->setHTML(true);
if (!$modx->mail->send()) {
    $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
    $response['status'] = 0;
    $response['msg'] = $modx->lexicon('subscrauthor_error_mail_confirm');
}else{
	$response['status'] = 1;
	$response['msg'] = $modx->lexicon('subscrauthor_success_mail_confirm');
}
$modx->mail->reset();

echo json_encode($response);