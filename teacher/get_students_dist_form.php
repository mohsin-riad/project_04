<?php 
    session_start();
    include '../include/connection.php';
    $teacher_id = $_SESSION['id'];
    $course_id = $_REQUEST['course_id'];
    $section_id = $_REQUEST['section_id'];
    $session_id = $_REQUEST['session_id'];
    $query = "SELECT * FROM `num_dist` WHERE `course_id` = $course_id AND `teacher_id` = $teacher_id AND `section_id` = $section_id AND `session_id`= $session_id";
    // echo $query;
    $sql = mysqli_query($conn, $query);
    $data = [];
    $i = 0;
    while($row = mysqli_fetch_array($sql))
    {
        $data[$i]['id'] = $row['id'];
        $data[$i]['catagory_name'] = $row['catagory_name'];
        $data[$i]['marks'] = $row['marks'];
        $i++;
    }
    // echo $data;
    echo json_encode($data);
?>