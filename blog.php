<?php
include_once 'header.php';
require_once './includes/dbh.inc.php';
require_once './includes/functions.inc.php';
?>


<?php

// Message alerts from update review button

if (isset($_GET['updatereview'])) {
    if ($_GET['updatereview'] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">You review has been updated successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } else if ($_GET['updatereview'] == "emptyinput") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">You can not leave empty fields when uploading your review. Try again!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

// Message alerts from delete review button

if (isset($_GET['deletereview'])) {
    if ($_GET['deletereview'] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">You review has been deleted successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    } else if ($_GET['deletereview'] == "stmterror") {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Oops, something went wrong. Try again!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}

?>
<h2 class="py-2 my-5 text-center fw-bold text-title fs-1">Reviews</h2>



<?php
// Loop all the reviews and show the edit and delete button just if the current userid match to the session id

$sql = "SELECT posts.postsId, posts.rname, posts.imageUrl, posts.postComment, posts.rating, posts.usersId, users.usersUid FROM posts LEFT JOIN users ON posts.usersId = users.usersId";



$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    $output = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $output .=

            '<div class="container p-4 bg-light my-3 position-relative" style="width: 800px">
                <div class="card " id="' . $row['postsId'] . '">
                    <img src="' . $row['imageUrl'] . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center text-success fw-bold">' . $row['rname'] . '</h5>
                        <p class="card-text">' . $row['postComment'] . '</p>
                        <p class="card-text"><small class="text-muted">Score: ' . $row['rating'] . '</small></p>
                        <p class="card-text star-color"><small>' . reviewRating((int)$row['rating']) . '</small></p>
                        
                        <p class="card-text"><small>Posted by ' . $row['usersUid'] . '</small></p>
                        

                    </div>';
        if (isset($_SESSION['userid'])) {
            if ($row['usersId'] == ($_SESSION['userid'])) {
                $output .= '
                            <div class="admin-btn m-auto mb-2">
                              <a href="editpost.php?id=' . $row['postsId'] . '" class="btn btn-secondary mt-2">Edit</a>
                              <a href="includes/deletepost.inc.php?id=' . $row['postsId'] . '" class="btn btn-danger mt-2">Delete</a>
                            </div>';
            }
        }


        $output .=
            '        
                
                </div>
            </div>';
    }
    echo $output;
}

?>

<!-- <div class="card mb-3">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div> -->

<!-- </div> -->

<?php
include_once 'footer.php';

?>