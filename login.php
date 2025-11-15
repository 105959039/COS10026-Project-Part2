<?php
session_start();

// Include database settings
include 'settings.php';

// Initialize variables
$error = '';
$locked_until = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Create database connection
    $conn = mysqli_connect($host, $user, $pswd, $dbnm);
    
    if ($conn) {
        // Check if user is locked
        $lock_check_sql = "SELECT locked_until FROM managers WHERE username = ?";
        $stmt = mysqli_prepare($conn, $lock_check_sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['locked_until'] && strtotime($row['locked_until']) > time()) {
                $locked_until = $row['locked_until'];
                $error = "Account locked until " . date('H:i:s', strtotime($locked_until));
            } else {
                // Verify credentials
                $login_sql = "SELECT id, username, password_hash, login_attempts FROM managers WHERE username = ? AND is_active = TRUE";
                $stmt = mysqli_prepare($conn, $login_sql);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if ($manager = mysqli_fetch_assoc($result)) {
                    if (password_verify($password, $manager['password_hash'])) {
                        // Successful login - reset attempts
                        $reset_sql = "UPDATE managers SET login_attempts = 0, locked_until = NULL WHERE username = ?";
                        $stmt = mysqli_prepare($conn, $reset_sql);
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        
                        $_SESSION['manager_logged_in'] = true;
                        $_SESSION['manager_username'] = $manager['username'];
                        $_SESSION['manager_id'] = $manager['id'];
                        header('Location: manage.php');
                        exit();
                    } else {
                        // Failed attempt
                        $new_attempts = $manager['login_attempts'] + 1;
                        
                        if ($new_attempts >= 3) {
                            // Lock account for 30 minutes
                            $lock_time = date('Y-m-d H:i:s', time() + 1800); // 30 minutes
                            $lock_sql = "UPDATE managers SET login_attempts = ?, locked_until = ? WHERE username = ?";
                            $stmt = mysqli_prepare($conn, $lock_sql);
                            mysqli_stmt_bind_param($stmt, "iss", $new_attempts, $lock_time, $username);
                            mysqli_stmt_execute($stmt);
                            $error = "Too many failed attempts. Account locked for 30 minutes.";
                        } else {
                            $update_sql = "UPDATE managers SET login_attempts = ? WHERE username = ?";
                            $stmt = mysqli_prepare($conn, $update_sql);
                            mysqli_stmt_bind_param($stmt, "is", $new_attempts, $username);
                            mysqli_stmt_execute($stmt);
                            $error = "Invalid credentials. Attempts: $new_attempts/3";
                        }
                    }
                } else {
                    $error = "Invalid credentials";
                }
            }
        } else {
            $error = "Invalid credentials";
        }
        mysqli_close($conn);
    } else {
        $error = "Database connection failed";
    }
}
?>
<?php include 'styles/styles.css'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manager Login - QuantumAxis Engineering</title>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>🔒 HR Manager Login</h2>
            <p>QuantumAxis Engineering</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error">⚠️ <?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label>👤 Username:</label>
                <input type="text" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label>🔑 Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">🚀 Login</button>
        </form>
        
        <div class="register-link">
            <p>Need an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>