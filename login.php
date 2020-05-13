<?php  require_once  'includes/front_header.php'  ?>

		<div class="slider display-table center-text">
			<h1 class="title display-table-cell"><b>Prisijungimas</b></h1>
		</div><!-- slider -->

		<section class="blog-area section">
			<div class="container">

				<div class="row">
					<div class="col-lg-2 col-md-0"></div>
					<div class="col-lg-8 col-md-12">
						<div class="post-wrapper">
              <?php  successMsg();  ?>
							
              <p class="text-center mb-4">Prisijunkti prie savo vartotojo</p>
              <?php  user_v_login();  ?>

							<div class="card bg-light">
								<article class="card-body mx-auto" style="max-width: 400px;">
									<form method="POST">
										<div class="form-group input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
											</div>
                      <input class="form-control" name="username" placeholder="Vartotojo vardas" required type="text">

										</div>
										<div class="form-group input-group">
											<div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>

											</div>
                      <input class="form-control d-block" name="password"  placeholder="Slaptažodis" type="password" required>

                    </div>
                  <div class="mb-3">
                  <?php if (isset( $login_errors_v['p'])) : ?>
                        <span class="text-danger">
                          <?php echo  $login_errors_v['p']; ?>
                        </span>
                      <?php endif;  ?>
                      <?php if (isset($login_errors_v['u'])) : ?>
                        <span class="text-danger">
                          <?php echo  $login_errors_v['u']; ?>
                        </span>
                      <?php endif;  ?>
                  </div>
										<div class="form-group">
											<button type="submit" name="login_v" class="btn btn-primary btn-block"> Prisijungti </button>
										</div> <!-- form-group// -->
										<p class="text-center">Neturi vartotojo? <a href="signup.php">Užsiregistruok!</a> </p>
									</form>
								</article>
							</div> <!-- card.// -->


						</div><!-- post-wrapper -->
					</div><!-- col-sm-8 col-sm-offset-2 -->
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
