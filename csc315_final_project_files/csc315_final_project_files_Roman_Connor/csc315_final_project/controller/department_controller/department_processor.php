<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['facultyID'])){ $_SESSION['facultyID'] = $_GET['facultyID']; }

// #########################################################################################
// POST Variables
if(isset($_POST['instructor_id'])){ $instructor_id = $_POST['instructor_id']; }
if(isset($_POST['department_name'])){ $department_name = $_POST['department_name']; }
if(isset($_POST['department_id'])){ $department_id = $_POST['department_id']; }

switch($_GET['mode'])
{

    case 'insert':
        global $MYSQL_CONN;

        // Change to uppercase
        $department_name = strtoupper($department_name);

        $sql = "INSERT INTO department (Department_id, Department_name, Instructor_id, Instructor_Lastname)";
        $sql .=" VALUES (";
        $sql .= $department_id.", ";
        $sql .= "'".$department_name."', ";
        $sql .= "(SELECT Instructor_id FROM instructor WHERE Instructor_id = ".$instructor_id."), ";
        $sql .= "(SELECT Last_name FROM instructor WHERE Instructor_id = ".$instructor_id."))";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();

        break;

    case 'update':
        $updates = array();
        global $MYSQL_CONN;

        if(!empty($department_id)){$updates[] = 'Department_id = '.intval($department_id);}
        if(!empty($department_name)){$updates[] = 'Department_name = '."'".strtoupper($department_name)."'";}


        if(!empty($updates)){
            $sql = 'UPDATE department SET '.implode(', ', $updates).' WHERE Faculty_id = '.$_GET['faculty_id'];
        }

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    case 'delete':

        $sql = "DELETE FROM department WHERE Faculty_id = ".$_GET['faculty_id'];
        deleteMySQL($sql);
        break;
}
?>