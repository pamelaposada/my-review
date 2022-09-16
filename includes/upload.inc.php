<?php
session_start();
include_once 'dbh.inc.php';
include_once 'functions.inc.php';

$userid = $_SESSION['userid'];


if (isset($_POST['submit-file'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));



    $allowedFiles = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowedFiles)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $newFileName = "profile" . $userid . "." . "png";
                $fileDestination = '../uploads/' . $newFileName;
                move_uploaded_file($fileTmpName, $fileDestination);
                // Send data to bd
                $status = 1;
                uploadProfileImage($conn, $userid, $status);
            } else {
                // echo "Your file is too big!";
                header("Location: ../profile.php?upload=size-error");
            }
        } else {
            // echo "Oops something went wrong. Upload your file again!";
            header("Location: ../profile.php?upload=system-error");
        }
    } else {
        // echo "You can't upload files of this type! or empty file";
        header("Location: ../profile.php?upload=extension-error");
    }
}
