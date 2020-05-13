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

							<?php if (!isset($_GET['source']) and $desc !== '') : ?>

								<?php echo $desc; ?>
								<a name="" id="" class="btn btn-primary btn-sm ml-3" href="myprofile.php?source=add-details" role="button"> Keisti duomenis
								</a>

							<?php endif; ?>

						</p>


					</div><!-- post-top-area -->

				</div><!-- main-post -->
			</div><!-- col-lg-8 col-md-12 -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- post-area -->
<section class="comment-section center-text mt-5">
	<div class="container">
		<h4 class="mb-2"><b> Atsiliepimai</b></h4>
		<div class="row">

			<div class="col-lg-8 offset-lg-2 col-md-12">
				<?php
				$avg_stars = 1;
				$offer_ID = "";
				if (isset($_GET['id'])) {
					$offer_ID = $_GET['id'];
				}
				$sql_of = "SELECT * FROM  feedback INNER JOIN tbl_users ON tbl_users.user_id = feedback.u_id WHERE u_id = " . $_SESSION['u_id'];
				$result_of = query($sql_of);
				$total_feedbacks = row_count($result_of);

				$avg_stars = 0;
				$total_stars = 0;
				$feedback_html = '';
				$feedback_card_html = '';
				if ($result_of->num_rows > 0) {
					while ($row_of = fetch_array($result_of)) {
						$f_id = $row_of['f_id'];
						$u_name = $row_of['u_name'];
						$feedback = $row_of['feedback'];
						$o_id = $row_of['o_id'];
						$u_id = $row_of['u_id'];
						$stars = intval($row_of['stars']);
						$given_at = $row_of['given_at'];
						$date2 = date_create($given_at);
						$specialClass = '';
						if ($u_id == $_SESSION['u_id']) {
							$specialClass = "alert-primary";
						}

						$total_stars = $total_stars + $stars;
						$feedback_html .= "<div class='commnets-area text-left " . $specialClass . "'> <div class='comment'> <div class='post-info'> <div class='left-area'> <a class='avatar'><img src='assets/images/avatar.jpg' alt='Profile Image'></a> </div> <div class='middle-area'> <a class='name'><b> " . $u_name . " </b> </a> <h6 class='date'> " . date_format($date2, ' M d, Y -- H:i A') . " </h6> </div> <div class='rating_area'> <img class='rating' src='./assets/images/ratings/" . $stars . "star.png' alt=''> </div> </div><!-- post-info --> <p> " . $feedback . " </p> </div> </div>";
					}
					echo $feedback_html;
					$avg_stars = $total_stars / $total_feedbacks;
					echo $feedback_card_html = "<div class='card border p-4'> <div class='card-body'> <div class='d-flex justify-content-between'> <div class=''> <h6 class=''>Išviso atsiliepimų: <b> " . $total_feedbacks . " </b></h6> </div> <div class=''> <h6 class=''>Vidutinis reitingas: <img class='rating' height='16' width='auto' src='./assets/images/ratings/" . $avg_stars . "star.png' alt=''></h6> </div> </div> </div> </div>";
					$avg_stars = intval($avg_stars);
				?>
				<?php 	} else { ?>
					<div class="alert alert-danger">
						Nėra jokių atsiliepimų
					</div><!-- /.alert alert-danger END -->
				<?php } ?>
				<!-- <a class="more-comment-btn" href="#"><b>Žiūrėti daugiau atsiliepimų</a> -->
			</div><!-- col-lg-8 col-md-12 -->
		</div><!-- row -->

	</div><!-- container -->
</section>


<!-- SCIPTS -->

<script src="assets/common-js/jquery-3.1.1.min.js"></script>

<script src="assets/common-js/tether.min.js"></script>

<script src="assets/common-js/bootstrap.js"></script>

<script src="assets/common-js/scripts.js"></script>

<?php require_once  'includes/frontend_scripts.php'  ?>
<script type="text/javascript" src="assets/stars/stars.js"></script>

<script>
	$(".text").stars({
		text: ["1 star", "2 star", "3 star", "4 star", "5 star"]
	});
	$(".click-callback").stars({
		stars: 5,
		// emptyIcon: 'fa-star-o',
		// filledIcon: 'fa-star',
		color: '#E4AD22',
		value: 0,
		click: function(i) {
			// alert("Star " + i + " selected.");
			document.getElementById("rating_input").value = i;
			// alert(document.getElementById("rating_input").value);
		}
	});
</script>

</body>

</html>