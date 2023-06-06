<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['instructor_id'])){ $instructor_id = $_GET['instructor_id']; }

// #########################################################################################
// POST Variables
if(isset($_POST['instructor_id'])){ $instructor_id  = intval($_POST['instructor_id']); }
if(isset($_POST['firstName'])){ $firstName          = strtoupper($_POST['firstName']); }
if(isset($_POST['lastName'])){ $lastName            = strtoupper($_POST['lastName']); }
if(isset($_POST['rank'])){ $rank                    = strtoupper($_POST['rank']); }
if(isset($_POST['office'])){ $office                = strtoupper($_POST['office']); }
if(isset($_POST['dept_name'])){ $deptName           = strtoupper($_POST['dept_name']); }

switch($_GET['mode']){
//    case 'select':
//
//        $sql = "SELECT i.Instructor_id, i.First_name, i.Last_name, i.Instructor_rank, i.Office, d.Department_name
//                FROM instructor i
//                INNER JOIN department d ON d.Faculty_id = i.Faculty_id
//                WHERE 1=1
//                AND i.Instructor_id = ".$instructor_id;
//        $data = SelectMySQL($sql);
//
//        // prepare for json_encode
//        header('Content-type: application/json');
//        echo json_encode($data); // sending response to ajax
//        break;

    case 'update':
        $updates = array();
        global $MYSQL_CONN;

        if(!empty($firstName)){$updates[] = 'First_name = '."'".strtoupper($firstName)."'";}
        if(!empty($lastName)){$updates[] = 'Last_name = '."'".strtoupper($lastName)."'";}
        if(!empty($rank)){$updates[] = 'Instructor_rank = '."'".strtoupper($rank)."'";}
        if(!empty($office)){$updates[] = 'Office = '."'".strtoupper($office)."'";}
        if(!empty($deptName)){$updates[] = 'Department_name = (SELECT Department_name FROM department 
                                            WHERE Instructor_id = '.$instructor_id.')';}

        if(!empty($updates)){
            $sql = 'UPDATE instructor SET '.implode(', ', $updates).' WHERE Instructor_id = '.$instructor_id;
        }
        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    case 'insert':
        global $MYSQL_CONN;

        // Build INSERT statement
        $sql = "INSERT INTO instructor (First_name, Last_name, Instructor_rank, Office)";
        $sql .=" VALUES (";
        $sql .= "'".$firstName."', ";
        $sql .= "'".$lastName."', ";
        $sql .= "'".$rank."', ";
        $sql .= "'".$office."')";
        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    case 'delete':

        $sql = "DELETE FROM instructor WHERE Instructor_id = ".$instructor_id;
        deleteMySQL($sql);
        break;

}

?>