<?php

include("includes/init.php");

$photo = Photo::getById($_GET['id']);

if (empty($_GET['id'])) {
    echo "No ID found";
    redirect("photos.php");
} else if ($photo) {
    $photo->deletePhoto();
    redirect("photos.php");
} else {
    redirect("photos.php");
}
