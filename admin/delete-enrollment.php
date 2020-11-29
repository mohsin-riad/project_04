<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'admin'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
    include '../include/connection.php'; 
    $id=$_REQUEST['id'];
    
    $qry="UPDATE enrollment SET status=2 WHERE id=$id";
    if(mysqli_query($conn,$qry)){
        header('Location: manage_student_enrollment.php');
    }
    
    //echo $courses['id'];
    //echo $courses['name'];
?>