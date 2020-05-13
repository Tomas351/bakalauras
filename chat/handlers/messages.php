<?php
session_start();
$my_u_id = $_SESSION['u_id'];
$chat_with = $_SESSION['chat_with'];
$seconduserid = 0;
include('../config.php');
switch ($_REQUEST['action']) {
    case "sendMessage":
        session_start();
        $query = $pdo->prepare("INSERT INTO tbl_messages SET  message=?, sender_id=?, user_1=?, user_2=?");
        $row = $query->execute([$_REQUEST['message'], $_REQUEST['sender'], $_REQUEST['user_1'], $_REQUEST['user_2']]);
        $my_u_id = $_REQUEST['sender_id'];
        $seconduserid = $_REQUEST['user_2'];

        if ($row) {
            echo 1;
            exit;
        }
        break;
    case "getMessages":
        $my_u_id = $_SESSION['u_id'];
        $getMsgQ = "SELECT DISTINCT(message), date, id, user_1, user_2, sender_id FROM tbl_messages WHERE (user_1 = '$my_u_id' OR user_2 = '$my_u_id') AND (user_1 = '$chat_with' OR user_2 = '$chat_with') ORDER BY date ASC";
        $query = $pdo->prepare($getMsgQ);
        $row = $query->execute();
        $rs = $query->fetchAll(PDO::FETCH_OBJ);
        $chat = '';
        $myid = $seconduserid;

        foreach ($rs as $message) {
            if ($message->sender_id == $_SESSION['u_id']) {
                $chat .= '
                <li class="chat_user chat_right">
                    <div class="message-data align-right">
                        <span class="message-data-time">' . date('d M h:i a', strtotime($message->date)) . '</span> &nbsp; &nbsp;
                        <span class="message-data-name">' . $message->sender_id . '</span> <i class="fa fa-circle me"></i>
                    </div>
                    <div class="message other-message float-right">
                        ' . $message->message . '
                    </div>
                </li>';
            } else {
                $chat .= '
                <li class="chat_left">
                    <div class="message-data align-left">
                        <span class="message-data-name">' . $message->sender_id . '</span>
                        <span class="message-data-time">' . date('d M h:i a', strtotime($message->date)) . '</span> &nbsp; &nbsp;
                        <i class="fa fa-circle me"></i>

                    </div>
                    <div class="message my-message">
                        ' . $message->message . '
                    </div>
                </li>';
            }
        }
        echo $chat;
        break;
}
