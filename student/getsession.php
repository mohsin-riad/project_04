<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
        session_destroy();
        header('Location: ../index.php');
    }
      else if($_SESSION['username'] && $_SESSION['role'] != 'student'){
        session_destroy();
        header('Location: ../unauthorised_user.php');
    }
    include '../include/connection.php';
    $session_id = $_REQUEST['session_id'];
    $id = $_SESSION['id'];
    $qry = "SELECT * FROM enrollment WHERE student_id = $id AND session_id = $session_id";
    $r=mysqli_query($conn,$qry);
    $i=0;
    while($row=mysqli_fetch_array($r)){
            $course_id = $row['course_id'];
            $query1= "SELECT * FROM `courses` WHERE id = $course_id";
            $sql1 = mysqli_query($conn, $query1);
            $row1 = mysqli_fetch_assoc($sql1);
            
            $session_id = $row['session_id'];
            $query2= "SELECT * FROM `sessions` WHERE id = $session_id";
            $sql2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($sql2);

            $section_id = $row['section_id'];
            $query3= "SELECT * FROM `sections` WHERE id = $section_id";
            $sql3 = mysqli_query($conn, $query3);
            $row3 = mysqli_fetch_assoc($sql3);
            
            $type_id = $row['type_id'];
            $query4= "SELECT * FROM `type` WHERE id = $type_id";
            $sql4 = mysqli_query($conn, $query4);
            $row4 = mysqli_fetch_assoc($sql4);

            $data[$i]['course'] =  $row1['name'];
            $data[$i]['course_type'] = $row1['type'];
            $data[$i]['credit'] = $row1['credit'];
            $data[$i]['section'] = $row3['name'];
            $data[$i]['type'] =  $row4['name'];
            if($row['status']==0) {$data[$i]['status'] ="pending";} 
            else if($row['status']==1) {$data[$i]['status'] ="<p style='color: Green;'>Approved</p>";}
            else if($row['status']==2) {$data[$i]['status'] ="<p style='color: Red;'>Rejected</p>";} 
            $i++;
    }
    //echo $data[0]['course'] .' '.$data[0]['course_type'].' '.$data[0]['credit'];
    echo json_encode($data);
?>
