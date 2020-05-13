<?php
ob_start();

// for redirecting page
function Redirect_to($location)
{
    header("Location:{$location}");
    exit;
}
function errorMsg()
{
    if (isset($_SESSION['error'])) {
        $Output = "<div class='alert alert-danger alert-dismissible fade show '>";
        $Output .= htmlentities($_SESSION['error']);
        $Output .= "<button type='button'class='close' data-dismiss='alert' aria-label='Close'>";
        $Output .= "<span aria-hidden='true'>&times;</span>";
        $Output .= '</div>';

        echo $Output;
        unset($_SESSION['error']);
    }
}
function successMsg()
{
    if (isset($_SESSION['success'])) {
        $Output = "<div class='alert alert-success alert-dismissible fade show'>";
        $Output .= htmlentities($_SESSION['success']);
        $Output .= "<button type='button'class='close' data-dismiss='alert' aria-label='Close'>";
        $Output .= "<span aria-hidden='true'>&times;</span>";
        $Output .= '</div>';

        echo $Output;
        unset($_SESSION['success']);
    }
}

// formu klaida
function validation_errors($error_message)
{
    $error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible " role="alert">
     <strong> Klaida:</strong> $error_message
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
     </button>
</div>
DELIMITER;
    return $error_message;
}

// check if email already existed
function email_Exist($email)
{
    $sql = " SELECT * FROM tbl_users WHERE u_email = '$email' ";
    $result = query($sql);
    confirm($result);
    if (row_count($result) > 0) {
        return true;
    } else {
        return false;
    }
}


//   ****************** visitor user functions ******************** //


// add user
function add_v_user()
{
    if (isset($_POST['addv_v_user'])) {
        $u_name = str_replace(' ', '', escape($_POST['name']));
        $u_email = escape($_POST['email']);
        $u_password = escape($_POST['password']);
        $u_c_password = escape($_POST['c-password']);
        $role = escape($_POST['role']);

        $errors = [];

        if (empty($u_name) || empty($u_email) || empty($u_password) || empty($u_c_password)) {
            $errors[] = 'Visi laukai yra privalomi';
        }
        if ($u_password !== $u_c_password) {
            $errors[] = 'Slaptažodžiai nesutampa';
        }

        if (email_Exist($u_email)) {
            $errors[] = 'El. paštas jau užimtas';
        }


        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            $hashedPassword = password_hash($u_password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO tbl_users(u_name, u_email, u_password, role) ';
            $sql .= "VALUES('$u_name' , '$u_email' , '$hashedPassword', '$role')";
            $executeSql = query($sql);
            confirm($executeSql);
            if ($executeSql) {
                $_SESSION['success'] = 'Sėkmingai užsiregistravai ' . "$u_name";
                Redirect_to('login.php');
            }
        }
    }
}


function filter_offer()
{
    if (isset($_POST['search_filter'])) {
        $filter_o_1 = str_replace(' ', '', escape($_POST['filter_o_1']));
        $filter_o_2 = escape($_POST['filter_o_2']);
        $filter_o_3 = escape($_POST['filter_o_3']);
        // $page = escape($_POST['page']);

        $url_to_redirect = '?' . 'filter_o_1' . '=' . $filter_o_1 . '&filter_o_2' . '=' . $filter_o_2 . '&filter_o_3' . '=' . $filter_o_3;
        Redirect_to($url_to_redirect);
    }
}

// add_details

function add_details()
{

    if (isset($_POST['add-details'])) {
        $user_id = $_SESSION['u_id'];
        $det = escape($_POST['details']);
        $det = trim($det);

        $errors = [];

        if (empty($det)) {

            $errors[] = 'Aprašymas negali būti tusčias';
        }


        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            $add_det = " UPDATE tbl_users SET u_desc = '$det' WHERE user_id = '$user_id' ";
            $execute = query($add_det);
            confirm($execute);
            if ($execute) {

                $_SESSION['success'] = 'Aprašymas sėkmingai pridėtas';
                Redirect_to('myprofile.php');
            }
        }
    }
}

