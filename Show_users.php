<div class="container mt-4">
    <h2>User Management</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Time</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require("connection.php");

            // Pagination variables
            $limit = 30; // Number of records per page (changed to 20)
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Convert page to integer
            $offset = ($page - 1) * $limit;
            if ($offset < 0) {
                $offset = 0; // Ensure offset is not negative
            }

            // Query to fetch users, ordered by creation time descending
            $showusers = "SELECT * FROM tbl_condidate ORDER BY doe DESC LIMIT $limit OFFSET $offset";
            $resultshow = $con->query($showusers);

            if ($resultshow === false) {
                echo "Error executing query: " . $con->error;
            } else {
                // Store rows in an array
                $rows = [];
                if ($resultshow->num_rows > 0) {
                    while ($row = $resultshow->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }

                // Output rows in reverse order to display newest first
                for ($i = count($rows) - 1; $i >= 0; $i--) {
                    $row = $rows[$i];
                    $username = htmlspecialchars($row['username']);
                    $password = htmlspecialchars($row['password']);
                    $time = htmlspecialchars($row['doe']); // Assuming 'doe' is the datetime field
                    $status = $row['status'];
                    $id = $row['id'];

                    ?>
                    <tr>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $password; ?></td>
                        <td><?php echo $time; ?></td>
                        <td><?php echo $status == '1' ? 'Active' : 'Blocked'; ?></td>
                        <td>
                            <form id="deleteForm<?php echo $id; ?>" method="post" action="back_end_code/Show_users_b.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="button" onclick="confirmDelete(<?php echo $id; ?>)" class="btn btn-danger btn-sm">Delete</button>
                                <input type="hidden" name="delete" value="1">
                            </form>
                            <form method="post" action="back_end_code/Show_users_b.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" name="toggle_status" class="btn btn-<?php echo $status == '1' ? 'danger' : 'primary'; ?> btn-sm">
                                    <?php echo $status == '1' ? 'Block' : 'Activate'; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }

                if ($resultshow->num_rows == 0) {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <?php
    // Count total number of records
    $countQuery = "SELECT COUNT(*) AS total FROM tbl_condidate";
    $countResult = $con->query($countQuery);

    if ($countResult === false) {
        echo "Error counting records: " . $con->error;
    } else {
        $totalCount = $countResult->fetch_assoc()['total'];

        // Calculate total pages
        $totalPages = ceil($totalCount / $limit);

        // Pagination links
        echo "<ul class='pagination'>";
        if ($page > 1) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a></li>";
        }
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        if ($page < $totalPages) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
        }
        echo "</ul>";
    }
    ?>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            document.getElementById('deleteForm' + id).submit();
        }
    }
</script>
