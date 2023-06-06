<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['finaid_id'])){ $finaid_id = $_GET['finaid_id']; }
if(isset($_GET['student_id'])){ $student_id = $_GET['student_id']; }

// #########################################################################################
// POST Variables
if(isset($_POST['finaid_id'])){ $finaid_id = $_POST['finaid_id']; }
if(isset($_POST['finaid_source'])){ $finaid_source = $_POST['finaid_source']; }
if(isset($_POST['finaid_amount'])){ $finaid_amount = $_POST['finaid_amount']; }
if(isset($_POST['student_id'])){ $student_id = $_POST['student_id']; }
if(isset($_POST['ssn'])){ $ssn = $_POST['ssn']; }

// Change to uppercase
$finaid_source = strtoupper($finaid_source);
$finaid_amount = floatval($finaid_amount);

switch($_GET['mode'])
{

    case 'insert':
        global $MYSQL_CONN;

        $sql = "INSERT INTO financial_aid (Aid_Source, Aid_Amount, Student_id, SSN)";
        $sql .=" VALUES (";
        $sql .= "'".$finaid_source."', ";
        $sql .= $finaid_amount.", ";
        $sql .= $student_id.", ";
        $sql .= "(SELECT SSN FROM student WHERE Student_id = ".$student_id."))";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    case 'update':
        $updates = array();
        global $MYSQL_CONN;

        if(!empty($finaid_source)){$updates[] = 'Aid_Source = '."'".$finaid_source."'";}
        if(!empty($finaid_amount)){$updates[] = 'Aid_Amount = '.$finaid_amount;}


        if(!empty($updates)){
            $sql = 'UPDATE financial_aid SET '.implode(', ', $updates).' WHERE Finaid_id = '.$finaid_id;
        }
        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    case 'delete':

        $sql = "DELETE FROM financial_aid WHERE Finaid_id = ".$finaid_id;
        deleteMySQL($sql);
        break;
}
?>