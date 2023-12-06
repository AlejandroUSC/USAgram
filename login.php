<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>


<!-- https://getbootstrap.com/docs/4.3/components/forms/? -->
<!-- https://mdbootstrap.com/docs/standard/extended/modal-form/#example1 -->

<!-- Template used for this. has modifications -->

<body class="login-body">

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

    <div class="container cust-container">
        <div class="row">
            <div class="cust-col">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login to Your Account</h3>
                        <form id="login-form">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone.</small>
                                <small id="firstname-error" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary  mx-auto d-block">Login</button>
                            <p class="text-center" id="p-text-center">Don't have an account?
                                <a href="#" data-toggle="modal" data-target="#registerModal">Create one</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Template grabbed for this - has modification -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-75">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Sign in</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-fname">First Name</label>
                            <input type="text" id="reg-fname" class="form-control" placeholder="John" required>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-lname">Last Name</label>
                            <input type="text" id="reg-lname" class="form-control" placeholder="Smith" required>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-email">Email address</label>
                            <input type="email" id="reg-email" class="form-control" placeholder="jsmith@gmail.com"
                                required>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="reg-password">Password</label>
                            <input type="text" id="reg-password" class="form-control" placeholder="*******"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="footer" class="container-fluid">
        <div class="row">
            <div id="footer-text" class="col-12 text-center">
                © 2023 Alejandro Martinez
            </div>
        </div>
    </div> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>

</body>

</html>