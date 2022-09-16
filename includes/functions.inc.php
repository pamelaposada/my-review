<?php
// Signup funtions
function emptyInputSignup($username, $mail, $pwd, $pwdRepeat)
{
    // $result;
    if (empty($username) || empty($mail) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($username)
{
    // $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidEmail($mail)
{
    // $result;
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdMatch($pwd, $pwdRepeat)
{
    // $result;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function existentUid($conn, $username, $mail)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $mail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $mail, $pwd)
{
    $sql = "INSERT INTO users (usersEmail, usersUid, usersPwd) VALUES (?, ?, ?) ;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $mail, $username, $hashPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

// Login functions
function emptyInputLogin($username, $pwd)
{
    // $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd)
{
    $uidExist = existentUid($conn, $username, $username);

    if ($uidExist === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $hashPwd = $uidExist["usersPwd"];
    $checkPwd = password_verify($pwd, $hashPwd);

    if ($checkPwd === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExist["usersId"];
        $_SESSION["useruid"] = $uidExist["usersUid"];
        header("location: ../index.php?login=success");
        exit();
    }
}

// Create review functions

function emptyReview($restName, $imageUrl, $comment, $rating)
{
    if (empty($restName) || empty($imageUrl) || empty($comment) || empty($rating)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function createReview($conn, $restName, $imageUrl, $comment, $rating, $userid)
{
    $sql = "INSERT INTO posts (rname, imageUrl, postComment, rating, usersId) VALUES (?, ?, ?, ?, ?) ;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssii", $restName, $imageUrl, $comment, $rating, $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?review=success");
    exit();
}

// Reviews page
// Rating

function reviewRating($rating)
{
    if ($rating === 5) {
        return '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
    } else if ($rating == 4) {
        return '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
    } else if ($rating == 3) {
        return '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
    } else if ($rating == 2) {
        return '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
    } else if ($rating == 1) {
        return '<i class="fas fa-star"></i>';
    }
}

// Profile page
// Profile picture

function uploadProfileImage($conn, $userid, $status)
{

    $sql = "INSERT INTO profileimage (userId, status) VALUES (?, ?) ;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?upload=errorstmt");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ii", $userid, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../profile.php?upload=success");
    exit();
}

// Edit post page


function emptyUpdateReview($restName, $imageUrl, $comment, $rating)
{
    if (empty($restName) || empty($imageUrl) || empty($comment) || empty($rating)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function updateReview($conn, $rname, $imageUrl, $comment, $rating, $postid)
{
    $sql = "UPDATE posts SET rname = ?, imageUrl = ?, postComment = ?, rating = ? WHERE postsId = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../blog.php?updatereview=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssii", $rname, $imageUrl, $comment, $rating, $postid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../blog.php?updatereview=success");
    exit();
}
