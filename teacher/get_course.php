<?php 
    session_start();
    include '../include/connection.php';
    $teacher_id = $_SESSION['id'] ;
    $session_id = $_REQUEST['session_id'];
    $query = "SELECT * FROM `teacher_assign` WHERE `teacher_id` = $teacher_id AND `session_id` = $session_id";
    $sql = mysqli_query($conn, $query);
    $data = [];
    while($row = mysqli_fetch_array($sql))
    {
        //tough one to explore :)
        //OOP blessings :)
        class assign{
            public function __construct( $course_id, $course_name, $section_id, $section_name){
               $this->course_id = $course_id;
               $this->course_name = $course_name;
               $this->section_id = $section_id;
               $this->section_name = $section_name;
            }
        }
        $course_id = $row['course_id'];
        $query1 = "SELECT * FROM `courses` WHERE id = $course_id";
        $sql1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_assoc($sql1);
        $course_name = $row1['name'];
        
        $section_id = $row['section_id'];
        $query2 = "SELECT * FROM `sections` WHERE id = $section_id";
        $sql2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($sql2);
        $section_name = $row2['name'];
        
        $row_assign = new assign($course_id, $course_name, $section_id, $section_name);
        $data[] = $row_assign;
    }
    echo json_encode($data);
?>