<?php
session_start();

if (isset($_POST['review-submit']) && isset($_SESSION['userid'])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $restName = $_POST['rname'];
    $imageUrl = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $userid = $_SESSION['userid'];

    if (emptyReview($restName, $imageUrl, $comment, $rating) !== false) {
        header("Location: ../profile.php?error=emptyfields");
        exit();
    } else {
        createReview($conn, $restName, $imageUrl, $comment, $rating, $userid);
    }
} else {
    header("location: ../index.php");
    exit();
}
