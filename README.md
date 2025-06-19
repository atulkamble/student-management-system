# 📦 XAMPP Student Management System
---

## ✅ Prerequisites

* Set **default web browser** to **Chrome**
* Install **Git**

  ```powershell
  # Run PowerShell as Administrator
  choco install git -y
  ```
* Install **XAMPP**
  👉 [Download from here](https://www.apachefriends.org/)

---

## ✅ Setup Instructions

1. **Start XAMPP Control Panel**

   * Start **Apache**
   * Start **MySQL**

2. **Clone the Project Repository**

   ```bash
   git clone https://github.com/atulkamble/xampp-student-management-system.git
   cd .\xampp-student-management-system\
   ```

3. **Copy Project Files to XAMPP Directory**

   * Copy all files from `xampp-student-management-system` folder
   * Paste them into:
     `C:\xampp\htdocs\student_management`

4. **Log in to XAMPP Dashboard**
   [http://localhost/dashboard/](http://localhost/dashboard/)

5. **Create Database & Table**

   * Open **phpMyAdmin**: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   * Create new database: `student_db`
   * Switch to `student_db` and run this SQL query:

     ```sql
     CREATE TABLE students (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(100),
         email VARCHAR(100)
     );
     ```

---

## ✅ Project Code Overview

**Project Folder:** `C:\xampp\htdocs\student_management`

### 📂 Structure

```
student_management/
├── db.php
├── index.php
├── add.php
├── edit.php
└── delete.php
```

---

## 📄 Key Code Files

**db.php**

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

**index.php**

```php
<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head><title>Student List</title></head>
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

**add.php**

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

**edit.php**

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

**delete.php**

```php
<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM students WHERE id=$id");
header("Location: index.php");
?>
```

---

## ✅ Run the Project

* Visit: [http://localhost/student\_management/](http://localhost/student_management/)
* You can **add**, **edit**, and **delete** student records now.

---
