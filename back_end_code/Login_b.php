<?php
session_start();
require("connection.php");

if (isset($_POST['Login'])) {
    $username = $_POST['username']; // Assuming your form fields are named 'username' and 'password'
    $password = $_POST['password'];

    $username = trim($username);
    $password = trim($password);


    // Prepare and execute the admin query
    $adminStmt = $con->prepare("SELECT * FROM tbl_admin WHERE username = ? AND password = ?");
    $adminStmt->bind_param("ss", $username, $password);
    $adminStmt->execute();
    $adminResult = $adminStmt->get_result();

    // Prepare and execute the candidate query
    $candidateStmt = $con->prepare("SELECT * FROM tbl_condidate WHERE username = ? AND password = ? AND status = 1");
    $candidateStmt->bind_param("ss", $username, $password);
    $candidateStmt->execute();
    $candidateResult = $candidateStmt->get_result();

    // Prepare and execute the blocked candidate query
    $blockedStmt = $con->prepare("SELECT * FROM tbl_condidate WHERE username = ? AND password = ? AND status = 0");
    $blockedStmt->bind_param("ss", $username, $password);
    $blockedStmt->execute();
    $blockedResult = $blockedStmt->get_result();

    if ($adminResult->num_rows > 0) {
        $row = $adminResult->fetch_assoc();
        $_SESSION['admin_email'] = $row['username'];
        $_SESSION['username'] = "Admin";
        header('Location: http://localhost/indian_Premium/');
        exit;
    } elseif ($candidateResult->num_rows > 0) {
        $row = $candidateResult->fetch_assoc();
        $_SESSION['user_email'] = $row['username'];
        $_SESSION['username'] = "Candidate";
        header('Location: http://localhost/indian_Premium/');
        exit;
    } elseif ($blockedResult->num_rows > 0) {
        echo "<script>alert('Your account is blocked');</script>";
        echo "<script>
              window.location.href='http://localhost/indian_Premium/?page=login';
              </script>";
        exit;
    } else {
        echo "<script>alert('Username or password is wrong');</script>";
        echo "<script>
              window.location.href='http://localhost/indian_Premium/?page=login';
              </script>";
        exit;
    }
}
?>
