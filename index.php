<?php
include_once 'header.php';
?>


<main class="bg-success">
    <?php

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo '<div class="alert alert-danger mb-0" role="alert">Please fill all the fields</div>';
        } else if ($_GET["error"] == "wronglogin") {
            echo '<div class="alert alert-danger mb-0" role="alert">Incorrect login details </div>';
        }
    }
    if (isset($_GET["session"])) {
        if ($_GET["session"] == "out") {
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">You have successfully logged out.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }

    if (isset($_SESSION["useruid"])) {
        if (isset($_GET["login"]) == "success") {
            echo "<div class='alert alert-info alert-dismissible fade show mb-0' role='alert'>" . "Welcome" . " " . $_SESSION["useruid"] . "!" .
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>" .
                "</div>";
        }
    }
    ?>
    <section class="heading">

        <div class="home-circle bg-success">
            <i class="fas fa-utensils food text-light"></i>
        </div>
        <div class="text-div">
            <h1 class="index-intro-text">Welcome to <span class="fw-bold melbourne text-success">My Review</span> Melbourne!</h1>
        </div>

    </section>
</main>
<footer class="bg-success footer-index">
    <p class="m-auto">Copyright &copy; 2021. All rights reserved. </p>
</footer>


<?php
include_once 'footer.php';

?>