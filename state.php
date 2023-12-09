    <?php
    require "config/config.php";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }
    $mysqli->set_charset('utf8');

    require "required/yield.php"; // Displays submissions

    require "required/create.php"; // Adds submissions

    require "required/delete.php"; // Deletes submissions
    
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="The beautiful US state, <?php echo $sub['state']; ?>! Have you visited here before? Lovely! Come share your experience! Never been? Doesn't matter! Come look at what others have done!">
        <title>US'Agram</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        
        <!-- Use open-iconic from lecture example -->
        <link href="lib/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <?php include 'required/nav.php'; ?>

        <div id="content">

            <div id="state-div">
                <h1 id="state-name-rep">State</h1>
            </div>

            <div id="state-container">
                <div id="state-img">
                    <img id="state-flag" src="usr_img/loading.jpeg" alt="State flag">
                </div>
                <div id="state-desc">
                    <p></p>
                </div>
            </div>

            <hr>

            <?php while ($sub = $submissionResult->fetch_assoc()) : ?>
                <div class="post-container">
                    <div class="post-header">
                        <span class="user-name">User: <?php echo $sub['first'] . ' ' .  $sub['last']; ?></span>
                        <span class="state-name">Location: <?php echo $sub['city'] . ", " . str_replace('_', ' ', $sub['state']); ?></span>
                        <span class="post-date">Date: <?php echo date('Y-m-d',strtotime($sub['date'])); ?></span>
                        <?php if ($sub['userID'] == $userID) : ?>
                            <svg class="edit-button" data-submission-id="<?php echo $sub['ID']; ?>" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                            <span class="todo-remove oi oi-circle-x del-button" title="Remove" data-submission-id="<?php echo $sub['ID']; ?>"></span>
                        <?php endif; ?>
                    </div>
                    <div class="post-body">
                        <img class="user-image" src="<?php echo $sub['file']; ?>" alt=" <?php echo $sub['first'] . ' ' . $sub['last'] . ' uploaded picture'; ?>">
                        <div class="post-description">
                            <p class="user-description"> <?php echo $sub['des']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
            <button type="button" class="btn btn-primary" id="upload-button" data-toggle="modal" data-target="#uploadModal">
                + Add a Memory +
            </button>
        <?php endif; ?>

        <!-- Credit to https://bestjquery.com/tutorial/pagination/demo216/ -->
        <nav class="pagination-outer" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php if ($curr_page <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a href="<?php $_GET['page'] = $curr_page - 1;
                                echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href=""><?php echo $curr_page; ?></a></li>
                <li class="page-item <?php if ($curr_page >= $fin_page) {
                                            echo 'disabled';
                                        } ?>">
                    <a href="<?php $_GET['page'] = $curr_page + 1;
                                echo $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET); ?>" class="page-link" aria-label="Next">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Photo</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="upload-form" action="<?php echo $url; ?>" method="POST" enctype="multipart/form-data">
                            <div class="upload-form-group">
                                <label for="picture-upload">Select image to upload</label>
                                <input type="file" class="form-control" name="image_up" id="picture-upload" accept="image/png, image/jpeg, image/jpg" required>
                            </div>
                            <div class="upload-form-group">
                                <label for="location">What city was this picture taken in?</label>
                                <textarea class="form-control" id="location" name="city" rows="1" maxlength="100" required></textarea>
                            </div>
                            <div class="upload-form-group">
                                <label for="time">When was this picture taken?</label>
                                <input class="form-control" name="date" type="date" id="time" name="date" required>
                            </div>
                            <div class="upload-form-group">
                                <label for="description">Description (300 characters or less)</label>
                                <textarea class="form-control" id="description" name="desc" rows="3" maxlength="300" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="loginModel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModel">Not Logged In</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You need to login inorder to share your memories!</p>
                        <a href="login.php" class="btn btn-primary">Register or Login now!</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer" class="container-fluid">
            <div class="row">
                <div id="footer-text" class="col-12 text-center">
                    This map was created and can be edited at
                    <a href="http://simplemaps.com/custom/us/uCVg3D6K">http://simplemaps.com/custom/us/uCVg3D6K</a>
                    <br>
                    © 2023 Alejandro Martinez
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/state_insert.js"></script>

        <script>
            // Deleting Post
            $(document).ready(function() {
                $(".del-button").on("click", function() {
                    var submissionID = $(this).data("submission-id");
                    console.log("in ajax: ".submissionID);
                    // Perform the AJAX request
                    $.ajax({
                        type: "POST",
                        url: window.location.href,
                        data: {
                            submissionID: submissionID
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(error) {
                            console.error("Error:", error);
                        }
                    });
                });
            });

            // Updating a Post
            $(document).ready(function() {
                $(".edit-button").on("click", function() {
                    var submissionID = $(this).data('submission-id');
                    window.location.href = "edit_content.php?sub=" + submissionID;
                });
            });
        </script>

    </body>