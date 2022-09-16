<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['editreview-submit']) && isset($_SESSION['userid'])) {

    $idpost = mysqli_real_escape_string($conn, $_GET['id']);
    $idpost = intval($idpost);
    $rname =  $_POST['rnameupdate'];
    $imageurl = $_POST['imageurlupdate'];
    $postComment = $_POST['commentupdate'];
    $rating = $_POST['ratingupdate'];

    if (emptyUpdateReview($rname, $imageurl, $postComment, $rating) !== false) {
        header("location: ../blog.php?updatereview=emptyinput");
        exit();
    } else {
        updateReview($conn, $rname, $imageurl, $postComment, $rating, $idpost);
    }
} else {
    header("Location: ../profile.php");
    exit();
}