// update user_visitor
function update_user_v()
{
    if (isset($_POST['edit-user-v'])) {
        $user_id = $_SESSION['u_id'];
        $u_name = escape($_POST['name']);
        $u_email = escape($_POST['email']);
        $u_pass = escape($_POST['password']);

        $sql_u_mail = "SELECT * FROM tbl_users WHERE u_email = '$u_email' AND user_id != '$user_id' ";
        $result_mail = query($sql_u_mail);

        $errors = [];

        if (empty($u_name)  || empty($u_email)) {
            $errors[] = 'Vartotojo vardas ir el. paštas negali būti tusčias';
        }
        if (empty($u_pass)) {
            $errors[] = 'Slaptažodis negali būti tusčias';
        }

        if (row_count($result_mail) > 0) {
            $errors[] = 'El. paštas jau egzistuoja';
        }


        if (!empty($u_pass)) {
            $sql_user = " SELECT u_password FROM tbl_users WHERE user_id = '$user_id' ";
            $result_user = query($sql_user);
            confirm($result_user);
            $row = fetch_array($result_user);
            $db_u_password = $row['u_password'];

            if ($db_u_password != $u_pass) {

                $hashed_pass = password_hash($u_pass, PASSWORD_DEFAULT);
            }
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo validation_errors($error);
                }
            } else {
                $sql = " UPDATE tbl_users SET u_name = '$u_name' , u_password = '$hashed_pass' , u_email = '$u_email' ";
                $sql .= " WHERE user_id = $user_id ";
                $executeSql = query($sql);
                confirm($executeSql);
                if ($executeSql) {

                    $_SESSION['success'] = 'Sėkmingai atnaujinti duomenys';
                    Redirect_to('myprofile.php');
                }
            }
        }
    }
}



// SUBMIT FEEDBACK OF OFFER
function submit_feedback_of_ooffer()
{
    if (isset($_POST['submit_offer_feedback'])) {
        $user_id = $_SESSION['u_id'];
        $offer_id = escape($_POST['offer_id']);
        $rating_input = escape($_POST['rating_input']);
        $offer_feedback = $_POST['offer_feedback'];
        $errors = [];


        if ((empty($user_id)) || (empty($user_id)) || (empty($user_id))) {
            $errors[] = "Kažkas netaip";
        } else {
            $sql = "INSERT INTO feedback (u_id, o_id, feedback, stars) VALUES('" . $user_id . "', '" . $offer_id . "', '" . $offer_feedback . "', '" . $rating_input . "')";
            $executeSql = query($sql);
            confirm($executeSql);
            if ($executeSql) {
                $_SESSION['success'] = 'Atsiliepimas pridėtas';
                Redirect_to('offer-detail.php?id=' . $offer_id);
            }
        }
    }
}

// login visitor user
$login_errors_v = [];
function user_v_login()
{
    global $login_errors_v;
    if (isset($_POST['login_v'])) {
        $username = escape($_POST['username']);
        $password = escape($_POST['password']);
        $sql = "SELECT * FROM tbl_users WHERE u_name = '$username'";
        echo $sql;
        $result = query($sql);

        if ($row = fetch_array($result)) {
            $dbPassword = $row['u_password'];
            $pwdCheck = password_verify($password, $dbPassword);
            $db_u_id = $row['user_id'];
            $db_u_name = $row['u_name'];


            if ($pwdCheck == true) {
                $_SESSION['u_id'] = $db_u_id;
                $_SESSION['u_name'] = $db_u_name;
                $_SESSION['success'] = "Sveikas sugrįžes {$_SESSION['u_name']}  ";
                Redirect_to('index.php');
            } else {
                $login_errors_v['p'] = 'Neteisingas slaptažodis';
            }
        } else {
            $login_errors_v['u'] = 'Neteisingas vartotojo vardas';
        }
    }
}

// if visitor_user login
function login_v()
{
    if (isset($_SESSION['u_id'])) {
        return true;
    }
}

// redir login

function confirm_login_v()
{
    if (!login_v()) {
        Redirect_to('login.php');
    }
}

// ************************   Stamp collection ********************* //


// add stamp
function add_stamp()
{
    if (isset($_POST['add_stamp'])) {

        $con = escape($_POST['con']);
        $des = escape($_POST['des']);
        $user_id  = $_SESSION['u_id'];

        // For stamp  image

        $image_name = $_FILES['post_image']['name'];
        $image_tmp_name = $_FILES['post_image']['tmp_name'];
        $image_size = $_FILES['post_image']['size'];

        $image_ext = explode('.', $image_name);

        $image_actual_ext = strtolower(end($image_ext));

        $allowed_files = ['jpg', 'jpeg', 'png'];

        if (empty($image_tmp_name)) {
            $errors[] = 'Įkelti nuotrauka yra būtina';
        }

        else {
            if (!in_array($image_actual_ext, $allowed_files)) {
                $errors[] = 'Galima kelti tik jpg ir png failus!';
            } else {
                $image_new_name = uniqid('', true) . '.' . $image_actual_ext;
            }
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            $sql = " INSERT INTO post_stamps(s_img,s_con,s_des,u_id) VALUES('$image_new_name','$con','$des','$user_id') ";
            $execute = query($sql);
            confirm($execute);
            if ($execute) {
                move_uploaded_file($image_tmp_name, "assets/images/stamps/$image_new_name");
                $_SESSION['success'] = 'Pašto ženklas pridėtas sėkmingai!';
                Redirect_to('collection.php');
            }
        }
    }
}


