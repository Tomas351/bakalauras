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

						</div><!-- post-info -->

						<ul id="gallery" class="d-flex justify-content-center flex-wrap pure-js-lightbox-container">
							<li class="p-2 border shadow" style="width: 200px;">
								<a href="./assets/images/stamps/<?php echo $post_stamp_img; ?>"><img class="img-fluid" src="./assets/images/stamps/<?php echo $post_stamp_img; ?>" /></a>
							</li>
						</ul>

						<div class="">

							<div class="mt-4">
								<div class="card shadow border p-3">
									<h4><b>Siūlo</b></h4>
									<p class="mb-0"><?php echo $offer_sum; ?> </p>
								</div>
								<div class="card shadow border p-3 mt-2">
									<h4><b>Nori</b></h4>
									<p class="mb-0"><?php echo $offer_want; ?> </p>
								</div>

								<div class="text-center">
									<?php if ($user_id_of_creator == $_SESSION['u_id']) { ?>
										<button class="mt-4 w-50 btn btn-primary disabled">Pasiūlyti</button>
									<?php } else { ?>
										<a href="chat.php?chat_with=<?php echo $user_id_of_creator; ?>" class="mt-4 w-50 btn btn-primary">Pasiūlyti</a>
									<?php } ?>
								</div><!-- /.text-center END -->
							</div>
						</div><!-- post-bottom-area -->
					</div>

				</div><!-- main-post -->
			</div><!-- col-lg-8 col-md-12 -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- post-area -->

<section class="comment-section center-text mt-5">
	<div class="container">
		<h4><b>Palikti atsiliepimą</b></h4>
		<div class="row">

			<div class="col-lg-8 offset-lg-2 col-md-12">
				<div class="text-center">
					<?php if ($user_id_of_creator == $_SESSION['u_id']) { ?>
						<div class="alert alert-danger mt-3">
							Negalima palikti sau atsiliepimo
						</div><!-- /.alert alert-danger END -->
					<?php } else { ?>
						<div class="comment-form">
							<form method="post">
								<div class="row">
									<div class="col-md-12">
										<?php successMsg();  ?>
										<?php submit_feedback_of_ooffer();  ?>
									</div>

									<div class="col-sm-12">
										<div class="click-callback"></div>
									</div>
									<div class="col-sm-12">
										<input type="hidden" aria-required="true" id="rating_input" name="rating_input">
										<input type="hidden" aria-required="true" value="<?php echo $_SESSION['u_id']; ?>" id="u_id" name="u_id">
										<input type="hidden" aria-required="true" value="<?php echo $offer_ID; ?>" id="offer_id" name="offer_id">
									</div>
									<div class="col-sm-12">
										<textarea name="offer_feedback" rows="2" class="text-area-messge form-control" placeholder="Įvesk atsiliepimą" aria-required="true" aria-invalid="false"></textarea>
									</div><!-- col-sm-12 -->
									<div class="col-sm-12">
										<button class="submit-btn" name="submit_offer_feedback" type="submit" id="submit_offer_feedback"><b>Išsaugoti atsiliepimą</b></button>
									</div><!-- col-sm-12 -->

								</div><!-- row -->
							</form>
						</div><!-- FEEDBACK-form -->
					<?php } ?>
				</div><!-- /.text-center END -->


				<h4><b>Atsiliepimai</b></h4>
				<?php
				$avg_stars = 0;
				$offer_ID = "";
				if (isset($_GET['id'])) {
					$offer_ID = $_GET['id'];
				}
				$sql_of = "SELECT * FROM  feedback INNER JOIN tbl_users ON tbl_users.user_id = feedback.u_id";
				$result_of = query($sql_of);
				$total_feedbacks = row_count($result_of);
				?>

				<?php
				$avg_stars = 0;
				$total_stars = 0;
				$feedback_html = '';
				$feedback_card_html = '';
				while ($row_of = fetch_array($result_of)) {
					$f_id = $row_of['f_id'];
					$u_name = $row_of['u_name'];
					$feedback = $row_of['feedback'];
					$o_id = $row_of['o_id'];
					$u_id = $row_of['u_id'];
					$stars = $row_of['stars'];
					$given_at = $row_of['given_at'];
					$date2 = date_create($given_at);
					$specialClass = '';
					if ($u_id == $_SESSION['u_id']) {
						$specialClass = "alert-primary";
					}

					$total_stars = $total_stars + $stars;
					$feedback_html .= "<div class='commnets-area text-left " . $specialClass . "'> <div class='comment'> <div class='post-info'> <div class='left-area'> <a class='avatar'><img src='assets/images/avatar.jpg' alt='Profile Image'></a> </div> <div class='middle-area'> <a class='name'><b> " . $u_name . " </b> </a> <h6 class='date'> " . date_format($date2, ' M d, Y -- H:i A') . " </h6> </div> <div class='rating_area'> <img class='rating' src='./assets/images/ratings/ " . $stars . " star.png' alt=''> </div> </div><!-- post-info --> <p> " . $feedback . " </p> </div> </div>";
				}
				
				if($total_feedbacks!=0){
					$avg_stars = $total_stars / $total_feedbacks;
					$avg_stars = intval($avg_stars);


				}
				echo $feedback_card_html = "<div class='card border p-4'> <div class='card-body'> <div class='d-flex justify-content-between'> <div class=''> <h6 class=''>Išviso atsiliepimų: <b> " . $total_feedbacks . " </b></h6> </div> <div class=''> <h6 class=''>Vidutinis reitingas: <img class='rating' height='16' width='auto' src='./assets/images/ratings/" . $avg_stars . "star.png' alt=''></h6> </div> </div> </div> </div>";
				echo $feedback_html;
				?>
				<!-- <a class="more-comment-btn" href="#"><b>VIEW MORE FEEDBACK</a> -->
			</div><!-- col-lg-8 col-md-12 -->
		</div><!-- row -->

	</div><!-- container -->
