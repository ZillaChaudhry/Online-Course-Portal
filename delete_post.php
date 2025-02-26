<?php
require("connection.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Step 1: Fetch file path from database
    $selectQuery = "SELECT upload FROM tbl_customer_posts WHERE id = ?";
    $stmt = $con->prepare($selectQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($upload);
            $stmt->fetch();

            // Step 2: Delete record from database
            $deleteQuery = "DELETE FROM tbl_customer_posts WHERE id = ?";
            $deleteStmt = $con->prepare($deleteQuery);
            $deleteStmt->bind_param("i", $id);

            if ($deleteStmt->execute()) {
                $deleteStmt->close();

                // Step 3: Delete file from local server
                $file_path = "path/to/uploaded/files/" . $upload; // Replace with actual file path
                if (file_exists($file_path)) {
                    if (unlink($file_path)) {
                        echo "File deleted successfully from server.";
                    } else {
                        echo "Error deleting file from server.";
                    }
                } else {
                    echo "File not found on server.";
                }

                // Step 4: Redirect back to show post page
                header('Location: http://localhost/indian_Premium/?page=show%20post');
                exit();
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "No record found with ID: $id";
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
} else {
    // ID not set
    header('Location: http://localhost/indian_Premium/?page=show%20post');
    exit();
}
?>
