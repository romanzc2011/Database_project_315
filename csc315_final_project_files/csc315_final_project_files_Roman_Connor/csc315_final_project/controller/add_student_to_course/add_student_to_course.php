<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['student_id'])){ $student_id = $_GET['student_id']; }
if(isset($_GET['course_id'])){ $course_id = $_GET['course_id']; }

// #########################################################################################
// POST Variables
if(isset($_POST['student_id'])){ $student_id    = $_POST['student_id']; }
if(isset($_POST['course_id'])){ $course_id      = $_POST['course_id']; }

switch($_GET['mode']){

    case 'insert':
        global $MYSQL_CONN;

        // Build INSERT statement
        $sql = "INSERT INTO add_student_to_course (Student_id, Course_id)";
        $sql .=" VALUES (";
        $sql .= $student_id.", ";
        $sql .= $course_id.")";

        try {
            $stmt = $MYSQL_CONN->prepare($sql);
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        $stmt->execute();
        break;

    case 'delete':
        $sql = "DELETE FROM add_student_to_course 
                WHERE 1=1
                AND Course_id = ".$course_id."
                AND Student_id = ".$student_id;
        deleteMySQL($sql);
        break;

}

?>