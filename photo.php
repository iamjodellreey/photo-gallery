<?php

include("includes/header.php");

if(empty($_GET['id'])){
    redirect("index.php");
}

$photo = Photo::getById($_GET['id']);

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $newComment = Comment::makeComment($photo->id, $author, $body);

    if($newComment && $newComment->save()){
        redirect("photo.php?id={$photo->id}");
    } else {
        echo "Comment not saved";
    }
} else {
    $author = "";
    $body = "";
}

?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-4"><?php echo $photo->title; ?></h1>

                <hr>

                <!-- Date/Time -->
                <p>Posted on <?php echo $photo->date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img src="<?php echo "admin/" .$photo->picturePath(); ?>" class="img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                <hr>

                <!-- Comments Form -->
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form action="" method="POST">
                            <label for="author"></label>
                            <div class="form-group">
                                <input id="author" type="text" class="form-control" name="author">
                            </div>
                            <div class="form-group">
                                <textarea name="body" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Single Comment -->
                <?php
                    $comments = Comment::getComment($photo->id);
                    foreach($comments as $comment):
                ?>
                    <div class="media mb-4">
                        <div class="media-body">
                            <h5 class="mt-0"><?php echo $comment->author; ?></h5>
                                <?php echo $comment->body; ?>
                        </div>
                    </div>
                 <?php endforeach; ?>

                <!-- Comment with nested comments -->
                <!-- <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                    </div>
                </div> -->

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Side Widget</h5>
                    <div class="card-body">
                        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include("includes/footer.php"); ?>
