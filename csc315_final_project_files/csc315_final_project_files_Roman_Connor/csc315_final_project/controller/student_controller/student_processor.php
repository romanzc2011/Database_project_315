<?php

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

// determine which $_GET are set
if(isset($_GET['studentID'])){ $student_id = $_GET['studentID']; }

// #########################################################################################
// POST Variables
if(isset($_POST['ssn'])){ $ssn = $_POST['ssn']; }
if(isset($_POST['firstName'])){ $firstName = $_POST['firstName']; }
if(isset($_POST['lastName'])){ $lastName = $_POST['lastName']; }
if(isset($_POST['age'])){ $age = $_POST['age']; }
if(isset($_POST['email'])){ $email = $_POST['email']; }
if(isset($_POST['address'])){ $address = $_POST['address']; }
if(isset($_POST['birth_date'])){ $birthDate = $_POST['birth_date']; }
if(isset($_POST['major'])){ $major = $_POST['major']; }

// ##################################################################################
// STUDENT TABLE
// ##################################################################################
switch($_GET['mode']){

    // ##################################################################################
    // INSERT
    case 'insert':
        global $MYSQL_CONN;
        // Change to upper case
        $firstName = strtoupper($firstName);
        $lastName = strtoupper($lastName);
        $address = strtoupper($address);
        $major = strtoupper($major);

        // CONVERT DATE TO MYSQL FORMAT
        $birthDate = date('Y-m-d', strtotime($birthDate));

        $sql = "INSERT INTO student (SSN, First_name, Last_name, Age, Email, Address, Birth_date, Major, GPA)";
        $sql .=" VALUES (";
        $sql .= "'".$ssn."', ";
        $sql .= "'".$firstName."', ";
        $sql .= "'".$lastName."', ";
        $sql .= "'".$age."', ";
        $sql .= "'".$email."', ";
        $sql .= "'".$address."', ";
        $sql .= "'".$birthDate."', ";
        $sql .= "'".$major."', ";
        $sql .= "'0.00')";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();

        break;

    // ##################################################################################
    // UPDATE
    case 'update':
        $updates = array();
        global $MYSQL_CONN;
        if(!empty($firstName)){$updates[] = 'First_name = '."'".strtoupper($firstName)."'";}
        if(!empty($lastName)){$updates[] = 'Last_name = '."'".strtoupper($lastName)."'";}
        if(!empty($age)){$updates[] = 'Age = '."'".$age."'";}
        if(!empty($address)){$updates[] = 'Address = '."'".strtoupper($address)."'";}
        if(!empty($birthDate)){$updates[] = 'Birth_date = '."'".$birthDate."'";}
        if(!empty($email)){$updates[] = 'Email = '."'".$email."'";}
        if(!empty($major)){$updates[] = 'Major = '."'".strtoupper($major)."'";}

        if(!empty($updates)){
            $sql = 'UPDATE student SET '.implode(', ', $updates).' WHERE Student_id = '.$_GET['student_id'];
        }
        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        break;

    // ##################################################################################
    // DELETE
    case 'delete':
        $sql = "DELETE FROM student WHERE Student_id = ".$student_id;
        deleteMySQL($sql);
        break;
}

?>