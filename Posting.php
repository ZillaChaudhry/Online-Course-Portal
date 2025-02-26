<div class="container mt-5">
    <h1 class="text-center">Posting</h1>
    <form action="back_end_code/posting_b.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="jobTitle">Title</label>
            <textarea class="form-control" id="jobTitle" name="jobTitle" rows="2" maxlength="100" placeholder="Write about 100 words"></textarea>
        </div>

        <div class="form-group">
             <label for="jobDescription">Description</label>
             <textarea class="form-control" id="jobDescription" name="jobDescription" rows="5" maxlength="500" placeholder="Write about 500 words"></textarea>
        </div>
         
        <div class="form-group">
            <label for="jobFile">Upload File</label>
            <input type="file" class="form-control-file" id="jobFile" name="jobFile">
        </div>

        <?php
             if(isset($_SESSION['username']) && $_SESSION['username'] == "Admin") {
                 require("connection.php");
                 $selectcon = "SELECT username FROM tbl_condidate";
                 $resultcon = $con->query($selectcon);
         
                 if($resultcon->num_rows > 0) {
                     $usernames = array();
         
                     while($row = $resultcon->fetch_assoc()) {
                         $usernames[] = $row['username'];
                     }
        ?>
                     <div class="form-group">
                         <label for="jobFileAdmin">Select users who have seen this post</label>
                         <input list="userOptions" class="form-control" id="jobFileAdmin" name="jobFileAdmin" placeholder="Select user that show this post...">
                         <datalist id="userOptions">
                             <?php
                                 foreach($usernames as $username) {
                                     echo '<option value="' . htmlspecialchars($username) . '">';
                                 }
                             ?>
                             <option value="Show to all">
                         </datalist>
                     </div>
         <?php
                 } 
             } 
    ?>
        

        <button type="submit" name="post" class="btn btn-primary">Post</button>
    </form>
</div>
