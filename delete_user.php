<?php include 'config.php'; require_admin();
$id = $_GET['id'];

// Don't let admin delete themselves
if ($id != $_SESSION['user_id']) {
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}

header("Location: users.php?msg=deleted");
exit;
?>
