<?php require_once  'includes/front_header.php'  ?>
<?php confirm_login_v(); ?>

<link rel="stylesheet" href="assets/common-css/chat.css">
<?php
$nextid = "1";
$u_id2 = 0;
$chat_with = "1";
if (isset($_GET['chat_with'])) {
    $nextid = $_GET['chat_with'];
    $_SESSION['chat_with'] = $_GET['chat_with'];
}


$sql_of = "SELECT * FROM  tbl_users WHERE user_id = '$nextid'";
$result_of2 = query($sql_of);

if ($result_of2->num_rows > 0) {
    while ($row_of = fetch_array($result_of2)) {
        $u_id2 = $row_of['user_id'];
        $chat_with = $row_of['u_name'];
    }
}
?>

<div class="w-100"></div><!-- /.w-100 END -->


<section class="container">
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="container chat_app mt-3">
                <div class="row">
                    <!-- <div class="col-md-3">
                        <div class="people-list" id="people-list">
                            <?php
                            $sql_of = "SELECT DISTINCT * FROM  tbl_messages ";
                            $sql_of .= "INNER JOIN tbl_users ON tbl_users.user_id = tbl_messages.sender_id WHERE sender_id = " . $_SESSION['u_id'];
                            $result_of = query($sql_of);
                            if ($result_of->num_rows > 0) {
                            ?>
                                <ul class="list">
                                    <?php
                                    while ($row_of = fetch_array($result_of)) {
                                        $username = $row_of['u_name'];
                                        $user2_id = 0;
                                        if ($row_of['user_1'] != $_SESSION['u_id']) {
                                            $user2_id = $row_of['user_1'];
                                        } else if ($row_of['user_2'] != $_SESSION['u_id']) {
                                            $user2_id = $row_of['user_2'];
                                        }
                                    ?>
                                        <li class="chat_user">
                                            <a href="chat.php?chat_with=<?php echo $user2_id; ?>">
                                                <img src="assets/images/avatar.jpg" alt="avatar" />
                                                <div class="about">
                                                    <div class="name"><?php echo $username; ?></div>
                                                    <div class="status">
                                                        <i class="fa fa-circle online"></i> online
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                                </ul>
                                <?php
                                ?>
                        </div>
                    </div> -->
                    <div class="col-md-9">
                        <div class="chat">
                            <div class="chat-header clearfix">
                                <img src="assets/images/avatar.jpg" alt="avatar" />

                                <div class="chat-about">
                                    <div class="chat-with">Susirašinėjimas su <?php echo  $chat_with; ?></div>
                                    <?php
                                    $sql_stm = "SELECT * FROM  tbl_messages LIMIT 1";
                                    $result_stm = query($sql_stm);
                                    if ($result_stm->num_rows > 0) {
                                        while ($row_stm = fetch_array($result_stm)) {
                                            $last_msg_date =  date_format(date_create($row_stm['date']), "M d, Y H:i A");
                                    ?>
                                            <div class="chat-num-messages">Paskutinį kartą aktyvus <?php echo $last_msg_date; ?></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <i class="fa fa-star"></i>
                            </div>

                            <div class="chat-history">
                                <ul id="chat"></ul>
                            </div>

                            <div class="chat-message clearfix">
                                <form class="" id="msgform" action="" method="post">
                                    <textarea name="message" placeholder="Įrašykite žinute" rows="1" cols="80" class="textarea"></textarea>
                                </form>
                                <button onclick="myFunction()" class="send_chat">Siųsti</button>
                            </div>

                        </div> 
                    </div>
                </div>
            </div> 

        </div><!-- col-lg-8 col-md-12 -->
    </div><!-- row -->
</section><!-- post-area -->



<script src="./assets/common-js/jquery-3.1.1.min.js"></script>

<script src="./assets/common-js/tether.min.js"></script>

<script src="./assets/common-js/bootstrap.js"></script>

<script src="./assets/common-js/scripts.js"></script>
<?php require_once  'includes/frontend_scripts.php'  ?>

<script>
    $(".image-checkbox").each(function() {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        } else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    $(".image-checkbox").on("click", function(e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked", !$checkbox.prop("checked"))
        e.preventDefault();
    });
</script>

<script type="text/javascript">
    LoadChat();
    setInterval(function() {
        LoadChat();
    }, 1500);

    function LoadChat() {
        console.log("LoadChat");
        $.post('./chat/handlers/messages.php?action=getMessages', function(response) {
            var scrollpos = $('#chat').scrollTop();
            var scrollpos = parseInt(scrollpos) + 420;
            var scrollHeight = $('#chat').prop('scrollHeight');
            $('#chat').html(response);
            if (scrollpos < scrollHeight) {

            } else {
                $('#chat').scrollTop($('#chat').prop('scrollHeight'));
            }

        })
    }

    function myFunction() {
        var audio = new Audio('chat/click.mp3');
        audio.play();
        $('form').submit();
    }


    $('form#msgform').submit(function() {
        var sendID = <?php echo $_SESSION['u_id']; ?>;
        var nextID = <?php echo $u_id2; ?>;
        var message = $('.textarea').val();
        $.post('./chat/handlers/messages.php?action=sendMessage&message=' + message + '&sender=' + sendID + '&user_1=' + sendID + '&user_2=' + nextID, function(response) {
            if (response == 1) {
                LoadChat();
                console.log("response");
                document.getElementById('msgform').reset();
            }
        });
        console.log("end");
        e.preventDefault();
        return false;
    })
</script>

</body>

</html>