<?php

require_once 'app/helpers.php';
$userAuth = user_auth();

if (!$userAuth) {

    header('location: signin.php');
    exit;

}

$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");

$pid = $_GET['pid'] ?? null;
$uid = $_SESSION['uid'];

if ($pid && is_numeric($pid)) {
    $pid = mysqli_real_escape_string($link, $pid);
    $sql = "DELETE FROM posts WHERE id = $pid AND user_id = $uid";
    $result = mysqli_query($link, $sql);

    if ($result) {
        header('location: blog.php');
        exit;
    }

} else {
    header('location: logout.php');
    exit;
}