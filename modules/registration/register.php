<?php
include 'constellation/functions.php';
?>

<main role="main">
		<body class="login-background">
		<section class="page-container page-center">
        <div class="container border border-primary rounded rounded-lg shadow white-background-login">
			<h2 class="h2 site-h2 text-center opac100"> Fleet Registration remote2 </h2>
			<form>
				<div class="form-group">
					<label for="InputUsername">In-Game Name</label>
					<input type="email" class="form-control" id="InputUsername" placeholder="Enter your In-Game Name here...">
				</div>			
				<div class="form-group">
					<label for="InputEmail">E-mail Address</label>
					<input type="email" class="form-control" id="InputEmail" placeholder="Enter your email here...">
				</div>
				<div class="form-group">
					<label for="InputPassword">Password</label>
					<input type="password" class="form-control" id="InputPassword" placeholder="Enter password...">
				</div>
				<div class="form-group">
					<label for="DivisionSelect">Select Task Force</label>
					<select class="form-control" id="DivisionSelect" placeholder="Select your Taskforce">
						<?php divisionSelect(); ?>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
        </div>
		<div class="white-background-login"><?php divisionSelect(); ?></div>
		</section>
		</body>
	</main>