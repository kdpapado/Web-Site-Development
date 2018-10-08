<?php
define('DB_HOST', 'webpagesdb.it.auth.gr');
define('DB_NAME', 'quiz1');
define('DB_USER','emitsopou1');
define('DB_PASSWORD','emitsopou1');

$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysqli_error());
$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());


?>