</section>


<!-- SCIPTS -->

<script src="assets/common-js/jquery-3.1.1.min.js"></script>

<script src="assets/common-js/tether.min.js"></script>

<script src="assets/common-js/bootstrap.js"></script>


<script src="assets/common-js/scripts.js"></script>
<script src="assets/common-js/lightbox.js"></script>

<?php require_once  'includes/frontend_scripts.php'  ?>

<script type="text/javascript" src="assets/stars/stars.js"></script>
<script>
	var test = new pureJSLightBox({
		// shows fullscreen overlay
		overlay: true,
		// shows navigation arrows
		navigation: false,
		// enable swipe
		swipe: false

	});
</script>
<script>
	$(".text").stars({
		text: ["1 star", "2 star", "3 star", "4 star", "5 star"]
	});
	$(".click-callback").stars({
		stars: 5,

		color: '#E4AD22',
		value: 0,
		click: function(i) {

			document.getElementById("rating_input").value = i;

		}
	});
</script>

<script>
	$(document).ready(function() {

		$('#stars li').on('mouseover', function() {
			var onStar = parseInt($(this).data('value'), 10);

			$(this).parent().children('li.star').each(function(e) {
				if (e < onStar) {
					$(this).addClass('hover');
				} else {
					$(this).removeClass('hover');
				}
			});

		}).on('mouseout', function() {
			$(this).parent().children('li.star').each(function(e) {
				$(this).removeClass('hover');
			});
		});



		$('#stars li').on('click', function() {
			var onStar = parseInt($(this).data('value'), 10);
			var stars = $(this).parent().children('li.star');

			for (i = 0; i < stars.length; i++) {
				$(stars[i]).removeClass('selected');
			}

			for (i = 0; i < onStar; i++) {
				$(stars[i]).addClass('selected');
			}


		});


	});


	function responseMessage(msg) {
		$('.success-box').fadeIn(200);
		$('.success-box div.text-message').php("<span>" + msg + "</span>");
	}
</script>

<script>
	var modalBox = document.querySelector('.modal-box'),
		modalBoxImg = modalBox.querySelector('.modal-box--image'),
		overlay = document.querySelector('.overlay'),
		imageBox = document.querySelectorAll('.image-box'),
		modalImgBox = modalBoxImg.querySelector('img');

	for (let i = 0; i < imageBox.length; i++) {
		imageBox[i].onclick = function() {
			modalBox.classList.remove('invisible');
			var imgSrc = this.querySelector('img').src;
			modalImgBox.src = imgSrc;
		}
	}

	overlay.onclick = function() {
		modalBox.classList.add('invisible');
	}
	windwo.onkeydown = function(e) {
		if (e.keyCode === 27) {
			modalBox.classList.add('invisible');

		}
	}
</script>

</body>

</html>