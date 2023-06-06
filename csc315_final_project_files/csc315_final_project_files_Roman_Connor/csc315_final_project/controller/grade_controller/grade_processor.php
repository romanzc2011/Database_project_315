<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['student_id'])){ $_SESSION['student_id'] = $_GET['student_id']; }
if(isset($_GET['course_id'])){ $_SESSION['course_id'] = $_GET['course_id']; }
if(isset($_GET['grade_id'])){ $grade_id = $_GET['grade_id']; }

// #########################################################################################
// POST Variables
if(isset($_POST['grade'])){ $grade              = $_POST['grade']; }
if(isset($_POST['student_id'])){ $student_id    = $_POST['student_id']; }
if(isset($_POST['course_id'])){ $course_id      = $_POST['course_id']; }

switch($_GET['mode']){

    case 'update':
        $updates = array();
        $WHERE = '';
        global $MYSQL_CONN;

        if(!empty($grade)){$updates[] = 'Grade = '."'".strtoupper($grade)."'";}
        if(!empty($updates)){
            $sql = 'UPDATE student_course_grades SET '.implode(', ', $updates).' WHERE Grade_id = '.$grade_id;
        }

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
    break;

    case 'insert':
        global $MYSQL_CONN;

        // Change to uppercase
        $grade = strtoupper($grade);


        // Build INSERT statement
        $sql = "INSERT INTO student_course_grades (Student_id, Student_Lastname, Course_id, Course_name, Grade)";
        $sql .=" VALUES (";
        $sql .= $student_id.", ";
        $sql .= "(SELECT Last_name FROM student WHERE student_id = ".$student_id."), ";
        $sql .= $course_id.", ";
        $sql .= "(SELECT Course_name FROM course WHERE Course_id = ".$course_id."), ";

        $sql .= "'".$grade."')";
        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
    break;

    case 'delete':
        $sql = "DELETE FROM student_course_grades 
                WHERE Grade_id = ".$_GET['grade_id'];
        deleteMySQL($sql);
    break;



}

?>