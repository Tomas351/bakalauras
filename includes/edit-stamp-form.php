<section class="comment-section">
	<h4><b>Atnaujinti pašto ženklų kolekcija</b></h4>
	<div class="comment-form">
		<?php

		if (isset($_GET['edit_stamp'])) {

			$edit_stamp_id = $_GET['edit_stamp'];



			$sql_edit = "SELECT * FROM post_stamps WHERE s_id = '$edit_stamp_id' ";
			$result_edit = query($sql_edit);
			while ($row_edit = fetch_array($result_edit)) {

				$s_img_edit = $row_edit['s_img'];
				$s_des_edit = $row_edit['s_des'];
				$s_con_edit = $row_edit['s_con'];
			}
		}
		?>
		<?php update_stamp(); ?>
		<form method="post" enctype="multipart/form-data">

			<div class="row justify-content-center">

				<div class="col-sm-6">
					<div class="border">
						<label class="label" for="file-input">
							<div id="img_contain" class="img-preview">
								<img id="image-preview" src="assets/images/stamps/<?php echo $s_img_edit; ?>" alt="your image" title='' />
							</div>
						</label>
						<input type='file' class="form-control mb-0" name="post_image" id="file-input" />
					</div>
				</div><!-- col-sm-6 -->
				<div class="col-sm-12 mt-3">
					<select name="con" id="" class="form-control">

						<?php
						$sql = "SELECT * FROM countries ";
						$result = query($sql);
						while ($row = fetch_array($result)) {
							$c_name = $row['c_name'];
						?>
							<option value="<?php echo $c_name; ?>"><?php echo $c_name; ?></option>
						<?php } ?>

					</select>
				</div><!-- col-sm-6 -->

				<div class="col-sm-12">
					<textarea name="des" rows="2" class="text-area-messge form-control mt-4 " placeholder="Įvesk pašto ženklo aprašymą" aria-required="true" aria-invalid="false"><?php echo $s_des_edit; ?></textarea>
				</div><!-- col-sm-12 -->
				<div class="col-sm-12">
					<button class="submit-btn" name="edit_stamp" type="submit" id="form-submit"><b>Išsaugoti pašto ženklą</b></button>
				</div><!-- col-sm-12 -->

			</div><!-- row -->
		</form>
	</div><!-- comment-form -->
</section>