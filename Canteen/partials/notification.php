<?php if (isset($_SESSION["success"])):  ?>
  <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION["success"]; unset($_SESSION["success"]); ?>
  </div>
<?php endif; ?>
<?php if (isset($_SESSION["error"])):  ?>
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?>
  </div>
<?php endif; ?>
