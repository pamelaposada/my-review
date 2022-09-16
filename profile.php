<?php
include_once 'header.php';
include_once './includes/dbh.inc.php';
?>
<div class="profile-main">
    <header class="header-title">
        <?php
        // Review form messages
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyfields") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">You need to complete all fields.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else if ($_GET["error"] == "stmtfailed") {
                echo '<div class="alert alert-danger" role="alert">Server Error. Try again please.</div>';
            }
        }
        if (isset($_GET["review"])) {
            if ($_GET["review"] == "success") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">You have successfully created a review.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }

        // Upload image form messages
        if (isset($_GET["upload"])) {
            if ($_GET["upload"] == "extension-error") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">You have not uploaded an image.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else if ($_GET["upload"] == "size-error") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Your file size is too big!" <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else if ($_GET["upload"] == "system-error") {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops something went wrong. Upload your image again.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else if ($_GET["upload"] == "success") {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Your image has been uploaded successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }

        ?>
        <h1 class="my-5 text-center fw-bold text-title fs-1">Your Profile</h1>

    </header>

    <main class="container bg-white d-flex py-2 img-back position-relative" style="width: 1200px; height: 556px">
        <!-- Profile picture -->
        <div class="card me-5 text-center " style="width: 21rem; height: 32rem">
            <?php
            $userid = $_SESSION['userid'];

            $sqlimage = "SELECT * FROM profileimage WHERE userId = $userid";
            $result = mysqli_query($conn, $sqlimage);
            ?>

            <img src="./uploads/profile<?php
                                        if (mysqli_num_rows($result) > 0) {
                                            echo "$userid.png?" . mt_rand();
                                        } else {
                                            echo "default.png";
                                        }
                                        ?>" class="card-img-top" alt="profile">

            <div class="card-body font-type">
                <h5 class="card-title text-center">
                    <?php
                    echo (strtoupper($_SESSION["useruid"]));
                    ?>
                </h5>
                <p class="card-text text-center fs-6">Something about me.</p>
                <form action="./includes/upload.inc.php" method="POST" enctype="multipart/form-data" class="mx-auto">
                    <input type="file" name="file">
                    <button type="submit" name="submit-file" class="btn btn-success mt-2">Upload image</button>
                </form>
            </div>
        </div>
        <!-- Post Form -->
        <!-- createreview.inc.php - Will process the data from this form-->
        <form action="includes/createreview.inc.php" method="POST" style="width: 800px" class="p-3">
            <h4 class="form-title py-2">Create Review</h4>

            <!-- 1. TITLE -->
            <div class="mb-3">
                <label for="rstaurant" class="form-label fs-6">Restaurant name</label>
                <input type="text" class="form-control" name="rname" placeholder="Restaurant name" value="">
            </div>

            <!-- 2. IMAGE URL -->
            <div class="mb-3">
                <label for="imageurl" class="form-label fs-6">Image URL</label>
                <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="">
            </div>

            <!-- 3. COMMENT SECTION -->
            <div class="mb-3">
                <label for="comment" class="form-label fs-6">Comment</label>
                <textarea class="form-control" name="comment" rows="3" placeholder="Comment"></textarea>
            </div>
            <!-- 4. RATING -->
            <div class="mb-3">
                <div>
                    <label for="comment" class="form-label fs-6">Rating</label>
                </div>
                <input type="radio" name="rating" value="1"> 1
                <input type="radio" name="rating" value="2" class="ms-2"> 2
                <input type="radio" name="rating" value="3" class="ms-2"> 3
                <input type="radio" name="rating" value="4" class="ms-2"> 4
                <input type="radio" name="rating" value="5" class="ms-2"> 5
            </div>

            <!-- 6. SUBMIT BUTTON -->
            <button type="submit" name="review-submit" class="btn btn-success w-100 fs-6">Post Review</button>
        </form>

    </main>
</div>
<?php
include_once 'footer.php';

?>
<!-- <div class="something"></div> -->