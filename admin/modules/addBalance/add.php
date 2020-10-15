<?php

    $open="addbalance";
    require_once __dir__. "/../../autoload/autoload.php";
    $id=strval(getInput("name"));
    $addbalance=$db->fetchID("tbluser", 'username', "'".$id."'");
    $department=$db->fetchAll("tbldepartment");
    if (empty($addbalance)) {
        $_SESSION["error"]="Data is not exist";
        redirectCate("addBalance");
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        // if(isset($_POST["name"]) && $_POST["name"]!=NULL)
        // {
        //   $name=$_POST["name"];
        // }

        // $name=postInput("name");
        // echo $name;

        $data = $addbalance;
        $data["currentBalance"]= $data["currentBalance"]+postInput("addBalance");

        $error = [];


        if (postInput("addBalance")==0) $error["addBalance"]="Please fill out this form completely";


        if (empty($error)) {
            $idadd=$db->update("tbluser", $data, array("username"=>$id));
            if ($idadd>0) {
                $_SESSION["success"]="Add successfully";
                redirectCate("addBalance");
            }
            else {
                $_SESSION["error"]="Edit canceled";
                redirectCate("addBalance");
            }
        }
    }

?>

<?php require_once __dir__. "/../../layouts/header.php"; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Add balance</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add</h1>
        </div>
        <div class="clearfix"></div>
        <?php require_once __dir__. "/../../../partials/notification.php"; ?>
        <!-- Content Row -->
        <!-- DataTales Example -->
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemName" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-8">
                <?php echo $addbalance["username"]; ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemName" class="col-sm-2 col-form-label">Fullname</label>
            <div class="col-sm-8">
                <?php echo $addbalance["fullname"]; ?>
            </div>
        </div>
        <div class="form-group row mr-auto ml-auto justify-content-center">
            <label for="inputItemCategory" class="col-sm-2 col-form-label">Department</label>
            <div class="col-sm-8">
                    <?php foreach ($department as $item):
                      if ($item["departmentId"]==$addbalance["departmentId"]): ?>
                        <div class="col-sm-8">
                            <?php echo $item["name"]; ?>
                        </div>
                    <?php endif; endforeach ?>
            </div>
        </div>
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group row mr-auto ml-auto justify-content-center">
                <label for="inputItemName" class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-8">
                    <input type="number" value=0 class="form-control" id="inputItemName" name="addBalance" placeholder="Amount">
                    <?php if (isset($error["addBalance"])): ?>
                    <p class="text-danger ">&nbsp <?php echo $error["addBalance"]; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group row mr-auto ml-auto">
                <label for="inputCategoryDes" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary mr-auto ml-auto d-block"><i class="fas fa-plus fa-sm text-white-50"></i> Add balance</button>
                </div>
            </div>
        </form>
        <a class="btn btn-xs btn-info" href="index.php"><i class="fas fa-undo"></i> Cancle</a>
    </div>
    <!-- End of Main Content -->

<?php require_once __dir__. "/../../layouts/footer.php"; ?>
