<?php require_once  'includes/front_header.php'  ?>
<?php confirm_login_v(); ?>
<section class="post-area">
  <div class="container">

    <div class="row">

      <div class="col-lg-1 col-md-0"></div>
      <div class="col-lg-10 col-md-12">

        <div class="main-post">
          <?php
          $sql = "SELECT * FROM tbl_users WHERE user_id = '" . $_SESSION['u_id'] . "' ";
          $result = query($sql);
          $row = fetch_array($result);
          $name = $row['u_name'];
          $email = $row['u_email'];
          $created_at = $row['created_at'];
          $desc = $row['u_desc'];
          ?>
          <div class="post-top-area">
            <div class="post-info">

              <div class="left-area">
                <a class="avatar" href="#"><img src="assets/images/avatar.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <h3 class=""><a href="#"><b> <?php echo $name; ?> </b></a></h3>
                <h6 class="date">
                  Vartotojas nuo:
                  <?php $date = date_create($created_at);
                  echo date_format($date, 'M d, Y'); ?>
                </h6>
              </div>

            </div><!-- post-info -->
            <?php successMsg(); ?>
            <p class="mb-5">

              <?php if ($desc == '' and !isset($_GET['source'])) : ?>

                <a name="" id="" class="btn btn-primary btn-sm" href="myprofile.php?source=add-details" role="button"> Pridėti aprašymą apie save
                </a>

              <?php endif; ?>

              <?php if (isset($_GET['source'])) : ?>

                <?php include_once 'includes/add_deatail_form.php' ?>

              <?php endif; ?>

              <?php if (!isset($_GET['source']) and $desc != '') : ?>

                <?php echo $desc; ?>
                <a name="" id="" class="btn btn-primary btn-sm ml-3" href="myprofile.php?source=add-details" role="button"> Keisti aprašymą
                </a>

              <?php endif; ?>

            </p>


          </div><!-- post-top-area -->

        </div><!-- main-post -->
      </div><!-- col-lg-8 col-md-12 -->
    </div><!-- row -->
  </div><!-- container -->
</section><!-- post-area -->

<section class="post-area section">
  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-10 col-md-12">

        <div class="main-post">

          <div class="blog-post-inner">
            <section class="comment-section">
              <h4><b>Redaguoti profilį</b></h4>
              <div class="comment-form">
                <?php update_user_v(); ?>
                <form method="post">
                  <div class="row">

                    <div class="col-sm-6">
                      <input type="text" aria-required="true" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Slaptažodis" aria-invalid="true" required>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                      <input type="email" aria-required="true" value="<?php echo $email; ?>" name="email" class="form-control" placeholder="El. paštas" aria-invalid="true" required>
                    </div><!-- col-sm-6 -->

                    <div class="col-sm-12">
                      <input type="password" aria-required="true" name="password" class="form-control" placeholder="Slaptažodis" aria-invalid="true" required>
                    </div><!-- col-sm-12 -->
                    <div class="col-sm-12">
                      <button class="submit-btn" name="edit-user-v" type="submit" id="form-submit"><b>Išsaugoti</b></button>
                    </div><!-- col-sm-12 -->

                  </div><!-- row -->
                </form>
              </div><!-- comment-form -->
            </section>

          </div><!-- main-post -->
        </div><!-- col-lg-8 col-md-12 -->


      </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->

<section class="post-area section">
  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-10 col-md-12">

        <div class="main-post">

          <div class="blog-post-inner">
            <section class="comment-section">
              <h4><b>Sukurti skelbimą</b></h4>
              <?php add_offer(); ?>
              <div class="comment-form">
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12 mb-3">
                      <h4>Pasirink pašto ženklus</h4>
                      <div class="row">
                        <?php
                        $sql_stm = "SELECT * FROM  post_stamps WHERE u_id ='" . $_SESSION['u_id'] . "' ";
                        $result_stm = query($sql_stm);
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

                        <?php } ?>
                      </div>

                    </div>

                    <div class="col-sm-12 mt-4">
                      <textarea name="title" rows="2" class="text-area-messge form-control" placeholder="Pavadinimas" aria-required="true" aria-invalid="false"></textarea>
                    </div><!-- col-sm-12 -->

                    <div class="col-sm-12">
                      <textarea name="sum" rows="2" class="text-area-messge form-control" placeholder="Ką siūlai" aria-required="true" aria-invalid="false"></textarea>
                    </div><!-- col-sm-12 -->
                    <div class="col-sm-12">
                      <textarea name="want" rows="2" class="text-area-messge form-control" placeholder="Ką nori gauti" aria-required="true" aria-invalid="false"></textarea>
                    </div><!-- col-sm-12 -->
                    <div class="col-sm-12">
                      <button class="submit-btn" name="add-offer" type="submit" id="form-submit"><b>Sukurti skelbimą</b></button>
                    </div><!-- col-sm-12 -->

                  </div><!-- row -->
                </form>
              </div><!-- comment-form -->
            </section>
          </div><!-- main-post -->
        </div><!-- col-lg-8 col-md-12 -->


      </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->


