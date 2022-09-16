<?php
require_once "dbh.inc.php";
session_start();

if (isset($_SESSION['userid']) && isset($_GET['id'])) {
    $postid = mysqli_real_escape_string($conn, $_GET['id']);
    $postid = intval($postid);

    $sql = "DELETE FROM posts WHERE postsId = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../blog.php?deletereview=stmterror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $postid);
        mysqli_stmt_execute($stmt);
        header("Location: ../blog.php?deletereview=success");
        exit();
    }
} else {
    header("Location: ../signup.php");
    exit();
}
