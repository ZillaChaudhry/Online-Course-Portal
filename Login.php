<!-- Include Font Awesome CSS (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-header">
            <h3 class="text-center">Login</h3>
        </div>
        <div class="card-body">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post" action="back_end_code/Login_b.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" name="Login" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
</script>
