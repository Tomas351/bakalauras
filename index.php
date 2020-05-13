<?php require_once  'includes/front_header.php'  ?>

<div class="slider">
	<div class="display-table  center-text">
		<h1 class="title display-table-cell"><b>Skelbimai</b></h1>
	</div>
</div><!-- slider -->

<section class="blog-area section">
	<div class="container">

		<div class="row">

			<div class="col-lg-12">
				<h4><b>Visi skelbimai</b></h4>

				<?php successMsg();  ?>
				<div class="text-left"><small class="">Filtrai:</small></div>
				<form class="d-flex justify-content-between">
					<?php
					filter_offer();
					?>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-user"></i> </span>
						</div>
						<!-- <input type="hidden" name="page" value="index.php" /> -->
						<?php
						$sql_of = "SELECT * FROM  countries";
						$countries = query($sql_of);
						// $total_feedbacks = row_count($result_of);
						if ($countries->num_rows > 0) {
						?>
							<select name="filter_o_1" id="" class="form-control">
								<option value="">Pasirinkti šalį</option>
								<?php
								while ($country = fetch_array($countries)) {
									$c_id = $country['c_id'];
									$c_name = $country['c_name'];
									echo "<option value='" . $c_id . "'>" . $c_name . "</option>";
								}
								?>
							</select>
						<?php
						}
						?>

					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input class="form-control" placeholder="Ką siūlai" name="filter_o_2" type="text">
					</div>
					<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input class="form-control" name="filter_o_3" placeholder="Kokių pašto ženklų ieškai" type="text">
					</div>
					<div class="form-group">
						<button type="submit" value="" name="search_filter2" class="btn btn-primary btn-block"> Filtruoti </button>
					</div>
				</form>
			</div><!-- /.col-lg-12 END -->



			<?php
			$filter_o_1 = "";
			$filter_o_2 = "";
			$filter_o_3 = "";
			$sql_of = '';
			$filter = false;
			if (isset($_GET['filter_o_1'])) {
				$filter_o_1 = $_GET['filter_o_1'];
				if (!empty($filter_o_1)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_con WHERE c_id = '$filter_o_1'";
				}
			}
			if (isset($_GET['filter_o_2'])) {
				$filter_o_2 = $_GET['filter_o_2'];
				if (!empty($filter_o_2)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_conn WHERE s_sum = '$filter_o_2'";
				}
			}
			if (isset($_GET['filter_o_3'])) {
				$filter_o_3 = $_GET['filter_o_3'];
				if (!empty($filter_o_3)) {
					$filter = true;
					$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_conn WHERE o_want = '$filter_o_3'";
				}
			}
			// if (!$_GET['filter_o_3'] and !$_GET['filter_o_3']) {
			// }

			if (!$filter) {
				$sql_of = "SELECT * FROM  offers INNER JOIN stamp_offer ON stamp_offer.offer_id = offers.o_id INNER JOIN post_stamps ON stamp_offer.stamp_id = post_stamps.s_id INNER JOIN countries ON `countries`.`c_id` = post_stamps.s_con";
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
								<div><b>Siūlo</b> <?php echo $offer_sum; ?></div>
								<div><b>Nori</b> <?php echo $offer_want; ?></div>
							</div>

							<ul class="post-footer">
								<li><a href="#"><i class="ion-android-map"></i> <?php echo $c_name; ?> </a></li>
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

</body>

</html>