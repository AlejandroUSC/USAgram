<?php 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>US'Agram</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Use open-iconic from lecture example -->
    <link href="lib/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
</head>

<!-- Template grabbed and modified from this site -->
<!-- https://mdbootstrap.com/docs/standard/extended/modal-form/#example1 -->

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="main.php"><strong>US'Agram</strong></a>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" id="nav-about" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <form class="form-inline" id="search-form">
                <input type="text" class="form-control" id="search-term" placeholder="Search...">
                <button class="btn btn-outline-primary" id="search-button" type="submit">Search</button>
              </form>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-login" href="login.php">Login</a>
            </li>
          </ul>
        </div>
      </nav>

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

        <div class="post-container">
            <div class="post-header">
                <span class="user-name">User: Alejandro Martinez</span>
                <span class="state-name">Location: Seattle, Washington</span>
                <span class="post-date">Date: June 2023</span>
                <span class="todo-remove oi oi-circle-x" title="Remove"></span>
            </div>
            <div class="post-body">
                <img class="user-image" src="usr_img/Washington.jpg" alt="Alejandro in front of the Space Needle">
                <div class="post-description">
                    <p class="user-description">A spontanious 2 day trip to Seattle, Washington!</p>
                </div>
            </div>
        </div>

        <div class="post-container">
            <div class="post-header">
                <span class="user-name">User: Alejandro Martinez</span>
                <span class="state-name">Location: San Diego, California</span>
                <span class="post-date">Date: April 2021</span>
                <span class="todo-remove oi oi-circle-x" title="Remove"></span>
            </div>
            <div class="post-body">
                <img class="user-image" src="usr_img/California.jpg" alt="Alejandro and friends at the beach">
                <div class="post-description">
                    <p class="user-description">Weekend get away with friends! We drove down to San Diego and explored the
                        beaches and city!</p>
                </div>
            </div>
        </div>

        <div class="post-container">
            <div class="post-header">
                <span class="user-name">User: Alejandro Martinez</span>
                <span class="state-name">Location: Liberty Island, New York</span>
                <span class="post-date">Date: July 2018</span>
                <span class="todo-remove oi oi-circle-x" title="Remove"></span>
            </div>
            <div class="post-body">
                <img class="user-image" src="usr_img/New_York.jpeg" alt="Statue of Liberty">
                <div class="post-description">
                    <p class="user-description">Heres a picture I took of the statue of liberty while on a boat ride to the
                        island! It was a fun trip!</p>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="upload-button" data-toggle="modal" data-target="#uploadModal">
        + Add a Memory +
    </button>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Photo</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upload-form">
                        <div class="upload-form-group">
                            <label for="picture-upload">Select image to upload</label>
                            <input type="file" class="form-control" id="picture-upload"
                                accept="image/png, image/jpeg, image/jpg" required>
                        </div>
                        <div class="upload-form-group">
                            <label for="location">What city was this picture taken in?</label>
                            <textarea class="form-control" id="location" rows="1" maxlength="100" required></textarea>
                        </div>
                        <div class="upload-form-group">
                            <label for="time">When was this picture taken? 'Month/Year'</label>
                            <textarea class="form-control" id="time" rows="1" maxlength="100" required></textarea>
                        </div>
                        <div class="upload-form-group">
                            <label for="description">Description (300 characters or less)</label>
                            <textarea class="form-control" id="description" rows="3" maxlength="300"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginRegisterModal" tabindex="-1" role="dialog" aria-labelledby="loginModel"
        aria-hidden="true">
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

    <script src="js/script.js"></script>
    <script src="js/state_insert.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>