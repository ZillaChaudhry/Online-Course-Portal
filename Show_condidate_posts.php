<div class="table-container">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Username</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require("connection.php");

        if(isset($_SESSION['username'])) {
            if($_SESSION['username'] != "Admin") {
                if(isset($_SESSION['user_email'])) {
                    $user_email_safe = $con->real_escape_string($_SESSION['user_email']);
                    $selectCandidateReq = "SELECT * FROM tbl_customer_posts WHERE username = '$user_email_safe' ORDER BY id DESC"; // Order by id DESC to show newest first
                } else {
                    echo '<tr><td colspan="4">User email not found in session</td></tr>';
                    exit;
                }
            } else {
                $selectCandidateReq = "SELECT * FROM tbl_customer_posts ORDER BY id DESC"; // Order by id DESC to show newest first
            }            
            
            $resultCandidatePosts = $con->query($selectCandidateReq);
            
            if ($resultCandidatePosts->num_rows > 0) {
                while ($row = $resultCandidatePosts->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                    echo '<td>';
                    echo '<a href="back_end_code/users_img_doc/' . $row['upload'] . '" class="btn btn-primary" target="_blank">View</a>';
                    echo '<a download="' . $row['upload'] . '" href="back_end_code/users_img_doc/' . $row['upload'] . '" class="btn btn-secondary">Download</a>';
            
                    if($_SESSION['username'] != "Admin") {
                        echo '<a href="delete_post.php?id=' . htmlspecialchars($row['id']) . '" class="btn btn-danger btn-sm btn-custom" onclick="return confirmDelete()">Delete</a>';
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="4">No records found</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="4">User session not found</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
</script>
