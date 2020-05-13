<?php require_once  'includes/front_header.php'  ?>

<div class="slider display-table center-text">
	<h1 class="title display-table-cell"><b>Registracija</b></h1>
</div><!-- slider -->

<section class="blog-area section">
	<div class="container">

		<div class="row">
			<div class="col-lg-2 col-md-0"></div>
			<div class="col-lg-8 col-md-12">
				<div class="post-wrapper">

					<h3 class="title text-center mb-0"><b>Susikurti vartotoją</b></h3>
					<?php add_v_user(); ?>

					<div class="card bg-light">
						<article class="card-body mx-auto" style="max-width: 400px;">
							<form method="POST">
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
									</div>
									<input name="name" class="form-control" placeholder="Vartotojo vardas" type="text">
								</div> <!-- form-group// -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
									</div>
									<input name="email" class="form-control" placeholder="El. pašto adresas" type="email">
								</div> <!-- form-group// -->

								<div class="form-group input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
									</div>
									<input class="form-control" name="password" placeholder="Slaptažodis" type="password">
								</div> <!-- form-group// -->
								<div class="form-group input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
									</div>
									<input class="form-control" name="c-password" placeholder="Pakartoti slaptažodį" type="password">
								</div> <!-- form-group// -->
								<input class="form-control" value="user" name="role" type="hidden">
								<div class="form-group">
									<button type="submit" name="addv_v_user" class="btn btn-primary btn-block"> Sukurti vartotoja </button>
								</div> <!-- form-group// -->
								<p class="text-center">Turi vartotoją? <a href="login.php">Prisijunk!</a> </p>

							</form>
						</article>
					</div> <!-- card.// -->


				</div><!-- post-wrapper -->
			</div><!-- col-sm-8 col-sm-offset-2 -->
		</div><!-- row -->

	</div><!-- container -->
</section><!-- section -->

<?php require_once  'includes/frontend_scripts.php'  ?>

</body>

</html>