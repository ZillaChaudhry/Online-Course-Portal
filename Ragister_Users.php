<center>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center mb-4">User Registration</h2>
              <form method="post" action="back_end_code/Ragister_Users_b.php" onsubmit="return validateForm()">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                  <div id="usernameError" class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                  <label for="validity-date">Validity Date:</label>
                  <input type="date" class="form-control" id="validity-date" name="validity_date" required>
                </div>
                
                <div class="text-center">
                  <button type="submit" name="RegisterUsers" class="btn btn-primary btn-block">Register</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </center>
  <script>
    function validateForm() {
      var username = document.getElementById('username').value;
      var errors = [];

      // Check if username is empty
      if (username.trim() === '') {
        errors.push("Username is required.");
      }
      if (username.trim().length <= 6) {
        errors.push("Username length must be greater than six characters.");
      }
      // Check if username contains at least one letter
      if (!/[a-zA-Z]/.test(username)) {
        errors.push("Username must contain at least one letter.");
      }

      // Check if username contains at least one digit
      if (!/\d/.test(username)) {
        errors.push("Username must contain at least one digit.");
      }

      // Display errors if any
      if (errors.length > 0) {
        var errorHtml = '';
        errors.forEach(function(error) {
          errorHtml += '<div>' + error + '</div>';
        });
        document.getElementById('usernameError').innerHTML = errorHtml;
        document.getElementById('username').classList.add('is-invalid');
        return false;
      }

      // Clear any previous errors
      document.getElementById('usernameError').innerHTML = '';
      document.getElementById('username').classList.remove('is-invalid');
      return true;
    }
  </script>