<?php

include("includes/header.php");

if(empty($_GET['id'])){
    redirect("photos.php");
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Comments</h1>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Body</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $comments = Comment::getComment($_GET['id']);
            $photo = Photo::getById($_GET['id']);
            foreach ($comments as $comment) {
            ?>
                <tr>
                    <td><?php echo $comment->id; ?></td>
                    <td><?php echo $comment->author; ?></td>
                    <td><?php echo $comment->body; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include("includes/footer.php"); ?>
