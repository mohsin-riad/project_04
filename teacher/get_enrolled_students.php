<?php 
    session_start();
    include '../include/connection.php';
    $teacher_id = $_SESSION['id'];
    $course_id = $_REQUEST['course_id'];
    $section_id = $_REQUEST['section_id'];
    $session_id = $_REQUEST['session_id'];
    $query = "SELECT users.name, student_id FROM enrollment, users WHERE course_id=$course_id AND section_id=$section_id AND teacher_id=$teacher_id AND session_id=$session_id AND status=1 AND users.id = enrollment.student_id";
    // echo $query;
    $sql = mysqli_query($conn, $query);
    $data = [];
    $i = 0;
    while($row = mysqli_fetch_array($sql))
    {
        $student_id = $row['student_id'];
        $data[$i]['name'] = $row['name'];
        $data[$i]['student_id'] = $student_id;

        $query1 = "SELECT dist_id, marks FROM marks_assign WHERE marks_assign.student_id = $student_id AND marks_assign.teacher_id = $teacher_id AND marks_assign.course_id = $course_id AND marks_assign.section_id = $section_id AND marks_assign.session_id = $session_id";
        $sql1 = mysqli_query($conn, $query1);
        $flag = true;
        $j = 0;
        while($row1 = mysqli_fetch_array($sql1)){
            $dist_id = $row1['dist_id'];
            if($flag) { $data[$i]['begin'] = $dist_id; $flag = false; }
            else { $data[$i]['end'] = $dist_id; }
            $marks = $row1['marks'];
            $data[$i][$j] = $marks; 
            $j++;
        }   
        $i++;
    }
    // echo $data;
    echo json_encode($data);
?>