<?php include 'config.php'; require_admin();
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header-bar">
            <h2>User Management</h2>
            <div>
                <a href="dashboard.php" class="btn btn-sm btn-primary">← Back</a>
                <a href="add_user.php" class="btn btn-sm btn-success">+ Add User</a>
            </div>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success">
                <?php
                $msgs = ['added'=>'User added!', 'updated'=>'User updated!', 'deleted'=>'User deleted!'];
                echo $msgs[$_GET['msg']] ?? '';
                ?>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo ucfirst($row['role']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
