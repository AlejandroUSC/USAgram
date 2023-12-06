<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

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


    <div class="img-container">
        <img class="sum-img mx-auto d-block"
            src="https://img.freepik.com/premium-vector/computer-monitor-with-map-usa-browser-search-country-usa-web-mapping-program_292608-11252.jpg?w=500"
            alt="Map of USA">
        <div class="overlay-title">
            <h1>US'Agram</h1>
        </div>
        <p>
            An online spin off of Google Maps and Instagram. A place where one can share their pictures and experience
            about a time they visited one of the US States!
        </p>
    </div>

    <hr class="img-container-hr">


    <section class="container mt-5" id="container-sum">
        <h2>Sharing Photos</h2>
        <p>Our site allows you to post your own pictures about the state of your choice! Funny, lovely, or even
            mesmerizing
            we welcome you to share your memories on US'Agram!
        </p>

        <h2>Story Telling</h2>
        <p>
            Bring the memory back to life! Do share about that wonderful moment of when you took that snapshot. Whether
            it was a funny
            funny moment, hidden picture, or one taken in the spur of the moment. Tell the story and let everyone relive
            it with you!
        </p>

        <h2>User Engagement</h2>
        <p>
            Engage with the webstie by creating an account! Sign up now and share your memory! Don't worry!
            Uncomfortable with having it up
            for eternity? Delete whenever you'd like. You're only a click away!
        </p>

    </section>



    <div id="footer" class="container-fluid">
        <div class="row">
            <div id="footer-text" class="col-12 text-center">
                © 2023 Alejandro Martinez
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>