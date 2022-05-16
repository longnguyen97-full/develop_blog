<?php
/**
 * Template Name: Form Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once get_parent_theme_file_path('samples/form/controllers/page-contact-controller.php');
?>
<html>
<head>
<link rel='stylesheet' id='themestandard-bootstrap-css'  href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css?ver=4.1.3' type='text/css' media='all' />
<script type='text/javascript' src='https://code.jquery.com/jquery-3.3.1.slim.min.js?ver=3.3.1'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js?ver=1.14.3'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js?ver=4.1.3'></script>
</head>
<body>
<div class="container">
    <?php
    if($form_status === ""){
        include_once get_parent_theme_file_path('samples/form/view/template-parts/content-contact.php');
    }
    if($form_status === "confirm"){
        include_once get_parent_theme_file_path('samples/form/view/template-parts/content-contact-confirmation.php');
    }
    ?>
</div>
</body>
</html>
