<?php
require("connection.php");

if (isset($_POST['RegisterUsers'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $doe = $_POST['validity_date'];

    $username = $con->real_escape_string($username);

    $selectcandidate = "SELECT * FROM tbl_condidate WHERE username = '$username'";
    $result = $con->query($selectcandidate);
    
    if ($result->num_rows > 0) {
        echo "<script>alert('This username is already registered');</script>";
        echo "<script>window.location.href='http://localhost/indian_Premium/?page=register'</script>";
    } else {
        $status = 1; // Assuming '1' is the status you want to insert

        $stmt = $con->prepare("INSERT INTO tbl_condidate (username, password, doe, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $password, $doe, $status);
        
        if ($stmt->execute()) {
            $showAlert = "User created";
            header('Location: http://localhost/indian_Premium/?page=allcandidates');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

$con->close();
?>
