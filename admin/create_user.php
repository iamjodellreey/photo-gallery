<?php

include("includes/header.php");

if (!$session->isSignedIn()) {
    redirect("login.php");
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php
    if (isset($_POST['submit'])) {

        $user = new User();
        $user->username  = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname  = $_POST['lastname'];
        $user->password  = $_POST['password'];
        $user->file = $_FILES['image'];

        if ($user->checkImage()) {

            $targetPath = SITE_ROOT . DS . 'admin' . DS . $user->picturePath();
            move_uploaded_file($user->tmpPath, $targetPath);

            $user->save();
            $message = "User registered successfully";
        } else if (!$user->checkImage()) {
            $user->save();
            $message = "User registered successfully without picture";
        } else {
            $message = "Failed registering the user";
        }

        echo $message;
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="bg-white border rounded p-4">
            <div class="form-group">
                <label for="profile-pic">Profile picture</label>
                <div class="col-md-12 pl-0">
                    <input id="profile-pic" type="file" name="image">
                </div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="col-md-12 pl-0">
                    <input id="username" type="text" name="username" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <div class="col-md-12 pl-0">
                    <input id="firstname" type="text" name="firstname" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <div class="col-md-12 pl-0">
                    <input id="lastname" type="text" name="lastname" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="col-md-12 pl-0">
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 pl-0">
                    <a href="users.php">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("includes/footer.php"); ?>
