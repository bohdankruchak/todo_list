<?php
    require_once('connection.php');
    if (isset($_POST) &&
	count($_POST)>0 &&
	empty($_POST['mode']) == false
	)
    {
        $db = Db::getInstance();
        switch ($_POST['mode']) {
            case "add_new_list":
                if(empty($_POST['title']) == false){
                    $temp = $_POST['title'];
                    $sel_id = $_POST['selected_id'];
                    $db->query("INSERT INTO `lists` (`id`, `title`) VALUES (NULL, '$temp')");
                    require_once('views/pages_parts/todo_lists.php');
                }
            break;
            case "add_new_point":
                $temp_content = $_POST['content'];
                $sel_id = $_POST['selected_id'];
                $db->query("INSERT INTO `list_points` (`id`, `list_id`, `content`, `checked`) VALUES (NULL, '$sel_id', '$temp_content', '0')");
                require_once('views/pages_parts/todo_list_points.php');
            break;
            case "change_state":
                $temp_state = $_POST['state'];
                $temp_id = $_POST['id'];
                $sel_id = $_POST['selected_id'];
                $db->query("UPDATE `list_points` SET `checked` = $temp_state WHERE `list_points`.`id` = $temp_id");
                require_once('views/pages_parts/todo_list_points.php');
            break;
            case "delete_list":
                $temp_id = $_POST['id'];
                $db->query("DELETE FROM `lists` WHERE `lists`.`id` = $temp_id");
                $db->query("DELETE FROM `list_points` WHERE `list_points`.`list_id` = $temp_id");
                echo "";
            break;
            case "delete_point":
                $temp_id = $_POST['id'];
                $db->query("DELETE FROM `list_points` WHERE `list_points`.`id` = $temp_id;");
                echo "";
            break;
            case "update_list":
                $sel_id  = $_POST['selected_id'];
                require_once('views/pages_parts/todo_lists.php');
            break;
            case "update_points":
                $sel_id  = $_POST['selected_id'];
                require_once('views/pages_parts/todo_list_points.php');
            break;
            case "edit_point":
                $temp_content = $_POST['content'];
                $temp_id = $_POST['id'];
                $db->query("UPDATE `list_points` SET `content` = '$temp_content' WHERE `list_points`.`id` = $temp_id");
                echo "";
            break;
        }
	    exit;
    }
?>