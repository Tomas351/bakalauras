<?php require_once  'includes/front_header.php'  ?>
<?php confirm_login_v(); ?>


<?php
$offer_ID = "";
if (isset($_GET['id'])) {
    $offer_ID = $_GET['id'];
}
$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN tbl_users ON tbl_users.user_id = offers.user_id WHERE post_stamps.s_id = '" . $offer_ID . "'";

$result_of = query($sql_of);
while ($row_of = fetch_array($result_of)) {
    $id = $row_of['s_id'];
    $user_id_of_creator = $row_of['user_id'];
    $user_name_of_creator = $row_of['u_name'];
    $offer_id = $row_of['o_id'];
    $offer_country = $row_of['s_con'];
    $post_stamp_img = $row_of['s_img'];
    $offer_title = $row_of['o_title'];
    $offer_want = $row_of['o_want'];
    $offer_sum = $row_of['o_sum'];
    $offer_date = $row_of['created_at'];
    $post_year = $row_of['year'];
    $condition = $row_of['mint'];
}
?>


<section class="post-area">
    <div class="container">

        <div class="row">

            <div class="col-lg-1 col-md-0"></div>
            <div class="col-lg-10 col-md-12">

                <div class="main-post">

                    <div class="mb-4">

                        <h3 class="title mb-0 mt-3"><b><a href="chat.php?chat_with=<?php echo $user_id_of_creator; ?>"><?php echo $offer_title; ?> </a></b></h3>

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="chat.php?chat_with=<?php echo $user_id_of_creator; ?>"><img src="assets/images/avatar.jpg" alt="Profile Image"></a>
                            </div>
                            <div class="middle-area">
                                <div>
                                    Paskelbė: <a class="name" href="chat.php?chat_with=<?php echo $user_id_of_creator; ?>"><b><?php echo $user_name_of_creator; ?> </b></a>
                                </div>
                                Sukurtas: <h6 class="date"><?php $date = date_create($offer_date);
                                    echo date_format($date, "Y M d"); ?></h6>
                            </div>

                        </div>

                        <ul id="gallery" class="d-flex justify-content-center flex-wrap pure-js-lightbox-container">
                            <li class="p-2 border shadow" style="width: 200px;">
                                <a href="./assets/images/stamps/<?php echo $post_stamp_img; ?>"><img class="img-fluid" src="./assets/images/stamps/<?php echo $post_stamp_img; ?>" /></a>
                                <h4><b>Metai: <?php echo $post_year; ?></b></h4>
                                <h4><b>Būklė: <?php if($condition=1) echo "Nepanaudotas";if($condition=0) echo "Panaudotas"; ?></b></h4>
                            </li>
                        </ul>

                        <div class="">

                                <div class="card shadow border p-3">
                                    <h4><b>Siūlo</b></h4>
                                    <p class="mb-0"><?php echo $offer_sum; ?> </p>
                                </div>
                                <div class="card shadow border p-3 mt-2">
                                    <h4><b>Nori</b></h4>
                                    <p class="mb-0"><?php echo $offer_want; ?> </p>
                                 </div>

<section class="post-area section">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10 col-md-12">

                <div class="main-post">

                    <div class="blog-post-inner">
                        <section class="comment-section">
                            <h4><b>Pateikti pasiūlymą</b></h4>
                            <?php send_offer(); ?>
                            <div class="comment-form">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-12 mb-3">
                                            <h4>Pasirink pašto ženklus</h4>
                                            <div class="row">
                                                <?php
                                                $sql_stm = "SELECT * FROM  post_stamps WHERE u_id ='" . $_SESSION['u_id'] . "' ";
                                                $result_stm = query($sql_stm);
                                                if (mysqli_num_rows($result_stm) == 0) { ?>
                                                    <h4><a href="collection.php">Tu neturi įkeles pašto ženklų, įkelk juos į savo kolekcija paspaudes čia.</a></h4> <?php } else {
                                                while ($row_stm = fetch_array($result_stm)) {
                                                    $s_img = $row_stm['s_img'];
                                                    $s_id = $row_stm['s_id'];
                                                    ?>

                                                    <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center">
                                                        <label class="image-checkbox">
                                                            <img class="img-fluid" src="assets/images/stamps/<?php echo $s_img; ?>" />
                                                            <input type="checkbox" name="image[]" value="<?php echo $s_id; ?>" />
                                                            <i class="check-icon ion-checkmark"></i>
                                                        </label>
                                                    </div>
                                            </div>
                                            <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">
                                            <div class="text-center">
                                                <button class="mt-4 w-50 btn btn-primary" name="send-offer" type="submit" id="form-submit"><b>Pasiūlyti</b></button>
                                            </div>
                                                <?php } }?>

                                    </div><!-- row -->
                                </form>
                            </div><!-- comment-form -->
                        </section>
                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->


            </div><!-- row -->

        </div><!-- container -->
</section><!-- post-area -->
<!-- SCIPTS -->

<script src="assets/common-js/jquery-3.1.1.min.js"></script>

<script src="assets/common-js/tether.min.js"></script>

<script src="assets/common-js/bootstrap.js"></script>


<script src="assets/common-js/scripts.js"></script>

<?php require_once  'includes/frontend_scripts.php'  ?>

<style>
  .nopad {
    padding-left: 0 !important;
    padding-right: 0 !important;
  }

  /*image gallery*/
  .image-checkbox {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border: 4px solid transparent;
    margin-bottom: 0;
    outline: 0;
  }

  .image-checkbox input[type="checkbox"] {
    display: none;
  }

  .image-checkbox-checked {
    border-color: #4783B0;
  }

  .image-checkbox .check-icon {
    position: absolute;
    color: transparent;
    ;
    background-color: transparent;
    padding: 5px;
    top: 0;
    right: 0;
    width: 25px;
    height: 25px;
  }

  .image-checkbox-checked .check-icon {
    display: block !important;
    background-color: green;
    color: #fff;
  }
</style>

<script>
    // image gallery
    // init the state from the input
    $(".image-checkbox").each(function() {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        } else {
            $(this).removeClass('image-checkbox-checked');
        }
    });

    // sync the state to the input
    $(".image-checkbox").on("click", function(e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked", !$checkbox.prop("checked"))

        e.preventDefault();
    });
</script>

</body>

</html>