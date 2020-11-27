<?php 
    session_start();
    include '../include/connection.php';
    $teacher_id = $_SESSION['id'] ;
    $session_id = $_REQUEST['session_id'];
    $course_id = $_REQUEST['course_id'];
    $query = "SELECT distinct section_id FROM `teacher_assign` WHERE `teacher_id` = $teacher_id AND `session_id` = $session_id AND course_id = $course_id AND status = 0";
    $sql = mysqli_query($conn, $query);
    $data = [];
    $i = 0;
    while($row = mysqli_fetch_array($sql))
    {
        // $course_id = $row['course_id'];
        // $query1 = "SELECT * FROM `courses` WHERE id = $course_id";
        // $sql1 = mysqli_query($conn, $query1);
        // $row1 = mysqli_fetch_assoc($sql1);
        // $course_name = $row1['name'];
        
        $section_id = $row['section_id'];
        $query2 = "SELECT * FROM `sections` WHERE id = $section_id";
        $sql2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($sql2);
        $section_name = $row2['name'];
        
        // $data[$i]['course_id'] = $course_id;
        // $data[$i]['course_name'] = $course_name;
        $data[$i]['section_id'] = $section_id;
        $data[$i]['section_name'] = $section_name;
        $i++;
    }
    //echo $data;
    echo json_encode($data);
?>