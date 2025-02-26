<?php
require("connection.php");

if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    $delete = $con->prepare("DELETE FROM tbl_condidate WHERE id = ?");
    if ($delete === false) {
        echo "Prepare failed: " . $con->error;
    } else {
        $delete->bind_param("i", $id);

        if($delete->execute()) {
            $delete->close();
            header('Location: http://localhost/indian_Premium/?page=allcandidates');
            exit();
        } else {
            echo "Error deleting record: " . $delete->error;
        }
    }
} else {
    echo "No delete parameter passed";
}

if(isset($_POST['toggle_status'])) {
    $id = $_POST['id']; 

    $retrieve = $con->prepare("SELECT status FROM tbl_condidate WHERE id = ?");
    if ($retrieve === false) {
        echo "Prepare failed: " . $con->error;
    } else {
        $retrieve->bind_param("i", $id);
        
        if ($retrieve->execute()) {
            $retrieve->bind_result($current_status);
            $retrieve->fetch();
            $retrieve->close();

            $new_status = $current_status == '1' ? '0' : '1';

            $update = $con->prepare("UPDATE tbl_condidate SET status = ? WHERE id = ?");
            if ($update === false) {
                echo "Prepare failed: " . $con->error;
            } else {
                $update->bind_param("ii", $new_status, $id);

                if($update->execute()) {
                    $update->close(); 
                    header('Location: http://localhost/indian_Premium/?page=allcandidates');
                    exit();
                } else {
                    echo "Error updating status: " . $update->error;
                }
            }
        } else {
            echo "Error retrieving current status: " . $retrieve->error;
        }
    }
}
?>
