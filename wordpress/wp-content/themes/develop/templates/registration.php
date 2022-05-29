<?php
/**
 * Template Name: User Registration
 */
mp_prevent_user_logged_in();
get_header();?>

<div class="container my-3">

    <form class="form-horizontal" method="POST" role="form">
        <div class="form-group">
            <label for="user_login">Username <span class="text-danger">(*)</span></label>
            <input type="text" name="user_login" id="user_login" class="form-control" placeholder="Enter username" value="" size="20">
        </div>

        <div class="form-group">
            <label for="user_mail">Email <span class="text-danger">(*)</span></label>
            <input type="email" name="user_mail" id="user_mail" class="form-control" placeholder="Enter Email" value="" size="20">
        </div>

        <div class="form-group">
            <label for="user_pass">Password <span class="text-danger">(*)</span></label>
            <input type="password" name="user_pass" id="user_pass" class="form-control" placeholder="Enter Password" value="" size="20">
        </div>

        <div class="form-group">
            <label for="user_confirm_pass">Confirm Password <span class="text-danger">(*)</span></label>
            <input type="password" name="user_confirm_pass" id="user_confirm_pass" class="form-control" placeholder="Confirm Password" value="" size="20">
        </div>

        <input type="submit" name="register_submit" id="register_submit" class="btn btn-primary btn-sm" value="Register">
        <button type="button" class="btn btn-primary btn-sm" onclick="history.back()">Back</button>
    </form>

    <?php mp_user_registration_execute();?>

</div>

<?php get_footer();
