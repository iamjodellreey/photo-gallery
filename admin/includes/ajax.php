<?php

require_once("init.php");

$user = new User();
$user->updateImage($_POST['userId'], $_POST['imageName']);
