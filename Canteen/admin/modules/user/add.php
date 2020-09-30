<?php
  $open="manageitem";
  require_once __dir__. "/../../autoload/autoload.php";
  $role=$db->fetchAll("tblrole");
  $data =
  [
    "username"=>"",
    "fullname"=>"",
    "roleId"=>"",
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
      "roleId"=>postInput("roleId"),
      "phone"=>postInput("phone"),
      "email"=>postInput("email"),
      "address"=>postInput("address"),
      "identityNo"=>postInput("identityNo"),
      "password"=>MD5(postInput("password"))

    ];

    $error = [];

    if (postInput("username")=="") {
      $error["username"]="Please fill out this form completely";
    }
    if (postInput("fullname")=="") {
      $error["fullname"]="Please fill out this form completely";
    }
    if (postInput("roleId")=="") {
      $error["roleId"]="Please fill out this form completely";
    }
    if (postInput("phone")=="") {
      $error["phone"]="Please fill out this form completely";
    }
    if (postInput("email")=="") {
      $error["email"]="Please fill out this form completely";
    }
    if (postInput("address")=="") {
      $error["address"]="Please fill out this form completely";
    }
    if (postInput("identityNo")=="") {
      $error["identityNo"]="Please fill out this form completely";
    }
    if (postInput("password")=="") {
      $error["password"]="Please fill out this form completely";
    }
    if ($data["password"]!=MD5(postInput("repassword"))) {
      $error["repassword"]="Password is not match";
    }


    if (empty($error)) {


      $idInsert=$db->insert("tbluser", $data);
      if ($idInsert) {
        $_SESSION["success"]="Add successfully";
        redirectCate("user");
      }
      else {
        $_SESSION["error"]="Add failed";
      }
    }
  }

?>
<?php require_once __dir__. "/../../layouts/header.php"; ?>
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Category</h1>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Manage item</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Category</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                        <div class="clearfix"></div>
                        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
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
                            <label for="inputItemName" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-8">
                              <select class="form-control" name="roleId">
                                <option value="">Please choose a role</option>
                                <?php foreach ($role as $item): ?>
                                  <option value="<?php echo $item["roleId"]; ?>"><?php echo $item["name"]."-".$item["description"]; ?></option>
                                <?php endforeach ?>
                              </select>
                              <?php if (isset($error["roleId"])): ?>
                                <p class="text-danger ">&nbsp <?php echo $error["roleId"]; ?></p>
                              <?php endif ?>
                            </div>
                          </div>
                          <div class="form-group row mr-auto ml-auto justify-content-center">
                            <label for="inputItemName" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                              <input type="email" value="<?php echo $data["email"] ?>" class="form-control" id="inputItemName" name="email" placeholder="Email-Not required">
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
                              <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                            </div>
                          </div>
                        </form>

                <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
