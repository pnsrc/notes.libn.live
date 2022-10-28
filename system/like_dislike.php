<?php
include 'init.system.php';

$data = $_POST;

if (isset($data['do_like'])) {
    $action = 'like';
    $delete = 'dislike';
};

if (isset($data['do_dislike'])) {
    $action = 'dislike';
    $delete = 'like';
}

function marry($action, $data, $delete)
{
    R::exec('DELETE FROM `actions` WHERE `user_id` = ' . $_SESSION['logged_user']->id . ' && `post_id` = ' . $data['id'] . ' && `which_activity` = "' . $delete . '"');
    $like_s = R::dispense('actions');
    $like_s->post_id = $data["id"];
    $like_s->user_id = $_SESSION['logged_user']->id;
    $like_s->which_activity = $action;
    R::store($like_s);
    echo '<script type="text/javascript">
    window.location.href = "/notes/all";
</script>';
}

if (isset($action)) {
    $user = R::findOne('actions', 'post_id = ?', array($data['id']));
    if ($user) {
        $like = R::findOne('actions', 'user_id = ?', array($_SESSION['logged_user']->id));
        if ($like) {
            $like = R::findOne('actions', 'which_activity = ?', array($action));
            if ($like) {
                marry($action, $data, $delete);

            } else {
                marry($action, $data, $delete);
            }
        }
    } else {
        marry($action, $data, $delete);
    }
} else {
    marry($action, $data, $delete);
}
