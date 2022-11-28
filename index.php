<?php

include('includes/header.php');

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 4;
$totalCount = count(Photo::getAll());

$paginate = new Paginate($page, $itemsPerPage, $totalCount);
$sql = "SELECT * FROM photos LIMIT {$itemsPerPage} OFFSET {$paginate->offset()}";

?>


<div class="container">
  <h1 class="fw-light text-center text-lg-start mt-4 mb-0">My Gallery</h1>
  <hr class="mt-2 mb-5">
  <div class="row text-center text-lg-start">
    <?php
    $photos = Photo::getQuery($sql);

    foreach($photos as $photo):
    ?>
        <div class="col-lg-3 col-md-4 col-6">
        <a href="photo.php?id=<?php echo $photo->id; ?>" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="<?php echo "admin/" . $photo->picturePath(); ?>" alt="">
        </a>
        </div>
    <?php endforeach; ?>
  </div>

  <nav aria-label="Page navigation">
    <ul class="pagination">
       <?php if($paginate->hasPrevious()){ ?>
      <li class="page-item">
        <a class="page-link" href="index.php?page=<?php echo $paginate->previous(); ?>" aria-label="Previous">
          <span aria-hidden="true">«</span>
        </a>
      </li>
       <?php } ?>
      <?php if($paginate->hasNext()){ ?>
        <li class="page-item">
        <a class="page-link" href="index.php?page=<?php echo $paginate->next(); ?>" aria-label="Next">
          <span aria-hidden="true">»</span>
        </a>
      </li>
      <?php } ?>
    </ul>
  </nav>
</div>
