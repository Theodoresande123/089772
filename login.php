<?php
include_once('server.php');
include_once('services/otp_core_service.php');
require_once "vendor/autoload.php";

?>
<!DOCTYPE html>
<html>

<head>
	<title>HOSTEL WORLD</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body {
			background: url(images/bglogin.jpg) no-repeat center center fixed;
			background-size: cover;
		}
	</style>
</head>

<body>
	<div class="header">
		<h2>Student Login</h2>
	</div>

	<form method="post" action="login.php">
		<?php include('errors.php'); ?>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="username" id="uname">
		</div>

		<label>Password</label>
		<div class="form-group d-flex">
			<input type="password" class="form-control" name="password" id="password">
			<button class="btn btn-dark" type="button" id="togglePass">
				<i class="fa fa-eye" id="togglePassIcon"></i>
			</button>
		</div>
		<br>
		<div class="d-flex">
			<button type="button" class="btn btn-success" id="two_FA" name="two_FA">Send 2FA code</button>
		</div>
		<br>

		<div class="form-group" id="tokenGrp" hidden>
			<input type="text" class="form-control" placeholder="Enter OTP Code" name="_2fa_token" id="token">
		</div>

		<div class="input-group d-flex justify-content-between">
			<button type="submit" class="btn btn-primary" name="login_user" hidden id="loginBtn">
				Login
			</button>
			<a class="" href="admin_login.php">
				Log in as owner/realtor
			</a>
		</div>

		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
	<script>
		var unameField = document.getElementById("uname")
		var eyeBtn = document.getElementById("togglePass")
		var pwdField = document.querySelector("#password")
		var twoFa = document.querySelector("#two_FA")
		var loginBtn = document.querySelector("#loginBtn")
		var token = document.querySelector("#token")
		var tokenGrp = document.querySelector("#tokenGrp")

		// toggle password field visibility
		eyeBtn.addEventListener('click', () => {
			if (pwdField.type === "password") {
				pwdField.type = "text"
				eyeBtn.children[0].classList.replace("fa-eye", "fa-eye-slash")
			} else {
				pwdField.type = "password"
				eyeBtn.children[0].classList.replace("fa-eye-slash", "fa-eye")
			}
		})

		// unhide 2FA input field
		twoFa.addEventListener('click', () => {
			if (unameField.value !== "" && pwdField.value !== "") {
				tokenGrp.hidden = false
				var data = new FormData();
				data.append('username', unameField.value)
				data.append('password', pwdField.value)
				// Ajax fetch verify otp service
				fetch("./process_otp.php", {
						method: "POST",
						body: data
					}).then(response => response.text())
					.then(data => {
						console.log(data);
					})
					.catch(error => {
						console.error(error);
					});
			}
		})

		// Activate login btn if 2FA input is not empty
		token.addEventListener('input', () => {
			if (token.value.length > 5) {
				loginBtn.hidden = false
				twoFa.hidden = true
			} else {
				loginBtn.hidden = true
			}
		})
	</script>
</body>


</html>