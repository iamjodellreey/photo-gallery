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
        <h1 class="h3 mb-0 text-gray-800">Upload</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php

    if (isset($_POST['submit'])) {

        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->setFile($_FILES['fileUpload']);

        if ($photo->savePhoto()) {
            $message = "Photo uploaded successfully";
        } else {
            $message = join("<br>", $photo->errors);
        }

        echo $message;
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="bg-white border rounded p-4">
            <div class="form-group">
                <label for="title">Title</label>
                <div class="col-md-12 pl-0">
                    <input id="title" type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 pl-0">
                    <input type="file" name="fileUpload">
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
