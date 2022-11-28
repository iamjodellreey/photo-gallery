<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'xampp' . DS . 'htdocs' . DS . 'temp_photo_gallery');
defined('INLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

require_once("function.php");
require_once("new_config.php");
require_once("database.php");
require_once("database_service.php");
require_once("session.php");
require_once("photo.php");
require_once("user.php");
require_once("comment.php");
require_once("paginate.php");
