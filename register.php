<?php 
include 'config.php';
$username = '';
error_reporting(0);
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert(' good Registration ')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert(' Something Wrong ')</script>";
			}
		} else {
			echo "<script>alert(' Email Already Exists')</script>";
		}
	} else {
		echo "<script>alert('Password eror')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form </title>
</head>
<body>
	<div class="container">
	<div class="row mt-5">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="  justify-content-center">
			<div class="col form-group mt-3" >
				<input class="form-control" type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="col form-group mt-3" >
				<input class="form-control" type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="col form-group mt-3" >
				<input class="form-control" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="col form-group mt-3" >
				<input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="col form-group mt-3" >
				<button  class="btn btn-outline-primary btn-block mb-5"  name="submit" class="btn">Register</button>
			</div>
			</div>
			<p >Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
	</div>

</body>
</html>