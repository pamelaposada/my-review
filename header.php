<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Home</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand logo-text" href="index.php">My Review <i class="fab fa-microblog"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link active" href="blog.php">Reviews</a>

                    <?php
                    if (isset($_SESSION["useruid"])) {
                        echo "<a class='nav-link active' href='profile.php'>Profile</a>";
                        echo
                        "<form action='includes/logout.inc.php' action='POST' class='rounded'>
                        <button type='submit' class='btn btn-light w-100' name='logout-submit'>Log out</button>
                      </form>";
                    } else {
                        echo "<a class='nav-link active' href='signup.php'>Sign Up</a>";
                        echo "<button type='button' class='btn btn-light' data-bs-toggle='modal' data-bs-target='#login-modal'>
                        Login
                    </button>";
                    }

                    ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->

    <!-- Login Modal: START -->
    <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <!-- login.inc.php - Will process the data from this form-->
                <div class="modal-body">
                    <form action="includes/login.inc.php" method="POST">

                        <div class="mb-3">
                            <label for="username" class="form-label">Username / Email: </label>
                            <input id="username" type="text" class="form-control" name="uid" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="pwd" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success w-100" name="login-submit" id="liveAlertBtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal: END -->