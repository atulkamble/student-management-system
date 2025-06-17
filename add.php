<?php
include 'db.php';
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    mysqli_query($conn, "INSERT INTO students (name, email) VALUES ('$name', '$email')");
    header("Location: index.php");
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    <button type="submit">Add Student</button>
</form>
