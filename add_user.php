<?php include 'config.php'; require_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fullname, email, password, role) 
            VALUES ('$fullname', '$email', '$password', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: users.php?msg=added");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add New User</h2>
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <label>Role</label>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <div style="margin-top: 15px;">
                <a href="users.php" class="btn btn-primary">← Cancel</a>
                <button type="submit" class="btn btn-success">Save User</button>
            </div>
        </form>
    </div>
</body>
</html>
