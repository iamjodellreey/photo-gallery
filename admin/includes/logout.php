<?php

require_once("header.php");

$session->logout();
redirect("../login.php");
