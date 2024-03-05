<?php
/*
Plugin Name: Private Comments
Plugin URI: https://supervised.co/wordpress
Description: Turn your comments private.
Version: 1.0.0
Author: Supervised AI
Author URI: http://supervised.co
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function restrict_comment_visibility($comments_query) {
    if (!is_admin() && !current_user_can('edit_posts') && !is_singular()) {
        $comments_query->query_vars['include_children'] = false;
        if ($comments_query->query_vars['user_id']) {
            $comments_query->query_vars['user_id'] = get_current_user_id();
        } else {
            $comments_query->query_vars['post_author'] = get_current_user_id();
        }
    }
}
add_action('pre_get_comments', 'restrict_comment_visibility');
