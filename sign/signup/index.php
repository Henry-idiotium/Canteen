<?php
    $open="manageaccount";
    session_start();
  	require_once __dir__. "/../../library/Database.php";
  	require_once __dir__. "/../../library/Function.php";
  	$db = new Database;
    $department=$db->fetchAll("tbldepartment");
    $data =
    [
        "username"=>"",
        "fullname"=>"",
        "departmentId"=>"",
        "roleId"=>3,
        "phone"=>"",
        "email"=>"",
        "address"=>"",
        "identityNo"=>"",
        "password"=>""
    ];

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        // if(isset($_POST["name"]) && $_POST["name"]!=NULL)
        // {
        //   $name=$_POST["name"];
        // }

        // $name=postInput("name");
        // echo $name;

        $data =
        [
            "username"=>postInput("username"),
            "fullname"=>postInput("fullname"),
            "departmentId"=>postInput("departmentId"),
            "roleId"=>3,
            "phone"=>postInput("phone"),
            "email"=>postInput("email"),
            "address"=>postInput("address"),
            "identityNo"=>postInput("identityNo"),
            "password"=>MD5(postInput("password"))
        ];

        $error = [];

        if (postInput("username")=="") $error["username"]="Please fill out this form completely";
        else {
            $isChecku=$db->fetchOne("tbluser", " username='".$data["username"]."' ");
            if ($isChecku!=NULL) {
                $error["username"]="Username has been existed, please choose another one";
            }
        }
        if (postInput("departmentId")=="") {
            $error["departmentId"]="Please choose a department";
        }
        if (postInput("fullname")=="") $error["fullname"]="Please fill out this form completely";
        if (postInput("phone")=="") $error["phone"]="Please fill out this form completely";

        if (postInput("email")=="") $error["email"]="Please fill out this form completely";
        else {
            $isCheck=$db->fetchOne("tbluser", " email='".$data["email"]."' ");
            if ($isCheck!=NULL) {
                $error["email"]="Email has been existed, please choose another one";
            }
        }

        if (postInput("address")=="") $error["address"]="Please fill out this form completely";

        if (postInput("identityNo")=="") $error["identityNo"]="Please fill out this form completely";
        else {
            $isChecki=$db->fetchOne("tbluser", " identityNo='".$data["identityNo"]."' ");
            if ($isChecki!=NULL) {
                $error["identityNo"]="Identity number has been existed, please choose another one";
            }
        }

        if (postInput("password")=="") $error["password"]="Please fill out this form completely";
        if ($data["password"]!=MD5(postInput("repassword"))) $error["repassword"]="Password is not match";


        if (empty($error)) {
            $idInsert=$db->insert("tbluser", $data);
            if (isset($idInsert)) {
                $_SESSION["success"]="Add successfully";
                redirectCate("user".$show);
            }
            else $_SESSION["error"]="Add failed";
        }
    }

?>

<?php require_once __dir__. "/layouts/header.php"; ?>

    <!-- Begin Page Content -->
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 justify-content-center">
				<form action="" method="POST" class="login100-form validate-form" enctype="multipart/form-data">
					<!-- Username-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" value="<?php echo $data["username"] ?>" id="inputItemName" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["username"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["username"]; ?></p>
						<?php endif ?>
					</div>

					<!-- Password-form -->
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="password" id="inputItemName" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["password"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["password"]; ?></p>
						<?php endif ?>
                    </div>

					<!-- Confirm Password-form -->
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="password" id="inputItemName" name="repassword" placeholder="Confirm Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["repassword"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["repassword"]; ?></p>
						<?php endif ?>
                    </div>

					<!-- Name-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" value="<?php echo $data["fullname"] ?>" id="inputItemName" name="fullname" placeholder="Fullname">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-badge" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["fullname"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["fullname"]; ?></p>
						<?php endif ?>
					</div>

					<!-- Department-form (Under Construction) -->
					<div class="wrap-input100 validate-input">
						<select class="option100 form-control" name="departmentId">
							<option value="">Please choose a department</option>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-id-badge" aria-hidden="true"></i>
							</span>
							<?php foreach ($department as $item):
								if ($item["departmentId"]!=1 and $item["departmentId"]!=3 and $item["departmentId"]!=6):?>
								<option value="<?php echo $item["departmentId"]; ?>"><?php echo $item["name"]; ?></option>
							<?php endif;endforeach; ?>
						</select>
						<?php if (isset($error["departmentId"])): ?>
							<p class="text-danger ">&nbsp <?php echo $error["departmentId"]; ?></p>
						<?php endif ?>
					</div>

					<!-- Email-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="email" value="<?php echo $data["email"] ?>"  id="inputItemName" name="email" placeholder="Email-Not required">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["email"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["email"]; ?></p>
						<?php endif ?>
                    </div>

					<!-- Phone-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="tel" value="<?php echo $data["phone"] ?>" id="inputItemName" name="phone" placeholder="Phone number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["phone"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["phone"]; ?></p>
						<?php endif ?>
                    </div>

					<!-- Address-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" value="<?php echo $data["address"] ?>" id="inputItemName" name="address" placeholder="Address">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["address"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["address"]; ?></p>
						<?php endif ?>
                    </div>

					<!-- Id No.-form -->
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" value="<?php echo $data["identityNo"] ?>" id="inputItemName" name="identityNo" placeholder="Identity Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-id-card" aria-hidden="true"></i>
						</span>
						<?php if (isset($error["identityNo"])): ?>
						<p class="text-danger ">&nbsp <?php echo $error["identityNo"]; ?></p>
						<?php endif ?>
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Sign up
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
						<a class="txt2" href="../Login/index.php">
							Return Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/layouts/footer.php"; ?>