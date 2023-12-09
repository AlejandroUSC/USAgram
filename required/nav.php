<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="main.php"><strong>US'Agram</strong></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="nav-about" href="about.php">About</a>
            </li>
            <li class="nav-item">
                <form class="form-inline" id="search-form">
                    <input type="text" class="form-control" id="search-term" placeholder="Search State...">
                    <button class="btn btn-outline-primary" id="search-button" type="submit">Search</button>
                </form>
            </li>
            <li class="nav-item">
                <?php if (!isset($_SESSION['logged_in'])) : ?>
                    <a class="nav-link" id="nav-login" href="login.php">Login</a>
                <?php else : ?>
                    <a class="nav-link" id="nav-login" href="logout.php">Logout</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</nav>