<?php include('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Student</title>
</head>
<body>
<h2>Enroll Student into a Course</h2>
<form method="POST" action="">
    <label>Student Matric No:</label><br>
    <input type="text" name="matric_no" required><br><br>

    <label>Select Course:</label><br>
    <select name="course_id">
        <?php
        $result = $conn->query("SELECT * FROM courses");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['course_id']}'>{$row['course_code']} - {$row['course_title']}</option>";
        }
        ?>
    </select><br><br>

    <label>Semester:</label><br>
    <select name="semester">
        <option value="1st">1st Semester</option>
        <option value="2nd">2nd Semester</option>
    </select><br><br>

    <button type="submit" name="enroll">Enroll</button>
</form>

<?php
if (isset($_POST['enroll'])) {
    $matric_no = $_POST['matric_no'];
    $course_id = $_POST['course_id'];
    $semester = $_POST['semester'];

    // Find student ID
    $student = $conn->query("SELECT * FROM students WHERE matric_no='$matric_no'");
    if ($student->num_rows == 0) {
        echo "Student not found!";
    } else {
        $student_row = $student->fetch_assoc();
        $student_id = $student_row['student_id'];

        // Prevent duplicate enrollment
        $check = $conn->query("SELECT * FROM enrollments WHERE student_id='$student_id' AND course_id='$course_id' AND semester='$semester'");
        if ($check->num_rows > 0) {
            echo "This student is already enrolled in this course!";
        } else {
            $conn->query("INSERT INTO enrollments (student_id, course_id, semester) VALUES ('$student_id', '$course_id', '$semester')");
            echo "Enrollment successful!";
        }
    }
}
?>
</body>
</html>
