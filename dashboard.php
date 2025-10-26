<?php include('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>System Summary</h2>
<?php
$students = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'];
$courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$enrollments = $conn->query("SELECT COUNT(*) AS total FROM enrollments")->fetch_assoc()['total'];
?>

<ul>
    <li>Total Students: <?php echo $students; ?></li>
    <li>Total Courses: <?php echo $courses; ?></li>
    <li>Total Enrollments: <?php echo $enrollments; ?></li>
</ul>
</body>
</html>
