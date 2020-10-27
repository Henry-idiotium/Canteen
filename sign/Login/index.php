<!DOCTYPE html>
<?php
	session_start();
	require_once __dir__. "/../../library/Database.php";
	require_once __dir__. "/../../library/Function.php";
	$db = new Database;
	$role=$db->fetchAll("tblrole");
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
			// if(isset($_POST["name"]) && $_POST["name"]!=NULL)
			// {
			//   $name=$_POST["name"];
			// }

			// $name=postInput("name");
			// echo $name;
			$error=[];
			if (postInput("roleId")=="") {
					$error["roleId"]="damn role";
			}
			if (empty($error)) {
				$data =
				[
						"username"=>postInput("username"),
						"password"=>MD5(postInput("password")),
						"roleId"=>postInput("roleId")
				];
				$is_check = $db->fetchOne("tbluser", "username="."'".$data['username']."'"." AND password="."'".$data['password']."'"." AND roleId="."'".$data['roleId']."'"." ");
				if ($is_check != NULL) {
					$_SESSION['success']="Login successfully";
					if ($data['roleId']==1){
						header("location: ".base_url(). "admin/modules/user?account=".$data['username']); exit();
					}
					elseif ($data['roleId']==2){
						header("location: ".base_url(). "admin/modules/item?account=".$data['username']); exit();
					}
					elseif ($data['roleId']==3){
						header("location: ".base_url(). "user/modules/itemDisplay?account=".$data['username']); exit();
					}
				}
				else{
					$error["login"]="Something wrong...";
				}
			}

	}
?>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form action="" method="POST" class="login100-form validate-form" enctype="multipart/form-data">
					<?php if (isset($error["login"])): ?>
					<p class="text-danger ">&nbsp <?php echo $error["login"]; ?></p>
					<?php unset($error["login"]); endif; ?>
					<div class="form-group row mr-auto ml-auto justify-content-center">
						<select class="form-control" name="roleId">
								<option value=""><strong>Please choose a role</strong></option>
								<?php foreach ($role as $item): ?>
								<option value="<?php echo $item["roleId"]; ?>"><?php echo $item["name"]; ?></option>
								<?php endforeach ?>
						</select>
						<?php if (isset($error["roleId"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["roleId"]; ?></p>
						<?php endif ?>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" type="text" name="username" placeholder="Username" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="../signup">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>

			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
