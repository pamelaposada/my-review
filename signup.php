<?php
include 'header.php'
?>
<main class="px-5 bg-light my-3 profile-main position-relative">
    <h2 class="py-2 my-5 text-center fw-bold text-title fs-1">Sign Up</h2>
    <?php

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo '<div class="alert alert-danger" role="alert">Please fill all the fields</div>';
        } else if ($_GET["error"] == "invaliduid") {
            echo '<div class="alert alert-danger" role="alert">Invalid username</div>';
        } else if ($_GET["error"] == "invalidemail") {
            echo '<div class="alert alert-danger" role="alert">Invalid email</div>';
        } else if ($_GET["error"] == "passworderrormatch") {
            echo '<div class="alert alert-danger" role="alert">You have typed different passwords </div>';
        } else if ($_GET["error"] == "usernametaken") {
            echo '<div class="alert alert-danger" role="alert">This username is already taken</div>';
        } else if ($_GET["error"] == "stmtfailed") {
            echo '<div class="alert alert-danger" role="alert">Something whent wrong. Try again!</div>';
        } else if (isset($_GET["error"]) == "none") {
            echo '<div class="alert alert-success" role="alert">You have successfully signed up!</div>';
        }
    }

    ?>

    <form action="includes/signup.inc.php" method="POST" class="p-4 form-corners">



        <!-- 1. USERNAME -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="uid" placeholder="Username">
        </div>

        <!-- 2. EMAIL -->
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="mail" placeholder="Email Address">
        </div>

        <!-- 3. PASSWORD -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="pwd" placeholder="Password">
        </div>

        <!-- 4. PASSWORD CONFIRMATION -->
        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
        </div>

        <!-- 6. SUBMIT BUTTON -->
        <button type="submit" name="signup-submit" class="btn btn-success w-100 mt-3">Sign Up</button>
    </form>
</main>





<?php
include_once 'footer.php'

?>