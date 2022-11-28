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
        <h1 class="h3 mb-0 text-gray-800">Photos</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <?php

    $photo = Photo::getById($_GET['id']);
    if (isset($_POST['update'])) {
        if ($photo) {
            $photo->title = $_POST['title'];
            $photo->description = $_POST['description'];
            $photo->setFile($_FILES['fileUpload']);

            if ($photo->savePhoto()) {
                $message = "Photo information updated successfully";
            } else {
                $message = join("<br>", $photo->errors);
            }

            echo $message;
        }
    }

    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="d-flex">
            <div class="d-inline-block bg-white border rounded p-4 col-lg-10">
                <figure class="figure">
                    <img src="<?php echo $photo->picturePath(); ?>" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    <figcaption class="figure-caption">
                        <input type="file" name="fileUpload">
                    </figcaption>
                </figure>
                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="col-md-12 pl-0">
                        <input id="title" type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <div class="col-md-12 pl-0">
                        <textarea id="description" name="description" class="form-control"><?php echo $photo->description; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="d-inline-block col-md-2">
                <div class="photo-info-box">
                    <div class="info-box-header">
                        <span id="toggle" class="d-flex justify-content-end"><i class="fas fa-chevron-up"></i></span>
                    </div>
                    <div class="inside">
                        <div class="box-inner">
                            <p class="text">
                                <span><i class="fas fa-calendar-alt"></i></span> Uploaded on: <?php echo date("Y-m-d", strtotime($photo->date)); ?>
                            </p>
                            <p class="text">
                                Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                            </p>
                            <p class="text">
                                Filename: <span class="data"><?php echo $photo->filename; ?></span>
                            </p>
                            <p class="text">
                                File Type: <span class="data"><?php echo $photo->type; ?></span>
                            </p>
                            <p class="text">
                                File Size: <span class="data"><?php echo $photo->size; ?></span>
                            </p>
                        </div>
                        <div class="info-box-footer d-flex justify-content-between">
                            <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                            <div class="info-box-delete">
                                <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("includes/footer.php"); ?>