<section class="blog-area section">
	<div class="container">

		<div class="row">

			<div class="col-lg-12">
				<h4><b>Mano skelbimai</b></h4>

			</div><!-- /.col-lg-12 END -->



			<?php
			$filter_o_1 = "";
			$filter_o_2 = "";
			$filter_o_3 = "";
      $u_id = $_SESSION['u_id'];
			$sql_of = '';
			$filter = false;
			if (isset($_GET['filter_o_1'])) {
				$filter_o_1 = $_GET['filter_o_1'];
				if (!empty($filter_o_1)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_con WHERE c_id = '$filter_o_1' AND user_id = $u_id";
				}
			}
			if (isset($_GET['filter_o_2'])) {
				$filter_o_2 = $_GET['filter_o_2'];
				if (!empty($filter_o_2)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_conn WHERE s_des = '$filter_o_2' AND user_id = $u_id";
				}
			}
			if (isset($_GET['filter_o_3'])) {
				$filter_o_3 = $_GET['filter_o_3'];
				if (!empty($filter_o_3)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_conn WHERE o_want = '$filter_o_3' AND user_id = $u_id";
				}
			}
			// if (!$_GET['filter_o_3'] and !$_GET['filter_o_3']) {
			// }

			if (!$filter) {
				$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_con WHERE user_id = $u_id";
			}
			// echo $sql_of;
			$result_of = query($sql_of);
			while ($row_of = fetch_array($result_of)) {
				$id = $row_of['s_id'];
				$offer_id = $row_of['o_id'];
				$c_name = $row_of['c_name'];
				$post_stamp_img = $row_of['s_img'];
				$offer_title = $row_of['o_title'];
				$offer_want = $row_of['o_want'];
				$offer_sum = $row_of['o_sum'];

                $sql = "SELECT COUNT(*) FROM sent_offers WHERE sent_offers.o_id = $offer_id";
                $result = query($sql);
                $row = fetch_array($result);
                $kiek_offer = $row['COUNT(*)'];
			?>
				<?php
				//  $sql_stm_of = "SELECT * FROM  stamp_offer WHERE offer_id = '$offer_id' ";
				//  $result_stm_of = query($sql_stm_of);
				//  while ($row_stm_of = fetch_array($result_stm_of)) {
				//    $title = $row_stm_of['o_title'];
				?>
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">
							<div class="blog-image"><img src="assets/images/stamps/<?php echo $post_stamp_img; ?>" alt="Blog Image"></div>
							<!-- <a class="avatar" href=""> -->
							<img class="avatar" src="assets/images/avatar.jpg" alt="Profile Image">
							<!-- </a> -->
							<div class="text-left p-3">
								<h4 class="text-center text-primary"><b><?php echo $offer_title; ?></b></h4>
								<div><b>Siūlau</b> <?php echo $offer_sum; ?></div>
								<div><b>Noriu</b> <?php echo $offer_want; ?></div>
							</div>

							<ul class="post-footer">
								<li><a href="#"><i class="ion-android-alert"></i>Pasiūlymai:
                                        <?php echo $kiek_offer;?> </a></li>
                <li><a onclick="return confirm('Ar esi tikras, kad nori ištrinti šį skelbimą?')" href="myprofile.php?delete-offer=<?php echo $offer_id; ?>" class="text-danger"><i class="ion-android-delete"></i>
                        Ištrinti</a></li>
								<li><a href="offer-detail.php?id=<?php echo $id; ?>"><i class="ion-eye"></i>Aprašymas</a></li>
							</ul>
							<?php offer_delete(); ?>
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
			<?php } ?>
		</div><!-- row -->

	</div><!-- container -->
</section><!-- section -->

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