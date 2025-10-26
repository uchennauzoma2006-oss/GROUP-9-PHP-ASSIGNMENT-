<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('db.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Courses</title>
</head>
<body>
<h2>Add New Course</h2>
<form method="POST" action="">
    <label>Course Code:</label><br>
    <input type="text" name="course_code" required><br><br>
    <label>Course Title:</label><br>
    <input type="text" name="course_title" required><br><br>
    <label>Semester:</label><br>
    <select name="semester">
        <option value="1st">1st</option>
        <option value="2nd">2nd</option>
    </select><br><br>
    <button type="submit" name="add_course">Add Course</button>
</form>

<?php
if (isset($_POST['add_course'])) {
    $code = $_POST['course_code'];
    $title = $_POST['course_title'];
    $semester = $_POST['semester'];

    $check = $conn->query("SELECT * FROM courses WHERE course_code='$code'");
    if ($check->num_rows > 0) {
        echo "Course already exists!";
    } else {
        $conn->query("INSERT INTO courses (course_code, course_title, semester) VALUES ('$code', '$title', '$semester')");
        echo "Course added successfully!";
    }
}
?>
</body>
</html>
