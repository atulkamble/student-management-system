**“XAMPP Project Code”**

1. A **sample PHP + MySQL project** that can run on a local XAMPP server?
2. Or something else related to configuring XAMPP itself or creating a web app using XAMPP?

Assuming you meant a **simple PHP-MySQL CRUD (Create, Read, Update, Delete) project** for XAMPP, here’s a clean, minimal example.

---

## 📦 Simple XAMPP Project Code Example

**Project Name:** `student_management`

### 📂 Project Structure

```
htdocs/
└── student_management/
    ├── db.php
    ├── index.php
    ├── add.php
    ├── edit.php
    └── delete.php
```

---

## 📄 1️⃣ db.php (Database connection)

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

---

## 📄 2️⃣ index.php (List all students)

```php
<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>
<h2>Student List</h2>
<a href="add.php">Add New Student</a>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
```

---

## 📄 3️⃣ add.php (Add a new student)

```php
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
```

---

## 📄 4️⃣ edit.php (Edit a student)

```php
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
```

---

## 📄 5️⃣ delete.php (Delete a student)

```php
<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM students WHERE id=$id");
header("Location: index.php");
?>
```

---

## 🛠️ SQL to create `student_db` and `students` table

```sql
CREATE DATABASE student_db;
USE student_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);
```

---

## ✅ How to Run This on XAMPP

1. Copy the `student_management` folder to your XAMPP `htdocs` directory.
2. Start Apache and MySQL from XAMPP control panel.
3. Open **phpMyAdmin** → create the `student_db` database → run the SQL query above.
4. Open browser → go to: [http://localhost/student\_management/](http://localhost/student_management/)

---
