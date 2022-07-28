<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Theme_Standard
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
    ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                /* translators: %s: post title */
                printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'themestandard' ), get_the_title() );
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'themestandard'
                    ),
                    number_format_i18n( $comments_number ),
                    get_the_title()
                );
            }
            ?>
        </h2>
        <ol class="p-0">
        <?php
            wp_list_comments( array(
                'style'         => 'ol',
                'max_depth'     => 4,
                'short_ping'    => true,
                'avatar_size'   => '50',
                'walker'        => new Bootstrap_Comment_Walker(),
            ) );
        ?>
        </ol>
        <?php
        the_comments_pagination(
            array(
                'prev_text' => __( 'Previous', 'themestandard' ),
                'next_text' => __( 'Next', 'themestandard' ),
            )
        );

    endif; // Check for have_comments().

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'themestandard' ); ?></p>
    <?php
    endif;

    $comments_args = array(
        'fields' => array(
            'author' => '<p class="comment-form-author"><input id="author" name="author" class="form-control" placeholder="Name" required></p>',
            'email' => '<p class="comment-form-email"><input id="email" name="email" class="form-control" placeholder="E-Mail" required ></p>',
            'url' => '<p class="comment-form-url"><input id="url" name="url" class="form-control" placeholder="Website" required></p>',
            'cookies' => '<input type="checkbox" required> By commenting you accept the<a href="' . get_privacy_policy_url() . '"> Privacy Policy</a>',
        ),
        // Change the title of send button
        'label_submit' => __( 'Send', 'themestandard' ),
        // Change the title of the reply section
        'title_reply' => __( 'Leave a Message', 'themestandard' ),
        // Change the title of the reply section
        'title_reply_to' => __( 'Reply', 'themestandard' ),
        //Cancel Reply Text
        'cancel_reply_link' => __( 'Cancel Reply', 'themestandard' ),
        // Redefine your own textarea (the comment body).
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="form-control" required placeholder="Comment"></textarea></p>',
        //Message Before Comment
        'comment_notes_before' => __( 'Registration isn\'t required.', 'themestandard' ),
        // Remove "Text or HTML to be displayed after the set of comment fields".
        'comment_notes_after' => '',
        //Submit Button ID
        'id_submit' => __( 'comment-submit', 'themestandard' ),
        'class_submit' => 'submit btn btn-light'
    );
    if ( is_user_logged_in() ) {
        comment_form( $comments_args );
    } else {
        echo '<div class="alert alert-primary" role="alert">You are not currently logged in.</div>';
    }
    ?>

</div><!-- #comments -->
