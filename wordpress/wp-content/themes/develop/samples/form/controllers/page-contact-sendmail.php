<?php
use phuquang\Validation\QNP_Mailer;

$Mailer_user = new QNP_Mailer();
$Mailer_user->setFrom('admin@cybridge.jp', 'Admin');
$Mailer_user->setTo('pauli@cybridge.jp', 'User');
$Mailer_user->setSubject('Subject');
// $Mailer_user->Subject = $Mailer_user->transferEncode('Subject');
$Mailer_user->setMailData($Validate->getAllData());
$Mailer_user->setMailTemplate(dirname(__FILE__) . '/../template-emails/page-contact-user.tpl');
$Mailer_user->send();

$Mailer_admin = new QNP_Mailer();
$Mailer_admin->setFrom('admin@cybridge.jp', 'Admin');
$Mailer_admin->setTo('admin@cybridge.jp', 'Admin');
$Mailer_admin->setSubject('Subject');
// $Mailer_admin->Subject = $Mailer_admin->transferEncode('Subject');
$Mailer_admin->setMailData($Validate->getAllData());
$Mailer_admin->setMailTemplate(dirname(__FILE__) . '/../template-emails/page-contact-admin.tpl');
$Mailer_admin->send();