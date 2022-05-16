<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die();
}

include_once dirname(__FILE__) . '/trait.qnp_rules.php';
include_once dirname(__FILE__) . '/trait.qnp_methods.php';
include_once dirname(__FILE__) . '/trait.qnp_filters.php';
include_once dirname(__FILE__) . '/trait.qnp_helpers.php';
include_once dirname(__FILE__) . '/trait.qnp_errors.php';
include_once dirname(__FILE__) . '/QNP_Mailer.php';
include_once dirname(__FILE__) . '/QNP_Field.php';
include_once dirname(__FILE__) . '/QNP_Form.php';
