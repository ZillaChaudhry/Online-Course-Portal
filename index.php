<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Styles.css">
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="css/Header.css">
</head>
<body>
    <!--Header-->
    <?php require('Header.php'); ?>

    <!-- Body -->
    <main class="container my-5">
        <?php
        $defaultPage = 'Home'; // Set default page here
        $page = isset($_GET['page']) ? $_GET['page'] : $defaultPage;

        switch ($page) {
            case 'login':
                require("Login.php");
                break;
            case 'register':
                require("Ragister_Users.php");
                break;
            case 'posting':
                require("Posting.php");
                break;
            case 'show post':
                    require("Show_condidate_posts.php");
                    break;
            case 'Home':
            default:
                require("Home.php");
                break;
            case 'allcandidates':
                require("Show_users.php");
                break;
        }
        ?>
    </main>

    <!--Footer-->
    <?php require('Footer.php'); ?>

    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>
