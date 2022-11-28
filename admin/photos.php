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
        <h1 class="h3 mb-0 text-gray-800">Photo List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <a href="uploads.php"><button class="btn btn-primary">Upload Photo</button></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">ID#</th>
                <th>Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Filename</th>
                <th scope="col">Type</th>
                <th scope="col">Size</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php
                  if (isset($_POST['search'])){
                    $photo = new Photo();
                    $photos = $photo->searchUser($_POST['keyword'], 'title');
                } else {
                    $photos = Photo::getAll();
                }

            foreach ($photos as $photo) {
            ?>
                <tr>
                    <th scope="row"><?php echo $photo->id ?></th>
                    <td>
                        <img class="img-thumbnail" src="<?php echo $photo->picturePath(); ?>" alt="image.jpg">
                        <div class="picture_link">
                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                            <a href="update_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                            <a href="../photo.php?id=<?php echo $photo->id; ?>">Show</a>
                        </div>
                    </td>
                    <td><?php echo $photo->title; ?></td>
                    <td><?php echo $photo->description; ?></td>
                    <td><?php echo $photo->filename; ?></td>
                    <td><?php echo $photo->type; ?></td>
                    <td><?php echo $photo->size; ?></td>
                    <td><a href="photo_comment.php?id=<?php echo $photo->id; ?>">
                        <?php
                        $comments = Comment::getComment($photo->id);
                        echo count($comments)
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include("includes/footer.php"); ?>
