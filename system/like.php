<?php
require 'init.system.php';

$data = $_POST;

	if ( isset($data['do_like']) )
	{
        $user = R::findOne('actions', 'post_id = ?', array($data['id']));
        if($user){
            $like = R::findOne('actions', 'user_id = ?', array($_SESSION['logged_user']->id));
            if($like){
                $like = R::findOne('actions', 'which_activity = ?', array('like'));
                if($like){
                    R::exec('DELETE FROM `actions` WHERE `user_id` = '.$_SESSION['logged_user']->id.' && `post_id` = '.$data['id'].' && `which_activity` = "like"');
                    echo '<script type="text/javascript">
                window.location.href = "/notes/all";
            </script>';
                } else {
                    if ( empty($errors) )
                    {
                        $like_s = R::dispense('actions');
                        $like_s->post_id = $data["id"];
                        $like_s->user_id = $_SESSION['logged_user']->id;
                        $like_s->which_activity = "like";
                        R::store($like_s);
                    }else
                    {
                        echo '<script type="text/javascript">
                alert("'.array_shift($errors).'")
            </script>';
                    }

                }

            } else {
                if ( empty($errors) )
                {
                    $like_s = R::dispense('actions');
                    $like_s->post_id = $data["id"];
                    $like_s->user_id = $_SESSION['logged_user']->id;
                    $like_s->which_activity = "like";
                    R::store($like_s);
                }else
                {
                    echo '<script type="text/javascript">
            alert("'.array_shift($errors).'")
        </script>';
                }

            }
        } else {
            if ( empty($errors) )
            {
                $like_s = R::dispense('actions');
                $like_s->post_id = $data["id"];
                $like_s->user_id = $_SESSION['logged_user']->id;
                $like_s->which_activity = "like";
                R::store($like_s);
                echo '<script type="text/javascript">
        window.location.href = "/notes/all";
    </script>';
            }else
            {
                echo '<script type="text/javascript">
        alert("'.array_shift($errors).'")
    </script>';
            }

        }

	}

?>