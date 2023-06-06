<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['course_id'])){ $course_id = $_GET['course_id']; }
// #########################################################################################
// POST Variables
if(isset($_POST['courseID'])){ $course_id           = $_POST['courseID']; }
if(isset($_POST['courseName'])){ $courseName        = $_POST['courseName']; }
if(isset($_POST['credits'])){ $creditHrs            = $_POST['credits']; }
if(isset($_POST['instructor_id'])){ $instructorID   = $_POST['instructor_id']; }

// ##################################################################################
// COURSE TABLE
// ##################################################################################
switch($_GET['mode']){
//    // ##################################################################################
//    // SELECT
//    case 'select':
//        global $MYSQL_CONN;
//        $sql = "SELECT * FROM course
//                WHERE 1=1
//                AND Course_id = " . $_GET['course_id'];
//        $data = (SelectMySQL($sql));
//
//        // prepare for json_encode
//        header('Content-type: application/json');
//        echo json_encode($data); // sending response to ajax
//        break;

    // ##################################################################################
    // INSERT
    case 'insert':
        global $MYSQL_CONN;

        // Change to uppercase
        $course_id = intval($course_id);
        $courseName = strtoupper($courseName);
        $creditHrs = intval($creditHrs);
        $instructorID = intval($instructorID);

        $sql = "INSERT INTO course (Course_id, Course_name, Credits, Instructor_id, Instructor_Lastname)";
        $sql .=" VALUES (";
        $sql .= $course_id.", ";
        $sql .= "'".$courseName."', ";
        $sql .= $creditHrs.", ";
        $sql .= $instructorID.", ";
        $sql .= "(SELECT Last_name FROM instructor WHERE Instructor_id = ".$instructorID."))";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    // ##################################################################################
    // UPDATE
    case 'update':
        $updates = array();
        global $MYSQL_CONN;
        if(!empty($instructorID)){$updates[] = 'Instructor_id = '.intval($instructorID);}
        if(!empty($courseName)){$updates[] = 'Course_name = '."'".strtoupper($courseName)."'";}
        if(!empty($creditHrs)){$updates[] = 'Credits = '.intval($creditHrs);}

        if(!empty($updates)){
            $sql = 'UPDATE course SET '.implode(', ', $updates).' WHERE Course_id = '.$_GET['course_id'];
        }

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    // ##################################################################################
    // DELETE
    case 'delete':
        $sql = "DELETE FROM course WHERE Course_id = ".$_GET['course_id'];
        deleteMySQL($sql);
        break;
}
?>