<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] == "Admin") {
  require("connection.php");

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Selecting file path from database
    $selectQuery = "SELECT doc FROM tbl_posting WHERE id = '$id'";
    $result = $con->query($selectQuery);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $file_path = "back_end_code/users_img_doc/" . $row['doc'];

      // SQL to delete record
      $deleteQuery = "DELETE FROM tbl_posting WHERE id = '$id'";
      
      if ($con->query($deleteQuery) === TRUE) {
        echo "Record deleted successfully";

        // Delete file from server directory
        if (file_exists($file_path)) {
          unlink($file_path);
          echo "File deleted successfully from server.";
        } else {
          echo "File not found on server.";
        }

        header('Location: http://localhost/indian_Premium/?page=Home');
        exit;
      } else {
        echo "Error deleting record: " . $con->error;
      }
    } else {
      echo "No record found with ID: $id";
    }

    $con->close(); // Close database connection
  } else {
    echo "No ID specified for deletion.";
  }
} else {
  echo "Unauthorized access.";
}
?>
