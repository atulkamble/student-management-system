<?php
include 'db.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "UPDATE students SET name='$name', email='$email' WHERE id=$id");
    header("Location: index.php");
}
?>

<form method="post">
    Name: <input type="text" name="name" value="<?= $row['name'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
    <button type="submit">Update Student</button>
</form>
