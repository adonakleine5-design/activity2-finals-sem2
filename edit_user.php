<?php include 'config.php'; require_admin();

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET fullname='$fullname', email='$email', password='$pass', role='$role' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET fullname='$fullname', email='$email', role='$role' WHERE id=$id";
    }
    
    mysqli_query($conn, $sql);
    header("Location: users.php?msg=updated");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2> Edit User</h2>
        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            
            <label>Password <small>(leave blank to keep current)</small></label>
            <input type="password" name="password" placeholder="••••••••">
            
            <label>Role</label>
            <select name="role">
                <option value="user" <?php if ($user['role']==='user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if ($user['role']==='admin') echo 'selected'; ?>>Admin</option>
            </select>
            
            <div style="margin-top: 15px;">
                <a href="users.php" class="btn btn-primary">← Cancel</a>
                <button type="submit" class="btn btn-warning">Update User</button>
            </div>
        </form>
    </div>
</body>
</html>
