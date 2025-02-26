<?php
session_start(); // Start the session at the beginning of the script
require("connection.php");

if (isset($_POST['post'])) {
    if (isset($_SESSION['username'])) {
        $job_title = $_POST['jobTitle'];
        $job_description = $_POST['jobDescription'];
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/indian_Premium/back_end_code/users_img_doc/";

        // Ensure the directory exists or create it
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); // Create directory with full permissions (0777)
        }

        $filename = $_FILES['jobFile']['name'];
        $file_tmp = $_FILES['jobFile']['tmp_name'];
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "png", "jpeg", "avif", "gif", "docx", "doc");

        if (in_array($file_extension, $allowed_extensions)) {
            // Generate a unique filename
            $new_filename = uniqid() . "." . $file_extension;
            $target_file = $dir . $new_filename;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($file_tmp, $target_file)) {
                if ($_SESSION['username'] == "Admin") {
                    $show_user = $_POST['jobFileAdmin'];
                    // Use prepared statements to insert data into database
                    $insertpost = $con->prepare("INSERT INTO tbl_posting (job_title, job_description, doc, show_username) VALUES (?, ?, ?, ?)");
                    $insertpost->bind_param("ssss", $job_title, $job_description, $new_filename, $show_user);
                } elseif ($_SESSION['username'] == "Candidate") {
                    // Use prepared statements to insert data into database
                    $insertpost = $con->prepare("INSERT INTO tbl_customer_posts (title, description, upload, username) VALUES (?, ?, ?, ?)");
                    $insertpost->bind_param("ssss", $job_title, $job_description, $new_filename, $_SESSION['user_email']);
                } else {
                    echo "Unauthorized user.";
                    exit;
                }

                if ($insertpost->execute()) {
                    // Redirect to success page or home page
                    header('location: http://localhost/indian_Premium/?page=Home');
                    exit;
                } else {
                    echo "Error: " . $con->error;
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type. Allowed types: jpg, png, jpeg, avif, gif, docx, doc";
        }
    } else {
        echo "No valid session found.";
    }
} else {
    echo "No post data received.";
}
?>
