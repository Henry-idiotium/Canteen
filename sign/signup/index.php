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

<?php require_once __dir__. "\header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <!-- Page Heading -->
          <div class="clearfix"></div>
          <!-- Content Row -->
          <!-- DataTales Example -->
          <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-8">
                      <input type="text" value="<?php echo $data["username"] ?>" class="form-control" id="inputItemName" name="username" placeholder="User name">
                      <?php if (isset($error["username"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["username"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputItemName" name="password" placeholder="Password">
                      <?php if (isset($error["password"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["password"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-8">
                      <input type="password" class="form-control" id="inputItemName" name="repassword" placeholder="Confirm Password" required>
                      <?php if (isset($error["repassword"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["repassword"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Fullname</label>
                  <div class="col-sm-8">
                      <input type="text" value="<?php echo $data["fullname"] ?>" class="form-control" id="inputItemName" name="fullname" placeholder="Fullname">
                      <?php if (isset($error["fullname"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["fullname"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemCategory" class="col-sm-2 col-form-label">Class</label>
                  <div class="col-sm-8">
                      <select class="form-control" name="departmentId">
                          <option value="">Please choose a class</option>
                          <?php foreach ($department as $item):
                            if ($item["departmentId"]!=1 and $item["departmentId"]!=3 and $item["departmentId"]!=6):?>
                              <option value="<?php echo $item["departmentId"]; ?>"><?php echo $item["name"]; ?></option>
                          <?php endif;endforeach; ?>
                      </select>
                      <?php if (isset($error["departmentId"])): ?>
                        <p class="text-danger ">&nbsp <?php echo $error["departmentId"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-8">
                      <input type="email" value="<?php echo $data["email"] ?>" class="form-control" id="inputItemName" name="email" placeholder="Email-Not required">
                      <?php if (isset($error["email"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["email"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Phone number</label>
                  <div class="col-sm-8">
                      <input type="tel" value="<?php echo $data["phone"] ?>" class="form-control" id="inputItemName" name="phone" placeholder="Phone number">
                      <?php if (isset($error["phone"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["phone"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-8">
                      <input type="text" value="<?php echo $data["address"] ?>" class="form-control" id="inputItemName" name="address" placeholder="Address">
                      <?php if (isset($error["address"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["address"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Identity Number</label>
                  <div class="col-sm-8">
                      <input type="text" value="<?php echo $data["identityNo"] ?>" class="form-control" id="inputItemName" name="identityNo" placeholder="Identity Number">
                      <?php if (isset($error["identityNo"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["identityNo"]; ?></p>
                      <?php endif ?>
                  </div>
              </div>
              <div class="form-group row mr-auto ml-auto">
                  <label for="inputCategoryDes" class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-registered fa-sm text-white-50"></i> Register</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
      <div class="">
        <a class="btn btn-primary mr-auto ml-auto d-inline-block" href="../login">
          <h3>
            Login
            <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
          </h3>

        </a>
      </div>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/footer.php"; ?>
