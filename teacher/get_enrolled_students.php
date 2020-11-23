<?php 
    session_start();
    include '../include/connection.php';
    $teacher_id = $_SESSION['id'];
    $course_id = $_REQUEST['course_id'];
    $section_id = $_REQUEST['section_id'];
    $session_id = $_REQUEST['session_id'];
    $query = "SELECT users.name, student_id FROM enrollment, users, marks_assign WHERE course_id=$course_id AND section_id=$section_id AND teacher_id=$teacher_id AND session_id=$session_id AND status=1 AND users.id = enrollment.student_id";
    // echo $query;
    $sql = mysqli_query($conn, $query);
    $data = [];
    $i = 0;
    while($row = mysqli_fetch_array($sql))
    {
        $data[$i]['name'] = $row['name'];
        $data[$i]['student_id'] = $row['student_id'];
        $i++;
    }
    // echo $data;
    echo json_encode($data);
?>