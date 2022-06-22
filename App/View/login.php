<?php

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="detailed-page"></div>
</div>






<section style="background: linear-gradient(to top, #ec3d9f 40%, #bd00da 90%, #c900aa 100%);" class="vh-100 gradient-custom">
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card bg-dark text-white" style="border-radius: 1rem;">
					<div class="card-body p-5 text-center">

						<div class="mb-md-5 mt-md-4 pb-5">
							<form action="/admin/excursions" method="post">

								<h2 class="fw-bold mb-2 text-uppercase">Login</h2>
								<p class="text-white-50 mb-5">Please enter your login and password!</p>

								<div class="form-outline form-white mb-4">
									<input type="text" name="login" required="required" placeholder="     Логин..."  id="typeEmailX" class="form-control form-control-lg"/>
									<label class="form-label" for="typeEmailX">Email</label>
								</div>

								<div class="form-outline form-white mb-4">
									<input type="password" name="password" required="required" placeholder="     Пароль..." id="typePasswordX" class="form-control form-control-lg"/>
									<label class="form-label" for="typePasswordX">Password</label>
								</div>

								<input class="btn btn-outline-light btn-lg px-5" type="submit" value="Login">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>