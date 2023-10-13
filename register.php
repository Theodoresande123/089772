<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<title>HOSTEL WORLD</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Merriweather&family=Merriweather+Sans&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="header">
		<h2>STUDENT SIGN UP</h2>
	</div>

	<form method="post" action="register.php">
		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username ?? ''; ?>" required>
		</div>

		<div class="input-group">
			<label>First name</label>
			<input type="text" name="firstname" value="<?php echo $firstname ?? ''; ?>" required>
		</div>

		<div class="input-group">
			<label>Last name</label>
			<input type="text" name="lastname" value="<?php echo $lastname ?? ''; ?>" required>
		</div>

		<div class="input-group">
			<label>Surname</label>
			<input type="text" name="secondname" value="<?php echo $secondname ?? ''; ?>">
		</div>

		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>" required>
		</div>

		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>

		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>

		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>

</html>