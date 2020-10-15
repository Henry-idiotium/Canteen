<?php
    $open="manageaccount";
    $addrole=$_GET['addrole'];
    if ($addrole==1) {
      $show="/showadmin.php";
    }
    if ($addrole==2) {
      $show="/showcaterer.php";
    }
    if ($addrole==3) {
      $show="/showuser.php";
    }
    $open="manageaccount";
    require_once __dir__. "/../../autoload/autoload.php";
    $role=$db->fetchAll("tblrole");
    $department=$db->fetchAll("tbldepartment");
    $data =
    [
        "username"=>"",
        "fullname"=>"",
        "currentBalance"=>"",
        "departmentId"=>"",
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
            "currentBalance"=>postInput("currentBalance"),
            "departmentId"=>postInput("departmentId"),
            "roleId"=>postInput("roleId"),
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
        if (postInput("roleId")=="") $error["roleId"]="Please fill out this form completely";
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

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Manage item</a></li>
            <li class="breadcrumb-item">
              <?php
                if ($addrole==1) {
                  echo '<a href="showadmin.php">Admin account</a>';
                }
                elseif ($addrole==2) {
                  echo '<a href="showcaterer.php">Caterer account</a>';
                }
                else {
                  echo '<a href="showuser.php">Client account</a>';
                }
               ?>
            </li>
            <li class="breadcrumb-item active">Add account</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add account</h1>
        </div>
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
            <?php if ($addrole==3): ?>
              <div class="form-group row mr-auto ml-auto justify-content-center">
                  <label for="inputItemName" class="col-sm-2 col-form-label">Balance</label>
                  <div class="col-sm-8">
                      <input type="number" value="<?php echo $data["currentBalance"] ?>" class="form-control" id="inputItemName" name="currentBalance" placeholder="Balance">
                  </div>
              </div>
            <?php endif; ?>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemCategory" class="col-sm-2 col-form-label">Department</label>
                <div class="col-sm-8">
                    <select class="form-control" name="departmentId">
                        <option value="">Please choose a department</option>
                        <?php foreach ($department as $item): ?>
                        <option value="<?php echo $item["departmentId"]; ?>"><?php echo $item["name"]; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php if (isset($error["departmentId"])): ?>
                      <p class="text-danger ">&nbsp <?php echo $error["departmentId"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemName" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-8">
                    <select class="form-control" name="roleId">
                    <option value="<?php echo $addrole ?>">
                      <?php foreach ($role as $item){
                        if ($addrole==$item["roleId"]) {
                          echo $item["name"]."-".$item["description"];
                        }
                      } ?>
                    </option>
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
                    <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                </div>
            </div>
        </form>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
