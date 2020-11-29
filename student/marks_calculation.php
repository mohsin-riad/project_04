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
    $session_id = $_REQUEST['session_id'];;
    $id = $_SESSION['id'];
    $qry = "SELECT distinct course_id FROM marks_assign WHERE student_id = $id AND session_id = $session_id";
    $r=mysqli_query($conn,$qry);
    $i=0;
    while($row=mysqli_fetch_array($r)){
        $course_id = $row['course_id'];
        $qry = "SELECT * FROM courses WHERE id = $course_id";
        $r1 = mysqli_query($conn,$qry);
        $row1=mysqli_fetch_array($r1);
        $arr[$i][0] = $row1['code'];
        $arr[$i][1] = $row1['name'];
        $qry = "SELECT marks FROM marks_assign WHERE course_id = $course_id AND student_id = $id AND session_id = $session_id";
        $r1 = mysqli_query($conn,$qry);
        $total=0;
        while($row1=mysqli_fetch_array($r1)){
            $mark=$row1['marks'];
            $total = $total + $mark;
        }
        $arr[$i][2] = $total;
        if($total>=80 && $total<=100) { $arr[$i][3] = 4.00; $arr[$i][4]="A+";}
        else if($total>=75 && $total<=79) {$arr[$i][3] = 3.75 ; $arr[$i][4]="A";}
        else if($total>=70 && $total<=74) {$arr[$i][3] = 3.50 ; $arr[$i][4]="A-";}
        else if($total>=65 && $total<=69) {$arr[$i][3] = 3.25 ; $arr[$i][4]="B+";}
        else if($total>=60 && $total<=64) {$arr[$i][3] = 3.00 ; $arr[$i][4]="B";}
        else if($total>=55 && $total<=59) {$arr[$i][3] = 2.75 ; $arr[$i][4]="B-";}
        else if($total>=50 && $total<=54) {$arr[$i][3] = 2.50 ; $arr[$i][4]="C+";}
        else if($total>=45 && $total<=49) {$arr[$i][3] = 2.25 ; $arr[$i][4]="C";}
        else if($total>=40 && $total<=44) {$arr[$i][3] = 2.00 ; $arr[$i][4]="D";}
        else  {$arr[$i][3] = 0.00 ; $arr[$i][4]="F";}
        $i++;
    }
    
    echo json_encode($arr);
?>
