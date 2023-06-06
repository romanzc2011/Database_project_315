<?php

$host = "localhost";
$username = "root";
$password = "zZryderkile506!@a";
$dbName = "university";
$MYSQL_CONN = new pdo('mysql:dbname='.$dbName.';host='.$host,$username,$password);
$MYSQL_CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$MYSQL_CONN->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

// ############################################################################
// Select
// ############################################################################
function SelectMySQL($sql){
    global $MYSQL_CONN;

    $stmt = $MYSQL_CONN->query($sql);
    return $stmt->fetch();
}

// ############################################################################
// Student Insert
// ############################################################################
function insertStudent($sql, $sID, $firstName, $lastName, $age, $email, $address, $state, $zip, $major){
    global $MYSQL_CONN;

    $stmt = $MYSQL_CONN->prepare($sql);
    $stmt->execute([$sID, $firstName, $lastName, $age, $email, $address, $state, $zip, $major]);
}

// ############################################################################
// Delete
// ############################################################################
function deleteMySQL($sql){
    global $MYSQL_CONN;

    $stmt = $MYSQL_CONN->prepare($sql);
    $stmt->execute();
}

// ############################################################################
// Course Insert
// ############################################################################
function insertCourse($sql, $course_id, $courseName, $creditHrs, $instructorID, $instructorLastName){
    global $MYSQL_CONN;

    $stmt = $MYSQL_CONN->prepare($sql);
    $stmt->execute([$course_id, $courseName, $creditHrs, $instructorID, $instructorLastName]);
}

?>