<?php 
if (isset($_SESSION['username'])) {
  require("connection.php");

  if ($_SESSION['username'] == "Admin") {
    $selectposts = "SELECT * FROM tbl_posting";
  } elseif ($_SESSION['username'] == "Candidate" && isset($_SESSION['user_email'])) {
    $usersemail = $_SESSION['user_email'];
    $selectposts = "SELECT * FROM tbl_posting WHERE show_username='$usersemail' or show_username='Show to all'";
  }
  else {
    echo "No valid user session found.";
    exit();
  }

  $resultposts = $con->query($selectposts);

  if ($resultposts->num_rows > 0) {
    echo '<div class="container mt-5">';
    $count = 0; // Counter to keep track of columns
    
    while ($row = $resultposts->fetch_assoc()) {
      if ($count % 3 == 0) {
        // Start a new row for every third item
        echo '<div class="row">';
      }
      
      echo '<div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title" id="title1">' . $row['job_title'] . '</h3>
              <p class="card-text" id="description1">' . $row['job_description'] . '</p>
              <h5><p class="card-text" id="username">Show to : ' . $row['show_username'] . '</p></h5>
              
              <a href="back_end_code/users_img_doc/' . $row['doc'] . '" class="btn btn-primary" target="_blank">View</a>
              <a download="' . $row['doc'] . '" href="back_end_code/users_img_doc/' . $row['doc'] . '" class="btn btn-secondary">Download</a>';

              
      if ($_SESSION['username'] == "Admin") {
          echo '<button class="btn btn-danger" onclick="confirmDelete(' . $row['id'] . ')">Delete</button>';
      }

      echo '</div>
            </div>
          </div>';

      $count++;
      
      if ($count % 3 == 0) {
        // Close the row after every third item
        echo '</div>';
      }
    }

    // Close the row if there are remaining columns
    if ($count % 3 != 0) {
      echo '</div>';
    }

    echo '</div>'; // Close container

    // JavaScript function for confirmation and delete action
    if ($_SESSION['username'] == "Admin") {
      echo '<script>
              function confirmDelete(id) {
                if (confirm("Are you sure you want to delete this post?")) {
                  window.location.href = "delete.php?id=" + id;
                }
              }
            </script>';
    }
  } else {
    echo "No posts found.";
  }

  $con->close(); // Close database connection
}
else {
  // Display default homepage content if no valid user session found
  echo '
  <div class="container mt-5">
    <center>
        <h1>Username: <span id="username" style="cursor: pointer;" onclick="copyToClipboard(\'Admin\')">Admin</span></h1>
        <h1>Password: <span id="password" style="cursor: pointer;" onclick="copyToClipboard(\'Admin\')">Admin</span></h1>
    </center>
      <div class="row justify-content-center">
          <div class="col-md-6 text-center">
              <img src="image/Home/5.jpg" alt="Image" style="width: 100%; height: auto; border-radius: 50%; display: block; margin: 0 auto;">
              <h1>Create your own website.</h1>
          </div>
      </div>
  </div>';

  echo '
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-6 text-center">
              <img src="image/Home/2.jpg" alt="Image" style="width: 100%; height: auto; border-radius: 50%; display: block; margin: 0 auto;">
              <h1>Cheap and Attractive.</h1>
          </div>
      </div>
  </div>';

  echo '
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-6 text-center">
              <img src="image/Home/3.jpg" alt="Image" style="width: 100%; height: auto; border-radius: 50%; display: block; margin: 0 auto;">
              <h1>in minimum time.</h1>
          </div>
      </div>
  </div>';

  echo '
  <div class="container mt-5">
      <div class="row justify-content-center">
          <div class="col-md-6 text-center">
              <img src="image/Home/1.jpg" alt="Image" style="width: 100%; height: auto; border-radius: 50%; display: block; margin: 0 auto;">
              <h1>increase your business reach</h1>
          </div>
      </div>
  </div>';

  // Notification div for copy success
  echo '
  <div id="notification" style="display:none; position:fixed; top:20px; right:20px; background-color:green; color:white; padding:10px; border-radius:5px;">
      Text copied to clipboard!
  </div>';
}
?>
