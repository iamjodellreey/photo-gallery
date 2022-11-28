<?php

include("includes/header.php");
include("includes/photo_modal.php");

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

    $user = User::getById($_GET['id']);
    if (isset($_POST['update'])) {
        if ($user) {
            $user->username = $_POST['username'];
            $user->firstname = $_POST['firstname'];
            $user->lastname = $_POST['lastname'];
            $user->file = $_FILES['image'];

            if ($user->checkImage()) {

                $targetPath = SITE_ROOT . DS . 'admin' . DS . $user->picturePath();
                move_uploaded_file($user->tmpPath, $targetPath);

                $user->save();
                echo "Successfully updated with profile image";
            } else {
                $user->save();
                echo "Successfully updated without profile image";
            }
        }
    }

    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="bg-white border rounded p-4">
            <div class="form-group">
                <figure class="figure">
                    <a href="" data-toggle="modal" data-target="#photo-modal">
                        <img id="userId" src="<?php echo $user->picturePath(); ?>" class="figure-img img-fluid rounded" alt="image" value="<?php echo $user->id; ?>">
                    </a>
                    <figcaption class="figure-caption">
                        <input type="file" name="image">
                    </figcaption>
                </figure>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="col-md-12 pl-0">
                    <input id="username" type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <div class="col-md-12 pl-0">
                    <input id="firstname" type="text" name="firstname" class="form-control" value="<?php echo $user->firstname; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <div class="col-md-12 pl-0">
                    <input id="lastname" type="text" name="lastname" class="form-control" value="<?php echo $user->lastname; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 pl-0">
                    <a href="users.php">Cancel</a>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("includes/footer.php"); ?>
