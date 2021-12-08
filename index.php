<?php 

include 'config.php';

session_start();


error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: php-crud-main/read.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: php-crud-main/read.php");
	} else {
		echo "<script>alert(' wrong Email or wrong Password ')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


	<title>Login Form</title>
</head>
<body>
	<div class="container mt-5">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="col form-group mt-3" >
				<input class="form-control " type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="col form-group mt-3" >
				<input class="form-control" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="col form-group mt-3" >
				<button class="btn btn-outline-primary btn-block mb-5"  name="submit" class="btn">Login</button>
			</div>
			<p >Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>