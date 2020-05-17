<?php require_once  'includes/front_header.php'  ?>


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
          $desc = $row['u_desc'];


          ?>

          <div class="post-top-area">
            <div class="post-info">

              <div class="left-area">
                <a class="avatar" href="#"><img src="assets/images/avatar.jpg" alt="Profile Image"></a>
              </div>

              <div class="middle-area">
                <h3 class=""><a href="#"><b><?php echo $name; ?></b></a></h3>
                <!-- <h6 class="date">on Sep 29, 2017 at 9:48 am</h6> -->
              </div>

            </div><!-- post-info -->
            <?php successMsg(); ?>
            <p class="mb-5">
              <?php echo $desc; ?>
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
            <?php if (!isset($_GET['edit_stamp'])) : ?>

              <section class="comment-section">
                <h4><b>Įkelti pašto ženklus į kolekcija</b></h4>
                <div class="comment-form">
                  <?php add_stamp(); ?>
                  <form method="post" enctype="multipart/form-data">

                    <div class="row justify-content-center">

                      <div class="col-sm-6">
                        <div class="border">
                          <label class="label" for="file-input">
                            <div id="img_contain" class="img-preview">
                              <img class="img-fluid" id="image-preview" src="assets/images/file-upload.png" alt="your image" title='' />
                            </div>
                          </label>
                          <input type='file' class="form-control mb-0" name="post_image" id="file-input" />
                        </div>
                          <div class="alert alert-success">
                              Galima kelti tik .jpg ir .png failus, nedidesnius nei 1MB.                          </div>
                      </div><!-- col-sm-6 -->
                      <div class="col-sm-12 mt-3">
                        <select name="con" id="" class="form-control">

                          <?php
                          $sql = "SELECT * FROM countries ";
                          $result = query($sql);
                          while ($row = fetch_array($result)) {
                            $c_id = $row['c_id'];
                            $c_name = $row['c_name'];
                          ?>
                            <option value="<?php echo $c_id; ?>"><?php echo $c_name; ?></option>
                          <?php } ?>

                        </select>
                      </div><!-- col-sm-6 -->

                        <div class="col-sm-12">
                            <label>Ar pašto ženklo nepanaudotas?</label>
                            <p>
                                <input type="radio" name="yes_no" checked value="1">Taip</input>
                                <input type="radio" name="yes_no" value="0">Ne</input>
                            </p>
                        </div>

                        <div class="col-sm-12">
                            <textarea name="year" rows="1" class="text-area-messge form-control" placeholder="Įveskite pašto ženklo metus (Nuo 1840 iki 2020)" aria-required="true" aria-invalid="false"></textarea>
                        </div>

                      <div class="col-sm-12">
                        <textarea name="des" rows="2" class="text-area-messge form-control" placeholder="Įrašyk aprašymą" aria-required="true" aria-invalid="false"></textarea>
                      </div><!-- col-sm-12 -->
                      <div class="col-sm-12">
                        <button class="submit-btn" name="add_stamp" type="submit" id="form-submit"><b>Įkelti pašto ženklą</b></button>
                      </div><!-- col-sm-12 -->

                    </div><!-- row -->
                  </form>
                </div><!-- comment-form -->
              </section>

            <?php elseif (isset($_GET['edit_stamp'])) : ?>
              <?php include_once 'includes/edit-stamp-form.php'  ?>
            <?php else : ?>

            <?php endif; ?>

          </div><!-- main-post -->
        </div><!-- col-lg-8 col-md-12 -->


      </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->

<section class="blog-area section">
  <div class="container">

    <div class="row">

      <div class="col-lg-12">
        <h4><b>Pašto ženklų kolekcija</b></h4>

      </div><!-- /.col-lg-12 END -->

      <?php
      $u_id = $_SESSION['u_id'];
      $sql_s = "SELECT * FROM post_stamps INNER JOIN countries ON `post_stamps`.`s_con` = `countries`.`c_id` WHERE u_id = '$u_id'";
      $result_s = query($sql_s);
      confirm($result_s);
      if ($result_s->num_rows > 0) {
        while ($row_s = fetch_array($result_s)) {
          $s_id = $row_s['s_id'];
          $s_img = $row_s['s_img'];
          $s_des = $row_s['s_des'];
          $c_name = $row_s['c_name'];
      ?>
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="single-post post-style-1">
                <div class="blog-image"><img src="assets/images/stamps/<?php echo $s_img; ?>" alt="Blog Image"></div>

                <div class="blog-info">
                  <h6 class="title"><a href="#"><b><?php echo $s_des; ?></b></a></h6>

                  <ul class="post-footer">
                    <li><a href="#"><i class="ion-android-map"></i><?php echo $c_name; ?></a></li>
                    <li><a href="collection.php?edit_stamp=<?php echo $s_id; ?>"><i class="ion-edit"></i>Redaguoti</a></li>
                    <li><a onclick="return confirm('Ar esi tikras, kad nori ištrinti šį pašto ženklą?')" href="collection.php?delete_stamp=<?php echo $s_id; ?>" class="text-danger"><i class="ion-android-delete"></i>
                        Ištrinti</a></li>
                  </ul>
                </div><!-- blog-info -->

              </div><!-- single-post -->
            </div><!-- card -->
          </div><!-- col-lg-4 col-md-6 -->
        <?php } ?>
      <?php } else { ?>
        <div class="alert alert-danger w-100">
          Kolkas neįkėlei neivieno pašto ženklo
        </div><!-- /.aertl alert-danger END -->
      <?php } ?>
    </div><!-- row -->
    <?php post_stamp_delete(); ?>
    <!-- <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> -->

  </div><!-- container -->
</section><!-- section -->

<!-- SCIPTS -->

<script src="assets/common-js/jquery-3.1.1.min.js"></script>

<script src="assets/common-js/tether.min.js"></script>

<script src="assets/common-js/bootstrap.js"></script>

<script src="assets/common-js/scripts.js"></script>

<?php require_once  'includes/frontend_scripts.php'  ?>

<!-- // IMAGE PREVIEW CODE  -->
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#image-preview').attr('src', e.target.result);
        $('#image-preview').hide();
        $('#image-preview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file-input").change(function() {
    readURL(this);
  });
</script>

</body>

</html>