// update stamp

function update_stamp()
{

    if (isset($_POST['edit_stamp'])) {


        $edit_stamp_id = $_GET['edit_stamp'];
        $errors = [];
        $con = str_replace(' ', '', strtolower(escape($_POST['con'])));
        $des = escape($_POST['des']);
        $user_id  = $_SESSION['u_id'];

        $image_name = $_FILES['post_image']['name'];
        $image_tmp_name = $_FILES['post_image']['tmp_name'];
        $image_size = $_FILES['post_image']['size'];

        $image_ext = explode('.', $image_name);

        $image_actual_ext = strtolower(end($image_ext));

        $allowed_files = ['jpg', 'jpeg', 'png'];
        $image_new_name = uniqid('', true) . '.' . $image_actual_ext;


        if (empty($image_name)) {
            $sql_img = " SELECT * FROM post_stamps WHERE s_id = '$edit_stamp_id' ";
            $execute_sql_img = query($sql_img);
            while ($row = fetch_array($execute_sql_img)) {
                $image_new_name = $row['s_img'];
            }
        } elseif (!empty($image_name)) {
            $deleteImage = " SELECT * FROM post_stamps WHERE s_id = '$edit_stamp_id' ";
            $execute = query($deleteImage);
            confirm($execute);
            $row = fetch_array($execute);
            $image = $row['s_img'];
            unlink("assets/images/stamps/$image");
        }


        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo validation_errors($error);
            }
        } else {
            $query = "UPDATE post_stamps SET s_img = '$image_new_name', s_con = '$con', s_des = '$des'  WHERE s_id = '$edit_stamp_id'  ";

            $execute = query($query);
            confirm($execute);

            if ($execute) {

                move_uploaded_file($image_tmp_name, "assets/images/stamps/$image_new_name");

                $_SESSION['success'] = 'Pašto ženklas atnaujintas sėkmingai';
                Redirect_to('collection.php');
            }
        }
    }
}

// delete post_stamp

function post_stamp_delete()
{
    if (isset($_GET['delete_stamp'])) {

        $post_delete_id = $_GET['delete_stamp'];

        $deleteImage = " SELECT * FROM post_stamps WHERE s_id = '$post_delete_id' ";
        $execute = query($deleteImage);
        $row = fetch_array($execute);
        $image1 = $row['s_img'];

        unlink("assets/images/stamps/$image1");


        $sql = " DELETE FROM post_stamps WHERE s_id = '$post_delete_id' ";
        $execute = query($sql);
        confirm($execute);
        if ($execute) {
            $_SESSION['success'] = 'Pašto ženklas ištrintas sėkmingai';
            Redirect_to('collection.php');
        }
    }
}

function add_offer()
{

    if (isset($_POST['add-offer'])) {

        $title = escape($_POST['title']);

        $sum = escape($_POST['sum']);
        $want = escape($_POST['want']);
        $user_id = $_SESSION['u_id'];
        $sql = "INSERT INTO offers(o_title,o_sum, o_want,user_id) VALUES('$title','$sum','$want',$user_id)";
        $execute = query($sql);
        confirm($execute);
        global $con;
        $last_id = mysqli_insert_id($con);
        $user_id = $_SESSION['u_id'];
        if (isset($_POST['image'])) {

            $img_ids = $_POST['image'];
            foreach ($img_ids as $img_id) {

                $sql_ids = "INSERT INTO stamp_offer(stamp_id, offer_id) VALUES('$img_id',$last_id) ";
                $execute_ids = query($sql_ids);
                confirm($execute_ids);
            }
        }

        $_SESSION['success'] = 'Skelbimas sukurtas sėkmingai';

        Redirect_to('myprofile.php');
    }
}

function offer_delete()
{
    if (isset($_GET['delete-offer'])) {
        $offer_delete_id = $_GET['delete-offer'];


        $sql = " DELETE FROM offers WHERE o_id = '$offer_delete_id' ";
        $execute = query($sql);
        confirm($execute);
        if ($execute) {
            $_SESSION['success'] = 'Skelbimas ištrintas sėkmingai';
            Redirect_to('myprofile.php');
        }
    }
}
