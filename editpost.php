<?php
include_once 'header.php';
require_once './includes/dbh.inc.php'
?>




<!-- Review Form -->
<div class="p-5 profile-main">
    <h1 class="my-3 text-center fw-bold text-title fs-1">Update You Review </h1>
    <?php
    if (isset($_SESSION['userid']) && isset($_GET['id'])) {
        $postid = mysqli_real_escape_string($conn, $_GET['id']);
        $postid = intval($postid);
        $row;

        $sql = "SELECT rname, imageUrl, postComment FROM posts WHERE postsId = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: blog.php?id=$postid&editpost=stmterror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $postid);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
        }
    }

    ?>



    <form action="includes/editpost.inc.php?id=<?php echo $_GET['id'] ?>" method="POST" class="mx-auto p-5 form-corners" style="width: 800px">


        <!-- 1. TITLE -->
        <div class="mb-3">
            <label for="rstaurant" class="form-label fs-5 text-success">Restaurant name</label>
            <input type="text" class="form-control form-control fs-6 text-secondary" name="rnameupdate" placeholder="Restaurant name" value="<?php echo $row['rname'] ?>">
        </div>

        <!-- 2. IMAGE URL -->
        <div class="mb-3">
            <label for="imageurl" class="form-label fs-5 text-success">Image URL</label>
            <input type="text" class="form-control fs-6 text-secondary" name="imageurlupdate" placeholder="Image URL" value="<?php echo $row['imageUrl'] ?>">
        </div>

        <!-- 3. COMMENT SECTION -->
        <div class="mb-3">
            <label for="comment" class="form-label fs-5 text-success">Comment</label>
            <textarea class="form-control form-control fs-6 text-secondary" name="commentupdate" rows="3" placeholder="Comment"><?php echo $row['postComment'] ?></textarea>
        </div>
        <!-- 4. RATING -->
        <div class="mb-3">
            <div>
                <label for="comment" class="form-label fs-5 text-success">Rating</label>
            </div>
            <div>
                <input type="radio" name="ratingupdate" value="1"> 1
                <input type="radio" name="ratingupdate" value="2" class="ms-2"> 2
                <input type="radio" name="ratingupdate" value="3" class="ms-2"> 3
                <input type="radio" name="ratingupdate" value="4" class="ms-2"> 4
                <input type="radio" name="ratingupdate" value="5" class="ms-2"> 5
            </div>
        </div>

        <!-- 6. SUBMIT BUTTON -->
        <button type="submit" name="editreview-submit" class="btn btn-success w-100 fs-6">Post Review</button>
    </form>

</div>



<?php
include_once 'footer.php';

?>