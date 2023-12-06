<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>US'Agram</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <script src="simplemaps/mapdata.js"></script>
  <script src="simplemaps/usmap.js"></script>
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

  <div class="div-body">
    <div id="map"></div>
  </div>

  <div id="footer">
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

</body>

</html>