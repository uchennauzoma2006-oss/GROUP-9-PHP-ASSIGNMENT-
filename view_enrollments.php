<?php include('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Enrollments</title>
</head>
<body>
<h2>View Enrollments</h2>
<form method="GET" action="">
    <label>Enter Matric No:</label><br>
    <input type="text" name="matric_no" required>
    <button type="submit">View</button>
</form>

<?php
if (isset($_GET['matric_no'])) {
    $matric_no = $_GET['matric_no'];
    $student = $conn->query("SELECT * FROM students WHERE matric_no='$matric_no'");
    
    if ($student->num_rows == 0) {
        echo "Student not found!";
    } else {
        $student_row = $student->fetch_assoc();
        $student_id = $student_row['student_id'];

        $enrollments = $conn->query("
            SELECT c.course_code, c.course_title, e.semester
            FROM enrollments e
            JOIN courses c ON e.course_id = c.course_id
            WHERE e.student_id='$student_id'
        ");

        echo "<h3>Enrolled Courses for {$student_row['student_name']}:</h3>";
        echo "<ul>";
        while ($row = $enrollments->fetch_assoc()) {
            echo "<li>{$row['course_code']} - {$row['course_title']} ({$row['semester']})</li>";
        }
        echo "</ul>";
    }
}
?>
</body>
</html>
