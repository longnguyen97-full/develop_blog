<?php
// starts new or resumes existing session
session_start();

// regenerates SESSIONID to prevent hijacking
session_regenerate_id(true);

// Theme_debug
// include_once dirname(__FILE__) . '/../inc/libraries/theme-debug.php';

// Include libraries
include_once dirname(__FILE__) . '/../libraries/init.php';

use phuquang\Validation\QNP_Form;

$include_path = array(
    'validator' => dirname(__FILE__) . '/page-contact-validator.php',
    'sendmail' => dirname(__FILE__) . '/page-contact-sendmail.php',
);

$urls = array(
    'form' => '/contact/',
    'thank' => '/contact/thank/',
);

$Validate = new QNP_Form();

// Set form status is first
$form_status = '';

// Method is GET
if ( $Validate->methodIsGet() ) {
    $form_id           = rand(10000,99999);
    $form_name         = 'contact';
    $form_session_name = 'form_' . $form_name . '_' . $form_id;
    $form_token_name   = 'form_' . $form_name . '_' . $form_id . '_csrf';
    $form_token_value  = md5(mt_rand(1,1000000) . $form_name);
    // Set session for form
    $_SESSION[$form_session_name] = time();
    $_SESSION[$form_token_name]   = $form_token_value;
}

// Method is POST
if ( $Validate->methodIsPost() ) {

    // Not form session
    if ( empty($Validate->post('form_session')) ) {
        $Validate->redirect($urls['form']);
    }

    // form token not match
    if ( !isset($_SESSION[$Validate->post('form_session') . '_csrf']) || $_SESSION[$Validate->post('form_session') . '_csrf'] !== $Validate->post('form_token') ) {
        $Validate->redirect($urls['form']);
    }

    // form due
    if ( strtotime('+1 day', $_SESSION[$Validate->post('form_session')]) < time() ) {
        $Validate->redirect($urls['form']);
    }

    // Include Validator
    include_once $include_path['validator'];

    // First submit and Validate not errors
    if ( $Validate->post('submit') === 'confirm' && $Validate->notErrors() ) {
        // Set form status is confirm
        $form_status = 'confirm';
    }

    // Second submit and Validate not errors
    if ( $Validate->post('submit') === 'done' && $Validate->notErrors() ) {
        // Set form status is done
        $form_status = 'complete';

        // Include Sendmail
        include_once $include_path['sendmail'];
        // $Validate->redirect($urls['thank']);

        // Rremove this form session
        unset($_SESSION[$Validate->post('form_session')]);

        // Remove all session
        session_destroy();
    }

    // Back submit
    if ( $Validate->post('submit') === 'back' ) {
        // Set form status is rollback to first
        $form_status = '';
    }

}

theme_debug(
    array(
        'Session' => $_SESSION,
        'Form' => $Validate,
        'form_status' => $form_status,
    )
);
