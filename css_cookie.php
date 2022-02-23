<?php
$default_theme = "";
if (!isset($_COOKIE['webstyle'])) {
    $default_theme = "blitzer";
} else {
	$default_theme = $_COOKIE['webstyle'];
}
?>