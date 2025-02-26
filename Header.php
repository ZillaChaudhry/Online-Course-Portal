<header>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 d-flex align-items-center">
                <img src="image/logo.png" alt="Logo" class="img-fluid logo">
                <?php if(isset($_SESSION['username'])): ?>
                    <form action="Logout.php" method="post">
                        <button type="submit" class="btn btn-danger ml-3">Logout</button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        &#9776;
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">.
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" href="?page=Home">Home</a>
                            </li>
                            
                            <?php if(isset($_SESSION['username']) && ($_SESSION['username'] == "Admin" || $_SESSION['username'] == "Candidate")): ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=posting">Post</a>
                                </li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == "Admin"): ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=register">Register Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=allcandidates">All Users</a>
                                </li>
                            <?php elseif (isset($_SESSION['username']) && $_SESSION['username'] == "Candidate"): ?>
                                <!-- If username is "Candidate", do not show login link -->
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=login">Login</a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == "Admin"): ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=show post">Candidate Posts</a>
                                </li>
                            <?php elseif (isset($_SESSION['username']) && $_SESSION['username'] == "Candidate"): ?>
                                <li class="nav-item">
                                    <a class="nav-link font-weight-bold" href="?page=show post">Show My Posts</a>
                                </li>
                            <?php endif; ?>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
